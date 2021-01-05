import { Axios as api } from '../api'
import store from '../store'

// Note, this is a slow refactor so might appear incomplete
const Settings = {

	save(data) {
		let formData = new FormData()
		formData.append('slideshow_id', store.getters['slideshows/getCurrent'].id)
		formData.append('action', 'ms_update_all_slideshow_settings')
		data.forEach(data => {
			formData.append(data.name, data.value)
		})
		return api.post('settings/slideshow/save', formData, {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		})
	},

	// Use this when the setting is not related to the slideshow itself (which would be in the store)
	saveSingleSlideshowSetting(key, value) {
		let formData = new FormData()
		formData.append('slideshow_id', store.getters['slideshows/getCurrent'].id)
		formData.append('setting_key', key)
		formData.append('setting_value', value)
		formData.append('action', 'ms_update_single_slideshow_setting')

		return api.post('settings/slideshow/save-single', formData, {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		})
	},
	// Save a global option for the user
	saveUserSetting(key, value) {
		let formData = new FormData()
		formData.append('setting_key', key)
		formData.append('setting_value', value)
		formData.append('action', 'ms_update_user_setting')

		return api.post('settings/user/save', formData, {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		})
	},
	get(setting) {
		return api.get('settings/single', {
			params: {
				action: 'ms_get_single_setting',
				setting: setting,
			}
		})
	},
	getSlideshowDefaults() {
		return api.get('settings/slideshow/defaults', {
			params: {
				action: 'ms_get_default_slideshow_settings'
			}
		})
	},
	saveSlideshowDefaults(settings) {
		let formData = new FormData()
		formData.append('action', 'ms_update_slideshow_default_settings')
		formData.append('settings', settings)
		return api.post('settings/slideshow/defaults/save', formData, {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		})
    },
    getGlobalSettings() {
		return api.get('settings/global', {
			params: {
				action: 'ms_get_default_slideshow_settings'
			}
		})
    },

	saveGlobalSettings(settings) {
		let formData = new FormData()
		formData.append('action', 'ms_update_global_settings')
		formData.append('settings', settings)
		return api.post('settings/global/save', formData, {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		})
	},

	saveGlobalSettingsSingle(key, value) {
		let formData = new FormData()
		formData.append('action', 'ms_update_global_settings_single')
		formData.append('setting_key', key)
		formData.append('setting_value', value)
		return api.post('settings/global/single/save', formData, {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		})
	},
}

export default Settings
