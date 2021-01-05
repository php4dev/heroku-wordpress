<template>

	<!-- This component will work similar to the featured image component -->
	<section
		v-if="current.id"
		:class="{'unsupported': unsupportedSliderType}"
		class="ms-postbox theme-select-module">
		<h3 class="hndle">
			{{ __('Slideshow Theme', 'ml-slider') }}<template v-if="hasThemeSet">: <span>{{ current.theme.title }}</span></template>
		</h3>
		<div
			:class="{'ms-modal-open': is_open}"
			class="inside wp-clearfix metaslider-theme-viewer">

			<!-- If the theme is not supported we should show an error -->
			<p
				v-if="(hasThemeSet && unsupportedSliderType)"
				class="slider-not-supported-warning">
                <svg class="inline w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
				{{ __('This theme is not officially supported by the slider you chose. Your results might vary.', 'ml-slider') }}
			</p>

			<!-- If there's a theme already set -->
			<div
				v-if="hasThemeSet"
				class="ms-current-theme">
				<button
					style="width:100%;text-decoration:none"
					type="button"
					class="button-link change-theme-img-button"
					@click="openModal">
					<div
						v-if="'custom' == current.theme.type"
						class="custom-theme-single">
						<span class="custom-subtitle">
							{{ __('Custom theme', 'ml-slider') }}
						</span>
						{{ current.theme.title }}
					</div>
					<div v-else>
						<img
							v-if="current.theme.screenshot_dir"
							:src="current.theme.screenshot_dir + '/screenshot.png'"
							:alt="current.theme.title">
						<img
							v-else
							:src="themeDirectoryUrl + current.theme.folder + '/screenshot.png'"
							:alt="current.theme.title">
					</div>
				</button>
				<p class="button-info">{{ __('Click the image to edit or update', 'ml-slider') }}</p>
				<button
					type="button"
					class="button-link remove-theme"
					@click="removeTheme">{{ __('Remove theme', 'ml-slider') }}
				</button>
			</div>

			<!-- If no theme then we render the theme select button -->
			<div v-else>
				<p>
					{{ __('Change the look and feel of your slideshow with one of our custom-built MetaSlider themes!', 'ml-slider') }}
				</p>
				<button
					v-if="Object.keys(themes).length || Object.keys(customThemes).length"
					type="button"
					class="button-link"
					@click="openModal">{{ __('Select a custom theme', 'ml-slider') }}
				</button>
			</div>

			<!-- This will be a modal for showing the themes -->
			<sweet-modal
				ref="themesModal"
				:hide-close-button="true"
				:blocking="true"
				:pulse-on-block="false"
				overlay-theme="dark"
				@close="is_open = false">
				<button
					slot="box-action"
					@click.prevent="$refs.themesModal.close()">
                    <svg class="w-6 -mt-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
				</button>
				<sweet-modal-tab
					id="free"
					:title="__('Themes', 'ml-slider')">
					<template v-if="themes && Object.keys(themes).length">
						<div class="columns">
							<div class="theme-list-column">
								<ul class="ms-image-selector regular-themes">
									<li
										v-for="theme in themes"
										:key="theme.folder"
										:class="{ 'a-theme': true, selected: (selectedTheme.folder == theme.folder) }"
										role="checkbox"
										@mouseover="hoveredTheme = theme"
										@mouseout="hoveredTheme = selectedTheme"
										@click="selectTheme(theme)">
										<span>
											<img
												v-if="theme.screenshot_dir"
												:src="theme.screenshot_dir + '/screenshot.png'"
												:alt="theme.title">
											<img
												v-else
												:src="themeDirectoryUrl + theme.folder + '/screenshot.png'"
												:alt="theme.title">
										</span>
									</li>
								</ul>
							</div>
							<div class="theme-details-column">
								<template v-if="showThemeDetails && hoveredTheme.type !== 'custom'">
									<div>
										<h1
											slot="button"
											class="metaslider-theme-title"
											v-text="hoveredTheme.title"/>
										<template v-if="hoveredTheme.description">
											<div class="ms-theme-description">
												<h2>{{ __('Theme Details', 'ml-slider') }}</h2>
												<p v-html="hoveredTheme.description"/>
											</div>
										</template>
										<template v-if="hoveredTheme.instructions">
											<div class="ms-theme-instructions">
												<h2>{{ __('Theme Instructions', 'ml-slider') }}</h2>
												<p v-html="hoveredTheme.instructions"/>
											</div>
										</template>
									</div>
									<div v-if="hoveredTheme && hoveredTheme.tags && hoveredTheme.tags.length">
										<h3>{{ __('Tags', 'ml-slider') }}</h3>
										<ul class="ms-theme-tags">
											<li
												v-for="(tag, i) in hoveredTheme.tags"
												:key="i"
												v-text="tag"/>
										</ul>
									</div>
								</template>
								<template v-else>
									<div>
										<h1 class="metaslider-theme-title">{{ __('How To Use', 'ml-slider') }}</h1>
										<p>{{ __('Select a theme on the left to use on this slideshow. Click the theme for more details.', 'ml-slider') }}</p>
										<p>{{ __('If no theme is selected we will use the default theme provided by the slider plugin', 'ml-slider') }}</p>
									</div>
								</template>
							</div>
						</div>
					</template>
					<template v-else>
						<div v-if="loading">
                            {{ __('Loading...', 'ml-slider') }}
						</div>
						<div
							v-else
							class="free-themes-not-found">
							<h1>{{ __('Error: No themes were found.', 'ml-slider') }}</h1>
							<p v-if="Object.keys(customThemes).length">{{ __('However, it looks like you have custom themes available. Select "My Custom Themes" from the navigation up top to view your custom themes.', 'ml-slider') }}</p>
						</div>
					</template>
				</sweet-modal-tab>
				<sweet-modal-tab
					id="custom-themes"
					:title="__('My Custom Themes', 'ml-slider')">
					<template v-if="!proUser">
						<h1>{{ __('Get the add-on pack!', 'ml-slider') }}</h1>
						<p>
							{{ __('Upgrade now to build your own custom themes!', 'ml-slider') }}
							<a :href="hoplink">{{ __('Learn more', 'ml-slider') }}</a>
						</p>
					</template>
					<div v-if="loadingCustom">
                        {{ __('Loading...', 'ml-slider') }}
					</div>
					<template v-if="!Object.keys(customThemes).length && proUser && !loadingCustom">
						<h1>{{ __('The pro add-on pack is installed!', 'ml-slider') }}</h1>
						<p>
							{{ __('You can create your own themes with our theme editor', 'ml-slider') }}
							<a :href="themeEditorLink">{{ __('Get started', 'ml-slider') }}</a>
						</p>
					</template>
					<div
						v-if="Object.keys(customThemes).length && proUser"
						class="columns">
						<div class="theme-list-column">
							<ul class="ms-image-selector custom-themes">
								<li
									v-for="theme in customThemes"
									:key="theme.folder"
									:class="{ 'a-theme': true, selected: (selectedTheme.folder == theme.folder) }"
									role="checkbox"
									@click="selectTheme(theme)">
									<span><div class="custom-theme-single">
										{{ theme.title }}
									</div></span>
								</li>
							</ul>
						</div>
						<div class="theme-details-column">
							<div>
								<h1 class="metaslider-theme-title">{{ __('How To Use', 'ml-slider') }}</h1>
								<p>{{ __('On the left are themes that you have created in the theme editor.', 'ml-slider') }}</p>
								<p>{{ __('If no theme is selected we will use the default theme provided by the slider plugin', 'ml-slider') }}</p>
							</div>
						</div>
					</div>
				</sweet-modal-tab>
				<template
					slot="button">
					<div>
						<span
							v-if="sliderTypeNotSupported"
							class="slider-not-supported-warning">
                            <svg class="inline w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
							{{ __('This theme is not officially supported by the slider you chose. Your results might vary.', 'ml-slider') }}</span>
					</div>
					<div class="flex items-center">
						<button
							:title="__('Preview slideshow', 'ml-slider')"
							class="flex items-center m-0 mr-1 text-gray-darker"
							@click.prevent="openPreview">
                            <svg class="w-6 inline mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            {{ __('Preview', 'ml-slider') }}
						</button>
						<button
							:disabled="!selectedTheme.folder"
							class="button button-primary"
							@click.stop.prevent="setTheme">{{ __('Select', 'ml-slider') }}
						</button>
					</div>
				</template>
			</sweet-modal>
		</div>
	</section>
</template>

<script>
import { EventManager } from '../utils'
import { Axios } from '../api'
import './components'
import { mapGetters } from 'vuex'
import QS from 'qs'

export default {
	props: {
		themeDirectoryUrl: {
			type: [String],
			default: ''
		}
	},
	data() {
		return {
			loading: true,
			loadingCustom: true,
			unsupportedSliderType: false,
			themes: {},
			customThemes: {},
			selectedTheme: {},
			hoveredTheme: {},
			is_open: false
		}
	},
	watch: {
		currentThemeSupports() {
			// TODO: Settings - once reactive, refactor this
			this.updateSupportedStatus()
		},
		current: {
			immediate: true,
			handler: function(current) {
				// hoveredTheme controls what shows in the sidebar
				if (!this.current || !this.current.theme || 'none' === this.current.theme) {
					this.selectedTheme = this.hoveredTheme = this.themeStub()
					return
				}
				this.selectedTheme = this.current.theme
				this.hoveredTheme = this.current.theme
			}
		}
	},
	computed: {
		showThemeDetails() {
			return this.hoveredTheme.description || (this.selectedTheme.description && !this.isCustomTheme)
		},
		isCustomTheme() {
			if (!this.selectedTheme) return false
			return this.selectedTheme && this.selectedTheme.folder ? this.selectedTheme.folder.startsWith('_theme') : false
		},
		sliderTypeNotSupported() {
			if (!this.hovererdTheme || !this.hoveredTheme.tags) {
				return false
			}

			// TODO: Settings - once reactive, refactor this
			let currentType = document.querySelector('input[name="settings[type]"]:checked')
			if (!currentType) return false
			return parseInt(this.hoveredTheme.supports.indexOf(currentType.value), 10) === -1
		},
		supportLink() {
			return this.proUser ? 'https://www.metaslider.com/support/' : 'https://wordpress.org/support/plugin/ml-slider'
		},
		currentThemeSupports() {
			if (!this.current.id) return undefined
			return this.current.theme ? this.current.theme.supports : undefined
		},
		hasThemeSet() {
			if (!this.current.id || !this.current.hasOwnProperty('theme')) return false
			return this.current.theme.hasOwnProperty('folder') && this.current.theme.folder.length
		},
		...mapGetters({
			current: 'slideshows/getCurrent'
		})
	},
	created() {},
	mounted() {
		this.fetchThemes()

		// TODO: when converting settings to vue, this could be removed
		document.querySelectorAll('input[name="settings[type]"]').forEach(sliderType => {
			sliderType.addEventListener('click', event => {

				// TODO: Settings - once reactive, refactor this
				this.updateSupportedStatus()

				// hack to work with non-vue (refreshes computed properties)
				this.hoveredTheme = {}
				this.hoveredTheme = this.selectedTheme || this.current.theme
			})
		})

		this.updateSupportedStatus()
	},
	methods: {
		fetchThemes() {

			// Pre-built themes
			Axios.get('themes/all', {
				params: {
					action: 'ms_get_all_free_themes'
				}
			}).then(response => {
				this.themes = response.data.data
				this.loading = false
			}).catch(error => {
				this.loading = false
				this.notifyError('metaslider/theme-error', error, true)
			})

            // Custom themes
            this.loadingCustom = this.proUser
			this.proUser && Axios.get('themes/custom', {
				params: {
					action: 'ms_get_custom_themes'
				}
			}).then(response => {
				this.customThemes = (typeof response.data.data === 'object') ? response.data.data : {}
				this.loadingCustom = false
			}).catch(error => {
				this.loadingCustom = false
				this.notifyError('metaslider/theme-error', error, true)
			})
		},
		selectTheme(theme) {
			this.selectedTheme = (this.selectedTheme === theme) ? {} : theme
		},
		removeTheme() {
			this.selectedTheme = {}
			this.setTheme()
		},
		setTheme() {
			this.notifyInfo('metaslider/theme-updating', this.__('Saving theme...', 'ml-slider'))
			this.$refs.themesModal.close()

			// If the selected theme is set and already the current theme, do nothing
			if (Object.keys(this.selectedTheme).length && Object.is(this.selectedTheme.folder, this.current.theme.folder)) {
				this.notifySuccess('metaslider/theme-updated', this.__('Theme saved', 'ml-slider'), true)
			} else {
				this.$store.commit('slideshows/updateTheme', this.selectedTheme)

				Axios.post('themes/set', QS.stringify({
					action: 'ms_set_theme',
					slideshow_id: this.current.id,
					theme: this.selectedTheme
				})).then(response => {
					this.notifySuccess('metaslider/theme-updated', this.__('Theme saved', 'ml-slider'), true)
				}).catch(error => {
					this.notifyError('metaslider/theme-error', error, true)
				})
			}
		},
		openModal() {
			// TODO: when converting settings to vue, this could be removed.
			// It's used to force re-render of the UI
			this.hoveredTheme = this.selectedTheme || this.current.theme

			// If a current theme is selected, show that tab
			let tab = this.isCustomTheme ? 'custom-themes' : 'free'
			this.is_open = true
			this.$refs.themesModal.open(tab)
		},
		openPreview() {
			EventManager.$emit('metaslider/preview', {
				slideshowId: this.current.id,
				themeId: this.selectedTheme ? this.selectedTheme.folder : ''
			})
		},
		updateSupportedStatus() {
			if (!this.current.id || 'undefined' === typeof this.currentThemeSupports) return true
			let currentType = document.querySelector('input[name="settings[type]"]:checked')
			this.unsupportedSliderType = this.currentThemeSupports ? this.currentThemeSupports.indexOf(currentType.value) === -1 : false
		},
		themeStub() {
			return {
				description: null,
				folder: null,
				images: [],
				supports: [],
				tags: [],
				title: null,
				type: null
			}
		}
	}
}
</script>

<style lang="scss">
	@import '../assets/styles/globals.scss';
	@import '../assets/styles/mixins.scss';

	#metaslider-ui .metaslider-theme-viewer {
		p {
			margin-top: 0;
			color: #444;
		}
	}
	#metaslider-ui .metaslider-theme-viewer > .sweet-modal-overlay > .sweet-modal {
		position: absolute;
		display: flex;
		flex-direction: column;
		width: 100%;
		height: 100%;
		max-width: 90%;
		max-height: 90%;
		left: 5%;
		top: 5%;
		right: 0;
		bottom: 0;
		overflow: visible;
		> .sweet-buttons {
			display: flex;
			align-items: center;
			justify-content: space-between;
			button {
				margin-left: 0.5rem;
			}
			.metaslider-theme-title {
				font-size: 1.3em;
				margin-top: 0.3em;
			}
		}
	}
	#metaslider-ui .sweet-modal .columns {
		display: flex;
		flex-direction: row;
		.theme-list-column {
			width: 75%;
			position: absolute;
			left: 0;
			top: 0;
			bottom: 0;
			right: 0;
			overflow: auto;
		}
		.theme-details-column {
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			width: 25%;
			background: #f3f3f3;
			border-left: 1px solid #dddddd;
			position: absolute;
			bottom: 0;
			top: 0;
			right: 0;
			height: 100%;
			text-align: left;
			padding: 0 1rem 1rem;
			color: #666;
			[dir='rtl'] & {
				right: auto;
    			left: 0;
			}
			.metaslider-theme-title {
				background-color: #e8e8e8;
				color: #4a4a4a;
				font-size: 1.5em;
				font-weight: 500;
				margin: -1.5rem -1rem 1.5rem;
				padding: 0.5rem 1rem 0.4rem;
			}
			h2, h3 {
				margin: 0;
				margin-top: 1.5rem;
				margin-bottom: .6em;
				color: #666;
				padding: 0;
				font-weight: 600;
				text-transform: uppercase;
				font-size: 1em;
			}
			h2:first-of-type {
				margin-top: 0;
			}
			h3 {
				font-size: 0.9em;
				text-transform: none;
			}
			p {
				line-height: 1.4;
				font-size: 0.9em;
			}
			.ms-theme-description {
				margin-bottom: 2rem;
			}
			ul.ms-theme-tags {
				margin: 0;
				li {
					border-radius: 0.2em;
					display: inline-block;
					margin-right: 0.4em;
					line-height: 1;
					white-space: nowrap;
					font-size: 13px;
					line-height: 1;
					margin-right: 0.4em;
					white-space: nowrap;
					background: lightgray;
					padding: 5px;
					color: #555;
					// border-bottom: 1px solid #b4b6b7;
					// &:hover {
					// 	border-bottom: 1px solid #747b7d;
					// }
				}
			}
		}
	}
	#metaslider-ui .free-themes-not-found {
		max-width: 455px;
		h1 {
			color: $brand;
		}
	}
	#metaslider-ui .ms-image-selector {
		display: flex;
		flex-wrap: wrap;
		margin: 0;
		padding: 0.5rem;
		li {
			background: #fafafa;
			cursor: pointer;
			margin: 0;
			padding: 2px;
			width: 33.3%;
			@include from(1850px) {
				width: 25%;
			}
			@include until(1100px) {
				width: 50%;
			}
			@include until(900px) {
				width: 100%;
			}
			img {
				max-width: 100%;
				display: block;
				width: 100%;
			}
			span {
				border: 4px solid #fafafa;
				height: 100%;
				display: block;
				padding: 2px;
			}
			&:hover span {
				border-color: #ccc;
			}
			&.selected span {
				border-color: $blue-dark;
			}
		}
	}
	#metaslider-ui .ms-image-selector li.ms-theme-more {
		cursor: default;
		span {
			font-size: 1.5em;
			text-transform: uppercase;
			line-height: 1.3;
			background: #efefef;
			border-color: #FFFFFF !important;
			height: 100%;
			> div {
				padding: 2rem;
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: space-around;
				height: 100%;
				border: 4px solid #eaeaea;
			}
			small {
				font-size: 15px;
				text-transform: initial;
			}
		}
	}

	// Styles for the smaller box
	#metaslider-ui .theme-select-module {
		min-height: 70px;
		.button-info {
			margin-top: 0;
		}
	}
	#metaslider-ui .metaslider-theme-viewer {
		z-index: 3;
		position: relative;
		&.ms-modal-open {
			z-index: 999999;
		}
	}
	#metaslider-ui .theme-select-module .hndle {
		padding-bottom: 0;
	}
	#metaslider-ui .theme-select-module .hndle span {
		color: $brand;
	}
	#metaslider-ui .theme-select-module .slider-not-supported-warning {
		margin-bottom: 1em;
		svg {
			color: $red !important;
		}
	}
	#metaslider-ui .theme-select-module .sweet-buttons .slider-not-supported-warning {
		margin-bottom: 0;
	}
	#metaslider-ui .theme-select-module .change-theme-img-button {
		img {
			display: block;
			max-width: 100%;
			width: 100%;
		}
	}
	#metaslider-ui .ms-current-theme .custom-theme-single {
		min-height: 0;
		height: 177px;
	}
	#metaslider-ui .ms-current-theme .custom-theme-single .custom-subtitle {
		font-size: 12px;
		font-weight: 300;
		text-transform: uppercase;
		color: darken(white, 15%);
		margin-bottom: 0.1em;
	}
	#metaslider-ui .custom-theme-single {
		width: 100%;
		min-height: 200px;
		height: 10vw;
		line-height: normal;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		font-size: 24px;
		font-weight: 600;
		background-color: #999999;
		color: white;
		padding: 1rem;
		box-sizing: border-box;
	}
	@include until(700px) {
		#metaslider-ui .sweet-modal {
			.sweet-content {
				display: block;
			}
			.columns {
				flex-direction: column;
				& > div {
					position: static!important;
					width: 100% !important;
				}
			}
		}
	}
	// Fade the custom theme backgrounds for variety
	// $step:1;
	// $color: $brand;
	// @while $step <=5  {
	// 	#metaslider-ui .custom-themes li:nth-child(10n+#{$step}) > div {
	// 		background: linear-gradient($color, darken($color, (5%)));
	// 	}
	// 	$color: darken($color, (5%));
	// 	$step: $step + 1;
	// }
	// $step:6;
	// @while $step <=10  {
	// 	#metaslider-ui .custom-themes li:nth-child(10n+#{$step}) > div {
	// 		background: linear-gradient($color, lighten($color, (5%)));
	// 	}
	// 	$color: lighten($color, (5%));
	// 	$step: $step + 1;
	// }
</style>
