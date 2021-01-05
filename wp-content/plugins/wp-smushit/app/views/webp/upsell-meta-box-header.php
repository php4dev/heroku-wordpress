<?php
/**
 * Upsell WebP meta box header.
 *
 * @since 3.8.0
 * @package WP_Smush
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<h3 class="sui-box-title">
	<?php esc_html_e( 'WebP', 'wp-smushit' ); ?>
</h3>

<div class="sui-actions-left">
	<span class="sui-tag sui-tag-pro sui-tooltip sui-tooltip-constrained" data-tooltip="<?php esc_attr_e( 'Join WPMU DEV to use this feature', 'wp-smushit' ); ?>">
		<?php esc_html_e( 'Pro', 'wp-smushit' ); ?>
	</span>
</div>
