<?php
/**
 * Settings meta box.
 *
 * @since 3.0
 * @package WP_Smush
 *
 * @var string $site_language     Site language.
 * @var string $translation_link  Link to plugin translation page.
 * @var array  $settings          Settings values.
 * @var array  $settings_data     Settings labels and descriptions.
 * @var array  $settings_group    Settings group.
 * @var mixed  $networkwide       Network wide settings.
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<div class="sui-box-settings-row" xmlns="http://www.w3.org/1999/html">
	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label "><?php esc_html_e( 'Translations', 'wp-smushit' ); ?></span>
		<span class="sui-description">
			<?php
			printf(
				/* translators: %1$s: opening a tag, %2$s: closing a tag */
				esc_html__( 'By default, Smush will use the language you’d set in your %1$sWordPress Admin Settings%2$s if a matching translation is available.', 'wp-smushit' ),
				'<a href="' . esc_html( admin_url( 'options-general.php' ) ) . '">',
				'</a>'
			);
			?>
		</span>
	</div>
	<div class="sui-box-settings-col-2">
		<div class="sui-form-field">
			<label for="language-input" class="sui-label">
				<?php esc_html_e( 'Active Translation', 'wp-smushit' ); ?>
			</label>
			<input type="text" id="language-input" class="sui-form-control" disabled="disabled" placeholder="<?php echo esc_attr( $site_language ); ?>">
			<span class="sui-description">
				<?php
				printf(
					/* translators: %1$s: opening a tag, %2$s: closing a tag */
					esc_html__( 'Not using your language, or have improvements? Help us improve translations by providing your own improvements %1$shere%2$s.', 'wp-smushit' ),
					'<a href="' . esc_html( $translation_link ) . '" target="_blank">',
					'</a>'
				);
				?>
			</span>
		</div>
	</div>
</div>

<form id="wp-smush-settings-form" method="post">
	<input type="hidden" name="setting_form" id="setting_form" value="settings">
	<?php if ( is_multisite() && is_network_admin() ) : ?>
		<input type="hidden" name="setting-type" value="network">
	<?php endif; ?>

	<?php
	wp_nonce_field( 'save_wp_smush_options', 'wp_smush_options_nonce', '', true );
	foreach ( $settings_data as $name => $values ) {
		if ( ! in_array( $name, $settings_group, true ) ) {
			continue;
		}

		$label = ! empty( $settings_data[ $name ]['short_label'] ) ? $settings_data[ $name ]['short_label'] : $settings_data[ $name ]['label'];

		// Show settings option.
		$this->settings_row( WP_SMUSH_PREFIX . $name, $label, $name, $settings[ $name ] );
	}
	?>

	<?php if ( is_multisite() && is_network_admin() ) : ?>
	<div class="sui-box-settings-row">
		<div class="sui-box-settings-col-1">
			<span class="sui-settings-label"><?php echo esc_html( $settings_data['networkwide']['short_label'] ); ?></span>
			<span class="sui-description"><?php echo esc_html( $settings_data['networkwide']['desc'] ); ?></span>
		</div>

		<div class="sui-box-settings-col-2">
			<div class="sui-side-tabs sui-tabs">
				<div data-tabs>
					<?php $selected = is_array( $networkwide ) ? 'custom' : $networkwide; ?>
					<label for="access-none" class="sui-tab-item <?php echo ! $networkwide ? 'active' : ''; ?>">
						<input type="radio" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>subsite-access" value="0" id="access-none" <?php checked( $selected, false ); ?>>
						<?php esc_html_e( 'None', 'wp-smushit' ); ?>
					</label>
					<label for="access-all" class="sui-tab-item <?php echo '1' === $networkwide ? 'active' : ''; ?>">
						<input type="radio" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>subsite-access" value="1" id="access-all" <?php checked( $selected, '1' ); ?>>
						<?php esc_html_e( 'All', 'wp-smushit' ); ?>
					</label>
					<label for="access-custom" class="sui-tab-item <?php echo is_array( $networkwide ) ? 'active' : ''; ?>">
						<input type="radio" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>subsite-access" value="custom" id="access-custom" <?php checked( $selected, 'custom' ); ?>>
						<?php esc_html_e( 'Custom', 'wp-smushit' ); ?>
					</label>
				</div>

				<div data-panes>
					<div class="sui-notice sui-notice-info <?php echo ! $networkwide ? 'active' : ''; ?>">
						<div class="sui-notice-content">
							<div class="sui-notice-message">
								<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
								<p><?php esc_html_e( "Subsite admins can't override any module settings and will always inherit your network settings.", 'wp-smushit' ); ?></p>
							</div>
						</div>
					</div>
					<div class="sui-notice sui-notice-info <?php echo '1' === $networkwide ? 'active' : ''; ?>">
						<div class="sui-notice-content">
							<div class="sui-notice-message">
								<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
								<p><?php esc_html_e( 'Subsite admins can override all module settings.', 'wp-smushit' ); ?></p>
							</div>
						</div>
					</div>
					<div class="sui-tab-boxed <?php echo is_array( $networkwide ) ? 'active' : ''; ?>">
						<p class="sui-description">
							<?php esc_html_e( 'Choose which modules settings subsite admins have access to.', 'wp-smushit' ); ?>
						</p>

						<label class="sui-checkbox sui-checkbox-stacked sui-checkbox-sm">
							<input type="checkbox" id="module-bulk" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>access[]" value="bulk" <?php checked( ! is_array( $networkwide ) || in_array( 'bulk', $networkwide, true ) ); ?>>
							<span aria-hidden="true">&nbsp;</span>
							<span><?php esc_html_e( 'Bulk Smush', 'wp-smushit' ); ?></span>
						</label>
						<label class="sui-checkbox sui-checkbox-stacked sui-checkbox-sm">
							<input type="checkbox" id="module-integrations" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>access[]" value="integrations" <?php checked( ! is_array( $networkwide ) || in_array( 'integrations', $networkwide, true ) ); ?>>
							<span aria-hidden="true">&nbsp;</span>
							<span><?php esc_html_e( 'Integrations', 'wp-smushit' ); ?></span>
						</label>
						<label class="sui-checkbox sui-checkbox-stacked sui-checkbox-sm">
							<input type="checkbox" id="module-lazy_load" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>access[]" value="lazy_load" <?php checked( ! is_array( $networkwide ) || in_array( 'lazy_load', $networkwide, true ) ); ?>>
							<span aria-hidden="true">&nbsp;</span>
							<span><?php esc_html_e( 'Lazy Load', 'wp-smushit' ); ?></span>
						</label>
						<label class="sui-checkbox sui-checkbox-stacked sui-checkbox-sm">
							<input type="checkbox" id="module-cdn" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>access[]" value="cdn" <?php checked( ! is_array( $networkwide ) || in_array( 'cdn', $networkwide, true ) ); ?>>
							<span aria-hidden="true">&nbsp;</span>
							<span><?php esc_html_e( 'CDN', 'wp-smushit' ); ?></span>
						</label>
						<label class="sui-checkbox sui-checkbox-stacked sui-checkbox-sm">
							<input type="checkbox" id="module-tools" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>access[]" value="tools" <?php checked( ! is_array( $networkwide ) || in_array( 'tools', $networkwide, true ) ); ?>>
							<span aria-hidden="true">&nbsp;</span>
							<span><?php esc_html_e( 'Tools', 'wp-smushit' ); ?></span>
						</label>
						<?php // Don't display if Dashboard's whitelabel is hiding documentation. ?>
						<?php if ( ! apply_filters( 'wpmudev_branding_hide_doc_link', false ) ) : ?>
							<label class="sui-checkbox sui-checkbox-stacked sui-checkbox-sm">
								<input type="checkbox" id="module-tutorials" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>access[]" value="tutorials" <?php checked( ! is_array( $networkwide ) || in_array( 'tutorials', $networkwide, true ) ); ?>>
								<span aria-hidden="true">&nbsp;</span>
								<span><?php esc_html_e( 'Tutorials', 'wp-smushit' ); ?></span>
							</label>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="sui-box-settings-row smush-keep-data-form-row">
		<div class="sui-box-settings-col-1">
			<span class="sui-settings-label"><?php echo esc_html( $settings_data['keep_data']['short_label'] ); ?></span>
			<span class="sui-description"><?php echo esc_html( $settings_data['keep_data']['desc'] ); ?></span>
		</div>

		<div class="sui-box-settings-col-2">
			<?php if ( $this->should_render( 'tools' ) ) : ?>
				<strong><?php esc_html_e( 'Restore Images', 'wp-smushit' ); ?></strong>
				<span class="sui-description">
					<?php esc_html_e( 'Made a mistake? No worries. We have a built-in bulk restore tool that will restore your image thumbnails to their original state.', 'wp-smushit' ); ?>
				</span>
				<span class="sui-description sui-margin-bottom">
					<?php
					printf(
						/* translators: %1$s - <a> link, %2$s - </a> */
						esc_html__( 'Navigate to %1$sTools%2$s to begin the process.', 'wp-smushit' ),
						'<a href="' . esc_url( $this->get_page_url() ) . '&view=tools">',
						'</a>'
					);
					?>
				</span>
			<?php endif; ?>

			<strong><?php echo esc_html( $settings_data['keep_data']['label'] ); ?></strong>
			<span class="sui-description">
				<?php esc_html_e( 'When you uninstall the plugin, what do you want to do with your settings? You can save them for next time, or wipe them back to factory settings.', 'wp-smushit' ); ?>
			</span>

			<div class="sui-side-tabs">
				<div class="sui-tabs-menu">
					<label for="keep_data-true" class="sui-tab-item <?php echo $settings['keep_data'] ? 'active' : ''; ?>">
						<input type="radio" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>keep_data" value="1" id="keep_data-true" <?php checked( $settings['keep_data'] ); ?>>
						<?php esc_html_e( 'Keep', 'wp-smushit' ); ?>
					</label>

					<label for="keep_data-false" class="sui-tab-item <?php echo $settings['keep_data'] ? '' : 'active'; ?>">
						<input type="radio" name="<?php echo esc_attr( WP_SMUSH_PREFIX ); ?>keep_data" value="0" id="keep_data-false" <?php checked( ! $settings['keep_data'] ); ?>>
						<?php esc_html_e( 'Delete', 'wp-smushit' ); ?>
					</label>
				</div>
			</div>

			<strong><?php esc_html_e( 'Reset Factory Settings', 'wp-smushit' ); ?></strong>
			<span class="sui-description">
				<?php esc_html_e( 'Need to revert back to the default settings? This button will instantly reset your settings to the defaults.', 'wp-smushit' ); ?>
			</span>

			<button class="sui-button sui-button-ghost" data-modal-open="wp-smush-reset-settings-dialog" data-modal-open-focus="reset-setting-confirm" data-modal-mask="true">
				<i class="sui-icon-undo" aria-hidden="true"></i>
				<?php esc_html_e( 'Reset Settings', 'wp-smushit' ); ?>
			</button>
		</div>
	</div>

	<div class="sui-box-settings-row">
		<div class="sui-box-settings-col-1">
			<span class="sui-settings-label"><?php echo esc_html( $settings_data['api_auth']['short_label'] ); ?></span>
			<span class="sui-description"><?php echo esc_html( $settings_data['api_auth']['desc'] ); ?></span>
		</div>

		<div class="sui-box-settings-col-2">
			<button type="button" class="sui-button sui-button-ghost" id="wp-smush-update-api-status">
				<span class="sui-loading-text">
					<i class="sui-icon-undo" aria-hidden="true"></i>
					<?php esc_html_e( 'Update API status', 'wp-smushit' ); ?>
				</span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>
		</div>
	</div>

</form>

<?php $this->view( 'reset-settings', array(), 'modals' ); ?>
