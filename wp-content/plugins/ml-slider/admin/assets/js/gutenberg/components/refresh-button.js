// @codingStandardsIgnoreFile
/**
 * Refresh Button
 *
 * Adds a refresh button to the block toolbar.
 * Used for example when a user makes an edit to a slideshow and want to see the result in the editor.
 */

/**
 * WordPress dependencies
 */
const wp = window.wp
const { __ } = wp.i18n
const { Toolbar } = wp.components

/**
 * BlockStretchToolbar
 * Toolbar Component for allowing streching of the slider
 *
 * @param  {object} $object
 * @return {function}
 */
export default function RefreshButton({ value, onChange, onClick }) {
	/**
	 * applyOrUnset - Applies the value or unsets it when cligking
	 *
	 * @param  {string} $align
	 * @return {function}
	 */
	return (
		<Toolbar
			controls={[
				{
					icon: 'update',
					title: __('Update preview', 'ml-slider'),
					isActive: false,
					onClick: onClick
				}
			]}
		/>
	)
}
