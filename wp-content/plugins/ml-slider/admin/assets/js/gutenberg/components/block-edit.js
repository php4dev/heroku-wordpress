// @codingStandardsIgnoreFile
import icon from './metaslider-icon'
import MetaSliderPreview from './preview'
import BlockStretchToolbar from './stretch-toolbar'
import SlideshowSelector from './slideshow-selector'
import RefreshButton from './refresh-button'
import {
	InspectorAdvancedControls,
	InspectorControls,
	BlockControls
} from '@wordpress/block-editor'

const wp = window.wp
const { __ } = wp.i18n

const { Fragment } = wp.element
const { withSelect } = wp.data
const {
	TextControl,
	// SelectControl,
	Placeholder,
	Spinner,
	PanelBody,
	BaseControl
} = wp.components

const blockConfig = window.metaslider_block_config || {}

/**
 * Edit function - renders the block
 *
 * @param {object} props
 * @return {object}
 */
const edit = (props) => {
	let {slideshows, className, isSelected, wideControlsEnabled = false} = props
	let slideshowId = props.attributes.slideshowId
	let stretch = props.attributes.stretch
	let containerClass = props.attributes.containerClass
	let isLoading = slideshows.isLoading
	let hasSlideshows = slideshows.items.length || false
	let refreshPreview = props.attributes.refreshPreview
	/**
	 * inspectorControls contains the different block controls
	 * - InspectorControls: controls in the sidebar
	 * - BlockControls: action controls on the block
	 */
	const inspectorControls = isSelected && (
		<Fragment key='inspectorControls'>
			<InspectorControls key='inspector'>
				<PanelBody title={__('Slideshow settings', 'ml-slider')}>
					{hasSlideshows && <SlideshowSelector
						props={props}
					/>}
					{slideshowId !== 0 && <a
						href={blockConfig.plugin_page + '&id=' + slideshowId}
						target="_blank"
						className={'ms-edit-current-slideshow'}
					>{__('Edit slideshow', 'ml-slider')}</a>}
					{wideControlsEnabled && <BaseControl
						label={__('Slideshow width', 'ml-slider')}>
						<BlockStretchToolbar
							value={ stretch }
							onChange={ (nextStretch) => {
								setTimeout(() => {
									window.dispatchEvent(new Event('resize'))
								}, 50)
								props.setAttributes({ stretch: nextStretch })
							}}
						/>
					</BaseControl>}
				</PanelBody>
			</InspectorControls>
			<InspectorAdvancedControls>
				<BaseControl
					label={__('Additional CSS Class', 'ml-slider')}>
					<TextControl
						value={ containerClass }
						onChange={(nextcontainerClass) => {
							props.setAttributes({ containerClass: nextcontainerClass })
						}}/>
				</BaseControl>
			</InspectorAdvancedControls>
			<BlockControls key='controls'>
				{wideControlsEnabled && <BlockStretchToolbar
					label={__('Slideshow width', 'ml-slider')}
					value={ stretch }
					onChange={ (nextStretch) => {
						setTimeout(() => {
							window.dispatchEvent(new Event('resize'))
						}, 50)
						props.setAttributes({ stretch: nextStretch })
					}}
				/>}
				{slideshowId !== 0 && <RefreshButton
					key='refresh'
					label={__('Refresh preview', 'ml-slider')}
					onClick={ () => {
						props.setAttributes({ refreshPreview: !refreshPreview })
					}}
				/>}
			</BlockControls>
		</Fragment>
	)

	// The slideshows list is loading
	if (!hasSlideshows && !slideshowId && isLoading) {
		return <Placeholder
			className={className}
			label={[icon, ' MetaSlider']}>
			<Spinner key="spinner" /> {__('Loading slideshows list...', 'ml-slider')}
		</Placeholder>
	// No slideshows were found
	} else if (!hasSlideshows && !slideshowId && !isLoading) {
		return <Placeholder
			className={className}
			label={[icon, ' MetaSlider']}>
			{__('No slideshows found.', 'ml-slider')}&nbsp;<a target='_blank' href={blockConfig.plugin_page}>{__('Create one now!', 'ml-slider')}</a>
		</Placeholder>
	}

	/**
	 * - inspectorControls
	 * - MetaSliderPreview: the iframe component
	 * - Placeholder: a placeholder with the select if no slideshow is selected
	 *
	 * @return {array}
	 */
	return [
		inspectorControls,
		!!slideshowId && <MetaSliderPreview
			key="preview"
			className={className}
			src={blockConfig.preview_url + '&slideshow_id=' + slideshowId}
			slideshowId={slideshowId}
			isSelected={isSelected}
			refresh={refreshPreview}
		/>,
		!slideshowId && <Placeholder
			key="instructions"
			className={props.className}
			label={[icon, ' MetaSlider']}
		>
			<SlideshowSelector
				key="slidehow-selector"
				props={props}
			/>
		</Placeholder>
	]
}

/**
 * withSelect - Gutenberg store / data management
 *
 * Fetches the 'alignWide' setting (defined by add_theme_support())
 */
export default withSelect(
	(select) => ({
		wideControlsEnabled: select('core/editor').getEditorSettings().alignWide
	})
)(edit)
