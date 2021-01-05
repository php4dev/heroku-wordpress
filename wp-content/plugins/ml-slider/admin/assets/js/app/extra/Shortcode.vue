<script>
import { EventManager } from '../utils'
import { mapGetters } from 'vuex'
export default {
	data() {
		return {
			useTitle: false
		}
	},
	computed: {
		...mapGetters({
			current: 'slideshows/getCurrent'
		})
	},
	mounted() {
		// Add a filter to optimize the copy output
		this.$refs.shortcode.addEventListener('copy', event => {
			let text = window.getSelection()
				.toString().split("'")
				.map(function(string, index) {
					return string.trim()
				}).join("'")
			event.clipboardData.setData('text/plain', text)
			event.preventDefault()
		})
	},
	methods: {
		copyShortcode(event) {
			this.selectText(event.target).copySelected()
		},
		copyAll() {
			this.selectText(this.$refs.shortcode).copySelected()
		},
		selectText(node) {
			let range
			let selection

			// Most browsers will be able to select the text
			if (window.getSelection) {
				selection = window.getSelection()
				range = document.createRange()
				range.selectNodeContents(node)
				selection.removeAllRanges()
				selection.addRange(range)
			} else if (document.body.createTextRange) {
				range = document.body.createTextRange()
				range.moveToElementText(node)
				range.select()
			}

			return this
		},
		copySelected() {

			// Some browsers will be able to copy the text too!
			try {
				if (document.execCommand('copy')) {
					this.notifySuccess('metaslider/copy-success', this.__('Shortcode copied', 'ml-slider'), true)
				}
			} catch (err) {
				this.notifySuccess('metaslider/copy-error', this.__('Shortcode unable to be copied automatically', 'ml-slider'), true)
			}
		}
	}
}
</script>
