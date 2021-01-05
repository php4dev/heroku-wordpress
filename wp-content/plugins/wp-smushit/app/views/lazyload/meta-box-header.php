<?php
/**
 * Lazy Load meta box header.
 *
 * @since 3.2.0
 * @package WP_Smush
 *
 * @var string $title    Title.
 * @var string $tooltip  Tooltip text.
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<h3 class="sui-box-title">
	<?php echo esc_html( $title ); ?>
</h3>

<span class="sui-tag sui-tag-beta sui-tooltip sui-tooltip-constrained" data-tooltip="<?php echo esc_attr( $tooltip ); ?>" style="margin-left: 10px">
	<?php esc_html_e( 'Beta', 'wp-smushit' ); ?>
</span>
