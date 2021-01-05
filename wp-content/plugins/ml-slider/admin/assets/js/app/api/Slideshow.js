import { Axios as api } from '../api'
import store from '../store'

const Slideshow = {
	all(page = 1, count = 25) {
		return api.get('slideshow/all', {
			params: {
				action: 'ms_get_slideshows',
				page: page,
				count: count
			}
		})
	},
	single(id) {
		return api.get('slideshow/single', {
			params: {
				action: 'ms_get_single_slideshow',
				id: id
			}
		})
	},
	search(term, count = 50) {
		return api.get('slideshow/search', {
			params: {
				action: 'ms_search_slideshows',
				term: term,
				count: count
			}
		})
	},
	save(data, chunks = 10) {
		const formData = new FormData()
		let count = 0
		formData.append('slideshow_id', store.getters['slideshows/getCurrent'].id)
		formData.append('action', 'ms_save_slideshow')

		// Prune chunks from data
		for (let index = 0; index < chunks; index++) {
			if (!data[index]) continue
			data[index].forEach(data => {
				formData.append(data.name, data.value)
			})
			count++
			delete data[index]
		}
		data = data.filter(val => val) // re-index

		// Add key to verify data wasn't truncated
		formData.append('count', count)

		return api.post('slideshow/save', formData, {
			headers: { 'Content-Type': 'multipart/form-data' }
		}).then(response => {

			// If there is more data to process, return that
			return (data.length) ? data : response.data
		})
	},
	duplicate() {
		let formData = new FormData()
		formData.append('slideshow_id', store.getters['slideshows/getCurrent'].id)
		formData.append('action', 'ms_duplicate_slideshow')
		return api.post('slideshow/duplicate', formData, {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		})
	},
	export(slideshowIds) {
		return api.get('slideshow/export', {
			responseType: 'blob',
			params: {
				action: 'ms_export_slideshows',
				slideshow_ids: JSON.stringify(slideshowIds)
			}
		})
	},
	import(slideshows) {
		let formData = new FormData()
		formData.append('slideshows', slideshows)
		formData.append('action', 'ms_import_slideshows')
		return api.post('slideshow/import', formData, {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		})
	},
	// delete() {},
}

export default Slideshow
