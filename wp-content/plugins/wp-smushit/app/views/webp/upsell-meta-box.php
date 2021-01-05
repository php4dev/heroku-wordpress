<?php
/**
 * Upsell WebP meta box.
 *
 * @since 3.8.0
 * @package WP_Smush
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

$upgrade_url = add_query_arg(
	array(
		'utm_source'   => 'smush',
		'utm_medium'   => 'plugin',
		'utm_campaign' => 'smush_webp_upgrade_button',
	),
	$this->upgrade_url
);
?>

<div class="sui-message sui-no-padding">
	<span class="wp-smush-no-image">
		<img src="<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/smush-no-media.png' ); ?>" alt="<?php esc_html_e( 'Smush WebP', 'wp-smushit' ); ?>" />
	</span>

	<div class="sui-message-content">
		<p class="wp-smush-no-images-content">
			<?php
			esc_html_e(
				'Fix the "Serve images in next-gen format" Google PageSpeed recommendation by setting up this feature. Serve WebP versions of your images to supported browsers, and gracefully fall back on JPEGs and PNGs for browsers that don\'t support WebP.',
				'wp-smushit'
			);
			?>
		</p>
		<p>
			<a href="<?php echo esc_url( $upgrade_url ); ?>" class="sui-button sui-button-purple" target="_blank">
				<?php esc_html_e( 'UPGRADE', 'wp-smushit' ); ?>
			</a>
		</p>
	</div>
</div>
