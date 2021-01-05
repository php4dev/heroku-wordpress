<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


// Generate the Preview
add_action( 'init', 'buddyforms_preview_form' );
function buddyforms_preview_form() {
	if ( ! empty ( $_REQUEST['form_slug'] ) AND ! empty ( $_REQUEST['preview'] ) ) { //I

		// Get the Preview Page
		$preview_page_id = get_option( 'buddyforms_preview_page', true );

		// Check if the preview Page is displayed and get out of here if not.
		if ( $preview_page_id != $_REQUEST['page_id'] ) {
			return;
		}

		// Add the Preview Form to the Content with the content filter
		add_filter( 'the_content', 'buddyforms_append_preview_page', 9999 );
	}
}

/**
 * @param $content
 *
 * @return string
 */
function buddyforms_append_preview_page( $content ) {

	// GHet the form slug from the url parameter
	$form_slug = $_REQUEST['form_slug'];

	// Create the array for the form
	$args = array(
		'form_slug' => $form_slug,
	);

	// get the preview form
	ob_start();
	buddyforms_create_edit_form( $args );
	$bf_form = ob_get_clean();

	// Add the preview form to the content
	$content .= $bf_form;

	return $content;

}