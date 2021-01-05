(function($) {
	/**
	 * Extra JS for the Architekt theme
	 *
	 * 1. positions the different elements:
	 *    - arrows
	 *    - dots
	 *    - caption
	 *    - filmstrip
	 */

	// metaslider has been initilalised
	$(document).on('metaslider/initialized', function(e, identifier) {
		// if .ms-theme-architekt
		if ($(identifier).closest('.metaslider.ms-theme-architekt').length) {
			var $slider = $(identifier);
			var $container = $(identifier).closest('.metaslider.ms-theme-architekt');
			var captions = $slider.find('.caption');
			if (captions.length) {
				$container.addClass('ms-has-caption');
			}
			$container.addClass('ms-loaded');
		}
		$(window).trigger('resize');
	});

	$(window).on('resize', function(e) {
		// go through the sliders with this theme
		$('.metaslider.ms-theme-architekt').each(function(index) {
			var width = $(this).outerWidth();
			// if the slider width < 600px
			if (width < 600) {
				$(this).addClass('ms-is-small');
			} else {
				$(this).removeClass('ms-is-small');
			}

			// slightly delay action after resize for a smoother transition
			setTimeout(function() {
				var margin_bottom = 0;
				var $thumbNav = $(this).find('.filmstrip, .flex-control-thumbs, .nivo-thumbs-enabled');				
				// gets the slideshow's height
				var height = get_max_height($(this).find('.ms-image > img, .rslides > li > img, .nivoSlider > img'));

				// if has filmstrip nav
				if ($(this).find('.filmstrip').length) {
					// var $thumbNav = $(this).find('.filmstrip');
					var thumbs_height = $thumbNav.find('img').prop('height'); 

					// Filmstrip position
					if($(this).is('.ms-has-caption')) {
						$thumbNav.css({'top': height + 5});
					}

					// arrows position
					$(this)
						.find('.flex-control-nav, .flexslider .flex-direction-nav')
						.css({'top': height + thumbs_height + 15, 'bottom': 'auto'});

					// caption position
					$(this)
						.find('.caption-wrap')
						.css({'margin-top': thumbs_height});
					
					// margin_bottom += thumbs_height + 15;
				} else if ($(this).find('.flex-control-thumbs, .nivo-thumbs-enabled').length) {
					// var thumbs_height = $thumbNav.find('img').prop('height'); 					
					// thumbnails for flex
					// $(this).find('.flex-control-nav').css({'top': height, 'bottom': 'auto'});
					// Arrows
					$(this).find('.flex-direction-nav, .nivo-directionNav').css({
						'top': Math.round(height + $thumbNav.outerHeight() + 6),
						'bottom': 'auto'
					});
					margin_bottom += $thumbNav.outerHeight();
					if ($(this).find('.flex-direction-nav').length) {
						$(this).css('padding-bottom', margin_bottom + 15);
					}
				} else {
					// arrows and dots position
					$(this)
						.find('.flex-control-nav, .flexslider:not(.filmstrip) .flex-direction-nav, .rslides_nav, .rslides_tabs, .nivo-directionNav, .nivo-controlNav')
						.css({'top': height + 15, 'bottom': 'auto'});
				}
			}.bind(this), 50);
		});
	});

	/**
	 * Get maximum height of the elements collection
	 *
	 * @param  {jQuery object} elms 
	 * @return {int}
	 */
	var get_max_height = function(elms) {
		var h = 0;
		$(elms).each(function(index) {
			if ($(this).height() > h) {
				h = $(this).height();
			}
		});
		return h;
	}
})(jQuery)