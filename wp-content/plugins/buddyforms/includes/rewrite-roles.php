<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * handle custom page
 * do flush if changing rule, then reload the admin page
 *
 * @package BuddyForms
 * @since 0.3 beta
 */

add_action( 'init', 'buddyforms_attached_page_rewrite_rules' );
/**
 * @param bool $flush_rewrite_rules
 */
function buddyforms_attached_page_rewrite_rules( $flush_rewrite_rules = false ) {
	global $buddyforms;

	if ( ! $buddyforms ) {
		return;
	}

	foreach ( $buddyforms as $key => $buddyform ) {
		if ( ! empty( $buddyform['attached_page'] ) ) {
			$post_data = get_post( $buddyform['attached_page'], ARRAY_A ); // todo: remove this query and make the post_name available in the $buddyforms
			if ( ! empty( $post_data ) && ! empty( $post_data['post_name'] ) ) {
				add_rewrite_rule( $post_data['post_name'] . '/create/([^/]+)/([^/]+)/?', 'index.php?pagename=' . $post_data['post_name'] . '&bf_action=create&bf_form_slug=$matches[1]&bf_parent_post_id=$matches[2]', 'top' );
				add_rewrite_rule( $post_data['post_name'] . '/create/([^/]+)/?', 'index.php?pagename=' . $post_data['post_name'] . '&bf_action=create&bf_form_slug=$matches[1]', 'top' );
				add_rewrite_rule( $post_data['post_name'] . '/view/([^/]+)/?', 'index.php?pagename=' . $post_data['post_name'] . '&bf_action=view&bf_form_slug=$matches[1]', 'top' );
				add_rewrite_rule( $post_data['post_name'] . '/edit/([^/]+)/([^/]+)/?', 'index.php?pagename=' . $post_data['post_name'] . '&bf_action=edit&bf_form_slug=$matches[1]&bf_post_id=$matches[2]', 'top' );
				add_rewrite_rule( $post_data['post_name'] . '/revision/([^/]+)/([^/]+)/([^/]+)/?', 'index.php?pagename=' . $post_data['post_name'] . '&bf_action=revision&bf_form_slug=$matches[1]&bf_post_id=$matches[2]&bf_rev_id=$matches[3]', 'top' );
			}
		}
	}
	if ( $flush_rewrite_rules ) {
		flush_rewrite_rules();
	}

	do_action( 'buddyforms_after_attache_page_rewrite_rules', $flush_rewrite_rules );
}

/**
 * add the query vars
 *
 * @package BuddyForms
 * @since 0.3 beta
 */
add_filter( 'query_vars', 'buddyforms_attached_page_query_vars' );
/**
 * @param $query_vars
 *
 * @return array
 */
function buddyforms_attached_page_query_vars( $query_vars ) {

	$query_vars[] = 'bf_action';
	$query_vars[] = 'bf_form_slug';
	$query_vars[] = 'bf_post_id';
	$query_vars[] = 'bf_parent_post_id';
	$query_vars[] = 'bf_rev_id';
	$query_vars[] = 'form_slug';
	$query_vars[] = 'post_id';
	$query_vars[] = '_wpnonce';

	return $query_vars;
}

/**
 * rewrite the url of the edit-this-post link in the frontend
 *
 * @package BuddyForms
 * @since 0.3 beta
 */
add_filter( 'get_edit_post_link', 'buddyforms_my_edit_post_link', 1, 3 );
/**
 * @param $url
 * @param $post_ID
 *
 * @return string
 */
function buddyforms_my_edit_post_link( $url, $post_ID ) {
	global $buddyforms, $current_user;

	if ( is_admin() ) {
		return $url;
	}

	if ( ! isset( $buddyforms ) ) {
		return $url;
	}

	$the_post         = get_post( $post_ID );
	$post_type        = get_post_type( $the_post );
	$form_slug        = get_post_meta( $post_ID, '_bf_form_slug', true );
	$posttype_default = get_option( 'buddyforms_posttypes_default' );

	if ( ! $form_slug && isset( $posttype_default[ $post_type ] ) || $form_slug == 'none' && isset( $posttype_default[ $post_type ] ) ) {
		$form_slug = $posttype_default[ $post_type ];
	}

	if ( $form_slug == 'none' ) {
		return $url;
	}

	$the_author_id = apply_filters( 'buddyforms_the_author_id', $the_post->post_author, $form_slug, $post_ID );

	if ( $the_author_id != $current_user->ID ) {
		return $url;
	}

	if ( isset( $buddyforms[ $form_slug ]['edit_link'] ) && $buddyforms[ $form_slug ]['edit_link'] == 'none' ) {
		return $url;
	}

	if ( isset( $buddyforms[ $form_slug ]['edit_link'] ) && $buddyforms[ $form_slug ]['edit_link'] == 'my-posts-list' ) {
		return $url;
	}

	if ( isset( $buddyforms[ $form_slug ] ) && $buddyforms[ $form_slug ]['post_type'] == $post_type && ! empty( $buddyforms[ $form_slug ]['attached_page'] ) ) {

		$permalink = get_permalink( $buddyforms[ $form_slug ]['attached_page'] );
		$url       = $permalink . 'edit/' . $form_slug . '/' . $post_ID;

		return $url;
	}

	return $url;
}

/**
 * Retrieve edit posts link for post.
 *
 * Can be used within the WordPress loop or outside of it. Can be used with
 * pages, posts, attachments, and revisions.
 *
 * @param int $id Optional. Post ID.
 * @param string $context Optional, defaults to display. How to write the '&', defaults to '&amp;'.
 *
 * @return string The edit post link for the given post.
 * @since 2.3.0
 *
 */
function buddyforms_get_edit_post_link( $id = 0, $context = 'display' ) {
	if ( ! $post = get_post( $id ) ) {
		return $id;
	}

	if ( 'revision' === $post->post_type ) {
		$action = '';
	} elseif ( 'display' == $context ) {
		$action = '&amp;action=edit';
	} else {
		$action = '&action=edit';
	}

	$post_type_object = get_post_type_object( $post->post_type );
	if ( ! $post_type_object ) {
		return $id;
	}


	/**
	 * Filter the post edit link.
	 *
	 * @param string $link The edit link.
	 * @param int $post_id Post ID.
	 * @param string $context The link context. If set to 'display' then ampersands
	 *                        are encoded.
	 *
	 * @since 2.3.0
	 *
	 */
	return apply_filters( 'get_edit_post_link', admin_url( sprintf( $post_type_object->_edit_link . $action, $post->ID ) ), $post->ID, $context );
}

/**
 * Redirect Registration Page
 */
function buddyforms_registration_page_redirect() {
	global $pagenow;

	if ( ! isset( $_GET['action'] ) ) {
		return;
	}

	if ( ( strtolower( $pagenow ) == 'wp-login.php' ) && ( strtolower( $_GET['action'] ) == 'register' ) ) {

		$buddyforms_registration_page = get_option( 'buddyforms_registration_page' );

		if ( $buddyforms_registration_page != 'none' ) {
			$permalink = get_permalink( $buddyforms_registration_page );
			wp_redirect( $permalink );
		}

	}
}

add_filter( 'init', 'buddyforms_registration_page_redirect' );

/**
 * Redirect after login
 *
 * @param $redirect_to
 * @param $request
 * @param $user
 *
 * @return mixed|void
 */
function buddyforms_login_redirect( $redirect_to, $request, $user ) {
	global $pagenow;

	if ( ( strtolower( $pagenow ) == 'wp-login.php' ) ) {
		// Look for 'redirect_to'
		if ( isset( $_REQUEST['redirect_to'] ) && is_string( $_REQUEST['redirect_to'] ) && isset( $_REQUEST['log'] ) ) {
			if ( ! empty( $_REQUEST['form_slug'] ) && $_REQUEST['form_slug'] !== 'none' ) {
				$form_slug = buddyforms_sanitize_slug( $_REQUEST['form_slug'] );
				global $buddyforms;
				if ( ! empty( $buddyforms ) && isset( $buddyforms[ $form_slug ] ) && $buddyforms[ $form_slug ]['form_type'] === 'registration' ) {
					$redirect_url = apply_filters( 'buddyforms_login_form_redirect_url', $_REQUEST['redirect_to'] );
				}
			} else {
				$redirect_url = apply_filters( 'buddyforms_login_form_redirect_url', $_REQUEST['redirect_to'] );
			}

			if ( ! empty( $redirect_url ) ) {
				$redirect_to = $redirect_url;
			}

		}
	}

	return $redirect_to;
}

add_filter( 'login_redirect', 'buddyforms_login_redirect', 99999, 3 );

/**
 * Function to control how is processed the registration page
 *
 * @param $content
 *
 * @return mixed|string|void
 */
function buddyforms_registration_page_content( $content ) {
	global $post;

	if ( empty( $post ) || empty( $post->post_name ) ) {
		return $content;
	}

	$page_id = buddyforms_get_ID_by_page_name( $post->post_name );

	if ( empty( $page_id ) ) {
		return $content;
	}

	$buddyforms_registration_page = get_option( 'buddyforms_registration_page' );
	$buddyforms_registration_form = get_option( 'buddyforms_registration_form' );

	if ( empty( $buddyforms_registration_page ) || empty( $buddyforms_registration_form ) ) {
		return $content;
	}

	$bp_get_signup_slug = false;
	if ( function_exists( 'bp_get_signup_slug' ) ) {
		$bp_get_signup_slug = bp_get_signup_slug();
	}

	if ( ( $page_id == $buddyforms_registration_page || ( $bp_get_signup_slug !== false && $post->post_name == $bp_get_signup_slug ) ) && $buddyforms_registration_form != 'none' ) {
		if ( $buddyforms_registration_form == 'page' ) {
			$regpage = get_post( $buddyforms_registration_page );
			if ( ! empty( $regpage ) ) {
				// Remove the filter to make sure it not end up in a infinity loop
				remove_filter( 'the_content', 'buddyforms_registration_page_content', 99999 );

				$content = apply_filters( 'the_content', $regpage->post_content );
				$content = str_replace( ']]>', ']]&gt;', $content );

				// Rebuild the removed filters
				add_filter( 'the_content', 'buddyforms_registration_page_content', 99999 );

			}
		} else {
			$content = do_shortcode( '[bf form_slug="' . $buddyforms_registration_form . '"]' );
		}

		//Direct include of the assets with the new content because the normal flow not detect this new form to include the assets
		BuddyFormsAssets::front_js_css( $content, $buddyforms_registration_form );
		BuddyFormsAssets::load_tk_font_icons();
	}

	return $content;
}

add_filter( 'the_content', 'buddyforms_registration_page_content', 99999 );

function buddyforms_get_ID_by_page_name( $page_name ) {
	global $wpdb;
	$page_name_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s", $page_name ) );

	return $page_name_id;
}