<?php
/**
 * Notices template
 */
?>
<div class="notice notice-success is-dismissible <?php echo $this->plugin->name; ?>-notice-welcome">
	<p>
		<?php
		printf(
			/* translators: %s: Name of this plugin */
			__( 'Thank you for installing %1$s!', 'insert-headers-and-footers' ),
			$this->plugin->displayName
		);
		?>
		<a href="<?php echo $setting_page; ?>"><?php esc_html_e( 'Click here', 'insert-headers-and-footers' ); ?></a> <?php esc_html_e( 'to configure the plugin.', 'insert-headers-and-footers' ); ?>
	</p>
</div>
<script type="text/javascript">
	jQuery(document).ready( function($) {
		$(document).on( 'click', '.<?php echo $this->plugin->name; ?>-notice-welcome button.notice-dismiss', function( event ) {
			event.preventDefault();
			$.post( ajaxurl, {
				action: '<?php echo $this->plugin->name . '_dismiss_dashboard_notices'; ?>',
				nonce: '<?php echo wp_create_nonce( $this->plugin->name . '-nonce' ); ?>'
			});
			$('.<?php echo $this->plugin->name; ?>-notice-welcome').remove();
		});
	});
</script>
