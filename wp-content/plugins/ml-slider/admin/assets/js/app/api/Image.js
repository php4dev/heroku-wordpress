import { Axios as api } from '../api'

// Note, this is a slow refactor so might appear incomplete
const Image = {
	findIdFromFilename(filenames) {
		let formData = new FormData()
		formData.append('filenames', filenames)
		formData.append('action', 'ms_get_image_ids_from_filenames')
		return api.post('images/ids-from-filenames', formData, {
			headers: { 'Content-Type': 'multipart/form-data' }
		})
	}
}

export default Image