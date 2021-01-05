
import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersistence from 'vuex-persist'
import createLogger from 'vuex/dist/logger'
import slideshows from './modules/slideshows'
// import settings from './modules/settings'
// import slides from './modules/slides'

// Keep in local storage
const vuexLocal = new VuexPersistence({
	key: 'metaslider-vuex-' + window.metaslider_api.site_id,
	reducer: state => ({
		slideshows: {
			all: state.slideshows.all
		}
	})
})

// Keeping this very simple for now
Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'
// const debug = false
export default new Vuex.Store({
	modules: {
		slideshows
	},
	strict: debug,
	plugins: debug ? [createLogger()] : [vuexLocal.plugin]
})
