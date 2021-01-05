<template>
<div class="relative w-full">
	<div
		ref="drawer-container"
		:style="{ 'max-height': drawerHeight }"
		class="w-full bg-gray-light transition-all duration-300 ease-in overflow-hidden border-b border-gray-lightest">
		<div
			v-if="isIE11 && expanded && totalSlideshows > 25"
			class="text-center p-2">
			{{ __('This feature is not fully supported in Internet Explorer 11 and you may experience slow search result times.', 'ml-slider') }}
			</div>
		<div
			v-if="expanded"
			class="relative bg-gray border-b border-gray py-2 text-base text-black text-white w-full">
			<div class="container px-6">
				<div class="lg:flex items-center justify-between -mx-2">
					<div class="flex lg:w-1/2 px-2 mb-2 lg:mb-0">
						<div class="mr-2 rtl:mr-0 rtl:ml-2">
							<select
								v-model="sortType"
								class="text-black bg-gray-lightest block focus:bg-white h-full leading-normal m-0 rounded shadow-none"
								@change="sort()">
								<option value="sortByTitle">{{ __('Sort by title', 'ml-slider') }}</option>
								<option value="">{{ __('Sort by modified date', 'ml-slider') }}</option>
							</select>
						</div>
						<div class="flex-grow relative">
							<input
								:placeholder="__('Filter slideshows\u200E', 'ml-slider')"
								v-model="searchTerm"
								data-lpignore="true"
								type="text"
								class="appearance-none text-black bg-gray-lightest block focus:bg-white h-full leading-normal m-0 placeholder-gray-darker rounded shadow-none transition-all duration-300 ease-in w-full"/>
							<div
								@click="searchTerm = ''"
								:class="{ invisible: !searchTerm.length }"
								class="absolute inset-y-0 right-0 rtl:right-auto rtl:left-0 pr-2 rtl:pl-2 rtl:pr-0 flex items-center text-gray-dark">
                                <svg class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
							</div>
						</div>
					</div>
					<div class="lg:w-1/2 px-2">
						<div class="flex items-center justify-between -mx-2">
							<p
								v-if="sorting"
								class="m-0 text-center">
                                <svg class="inline w-5 ms-spin text-gray-darker" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                {{ __('Searching...', 'ml-slider') }}
							</p>
							<p
								v-else
								class="m-0 p-2 text-center">{{ summaryText }}</p>
							<div class="p-2 flex">
								<!-- If they have local storage then the data is already there -->
								<div
									v-if="fetchingAllSlideshows"
									class="flex items-center">
									<svg
                                        class="w-4 ms-spin mr-1 rtl:mr-0 rtl:ml-1"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
									<p
										v-if="slideshows.length < totalSlideshows"
										class="m-0">{{ loadingSlideshowsText() }}</p>
									<p
										v-else
										class="m-0">{{ __('Updating...', 'ml-slider') }}</p>
								</div>
								<div v-else>
									<button
										v-if="slideshows.length < totalSlideshows"
										@click.prevent="fetchAllSlideshows()"
										:class="{ 'underline': !fetchingAllSlideshows }"
										class="bg-gray-lighter leading-none m-0 outline-none px-2 py-1 rounded shadow no-underline text-xs">
										{{ __('Load all', 'ml-slider') }}
									</button>
									<button
										v-else
										@click.prevent="clearCache(event)"
										class="bg-gray-lighter leading-none m-0 outline-none px-2 py-1 rounded-lg shadow no-underline text-xs">
										{{ __('Clear cache', 'ml-slider') }}
									</button>
								</div>
								<div
									v-if="!fetchingAllSlideshows"
									class="tipsy-tooltip-bottom inline-flex ml-1 rtl:ml-0 rtl:mr-1"
									:title="slideshows.length < totalSlideshows ?
										sprintf(__('Load remaining %s slideshows', 'ml-slider'), totalSlideshows - slideshows.length) :
										__('Press to clear the slideshow cache from your web browser', 'ml-slider')"
									:original-title="slideshows.length < totalSlideshows ?
										sprintf(__('Load remaining %s slideshows', 'ml-slider'), totalSlideshows - slideshows.length) :
										__('Press to clear the slideshow cache from your web browser', 'ml-slider')">
									<svg class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<template v-if="slideshowsFiltered.length || currentSlideshow">
            <div class="relative">
                <button
                    @click.prevent="toggleDrawer();searchTerm = ''"
                    :class="{ invisible: !expanded }"
                    class="absolute flex items-center mr-4 mt-5 right-0 rtl:left-0 rtl:ml-4 rtl:mr-0 rtl:right-auto top-0 text-gray-dark hover:text-black">
                    <svg class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <ul
                    class="flex -mx-2 overflow-auto"
                    :class="{
                        'flex-nowrap p-4': !expanded,
                        'flex-wrap justify-lcenter p-10': expanded
                    }"
                    style="-webkit-overflow-scrolling:touch;-ms-overflow-style:-ms-autohiding-scrollbar;"
                    role="navigation"
                    aria-label="Recent slideshows">
                    <li
                        :class="{
                            'md:w-1/2 lg:w-1/3 xl:w-1/4 3xl:w-1/5': expanded
                        }"
                        class="w-full px-4 my-2 max-w-md"
                        style="min-width:400px">
                        <span
                            :class="{ 'whitespace-normal': expanded }"
                            class="block -mx-2 rounded bg-white shadow">
                            <slideshow-meta :slideshow="currentSlideshow" :include-images="false"/>
                        </span>
                    </li>
                    <li
                        :key="slideshow.id"
                        :class="{
                            'md:w-1/2 lg:w-1/3 xl:w-1/4 3xl:w-1/5': expanded
                        }"
                        class="w-full px-4 my-2 max-w-md"
                        style="min-width:400px"
                        v-for="slideshow in slideshowsFiltered">
                        <span
                            :class="{ 'whitespace-normal': expanded }"
                            class="block -mx-2 rounded bg-white shadow">
                            <slideshow-meta :slideshow="slideshow" :include-images="false"/>
                        </span>
                    </li>
                    <li v-if="!expanded" style="min-width:4rem;"></li>
                </ul>
            </div>
		</template>
		<template v-else>
			<span class="flex items-center font-normal block container text-xl my-4 h-24">
				{{ searchTerm.length ? __('No slideshows found', 'ml-slider') : __('Loading slideshows...', 'ml-slider') }}
			</span>
		</template>
	</div>
	<div class="container mx-auto flex px-6">
		<button
			@click.prevent="toggleDrawer();searchTerm = ''"
			:class="{
				'bg-gray-light border-gray-light': opened,
				'bg-gray-lighter pt-1 border-transparent': !opened
			}"
			class="block relative transition-all duration-300 ease-in text-xs text-gray-dark px-4 -mt-px border border-t-0 hover:bg-gray-light focus:bg-gray-light rounded-b shadow-none outline-none"
			>
			<template v-if="!opened">
					{{ __('Browse slideshows', 'ml-slider') }}
			</template>
            <svg v-else class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
		</button>
		<button
			@click.prevent="expanded = !expanded;searchTerm = ''"
			v-if="opened && slideshowsFiltered.length > 4"
			:title=" expanded ? __('Collapse', 'ml-slider') : __('Press to expand', 'ml-slider')"
			class="block relative transition-all duration-300 ease-in text-xs text-gray-dark px-4 -mt-px border border-t-0 bg-gray-lighter hover:bg-gray-light rounded-b shadow-none outline-none border-gray-light tipsy-tooltip-bottom-toolbar"
			>
			<svg class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
		</button>
	</div>
</div>
</template>

<script>
import hotkeys from 'hotkeys-js';
import { EventManager, Helpers as _ } from '../../utils'
import FuzzySearch from 'fuzzy-search/dist/FuzzySearch';
import Settings from '../../api/Settings'
import SlideshowMeta from '../SlideshowMeta'
import { mapState, mapGetters } from 'vuex'
import slideshows from '../../store/modules/slideshows';
export default {
	components: {
		'slideshow-meta': SlideshowMeta
	},
	props: {
		open: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			opened: this.open,
			expanded: false,
			slideshowsFiltered: [],
			sortType: '',
			searchTerm: '',
			slideshowCountdown: 0,
			sorting: false
		}
	},
	watch: {
		slideshows: {
			immediate: true,
			handler: function(slideshows) {
				this.searcher = slideshows.length ? new FuzzySearch(slideshows, ['title'], { sort: false }) : null
				this.sort()
			}
		},
		searchTerm() {
			this.sorting = true
			_.debounce(() => { this.sort() }, 1500)()
		},
		opened() {
			// If we are closing the drawer, remove the expanded state
			if (!this.opened) {
				this.$refs['drawer-container'].style.maxHeight = '12rem'
				this.expanded = false
			}
			this.saveNavPosition()
		},
		expanded() {
			this.$refs['drawer-container'].style.maxHeight = 'none'
		},
		slideshowsFiltered() {
			this.slideshowCountdown = this.totalSlideshows - this.slideshowsFiltered.length
		}
	},
	computed: {
		drawerHeight() {
			return this.opened ? '12rem' : '0'
		},
		summaryText() {
			if (!this.slideshowsFiltered.length || !this.slideshows.length) return ''
			let count = this.slideshowsFiltered.length + 1 // Plus the current slideshow
			if (this.slideshows.length == this.totalSlideshows) {
				const message = count == 1 ?
					this.__('1 slideshow', 'ml-slider') :
					this.__('Viewing %s out of %s slideshows', 'ml-slider')
				return this.sprintf(message, count, this.totalSlideshows)
			}
			const message = count == 1 ?
				this.__('1 slideshow','ml-slider') :
				this.__('Viewing %s out of %s slideshows (%s loaded)', 'ml-slider')
			return this.sprintf(message, count, this.totalSlideshows, this.slideshows.length)
		},
		...mapState({
			slideshows: state => state.slideshows.all,
			fetchingAllSlideshows: state => state.slideshows.fetchingAll,
			totalSlideshows: state => state.slideshows.totalSlideshows
		}),
		...mapGetters({
			currentSlideshow: 'slideshows/getCurrent'
		})
	},
	created() {
		// Accept a prop to remeber the state
		this.opened = this.open

		// Let the draw be opened closed elsewhere if needed
		EventManager.$on('metaslider/open-drawer', () => {
			this.opened = true
		})
		EventManager.$on('metaslider/close-drawer', () => {
			this.opened = false
		})

		// Run the filter again if the title changes
		EventManager.$on('metaslider/title-saved', () => {
			this.sort()
		})
	},
	mounted() {
	},
	methods: {
		toggleDrawer() {
			this.opened = !this.opened
		},
		saveNavPosition: _.debounce(function() {
			// Let users save the state of the nav position
			Settings.saveUserSetting('metaslider_nav_drawer_opened', this.opened)

		}, 3000),
		sort() {
			// If there is a search term then use that first before sorting
			let s = this.searchTerm.trim().length ? this.searcher.search(this.searchTerm.replace(/\s/g,'')) : [...this.slideshows]

			// Remove current slideshow which is handled elsewhere
			if (this.currentSlideshow) {
				s = s.filter(slideshow => slideshow.id != this.currentSlideshow.id)
			}

			this.slideshowsFiltered = s.sort(this[this.sortType])
			this.sorting = false
		},
		sortByTitle(a, b) {
			let one = a.title.toUpperCase()
			let two = b.title.toUpperCase()
			if (one < two) return -1
			if (one > two) return 1
			return 0
		},
		clearCache() {
			window.localStorage.removeItem('metaslider-vuex-' + this.siteId)
			window.location.reload(true)
		},
		fetchAllSlideshows() {

			// Keep a counter for a slightly better UX experience
			this.slideshowCountdown = this.totalSlideshows - this.slideshowsFiltered.length
			const countdown = () => {
				this.slideshowCountdown = this.slideshowCountdown - 1

				// lag randomly
  				while(Math.random() > 0.0000001) {}
				if (this.slideshowCountdown > 0) requestAnimationFrame(countdown)
			}
			requestAnimationFrame(countdown)

			this.notifyInfo(
				'metaslider-loading-all-slideshows',
				this.sprintf(this.__('Indexing %s slideshows into local storage...', 'ml-slider'), this.totalSlideshows))

			this.$store.dispatch('slideshows/getAllSlideshows').then(() => {
				this.notifySuccess('metaslider/all-slideshows-loaded', this.__('All Slideshows loaded', 'ml-slider'), true)
			})
		},
		loadingSlideshowsText() {
			if (this.totalSlideshows < 200) return this.__('Fetching slideshows...', 'ml-slider')
			if (this.slideshowCountdown <= 0) return this.__('Finished', 'ml-slider')
			return sprintf(this.__('Indexing slideshows... %s remaining', 'ml-slider'), this.slideshowCountdown)
		},
	}
}
</script>
