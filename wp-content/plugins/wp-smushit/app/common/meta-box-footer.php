<?php
/**
 * Footer meta box, common to one or more modules.
 *
 * @since 3.2.0
 * @package WP_Smush
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

$current_tab = $this->get_current_tab();
$button_msg  = 'bulk' === $current_tab ? '' : __( 'Updating settings...', 'wp-smushit' );
$button_text = __( 'Update settings', 'wp-smushit' );

/**
 * Filter to enable/disable submit button in integration settings.
 *
 * @param bool $show_submit Should show submit?
 */
$disabled = 'integrations' === $current_tab ? apply_filters( 'wp_smush_integration_show_submit', false ) : false;

if ( 'cdn' === $current_tab && ! WP_Smush::get_instance()->core()->mod->cdn->get_status() ) {
	$button_text = __( 'Save & Activate', 'wp-smushit' );
	$button_msg  = __( 'Activating CDN...', 'wp-smushit' );
}
?>

<div class="sui-actions-right">
	<?php if ( 'integrations' === $current_tab || 'bulk' === $current_tab ) : ?>
		<label id="smush-submit-description">
			<?php esc_html_e( 'Smush will automatically check for any images that need re-smushing.', 'wp-smushit' ); ?>
		</label>
	<?php endif; ?>

	<button type="submit" class="sui-button sui-button-blue" id="wp-smush-save-settings" aria-describedby="smush-submit-description" data-msg="<?php echo esc_attr( $button_msg ); ?>" <?php disabled( $disabled, false, false ); ?>>
		<i class="sui-icon-save" aria-hidden="true"></i>
		<?php echo esc_html( $button_text ); ?>
	</button>

	<span class="sui-icon-loader sui-loading sui-hidden"></span>
</div>
