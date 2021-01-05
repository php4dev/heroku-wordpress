<?php
/**
 * Render Smush NextGen pages.
 *
 * @package WP_Smush
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

$this->do_meta_boxes( 'summary' );
$this->do_meta_boxes( 'bulk' );

?>

<div class="sui-footer">
	<?php esc_html_e( 'Made with', 'wp-smushit' ); ?> <i class="sui-icon-heart" aria-hidden="true"></i> <?php esc_html_e( 'by WPMU DEV', 'wp-smushit' ); ?>
</div>

<ul class="sui-footer-nav">
	<li><a href="https://premium.wpmudev.org/hub/" target="_blank">
			<?php esc_html_e( 'The Hub', 'wp-smushit' ); ?>
		</a></li>
	<li><a href="https://premium.wpmudev.org/projects/category/plugins/" target="_blank">
			<?php esc_html_e( 'Plugins', 'wp-smushit' ); ?>
		</a></li>
	<li><a href="https://premium.wpmudev.org/roadmap/" target="_blank">
			<?php esc_html_e( 'Roadmap', 'wp-smushit' ); ?>
		</a></li>
	<li><a href="https://premium.wpmudev.org/hub/support/" target="_blank">
			<?php esc_html_e( 'Support', 'wp-smushit' ); ?>
		</a></li>
	<li><a href="https://premium.wpmudev.org/docs/" target="_blank">
			<?php esc_html_e( 'Docs', 'wp-smushit' ); ?>
		</a></li>
	<li><a href="https://premium.wpmudev.org/hub/community/" target="_blank">
			<?php esc_html_e( 'Community', 'wp-smushit' ); ?>
		</a></li>
	<li><a href="https://premium.wpmudev.org/academy/" target="_blank">
			<?php esc_html_e( 'Academy', 'wp-smushit' ); ?>
		</a></li>
	<li><a href="https://premium.wpmudev.org/terms-of-service/" target="_blank">
			<?php esc_html_e( 'Terms', 'wp-smushit' ); ?></a>  &  <a href="https://incsub.com/privacy-policy/" target="_blank">
			<?php esc_html_e( 'Privacy', 'wp-smushit' ); ?>
		</a></li>
</ul>
