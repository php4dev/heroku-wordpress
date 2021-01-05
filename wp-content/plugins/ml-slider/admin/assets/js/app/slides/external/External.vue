<template>
	<div class="attachments-browser external-media-importer">
		<div
			v-if="downloading"
			class="ms-hero-status">
			<div
				v-if="uploadPercentage > 0"
				class="ms-upload-progress">
				<div class="ms-upload-image">
					<span
						:aria-label="$refs['external-api'].fileName"
						tabindex="0"
						role="checkbox"
						aria-checked="false"
						style="width:150px;height:150px"
						class="attachment save-ready">
						<div class="attachment-preview js--select-attachment type-image subtype-jpeg portrait">
							<div class="thumbnail">
								<div class="centered">
									<img
										:src="$refs['external-api'].selected.urls.regular"
										:alt="$refs['external-api'].fileName"
										draggable="false">
								</div>
							</div>
						</div>
					</span>
				</div>
				<div class="ms-progress">
					<div
						:style="{width: uploadPercentage + '%'}"
						class="ms-progress-bar"/>
					<span class="text-lg">{{ downloadingMessage ? downloadingMessage : __('Crunching...', 'ml-slider') }}</span>
				</div>
			</div>
		</div>
		<component
			v-show="!downloading"
			ref="external-api"
			:is="component">
			<template slot="search-tools">
				<slot name="search-tools"/>
			</template>
		</component>
	</div>
</template>

<script>
import { EventManager } from '../../utils'
import { Axios } from '../../api'
import unsplash from './Unsplash.vue'

export default {
	components: {
		unsplash
	},
	props: {
		source: {
			type: [String],
			default: 'unsplash'
		},
		slideshowId: {
			type: [String, Number],
			default: null
		},
		slideId: {
			type: [String, Number],
			default: null
		},
		slideType: {
			type: [String],
			default: 'image'
		}
	},
	data() {
		return {
			page: 1,
			component: null,
			mediaButton: {},
			ourMediaButton: {},
			downloading: false,
			uploadPercentage: 1,
			downloadingMessage: ''
		}
	},
	watch: {
		downloading() {
			this.ourMediaButton.disabled = this.downloading
			if (this.downloading) window.metaslider.about_to_reload = true
		}
	},
	created() {
		// This can support other APIs, hard coded now for unsplash
		this.component = this.source
	},
	mounted() {
		// Set up the download progress bar %
		EventManager.$on('metaslider/external-api-percentage', ({ percentage }) => {
			this.uploadPercentage = percentage
		})

		// If the user has some images selected from the original media selector, remove them
		const importerContainer = document.querySelector('.external-media-importer')

		let clearButton = importerContainer.closest('.media-modal-content')
		clearButton = clearButton.querySelector('button.clear-selection')
		clearButton && clearButton.click()

		// Manually deselect any possible remaining images
		const selectedImages = document.querySelectorAll('.attachment.save-ready.selected')
		selectedImages && selectedImages.forEach(image => {
			image.click()
		})

		// Hack into the media upload button when the component is active
		let modalContainer = importerContainer.closest('.media-modal-content')
		this.mediaButton = modalContainer.querySelector('.media-frame-toolbar .media-toolbar-primary button.media-button')

		// Clone the button and use our version instead (original restored on destroy)
		this.ourMediaButton = this.mediaButton.cloneNode()
		this.ourMediaButton.classList.add('float-right', 'rtl\:float-left')
		this.ourMediaButton.innerHTML = this.mediaButton.innerHTML
		this.mediaButton.parentNode.insertBefore(this.ourMediaButton, this.mediaButton)

		this.ourMediaButton.disabled = false
		this.mediaButton.style.visibility = 'hidden'

		// The component isn't destroyed on tab switching, so this could be added multiple times. That's ok.
		this.ourMediaButton.addEventListener('click', this.interceptAddButton)

	},
	destroyed() {
		// Delete our button and show the original button
		this.ourMediaButton.removeEventListener('click', this.interceptAddButton)
		this.ourMediaButton.parentNode.removeChild(this.ourMediaButton)
		this.mediaButton.style.visibility = 'visible'

		const container = document.getElementById('image-api-container')
		container && container.parentNode.removeChild(container)

		if (window.metaslider.about_to_reload) {

			delete window.metaslider.about_to_reload

			// Close any WP media modals (currently we only have two)
			window.create_slides && window.create_slides.close()
			window.update_slide_frame && window.update_slide_frame.close()

		}
	},
	methods: {
		async interceptAddButton(event) {

			// Child components must impliment some of these referenced methods
			if (this.$refs['external-api'].selected.id) {
				this.downloading = true
				this.downloadingMessage = this.__('Saving...', 'ml-slider')

				const { data } = await this.$refs['external-api'].download()
				const uploadData = this.$refs['external-api'].upload
				const formData = new FormData()
				const name = this.$refs['external-api'].fileName

				// Add the file
				formData.append('files[' + name + ']', data, name)

				// Add the data (captions, etc)
				Object.keys(this.$refs['external-api'].upload).forEach(key => {
					let value = uploadData[key]
					formData.append('image_data[' + name + '][' + key + ']', value)
				})

				// Add additional info as needed
				formData.append('slideshow_id', this.slideshowId)
				this.slideType && formData.append('slide_type', this.slideType)
				this.slideId && formData.append('slide_id', this.slideId)
				formData.append('action', 'ms_import_images')

				const thumbnail = await Axios.post('import/images', formData).catch(error => {
					this.notifyError('metaslider/image-import-error', error, true)
					this.slideId = true // Prevent page reload
					this.$destroy() // Close the module
				})

				// incread slider to 100 and wait a second
				this.uploadPercentage = 100
				this.downloadingMessage = this.__('Complete!', 'ml-slider')
				await new Promise(resolve => setTimeout(resolve, 1500))

				// Reload to show the new slide
				!this.slideId && window.location.reload(true)

				// Set the new image if we are on a slide
				if (this.slideId) {
					document.querySelector('[data-slide-id="' + this.slideId + '"] .thumb').style.backgroundImage = 'url(' + thumbnail.data.data + ')'

					// Update any image data fields as necessary (field does not need to exist)
					EventManager.$emit('metaslider/image-meta-updated', ['' + this.slideId], this.$refs['external-api'].upload)
				}

				// We're done!
				this.$destroy()
			}
			// Don't need error handling / validation here
		}
	}
}
</script>

<style lang="scss">
.external-media-importer {
	ul.attachments li {
		max-width: 175px;
	}
}
.ms-hero-status {
	display: flex;
    align-items: center;
	// justify-content: center;
	flex-direction: column;
    width: 100%;
	height: 100%;
	.ms-upload-progress {
		height: 100%;
	}
	.ms-progress {
		width: 50%;
		span {
			line-height: 24px;
		}
	}
}
.ms-upload-image {
	margin: 1rem 0;
	border: 2px solid rgba(204, 204, 204, 0.7);
	img {
		width: 100%;
		display: block;
	}
}
</style>
