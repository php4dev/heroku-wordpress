<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Adds a form shortcode for the create and edit screen
 *
 * @param $args
 * @param bool $echo
 *
 *
 * @return string|void
 * @since 2.4.0 The function only return string or empty
 *
 * @since 2.5.1 Added the parameter $echo to return the output instead of echo it directly
 */
function buddyforms_create_edit_form( $args, $echo = true ) {
	global $current_user, $buddyforms, $wp_query, $bf_form_response_args, $wp, $bf_form_error;

	if ( isset( $_REQUEST['form_slug'] ) && isset( $_REQUEST['post_id'] ) && isset( $_REQUEST['_wpnonce'] ) ) {
		$form_slug       = filter_var( $_REQUEST['form_slug'], FILTER_SANITIZE_STRING );
		$post_id         = filter_var( $_REQUEST['post_id'], FILTER_VALIDATE_INT );
		$transient_name  = sprintf( 'buddyforms_transit_post_page_%s_%s', $form_slug, $post_id );
		$transient_entry = get_transient( $transient_name );
		if ( ! empty( $transient_entry ) ) {
			/** @var ErrorHandler $global_error */
			ErrorHandler::set_instance( $transient_entry['error'] );
			$_POST = $transient_entry['post'];
		}
	}

	do_action( 'buddyforms_create_edit_form_loader' );

	// Hook for plugins to overwrite the $args.
	$args = apply_filters( 'buddyforms_create_edit_form_args', $args );

	$post_type   = '';
	$the_post    = 0;
	$post_id     = 0;
	$post_parent = 0;
	$post_status = '';
	$form_slug   = false;
	$form_notice = '';

	$short_array = shortcode_atts( array(
		'post_type'   => '',
		'the_post'    => 0,
		'post_id'     => 0,
		'post_parent' => 0,
		'form_slug'   => false,
		'form_notice' => '',
	), $args );

	extract( $short_array );

	if ( empty( $form_slug ) ) {
		return '';
	}

	if ( empty( $buddyforms[ $form_slug ] ) ) {
		return '';
	}

	buddyforms_switch_to_form_blog( $form_slug );

	$current_user = wp_get_current_user();

	if ( empty( $post_type ) ) {
		$post_type = $buddyforms[ $form_slug ]['post_type'];
	}

	if ( $buddyforms[ $form_slug ]['form_type'] == 'registration' && is_user_logged_in() ) {
		$current_user_entry = new WP_Query( array(
			'post_type'      => $post_type,
			'fields'         => 'ids',
			'posts_per_page' => '1',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'author'         => $current_user->ID,
			'meta_query'     => array(
				'relation' => 'AND',
				array(
					'key'   => '_bf_form_slug',
					'value' => sanitize_title( $form_slug ),
				)
			)
		) );
		if ( ! empty( $current_user_entry->posts ) ) {
			$post_id = $current_user_entry->posts[0];
		}
	}
	$form_output = '';
	ob_start();
	require( BUDDYFORMS_INCLUDES_PATH . '/resources/pfbc/Style/GlobalStyle.php' );
	$global_css = ob_get_clean();
	if ( ! empty( $global_css ) ) {
		$global_css = buddyforms_minify_css( $global_css );
		if ( $echo ) {
			echo $global_css;
		} else {
			$form_output .= $global_css;
		}
	}

	// if post edit screen is displayed in pages
	if ( ! empty( $wp_query->query_vars['bf_action'] ) ) {

		if ( ! empty( $wp_query->query_vars['bf_form_slug'] ) ) {
			$form_slug = $wp_query->query_vars['bf_form_slug'];
		}

		$post_id = 0;
		if ( ! empty( $wp_query->query_vars['bf_post_id'] ) ) {
			$post_id = $wp_query->query_vars['bf_post_id'];
		}

		$post_parent = 0;
		if ( ! empty( $wp_query->query_vars['bf_parent_post_id'] ) ) {
			$post_parent = $wp_query->query_vars['bf_parent_post_id'];
		}

		$revision_id = 0;
		if ( ! empty( $wp_query->query_vars['bf_rev_id'] ) ) {
			$revision_id = $wp_query->query_vars['bf_rev_id'];
		}

		$post_type = $buddyforms[ $form_slug ]['post_type'];

		if ( ! empty( $revision_id ) ) {
			$the_post = get_post( $revision_id );
		} else {
			$post_id  = apply_filters( 'buddyforms_create_edit_form_post_id', $post_id );
			$the_post = get_post( $post_id, 'OBJECT' );
		}

		if ( $wp_query->query_vars['bf_action'] == 'edit' ) {
			$the_post_form_slug = get_post_meta( $post_id, '_bf_form_slug', true );
			if ( $the_post_form_slug !== $form_slug ) {
				$error_message = apply_filters( 'buddyforms_form_slug_error_message', __( 'You are not allowed to edit this post. What are you doing here?', 'buddyforms' ) );
				$echo_content  = '<div class="bf-alert error">' . $error_message . '</div>';
				if ( $echo ) {
					echo $echo_content;

					return;
				} else {
					return $form_output . $echo_content;
				}
			}
			//Check if the post to edit match with the form setting
			if ( $the_post->post_type !== $post_type ) {
				$error_message = apply_filters( 'buddyforms_post_type_error_message', __( 'You are not allowed to edit this post. What are you doing here?', 'buddyforms' ) );
				$echo_content  = '<div class="bf-alert error">' . $error_message . '</div>';
				if ( $echo ) {
					echo $echo_content;

					return;
				} else {
					return $form_output . $echo_content;
				}
			}

			$user_can_edit = false;
			if ( ! bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_all', array(), $form_slug ) ) {
				$current_post_is_draft = $the_post->post_status == 'draft';
				$current_user_can_edit = bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_edit', array(), $form_slug );
				if ( $current_post_is_draft ) {
					//Let the user edit the draft until is published
					$current_user_can_create = bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_create', array(), $form_slug );
					$current_user_can_draft  = bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_draft', array(), $form_slug );
					$user_can_edit           = ( $current_user_can_draft || $current_user_can_edit ) && $current_user_can_create;
				} else {
					if ( $the_post->post_author == $current_user->ID && $current_user_can_edit ) {
						$user_can_edit = true;
					}
				}
			} else {
				$user_can_edit = true;
			}
			$user_can_edit = apply_filters( 'buddyforms_user_can_edit', $user_can_edit, $form_slug, $post_id );

			if ( $user_can_edit == false ) {
				$error_message = apply_filters( 'buddyforms_user_can_edit_error_message', __( 'You are not allowed to edit this post. What are you doing here?', 'buddyforms' ), $user_can_edit, $form_slug, $post_id );
				$echo_content  = '<div class="bf-alert error">' . $error_message . '</div>';
				if ( $echo ) {
					echo $echo_content;

					return;
				} else {
					return $form_output . $echo_content;
				}
			}
		}
	}

	// if post edit screen is displayed
	if ( ! empty( $post_id ) && $buddyforms[ $form_slug ]['form_type'] !== 'registration' ) {

		if ( ! empty( $revision_id ) ) {
			$the_post = get_post( $revision_id );
		} else {
			$post_id  = apply_filters( 'buddyforms_create_edit_form_post_id', $post_id );
			$the_post = get_post( $post_id );
		}
	}

	// If post_id == 0 a new post is created
	if ( $post_id == 0 ) {
		//check if auto-draft exist
		global $wpdb;
		$query   = $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} INNER JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id WHERE 1=1 AND post_title ='Auto Draft' AND post_content = '' AND post_author = %s AND post_type = %s AND {$wpdb->postmeta}.meta_key = '_bf_form_slug' AND {$wpdb->postmeta}.meta_value = %s ORDER BY ID DESC", $current_user->ID, $post_type, $form_slug );
		$post_id = (int) $wpdb->get_var( $query );
		if ( empty( $post_id ) ) {
			$the_post = bf_get_default_post_to_edit( $post_type, true );
			$post_id  = $the_post->ID;
			update_post_meta( $post_id, '_bf_form_slug', $form_slug );
		}
	}

	if ( empty( $post_type ) ) {
		$post_type = $the_post->post_type;//buddyforms??
	}

	if ( empty( $form_slug ) ) {
		$form_slug = apply_filters( 'buddyforms_the_form_to_use', $form_slug, $post_type );
	}

	if ( ! isset( $buddyforms[ $form_slug ]['form_fields'] ) ) {
		$error_message = apply_filters( 'buddyforms_no_form_elements_error_message', __( 'This form has no fields yet. Nothing to fill out so far. Add fields to your form to make it useful.', 'buddyforms' ) );
		$echo_content  = '<div class="bf-alert error">' . $error_message . '</div>';
		if ( $echo ) {
			echo $echo_content;
		} else {
			return $form_output . $echo_content;
		}
	}

	$customfields = ( ! empty( $buddyforms[ $form_slug ]['form_fields'] ) ) ? $buddyforms[ $form_slug ]['form_fields'] : array();

	if ( ! empty( $the_post ) ) {
		if ( empty( $post_parent ) && ! empty( $the_post->post_parent ) ) {
			$post_parent = $the_post->post_parent;
		}
		if ( empty( $post_status ) && ! empty( $the_post->post_status ) ) {
			$post_status = $the_post->post_status;
		}
	}

	$args = array(
		'post_type'    => $post_type,
		'the_post'     => $the_post,
		'post_parent'  => $post_parent,
		'post_status'  => $post_status,
		'customfields' => $customfields,
		'post_id'      => apply_filters( 'buddyforms_set_post_id_for_draft', $post_id, $args, $customfields ),
		'form_slug'    => $form_slug,
		'form_notice'  => $form_notice,
		'current_user' => $current_user,
		'action'       => ( isset( $wp_query->query_vars['bf_action'] ) ) ? $wp_query->query_vars['bf_action'] : 'save',
	);

	if ( isset( $_POST['bf_submitted'] ) ) {
		$args                 = isset( $bf_form_response_args ) ? $bf_form_response_args : $args;
		$args['current_user'] = $current_user;
	}

	$echo_content = buddyforms_form_html( $args );
	if ( $echo ) {
		echo $form_output . $echo_content;
	} else {
		return $form_output . $echo_content;
	}

	if ( ! empty( $transient_name ) ) {
		delete_transient( $transient_name );
	}

	if ( buddyforms_is_multisite() ) {
		restore_current_blog();
	}
}

/**
 * Default post information to use when populating the "Write Post" form.
 *
 * @note modification of the original function `get_default_post_to_edit` to not set any post format with `set_post_format`
 *
 * @param string $post_type Optional. A post type string. Default 'post'.
 * @param bool $create_in_db Optional. Whether to insert the post into database. Default false.
 *
 * @return WP_Post Post object containing all the default post data as attributes
 * @since 2.5.1
 *
 */
function bf_get_default_post_to_edit( $post_type = 'post', $create_in_db = false ) {
	$post_title = '';
	if ( ! empty( $_REQUEST['post_title'] ) ) {
		$post_title = esc_html( wp_unslash( $_REQUEST['post_title'] ) );
	}

	$post_content = '';
	if ( ! empty( $_REQUEST['content'] ) ) {
		$post_content = esc_html( wp_unslash( $_REQUEST['content'] ) );
	}

	$post_excerpt = '';
	if ( ! empty( $_REQUEST['excerpt'] ) ) {
		$post_excerpt = esc_html( wp_unslash( $_REQUEST['excerpt'] ) );
	}

	if ( $create_in_db ) {
		$post_id = wp_insert_post(
			array(
				'post_title'  => __( 'Auto Draft' ),
				'post_type'   => $post_type,
				'post_status' => 'auto-draft',
			)
		);
		$post    = get_post( $post_id );

		// Schedule auto-draft cleanup
		if ( ! wp_next_scheduled( 'wp_scheduled_auto_draft_delete' ) ) {
			wp_schedule_event( time(), 'daily', 'wp_scheduled_auto_draft_delete' );
		}
	} else {
		$post                 = new stdClass;
		$post->ID             = 0;
		$post->post_author    = '';
		$post->post_date      = '';
		$post->post_date_gmt  = '';
		$post->post_password  = '';
		$post->post_name      = '';
		$post->post_type      = $post_type;
		$post->post_status    = 'draft';
		$post->to_ping        = '';
		$post->pinged         = '';
		$post->comment_status = get_default_comment_status( $post_type );
		$post->ping_status    = get_default_comment_status( $post_type, 'pingback' );
		$post->post_pingback  = get_option( 'default_pingback_flag' );
		$post->post_category  = get_option( 'default_category' );
		$post->page_template  = 'default';
		$post->post_parent    = 0;
		$post->menu_order     = 0;
		$post                 = new WP_Post( $post );
	}

	/**
	 * Filters the default post content initially used in the "Write Post" form.
	 *
	 * @param string $post_content Default post content.
	 * @param WP_Post $post Post object.
	 *
	 * @since 1.5.0
	 *
	 */
	$post->post_content = (string) apply_filters( 'default_content', $post_content, $post );

	/**
	 * Filters the default post title initially used in the "Write Post" form.
	 *
	 * @param string $post_title Default post title.
	 * @param WP_Post $post Post object.
	 *
	 * @since 1.5.0
	 *
	 */
	$post->post_title = (string) apply_filters( 'default_title', $post_title, $post );

	/**
	 * Filters the default post excerpt initially used in the "Write Post" form.
	 *
	 * @param string $post_excerpt Default post excerpt.
	 * @param WP_Post $post Post object.
	 *
	 * @since 1.5.0
	 *
	 */
	$post->post_excerpt = (string) apply_filters( 'default_excerpt', $post_excerpt, $post );

	return $post;
}

/**
 * Save the submited form and create a global array with the response array
 *
 * @package buddyforms
 * @since 1.5
 */

add_action( 'wp', 'buddyforms_form_response_no_ajax' );
function buddyforms_form_response_no_ajax() {
	global $buddyforms, $bf_form_response_args;
	// If the form is submitted we will get in action
	if ( ! empty( $_REQUEST['bf_submitted'] ) ) {
		$_POST     = buddyforms_sanitize( '', $_POST );
		$form_slug = get_query_var( 'form_slug' );
		if ( isset( $_REQUEST['post_id'] ) && isset( $_REQUEST['_wpnonce'] ) ) {
			$post_id        = filter_var( $_REQUEST['post_id'], FILTER_VALIDATE_INT );
			$wp_nonce       = filter_var( $_REQUEST['_wpnonce'], FILTER_SANITIZE_STRING );
			$transient_name = sprintf( 'buddyforms_transit_post_page_%s_%s', $form_slug, $post_id );
		}

		global $wp;

		if ( empty( $form_slug ) || empty( $wp_nonce ) ) {
			return;
		}

		$bf_form_response_args = buddyforms_process_submission( $_POST );

		extract( $bf_form_response_args );

		if ( ! empty( $hasError ) && ! empty( $_POST ) && ! empty( $post_id ) ) {
			$global_error = ErrorHandler::get_instance();
			$action       = ! empty( $action ) ? $action : 'create';
			if ( ! empty( $transient_name ) && ! empty( $global_error ) ) {
				unset( $_POST['bf_submitted'] );
				set_transient( $transient_name, array( 'error' => $global_error, 'post' => $_POST, 'action' => $action ) );
			}
			$sendback = remove_query_arg( array( 'form_slug', 'post_id', '_wpnonce', 'bf_submitted' ), wp_get_referer() );
			$sendback = rtrim( $sendback, "/" );

			$sendback = add_query_arg( 'form_slug', $form_slug, $sendback );
			$sendback = add_query_arg( 'post_id', $post_id, $sendback );
			$sendback = add_query_arg( 'bf_action', $action, $sendback );
			$sendback = add_query_arg( '_wpnonce', $wp_nonce, $sendback );

			wp_redirect( $sendback, 302 );
			exit;
		}

		if ( isset( $buddyforms[ $form_slug ]['after_submit'] ) ) {
			if ( $buddyforms[ $form_slug ]['after_submit'] == 'display_post' ) {
				$permalink = get_permalink( $post_id );
				$permalink = apply_filters( 'buddyforms_after_save_post_redirect', $permalink );
				wp_redirect( $permalink, 302 );
				exit;
			}
			if ( $buddyforms[ $form_slug ]['after_submit'] == 'display_page' ) {
				$permalink = get_permalink( $buddyforms[ $form_slug ]['after_submission_page'] );
				$permalink = apply_filters( 'buddyforms_after_save_post_redirect', $permalink );
				wp_redirect( $permalink, 302 );
				exit;
			}
			if ( $buddyforms[ $form_slug ]['after_submit'] == 'redirect' ) {
				$permalink = $buddyforms[ $form_slug ]['after_submission_url'];
				$permalink = apply_filters( 'buddyforms_after_save_post_redirect', $permalink );
				wp_redirect( $permalink, 302 );
				exit;
			}
			if ( $buddyforms[ $form_slug ]['after_submit'] == 'display_posts_list' ) {
				$permalink      = get_permalink( $buddyforms[ $form_slug ]['attached_page'] );
				$post_list_link = $permalink . 'view/' . $form_slug . '/';
				$post_list_link = apply_filters( 'buddyforms_after_save_post_redirect', $post_list_link );
				wp_redirect( $post_list_link, 302 );
				exit;
			}

		}

	}

}
