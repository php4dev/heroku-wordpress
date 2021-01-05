/**
 * Import global things:
 */

import Vue from 'vue'
import { Slideshow, Toolbar } from './slideshows'
import { EventManager } from './utils'
import { Axios } from './api'
import store from './store'
import './components'

Vue.component('metaslider', Slideshow)
Vue.component('metaslider-toolbar', Toolbar)
const MetaSlider = new Vue({ store }).$mount('#metaslider-ui')


// these exports are available globaly through window.metaslider.app.{name}
if (!window.metaslider) {
	window.metaslider = {}
}
window.metaslider.app = { Vue, MetaSlider, Slideshow, EventManager, Axios, store }
