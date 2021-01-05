<?php
/**
 * WebP meta box.
 *
 * @since 3.8.0
 * @package WP_Smush
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

$webp          = WP_Smush::get_instance()->core()->mod->webp;
$is_configured = $webp->is_configured();
?>

<p>
	<?php
	esc_html_e( "Serve WebP versions of your images to supported browsers, and gracefully fall back on JPEGs and PNGs for browsers that don't support WebP.", 'wp-smushit' );
	?>
</p>

<span class="sui-settings-label" style="font-size:13px;color:#333333;font-weight: bold;">
	<?php esc_html_e( 'Status', 'wp-smushit' ); ?>
</span>

<?php if ( $is_configured ) : ?>
	<div class="sui-notice sui-notice-success">
		<div class="sui-notice-content">
			<div class="sui-notice-message">
				<i class="sui-notice-icon sui-icon-info sui-md" aria-hidden="true"></i>
				<p>
					<?php
					if ( ! isset( $_SERVER['WPMUDEV_HOSTED'] ) ) :
						esc_html_e( 'WebP conversion is active and working well.', 'wp-smushit' );
					else :
						if ( ! apply_filters( 'wpmudev_branding_hide_branding', false ) ) :
							esc_html_e( 'WebP conversion is active and working well. Since your site is hosted with WPMU DEV, WebP conversion has been automatically configured and no further actions are required.', 'wp-smushit' );
						else :
							esc_html_e( 'WebP conversion is active and working well. Your hosting has automatically pre-configured the conversion for you and no further actions are required.', 'wp-smushit' );
						endif;
					endif;
					?>
				</p>
				<?php if ( ! WP_Smush::get_instance()->core()->s3->setting_status() ) : ?>
					<p>
						<?php
						printf(
							/* translators: 1. opening 'b' tag, 2. closing 'b' tag */
							esc_html__( '%1$sNote:%2$s We noticed the Amazon S3 Integration is enabled. Offloaded images will not be served in WebP format, but Smush will still create local WebP copies of all images. If this is undesirable, please deactivate the WebP module below.', 'wp-smushit' ),
							'<b>',
							'</b>'
						);
						?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php else : ?>
	<div class="sui-notice sui-notice-warning">
		<div class="sui-notice-content">
			<div class="sui-notice-message">
				<i class="sui-notice-icon sui-icon-warning-alert sui-md" aria-hidden="true"></i>
				<?php if ( 'apache' === $webp->get_server_type() && $webp->is_htaccess_written() ) : ?>
					<p><?php esc_html_e( 'The rules have been applied, however, the images have still not been converted to WebP.  We recommend to contact your server provider to know more about the cause of this issue.', 'wp-smushit' ); ?></p>
				<?php else : ?>
					<p><?php esc_html_e( "Server configurations haven't been applied yet. Make configurations below to start serving images in WebP format.", 'wp-smushit' ); ?></p>
				<?php endif; ?>

				<?php if ( ! WP_Smush::get_instance()->core()->s3->setting_status() ) : ?>
					<p>
						<?php
						printf(
							/* translators: 1. opening 'b' tag, 2. closing 'b' tag */
							esc_html__( '%1$sNote:%2$s We noticed the Amazon S3 Integration is enabled. Offloaded images will not be served in WebP format, but Smush will still create local WebP copies of all images. If this is undesirable, please deactivate the WebP module below.', 'wp-smushit' ),
							'<b>',
							'</b>'
						);
						?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<div class="sui-box-settings-row">
	<div class="sui-box-settings-col-1">
		<span class="sui-settings-label">
			<?php esc_html_e( 'Supported Media Types', 'wp-smushit' ); ?>
		</span>
		<span class="sui-description">
			<?php esc_html_e( 'Here\'s a list of the media types that will be converted to WebP format.', 'wp-smushit' ); ?>
		</span>
	</div>
	<div class="sui-box-settings-col-2">
		<span class="smush-filename-extension smush-extension-jpg">
			<?php esc_html_e( 'jpg', 'wp-smushit' ); ?>
		</span>
		<span class="smush-filename-extension smush-extension-png">
			<?php esc_html_e( 'png', 'wp-smushit' ); ?>
		</span>
	</div>
</div>

<?php if ( $is_configured ) : ?>

	<div class="sui-box-settings-row">
		<div class="sui-box-settings-col-1">
			<span class="sui-settings-label">
				<?php esc_html_e( 'Revert WebP Conversion', 'wp-smushit' ); ?>
			</span>
			<span class="sui-description"><?php esc_html_e( 'If your server storage space is full, use this feature to revert the WebP conversions by deleting all generated files. The files will fall back to normal PNGs or JPEGs once you delete them.', 'wp-smushit' ); ?></span>
		</div>

		<div class="sui-box-settings-col-2">
			<button
				type="button"
				class="sui-button sui-button-ghost"
				id="wp-smush-webp-delete-all-modal-open"
				data-modal-open="wp-smush-wp-delete-all-dialog"
				data-modal-close-focus="wp-smush-webp-delete-all-modal-open"
			>
				<span class="sui-loading-text">
					<i class="sui-icon-trash" aria-hidden="true"></i>
					<?php esc_html_e( 'Delete WebP Files', 'wp-smushit' ); ?>
				</span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>

			<span class="sui-description">
				<?php
				esc_html_e( 'Note: This feature won’t delete the WebP files converted via CDN, only the files generated via the local WebP feature.', 'wp-smushit' );
				?>
			</span>
		</div>
	</div>

	<div class="sui-box-settings-row">
		<div class="sui-box-settings-col-1">
			<span class="sui-settings-label">
				<?php esc_html_e( 'Deactivate', 'wp-smushit' ); ?>
			</span>

			<span class="sui-description">
				<?php esc_html_e( 'If you no longer require your images to be served in WebP format, you can disable this feature.', 'wp-smushit' ); ?>
			</span>
		</div>

		<div class="sui-box-settings-col-2">
			<p class="sui-description" style="margin-bottom: 5px;">
				<?php esc_html_e( 'Note: Deactivation won’t delete existing WebP images.', 'wp-smushit' ); ?>
			</p>

			<button class="sui-button sui-button-ghost" id="smush-toggle-webp-button" data-action="disable">
				<span class="sui-loading-text">
					<i class="sui-icon-power-on-off" aria-hidden="true"></i><?php esc_html_e( 'Deactivate', 'wp-smushit' ); ?>
				</span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>
		</div>
	</div>

<?php endif; ?>
<?php $this->view( 'webp-delete-all', array(), 'modals' ); ?>
