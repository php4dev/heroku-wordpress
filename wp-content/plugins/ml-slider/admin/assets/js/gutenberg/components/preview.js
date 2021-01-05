// @codingStandardsIgnoreFile
/**
 * Preview
 *
 * Handles the slideshow preview.
 * It renders an iframe, a transparent overlay to trigger the block selection and a loading state.
 */
import icon from './metaslider-icon'
const wp = window.wp
const React = window.React
const { Placeholder, Spinner } = wp.components
const { __ } = wp.i18n
const { apiRequest } = wp

/**
 * Custom iframe component to leverage events
 */
class MetaSliderPreview extends React.Component {
	/**
	 * Custom_Iframe component
	 *
	 * @param  object props Properties
	 * @return void
	 */
	constructor(props) {
		super(props)
		this.state = {
			height: 200,
			previewIsLoading: true,
			slideshowId: null,
			html: '',
			previewErrorMessage: ''
		}
		this.handleOnLoad = this.handleOnLoad.bind(this)
		this.setHeight = this.setHeight.bind(this)
		this.getPreview = this.getPreview.bind(this)
		this.handleResize = this.handleResize.bind(this)
		this.iframe = React.createRef()
	} // end constructor()

	/**
	 * componentDidMount: Fires when the dom element is inserted
	 */
	componentDidMount() {
		this.getPreview()
		window.addEventListener('resize', this.handleResize)
		if (this.props.componentDidMount) {
			this.props.componentDidMount(this)
		}
	} // end componentDidMount()

	/**
	 * componentWillUnmount - Fires just before the dom element is removed
	 */
	componentWillUnmount() {
		window.removeEventListener('resize', this.handleResize)
		if (this.props.componentWillUnmount) {
			this.props.componentWillUnmount()
		}
	} // end componentWillUnmount()

	/**
	 * ComponentDidUpdate
	 * When some props have been updated, before the component re-renders
	 */
	componentDidUpdate(prevProps) {
		// if the source changes, change loaded status
		if (this.props.slideshowId !== prevProps.slideshowId || this.props.refresh !== prevProps.refresh) {
			this.setHeight(200)
			this.getPreview()
			this.iframe.current.contentDocument.location.reload(true)
		}
	}

	/**
	 * handleOnLoad - The iframe onLoad event handler
	 *
	 * @param {Event} e - Event
	 */
	handleOnLoad(e) {
		if (this.state.html) {
			this.iframe.current.contentDocument.editor_block = this
			setTimeout(() => {
				clearInterval(this.loadInterval)
				this.setHeight(this.iframe.current.contentDocument.body.clientHeight)
			}, 50)
			this.setState({previewIsLoading: false})
		}
	} // end handleOnLoad()

	/**
	 * Handle window resize event
	 *
	 * @param {Event} e
	 */
	handleResize(e) {
		// console.log('ss', this.iframe.current.contentDocument.body.clientHeight, this.iframe.current.contentDocument.body, this.iframe.current.contentDocument, this.iframe)
		this.setHeight(this.iframe.current.contentDocument.body.clientHeight)
	}

	/**
	 * Sets iframe Height with a minimum of 200 if below 100
	 * Sometimes it shrinks on resize, so 200 looks best.
	 *
	 * @param {int} height
	 */
	setHeight(height) {
		this.setState({height: height > 200 ? height : 200})
	}

	/**
	 * Get Preview - fetches the iframe's content
	 */
	getPreview() {
		try {
			this.setState({
				html: '',
				previewIsLoading: true,
				previewErrorMessage: ''
			})
			apiRequest(
				{
					path: '/metaslider/v1/slideshow/preview',
					data: {
						action: 'ms_get_preview',
						slideshow_id: this.props.slideshowId,
						override_preview_style: true
					}
				}
			).then(response => {
				// Update the html inside the preview and set the height
				this.setState({html: response.data})
				this.setHeight(this.iframe.current.contentDocument.body.clientHeight)
			}).fail(error => {
				// Update the iframe but show an error that this slideshow no longer exists
				if (410 === error.status) {
					this.setState({
						previewIsLoading: false,
						previewErrorMessage: error.responseJSON.data.message
					})
					console.error('MetaSlider (Gutenberg): Slideshow not found:', error)
				} else {
					console.error('MetaSlider (Gutenberg): Could not load the preview:', error)
				}
			})
		} catch (error) {
			console.error('MetaSlider (Gutenberg): A general error occured:', error)
		}
	}

	/**
	 * Render - React render function
	 *
	 * @return dom object
	 */
	render() {
		return <div className={this.props.className + (this.state.previewIsLoading ? '' : ' loading') + ' ms-preview'}>
			<iframe
				key="preview-iframe"
				height={this.state.height}
				srcDoc={this.state.html || ''}
				onLoad={this.handleOnLoad}
				ref={this.iframe}
			/>
			<div key="trigger" className="ms-preview__trigger"></div>
			{this.state.previewIsLoading && <Placeholder
				key="ms-loader"
				className="ms-loader"
				label={[icon, ' MetaSlider']}>
				<Spinner/> {__('Loading slideshow', 'ml-slider')}
			</Placeholder>}
			{(this.state.previewErrorMessage) && <Placeholder
				key="ms-preview-empty"
				className="ms-loader"
				label={[icon, ' MetaSlider']}>
				{this.state.previewErrorMessage}
			</Placeholder>}
		</div>
	} // end render()
}

export default MetaSliderPreview
