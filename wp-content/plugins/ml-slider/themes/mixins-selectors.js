module.exports = {
	dotsContainer: {
		'flex':    '.flexslider ol.flex-control-nav:not(.flex-control-thumbs)',
		'rslides': 'ul.rslides_tabs',
		'nivo':    'div.slider-wrapper .nivo-controlNav:not(.nivo-thumbs-enabled)',
		'coin':    '.coin-slider .cs-buttons'
	},
	dotsLink: {
		'flex':    '.flexslider ol.flex-control-nav:not(.flex-control-thumbs) li a',
		'rslides': 'ul.rslides_tabs li a',
		'nivo':    'div.slider-wrapper .nivo-controlNav:not(.nivo-thumbs-enabled) a',
		'coin':    '.coin-slider .cs-buttons a'
	},
	dotsLinkActive: {
		'flex': '.flexslider ol.flex-control-nav li a.flex-active, .flexslider ol.flex-control-nav:not(.flex-control-thumbs) li a:hover',
		'rslides': 'ul.rslides_tabs li.rslides_here a, ul.rslides_tabs li a:hover',
		'nivo': 'div.slider-wrapper div.nivo-controlNav:not(.nivo-thumbs-enabled) a.active, .slider-wrapper .nivo-controlNav:not(.nivo-thumbs-enabled) a:hover',
		'coin': '.coin-slider .cs-buttons a.cs-active, .coin-slider .cs-buttons a:hover'
	},
	dotsLinkLastItem: {
		'flex': '.flexslider ol.flex-control-nav:not(.flex-control-thumbs) li:last-child a',
		'rslides':'ul.rslides_tabs li:last-child a', 
		'nivo': 'div.slider-wrapper div.nivo-controlNav:not(.nivo-thumbs-enabled) a:last-child',
		'coin': '.coin-slider .cs-buttons a:last-child'
	},
	arrowsContainer: {
		'flex': '.flexslider:not(.filmstrip) ul.flex-direction-nav',
		'nivo': 'div.nivo-directionNav'
	},
	arrowsLink: {
		'flex': '.flexslider ul.flex-direction-nav li a',
		'rslides': 'a.rslides_nav',
		'nivo': 'div.nivoSlider div.nivo-directionNav a',
		'coin': '.coin-slider .coin-slider div a'
	},
	arrowsLink__prev: {
		'flex': '.flexslider ul.flex-direction-nav li a.flex-prev',
		'rslides': '.rslides_nav.prev',
		'nivo': 'div.nivoSlider div.nivo-directionNav a.nivo-prevNav',
		'coin': '.coin-slider .coin-slider div a.cs-prev'
	},
	arrowsLink__next: {
		'flex': '.flexslider ul.flex-direction-nav li a.flex-next',
		'rslides': '.rslides_nav.next',
		'nivo': 'div.nivoSlider div.nivo-directionNav a.nivo-nextNav',
		'coin': '.coin-slider .coin-slider div a.cs-next'
	},
	sliderHover__arrowsLinks: {
		'flex': '.flexslider:hover ul.flex-direction-nav li a, .flexslider:focus-within ul.flex-direction-nav li a',
		'rslides': '&:hover a.rslides_nav',
		'nivo': 'div.nivoSlider:hover div.nivo-directionNav a',
		'coin': '.coin-slider:hover .coin-slider div a'
	},
	caption: {
		'flex': '.flexslider ul.slides .caption-wrap',
		'rslides': '.rslides .caption-wrap',
		'nivo': 'div.nivoSlider .nivo-caption',
		'coin': '.cs-title'
	},
	caption__text: {
		'flex': '.flexslider ul.slides .caption-wrap .caption',
		'rslides': '.rslides .caption-wrap .caption',
		'nivo': 'div.nivoSlider .nivo-caption',
		'coin': '.cs-title'
	}
}