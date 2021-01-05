<script>
import { HelpCenter, Settings, Import, Export } from './pages'
import { EventManager } from '../utils'
export default {
	components: {
		'helpcenter': HelpCenter,
		'settings': Settings,
		'import': Import,
		'export': Export,
	},
	props: {
	},
	data() {
		return {
            component: 'settings',
            hasNotice: false,
		}
	},
	mounted() {
        this.hasNotice = document.querySelector('.updraft-ad-container') ? true : false
		// Set up the page height minus the toolbar
		const calculateHeaderPadding = () => {
			window.requestAnimationFrame(() => {
					const adminToolbar = document.getElementById('wpadminbar')
					const msToolbar = document.getElementById('ms-toolbar')
					const toolbarsHeight = 'absolute' !== window.getComputedStyle(adminToolbar).position ?
						msToolbar.clientHeight :
						adminToolbar.clientHeight + msToolbar.clientHeight
					this.hasNotice || document.getElementById('metaslider-settings-page')
						.setAttribute('style', `padding-top:${toolbarsHeight}px!important`)
					document.getElementById('metaslider-ui')
						.setAttribute('style', `height:calc(100vh - ${adminToolbar.clientHeight}px)!important`)
			})
		}
		calculateHeaderPadding()
		window.addEventListener('resize', calculateHeaderPadding)

		EventManager.$on('metaslider/open-settings-page', data => {
			if (false === 'render' in data) {
				this.notifyError('metaslider/open-settings-page', this.__('Failed to open the settings page...', 'ml-slider'))
				return false
			}

			const filename = 'filename' in data ? data.filename : 'Name not found'
			this.notifyInfo(
				'metaslider/open-settings-page',
				this.__('Opening settings page...', 'ml-slider') + ' (' + filename + ')'
			)
			this.component = data
		})
	},
	methods: {
		loadPage(page) {
			if (Object.keys(this.$options.components).includes(page)) {
				this.component = page
				return
			}
			this.notifyError(
				'metaslider/open-settings-page',
				this.sprintf(this.__('Page not found: %s', 'ml-slider'), page)
			)
		}
	},
	render() {
		return this.$scopedSlots.default({})
	}
}
</script>
