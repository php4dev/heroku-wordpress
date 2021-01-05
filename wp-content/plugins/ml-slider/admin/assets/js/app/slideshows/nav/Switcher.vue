<template>
<div class="relative w-full h-full py-4">
	<span>
		<input
			:placeholder="__('Search slideshows (Press ctrl + / to focus)\u200E', 'ml-slider')"
			@focus="focused = true;$event.target.select()"
			@blur="focused = false"
			v-model="searchTerm"
			data-lpignore="true"
			type="text"
			ref="switcher"
			id="ms-slideshow-switcher"
			class="h-full w-full border border-gray-light focus:bg-white focus:shadow bg-gray-lightest transition duration-300 ease-in shadow-none focus:outline-none border-transparent placeholder-gray-darker rounded m-0 px-8 block appearance-none leading-normal ds-input"
			/>
			<span
				@mouseover="maybeAboutToClick = true"
				@mouseout="maybeAboutToClick = false"
				:class="{ hidden: !maybeAboutToClick && !focused }"
				class="top-arrow absolute z-50 w-full mt-3 shadow-md"
				role="listbox">
				<div class="relative border border-gray-light bg-white rounded pb-2">
					<template v-if="!searching">
						<div class="flex justify-between items-center pb-2 m-4 mb-2 border-b border-gray-lighter">
							<h3 class="text-sm text-gray-dark font-hairline m-0">
								{{ summaryText }}
							</h3>
						</div>
						<ul
							v-if="slideshows.length"
							class="overflow-scroll overflow-x-hidden"
							ref="switcher-view-area"
							style="max-height:30vh"
							:style="'min-height:' + minHeight + 'px'"
							role="navigation"
							aria-label="Slideshow search">
							<li
								@mouseover="selectedSlideshow = key"
								:key="slideshow.id"
								:ref="'switch-item-' + slideshow.id"
								:class="{ 'bg-blue-highlight highlighted-slideshow-nav': highlighted === slideshow.id }"
								class="m-0"
								v-for="(slideshow, key) in slideshows">
								<slideshow-meta :slideshow="slideshow"/>
							</li>
						</ul>
						<div v-else
							class="py-2 px-4">{{ __('No slideshows found', 'ml-slider') }}</div>
					</template>
					<template v-else>
						<span class="block text-sm font-hairline m-4 mb-2">
							{{ __('Searching slideshows...', 'ml-slider') }}
						</span>
					</template>
				</div>
			</span>
	</span>
	<div
		@click="focusInput()"
		:class="{ 'pointer-events-none': focused }"
		class="absolute inset-y-0 left-0 pl-3 rtl:left-auto rtl:right-0 rtl:pr-3 rtl:pl-0 flex items-center text-gray-dark">
        <svg v-if="!searching" class="mt-px w-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg v-else class="mt-px w-4 ms-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
	</div>
	<div
		@click="resetInput()"
		:class="{ invisible: !searchTerm.length }"
		class="absolute inset-y-0 right-0 rtl:right-auto rtl:left-0 pr-3 rtl:pl-3 rtl:pr-0 flex items-center text-gray-dark">
        <svg class="w-4 mt-px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
	</div>
</div>
</template>

<script>
import hotkeys from 'hotkeys-js';
import SlideshowMeta from '../SlideshowMeta'
import Slideshow from '../../api/Slideshow'
import { mapState } from 'vuex'
import { EventManager, Helpers as _ } from '../../utils'
export default {
	components: {
		'slideshow-meta': SlideshowMeta
	},
	props: {
		max: {
			type: Number|String,
			default: 25
		}
	},
	data() {
		return {
			focused: false,
			selectedSlideshow: -1,
			maybeAboutToClick: false,
			searchTerm: '',
			searching: true,
			slideshows: {},
		}
	},
	watch: {
		focused() {
			// Reset when the user leaves
			if (!this.focused && this.slideshows.length && !this.maybeAboutToClick) {
				this.resetSelectedPosition()
			}
		},
		searchTerm() {
			this.searching = true
			this.slideshows = {}
			this.resetSelectedPosition()
			this.search()
		}
	},
	computed: {
		summaryText() {
			if (!this.slideshows.length) return ''
			const message = this.slideshows.length == 1 ?
					this.__('Viewing 1 slideshow', 'ml-slider') :
					this.__('Viewing %s out of %s slideshows', 'ml-slider')
			return this.sprintf(message, this.slideshows.length, this.totalSlideshows)
		},
		highlighted() {
			if (!this.slideshows.length) return null
			return this.selectedSlideshow > -1 ? this.slideshows[this.selectedSlideshow].id : null
		},
		minHeight() {
			// Because height is vh, the min-height should be 300px unless they only have a few slideshows
			return this.slideshows.length > 4 ? 300 : this.slideshows.length * 50
		},
		...mapState({
			totalSlideshows: state => state.slideshows.totalSlideshows
		})
	},
	created() {
		// Run the filter again if the title changes
		EventManager.$on('metaslider/title-saved', () => {
			this.search()
		})
	},
	mounted() {
		hotkeys('ctrl+/', () => this.focusInput())
		hotkeys('escape', () => this.blurInput())
		hotkeys('enter', () => this.loadSlideshow())
		hotkeys('up,down', (e, h) => this.navigateSlideshows(e, h))
		hotkeys.filter = event => {
			return true // Allow keybinding on inputs
		}

		this.search()
	},
	methods: {
		// TODO: possibly delay the mouseover/out events by 200ms or add a slight transition
		focusInput() {
			this.$refs.switcher.focus()
		},
		blurInput() {
			this.maybeAboutToClick = false
			this.focused && this.$refs.switcher.blur()
		},
		resetInput() {
			this.focusInput()
			this.searchTerm = ''
		},
		loadSlideshow() {
			if (!this.focused) return
			if (this.selectedSlideshow < 0) return
			if (!this.slideshows.length) return

			event.preventDefault()

			window.location.replace(this.metasliderPage + '&id=' + this.slideshows[this.selectedSlideshow].id)
		},
		navigateSlideshows(event, handler) {
			if (!this.focused) return

			// Prevent the native behavior (page scroll down)
			event.preventDefault()

			switch(handler.key) {
				case 'down':
					// If the selected slideshow is in the final position, leave it there
					if ((this.selectedSlideshow + 1) < this.slideshows.length) {
						this.selectedSlideshow++
						this.bringSelectedItemIntoFocus()
					}
					break
				case 'up':
					// If the selected slideshow is not in the 0 position, move it up
					if (this.selectedSlideshow > 0) {
						this.selectedSlideshow--
						this.bringSelectedItemIntoFocus()
					}
					break
			}
		},
		bringSelectedItemIntoFocus() {
			if (this.$refs['switcher-view-area']) {
				this.$refs['switcher-view-area'].children[this.selectedSlideshow].scrollIntoView({
					block: "nearest"
				})
			}
		},
		resetSelectedPosition() {
			// Select the first in the list then scroll to it
			this.selectedSlideshow = 0
			this.bringSelectedItemIntoFocus()

			// Remove the selected
			this.selectedSlideshow = -1
		},
		search:_.debounce(function() {
			this.searching = true
			Slideshow.search(this.searchTerm, this.max).then(response => {
				this.slideshows = response.data.data
			}).catch(error => {
				this.notifyError('metaslider/search-error', error, true)
			}).finally(() => {
				this.searching = false
			})
		}, 500)
	}
}
</script>

<style>
.top-arrow::before {
	left: 15px !important;
	display: block !important;
    position: absolute !important;
    content: "" !important;
    width: 14px !important;
    height: 14px !important;
    background: #fff !important;
    z-index: 1000 !important;
    top: -7px !important;
    border-top: 1px solid #dae1e7 !important;
    border-right: 1px solid #dae1e7 !important;
    transform: rotate(-45deg) !important;
	border-radius: 2px !important;
}
[dir='rtl'] .top-arrow::before {
	left: auto !important;
	right: 15px !important;
}
</style>
