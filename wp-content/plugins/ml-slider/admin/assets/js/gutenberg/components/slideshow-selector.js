// @codingStandardsIgnoreFile
/**
 * Slideshow Selector
 *
 * Renders the SELECT with the slideshows list.
 */

/**
 * WordPress dependencies
 */
const wp = window.wp
const { __ } = wp.i18n
const {	SelectControl } = wp.components

/**
 * SlideshowSelector
 *
 * @param {object} props
 * @return {object}
 */
export default function SlideshowSelector({ props }) {
	let slideshowId = props.attributes.slideshowId
	let { slideshows } = props

	return <SelectControl
		label={__('Select a slideshow', 'ml-slider')}
		value={slideshowId}
		options={[{label: '-- ' + __('Select a slideshow', 'ml-slider') + ' --', value: 0}].concat(slideshows.items.map(function(slider) {
			return {
				key: slider.id,
				label: wp.htmlEntities.decodeEntities(slider.title) + ' (#' + slider.id + ')',
				value: slider.id
			}
		}))}
		onChange={(newId) => {
			newId = parseInt(newId)
			props.setAttributes({slideshowId: newId})
		}}
	/>
}
