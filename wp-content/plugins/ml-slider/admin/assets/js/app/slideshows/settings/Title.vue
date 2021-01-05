<template>
<div class="mb-12">
	<div class="relative">
		<input
			@change="$store.commit('slideshows/updateTitle', $event.target.value)"
			@keydown.escape.prevent="bail($event)"
			@keyup="$store.commit('slideshows/updateTitle', $event.target.value)"
			@keydown.enter="$event.target.blur()"
			@blur="save()"
			:value="current.title"
			id="metaslider-current-title"
			data-lpignore="true"
			type="text"
			style="width:calc(100% + 1rem)!important;transition:background .3s ease,border-left .3s ease!important"
			class="-ml-4 h-16 pl-4 pr-12 text-2xl font-light rounded-none shadow-none bg-transparent border-0 border-l-4 border-transparent hover:border-gray-light hover:bg-white focus:bg-white focus:shadow-sm focus:border-gray-light rtl:border-l-0 rtl:border-r-0 rtl:ml-0 rtl:-mr-4 rtl:pl-12 rtl:pr-4"/>
        <svg
			class="pointer-events-none opacity-0 transition-all duration-300 ease-in absolute m-2 w-6 top-0 right-0 text-gray rtl:left-0 rtl:right-auto"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        </svg>
	</div>
	<transition name="pop-in-quick-top">
		<div
			v-if="currentSavedTitle.trim() !== current.title.trim()"
			class="absolute text-gray-dark -ml-4 mt-2 mb-0 text-xs"
            v-html="sprintf(__('Press %s to save or %s to cancel.', 'ml-slider'),
                sprintf('<code>%s</code>', _x('Enter', 'The ENTER key on a keyboard', 'ml-slider')),
                sprintf('<code>%s</code>', _x('Escape', 'The ESCAPE key on a keyboard', 'ml-slider'))
            )"/>
	</transition>
</div>
</template>

<script>
import { mapGetters } from 'vuex'
import { Axios, Slideshow, Settings } from '../../api'
export default {
	props: {},
	data() {
		return {
			currentSavedTitle: '',
		}
	},
	watch: {
		current: {
			immediate: true,
			handler: function(current) {
				this.currentSavedTitle = current.title
			}
		},
	},
	computed: {
		...mapGetters({
			current: 'slideshows/getCurrent'
		})
	},
	created() {},
	mounted() {},
	methods: {
		save() {
			if (this.currentSavedTitle.trim() === this.current.title.trim()) return
			Settings.saveSingleSlideshowSetting('title', this.current.title.trim()).then(() => {
				this.notifySuccess('metaslider/title-saved', this.__('Slideshow title updated'), true)
				this.currentSavedTitle = this.current.title
			})
		},
		bail(event) {
			this.$store.commit('slideshows/updateTitle', this.currentSavedTitle);
			this.$nextTick(() => {
				event.target.blur()
			})
		}
	}
}
</script>

<style lang="css">
#metaslider-current-title:hover ~ svg,
#metaslider-current-title:focus ~ svg {
	opacity: 1 !important;
}
</style>
