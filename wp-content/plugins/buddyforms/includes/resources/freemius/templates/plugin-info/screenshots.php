<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } $plugin = $VARS['plugin']; $screenshots = $VARS['screenshots']; ?>
<ol>
	<?php $i = 0; foreach ( $screenshots as $s => $url ) : ?>
			<?php
 $url = 'http' . ( WP_FS__IS_HTTPS ? 's' : '' ) . ':' . $url; ?>
			<li>
				<a href="<?php echo $url ?>" title="<?php echo esc_attr( sprintf( fs_text_inline( 'Click to view full-size screenshot %d', 'view-full-size-x', $plugin->slug ), $i ) ) ?>"><img src="<?php echo $url ?>"></a>
			</li>
			<?php $i ++; endforeach ?>
</ol>
