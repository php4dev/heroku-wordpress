import axios from 'axios'

const Axios = axios.create({
	baseURL: window.metaslider_api.supports_rest ? window.metaslider_api.root : false,
	headers: {
		'X-WP-Nonce': window.metaslider_api ? window.metaslider_api.nonce : false,
		'X-Requested-With': 'XMLHttpRequest'
	}
})

Axios.interceptors.request.use((config) => {

	// If the baseURL above is false, it means that REST is not supported
	// So we can override the route to use admin-ajax.php
	if (!config.baseURL) {
		config.url = window.metaslider_api.ajaxurl
	}

	return config
})

Axios.interceptors.response.use(undefined, error => {
	return new Promise((resolve, reject) => {

		// If we are already using admin-ajax, continue
		if (error.config.url === window.metaslider_api.ajaxurl) {
			reject(error)
		}
		
		if (error.config && 'GET' === error.config.method.toUpperCase()) {
			const APP = window.metaslider.app ? window.metaslider.app.MetaSlider : null
			APP && APP.notifyError('metaslider/rest-route-get-error', error.response)

			// If the failed route was a GET request then update the config and remake the call
			error.config.url = window.metaslider_api.ajaxurl
			resolve(axios.request(error.config))
		}

		if (error.config && 'POST' === error.config.method.toUpperCase()) {

			// Try again on "safe" routes
			if (error.response && 404 === error.response.status) {
				error.config.url = window.metaslider_api.ajaxurl
				resolve(axios.request(error.config))
			}
			// TODO: Possibly show a custom error message with action callback (point to URL with more info)
		}
		reject(error)
	})
})

export default Axios
