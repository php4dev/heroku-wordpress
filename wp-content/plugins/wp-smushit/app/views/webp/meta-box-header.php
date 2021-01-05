<?php
/**
 * WebP meta box header.
 *
 * @package WP_Smush
 *
 * @var boolean $is_disabled   Whether the WebP module is disabled.
 * @var boolean $is_configured Whether WebP images are being served.
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<h3 class="sui-box-title">
	<?php esc_html_e( 'WebP', 'wp-smushit' ); ?>
</h3>

<span
	class="sui-tag sui-tag-beta sui-tooltip sui-tooltip-constrained"
	data-tooltip="<?php esc_attr_e( 'This feature is likely to work without issue, however our WebP is in beta stage and some issues are still present.', 'wp-smushit' ); ?>"
	style="margin-left: 10px"
>
	<?php esc_html_e( 'Beta', 'wp-smushit' ); ?>
</span>

<?php if ( ! $is_disabled ) : ?>
	<div class="sui-actions-right">
		<?php esc_html_e( 'Made changes?', 'wp-smushit' ); ?> &nbsp;
		<button type="button" id="smush-webp-recheck" class="sui-button sui-button-ghost" data-is-configured="<?php echo $is_configured ? '1' : '0'; ?>">
			<span class="sui-loading-text"><i class="sui-icon-update"></i><?php esc_html_e( 'Re-check status', 'wp-smushit' ); ?></span>
			<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
		</button>
	</div>
<?php endif; ?>
