<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

//Leaven empty tag to let automation add the path disclosure line
?>
<div class="notice notice-error">
	<div style="color:#b22222;"><?php _e( 'This Form is Broken!', 'buddyforms' ); ?></div>
	<?php foreach ( $messages as $message ) : ?>
		<?php echo sprintf( '<p>%s</p>', $message ); ?>
	<?php endforeach; ?>
</div>