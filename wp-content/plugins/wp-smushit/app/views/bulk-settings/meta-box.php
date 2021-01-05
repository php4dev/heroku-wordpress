<?php
/**
 * Settings meta box.
 *
 * @package WP_Smush
 *
 * @var array $basic_features       Basic features list.
 * @var bool  $cdn_enabled          CDN status.
 * @var array $grouped_settings     Grouped settings that can be skipeed.
 * @var array $settings             Settings values.
 * @var array $settings_data        Settings labels and descriptions.
 */

use Smush\Core\Settings;

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<?php if ( WP_Smush::is_pro() && $cdn_enabled && Settings::can_access( 'bulk' ) ) : ?>
	<div class="sui-notice sui-notice-info">
		<div class="sui-notice-content">
			<div class="sui-notice-message">
				<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
				<p><?php esc_html_e( 'Your images are currently being served via the WPMU DEV CDN. Bulk smush will continue to operate as per your settings below and is treated completely separately in case you ever want to disable the CDN.', 'wp-smushit' ); ?></p>
			</div>
		</div>
	</div>
<?php endif; ?>

<form id="wp-smush-settings-form" method="post">
	<input type="hidden" name="setting_form" id="setting_form" value="bulk">
	<?php if ( is_multisite() && is_network_admin() ) : ?>
		<input type="hidden" name="setting-type" value="network">
		<div class="network-settings-wrapper">
	<?php endif; ?>

	<?php
	foreach ( $settings_data as $name => $value ) {
		// If not bulk settings - skip.
		if ( ! in_array( $name, $grouped_settings, true ) ) {
			continue;
		}

		// Skip premium features if not a member.
		if ( ! in_array( $name, $basic_features, true ) && ! WP_Smush::is_pro() ) {
			continue;
		}

		$setting_m_key = WP_SMUSH_PREFIX . $name;
		$setting_val   = empty( $settings[ $name ] ) ? false : $settings[ $name ];

		$label = ! empty( $value['short_label'] ) ? $value['short_label'] : $value['label'];

		// Show settings option.
		$this->settings_row( $setting_m_key, $label, $name, $setting_val );
	}

	// Hook after general settings.
	do_action( 'wp_smush_after_basic_settings' );

	if ( is_multisite() && is_network_admin() ) {
		echo '</div>';
	}
	?>
</form>
