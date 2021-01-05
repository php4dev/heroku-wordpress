(function($) {
	/**
	 * Extra JS for the Jenga theme
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
 		if ($(identifier).closest('.metaslider.ms-theme-jenga').length) {
 			var $slider = $(identifier);
 			var $container = $(identifier).closest('.metaslider.ms-theme-jenga');
 			var captions = $slider.find('.caption');
 			if (captions.length) {
 				$container.addClass('ms-has-caption');
 			}
 			$container.addClass('ms-loaded');
		}
 
		// Wrap nav and arrows in a div
		// When Dots
		$(".metaslider.has-dots-nav.ms-theme-jenga:not(.has-carousel-mode) .flexslider:not(.filmstrip) > .flex-control-paging, .metaslider.has-dots-nav.ms-theme-jenga:not(.has-carousel-mode) .flexslider:not(.filmstrip) > .flex-direction-nav").wrapAll("<div class='slide-control'></div>");

		// When Carousel
		$(".metaslider.ms-theme-jenga.has-carousel-mode .flexslider > .flex-control-paging").wrap("<div class='slide-control'></div>");

		// When Filmstrip
		$(".metaslider.ms-theme-jenga.has-filmstrip-nav .flexslider:not(.filmstrip) > .flex-direction-nav").wrap("<div class='slide-control'></div>");

		// Nivo with dots
		$(".metaslider.ms-theme-jenga:not(.has-carousel-mode).metaslider-responsive > div > .rslides_nav, .metaslider.ms-theme-jenga:not(.has-carousel-mode).metaslider-responsive > div > .rslides_tabs").wrapAll("<div class='slide-control'></div>");

		// Nivo wrap arrows
		$(".metaslider.ms-theme-jenga:not(.has-carousel-mode).metaslider-responsive .slide-control > .rslides_nav").wrapAll("<div class='rslides_arrows'></div>");

		// Nivo put arrows after dots
		var nivo_arrows = $(".metaslider.ms-theme-jenga:not(.has-carousel-mode).metaslider-responsive .rslides_arrows");
		nivo_arrows.next().insertBefore(nivo_arrows);

		$(window).trigger('resize');
 	});

	$(window).on('resize', function(e) {
		$(function() {
			// Removed these to give it a height that works for any number of slides.
			// var controlTotalHeight = controlNavHeight();
         	// var arrowsTotalHeight = arrowsNavHeight();
			$('.metaslider.ms-theme-jenga .slide-control').css({
				  'position' : 'absolute',
				  'top' : '39%',
				  'height' : "140px",
				  'margin-top' : "-50px"
			 });
		});
	});

})(jQuery)
