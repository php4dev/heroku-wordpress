import slide from '../../api/Slide'

// initial state
const state = {
	all: []
}

// getters
const getters = {}

// actions
const actions = {
	// getAllSlideshows({ commit }) {
	// 	slideshow.getSlideshows(slideshows => {
	// 		commit('allSlideshows', slideshows)
	// 	})
	// }
}

// mutations
const mutations = {
	// setProducts(state, products) {
	// 	state.all = products
	// },

	// decrementProductInventory(state, { id }) {
	// 	const product = state.all.find(product => product.id === id)
	// 	product.inventory--
	// }
}

export default {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}