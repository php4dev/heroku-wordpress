<template>
	<div
		v-if="component"
		style="z-index:99999"
        role="dialog"
        aria-modal="true"
		class="fixed w-full h-full inset-0 bg-white-70 flex items-center justify-center p-8 md:p-16">
		<div
			:class="classes"
			class="relative bg-white shadow-xl mt-16 md:mt-0">
			<component :is="component"/>
			<button
                v-if="showX"
                aria-label="Close Modal"
				class="close-pin-btn absolute top-0 right-0 rtl:right-auto rtl:left-0 text-gray-dark -mr-3 rtl:mr-0 rtl:-ml-3 -mt-3 p-1.5 bg-white rounded-full w-8 h-8 flex items-center justify-center shadow cursor-pointer border border-gray-lighter"
				@click="close">
                <svg class="w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
			</button>
		</div>
	</div>
</template>

<script>
import { EventManager } from '../utils'
export default {
	data() {
		return {
			component: null,
			filename: '',
			classes: 'w-full max-h-screen',
            forceOpen: false,
            showX: true,
		}
	},
	computed: {},
	mounted() {
		EventManager.$on('metaslider/open-utility-modal', data => {
			if (false === 'render' in data) {
				this.notifyError('metaslider/utility-modal-opening-ui', this.__('Failed to open utility modal...', 'ml-slider'))
				return false
			}

			this.filename = 'filename' in data ? data.filename : 'Name not found'
			this.notifyInfo('metaslider/utility-modal-opening-ui', this.__('Opening utility modal...', 'ml-slider') + ' (' + this.filename + ')')
			this.component = data
			document.body.style.overflow = 'hidden'
		})
	},
	methods: {
		close() {
			if (this.forceOpen) {
				this.forceOpen()
				this.$nextTick(() => {
					this.forceOpen = false
				})
				return
			}
			this.notifyInfo('metaslider/utility-modal-closing-ui', this.__('Closing utility modal...', 'ml-slider') + ' (' + this.filename + ')')
			this.filename = ''
			this.component = null
			document.body.style.overflow = 'initial'
		}
	}
}
</script>
