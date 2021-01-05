import Vue from 'vue'
import { __, _x, _n, _nx, sprintf, setLocaleData, EventManager } from './utils'
import SweetModal from '../tmp/sweet-modal-vue/src/plugin.js'
import Swal from 'sweetalert2'
import "@sweetalert2/theme-wordpress-admin/wordpress-admin.scss";
import { mapGetters } from 'vuex'

// Set up the locale data for the translations to be used globally.
Vue.mixin({
	computed: {
		...mapGetters({
			current: 'slideshows/getCurrent'
		})
	},
	created() {
		this.__ = __
		this._x = _x
		this._n = _n
		this._nx = _nx
		this.sprintf = sprintf
		setLocaleData(window.metaslider_api.locale, 'ml-slider')

		// Consider using WP defaults too. Caveat: large filesize
		// setLocaleData(window.metaslider_api.default_locale, 'default')
		this.siteId = window.metaslider_api.site_id
		this.proUser = window.metaslider_api.proUser
		this.hoplink = window.metaslider_api.hoplink
		this.themeEditorLink = window.metaslider_api.theme_editor_link
		this.metasliderPage = window.metaslider_api.metaslider_page,
		this.production = process.env.NODE_ENV === 'production'

		this.isIE11 = !!window.MSInputMethodContext && !!document.documentMode

		this.notify = Swal.mixin({
			toast: true,
			position: 'bottom-start',
			showConfirmButton: false,
			timer: 6000,
			onOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			},
			onClose: (toast) => {
				toast.removeEventListener('mouseenter', Swal.stopTimer)
				toast.removeEventListener('mouseleave', Swal.resumeTimer)
			},
			onBeforeOpen: (toast) => {

				// Offset the toast message based on the admin menu size
				let dir = 'rtl' === document.dir ? 'right' : 'left'
				toast.parentElement.style[dir] = document.getElementById('adminmenu').offsetWidth + 'px'
			}
		})

		// Intercept to flash error message to user
		window.onerror = (message, source, lineNumber, columnNumber, error) => {
			console.log('message', message);
			let filename = ''
			try {

				// This might help users identify errors that are coming from other plugins
				filename = source.split('/').pop().split('#')[0].split('?')[0]
			} catch (error) {}
			this.notifyError(
				'window/global-js-error',
					(message.length > 100 ? message.substring(0, 100) + '...' : message) +
					(filename.length ? ` (${filename})` : ''),
				true)
		}
		Vue.config.errorHandler = function (error, vm, info) {
			vm.notifyError(`vue/${info}-error`, error, true)
		}
	},
	methods: {

		asset(file = '') {
			return window.metaslider_api.metaslider_admin_assets + file.replace(/^\/+/, '')
		},

		// These are mainly meant for logging and not ideal for hooking into events
		notifyInfo(id, message, toast = false) {
			console.log('MetaSlider:', message)
			EventManager.$emit(id, message)
			toast && this.notify.fire({
				icon: 'info',
				iconHtml: '<div class="dashicons dashicons-megaphone" style="transform: scale(2.5);"></div>',
				title: 'string' === typeof message ? message : this.__('Doing something...', 'ml-slider')
			})
		},
		notifyWarning(id, message, toast = false) {
			console.warn('MetaSlider:', message)
			EventManager.$emit(id, message)
			toast && this.notify.fire({
				icon: 'warning',
				title: 'string' === typeof message ? message : this.__('No error message provided.', 'ml-slider'),
				iconHtml: '<div class="dashicons dashicons-warning" style="transform: scale(2);"></div>',
			})
		},
		notifySuccess(id, message, toast = false) {
			console.log('MetaSlider:', message)
			EventManager.$emit(id, message)
			toast && this.notify.fire({
				icon: 'success',
				title: 'string' === typeof message ? message : this.__('Success', 'ml-slider'),
				iconHtml: '<div class="dashicons dashicons-yes" style="transform: scale(3);"></div>',
			})
		},
		notifyError(id, error, toast = false) {
			console.error(`MetaSlider (${id.replace('metaslider/', '')}):`, error)

			if (!error) {
				error = this.__('Undefined error occurred', 'ml-slider')
			}
			// If it comes from the page itself
			if (!error.hasOwnProperty('response') && error.hasOwnProperty('message')) {
				error = error.message
			}

			if ('string' === typeof error && toast) {
				this.notify.fire({
					showConfirmButton: true,
					timer: null,
					icon: 'error',
					iconHtml: '<div class="dashicons dashicons-no" style="transform: scale(3);"></div>',
					title: error
				})
			}

			// It could come from jQuery
			if (error.hasOwnProperty('responseJSON')) {
				error.response = error.responseJSON
			}

			// Sometimes the response is returned
			if (error.hasOwnProperty('status')) {
				error.response = error
			}

			// If the error is abnormal
			if (!error.hasOwnProperty('response')) return

			// Make others aware an error happened
			EventManager.$emit(id, error.response)

			// Display the error in the console and optionally a toast message
			// TODO: Count the error message length and show a modal if needed
			console.error('MetaSlider:', this.getErrorMessage(error.response))
			toast && this.notify.fire({
				showConfirmButton: true,
				timer: null,
				icon: 'error',
				iconHtml: '<div class="dashicons dashicons-no" style="transform: scale(3);"></div>',
				title: this.getErrorMessage(error.response)
			})
		},
		getErrorMessage(error) {
			try {
				if ('string' === typeof error) return error
				if (error.hasOwnProperty('message')) return error.message
				if (!error.hasOwnProperty('data')) return error.statusText + ' (' + error.status + ')'
				if (error.data.hasOwnProperty('message')) return error.data.message
				if (!error.data.hasOwnProperty('data')) return error.statusText + ' (' + error.status + ')'
				if (error.data.data.hasOwnProperty('message')) return error.data.data.message
				if (error.statusText) return error.statusText + ' (' + error.status + ')'
			} catch(exception) {
				console.error('Error handling failed:', error, exception)
			}
			return this.__('No error message reported.', 'ml-slider')
		},
		triggerEvent(id, payload) {
			EventManager.$emit(id, payload)
		},
		currentSlideshowId() {
			return this.current.id
		}
	}
})

// Override the SweetModal style computed property to allow it to resize to slider dimensions
Vue.use(SweetModal)
let computedOverride = {
	computed: {
		modal_style() {
			// TODO: Perhaps change this to modal.width in parent components
			let width = this.$parent.slideshow ? this.$parent.slideshow.width : '90%'
			let height = this.$parent.slideshow ? this.$parent.slideshow.height : '90%'
			return {
				'max-width': width,
				'max-height': height
			}
		}
	}
}
let defaultOptions = Vue.options.components['SweetModal'].options
Vue.options.components['SweetModal'].options = Vue.util.mergeOptions(defaultOptions, computedOverride)
