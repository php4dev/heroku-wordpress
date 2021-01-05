<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Create Blocks from Shortcodes
 *
 * @since 2.3.1
 *
 */
function buddyforms_shortcodes_to_block_init() {
	global $buddyforms;

	if ( empty( $buddyforms ) ) {
		return;
	}

	// Register block editor BuddyForms script.
	wp_register_script(
		'bf-embed-form',
		plugins_url( 'shortcodes-to-blocks.js', __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' )
	);

	//
	// Localize the BuddyForms script with all needed data
	//

	// All Forms as slug and label
	$forms = array();
	foreach ( $buddyforms as $form_slug => $form ) {
		$forms[ $form_slug ] = $form['name'];
	}
	wp_localize_script( 'bf-embed-form', 'buddyforms_forms', $forms );

	$forms = array();
	foreach ( $buddyforms as $form_slug => $form ) {
		if ( $form['form_type'] == 'registration' ) {
			$forms[ $form_slug ] = $form['name'];
		}
	}
	wp_localize_script( 'bf-embed-form', 'buddyforms_registration_forms', $forms );

	$forms = array();
	foreach ( $buddyforms as $form_slug => $form ) {
		if ( ! empty( $form['attached_page'] ) && $form['attached_page'] != 'none' ) {
			$forms[ $form_slug ] = $form['name'];
		}
	}
	wp_localize_script( 'bf-embed-form', 'buddyforms_post_forms', $forms );

	wp_localize_script( 'bf-embed-form', 'buddyforms_create_new_form_url', get_admin_url( get_current_blog_id(), 'post-new.php?post_type=buddyforms' ) );

	// All WordPress User Roles
	$roles = buddyform_get_role_names();
	wp_localize_script( 'bf-embed-form', 'buddyforms_roles', $roles );

	//
	// Embed a form
	//
	register_block_type( 'buddyforms/bf-insert-form', array(
		'attributes'      => array(
			'bf_form_slug' => array(
				'type' => 'string',
			)
		),
		'editor_script'   => 'bf-embed-form',
		'render_callback' => 'buddyforms_block_render_form',
	) );

	//
	// Embed a navigation
	//
	register_block_type( 'buddyforms/bf-navigation', array(
		'attributes'      => array(
			'bf_form_slug'     => array(
				'type' => 'string',
			),
			'bf_nav_style'     => array(
				'type' => 'string',
			),
			'bf_label_add'     => array(
				'type'    => 'string',
				'default' => __( 'Create', 'buddyforms' )
			),
			'bf_label_view'    => array(
				'type'    => 'string',
				'default' => __( 'Display', 'buddyforms' )
			),
			'bf_nav_separator' => array(
				'type'    => 'string',
				'default' => ' | '
			),

		),
		'editor_script'   => 'bf-embed-form',
		'render_callback' => 'buddyforms_block_navigation',
	) );

	//
	// Embed a login form
	//
	register_block_type( 'buddyforms/bf-embed-login-form', array(
		'attributes'      => array(
			'bf_form_slug'    => array(
				'type' => 'string',
			),
			'bf_redirect_url' => array(
				'type' => 'string',
			),
			'bf_title'        => array(
				'type' => 'string',
			),

		),
		'editor_script'   => 'bf-embed-form',
		'render_callback' => 'buddyforms_block_render_login_form',
	) );

	//
	// Embed a password reset form
	//
	register_block_type( 'buddyforms/bf-password-reset-form', array(
		'attributes'      => array(
			'bf_redirect_url' => array(
				'type' => 'string',
			),
		),
		'editor_script'   => 'bf-embed-form',
		'render_callback' => 'buddyforms_block_password_reset_form',
	) );

	//
	// Embed a post list
	//
	register_block_type( 'buddyforms/bf-list-submissions', array(
		'attributes'      => array(
			'bf_form_slug'        => array(
				'type' => 'string',
			),
			'bf_rights'           => array(
				'type'    => 'string',
				'default' => 'public'
			),
			'bf_by_author'        => array(
				'type' => 'string',
			),
			'bf_author_ids'       => array(
				'type' => 'string',
			),
			'bf_by_form'          => array(
				'type' => 'string',
			),
			'bf_posts_per_page'   => array(
				'type' => 'string',
			),
			'bf_list_posts_style' => array(
				'type' => 'string',
			),
		),
		'editor_script'   => 'bf-embed-form',
		'render_callback' => 'buddyforms_block_list_submissions',
	) );
}

add_action( 'init', 'buddyforms_shortcodes_to_block_init' );

/**
 * Render a Form
 *
 * @since 2.3.1
 *
 */
function buddyforms_block_render_form( $attributes ) {
	global $buddyforms;

	if ( isset( $attributes['bf_form_slug'] ) && isset( $buddyforms[ $attributes['bf_form_slug'] ] ) ) {
		return buddyforms_create_edit_form_shortcode( array( 'form_slug' => $attributes['bf_form_slug'] ) );
	} else {
		return '<p>' . __( 'Please select a form in the block settings sidebar!', 'buddyforms' ) . '</p>';
	}
}

/**
 * Render a login form
 *
 * @since 2.3.1
 *
 */
function buddyforms_block_render_login_form( $attributes ) {
	global $buddyforms;

	$attr = array(
		'form_slug'      => empty( $attributes['bf_form_slug'] ) ? 'none' : $attributes['bf_form_slug'],
		'redirect_url'   => empty( $attributes['bf_redirect_url'] ) ? '' : $attributes['bf_redirect_url'],
		'title'          => empty( $attributes['bf_title'] ) ? __( 'Login', 'buddyforms' ) : $attributes['bf_title'],
		'label_username' => empty( $attributes['bf_label_username'] ) ? __( 'Username or Email Address', 'buddyforms' ) : $attributes['bf_label_username'],
		'label_password' => empty( $attributes['bf_label_password'] ) ? __( 'Password', 'buddyforms' ) : $attributes['bf_label_password'],
		'label_remember' => empty( $attributes['bf_label_remember'] ) ? __( 'Remember Me', 'buddyforms' ) : $attributes['bf_label_remember'],
		'label_log_in'   => empty( $attributes['bf_label_log_in'] ) ? __( 'Log In', 'buddyforms' ) : $attributes['bf_label_log_in'],
	);

	return buddyforms_view_login_form( $attr );

}

/**
 * Render a password reset form
 *
 * @since 2.3.1
 *
 */
function buddyforms_block_password_reset_form( $attributes ) {

	$attr = array(
		'redirect_url' => empty( $attributes['bf_redirect_url'] ) ? '' : $attributes['bf_redirect_url'],
	);

	return buddyforms_reset_password_form( $attr );

}

/**
 * Render navigation to a post form
 *
 * @since 2.3.1
 *
 */
function buddyforms_block_navigation( $attributes ) {
	global $buddyforms;

	if ( isset( $attributes['bf_form_slug'] ) && isset( $buddyforms[ $attributes['bf_form_slug'] ] ) ) {

		$args = array(
			'form_slug'  => $attributes['bf_form_slug'],
			'separator'  => empty( $attributes['bf_nav_separator'] ) ? '' : $attributes['bf_nav_separator'],
			'label_add'  => empty( $attributes['bf_label_add'] ) ? __( 'Add', 'buddyforms' ) : $attributes['bf_label_add'],
			'label_view' => empty( $attributes['bf_label_view'] ) ? __( 'View', 'buddyforms' ) : $attributes['bf_label_view'],
		);

		if ( isset( $attributes['bf_nav_style'] ) ) {
			switch ( $attributes['bf_nav_style'] ) {
				case 'buddyforms_button_view_posts':
					return buddyforms_button_view_posts( $args );
					break;
				case 'buddyforms_button_add_new':
					return buddyforms_button_add_new( $args );
					break;

			}
		}


		return buddyforms_nav( $args );


	} else {
		return '<p>' . __( 'Please select a form in the block settings sidebar!', 'buddyforms' ) . '</p>';
	}
}


/**
 * Render a form submissions
 *
 * @since 2.3.1
 *
 */
function buddyforms_block_list_submissions( $attributes ) {
	global $buddyforms;

//	print_r($attributes);
	$display = false;

	if ( ! is_user_logged_in() && $attributes['bf_rights'] == 'public' ) {
		$display = true;
	}
	if ( is_user_logged_in() && $attributes['bf_rights'] == 'public' ) {
		$display = true;
	}
	if ( is_user_logged_in() && $attributes['bf_rights'] == 'private' ) {
		$display = true;
	}
	$user = wp_get_current_user();
	if ( is_user_logged_in() && in_array( $attributes['bf_rights'], (array) $user->roles ) ) {
		$display = true;
	}

	if ( $display ) {
		if ( isset( $attributes['bf_form_slug'] ) && isset( $buddyforms[ $attributes['bf_form_slug'] ] ) ) {

			$list_style           = empty( $attributes['bf_list_posts_style'] ) ? 'list' : $attributes['bf_list_posts_style'];
			$posts_per_page       = empty( $attributes['bf_posts_per_page'] ) ? '10' : $attributes['bf_posts_per_page'];
			$filter_by_author     = empty( $attributes['bf_by_author'] ) ? 'logged_in_user' : $attributes['bf_by_author'];
			$filter_by_author_ids = empty( $attributes['bf_author_ids'] ) ? '' : $attributes['bf_author_ids'];
			$bf_by_form           = empty( $attributes['bf_by_form'] ) ? 'form' : $attributes['bf_by_form'];

			ob_start();
			buddyforms_blocks_the_loop(
				array(
					'form_slug'        => $attributes['bf_form_slug'],
					'list_posts_style' => $list_style,
					'posts_per_page'   => $posts_per_page,
					'query_option'     => $filter_by_author,
					'author_ids'       => $filter_by_author_ids,
					'bf_by_form'       => $bf_by_form,
					'caller'           => 'buddyforms_list_all'

				)
			);
			$tmp = ob_get_clean();

			return $tmp;

		} else {
			return '<p>' . __( 'Please select a form in the block settings sidebar!', 'buddyforms' ) . '</p>';
		}
	}

	return '';
}


/**
 * Query posts for the submission lists
 *
 * @since 2.3.1
 *
 */
function buddyforms_blocks_the_loop( $args ) {
	global $the_lp_query, $buddyforms, $form_slug, $paged;

	$caller = $posts_per_page = $list_posts_style = $author = $author_ids = $bf_by_form = $post_type = $form_slug = $id = $post_parent = $query_option = $user_logged_in_only = $meta_key = $meta_value = '';

	// Enable other plugins to manipulate the arguments used for query the posts
	$args = apply_filters( 'buddyforms_the_loop_args', $args );

	extract( shortcode_atts( array(
		'author'              => '',
		'author_ids'          => '',
		'bf_by_form'          => '',
		'post_type'           => '',
		'form_slug'           => '',
		'id'                  => '',
		'caller'              => $caller,
		'post_parent'         => 0,
		'query_option'        => 'logged_in_user',
		'user_logged_in_only' => 'logged_in_only',
		'meta_key'            => '',
		'meta_value'          => '',
		'list_posts_style'    => 'none',
		'posts_per_page'      => '10'
	), $args ) );


	// if multi site is enabled switch to the form blog id
	buddyforms_switch_to_form_blog( $form_slug );

	if ( empty( $form_slug ) && ! empty( $id ) ) {
		$post      = get_post( $id );
		$form_slug = $post->post_name;
	}
	$args['form_slug'] = $form_slug;
	unset( $args['id'] );


	if ( empty( $post_type ) && ! empty( $buddyforms[ $form_slug ]['post_type'] ) ) {
		$post_type = $buddyforms[ $form_slug ]['post_type'];
	}

	if ( $list_posts_style == 'none' ) {
		$list_posts_style = isset( $buddyforms[ $form_slug ]['list_posts_style'] ) ? $buddyforms[ $form_slug ]['list_posts_style'] : 'list';
	}

	$posts_per_page = apply_filters( 'buddyforms_user_posts_query_args_posts_per_page', $posts_per_page );

	$post_status = apply_filters( 'buddyforms_blocks_the_loop_post_status', array(
		'publish',
		'pending',
		'draft',
		'future'
	), $form_slug );

	$paged = buddyforms_get_url_var( 'page' );

	if ( empty( $author ) ) {
		$author = get_current_user_id();
	}

	$the_author_id = apply_filters( 'buddyforms_the_loop_author_id', $author, $form_slug );

	if ( ! $the_author_id ) {
		$post_status = array( 'publish' );
	}

	switch ( $query_option ) {
		case 'logged_in_user':
			$query_args = array(
				'post_type'      => $post_type,
				'post_parent'    => $post_parent,
				'form_slug'      => $form_slug,
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per_page,
				'paged'          => $paged,
			);
			break;
		case 'author_ids':
			$query_args = array(
				'post_type'      => $post_type,
				'post_parent'    => $post_parent,
				'form_slug'      => $form_slug,
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per_page,
				'paged'          => $paged,
			);
			break;
		case 'list_all':
			$query_args = array(
				'post_type'      => $post_type,
				'post_parent'    => $post_parent,
				'form_slug'      => $form_slug,
				'post_status'    => $post_status,
				'posts_per_page' => $posts_per_page,
				'paged'          => $paged,

			);
			break;
		default:
			$query_args = array(
				'post_type'      => $post_type,
				'post_parent'    => $post_parent,
				'form_slug'      => $form_slug,
				'post_status'    => $post_status,
				'posts_per_page' => $posts_per_page,
				'paged'          => $paged,
			);
			break;

	}

	if ( $bf_by_form == 'form' ) {
		$query_args['meta_key']   = '_bf_form_slug';
		$query_args['meta_value'] = $form_slug;
	}

	if ( $query_option !== 'all_users' ) {
		if ( ! current_user_can( 'buddyforms_' . $form_slug . '_all' ) ) {
			$query_args['author'] = $the_author_id;
		}
	}

	$query_args = apply_filters( 'buddyforms_user_posts_query_args', $query_args );

	$the_lp_query = new WP_Query( $query_args );
	$the_lp_query = apply_filters( 'buddyforms_the_lp_query', $the_lp_query );

	$form_slug = $the_lp_query->query_vars['form_slug'];

	if ( $list_posts_style == 'table' ) {
		buddyforms_locate_template( 'the-table', $form_slug );
	} elseif ( $list_posts_style == 'list' ) {
		buddyforms_locate_template( 'the-loop', $form_slug );
	} else {
		buddyforms_locate_template( $list_posts_style, $form_slug );
	}

	wp_reset_postdata();

	do_action( 'buddyforms_the_loop_end', $query_args );

	// If multisite is enabled we should restore now to the current blog.
	if ( buddyforms_is_multisite() ) {
		restore_current_blog();
	}
}
