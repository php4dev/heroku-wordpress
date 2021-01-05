<template>
<div>
	<split-layout :loading="loading">
		<template slot="header">{{ __('Slideshow Defaults', 'ml-slider') }}</template>
		<template slot="description">{{ __('Update default settings used when creating a new slideshow.', 'ml-slider') }}</template>
		<template slot="fields">
			<text-single-input v-model="slideshowDefaults.title" name="default-slideshow-title" @click="saveSlideshowDefaultSettings()">
				<template slot="header">{{ __('Default Slideshow Title', 'ml-slider') }}</template>
				<template slot="description"><span v-html="defaultTitleDescription"/></template>
				<template slot="input-label">
					{{ __('Change the default title', 'ml-slider') }}
				</template>
			</text-single-input>
			<text-single-input v-model="slideshowDefaults.width" name="default-slideshow-width" @click="saveSlideshowDefaultSettings()">
				<template slot="header">{{ __('Base Image Width', 'ml-slider') }}</template>
				<template slot="description">{{ __('Update the default width for the base image. This will be used for the slideshow dimensions and base image cropping.', 'ml-slider') }}</template>
				<template slot="input-label">
					{{ __('Change the default width', 'ml-slider') }}
				</template>
			</text-single-input>
			<text-single-input v-model="slideshowDefaults.height" name="default-slideshow-height" @click="saveSlideshowDefaultSettings()">
				<template slot="header">{{ __('Base Image Height', 'ml-slider') }}</template>
				<template slot="description">{{ __('Update the default height for the base image. This will be used for the base image cropping and slideshow dimaneions. If set to 100% width, the height will scale accordingly.', 'ml-slider') }}</template>
				<template slot="input-label">
					{{ __('Change the default width', 'ml-slider') }}
				</template>
			</text-single-input>
			<switch-single-input v-model="slideshowDefaults.fullWidth" @change="saveSlideshowDefaultSettings()">
				<template slot="header">{{ __('100% Width', 'ml-slider') }}</template>
				<template slot="description">{{ __('While the width and height defined above will be used for cropping (if enabled) and the base slideshow dimensions, you may also set the slideshow to stretch to its container.', 'ml-slider') }}</template>
			</switch-single-input>
		</template>
	</split-layout>
    <!-- Hey, for now this is hiden for pro users because we haven't integrated a license system yet! -->
    <split-layout :loading="loading" class="lg:mt-6">
		<template slot="header">{{ __('Global Settings', 'ml-slider') }}</template>
		<template slot="description">{{ __('Here you will find general account settings and options related to your account', 'ml-slider') }}</template>
		<template slot="fields">
			<text-single-input v-model="globalSettings.license" name="ms-license" class="hidden" @click="saveGlobalSettings()">
				<template slot="header">{{ __('License Key', 'ml-slider') }}</template>
				<template slot="description"><span v-html="licenseDescription"/></template>
				<template slot="input-label">
					{{ __('Update license key', 'ml-slider') }}
				</template>
			</text-single-input>
			<switch-single-input v-model="globalSettings.optIn" @change="saveGlobalSettings()">
				<template slot="header">{{ __('Help Improve MetaSlider', 'ml-slider') }}</template>
				<template slot="description">
                    <span v-html="optInDescription"/>
                    <small v-if="Object.prototype.hasOwnProperty.call(optinInfo, 'id')" class="italic">Activated by user id #{{ optinInfo.id }} ({{ optinInfo.email }}) on {{ new Date(optinInfo.time * 1000).toLocaleDateString() }}</small>
                </template>
			</switch-single-input>
		</template>
	</split-layout>
</div>
</template>

<script>
import { default as SplitLayout } from '../layouts/_split'
import { default as TextSingle } from '../inputs/_textSingle'
import { default as SwitchSingle } from '../inputs/_switchSingle'
import { Settings } from '../../api'
export default {
	components: {
		'split-layout' : SplitLayout,
		'text-single-input' : TextSingle,
		'switch-single-input' : SwitchSingle,
	},
	props: {},
	data() {
		return {
            loading: true,
            optinInfo: {},
			slideshowDefaults: {
				title: '',
				fullWidth: false,
				width: 0,
				height: 0,
            },
            globalSettings: {
				license: '',
				optIn: false,
			}
		}
	},
	computed: {
		defaultTitleDescription() {
			return this.sprintf(this.__('Change the default title that will be used when creating a new slideshow. Use %s and it will be replaced by the current slideshow ID.', 'ml-slider'), '<code class="bg-transparent p-0 font-bold">{id}</code>')
        },
        licenseDescription() {
			return this.sprintf(
                this.__('If you are a pro member, enter your license key here to receive updates. %s', 'ml-slider'),
                `<a target="_blank" href="${this.hoplink}">${this.__('Upgrade here', 'ml-slider')}</a>`
            )
		},
		optInDescription() {
			return this.sprintf(
                this.__('Opt-in to let MetaSlider responsibly collect information about how you use our plugin. This is disabled by default, but may have been enabled by via a notification. %s', 'ml-slider'),
                `<a target="_blank" href="${this.hoplink}">${this.__('View our detailed privacy policy', 'ml-slider')}</a>`
            )
		}
	},
	created() {
		Settings.getSlideshowDefaults().then(({data}) => {
			Object.keys(data.data).forEach(key => {
				if (this.slideshowDefaults.hasOwnProperty(key)) {
					this.slideshowDefaults[key] = data.data[key]
				}
			})
			this.loading = false
		}).catch(error => {
			this.notifyError('metaslider/settings-load-error', error.response, true)
		})
		Settings.getGlobalSettings().then(({data}) => {
			Object.keys(data.data).forEach(key => {
				if (this.globalSettings.hasOwnProperty(key)) {
					this.globalSettings[key] = data.data[key]
				}
			})
			this.loading = false
		}).catch(error => {
			this.notifyError('metaslider/settings-load-error', error.response, true)
        })
		Settings.get('optin_user_extras').then(({data}) => {
			this.optinInfo = data.data
		})
	},
	mounted() {},
	methods: {
		saveSlideshowDefaultSettings() {
			const settings = JSON.stringify(this.slideshowDefaults)
			Settings.saveSlideshowDefaults(settings).then(({data}) => {
				this.notifyInfo(
					'metaslider/settings-page-slideshow-settings-saved',
					this.__('Slideshow settings saved', 'ml-slider'),
					true
				)
			}).catch(error => {
				this.notifyError('metaslider/settings-save-error', error.response, true)
			})
		},
		async saveGlobalSettings() {
            this.optinInfo = {}
            if (this.globalSettings.optIn) {
                await Settings.saveGlobalSettingsSingle('optin_via', 'manual')
            }
			const settings = JSON.stringify(this.globalSettings)
			Settings.saveGlobalSettings(settings).then(({data}) => {
				this.notifyInfo(
					'metaslider/settings-page-global-settings-saved',
					this.__('Global settings saved', 'ml-slider'),
					true
				)
			}).catch(error => {
				this.notifyError('metaslider/settings-save-error', error.response, true)
			})
		}
	}
}
</script>
