import icon from './components/metaslider-icon'
// Edit function
import edit from './components/block-edit'
// Save function
import save from './components/block-save'

// Import Gutenberg variables and functions
const wp = window.wp
const { __ } = wp.i18n
const {
	registerBlockType
} = wp.blocks
const { registerStore, dispatch, withSelect } = wp.data
const { apiRequest } = wp

// Default state for the store
const DEFAULT_STATE = {
	items: [],
	isLoading: true
}
/**
 * Register a store, to fetch and store our slideshows
 * https://github.com/WordPress/gutenberg/tree/master/data
 */
registerStore('metaslider', {
	reducer(state = DEFAULT_STATE, action) {
		switch (action.type) {
		case 'SET_SLIDESHOWS':
			return {
				items: action.items,
				isLoading: false
			}
		}
		return state
	},
	actions: {
		setSlideshows(items) {
			return {
				type: 'SET_SLIDESHOWS',
				items
			}
		}
	},
	selectors: {
		getSlideshows(state) {
			return state
		}
	},
	resolvers: {
		getSlideshows(state, result) {
			// const items = await
			try {
				apiRequest({path: '/metaslider/v1/slideshow/list'}).then(result => {
					if (true === result.success) {
						dispatch('metaslider').setSlideshows(result.data)
					} else {
						console.warn('MetaSlider: API Request error:', result.data.message)
						dispatch('metaslider').setSlideshows([])
					}
				})
			} catch (error) {
				console.warn('MetaSlider: API Request error:', error)
				dispatch('metaslider').setSlideshows([])
			}
		}
	}
})

/**
 * Register Gutenberg Block
 *
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType('metaslider/slider', {
	title: 'MetaSlider',
	description: __('Use MetaSlider to insert slideshows and sliders in your page', 'ml-slider'),
	icon: icon,
	category: 'common',
	keywords: [__('slider', 'ml-slider'), __('slideshow', 'ml-slider'), __('gallery', 'ml-slider')],
	attributes: {
		slideshowId: {
			type: 'number',
			default: 0
		},
		stretch: {
			type: 'string',
			default: 'normal'
		},
		containerClass: {
			type: 'string',
			default: ''
		}
	},
	supports: {
		customClassName: false
	},

	/**
	 * Edit function
	 * withSelect is the gets content from the gutenberg store. The MS store is setup above.
	 */
	edit: withSelect((select, ownProps) => {
		const { getSlideshows } = select('metaslider')
		return {
			slideshows: getSlideshows()
		}
	})(
		edit
	),

	/**
	 *  The "save" property must be specified and must be a valid function.
	 *
	 * @param  {obj}  props
	 * @return {bool} false because content is dynamic (see php file)
	 */
	save: props => save(props),

	/**
	 * getEditWrapperProps: adds attributes to root block
	 *
	 * @param {object} attributes
	 * @return {object|void}
	 */
	getEditWrapperProps(attributes) {
		const { stretch } = attributes
		if ([ 'wide', 'full', 'normal' ].indexOf(stretch) !== -1) {
			return { 'data-align': stretch }
		}
	}
})
