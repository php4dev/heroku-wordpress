<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Process the form submission. Validate all. Saves or update the post and post meta. Sent aut notifications if needed
 *
 * @param array $args
 *
 * @return array
 * @package BuddyForms
 * @since   0.3 beta
 *
 */
function buddyforms_process_submission( $args = array() ) {
	global $current_user, $buddyforms, $form_slug, $_SERVER;

	$global_error = ErrorHandler::get_instance();

	$hasError      = false;
	$error_message = '';

	$post_type     = '';
	$the_post      = '';
	$revision_id   = '';
	$redirect_to   = '';
	$post_id       = 0;
	$post_author   = 0;
	$post_parent   = 0;
	$post_category = '';
	$bf_hweb       = '';

	extract( shortcode_atts( array(
		'post_type'   => '',
		'the_post'    => 0,
		'post_id'     => 0,
		'post_parent' => 0,
		'revision_id' => false,
		'form_slug'   => 0,
		'redirect_to' => $_SERVER['REQUEST_URI'],
		'bf_hweb'     => '',
		'post_author' => 0,
	), $args ) );


	if ( empty( $current_user ) ) {
		/** @var WP_User $current_user */
		$current_user = wp_get_current_user();
	}

	if ( ! empty( $current_user ) ) {
		$user_id = $current_user->ID;
	} elseif ( empty( $user_id ) ) {
		$user_id = get_current_user_id();
	}

	if ( empty( $user_id ) && ! empty( $post_author ) ) {
		$user_id = $post_author;
	}

	// Check if multisite is enabled and switch to the form blog id
	buddyforms_switch_to_form_blog( $form_slug );

	$form_type = isset( $buddyforms[ $form_slug ]['form_type'] ) ? $buddyforms[ $form_slug ]['form_type'] : '';

	$user_id = apply_filters( 'buddyforms_current_user_id', $user_id, $form_type, $form_slug, $post_id );

	$current_user = get_user_by( 'ID', $user_id );

	$user_data = array();
	if ( buddyforms_core_fs()->is_paying_or_trial__premium_only() && isset( $buddyforms[ $form_slug ]['user_data'] ) ) {
		// Get the browser and platform
		$browser_data = buddyforms_get_browser();

		// Collect all submitter data
		if ( ! in_array( 'ipaddress', $buddyforms[ $form_slug ]['user_data'], true ) && isset( $_SERVER['REMOTE_ADDR'] ) ) {
			$user_data['ipaddress'] = $_SERVER['REMOTE_ADDR'];
		}
		if ( ! in_array( 'referer', $buddyforms[ $form_slug ]['user_data'], true ) && isset( $_SERVER['REMOHTTP_REFERERTE_ADDR'] ) ) {
			$user_data['referer'] = $_SERVER['HTTP_REFERER'];
		}
		if ( ! in_array( 'browser', $buddyforms[ $form_slug ]['user_data'], true ) && isset( $browser_data['name'] ) ) {
			$user_data['browser'] = $browser_data['name'];
		}
		if ( ! in_array( 'version', $buddyforms[ $form_slug ]['user_data'], true ) && isset( $browser_data['version'] ) ) {
			$user_data['version'] = $browser_data['version'];
		}
		if ( ! in_array( 'platform', $buddyforms[ $form_slug ]['user_data'], true ) && isset( $browser_data['platform'] ) ) {
			$user_data['platform'] = $browser_data['platform'];
		}
		if ( ! in_array( 'reports', $buddyforms[ $form_slug ]['user_data'], true ) && isset( $browser_data['reports'] ) ) {
			$user_data['reports'] = $browser_data['reports'];
		}
		if ( ! in_array( 'userAgent', $buddyforms[ $form_slug ]['user_data'], true ) && isset( $browser_data['userAgent'] ) ) {
			$user_data['userAgent'] = $browser_data['userAgent'];
		}
	}

	// Check HoneyPot
	$bf_honeypot = $_POST['bf_hweb'];
	if ( ! empty( $bf_honeypot ) ) {
		return array(
			'hasError'      => true,
			'form_slug'     => $form_slug,
			'error_message' => __( 'SPAM Detected!', 'buddyforms' ),
		);
	}

	//Check nonce
	$buddyforms_form_nonce_value = $_POST['_wpnonce'];

	$nonce_result = wp_verify_nonce( $buddyforms_form_nonce_value, 'buddyforms_form_nonce' );

	if ( ! $nonce_result ) {
		$args = array(
			'hasError'      => true,
			'form_slug'     => $form_slug,
			'error_message' => __( 'Form submit error. Please contact the site administrator.', 'buddyforms' )
		);

		return $args;
	}

	$is_draft_enabled   = buddyforms_is_permission_enabled( $form_slug );
	$post_status        = $buddyforms[ $form_slug ]['status']; //Post status setup in the form
	$post_status_action = ! empty( $_POST['status'] ) ? $_POST['status'] : $post_status; //Post status from the form. default actions draft and publish or setup option

	$is_draft_not_need_validation = ( $is_draft_enabled && $post_status_action === 'draft' );
	//Avoid validation if the form is save as draft
	if ( ! $is_draft_not_need_validation ) {
		/* Servers site validation
		 * First we have browser validation. Now let us check from the server site if all is in place
		 * 7 types of validation rules: AlphaNumeric, Captcha, Date, Email, Numeric, RegExp, Required, and Url
		 *
		 * Validation can be extended
		 */
		if ( Form::isValid( $form_slug ) ) {
			if ( ! apply_filters( 'buddyforms_form_custom_validation', true, $form_slug ) ) {
				$args = array(
					'hasError'  => true,
					'form_slug' => $form_slug,
				);

				return $args;
			}
		} else {
			$args = array(
				'hasError'  => true,
				'form_slug' => $form_slug,
			);

			return $args;
		}
	}

	// Check if this is a registration form only
	if ( $form_type == 'registration' ) {

		if ( ! is_user_logged_in() ) {

			$users_can_register = false;
			if ( is_multisite() ) {
				$users_can_register = users_can_register_signup_filter();
			} else {
				$users_can_register = get_site_option( 'users_can_register' );
			}

			if ( empty( $users_can_register ) ) {
				$args = array(
					'hasError'      => true,
					'form_slug'     => $form_slug,
					'error_message' => apply_filters( 'buddyforms_disable_registration_error_message', __( 'Sorry, but registration is disabled on this site at the moment.', 'buddyforms' ) )
				);

				return $args;
			}

			$user_id = buddyforms_wp_insert_user();
		} else {
			$user_id = buddyforms_wp_update_user();
		}

		// Check if registration or update was successful
		if ( is_wp_error( $user_id ) || ! $user_id ) {

			$error_message = '';
			if ( is_wp_error( $user_id ) ) {
				$error_message = $user_id->get_error_message();
			}

			$args = array(
				'hasError'      => true,
				'form_slug'     => $form_slug,
				'error_message' => $error_message
			);

			return $args;
		}

		if ( buddyforms_core_fs()->is_paying_or_trial__premium_only() && ! empty( $user_data ) ) {
			/**
			 * Avoid save user meta data.
			 *
			 * This hook prevent buddyforms plugin to save user meta. Is important to use it if you like to save the user meta with your own plugin.
			 *
			 * @param boolean $grant This parameter determine if the data will be saved by buddyforms functions.
			 * @param string $type The type of information for the next parameter. Possible values is 'browser data' and 'field'.
			 * @param array $data This parameter holds the information what wil be saved.
			 *
			 * @since 2.1.7
			 *
			 */
			$save_usermeta = apply_filters( 'buddyforms_not_save_usermeta', true, 'browser_data', $user_data );
			if ( $save_usermeta ) {
				// Save the Browser user data
				add_user_meta( $user_id, 'buddyforms_browser_user_data', $user_data, true );
			}
		}

		if ( isset( $buddyforms[ $form_slug ]['form_fields'] ) ) {
			foreach ( $buddyforms[ $form_slug ]['form_fields'] as $field_key => $r_field ) {
				/**
				 * Avoid save user meta data.
				 *
				 * This hook prevent buddyforms plugin to save user meta. Is important to use it if you like to save the user meta with your own plugin.
				 *
				 * @param boolean $grant This parameter determine if the data will be saved by buddyforms functions.
				 * @param string $type The type of information for the next parameter. Possible values is 'browser data' and 'field'.
				 * @param array $data This parameter holds the information what wil be saved.
				 *
				 * @since 2.1.7
				 *
				 */
				$save_usermeta = apply_filters( 'buddyforms_not_save_usermeta', true, 'field', $r_field );
				if ( $save_usermeta ) {
					buddyforms_update_user_meta( $user_id, $r_field['type'], $r_field['slug'] );
					do_action( 'buddyforms_update_user_meta', $r_field, $user_id );
				}
			}

		}

		$args = array(
			'hasError'     => $hasError,
			'form_notice'  => isset( $form_notice ) ? $form_notice : false,
			'customfields' => isset( $customfields ) ? $customfields : false,
			'redirect_to'  => $redirect_to,
			'form_slug'    => $form_slug,
			'user_id'      => $user_id
		);

		do_action( 'buddyforms_process_submission_end', $args );
	}

	// Ok let us start processing the post form
	do_action( 'buddyforms_process_submission_start', $args );

	if ( isset( $_POST['bf_post_type'] ) ) {
		$post_type = $_POST['bf_post_type'];
	}

	if ( $post_id != 0 && $form_type !== 'registration' ) {
		if ( ! empty( $revision_id ) ) {
			$the_post = get_post( $revision_id );
		} else {
			$post_id  = apply_filters( 'buddyforms_create_edit_form_post_id', $post_id );
			$the_post = get_post( $post_id );
		}

		// Check if the user is author of the post
		if ( is_user_logged_in() ) {
			//Check if the post to edit match with the form setting
			if ( $the_post->post_type !== $post_type ) {
				$args = array(
					'hasError'      => true,
					'error_message' => apply_filters( 'buddyforms_user_can_edit_error_message', __( 'You do not have the required user role to use this form', 'buddyforms' ) ),
				);

				return $args;
			}
		}
	}

	// Check if user is logged in and if not check if registration during submission is enabled.
	if ( isset( $buddyforms[ $form_slug ]['public_submit_create_account'] ) && ! is_user_logged_in() ) {
		// ok let us try to register a user
		$user_id = buddyforms_wp_insert_user();
		// Check if registration was successful
		if ( ! $user_id ) {
			$args = array(
				'hasError'  => true,
				'form_slug' => $form_slug,
			);

			return $args;
		}
		//Assign the created post to the new register author
		$the_post->post_author = $user_id;

		if ( buddyforms_core_fs()->is_paying_or_trial__premium_only() && ! empty( $user_data ) ) {
			/**
			 * Avoid save user meta data.
			 *
			 * This hook prevent buddyforms plugin to save user meta. Is important to use it if you like to save the user meta with your own plugin.
			 *
			 * @param boolean $grant This parameter determine if the data will be saved by buddyforms functions.
			 * @param string $type The type of information for the next parameter. Possible values is 'browser data' and 'field'.
			 * @param array $data This parameter holds the information what wil be saved.
			 *
			 * @since 2.1.7
			 *
			 */
			$save_usermeta = apply_filters( 'buddyforms_not_save_usermeta', true, 'browser_data', $user_data );
			if ( $save_usermeta ) {
				// Save the Browser user data
				add_user_meta( $user_id, 'buddyforms_browser_user_data', $user_data, true );
			}
		}
	}

	$action             = 'save';//Base action
	$is_draft_enabled   = buddyforms_is_permission_enabled( $form_slug );
	$post_status        = $buddyforms[ $form_slug ]['status']; //Post status setup in the form
	$post_status_action = ! empty( $_POST['status'] ) ? $_POST['status'] : $post_status; //Post status from the form. default actions draft and publish or setup option
	//Check the current post status
	if ( $post_id != 0 ) {
		$post_current_status = get_post_status( $post_id );
		if ( $post_current_status === 'auto-draft' ) {
			if ( $is_draft_enabled && $post_status_action === 'draft' ) {
				$post_status = 'draft';
			}
		} else {
			$action      = 'update';
			$post_status = $post_status_action; // Keep the same action status selected by the user from the form
		}
	}

	// check if the user has the roles and capabilities
	$user_can_edit = false;
	if ( ! bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_all', array(), $form_slug ) ) {
		$current_post_is_draft   = ( ! empty( $the_post ) && $the_post->post_status == 'draft' );
		$current_user_can_edit   = bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_edit', array(), $form_slug );
		$current_user_can_create = bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_create', array(), $form_slug );
		$current_user_can_draft  = bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_draft', array(), $form_slug );
		if ( $current_post_is_draft ) {
			//Let the user edit the draft until is published
			$user_can_edit = ( $current_user_can_draft || $current_user_can_edit ) && $current_user_can_create;
		} else {
			if ( $action == 'save' && bf_user_can( $user_id, 'buddyforms_' . $form_slug . '_create', array(), $form_slug ) ) {
				$user_can_edit = true;
			}
			if ( $action == 'update' && ( bf_user_can( $user_id, 'buddyforms_' . $form_slug . '_edit', array(), $form_slug ) ) ) {
				$user_can_edit = true;
			}
		}
	} else {
		$user_can_edit = true;
	}
	if ( isset( $buddyforms[ $form_slug ]['public_submit'] ) && $buddyforms[ $form_slug ]['public_submit'] == 'public_submit' ) {
		$user_can_edit = true;
	}
	$user_can_edit = apply_filters( 'buddyforms_user_can_edit', $user_can_edit, $form_slug, $post_id );
	if ( $user_can_edit == false ) {
		$args = array(
			'hasError'      => true,
			'error_message' => apply_filters( 'buddyforms_user_role_error_message', __( 'You do not have the required user role to use this form', 'buddyforms' ) ),
		);

		return $args;
	}

	$process_submission_ok = apply_filters( 'buddyforms_process_submission_ok', true, $form_slug, $post_id );
	if ( $process_submission_ok == false ) {
		$args = array(
			'hasError'      => true,
			'error_message' => apply_filters( 'buddyforms_process_submission_ok_error_message', __( 'Sorry you are not allow to submit this Form.', 'buddyforms' ), $form_slug, $post_id ),
		);

		return $args;
	}

	if ( isset( $buddyforms[ $form_slug ]['form_fields'] ) ) {
		$customfields = $buddyforms[ $form_slug ]['form_fields'];
	}

	$comment_status = $buddyforms[ $form_slug ]['comment_status'];
	if ( isset( $_POST['comment_status'] ) ) {
		$comment_status = $_POST['comment_status'];
	}

	// Check if post_excerpt form element exist and if has values if empty check for default
	$post_excerpt = ! empty( $_POST['post_excerpt'] ) ? sanitize_text_field( $_POST['post_excerpt'] ) : '';
	$post_excerpt = apply_filters( 'buddyforms_update_post_excerpt', $post_excerpt );
	/**
	 * @since 2.5.12
	 */
	$post_excerpt = apply_filters( 'buddyforms_before_update_post_excerpt', $post_excerpt, $post_id, $form_slug );

	$content_field = buddyforms_get_form_field_by_slug( $form_slug, 'post_excerpt' );
	if ( ! empty( $content_field['generate_post_excerpt'] ) ) {
		$post_excerpt = buddyforms_str_replace_form_fields_val_by_slug( $content_field['generate_post_excerpt'], $customfields, $post_id, $form_slug );
	}
	/**
	 * @since 2.5.12
	 */
	$post_excerpt = apply_filters( 'buddyforms_after_update_post_excerpt', $post_excerpt, $post_excerpt, $post_id, $form_slug );

	//Override the post status if exist a status field
	$exist_field_status = buddyforms_exist_field_type_in_form( $form_slug, 'status' );
	if ( ! empty( $args['status'] ) && $exist_field_status ) {
		$post_status = $args['status'];
	}
	$post_status = apply_filters( 'buddyforms_create_edit_form_post_status', $post_status, $form_slug );
	if ( $post_id != 0 && $form_type !== 'registration' ) {
		$the_author_id = $the_post->post_author;
	} else {
		$the_author_id = $user_id;
	}
	$the_author_id = apply_filters( 'buddyforms_the_author_id', $the_author_id, $form_slug, $post_id, $form_type );

	$args = Array(
		'post_id'        => $post_id,
		'action'         => $action,
		'form_slug'      => $form_slug,
		'post_type'      => $post_type,
		'post_author'    => $the_author_id,
		'post_status'    => $post_status,
		'post_parent'    => $post_parent,
		'comment_status' => $comment_status,
		'form_type'      => $form_type,
		'current_user'   => $current_user,
		'new_user_id'    => $user_id,
	);

	if ( ! empty( $post_excerpt ) ) {
		$args['post_excerpt'] = $post_excerpt;
	}

	extract( $args );

	/*
	 * Check if the update or insert was successful
	 */
	if ( ! is_wp_error( $post_id ) && ! empty( $post_id ) ) {

        // If this was a registration form save the user id
        if ( $user_id ) {
            update_post_meta( $post_id, "_bf_registration_user_id", $user_id );
        }

		// Check if the post has post meta / custom fields
		if ( isset( $customfields ) ) {
			$customfields = buddyforms_update_post_meta( $post_id, $customfields );
		}

		$have_user_fields = false;
		if ( ! empty( $customfields ) ) {
			foreach ( $customfields as $customfield ) {
				if ( in_array( $customfield['type'], buddyforms_user_fields_array() ) ) {
					$have_user_fields = true;
					break;
				}
			}
			foreach ( $customfields as $customfield ) {
				if ( in_array( $customfield['type'], array( 'category' ) ) ) {
					$args['has_post_category'] = true;
					break;
				}
			}
		}

		// Check if user is logged in and update user relevant fields
		if ( is_user_logged_in() && $have_user_fields === true ) {
			 buddyforms_wp_update_user();
		}

		/*
		 * Process field submission for 3rd party and internal code. For example the Upload Field and Feature Image
		 */

		foreach ( $customfields as $customfield ) {
			$field_slug = $customfield['slug'];
			$field_type = $customfield['type'];

			do_action( 'buddyforms_process_field_submission', $field_slug, $field_type, $customfield, $post_id, $form_slug, $args, $action );
		}

		// Save the Form slug as post meta
		update_post_meta( $post_id, "_bf_form_slug", $form_slug );

		if ( buddyforms_core_fs()->is_paying_or_trial__premium_only() && ! empty( $user_data ) ) {
			// Save the User Data like browser ip etc
			update_post_meta( $post_id, "_bf_user_data", $user_data );
		}
	} else {
		$hasError      = true;
		$error_message = $post_id->get_error_message();
		$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, $error_message, '', $form_slug ) );
	}

	//Create the post
	$args = buddyforms_update_post( $args );

	// Display the message
	if ( ! $hasError ) {
		if ( isset( $_POST['post_id'] ) && ! empty( $_POST['post_id'] ) ) {
			$info_message = __( 'The ', 'buddyforms' ) . $buddyforms[ $form_slug ]['singular_name'] . __( ' has been successfully updated ', 'buddyforms' );
			$form_notice  = '<div class="info alert">' . $info_message . '</div>';
		} else {
			// Update the new post
			$info_message = __( 'The ', 'buddyforms' ) . $buddyforms[ $form_slug ]['singular_name'] . __( ' has been successfully created ', 'buddyforms' );
			$form_notice  = '<div class="info alert">' . $info_message . '</div>';
		}

	} else {
		if ( ! empty( $fileError ) ) {
			$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, $fileError, '', $form_slug ) );
		}
	}

	do_action( 'buddyforms_after_save_post', $post_id );

	$args2 = array(
		'hasError'     => $hasError,
		'form_notice'  => empty( $form_notice ) ? '' : $form_notice,
		'customfields' => is_array( $customfields ) ? $customfields : array(),
		'redirect_to'  => $redirect_to,
		'form_slug'    => $form_slug,
		'form_type'    => $form_type,
		'action'       => $action,
	);

	$args = array_merge( $args, $args2 );

	do_action( 'buddyforms_process_submission_end', $args );
	do_action( 'buddyforms_after_submission_end', $args );

	if ( buddyforms_is_multisite() ) {
		restore_current_blog();
	}

	return $args;
}

/**
 * Update post arguments
 *
 * @param $args
 *
 * @return array|bool|WP_Error
 */
function buddyforms_update_post( $args ) {
	$action            = '';
	$post_author       = '';
	$post_type         = '';
	$post_status       = '';
	$comment_status    = '';
	$post_parent       = 0;
	$form_slug         = '';
	$post_id           = 0;
	$form_type         = '';
	$new_user_id       = 0;
	$has_post_category = false;

	$args = apply_filters( 'buddyforms_update_post_args', $args );

	extract( $args );

	$default_post_title = __( 'none', 'buddyforms' );
	if ( 'registration' === $form_type && $new_user_id > 0 ) {
		$new_user = get_user_by( 'ID', $new_user_id );
		if ( ! empty( $new_user ) && ! is_wp_error( $new_user ) ) {
			if ( ! empty( $new_user->user_nicename ) ) {
				$default_post_title = $new_user->user_nicename;
			} elseif ( ! empty( $new_user->user_login ) ) {
				$default_post_title = $new_user->user_login;
			} else {
				$default_post_title = __( 'none', 'buddyforms' );
			}
		}
	} elseif ( 'contact' === $form_type ) {
		$default_post_title = ! empty( $_POST['subject'] ) ? stripslashes( $_POST['subject'] ) : __( 'none', 'buddyforms' );
	} else {
		$default_post_title = isset( $_POST['buddyforms_form_title'] ) && ! empty( $_POST['buddyforms_form_title'] ) ? stripslashes( $_POST['buddyforms_form_title'] ) : __( 'none', 'buddyforms' );
	}

	$post_title = apply_filters( 'buddyforms_update_form_title', $default_post_title, $form_slug, $post_id );

	$bf_post = array(
		'ID'             => intval( $post_id ),
		'post_author'    => $post_author,
		'post_title'     => $post_title,
		'post_name'      => sanitize_title( $post_title ),
		'post_content'   => apply_filters( 'buddyforms_update_form_content', isset( $_POST['buddyforms_form_content'] ) && ! empty( $_POST['buddyforms_form_content'] ) ? $_POST['buddyforms_form_content'] : '', $form_slug, $post_id ),
		'post_type'      => $post_type,
		'post_status'    => $post_status,
		'comment_status' => $comment_status,
		'post_parent'    => $post_parent,
	);

	if ( $has_post_category ) {
		$bf_post['post_category'] = wp_get_post_categories( $bf_post['ID'] );
	}

	if ( ! empty( $post_excerpt ) ) {
		$bf_post['post_excerpt'] = $post_excerpt;
	}

	// Check if post is new or edit
	if ( $action == 'update' ) {
		$bf_post = apply_filters( 'buddyforms_wp_update_post_args', $bf_post, $form_slug );

		// Update the new post
		$post_id = wp_update_post( $bf_post, true );

	} else {
		// Add optional scheduled post dates
		if ( isset( $_POST['status'] ) && $_POST['status'] == 'future' && $_POST['schedule'] ) {
			$post_schedule_request = sanitize_text_field( $_POST['schedule'] );
			$post_schedule         = Element_Date::create_from_format( $post_schedule_request );
			if ( ! empty( $post_schedule ) ) {
				$post_schedule_ts         = $post_schedule->getTimestamp();
				$post_date                = date( 'Y-m-d H:i:s', $post_schedule_ts );
				$bf_post['post_date']     = $post_date;
				$bf_post['post_date_gmt'] = get_date_from_gmt( $post_schedule->format( 'Y-m-d H:i:s' ), 'Y-m-d H:i:s' );
			}
		}

		$bf_post = apply_filters( 'buddyforms_wp_insert_post_args', $bf_post, $form_slug );

		// Insert the new form
		$post_id = wp_insert_post( $bf_post, true );

		if ( ! is_wp_error( $post_id ) ) {
			$bf_post['new_post'] = $post_id;
		}

	}

	$bf_post['post_id'] = $post_id;

	return $bf_post;
}

/**
 * Convert the existing field shortcode into field values
 *
 * @param $string
 * @param $post_id
 * @param $form_slug
 * @param bool $full_string
 *
 * @return string
 * @since 2.4.1
 * @since 2.5.17 Added the $full_string parameter to avoid ellipsis
 */
function buddyforms_get_field_value_from_string( $string, $post_id, $form_slug, $full_string = false ) {
	if ( false !== strpos( $string, '[' ) ) {
		$matches_fields_slugs = buddyforms_extract_form_fields_shortcode( $form_slug, $string );

		if ( ! empty( $matches_fields_slugs ) && ! empty( $matches_fields_slugs[2] ) ) {
			foreach ( $matches_fields_slugs[2] as $target_key => $target_slug ) {
				if ( empty( $target_slug ) || empty( $matches_fields_slugs[0][ $target_key ] ) ) {
					continue;
				}
				$shortcode_string   = $matches_fields_slugs[0][ $target_key ];
				$result_field       = buddyforms_get_field_with_meta( $form_slug, $post_id, $target_slug, $full_string );
				$field_result_value = ! empty( $result_field['value'] ) ? $result_field['value'] : apply_filters( 'buddyforms_field_shortcode_empty_value', '', $result_field, $form_slug, $post_id, $target_slug );
				$string             = buddyforms_replace_shortcode_for_value( $string, $shortcode_string, apply_filters( 'buddyforms_field_shortcode_value', $field_result_value, $form_slug, $post_id, $target_slug, $result_field ) );
			}
		}
	}

	return $string;
}


/**
 * Replace the shortcode in the body, only if they exist.
 *
 * @param $string
 * @param $shortcode
 * @param $value
 *
 * @return mixed
 * @since 2.4.1
 *
 */
function buddyforms_replace_shortcode_for_value( $string, $shortcode, $value ) {
	if ( strpos( $string, $shortcode ) >= 0 ) {
		$string = str_replace( $shortcode, mb_convert_encoding( $value, 'UTF-8' ), $string );
	}

	return $string;
}

/**
 * Extract form field shortcodes from the given string. Ideally use to extract the fields slugs from strings.
 *
 * @param $string
 * @param $form_slug
 *
 * @return mixed
 *
 * @since 2.4.1
 *
 */
function buddyforms_extract_form_fields_shortcode( $form_slug, $string ) {
	global $buddyforms;

	if ( empty( $buddyforms ) ) {
		return array();
	}

	if ( empty( $string ) ) {
		return array();
	}

	if ( ! isset( $buddyforms[ $form_slug ]['form_fields'] ) ) {
		return array();
	}

	$custom_fields = $buddyforms[ $form_slug ]['form_fields'];
	$fields_key    = md5( json_encode( $custom_fields ) . $string );

	$result = wp_cache_get( 'buddyforms_get_post_field_meta_' . $form_slug . '_' . $fields_key, 'buddyforms' );
	if ( $result === false ) {
		$fields_slugs = array( 'if' );
		foreach ( $custom_fields as $custom_field ) {
			if ( isset( $custom_field['slug'] ) ) {
				$slug = $custom_field['slug'];
			}

			if ( empty( $slug ) ) {
				$slug = buddyforms_sanitize_slug( $custom_field['name'] );
			}

			$fields_slugs[] = $slug;
		}

		$result = buddyforms_extract_all_shortcode( $string, $fields_slugs );

		//Process shortcode tags
		if ( ! empty( $result ) && ! empty( $result[2] ) ) {
			foreach ( $result[2] as $target => $shortcode_name ) {
				if ( ! empty( $shortcode_name ) && ! empty( $result[3][ $target ] ) ) {
					$attr_str             = html_entity_decode( $result[3][ $target ] );
					$result[3][ $target ] = shortcode_parse_atts( $attr_str );
				}
			}
		}

		wp_cache_set( 'buddyforms_get_post_field_meta_' . $form_slug . '_' . $fields_key, $result, 'buddyforms' );
	}

	return $result;
}

/**
 * Extract all shortcodes from the given string. Ideally use to extract the fields slugs from strings.
 *
 * @param $string
 * @param $fields_slugs
 *
 * @return mixed
 *
 * @since 2.4.1
 */
function buddyforms_extract_all_shortcode( $string, $fields_slugs ) {
	$pattern = get_shortcode_regex( $fields_slugs );
	$matches = array();
	preg_match_all( '/' . $pattern . '/', $string, $matches );

	return $matches;
}

/**
 * Get one field and add values property from the given field slug
 *
 * @param $form_slug
 * @param $post_id
 * @param $field_slug
 *
 * @param bool $full_string
 *
 * @param bool $html
 *
 * @return array
 * @since 2.4.1
 * @since 2.5.17 Added the $full_string parameter to avoid ellipsis
 * @since 2.5.19 Added the $html parameter to avoid html output
 */
function buddyforms_get_field_with_meta( $form_slug, $post_id, $field_slug, $full_string = false, $html = true ) {
	if ( ! isset( $form_slug ) || ! isset( $post_id ) ) {
		return array();
	}
	global $buddyforms;
	if ( empty( $buddyforms ) ) {
		return array();
	}

	if ( in_array( $field_slug, array( 'captcha' ) ) ) {
		return array();
	}

	$field_with_value_result = wp_cache_get( 'buddyforms_get_field_with_meta_' . $form_slug . '_' . $post_id . '_' . $field_slug, 'buddyforms' );

	if ( $field_with_value_result === false ) {
		$form_fields = $buddyforms[ $form_slug ]['form_fields'];
		$form_fields = buddyforms_get_post_field_meta( $post_id, $form_fields, $full_string, $html );
		foreach ( $form_fields as $custom_field ) {
			if ( isset( $custom_field['slug'] ) ) {
				$slug = $custom_field['slug'];
			}

			if ( empty( $slug ) ) {
				$slug = buddyforms_sanitize_slug( $custom_field['name'] );
			}

			if ( $field_slug === $slug ) {
				wp_cache_set( 'buddyforms_get_field_with_meta_' . $form_slug . '_' . $post_id . '_' . $field_slug, $custom_field, 'buddyforms' );

				return $custom_field;
			}
		}
	}

	return $field_with_value_result;
}

/**
 * Get form post meta for all fields
 *
 * @param $post_id
 * @param $custom_fields
 *
 * @param bool $full_string
 *
 * @param bool $html
 *
 * @return array
 * @since 2.4.1
 * @since 2.5.17 Added the $full_string parameter to avoid ellipsis
 * @since 2.5.19 Added the $html parameter to avoid html output
 */
function buddyforms_get_post_field_meta( $post_id, $custom_fields, $full_string = false, $html = true ) {
	if ( ! isset( $custom_fields ) ) {
		return $post_id;
	}

	$field_key            = md5( json_encode( $custom_fields ) );
	$result_custom_fields = wp_cache_get( 'buddyforms_get_post_field_meta_' . $post_id . '_' . $field_key, 'buddyforms' );

	if ( $result_custom_fields === false ) {
		$result_custom_fields = $custom_fields;
		foreach ( $custom_fields as $field_id => $custom_field ) {

			if ( isset( $custom_field['slug'] ) ) {
				$slug = $custom_field['slug'];
			}

			if ( empty( $slug ) ) {
				$slug = buddyforms_sanitize_slug( $custom_field['name'] );
			}

			if ( in_array( $slug, apply_filters( 'buddyforms_submission_exclude_columns', array( 'user_pass', 'captcha' ) ) ) ) {
				continue;
			}

			$meta_value = get_post_meta( $post_id, $slug, true );

			$post = get_post( $post_id );

			//Map field with his meta values
			$meta_value = buddyforms_get_field_output( $post_id, $custom_field, $post, $meta_value, $slug, $full_string, $html );

			$result_custom_fields[ $field_id ]['value'] = $meta_value;
		}
		wp_cache_set( 'buddyforms_get_post_field_meta_' . $post_id . '_' . $field_key, $result_custom_fields, 'buddyforms' );
	}

	return $result_custom_fields;
}

/**
 * Get field output
 *
 * @param $post_id
 * @param $custom_field
 * @param $post
 * @param $meta_value
 * @param $slug
 *
 * @param bool $full_string
 *
 * @param bool $html
 *
 * @return false|string
 * @since 2.5.2
 * @since 2.5.17 Added the $full_string parameter to avoid ellipsis
 * @since 2.5.19 Added the $html parameter to avoid html output
 */
function buddyforms_get_field_output( $post_id, $custom_field, $post, $meta_value, $slug, $full_string = false, $html = true ) {
	$author = false;
	if ( in_array( $custom_field['type'], buddyforms_user_fields_array() ) ) {
		$author_id = ( ! empty( $post->post_author ) ) ? $post->post_author : 0;
		if ( ! empty( $author_id ) ) {
			$author = get_user_by( 'ID', $author_id );
		}
	}

	$html = apply_filters( 'buddyforms_force_field_html', $html, $post_id, $custom_field, $post, $meta_value, $slug );

	switch ( $custom_field['type'] ) {
		case 'title':
			$meta_value = get_the_title( $post_id );
			if ( ! $full_string ) {
				$meta_value = buddyforms_add_ellipsis( $meta_value );
			}
			break;
		case 'post_excerpt':
		case 'content':
			$content    = apply_filters( 'the_content', $post->post_content );
			$content    = str_replace( ']]>', ']]&gt;', $content );
			$meta_value = strip_shortcodes( $content );
			if ( ! $full_string ) {
				$meta_value = buddyforms_add_ellipsis( $meta_value );
			}
			break;
		case 'upload':
		case 'featured_image':
			$result        = '';
			$attachment_id = explode( ",", $meta_value );
			foreach ( $attachment_id as $id ) {
				if ( ! empty( $id ) ) {
					$result = wp_get_attachment_url( $id );
				}
			}
			$meta_value = ( ! empty( $result ) ) ? trim( $result ) : '';
			break;
		case 'Creation_Date':
			$meta_value = get_the_date( 'F j, Y', $post_id );
			break;
		case 'category':
			if ( is_array( $meta_value ) ) {
				$result = array();
				foreach ( $meta_value as $key => $val ) {
					$cat      = get_the_category_by_ID( $val );
					$result[] = ( ! empty( $cat ) && ! is_wp_error( $cat ) ) ? $cat : '';
				}
				$meta_value = implode( apply_filters( 'buddyforms_implode_separator', ', ', $custom_field['type'], $slug ), $result );
			}
			break;
		case 'tags':
			if ( is_array( $meta_value ) ) {
				$result = array();
				foreach ( $meta_value as $key => $val ) {
					if ( is_numeric( $val ) ) {
						$tag = get_tag( $val );
					} else {
						$tag = get_term_by( 'slug', $val, 'post_tag' );
					}
					$result[] = ( ! empty( $tag ) && ! is_wp_error( $tag ) ) ? $tag->name : '';
				}
				$meta_value = implode( apply_filters( 'buddyforms_implode_separator', ', ', $custom_field['type'], $slug ), $result );
			}
			break;
		case 'status':
			$meta_value = buddyforms_get_post_status_readable( get_post_status( $post_id ) );
			break;
		case 'user_login':
			if ( ! empty( $author ) && $author instanceof WP_User ) {
				$meta_value = $author->user_login;
			}
			break;
		case 'user_email':
			if ( ! empty( $author ) && $author instanceof WP_User ) {
				$meta_value = $author->user_email;
			}
			break;
		case 'user_first':
			if ( ! empty( $author ) && $author instanceof WP_User ) {
				$meta_value = $author->first_name;
			}
			break;
		case 'user_last':
			if ( ! empty( $author ) && $author instanceof WP_User ) {
				$meta_value = $author->last_name;
			}
			break;
		case 'user_website':
			if ( ! empty( $author ) && $author instanceof WP_User ) {
				if ( $html ) {
					$meta_value = "<p><a href='" . esc_url( $author->user_url ) . "' " . $custom_field['name'] . ">" . esc_attr( $author->user_url ) . " </a></p>";
				} else {
					$meta_value = esc_url( $author->user_url );
				}
//				$meta_value = "<p><a href='" . esc_url( $meta_value ) . "' " . $custom_field['name'] . ">" . esc_attr( $meta_value ) . " </a></p>";
			}
			break;
		case 'user_bio':
			if ( ! empty( $author ) && $author instanceof WP_User ) {
				$meta_value = $author->description;
			}
			break;
		case 'taxonomy':
			if ( is_array( $meta_value ) ) {
				$terms = array();
				foreach ( $meta_value as $cat ) {
					$term    = get_term( $cat, $custom_field['taxonomy'] );
					$terms[] = ( ! empty( $term ) && ! is_wp_error( $term ) ) ? $term->name : $cat;
				}
				$meta_value = implode( apply_filters( 'buddyforms_implode_separator', ', ', $custom_field['type'], $slug ), $terms );
			} else {
				$term       = get_term( $meta_value, $custom_field['taxonomy'] );
				$meta_value = ( ! empty( $term ) && ! is_wp_error( $term ) ) ? $term->name : $meta_value;
			}
			break;
		case 'link':
			if ( $html ) {
				$meta_value = "<p><a href='" . esc_url( $meta_value ) . "' " . $custom_field['name'] . ">" . esc_attr( $meta_value ) . " </a></p>";
			} else {
				$meta_value = esc_url( $meta_value );
			}
			break;
		case 'gdpr':
			$gdpr_empty  = apply_filters( 'buddyforms_get_gdpr_field_meta_empty', __( '<p>Empty Agreement(s)</p>', 'buddyforms' ), $meta_value, $post_id, $slug );
			$gdpr_result = array();
			if ( ! empty( $meta_value ) && is_array( $meta_value ) ) {
				foreach ( $meta_value as $item ) {
					$gdpr_result[] = apply_filters( 'buddyforms_get_gdpr_field_meta_message', sprintf( '<p>%s <strong>(%s)</strong></p>', ( ! $full_string ) ? buddyforms_add_ellipsis( $item['label'] ) : $item['label'], ! empty( $item['checked'] ) ? __( 'Checked', 'buddyforms' ) : __( 'Unchecked', 'buddyforms' ) ), $meta_value, $post_id, $slug );
				}
			}
			if ( ! empty( $gdpr_result ) ) {
				$meta_value = join( '', $gdpr_result );
			} else {
				$meta_value = $gdpr_empty;
			}
			break;
		default:
			if ( is_array( $meta_value ) ) {
				$str_result = '';
				foreach ( $meta_value as $key => $val ) {
					$str_result .= $val;
				}
				$meta_value = $str_result;
			}
			break;
	}

	return apply_filters( 'buddyforms_get_post_field_meta', $meta_value, $post_id, $slug, $custom_field );
}

/**
 * Return a new string adding the ellipsis at end on the provided length taking care of not break a word
 *
 * @param $string
 * @param int $length
 * @param bool $echo
 * @param bool $force
 *
 * @return string|void
 * @since 2.5.20 Added a flag to force to break the srting to given position
 * @since 2.5.2
 */
function buddyforms_add_ellipsis( $string, $length = 25, $echo = false, $force = false ) {
	$str = $string;
	if ( strlen( $string ) > $length ) {
		$str = explode( "\n", wordwrap( $string, $length ) );
		if ( $force ) {
			$str = substr( $str[0], 0, $length );
		} else {
			$str = $str[0];
		}
		$str .= '...';
	}

	if ( $echo ) {
		echo $str;
	} else {
		return $str;
	}
}

/**
 * Update/Create post meta related to the new or existing post
 *
 * @param integer $post_id
 * @param array $custom_fields
 *
 * @return mixed
 */
function buddyforms_update_post_meta( $post_id, $custom_fields ) {
	global $buddyforms, $form_slug;

	if ( ! isset( $custom_fields ) ) {
		return $post_id;
	}

	foreach ( $custom_fields as $key => $customfield ) {

		if ( isset( $customfield['slug'] ) ) {
			$slug = $customfield['slug'];
		}

		if ( empty( $slug ) ) {
			$slug = buddyforms_sanitize_slug( $customfield['name'] );
		}

		// Update the post
		if ( isset( $_POST[ $slug ] ) && ! ( $_POST[ $slug ] == 'user_pass' || $_POST[ $slug ] == 'user_pass_confirm' ) ) {
			$field_value = buddyforms_sanitize( $customfield['type'], $_POST[ $slug ] );
			/**
			 * @since 2.5.12
			 */
			$field_value = apply_filters( 'buddyforms_before_update_post_meta', $field_value, $customfield, $post_id, $form_slug );
			update_post_meta( $post_id, $slug, $field_value );
		} else {
			if ( ! is_admin() ) {
				update_post_meta( $post_id, $slug, '' );
			}
		}

		// Save the GDPR Agreement
		if ( $customfield['type'] == 'gdpr' && isset( $customfield['options'] ) ) {
			$gdpr_data = array();
			foreach ( $customfield['options'] as $gdpr_key => $option ) {
				if ( ! empty( $_POST[ $slug . '_' . $gdpr_key ] ) ) {
					$gdpr_data[ $gdpr_key ]['checked'] = buddyforms_sanitize( $customfield['type'], $_POST[ $slug . '_' . $gdpr_key ] );
					$gdpr_data[ $gdpr_key ]['label']   = $option['label'];
				}
			}
			if ( ! empty( $gdpr_data ) ) {
				update_post_meta( $post_id, $slug, $gdpr_data );
			}
		}

		//
		// Check if file is new and needs to get reassigned to the correct parent
		//
		if ( $customfield['type'] == 'file' && ! empty( $_POST[ $customfield['slug'] ] ) ) {

			$attachement_ids = $_POST[ $customfield['slug'] ];
			$attachement_ids = explode( ',', $attachement_ids );

			if ( is_array( $attachement_ids ) ) {
				foreach ( $attachement_ids as $attachement_id ) {

					$attachement = get_post( $attachement_id );

					if ( $attachement->post_parent == $buddyforms[ $form_slug ]['attached_page'] ) {
						$attachement = array(
							'ID'          => $attachement_id,
							'post_parent' => $post_id,
						);
						wp_update_post( $attachement );
					}
				}
			}
		}

		//
		// Save post format if needed
		//
		if ( $customfield['type'] == 'post_formats' && isset( $_POST['post_formats'] ) && $_POST['post_formats'] != 'none' ) {
			set_post_format( $post_id, $_POST['post_formats'] );
		}

		//
		// Save taxonomies if needed
		// taxonomy, category, tags
		if ( $customfield['type'] == 'taxonomy' || $customfield['type'] == 'category' || $customfield['type'] == 'tags' ) {
			//return when on backend post edit page
			if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
				continue;
			}


			if ( ! isset( $customfield['taxonomy'] ) ) {
				$customfield['taxonomy'] = 'none';
			}
			if ( $customfield['taxonomy'] == 'none' ) {

				if ( $customfield['type'] == 'tags' ) {
					$customfield['taxonomy'] = 'post_tag';
				} elseif ( $customfield['type'] == 'category' ) {
					$customfield['taxonomy'] = 'category';
				}

			}

			if ( $customfield['taxonomy'] != 'none' && isset( $_POST[ $customfield['slug'] ] ) ) {

				// Get the tax items
				$tax_terms = $_POST[ $customfield['slug'] ];
				$taxonomy  = get_taxonomy( $customfield['taxonomy'] );

				// Get the term list before delete all term relations
				$term_list = wp_get_post_terms( $post_id, $customfield['taxonomy'], array( "fields" => "ids" ) );

				// Let us delete all and re assign.
				wp_delete_object_term_relationships( $post_id, $customfield['taxonomy'] );

				// Create a new empty array for our taxonomy terms
				$new_tax_items = array();

				// If no tax items are available check if we have some defaults we can use
				if ( $tax_terms[0] == - 1 && ! empty( $customfield['taxonomy_default'] ) ) {
					foreach ( $customfield['taxonomy_default'] as $key_tax => $tax ) {
						$tax_terms[ $key_tax ] = $tax;
					}
				}

				// Check if new term to insert
				if ( isset( $tax_terms ) && is_array( $tax_terms ) ) {
					foreach ( $tax_terms as $term_key => $term_val ) {

						if ( empty( $term_val ) || (integer) $term_val == - 1 ) {
							continue;
						}

						if ( is_array( $term_val ) && isset( $term_val[0] ) ) {
							$term_val = $term_val[0];
						}

						// Check if the term exist
						$term_exist = term_exists( (integer) $term_val, $customfield['taxonomy'] );

						// Create new term if need and add to the new tax items array
						if ( empty( $term_exist ) ) {
							$new_term = wp_insert_term( $term_val, $customfield['taxonomy'] );
							if ( ! empty( $new_term ) && ! is_wp_error( $new_term ) ) {
								$term                                  = get_term_by( 'id', $new_term['term_id'], $customfield['taxonomy'] );
								$new_tax_items[ $new_term['term_id'] ] = $term->slug;
							}
						} else {
							$term                                    = get_term_by( 'id', $term_exist['term_id'], $customfield['taxonomy'] );
							$new_tax_items[ $term_exist['term_id'] ] = $term->slug;
						}

					}
				}

				$cat_string = array();
				// Check if the taxonomy is hierarchical and prepare the string
				if ( isset( $taxonomy->hierarchical ) && $taxonomy->hierarchical == true ) {
					$cat_string = implode( apply_filters( 'buddyforms_implode_separator', ', ', 'taxonomy', $slug ), array_map(
						function ( $v, $k ) {
							return sprintf( "%s", $k );
						},
						$new_tax_items,
						array_keys( $new_tax_items )
					) );
				} else {
					$cat_string = array_values( $new_tax_items );
				}

				if ( ! empty( $new_tax_items ) ) {
					$cat_string = array_keys( $new_tax_items );
				}

				// We need to check if an excluded term was added via the backend edit screen.
				// If a excluded term is found we need to make sure to add it to the cat_string. Otherwise the term is lost by every update from teh frontend
				if ( isset( $customfield['taxonomy_exclude'] ) && is_array( $customfield['taxonomy_exclude'] ) ) {
					foreach ( $customfield['taxonomy_exclude'] as $exclude ) {
						if ( in_array( $exclude, $term_list ) ) {
							$cat_string .= ', ' . $exclude;
						}
					}
				}
				// Add the new terms to the taxonomy
				wp_set_object_terms( $post_id, $cat_string, $customfield['taxonomy'], true );

			} else {
				wp_delete_object_term_relationships( $post_id, $customfield['taxonomy'] );
			}
		}

		// Update meta do_action to hook into. This can be needed if you added
		// new form elements and need to manipulate how they get saved.
		do_action( 'buddyforms_update_post_meta', $customfield, $post_id, $form_slug );

	}

	return $custom_fields;
}

add_filter( 'wp_handle_upload_prefilter', 'buddyforms_wp_handle_upload_prefilter' );
/**
 * @param $file
 *
 * @return mixed
 */
function buddyforms_wp_handle_upload_prefilter( $file ) {
	if ( isset( $_POST['allowed_type'] ) && ! empty( $_POST['allowed_type'] ) ) {
		//this allows you to set multiple types seperated by a pipe "|"
		$allowed = explode( ",", $_POST['allowed_type'] );
		$ext     = $file['type'];

		//first check if the user uploaded the right type
		if ( ! in_array( $ext, (array) $allowed ) ) {
			$file['error'] = $file['type'] . __( "Sorry, you cannot upload this file type for this field.", 'buddyforms' );

			return $file;
		}

		//check if the type is allowed at all by WordPress
		foreach ( get_allowed_mime_types() as $key => $value ) {
			if ( $value == $ext ) {
				return $file;
			}
		}
		$file['error'] = __( "Sorry, you cannot upload this file type for this field.", 'buddyforms' );
	}

	return $file;
}

/**
 * @return array
 */
function buddyforms_get_browser() {
	$u_agent  = $_SERVER['HTTP_USER_AGENT'];
	$bname    = 'Unknown';
	$platform = 'Unknown';
	$version  = "";

	//First get the platform?
	if ( preg_match( '/linux/i', $u_agent ) ) {
		$platform = 'linux';
	} elseif ( preg_match( '/macintosh|mac os x/i', $u_agent ) ) {
		$platform = 'mac';
	} elseif ( preg_match( '/windows|win32/i', $u_agent ) ) {
		$platform = 'windows';
	}

	// Next get the name of the useragent yes seperately and for good reason
	if ( preg_match( '/MSIE/i', $u_agent ) && ! preg_match( '/Opera/i', $u_agent ) ) {
		$bname = 'Internet Explorer';
		$ub    = "MSIE";
	} elseif ( preg_match( '/Firefox/i', $u_agent ) ) {
		$bname = 'Mozilla Firefox';
		$ub    = "Firefox";
	} elseif ( preg_match( '/Chrome/i', $u_agent ) ) {
		$bname = 'Google Chrome';
		$ub    = "Chrome";
	} elseif ( preg_match( '/Safari/i', $u_agent ) ) {
		$bname = 'Apple Safari';
		$ub    = "Safari";
	} elseif ( preg_match( '/Opera/i', $u_agent ) ) {
		$bname = 'Opera';
		$ub    = "Opera";
	} elseif ( preg_match( '/Netscape/i', $u_agent ) ) {
		$bname = 'Netscape';
		$ub    = "Netscape";
	}

	// finally get the correct version number
	$known   = array( 'Version', $ub, 'other' );
	$pattern = '#(?<browser>' . join( '|', $known ) .
	           ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if ( ! preg_match_all( $pattern, $u_agent, $matches ) ) {
		// we have no matching number just continue
	}

	// see how many we have
	$i = count( $matches['browser'] );
	if ( $i != 1 ) {
		//we will have two since we are not using 'other' argument yet
		//see if version is before or after the name
		if ( strripos( $u_agent, "Version" ) < strripos( $u_agent, $ub ) ) {
			$version = $matches['version'][0];
		} else {
			$version = $matches['version'][1];
		}
	} else {
		$version = $matches['version'][0];
	}

	// check if we have a number
	if ( $version == null || $version == "" ) {
		$version = "?";
	}

	return array(
		'userAgent' => $u_agent,
		'name'      => $bname,
		'version'   => $version,
		'platform'  => $platform,
		'pattern'   => $pattern
	);
}

add_filter( 'buddyforms_form_field_include_extra_html', 'buddyforms_example_remove_inline_html', 10, 4 );
function buddyforms_example_remove_inline_html( $include, $form_slug, $field_slug, $post_id ) {
	if ( ! empty( $form_slug ) && $form_slug === 'dykiu' ) {
		return false;
	}

	return $include;
}

/**
 * Replace the content of a string using a field slug
 *
 * @param $string
 * @param $customfields
 * @param $post_id
 * @param string $form_slug
 *
 * @return mixed
 * @since 2.5.12 Include a hook `buddyforms_form_field_include_extra_html` to avoid inline HTML and the parameter $form_slug by gfirem
 */
function buddyforms_str_replace_form_fields_val_by_slug( $string, $customfields, $post_id, $form_slug = '' ) {
	if ( isset( $customfields ) && ! empty( $string ) ) {
		foreach ( $customfields as $f_id => $t_field ) {
			if ( isset( $t_field['slug'] ) && isset ( $_POST[ $t_field['slug'] ] ) && is_string( $_POST[ $t_field['slug'] ] ) ) {

				$field_val = $_POST[ $t_field['slug'] ];

				$string_tmp          = $field_val;
				$include_inline_html = apply_filters( 'buddyforms_form_field_include_extra_html', true, $form_slug, $t_field['slug'], $post_id );
				if ( $include_inline_html ) {
					switch ( $t_field['type'] ) {
						case 'taxonomy' :
						case 'category' :
						case 'tags' :
							if ( ! is_wp_error( $post_id ) && ! empty( $post_id ) ) {
								$string_tmp = get_the_term_list( $post_id, $t_field['taxonomy'], "<span class='" . $t_field['slug'] . "'>", ' - ', "</span>" );
							}
							break;
						case 'user_website':
							$string_tmp = "<span class='" . $t_field['slug'] . "'><a href='" . $field_val . "' " . $t_field['name'] . ">" . $field_val . " </a></span>";
							break;
						default:
							$string_tmp = "<span class='" . $t_field['slug'] . "'>" . $field_val . "</span>";
							break;
					}
				}

				$string = str_replace( '[' . $t_field['slug'] . ']', mb_convert_encoding( $string_tmp, 'UTF-8' ), $string );
			} else {
				$string = str_replace( '[' . $t_field['slug'] . ']', '', $string );
			}
		}
	}

	return $string;
}

add_filter( 'buddyforms_update_form_title', 'buddyforms_update_form_title', 2, 10 );
function buddyforms_update_form_title( $post_title, $form_slug, $post_id ) {
	$title_field = buddyforms_get_form_field_by_slug( $form_slug, 'buddyforms_form_title' );

	if ( ! empty( $title_field['generate_title'] ) ) {
		global $buddyforms;

		if ( isset( $buddyforms[ $form_slug ]['form_fields'] ) ) {
			$customfields = $buddyforms[ $form_slug ]['form_fields'];
		}

		$post_title = buddyforms_str_replace_form_fields_val_by_slug( $title_field['generate_title'], $customfields, $post_id, $form_slug );
	}

	return $post_title;

}

/**
 * Process the textarea auto-generate content functionality
 *
 * @param $field_value
 * @param $customfield
 * @param $post_id
 * @param $form_slug
 *
 * @return mixed|void
 * @author gfirem
 * @since 2.5.12
 */
function buddyforms_update_textarea_generated_content( $field_value, $customfield, $post_id, $form_slug ) {
	if ( $customfield['type'] == 'textarea' && ! empty( $customfield['slug'] ) && ! empty( $customfield['generate_textarea'] ) && ! empty( $form_slug ) ) {
		global $buddyforms;

		if ( isset( $buddyforms[ $form_slug ]['form_fields'] ) ) {
			$custom_fields = $buddyforms[ $form_slug ]['form_fields'];
			$textarea_val  = buddyforms_str_replace_form_fields_val_by_slug( $customfield['generate_textarea'], $custom_fields, $post_id, $form_slug );
			$field_value   = apply_filters( 'buddyforms_update_form_textarea', $textarea_val, $customfield, $post_id, $form_slug );
		}
	}

	return $field_value;
}

add_filter( 'buddyforms_before_update_post_meta', 'buddyforms_update_textarea_generated_content', 10, 4 );


add_filter( 'buddyforms_update_form_content', 'buddyforms_update_form_content', 2, 10 );
function buddyforms_update_form_content( $post_content, $form_slug, $post_id ) {
	$content_field = buddyforms_get_form_field_by_slug( $form_slug, 'buddyforms_form_content' );

	if ( ! empty( $content_field['generate_content'] ) ) {
		global $buddyforms;

		if ( isset( $buddyforms[ $form_slug ]['form_fields'] ) ) {
			$customfields = $buddyforms[ $form_slug ]['form_fields'];
		}

		$post_content = buddyforms_str_replace_form_fields_val_by_slug( $content_field['generate_content'], $customfields, $post_id, $form_slug );
	}

	return $post_content;
}


add_action( 'edit_post', 'buddyforms_after_update_post', 10, 2 );
/**
 * @param integer $post_ID
 * @param WP_Post $post
 */
function buddyforms_after_update_post( $post_ID, $post ) {
	if ( ! empty( $_POST ) && ! empty( $_POST['_bf_form_slug'] ) && intval( $post_ID ) === intval( $_POST['post_ID'] ) && ! empty( $_POST['meta'] ) ) {
		global $buddyforms;

		if ( ! isset( $buddyforms[ $_POST['_bf_form_slug'] ]['form_fields'] ) ) {
			return;
		}

		$fields = $buddyforms[ $_POST['_bf_form_slug'] ]['form_fields'];
		foreach ( $fields as $key => $field ) {
			if ( isset( $field['slug'] ) ) {
				$slug = $field['slug'];
			}
			if ( empty( $slug ) ) {
				$slug = buddyforms_sanitize_slug( $field['name'] );
			}
			switch ( $field['type'] ) {
				case 'title':
					$value = isset( $_POST['post_title'] ) ? $_POST['post_title'] : '';
					break;
				case 'content':
					$value = isset( $_POST['content'] ) ? $_POST['content'] : '';
					break;
				default:
					$value = isset( $_POST[ $slug ] ) ? $_POST[ $slug ] : '';
			}
			$_POST[ $field['slug'] ] = $value;
		}
	}
}
