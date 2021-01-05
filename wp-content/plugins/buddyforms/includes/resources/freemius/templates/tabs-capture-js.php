<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } $fs = freemius( $VARS['id'] ); $slug = $fs->get_slug(); ?>
<script type="text/javascript">
	(function ($) {
		$(document).ready(function () {
		    var $wrap = $( '.wrap' );
		    if ( 0 === $wrap.length ) {
		        $wrap = $( '<div class="wrap">' );
		        $wrap.insertBefore( $( '#wpbody-content .clear' ) );
            }

            $wrap = $wrap.clone().wrap( '<div>' ).parent();

		    var
			    settingHtml   = $wrap.html(),
			    tabsPosition  = settingHtml.indexOf('nav-tab-wrapper'),
			    aboveTabsHtml = '';

			if (-1 < tabsPosition) {
				// Find the tabs HTML beginning exact position.
				while ('<' !== settingHtml[tabsPosition] && 0 < tabsPosition) {
					tabsPosition--;
				}

				if (-1 < tabsPosition) {
					aboveTabsHtml = settingHtml.substr(0, tabsPosition);

					var tabsHtml = $('.wrap .nav-tab-wrapper').clone().wrap('<div>').parent().html();

					$.ajax({
						url        : ajaxurl + '?' + $.param({
							action   : '<?php echo $fs->get_ajax_action( 'store_tabs' ) ?>',
							security : '<?php echo $fs->get_ajax_security( 'store_tabs' ) ?>',
							module_id: '<?php echo $fs->get_id() ?>'
						}),
						method     : 'POST',
						data       : aboveTabsHtml + "\n" + tabsHtml + '</div>',
						dataType   : 'html',
						// Avoid escaping the HTML.
						processData: false
					});
				}
			}
		});
	})(jQuery);
</script>