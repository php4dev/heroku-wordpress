import { __, EventManager } from '../utils'
import { Axios as api } from '../api'
import Shepherd from 'tether-shepherd/dist/js/shepherd.js'

const MainTour = new Shepherd.Tour()
MainTour.options.defaults = {
	classes: 'shepherd-theme-arrows metaslider-tour',
	showCancelLink: true
}

MainTour.addStep('add-slide', {
	title: __('Add a slide', 'ml-slider'),
	text: __('Thank you for using MetaSlider. To get started, press here to add your first slide.', 'ml-slider'),
	attachTo: { element: '#add-new-slide', on: 'bottom' },
	buttons: []
})

MainTour.addStep('add-image', {
	title: __('Select images', 'ml-slider'),
	text: __('You can easily add an image from one of the options here. Additionally we provide free images from the Unsplash library.', 'ml-slider'),
	attachTo: { element: '.media-frame-router', on: 'bottom left' },
	tetherOptions: {
		targetAttachment: 'bottom left',
		attachment: 'top center',
		offset: '0 -140px'
	},
	buttons: [
		{
			text: __('Next step', 'ml-slider'),
			action: function() {
				MainTour.show('create-slide')
			}
		}
	]
})

MainTour.addStep('search-unsplash', {
	title: __('Search unsplash', 'ml-slider'),
	text: __('Choose an image from the left, or search for any topic here to bring up more images.', 'ml-slider'),
	attachTo: { element: '#search-unsplash', on: 'bottom' },
	tetherOptions: { attachment: 'top center' },
	buttons: [
		{
			text: __('Hide step', 'ml-slider'),
			action: function() {
				MainTour.show('create-slide')
			}
		}
	]
})

MainTour.addStep('create-slide', {
	title: __('Create your slide', 'ml-slider'),
	text: __('After you have selected an image, press here to create your slide.', 'ml-slider'),
	attachTo: { element: '.media-modal.wp-core-ui', on: 'bottom' },
	tetherOptions: {
		targetAttachment: 'bottom right',
		attachment: 'bottom right',
		offset: '70px 90px'
	},
	buttons: []
})

// TODO: Add step for setting a theme

MainTour.addStep('preview', {
	title: __('Preview Slideshow', 'ml-slider'),
	text: __('Now that you have some slides set, you can preview your slideshow by pressing here.', 'ml-slider'),
	attachTo: { element: '#preview-slideshow', on: 'bottom' },
	tetherOptions: { attachment: 'top right', offset: '0 -90px' },
	buttons: []
})

// This sets the position of the tour to the database (currently used when they end/cancel the tour)
MainTour.setPosition = () => {
	return api.post('tour/status', {
		action: 'set_tour_status',
		current_step: MainTour.getCurrentStep().id
	})
}

// Events
// Add slide button was clicked
EventManager.$on('metaslider/add-slide-opening-ui', function() {
	this.$nextTick(() => {
		this.tourEnabled && MainTour.show('add-image')
	})
})

// Unsplash tab was opened
EventManager.$on('metaslider/unsplash-tab-opened', function() {
	this.$nextTick(() => {
		if (this.tourEnabled && 'add-image' === MainTour.getCurrentStep().id) {
			MainTour.show('search-unsplash')
		}
	})
})

// Unsplash tab was opened
EventManager.$on('metaslider/unsplash-tab-closed', function() {
	this.$nextTick(() => {
		this.tourEnabled && MainTour.show('create-slide')
	})
})

// Unsplash search was focused
EventManager.$on('metaslider/unsplash-search-focused', function() {
	this.$nextTick(() => {
		this.tourEnabled && MainTour.show('create-slide')
	})
})

// The create slide UI was closed
EventManager.$on('metaslider/add-slide-closing-ui', function() {
	this.$nextTick(() => {
		this.tourEnabled && MainTour.show('preview')
	})
})

// The create slide UI was closed
EventManager.$on('metaslider/preview-loaded', function() {
	this.tourEnabled && MainTour.setPosition()
	this.tourEnabled && MainTour.hide()
})

export default MainTour
