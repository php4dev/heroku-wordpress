<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


if(function_exists('register_block_type')) {
	// Require all needed files
	require_once( BUDDYFORMS_INCLUDES_PATH . 'gutenberg/shortcodes/shortcodes-to-blocks.php' );
}
/**
 * Add Gutenberg block category "BuddyForms"
 *
 * @since 2.3.1
 *
 */
function buddyforms_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'buddyforms',
				'title' => __( 'BuddyForms', 'buddyforms' ),
			),
		)
	);
}

add_filter( 'block_categories', 'buddyforms_block_category', 10, 2 );

/**
 * Load all the assets needed
 *
 * @since 2.3.1
 *
 * @todo: load only the js/ css needed by individual blocks. For now all css/is loaded.
 */
function buddyforms_editor_assets() {
	BuddyFormsAssets::front_js_css();
}

add_action( 'enqueue_block_editor_assets', 'buddyforms_editor_assets' );
