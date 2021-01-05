<?php
/**
 * Lazy Load meta box header.
 *
 * @since 3.7.1
 * @package WP_Smush
 *
 * @var string $title Title.
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<h3 class="sui-box-title">
	<?php esc_html_e( 'Tutorials', 'wp-smushit' ); ?>
</h3>

<div class="sui-actions-right">
	<p class="sui-description"><a href="https://premium.wpmudev.org/blog/category/tutorials/" target="_blank">
		<span class="sui-icon-open-new-window sui-sm sui-blue" aria-hidden="true"></span>
		<?php esc_html_e( 'View All', 'wp-smushit' ); ?>
	</a></p>
</div>
