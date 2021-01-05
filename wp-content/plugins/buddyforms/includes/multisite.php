<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * @return bool
 */
function buddyforms_is_multisite() {
	if ( is_multisite() ) {
		if ( apply_filters( 'buddyforms_enable_multisite', false ) ) {
			return true;
		}
	}

	return false;
}

/**
 * @param $form_slug
 *
 * @return bool
 */
function buddyforms_switch_to_form_blog( $form_slug ) {
	global $buddyforms;

	// return if not a network install
	if ( ! buddyforms_is_multisite() ) {
		return false;
	}

	// Check if the form has a blog id to switch to
	if ( isset( $buddyforms[ $form_slug ]['blog_id'] ) ) {
		switch_to_blog( $buddyforms[ $form_slug ]['blog_id'] );

		return true;
	}

	return false;
}