<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Remove Scripts and Styles loaded by other plugins and themes if the BuddyForms Admin is displayed.
 *
 * @package buddyforms
 * @since 2.0.5
 */

// This functions create conflicts with WordPress.com and I think it is not needed anymore. It was importand before we switch from Bootstrap to jQuery.
// we should keep it and check if we get any support requests with plugin conflicts and than only dectivate the scripts loaded by this plugins.

//add_action( 'admin_enqueue_scripts', 'buddyforms_remove_admin_scripts', 9999, 1 );
function buddyforms_remove_admin_scripts( $hook_suffix ) {
	global $wp_scripts, $wp_styles, $post;

	// Add a check for WordPress.com to make sure its working on .com
	if( defined('VIP_GO_ENV')){
		return;
	}

	// Let us clean the BuddyForms admin views from unneeded styles and css
	if (
		( isset( $post ) && $post->post_type == 'buddyforms' && isset( $_GET['action'] ) && $_GET['action'] == 'edit'
		  || isset( $post ) && $post->post_type == 'buddyforms' && $hook_suffix == 'post-new.php' )
		|| $hook_suffix == 'buddyforms_page_buddyforms_submissions'
		|| $hook_suffix == 'buddyforms_page_buddyforms_settings'
	) {

		// Remove all code from the js and css added by other plugins. We not need it on the BuddyForms Views
		remove_all_actions( 'admin_head' );
		remove_all_actions( 'admin_print_styles' );
		remove_all_actions( 'admin_print_scripts' );
		remove_all_actions( 'admin_print_footer_scripts' );
		remove_all_actions( 'admin_footer' );

		// Attach the default filters back so we have all dependencies loaded
		require( ABSPATH . WPINC . '/default-filters.php' );


		// Remove css and js added by other plugins. We want to keep the conflicts out of our world ;)
		foreach ( $wp_scripts->registered as $handle ) :
			if ( ! ( preg_match( '/wp-admin/', $handle->src ) || preg_match( '/wp-includes/', $handle->src ) ) && ! empty( $handle->src ) ) {
				if ( $handle->src != 1 ) {
					if ( substr( $handle->handle, 0, 10 ) != 'buddyforms' && substr( $handle->handle, 0, 9 ) != 'fs_common' ) {
						wp_deregister_script( $handle->handle );
					}
				}
			}
		endforeach;

		// Same for the css WordPress edit screen is a mess of meta overwrites. So let us deregister any style left over from other plugins
		foreach ( $wp_styles->registered as $handle ) :
			if ( ! ( preg_match( '/wp-admin/', $handle->src ) || preg_match( '/wp-includes/', $handle->src ) ) && ! empty( $handle->src ) ) {
				if ( $handle->src != 1 ) {
					if ( substr( $handle->handle, 0, 10 ) != 'buddyforms' && substr( $handle->handle, 0, 9 ) != 'fs_common' ) {
						wp_deregister_style( $handle->handle );
					}
				}
			}
		endforeach;

	}
}
