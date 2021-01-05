<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


// We need this function to support yoast seo. For a strange reason yoast seo remove the dashicons
add_action( 'template_include', 'buddyforms_template_include' );
function buddyforms_template_include( $template ) {

	$form_slug = get_query_var( 'bf_form_slug' );
	$action    = get_query_var( 'bf_action' );

	if ( ! empty( $form_slug ) ) {

		if ( $action == 'view' || $action == 'create' || $action == 'edit' || $action == 'revision' ) {
			remove_all_actions( 'wpseo_head' );
		}

	}

	return $template;
}

/**
 *
 * Check if a BuddyForms rewrite endpoint is displayed and overwrite the content with the correct content for the view
 *
 * @param $content
 *
 * @return string
 */
add_filter( 'the_content', 'buddyforms_attached_page_content', 50, 1 );
function buddyforms_attached_page_content( $content ) {
	global $buddyforms, $wp_query;

	$form_slug      = isset( $wp_query->query_vars['bf_form_slug'] ) ? $wp_query->query_vars['bf_form_slug'] : '';
	$post_id        = isset( $wp_query->query_vars['bf_post_id'] ) ? $wp_query->query_vars['bf_post_id'] : '';
	$parent_post_id = isset( $wp_query->query_vars['bf_parent_post_id'] ) ? $wp_query->query_vars['bf_parent_post_id'] : 0;
	$action         = isset( $wp_query->query_vars['bf_action'] ) ? $wp_query->query_vars['bf_action'] : '';

	// Remove the filter to make sure it not end up in a infinity loop
	remove_filter( 'the_content', 'buddyforms_attached_page_content', 50 );

	if ( ! is_admin() && ! empty( $buddyforms ) ) {
		if ( ! empty( $action ) && isset( $buddyforms[ $form_slug ]['post_type'] ) ) {
			$post_type   = $buddyforms[ $form_slug ]['post_type'];
			$new_content = '';
			$args        = array(
				'form_slug'   => $form_slug,
				'post_id'     => $post_id,
				'parent_post' => $parent_post_id,
				'post_type'   => $post_type
			);

			if ( $action == 'create' || $action == 'edit' || $action == 'revision' ) {
				ob_start();
				buddyforms_create_edit_form( $args );
				$bf_form = ob_get_clean();
				$new_content = $bf_form;
			}
			if ( $action == 'view' ) {
				ob_start();
				buddyforms_the_loop( $args );
				$bf_form = ob_get_clean();
				$new_content = $bf_form;
			}

			$content = $new_content;
		}
	}
	// Rebuild the removed filters
	add_filter( 'the_content', 'buddyforms_attached_page_content', 50, 1 );

	return $content;
}