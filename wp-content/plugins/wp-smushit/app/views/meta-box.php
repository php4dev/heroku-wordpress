<?php
/**
 * Meta box layout.
 *
 * @package WP_Smush
 *
 * @var \Smush\App\Abstract_Page $this
 *
 * @var array  $callback         Callback for meta box content.
 * @var array  $callback_footer  Callback for meta box footer.
 * @var array  $callback_header  Callback for meta box header.
 * @var string $orig_id          Meta box ID.
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<div id="smush-box-<?php echo esc_attr( $id ); ?>" class="sui-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( $args['box_class'] ); ?>">

	<?php if ( is_callable( $callback_header ) ) : ?>
		<div class="<?php echo esc_attr( $args['box_header_class'] ); ?>">
			<?php call_user_func( $callback_header ); ?>
		</div><!-- end sui-box-title -->
	<?php elseif ( $this->view_exists( $orig_id . '/meta-box-header' ) ) : ?>
		<div class="<?php echo esc_attr( $args['box_header_class'] ); ?>">
			<?php
			$this->view(
				$orig_id . '/meta-box-header',
				array(
					'title' => $title,
				)
			);
			?>
		</div><!-- end sui-box-title -->
	<?php elseif ( $title ) : ?>
		<div class="<?php echo esc_attr( $args['box_header_class'] ); ?>">
			<h3  class="sui-box-title"><?php echo esc_html( $title ); ?></h3>
		</div><!-- end sui-box-title -->
	<?php endif; ?>

	<?php if ( $args['box_content_class'] ) : ?>
		<div class="<?php echo esc_attr( $args['box_content_class'] ); ?>">
			<?php if ( is_callable( $callback ) ) : ?>
				<?php call_user_func( $callback ); ?>
			<?php else : ?>
				<?php $this->view( $orig_id . '-meta-box' ); ?>
			<?php endif; ?>
		</div><!-- end box_content_class -->
		<?php
	else :
		if ( is_callable( $callback ) ) {
			call_user_func( $callback );
		} else {
			$this->view( $orig_id . '-meta-box' );
		}
	endif;
	?>

	<?php if ( is_callable( $callback_footer ) ) : ?>
		<div class="<?php echo esc_attr( $args['box_footer_class'] ); ?>">
			<?php call_user_func( $callback_footer ); ?>
		</div><!-- end sui-box-footer -->
	<?php elseif ( $this->view_exists( $orig_id . '/meta-box-footer' ) ) : ?>
		<div class="<?php echo esc_attr( $args['box_footer_class'] ); ?>">
			<?php $this->view( $orig_id . '/meta-box-footer' ); ?>
		</div><!-- end sui-box-footer -->
	<?php endif; ?>

	<?php
	// Allows you to output any content within the stats box at the end.
	do_action( 'wp_smush_after_stats' );
	?>

</div><!-- end box-<?php echo esc_attr( $id ); ?> -->
