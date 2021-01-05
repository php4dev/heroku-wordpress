(function($) {
	/**
	 * Extra JS for the Architekt theme
	 *
	 * 1. positions the different elements:
	 *    - arrows
	 */

	// metaslider has been initilalised
	$(document).on('metaslider/initialized', function(e, identifier) {
		// if .ms-theme-starter
		if ($(identifier).closest('.metaslider.ms-theme-starter').length) {
			var $slider = $(identifier);
			var $container = $(identifier).closest('.metaslider.ms-theme-starter');
			$container.addClass('ms-loaded');
		}
		$(window).trigger('resize');
	});

	$(window).on('resize', function(e) {
		// go through the sliders with this theme
		$('.metaslider.ms-theme-starter').each(function(index) {

			// slightly delay action after resize for a smoother transition
			setTimeout(function() {
				// gets the slideshow's height
				var height = get_max_height($(this).find('.ms-image > img'));
				// if has thumbnail nav
				if ($(this).is('.has-thumb-nav')) {
					// Arrows
					$(this).find('.flex-direction-nav a').css({'top': Math.round(height / 2), 'bottom': 'auto'});
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