<script>
import { EventManager } from '../../utils'
import { Axios } from '../../api'
import Swal from 'sweetalert2'
import QS from 'qs'
import { mapGetters } from 'vuex'

export default {
	mounted() {
		EventManager.$on('import-notice', themeId => {
			this.showNotice(themeId)
		})
	},
	computed: mapGetters({
		current: 'slideshows/getCurrent'
	}),
	methods: {
		showNotice(themeId) {
			Swal.fire({
				title: this.__('Import Slides', 'ml-slider'),
				confirmButtonText: this.__('Import slides', 'ml-slider'),
				showCancelButton: true,
				icon: 'info',
				iconHtml: '<div class="dashicons dashicons-megaphone" style="transform: scale(3.5);"></div>',
				customClass: 'shadow-lg',
				html: '<p class="text-base">' + this.__('You currently do not have any slides to preview. If you want, we can import some image slides for you.', 'ml-slider') + '</p>',
				showLoaderOnConfirm: true,
				allowOutsideClick: () => !Swal.isLoading(),
				preConfirm: () => {

					// Make the request to import images
					return Axios.post('import/images', QS.stringify({
						action: 'ms_import_images',
						slideshow_id: this.current.id,
						theme_id: themeId
					})).catch(error => {
						Swal.showValidationMessage(error)
					})
				}
			}).then(result => {

				// User didnt cancel (esc btn, click cancel, etc)
				if (!result.dismiss) {
					window.location.reload(true)
				}
			})
		}
	},
	render: () => {
		return true
	}
}
</script>
