import Axios from 'axios'
import { EventManager } from '../../utils'

// Since this uses an external api we need a new instance
const api = Axios.create({
	baseURL: 'https://www.metaslider.com/wp-json/unsplash/v1/'
})

const Unsplash = {
	photos(page = 1, search = '', nocache = 0) {

		if (search) {
			return this.searchPhotos(page, search)
		}

		return api.get('images/all', {
			params: { page: page, nocache: nocache }
		})
	},
	searchPhotos(page = 1, search = '') {
		return api.post('images/search', {
			page: page,
			search: search
		})
	},
	// A download from Unsplash requires downloading the image
	// AND hitting an endpoint to "count" the download
	async download(url, id) {
		// 1) Download image
		const blob = await Axios.get(url, {
			responseType: 'blob',
			onDownloadProgress: progressEvent => {

				// Leave the last 20% for the final confirmation from the server
				let percentage = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total)) - 20
				EventManager.$emit('metaslider/external-api-percentage', {
					percentage: percentage > 1 ? percentage : 1
				})
			}
		})

		// 2) Trigger the endpoint to increase the count (specific to Unsplash)
		api.post(`images/${id}/download`)

		// Return the blob to be processed on the user's server
		return blob
	}
}

export default Unsplash
