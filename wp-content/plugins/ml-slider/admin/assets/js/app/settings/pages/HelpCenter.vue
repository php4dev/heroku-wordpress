<template>
<div>
	<split-layout :loading="loading">
		<template slot="header">{{ __('Help Center', 'ml-slider') }}</template>
		<template slot="description">{{ __('Here you will find documentation, and two support tiers to choose from. Additionally, you may supply us with extra information specific to your website, server, etc.', 'ml-slider') }}</template>
		<template slot="fields">
            <textbox-with-link link="https://www.metaslider.com/documentation/" class="mb-4" :new-tab="true">
                <template slot="header">{{ __('Documentation 📚', 'ml-slider') }}</template>
                <template slot="description">{{ __('Check out our documentation page for examples, and more information about what you can do with MetaSlider.', 'ml-slider') }}</template>
                <template slot="link-text">{{ __('Visit documentation', 'ml-slider') }}</template>
            </textbox-with-link>
            <textbox-with-link link="https://wordpress.org/plugins/ml-slider" class="mb-4" :new-tab="true">
                <template slot="header">{{ __('Free Basic Support 🚀', 'ml-slider') }}</template>
                <template slot="description">{{ __('For users of the free version of MetaSlider, we offer full free support on the wordpress.org forums.', 'ml-slider') }}</template>
                <template slot="link-text">{{ __('Visit wordpress.org', 'ml-slider') }}</template>
            </textbox-with-link>
            <textbox-with-link link="https://wordpress.org/plugins/ml-slider" class="mb-4" :new-tab="true">
                <template slot="header">{{ __('Paid Premium Support 🌟', 'ml-slider') }}</template>
                <template slot="description">{{ __('Paid users of the premium plugin can open a ticket on our private support center to receive personalized support and faster response times.', 'ml-slider') }}</template>
                <template slot="link-text">{{ __('Visit metaslider.com', 'ml-slider') }}</template>
            </textbox-with-link>
			<data-box :data="{foo: 'bar'}" :can-copy="true" class="lg:mt-10 hidden">
				<template slot="header">{{ __('Site Information', 'ml-slider') }}</template>
				<template slot="description">
                    {{ __('For your convenience, you can copy the basic site information before to help us speed up the debugging process. Be sure to verify that no personal information is included that you might want to keep private.', 'ml-slider') }}
                </template>
				<template slot="data-extra">
					<div class="border-2 border-gray border-dashed h-64"></div>
				</template>
			</data-box>
		</template>
	</split-layout>
</div>
</template>

<script>
import { default as SplitLayout } from '../layouts/_split'
import { default as TextSingle } from '../inputs/_textSingle'
import { default as SwitchSingle } from '../inputs/_switchSingle'
import { default as TextBoxWithLink } from '../inputs/_textBoxWithLink'
import { default as Data } from '../components/data'
import { Settings } from '../../api'
export default {
	components: {
		'data-box' : Data,
		'split-layout' : SplitLayout,
        'text-single-input' : TextSingle,
        'textbox-with-link' : TextBoxWithLink,
		'switch-single-input' : SwitchSingle,
	},
	props: {},
	data() {
		return {
			loading: true,
			settings: {
				license: '',
				optIn: false,
			}
		}
	},
	computed: {
	},
	created() {
		// Settings.getDefaults().then(({data}) => {
		// 	Object.keys(data.data).forEach(key => {
		// 		if (this.settings.hasOwnProperty(key)) {
		// 			this.settings[key] = data.data[key]
		// 		}
		// 	})
		// 	this.loading = false
		// }).catch(error => {
		// 	this.notifyError('metaslider/settings-load-error', error.response, true)
		// })
	},
	mounted() {},
	methods: {
		saveSettings() {
			const settings = JSON.stringify(this.settings)
			Settings.saveDefaults(settings).then(({data}) => {
				this.notifyInfo(
					'metaslider/settings-page-setting-saved',
					this.__('All settings saved', 'ml-slider'),
					true
				)
			}).catch(error => {
				this.notifyError('metaslider/settings-save-error', error.response, true)
			})
		}
	}
}
</script>
