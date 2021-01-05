<template>
    <div class="p-6 rounded-md">
        <div class="text-center">
            <h3 class="m-0 mb-3 text-lg leading-6 font-medium text-gray-darkest">
                Thanks for using MetaSlider
            </h3>
            <div class="mt-2">
                <p class="text-sm leading-5 text-gray-darker" v-html="modalText()" />
            </div>
        </div>
        <div class="mt-6 sm:grid sm:gap-3 sm:grid-flow-row-dense">
            <span class="flex w-full rounded-md shadow-sm sm:col-start-2">
                <button @click="opt('yes')" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-dark text-base leading-6 font-medium text-white shadow-sm hover:bg-blue focus:outline-none focus:border-blue focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    Agree and continue
                </button>
            </span>
            <span class="mt-3 flex w-full rounded-md sm:mt-0 sm:col-start-1">
                <button @click="opt('no')" type="button" class="inline-flex justify-center w-full rounded-md px-4 py-2 bg-white text-base leading-6 font-medium text-gray-dark hover:text-gray-darker focus:outline-none focus:border-blue-light focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                    No thanks
                </button>
            </span>
        </div>
    </div>
</template>

<script>
import { Settings } from '../api'
import { EventManager } from '../utils'
export default {
    filename: 'AnalyticsNotice',
    created() {
        this.$parent.classes = 'w-full max-w-lg rounded-lg'
        this.$parent.forceOpen = () => {
            this.opt('dismiss')
            this.$parent.forceOpen = false
        }
    },
    mounted() {
        this.notifyInfo('metaslider/add-slide-css-manager-notice-opened', this.__('Analytics notice opened', 'ml-slider'))
    },
    beforeDestroy() {
        this.notifyInfo('metaslider/add-slide-css-manager-notice-closed', this.__('Analytics notice closed', 'ml-slider'))
    },
    methods: {
        modalText() {
            return this.sprintf(this.__('We are currently building the next version of MetaSlider. Can you help us out by sharing non-sensitive diagnostic information? We\'d also like to send you infrequent emails with important security and feature updates. See our %s for more details.', 'ml-slider'), '<a target="_blank" class="underline" href="https://www.metaslider.com/privacy-policy">' + this.__('privacy policy', 'ml-slider') + '</a>', 'ml-slider')
        },
        async opt(type) {
            this.$parent.forceOpen = false
            this.$parent.close()
            await Settings.saveUserSetting('analytics_onboarding_status', type)
            if (type === 'yes') {
                await Settings.saveGlobalSettingsSingle('optin_via', 'modal')

                // A bit contrived but keeps the api from needing a patch endpoint
                Settings.getGlobalSettings().then(({data}) => {
                    const settings = data.data
                    settings.optIn = true
                    Settings.saveGlobalSettings(JSON.stringify({...settings}))
                })
            }
            EventManager.$emit('metaslider/start-tour')
        },
    }
}
</script>
