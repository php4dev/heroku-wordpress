<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * The users submissions loop
 *
 * This template can be overridden by copying it to yourtheme/buddyforms/the-loop.php.
 *
 */

$wp_date_format = get_option( 'date_format' );
if ( empty( $wp_date_format ) ) {
	$wp_date_format = 'M j, Y';
}


ob_start();
require( BUDDYFORMS_INCLUDES_PATH . '/resources/pfbc/Style/LoopStyle.php' );
$css = ob_get_clean();
echo buddyforms_minify_css( $css );
?>

	<div id="buddyforms-list-view" class="buddyforms_posts_list buddyforms-posts-container">

		<?php if ( $the_lp_query->have_posts() ) : ?>

			<ul class="buddyforms-list buddyforms-posts-content" role="main">

				<?php while ( $the_lp_query->have_posts() ) : $the_lp_query->the_post();

					$form_slug = apply_filters( 'buddyforms_loop_form_slug', $form_slug, get_the_ID() );

					$bf_date_time_format = apply_filters( 'buddyforms_the_loop_date_format', $wp_date_format, $form_slug );

					$the_permalink = get_permalink();
					if ( isset( $buddyforms[ $form_slug ]['post_type'] ) && $buddyforms[ $form_slug ]['post_type'] == 'bf_submissions' ) {
						$the_permalink = '#';
					}

					$post_status      = get_post_status();
					$post_status_css  = buddyforms_get_post_status_css_class( $post_status, $form_slug );
					$post_status_name = buddyforms_get_post_status_readable( $post_status );

					?>

					<li id="bf_post_li_<?php the_ID() ?>" class="bf-submission <?php echo $post_status_css; ?> bf_posts_<?php the_ID() ?>">

						<?php // Create the modal for the submissions single view
						if ( isset( $buddyforms[ $form_slug ]['post_type'] ) && $buddyforms[ $form_slug ]['post_type'] == 'bf_submissions' ) { ?>
							<div style="display:none;" id="bf-submission-modal_<?php the_ID() ?>">
								<?php buddyforms_locate_template( 'submission-single', $form_slug ); ?>
							</div>
						<?php } ?>

						<div class="item">
							<div class="item-thumb">
								<?php
								$post_thumbnail = get_the_post_thumbnail( get_the_ID(), array(
									150,
									150
								), array( 'class' => "thumb" ) );
								$post_thumbnail = apply_filters( 'buddyforms_loop_thumbnail', $post_thumbnail );

								$the_title = get_the_title();

								if ( $the_title == 'none' ) {
									$the_subject = get_post_meta( get_the_id(), 'subject', true );

									if ( $the_subject ) {
										$the_title = $the_subject;
									}
								}
								?>

								<a class="" data-id="<?php the_ID() ?>"
								   href="<?php echo $the_permalink; ?>"><?php echo $post_thumbnail ?></a>
							</div>

							<div class="item-title">
								<a class="<?php echo ( isset( $buddyforms[ $form_slug ]['post_type'] ) && $buddyforms[ $form_slug ]['post_type'] == 'bf_submissions' ) ? 'bf-submission-modal' : '' ?> "
								   data-id="<?php the_ID() ?>"
								   href="<?php echo $the_permalink; ?>"
								   rel="bookmark"
								   title="<?php _e( 'Permanent Link to', 'buddyforms' ) ?> <?php the_title_attribute(); ?>"><?php echo $the_title; ?>
								</a>
								<?php do_action( 'buddyforms_the_loop_item_title_after', get_the_ID() ); ?>
							</div>

							<div class="item-desc"><?php echo wp_trim_words( buddyforms_get_the_excerpt(), 9, '...' ); ?></div>

							<?php do_action( 'buddyforms_the_loop_item_excerpt_after', get_the_ID() ); ?>

						</div>

						<?php
						$the_author_id = apply_filters( 'buddyforms_the_loop_item_author_id', get_the_author_meta( 'ID' ), $form_slug, get_the_ID() );
						ob_start();
						?>

						<div class="action">
							<div class="meta">
								<div class="item-status"><?php echo $post_status_name; ?></div>
								<?php buddyforms_post_entry_actions( $form_slug ); ?>
								<?php do_action( 'buddyforms_the_loop_after_actions', get_the_ID(), $form_slug ); ?>
								<div class="publish-date"><?php _e( 'Created ', 'buddyforms' ); ?><?php the_time( $bf_date_time_format ) ?></div>
							</div>
						</div>

						<?php echo apply_filters( 'buddyforms_the_loop_meta_html', ob_get_clean() ); ?>

						<?php do_action( 'buddyforms_the_loop_li_last', get_the_ID(), $form_slug ); ?>

						<div class="clear"></div>

					</li>

					<?php do_action( 'buddyforms_after_loop_item', get_the_ID(), $form_slug ) ?>

				<?php endwhile; ?>

			</ul>

			<div class="navigation">
				<?php if ( function_exists( 'wp_pagenavi' ) ) : ?>
					<?php wp_pagenavi(); ?>

				<?php else: ?>
					<div class="alignleft"><?php next_posts_link( '&larr;' . __( 'Previous Entries', 'buddyforms' ), $the_lp_query->max_num_pages ) ?></div>
					<div class="alignright"><?php previous_posts_link( __( 'Next Entries ', 'buddyforms' ) . '&rarr;' ) ?></div>
				<?php endif; ?>

			</div>

		<?php else : ?>

			<div id="message" class="info">
				<p><?php echo $empty_post_message; ?></p>
			</div>

		<?php endif; ?>

		<div class="bf_modal">
			<div style="display: none;"><?php wp_editor( '', 'buddyforms_form_content' ); ?></div>
		</div>

	</div>

<?php wp_reset_query();
