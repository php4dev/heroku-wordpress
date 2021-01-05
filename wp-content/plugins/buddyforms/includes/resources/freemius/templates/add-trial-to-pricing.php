<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } $fs = freemius( $VARS['id'] ); ?>
<script type="text/javascript">
	(function ($) {
		$(document).ready(function () {
			var $pricingMenu = $('.fs-submenu-item.<?php echo $fs->get_unique_affix() ?>.pricing'),
				$pricingMenuLink = $pricingMenu.parents('a');

			// Add trial querystring param.
			$pricingMenuLink.attr('href', $pricingMenuLink.attr('href') + '&trial=true');
		});
	})(jQuery);
</script>