<?php
/**
 * Tutorials meta box.
 *
 * @since 3.7.1
 * @package WP_Smush
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

$tutorials = $this->get_tutorials_data();
?>

<p><?php esc_html_e( 'Read our practical Smush tutorials and discover how to harness her full image-optimizing potential.', 'wp-smushit' ); ?></p>

<div class="wp-smush-tutorials-section">

	<div class="sui-row">

		<?php foreach ( $tutorials as $index => $tutorial ) : ?>

			<?php if ( 0 !== $index && 0 === $index % 3 ) : ?>
				</div>
				<div class="sui-row">
			<?php endif; ?>

			<div class="sui-col-md-4">

				<div
					tabindex="0"
					role="link"
					class="wp-smush-tutorial-item"
					<?php /* translators: title of the article */ ?>
					aria-label="<?php printf( esc_html__( 'Read article %s', 'wp-smushit' ), esc_html( $tutorial['title'] ) ); ?>"
					data-href="<?php echo esc_url( $tutorial['url'] ); ?>"
					data-tutorial="<?php echo esc_attr( $index ); ?>"
				>
					<div tabindex="-1" class="wp-smush-tutorial-item-header" aria-hidden="true" style="background-image: url(<?php echo esc_url( WP_SMUSH_URL . 'app/assets/images/tutorials/' . $tutorial['thumbnail_full_2x'] ); ?>);"></div>

					<div class="wp-smush-tutorial-item-body">

						<h4 class="wp-smush-tutorial-item-title"><?php echo esc_html( $tutorial['title'] ); ?></h4>

						<p class="sui-description"><?php echo esc_html( $tutorial['content'] ); ?></p>

					</div>

					<div class="wp-smush-tutorial-item-footer">

						<p tabindex="-1" class="wp-smush-read-more" aria-hidden="true"><?php esc_html_e( 'Read article', 'wp-smushit' ); ?></p>

						<?php /* translators: number of minutes */ ?>
						<p class="wp-smush-reading-time"><span class="sui-icon-clock sui-sm" aria-hidden="true"></span> <?php printf( esc_html__( '%d min read', 'wp-smushit' ), esc_html( $tutorial['read_time'] ) ); ?></p>

					</div>

				</div>

			</div>

		<?php endforeach; ?>
	</div>

</div>
