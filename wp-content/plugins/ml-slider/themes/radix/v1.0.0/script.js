(function($) {
	// metaslider has been initilalised
	$(document).on('metaslider/initialized', function (e, identifier) {
		// if .ms-theme-radix
		if ($(identifier).closest('.metaslider.ms-theme-radix').length) {
			var $slider = $(identifier);
			var $container = $(identifier).closest('.metaslider.ms-theme-radix');
			var captions = $slider.find('.caption');
			if (captions.length) {
				$container.addClass('ms-has-caption');
			}
			$container.addClass('ms-loaded');
		}
		$(window).trigger('resize');
	});

   	$(window).on('load resize', function(e) {
		// go through the sliders with this theme
		$('.metaslider').each(function(index) {
			var width = $(this).outerWidth();
			// if the slider width < 600px
			if (width < 600) {
				$(this).addClass('ms-is-small');
			} else {
				$(this).removeClass('ms-is-small');
			}
		});
	});

   	$(window).on('load', function() {

      	var rslideDots =  (function() {
			if ($('.metaslider.ms-theme-radix.has-dots-nav').find('ul.rslides').length) {
				var rslidesNumImgs = $('ul.rslides_tabs li').length;
				$('ul.rslides_tabs').append('<li class="rslides-slide-count"></li>');
				$('ul.rslides_tabs li').hide().filter('.rslides_here').show();
				$('li.rslides-slide-count').append('/ ' + rslidesNumImgs).show();
         	}
      	})();

      	var nivoDots =  (function() {
			if ($('.metaslider.ms-theme-radix.has-dots-nav').find('div.nivo-controlNav').length) {
				var nivoNumImgs = $('div.nivo-controlNav a').length;
				$('div.nivo-controlNav').append('<a class="nivo-slide-count"></a>');
				$('div.nivo-controlNav a').hide().filter('.active').show();
				$('a.nivo-slide-count').append('/ ' + nivoNumImgs).show();
         	}
      	})();
   });

})(jQuery)
