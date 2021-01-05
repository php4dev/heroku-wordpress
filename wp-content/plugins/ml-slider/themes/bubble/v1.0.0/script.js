(function($) {

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
   
})(jQuery)
