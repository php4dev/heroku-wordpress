<template>
	<div
		id="preview-component"
		:class="{ 'ms-has-error': errorMessage.length }"
		class="h-full z-max relative">
		<sweet-modal
			:ref="'preview'"
			:class="{'control-light': lightsOn}"
			:overlay-theme="overlayTheme"
			:modal-theme="overlayTheme"
			:blocking="true"
			:pulse-on-block="false"
			hide-close-button>
			<div
				slot="box-action"
				class="flex w-full bg-gray-light fixed top-0 left-0 right-0 h-8 items-center justify-between">
				<div class="flex h-full">
                    <h2
                        :class="{
                            'bg-white text-black': overlayTheme !== 'dark',
                            'bg-black text-white': overlayTheme === 'dark'
                        }"
                        class="font-bold flex items-center h-full m-0 pl-6 pr-8 relative overflow-hidden uppercase leading-normal">
                        {{ __('Preview', 'ml-slider') }}
                    </h2>
                    <button
                        :title="__('Toggle overlay type', 'ml-slider') + ' (L)'"
                        class="lightbulb w-10 px-2 hover:bg-black hover:text-white hover:p-px transition duration-200"
                        :class="{
                            'bg-black text-white p-px': overlayTheme !== 'dark',
                            'bg-transparent text-black': overlayTheme === 'dark'
                        }"
                        @click="toggleLights">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>
                    <button
                        :title="__('Toggle full width', 'ml-slider') + ' (F)'"
                        :class="{
                            'bg-black text-white p-px': showFullwidth,
                            'bg-transparent text-black': !showFullwidth
                        }"
                        class="w-10 px-2 hover:bg-black hover:text-white hover:p-px transition duration-200"
                        @click="toggleFullwidth">
                        <svg
                            class="w-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        </svg>
                    </button>
				</div>
				<button
					:title="__('Exit preview', 'ml-slider') + ' (ESC)'"
					class="mr-2 rtl:ml-2 rtl:mr-0 w-6 text-black"
					@click="closePreview">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
				</button>
			</div>
            <iframe
				v-if="'' !== html"
				:class="{'invisible':!iframeLoaded}"
				:id="'iframe-' + _uid"
				:srcdoc="html"
				frameborder="0"
				@load="setupIframe"
			/>
            <div v-else>
                <span v-if="!iframeLoaded && !errorMessage.length">
                    {{ __('Loading...', 'ml-slider') }}
                </span>
                <p
                    v-if="errorMessage.length"
                    class="ms-error"
                    v-text="errorMessage"/>
                <p
                    v-if="notFullySupported"
                    class="ms-feature-not-supported">
                    {{ __('This feature is not fully supported in this browser.', 'ml-slider') }}
                </p>
            </div>
		</sweet-modal>
	</div>
</template>

<script>
// TODO Maybe we dont need to save first if on a theme view
// green checkmark

import { EventManager } from '../utils'
import { Axios } from '../api'
import './components'
import srcDoc from 'srcdoc-polyfill'
import hotkeys from 'hotkeys-js';
import { mapGetters } from 'vuex'

export default {
	props: {},
	data() {
		return {
			html: '',
			slideshowId: '',
			theme_id: '',
			iframeLoaded: false,
			errorMessage: '',
			previewIframe: {},
			overlayTheme: 'dark',
			showFullwidth: false,
			notFullySupported: !('srcdoc' in document.createElement('iframe')),
			resizeEvent: {}
		}
	},
	computed: {
		lightsOn() {
			// TODO: save the state in the settings behind the scenes
			return 'dark' !== this.overlayTheme
		},
		maxWidth() {
			// TODO: refactor when settings object is implimented in vue store
			let width = parseInt(document.getElementsByName('settings[width]')[0].value, 10)

			// This accounts the 40px padding on each side.
			return (!this.showFullwidth && width) ? width + 'px' : '100%'
		},
		...mapGetters({
			current: 'slideshows/getCurrent'
		})
	},
	mounted() {
		// Note, the slideshow should be saved BEFORE this event is fired
		EventManager.$on('metaslider/open-preview', ({ slideshowId, themeId }) => {
			this.openPreview(slideshowId, themeId)
		})

		hotkeys('alt+p', () => this.handleOpeningPreviewByKeyboard())
	},
	methods: {
		hasSlides() {
			return document.querySelector('tr.slide:not(.ms-deleted)')
		},
		openPreview(slideshowId = null, themeId = null) {
			// If no images are found, offer to import some.
			if (!this.hasSlides()) {
				EventManager.$emit('import-notice', themeId || this.current.theme.folder)
				return false
			}

			// Add events for keyboard controls
			document.addEventListener('keyup', this.handleKeyups)

			// Reset to not show fullwidth whenever loaded.
			this.showFullwidth = false

			// Open the specific preview
			this.$refs['preview'].open()

			// Fetch the iframe
			this.fetchIframe(slideshowId, themeId)

		},
		closePreview() {
			this.$refs['preview'].close()
			this.html = ''
			this.iframeLoaded = false
			this.errorMessage = ''
			document.removeEventListener('keyup', this.handleKeyups)
		},
		fetchIframe(slideshowId = null, themeId = null) {
			this.errorMessage = ''
			Axios.get('slideshow/preview', {
				params: {
					action: 'ms_get_preview',
					theme_slug: themeId || this.current.theme.folder, // Used for pro themes
					slideshow_id: slideshowId || this.current.id,
					theme_id: themeId || this.current.theme.folder
				}
			}).then(response => {
				this.html = response.data.data

				// polyfill for ie11
				this.$nextTick(() => {
					srcDoc.set(document.getElementById('iframe-' + this._uid))

					// ! Somehow this is an IE11 fix. I'm guessing it forces Vuejs to compare
					// ! the dom to the virtual dom and force the update. Oh well, it works
					if (this.notFullySupported) console.log(document.getElementById('iframe-' + this._uid))
				})
				this.notifySuccess('metaslider/preview-loaded', 'Preview loaded')
			}).catch(error => {
				this.iframeLoaded = true
				this.errorMessage = this.getErrorMessage(error.response)
				this.notifyError('metaslider/preview-error', error)
			})
		},
		setupIframe(event) {
			this.previewIframe = {
				window: event.target.contentWindow,
				document: event.target.contentDocument,
				container: event.target.contentDocument.getElementById('preview-container'),
				slideshow: event.target.contentDocument.querySelector('.metaslider')
			}

			// Add events for keyboard controls for when focus is inside the iframe
			this.previewIframe.document.addEventListener('keyup', this.handleKeyups)

			// Set the slideshow to 100% width
			this.previewIframe.slideshow.style.width = '100%'

			// Add a way to fake a resize event inside the iframe, and trigger it
			if ('function' !== typeof window.Event) { // IE 11 polyfill
				this.resizeEvent = this.previewIframe.window.document.createEvent('UIEvents')
				this.resizeEvent.initUIEvent('resize', true, false, window, 0)
			} else {
				this.resizeEvent = new Event('resize')
			}

			// If the slideshow is a carousel make full width
			if (document.getElementsByName('settings[carouselMode]')[0].checked) {
				this.toggleFullwidth()
			}

			this.previewIframe.window.dispatchEvent(this.resizeEvent)
			this.iframeLoaded = true
		},
		toggleFullwidth() {
			this.showFullwidth = !this.showFullwidth

			// Set the container and slideshow to full width
			this.previewIframe.container.style.maxWidth = this.maxWidth
			this.previewIframe.slideshow.style.maxWidth = this.maxWidth

			// trigger a resize in the iframe to let the slider recalculate itself
			this.previewIframe.window.dispatchEvent(this.resizeEvent)
		},
		toggleLights() {
			this.overlayTheme = 'dark' === this.overlayTheme ? 'light' : 'dark'
		},
		handleKeyups(event) {
			70 === event.keyCode && this.toggleFullwidth() // F
			76 === event.keyCode && this.toggleLights() // L
			27 === event.keyCode && this.closePreview() // ESC
		},
		handleOpeningPreviewByKeyboard() {

			if (this.$parent.saving) return false

			if (document.getElementById('preview-component').length) {
				return false
			}

			// This will also offer to import slides if none exist
			EventManager.$emit('metaslider/preview')
		}
	}
}
</script>

<style lang="scss">
	@import '../assets/styles/globals.scss';
	div#preview-component {
		float: left;
		> .sweet-modal-overlay {
			background: #FFF;
			&.theme-dark {
				background: $wp-black;
			}
			.sweet-modal {
				background: transparent;
				box-shadow: none;
				min-width: 100%;
				padding: 0;
				.sweet-content,
				.sweet-content-content,
				iframe {
                    display: flex;
                    align-items: center;
                    justify-content: center;
					width: 100%;
					height:100%;
				}
			}
		}
	}
</style>
