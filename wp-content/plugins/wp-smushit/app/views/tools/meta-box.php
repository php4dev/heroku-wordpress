<?php
/**
 * Tools meta box.
 *
 * @since 3.2.1
 * @package WP_Smush
 *
 * @var array $settings
 * @var array $settings_data
 * @var array $grouped_settings
 * @var int   $backups_count
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<form id="wp-smush-settings-form" method="post">
	<input type="hidden" name="setting_form" id="setting_form" value="tools">
	<?php if ( is_multisite() && is_network_admin() ) : ?>
		<input type="hidden" name="setting-type" value="network">
	<?php endif; ?>

	<?php
	foreach ( $settings_data as $name => $values ) {
		// If not CDN setting - skip.
		if ( ! in_array( $name, $grouped_settings, true ) ) {
			continue;
		}

		$label = ! empty( $settings_data[ $name ]['short_label'] ) ? $settings_data[ $name ]['short_label'] : $settings_data[ $name ]['label'];

		// Show settings option.
		$this->settings_row( WP_SMUSH_PREFIX . $name, $label, $name, $settings[ $name ] );
	}
	?>

	<div class="sui-box-settings-row <?php echo WP_Smush::is_pro() ? '' : 'sui-disabled'; ?>">
		<div class="sui-box-settings-col-1">
			<span class="<?php echo WP_Smush::is_pro() ? 'sui-settings-label' : 'sui-settings-label-with-tag'; ?>">
				<?php echo esc_html( $settings_data['bulk_restore']['short_label'] ); ?>
				<?php if ( ! WP_Smush::is_pro() ) : ?>
					<span class="sui-tag sui-tag-pro"><?php esc_html_e( 'Pro', 'wp-smushit' ); ?></span>
				<?php endif; ?>
			</span>
			<span class="sui-description"><?php echo wp_kses_post( $settings_data['bulk_restore']['desc'] ); ?></span>
		</div>

		<div class="sui-box-settings-col-2">
			<button type="button" class="sui-button sui-button-ghost" onclick="WP_Smush.restore.init()" <?php disabled( ! $backups_count ); ?>>
				<i class="sui-icon-undo" aria-hidden="true"></i>
				<?php esc_html_e( 'Restore Thumbnails', 'wp-smushit' ); ?>
			</button>
			<span class="sui-description">
				<?php
				printf(
					/* translators: %1$s - a tag, %2$s - closing a tag */
					wp_kses( 'Note: This feature uses your original image uploads to regenerate thumbnails. If you have “%1$sSmush my original full size images%2$s” enabled, we can still restore your thumbnails, but the quality will reflect your compressed original image. ', 'wp-smushit' ),
					'<a href="' . esc_url( network_admin_url( 'admin.php?page=smush' ) ) . '">',
					'</a>'
				);
				?>
			</span>
		</div>
	</div>

</form>

<?php $this->view( 'restore-images', array(), 'modals' ); ?>
