import slideshow from '../../api/Slideshow'

// initial state
const state = {
	all: [],
	locked: false,
	remainingPages: 1,
	totalSlideshows: 0,
	fetchingAll: false,
	currentId: null
}

const slideshowStub = () => {
	return {
		title: '',
		theme: '',
		id: '',
		settings: {},
		slides: {}
	}
}

// getters
const getters = {
	getCurrent: (state, getters) => {
		if (!state.all.length) return slideshowStub()
		const current = state.all.find(slideshow => (slideshow.id === state.currentId))
		if (!current) return slideshowStub()
		return current
	},
}

// actions
const actions = {
	getSingleSlideshow({ commit }, id) {
		slideshow.single(id).then(({ data }) => {
			commit('addSlideshows', data.data)
		}).catch(error => {
			window.metaslider.app.MetaSlider.notifyError('metaslider/fetching-single-slideshows-error', error, true)
		})
	},
	getRecentSlideshows({ commit }) {
		const page = 1
		slideshow.all(page).then(({ data }) => {

			if (data.data.hasOwnProperty('remaining_pages')) {
				commit('updateRemainingPagesCount', data.data.remaining_pages)
				delete data.data.remaining_pages
				delete data.data.page
			}
			if (data.data.hasOwnProperty('totalSlideshows')) {
				commit('setTotalSlideshows', data.data.totalSlideshows)
				delete data.data.totalSlideshows
			}

			commit('addSlideshows', data.data)

		}).catch(error => {
			window.metaslider.app.MetaSlider.notifyError('metaslider/fetching-recent-slideshows-error', error, true)
		})
	},
	getAllSlideshows({ commit }) {
		const page = 1
		return fetchAllSlideshows(page, commit).catch(error => {
			window.metaslider.app.MetaSlider.notifyError('metaslider/fetching-all-slideshows-error', error, true)
		})
	}
}

const fetchAllSlideshows = (page, commit) => {
	commit('setFetchingAll', true)
	return new Promise((resolve) => {
		slideshow.all(page, 200).then(({ data }) => {
			let nextPage = false

			// If there are remaining pages we need to send another request with the next page
			if (data.data.hasOwnProperty('remaining_pages')) {
				nextPage = data.data.page + 1
				commit('updateRemainingPagesCount', data.data.remaining_pages)
				delete data.data.remaining_pages
				delete data.data.page
			} else {
				commit('updateRemainingPagesCount', 0)
			}

			if (data.data.hasOwnProperty('totalSlideshows')) {
				commit('setTotalSlideshows', data.data.totalSlideshows)
				delete data.data.totalSlideshows
			}

			commit('addSlideshows', data.data)

			// Only make a request every 2 seconds to cut down on processing load
			setTimeout(() => {
				!nextPage && commit('setFetchingAll', false)
				resolve(nextPage ? fetchAllSlideshows(nextPage, commit) : data)
			}, 2000);
		})
	})
}

// mutations
const mutations = {
	setCurrent(state, id) {
		state.currentId = id
	},
	setTotalSlideshows(state, count) {
		state.totalSlideshows = count
	},
	updateRemainingPagesCount(state, count) {
		state.remainingPages = count
	},
	addSlideshows(state, slideshows) {
		slideshows && Object.keys(slideshows).forEach(key => {

			// Check if the slideshow already exists in the store
			const index = state.all.findIndex(slideshow => (slideshow.id === slideshows[key].id))
			if (index > -1) {
				
				// If the two objects are not identical, replace with the new one
				if (JSON.stringify(state.all[index]) !== JSON.stringify(slideshows[key])) {
					Object.assign(state.all[index], slideshows[key])
					console.log('MetaSlider:', 'Updated slideshow id #' + slideshows[key].id + ' in local storage.')
				}
			} else {

				// It's new, so push to the store
				state.all.push(slideshows[key])
			}
		})
	},
	updateTheme(state, theme) {
		const index = state.all.findIndex(slideshow => (slideshow.id === state.currentId))
		state.all[index]['theme'] = theme
	},
	updateTitle(state, title) {
		const index = state.all.findIndex(slideshow => (slideshow.id === state.currentId))
		state.all[index]['title'] = title
	},
	setLocked(state, locked) {
		state.locked = locked
	},
	setFetchingAll(state, status) {
		state.fetchingAll = status
	}
}

export default {
	namespaced: true,
	state,
	getters,
	actions,
	mutations
}