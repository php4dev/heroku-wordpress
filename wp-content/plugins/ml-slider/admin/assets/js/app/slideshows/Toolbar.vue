<script>
import { EventManager } from '../utils'
import { CSSManagerNotice } from '../notices'
import { mapState } from 'vuex'
export default {
	data() {
		return {
			duplicating: false,
			scrolling: 0
		}
	},
	computed: mapState({
		locked: state => state.slideshows.locked
	}),
	mounted() {
		// Get height of admin bar to make the header sticky with offset (useful in case something else alters the admin bar height)
		const calculateToolbarPosition = function() {
			window.requestAnimationFrame(() => {
				document.getElementById('ms-toolbar').style.top = document.getElementById('wpadminbar').clientHeight + 'px'
			})
		}
		calculateToolbarPosition()
		window.addEventListener('resize', calculateToolbarPosition)

		// Know when the user isn't scrolled to the top
		window.addEventListener('scroll', () => { 
			this.scrolling = window.scrollY > 0
		}, { passive: true })

	},
	methods: {
		save() {
			EventManager.$emit('metaslider/save')
		},
		preview() {
			if (this.locked) return
			EventManager.$emit('metaslider/preview')
		},
		duplicate() {
			if (this.locked) return
			this.duplicating = true
			this.notifyInfo('metaslider/duplicate-preparing', this.__('Preparing slideshow for duplication...', 'ml-slider'), true)
			setTimeout(() => {
				EventManager.$emit('metaslider/duplicate')
			}, 1500)
		},
		showCSSManagerNotice() {
			EventManager.$emit('metaslider/open-utility-modal', CSSManagerNotice)
		},
		addSlide() {
			// The easy way
			// TODO: refactor out the jQuery way in admin.js (i.e. create Slide component)
			window.create_slides.open()
		}
	}
}
</script>
