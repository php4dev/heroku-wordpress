/**
 * Load all the components. needed for the app
 */

import Vue from 'vue'
import './globals'
import { ThemeViewer } from './themes'
import { Preview } from './previews'
import { SlideViewer, Slide, Caption, PreviewImport, DragDropImport, External } from './slides'
import { SettingsViewer, Title } from './slideshows/settings'
import { Shortcode, UtilityModal } from './extra'
import Switcher from './slideshows/nav/Switcher.vue'
import Drawer from './slideshows/nav/Drawer.vue'

import { SettingsPage } from './settings'

Vue.component('metaslider-settings-viewer', SettingsViewer)
Vue.component('metaslider-slide-viewer', SlideViewer)
Vue.component('metaslider-slide', Slide)
Vue.component('metaslider-caption', Caption)
Vue.component('metaslider-theme-viewer', ThemeViewer)
Vue.component('metaslider-preview', Preview)
Vue.component('metaslider-external', External)
Vue.component('metaslider-shortcode', Shortcode)
Vue.component('metaslider-utility-modal', UtilityModal)
Vue.component('metaslider-dragdrop-import', DragDropImport)
Vue.component('metaslider-switcher', Switcher)
Vue.component('metaslider-drawer', Drawer)
Vue.component('metaslider-title', Title)

Vue.component('metaslider-settings-page', SettingsPage)

// Loaded it this way because I couldn't get translations working
Vue.component('metaslider-import-module', PreviewImport)

// Let others load in custom components
if (window.metaslider.components) {
	Object.keys(window.metaslider.components).forEach(name => {
		Vue.component(name, window.metaslider.components[name])
	})
}

// Allow jQuery to control the creation and destruction of the external API component
window.jQuery(window).on('metaslider/initialize_external_api', (event, data) => {
	window.metaslider.externalVM = new Vue().$mount(data.selector)
})
window.jQuery(window).on('metaslider/destroy_external_api', event => {
	window.metaslider.externalVM && window.metaslider.externalVM.$destroy()
})

export default {}
