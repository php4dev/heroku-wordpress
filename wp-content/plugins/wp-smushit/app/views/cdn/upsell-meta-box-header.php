<?php
/**
 * Upsell CDN meta box header.
 *
 * @since 3.0
 * @package WP_Smush
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

$tooltip = __( 'Join WPMU DEV to host your images on our blazing fast global CDN', 'wp-smushit' );
?>

<h3 class="sui-box-title">
	<?php echo esc_html( $title ); ?>
</h3>

<div class="sui-actions-left">
	<span class="sui-tag sui-tag-pro sui-tooltip sui-tooltip-constrained" data-tooltip="<?php echo esc_attr( $tooltip ); ?>">
		<?php esc_html_e( 'Pro', 'wp-smushit' ); ?>
	</span>
</div>
