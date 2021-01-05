// @codingStandardsIgnoreFile
const { Fragment } = window.wp.element
/**
 * Save function - the output will be displayed on the frontend
 *
 * @param {object} props
 * @return {domObject}
 */
const save = (props) => {
	let { slideshowId, stretch, containerClass } = props.attributes
	let stretchClassName = stretch ? 'align' + stretch : ''

	return (!!slideshowId && <Fragment>
		<div class={stretchClassName}>
			[metaslider id={slideshowId} cssclass="{containerClass}"]
		</div>
	</Fragment>) || ''
}

export default save
