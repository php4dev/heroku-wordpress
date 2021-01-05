<?php
/**
 * Integrations meta box
 *
 * @package WP_Smush
 *
 * @var Dashboard $this
 *
 * @var array  $basic_features    Basic features array.
 * @var bool   $is_pro            Is PRO user or not.
 * @var array  $integration_group Integration group.
 * @var array  $settings          Settings array.
 * @var array  $settings_data     Settings descriptions and labels.
 * @var string $upsell_url        Upsell URL.
 */

use Smush\App\Pages\Dashboard;

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<form id="wp-smush-settings-form" method="post">
	<input type="hidden" name="setting_form" id="setting_form" value="integrations">
	<?php if ( is_multisite() && is_network_admin() ) : ?>
		<input type="hidden" name="setting-type" value="network">
	<?php endif; ?>

	<?php
	wp_nonce_field( 'save_wp_smush_options', 'wp_smush_options_nonce', '', true );

	foreach ( $integration_group as $name ) {
		// Settings key.
		$setting_m_key = WP_SMUSH_PREFIX . $name;
		// Disable setting.
		$disable = apply_filters( 'wp_smush_integration_status_' . $name, false );
		// Gray out row, disable setting.
		$upsell = ( ! in_array( $name, $basic_features, true ) && ! $is_pro );
		// Current setting value.
		$setting_val = ( $upsell || empty( $settings[ $name ] ) || $disable ) ? 0 : $settings[ $name ];
		// Current setting label.
		$label = ! empty( $settings_data[ $name ]['short_label'] ) ? $settings_data[ $name ]['short_label'] : $settings_data[ $name ]['label'];

		// Show settings option.
		$this->settings_row( $setting_m_key, $label, $name, $setting_val, $disable, $upsell );

	}
	// Hook after showing integration settings.
	do_action( 'wp_smush_after_integration_settings' );
	?>
</form>

<?php if ( ! $is_pro ) : ?>
	<div class="sui-box-settings-row sui-upsell-row">
		<img class="sui-image sui-upsell-image sui-upsell-image-smush integrations-upsell-image" alt="" style="width: 80px"
			src="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/smush-graphic-integrations-upsell.png' ); ?>"
			srcset="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/smush-graphic-integrations-upsell@2x.png' ); ?> 2x">
		<div class="sui-notice sui-notice-purple smush-upsell-notice">
			<div class="sui-notice-content">
				<div class="sui-notice-message">
					<p>
						<?php
						printf(
							/* translators: %1$s - a href tag, %2$s - a href closing tag */
							esc_html__( 'Smush Pro supports hosting images on Amazon S3 and optimizing NextGen Gallery images directly through NextGen Gallery settings. %1$sTry it free%2$s with a WPMU DEV membership today!', 'wp-smushit' ),
							'<a href="' . esc_url( $upsell_url ) . '" target="_blank" title="' . esc_html__( 'Try Smush Pro for FREE', 'wp-smushit' ) . '">',
							'</a>'
						);
						?>
					</p>
					<p>
						<a href="<?php echo esc_url( $upsell_url ); ?>" target="_blank" class="sui-button sui-button-purple">
							<?php esc_html_e( 'Try Smush Pro for Free', 'wp-smushit' ); ?>
						</a>
					</p>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
