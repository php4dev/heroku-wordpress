<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } $VARS = isset($VARS) ? $VARS : array(); $fs = freemius( $VARS['module_id'] ); wp_enqueue_script( 'jquery' ); wp_enqueue_script( 'json2' ); fs_enqueue_local_script( 'postmessage', 'nojquery.ba-postmessage.min.js' ); fs_enqueue_local_script( 'fs-postmessage', 'postmessage.js' ); ?>
<?php if ( ! $fs->is_whitelabeled() ) : ?>
<div id="pframe"></div>
<script type="text/javascript">
	(function ($) {
		$(function () {
			var
				base_url = '<?php echo WP_FS__ADDRESS ?>',
				pframe = $('<i' + 'frame id="fs_promo_tab" src="' + base_url + '/promotional-tab/?<?php echo http_build_query($VARS) ?>#' + encodeURIComponent(document.location.href) + '" height="350" width="60" frameborder="0" style="  background: transparent; position: fixed; top: 20%; right: 0;" scrolling="no"></i' + 'frame>')
					.appendTo('#pframe');

			FS.PostMessage.init(base_url);
			FS.PostMessage.receive('state', function (state) {
				if ('closed' === state)
					$('#fs_promo_tab').css('width', '60px');
				else
					$('#fs_promo_tab').css('width', '345px');
			});
		});
	})(jQuery);
</script>
<?php endif ?>