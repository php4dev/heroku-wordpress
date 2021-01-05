// @codingStandardsIgnoreFile
/**
 * Stretch toolbar
 *
 * Adds a stretch toolbar to the block, if the theme supports wide / fullwidth blocks
 */
// WordPress dependencies
const wp = window.wp
const { __ } = wp.i18n
const { Toolbar } = wp.components

const BLOCK_ALIGNMENTS_CONTROLS = {
	normal: {
		icon: 'align-center',
		title: __('Normal width', 'ml-slider')
	},
	wide: {
		icon: 'align-wide',
		title: __('Wide width', 'ml-slider')
	},
	full: {
		icon: 'align-full-width',
		title: __('Full width', 'ml-slider')
	}
}

const DEFAULT_CONTROLS = [ 'normal', 'wide', 'full' ]

/**
 * BlockStretchToolbar
 * Toolbar Component for allowing streching of the slider
 *
 * @param  {object} $object
 * @return {function}
 */
export default function BlockStretchToolbar({ value, onChange, controls = DEFAULT_CONTROLS }) {
	/**
	 * applyOrUnset - Applies the value or unsets it when cligking
	 *
	 * @param  {string} $align
	 * @return {function}
	 */
	function applyOrUnset(align) {
		return () => onChange(value === align ? undefined : align)
	}

	const enabledControls = controls
	return (
		<Toolbar
			controls={
				enabledControls.map((control) => {
					return {
						...BLOCK_ALIGNMENTS_CONTROLS[ control ],
						isActive: value === control,
						onClick: applyOrUnset(control)
					}
				})
			}
		/>
	)
}
