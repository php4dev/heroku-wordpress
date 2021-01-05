<template>
	<div id="ms-image-drag-drop">
		<span v-if="!dragAndDropCapable">{{ __('Drag and drop interface not available.', 'ml-slider') }}</span>
		<form v-show="dragAndDropCapable">
			<div
				ref="fileform"
				:class="{'ms-drag-hovering': isDragHovering || uploadPercentage > 0, 'has-error': error}"
				class="ms-drag-drop"
				@dragenter="isDragHovering = true"
				@dragleave="isDragHovering = false">
				<div
					v-if="uploadPercentage > 0"
					class="ms-upload-progress">
					<div class="ms-progress">
						<div
							:style="{width: uploadPercentage + '%'}"
							class="ms-progress-bar"/>
						<span>{{ __('Crunching...', 'ml-slider') }}</span>
					</div>
				</div>
			</div>
			<span v-if="uploadPercentage === 0 && !error">{{ __('Drop images here', 'ml-slider') }}</span>
			<span
				v-if="error"
				v-text="error"/>
		</form>
	</div>
</template>

<script>
import { Axios } from '../../api'

export default {

	// TODO: perhaps use this to allow a file or package to be dropped (for future export/import)
	// props: [],
	data() {
		return {
			dragAndDropCapable: false,
			files: [],
			uploadPercentage: 0,
			isDragHovering: false,
			error: false
		}
	},

	mounted() {
		const dragDropEvents = [
			'drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'
		]
		this.dragAndDropCapable = this.determineDragAndDropCapable()

		if (this.dragAndDropCapable) {

			// Add a listener for each event to stop browser default
			dragDropEvents.forEach(event => {
				this.$refs.fileform.addEventListener(event, e => {
					e.preventDefault()
					e.stopPropagation()
				})
			})

			// Add an event listener to upload when dropping on the form
			this.$refs.fileform.addEventListener('drop', this.attachDropEvent)
		}
	},
	methods: {

		attachDropEvent(event) {
			this.isDragHovering = true

			// Add only images to the local files array
			for (let i = 0; i < event.dataTransfer.files.length; i++) {
				/\.(jpe?g|png|gif)$/i.test(event.dataTransfer.files[i].name) && this.files.push(event.dataTransfer.files[i])
			}

			// If no files found reset the UI and show an error
			if (!this.files.length) {
				this.isDragHovering = false
				this.error = this.__('No valid files found', 'ml-slider')
			}

			// Upload right away
			this.files.length && this.submitFiles()
		},

		// Determines if the drag and drop functionality is in the window
		determineDragAndDropCapable() {
			let div = document.createElement('div')
			return (('draggable' in div) ||
					('ondragstart' in div && 'ondrop' in div)) &&
					'FormData' in window &&
					'FileReader' in window
		},

		// Handles uploading
		submitFiles() {
			let formData = new FormData()
			for (let key in this.files) {
				formData.append('files[' + key + ']', this.files[key])
			}

			// Start the uploader animation
			this.uploadPercentage = 1

			// Add param for old WP
			formData.append('action', 'ms_import_images')

			this.files.length && Axios.post('import/images', formData, {
				headers: {
					'Content-Type': 'multipart/form-data'
				},
				onUploadProgress: progressEvent => {
					// Leave the last 20% for the final confirmation from the server
					let percentage = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total)) - 20
					this.uploadPercentage = percentage > 1 ? percentage : 1
				}
			}).then(response => {
				console.info('MetaSlider: ', response)
				this.uploadPercentage = 100

				// Refresh to show added slides
				window.location.reload(true)
			}).catch(error => {
				this.uploadPercentage = 0
				this.isDragHovering = false
				this.$refs.fileform.removeEventListener('drop', this.attachDropEvent)
				this.error = this.getErrorMessage(error.response)
				this.notifyError('metaslider/drag-and-drop-error', error, true)
			})
		}
	}
}
</script>

<style lang="scss" scoped>
	@import '../../assets/styles/globals.scss';
	@import '../../assets/styles/mixins.scss';
	#ms-image-drag-drop > form {
		display: flex;
		justify-content: center;
		align-items: center;
		position: relative;
		height: 100px;
		margin: auto;
		margin-top: 1rem;
		> div {
			display: flex;
			justify-content: center;
			align-items: center;
			position: absolute;
			top: 0;
			left:0;
			color: #a0a5aa;
			background: transparent;
			transition: all 0.2s ease-in-out;
			font-size: 1.3em;
			width: 100%;
			height: 100%;
			border: 4px dashed #b4b9be;
			&.ms-drag-hovering {
				background: #eee;
				height: 200%;
				border-color: $blue-light;
			}
			&.has-error {
				border-color: $red !important;
				~ span {
					color: $red;
				}
			}
		}
	}
</style>
