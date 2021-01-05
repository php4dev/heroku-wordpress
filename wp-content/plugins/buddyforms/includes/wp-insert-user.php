<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


// register a new user
/**
 * @return bool|int|WP_Error
 */
function buddyforms_wp_update_user() {
	global $buddyforms, $form_slug;

	$hasError = false;

	$buddyforms_form_nonce_value = $_POST['_wpnonce'];

	if ( ! wp_verify_nonce( $buddyforms_form_nonce_value, 'buddyforms_form_nonce' ) ) {
		return false;
	}

	$userdata        = get_userdata( get_current_user_id() );
	$user_args       = (array) $userdata->data;
	$user_args['ID'] = $userdata->ID;

	if ( ! empty( $_POST["user_login"] ) ) {
		$user_args['user_login'] = sanitize_user( $_POST["user_login"] );
	}
	if ( ! empty( $_POST["buddyforms_user_pass"] ) ) {
		$user_args['user_pass'] = esc_attr( $_POST["buddyforms_user_pass"] );
	}
	if ( ! empty( $_POST["buddyforms_user_pass_confirm"] ) ) {
		$user_args['user_pass_confirm'] = esc_attr( $_POST["buddyforms_user_pass_confirm"] );
	}
	if ( ! empty( $_POST["user_email"] ) ) {
		$user_args['user_email'] = sanitize_email( $_POST["user_email"] );
	}
	if ( ! empty( $_POST["user_first"] ) ) {
		$user_args['first_name'] = sanitize_text_field( $_POST["user_first"] );
	}
	if ( ! empty( $_POST["user_last"] ) ) {
		$user_args['last_name'] = sanitize_text_field( $_POST["user_last"] );
	}
	if ( ! empty( $_POST["website"] ) ) {
		$user_args['user_url'] = esc_url( $_POST["website"] );
	}
	if ( ! empty( $_POST["display_name"] ) ) {
		$user_args['display_name'] = sanitize_text_field( $_POST["display_name"] );
	}
	if ( ! empty( $_POST["user_bio"] ) ) {
		$user_args['description'] = esc_textarea( $_POST["user_bio"] );
	}

	$global_error = ErrorHandler::get_instance();

	// invalid email?
	if ( ! is_email( $user_args['user_email'] ) ) {
		$hasError = true;
		$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Invalid email', 'buddyforms' ), 'user_email', $form_slug ) );
	}
	// invalid username?
	if ( ! validate_username( $user_args['user_login'] ) ) {
		$hasError = true;
		$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Invalid username', 'buddyforms' ), 'user_login', $form_slug ) );
	}
	// empty username?
	if ( $user_args['user_login'] == '' ) {
		$hasError = true;
		$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Please enter a username', 'buddyforms' ), 'user_login', $form_slug ) );
	}
	if ( $user_args['user_pass'] == '' ) {
		$hasError = true;
		$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Please enter a password', 'buddyforms' ), 'user_pass', $form_slug ) );
	}

	if ( isset( $_POST["user_pass"] ) ) {
		$global_error = ErrorHandler::get_instance();
		if ( $user_args['user_pass'] == '' || $user_args['user_pass_confirm'] == '' ) {
			// password(s) field empty
			$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_password_empty', __( 'Please enter a password, and confirm it', 'buddyforms' ), 'user_pass', $form_slug ) );
		}
		if ( $user_args['user_pass'] != $user_args['user_pass_confirm'] ) {
			// passwords do not match
			$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_password_mismatch', __( 'Passwords do not match', 'buddyforms' ), 'user_pass', $form_slug ) );
		}

		buddyforms_insert_user_set_error( $form_slug );
	}

	// Let us check if we run into any error.
	if ( ! $hasError ) {
		//Update the user role base on the update options or keep the same from the registration options
		$user_role           = isset( $buddyforms[ $form_slug ]['registration']['new_user_role'] ) ? $buddyforms[ $form_slug ]['registration']['new_user_role'] : 'subscriber';
		$on_update_user_role = isset( $buddyforms[ $form_slug ]['on_user_update']['new_user_role'] ) ? $buddyforms[ $form_slug ]['on_user_update']['new_user_role'] : 'keep';
		if ( ! empty( $on_update_user_role ) && $on_update_user_role !== 'keep' && current_user_can( 'administrator' ) ) {
			$user_role         = $on_update_user_role;
			$user_args['role'] = $user_role;
		}

		$user_id = wp_update_user( $user_args );

		if ( ! is_wp_error( $user_id ) && is_int( $user_id ) ) {
			// if multisite is enabled we need to make sure the user will become a member of the form blog id
			if ( buddyforms_is_multisite() ) {

				if ( isset( $buddyforms[ $form_slug ]['blog_id'] ) ) {
					// Add the user to the blog selected in the form builder
					add_user_to_blog( $buddyforms[ $form_slug ]['blog_id'], $user_id, $user_role );
				} else {
					// Add the user to the current blog
					add_user_to_blog( get_current_blog_id(), $user_id, $user_role );
				}
			}

			//Moderate user role changes
			$is_role_moderation_enabled = isset( $buddyforms[ $form_slug ]['on_user_update']['moderate_user_change'] ) ? $buddyforms[ $form_slug ]['on_user_update']['moderate_user_change'] : false;
			if ( ! empty( $is_role_moderation_enabled[0] ) ) {
				//Deactivate the user
				$activation_link = buddyforms_add_activation_data_to_user( $user_id, $form_slug, $buddyforms, 'on_user_update' );
				// send an email to the admin alerting them of the registration
				wp_new_user_notification( $user_id );
				$mail = buddyforms_activate_account_mail( $activation_link, $user_id, $form_slug, 'on_user_update' );

				// send an activation link to the user asking them to activate there account
				$was_send_activation_email = apply_filters( 'buddyforms_send_activation_mail_was_send', $mail, $user_id );
				if ( ! $was_send_activation_email ) {
					// General error message that one of the required field sis missing
					$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Send Activation eMail failed ', 'buddyforms' ), '', $form_slug ) );
				}
				wp_logout();
			}

			return $user_id;
		}
	}

	return false;
}

// register a new user
/**
 * @return bool|int|WP_Error
 */
function buddyforms_wp_insert_user() {
	global $buddyforms, $form_slug;

	$hasError = false;

	$global_error = ErrorHandler::get_instance();

	if ( ! empty( $_POST["user_email"] ) ) {
		$buddyforms_form_nonce_value = $_POST['_wpnonce'];
		if ( ! wp_verify_nonce( $buddyforms_form_nonce_value, 'buddyforms_form_nonce' ) ) {
			return false;
		}

		$user_login   = ! empty( $_POST["user_login"] )
			? sanitize_user( $_POST["user_login"] )
			: '';
		$user_email   = ! empty( $_POST["user_email"] )
			? sanitize_email( $_POST["user_email"] )
			: '';
		$user_first   = ! empty( $_POST["user_first"] )
			? sanitize_text_field( $_POST["user_first"] )
			: '';
		$user_last    = ! empty( $_POST["user_last"] )
			? sanitize_text_field( $_POST["user_last"] )
			: '';
		$user_pass    = ! empty( $_POST["buddyforms_user_pass"] )
			? esc_attr( $_POST["buddyforms_user_pass"] )
			: '';
		$pass_confirm = ! empty( $_POST["buddyforms_user_pass_confirm"] )
			? esc_attr( $_POST["buddyforms_user_pass_confirm"] )
			: '';
		$user_url     = ! empty( $_POST["website"] )
			? esc_url( $_POST["website"] )
			: '';
		$display_name    = ! empty( $_POST["display_name"] )
			? sanitize_text_field( $_POST["display_name"] )
			: '';
		$description  = ! empty( $_POST["user_bio"] )
			? esc_textarea( $_POST["user_bio"] )
			: '';

		$global_error = ErrorHandler::get_instance();

		// invalid email?
		if ( ! is_email( $user_email ) ) {
			$hasError = true;
			$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Invalid email', 'buddyforms' ), 'user_email', $form_slug ) );
		}
		// Email address already registered?
		if ( email_exists( $user_email ) ) {
			$hasError = true;
			$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Email already registered', 'buddyforms' ), 'user_email', $form_slug ) );
		}
		if ( isset( $buddyforms[ $form_slug ]['public_submit_username_from_email'] ) ) {
			$user_login = explode( '@', $user_email );
			$user_login = $user_login[0] . substr( md5( time() * rand() ), 0, 10 );;
		}
		// Username already registered?
		if ( username_exists( $user_login ) ) {
			$hasError = true;
			$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Username already taken', 'buddyforms' ), 'user_login', $form_slug ) );
		}
		// invalid username?
		if ( ! validate_username( $user_login ) ) {
			$hasError = true;
			$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Invalid username', 'buddyforms' ), 'user_login', $form_slug ) );
		}
		// empty username?
		if ( $user_login == '' ) {
			$hasError = true;
			$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Please enter a username', 'buddyforms' ), 'user_login', $form_slug ) );
		}

		$global_error = ErrorHandler::get_instance();

		if ( $user_pass == '' ) {
			// Generate the password if generate_password is set
			if ( isset( $buddyforms[ $form_slug ]['registration']['generate_password'] ) ) {
				$user_pass = $pass_confirm = wp_generate_password( 12, true );
			} else {
				$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_password_empty', __( 'Please enter a password, and confirm it', 'buddyforms' ), '', $form_slug ) );
			}
		}

		if ( $user_pass != $pass_confirm ) {
			// passwords do not match
			$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_password_mismatch', __( 'Passwords do not match', 'buddyforms' ), '', $form_slug ) );
		}

		buddyforms_insert_user_set_error( $form_slug );

	} else {
		// General error message that one of the required fields are missing
		$hasError = true;
		$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'eMail Address is a required fields. You need to add the email address field to the form.', 'buddyforms' ), '', $form_slug ) );
	}

	$user_role = isset( $buddyforms[ $form_slug ]['registration']['new_user_role'] ) ? $buddyforms[ $form_slug ]['registration']['new_user_role'] : 'subscriber';

	// only create the user in if there are no errors
	if ( ! $hasError ) {
		$new_user_id = wp_insert_user( array(
				'user_login'      => $user_login,
				'user_pass'       => $user_pass,
				'user_email'      => $user_email,
				'first_name'      => $user_first,
				'last_name'       => $user_last,
				'user_registered' => date( 'Y-m-d H:i:s' ),
				'role'            => $user_role,
				'user_url'        => $user_url,
				'display_name'    => $display_name,
				'description'     => $description
			)
		);

		if ( ! is_wp_error( $new_user_id ) && is_int( $new_user_id ) ) {

			// if multisite is enabled we need to make sure the user will become a member of the form blog id
			if ( buddyforms_is_multisite() ) {
				if ( isset( $buddyforms[ $form_slug ]['blog_id'] ) ) {
					// Add the user to the blog selected in the form builder
					add_user_to_blog( $buddyforms[ $form_slug ]['blog_id'], $new_user_id, $user_role );
				} else {
					// Add the user to the current blog
					add_user_to_blog( get_current_blog_id(), $new_user_id, $user_role );
				}
			}

			$activation_link = buddyforms_add_activation_data_to_user( $new_user_id, $form_slug, $buddyforms );

			if ( ! empty( $_POST['bf_pw_redirect_url'] ) ) {
				$bf_pw_redirect_url = esc_url( $_POST['bf_pw_redirect_url'] );
				add_user_meta( $new_user_id, 'bf_pw_redirect_url', $bf_pw_redirect_url, true );
			}

			$user_activation_admin_mail = apply_filters( 'buddyforms_wp_insert_user_activation_admin_mail', true, $new_user_id, $form_slug );
			if ( $user_activation_admin_mail === true ) {
				// send an email to the admin alerting them of the registration
				wp_new_user_notification( $new_user_id );
			}

			$mail = true;
			$insert_user_activation_mail = apply_filters( 'buddyforms_wp_insert_user_activation_mail', true, $new_user_id, $form_slug );
			if (  $insert_user_activation_mail === true ) {
				$mail = buddyforms_activate_account_mail( $activation_link, $new_user_id );
			}

			// send an activation link to the user asking them to activate there account
			$was_send_activation_email = apply_filters( 'buddyforms_send_activation_mail_was_send', $mail, $new_user_id );
			if ( ! $was_send_activation_email ) {
				// General error message that one of the required field sis missing
				$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, __( 'Send Activation eMail failed ', 'buddyforms' ), '', $form_slug ) );
			}
		}

		return $new_user_id;
	}

	return false;
}

/**
 * Add Errors to the Form
 *
 * @param string $form_slug
 *
 * @since 2.4.7
 */
function buddyforms_insert_user_set_error( $form_slug = '' ) {
	$global_error    = ErrorHandler::get_instance();
	$global_bf_error = $global_error->get_global_error();
	if ( ! empty( $global_bf_error ) ) {
		if ( $global_bf_error->has_errors() ) {
			$hasError = true;
			/**
			 * @var int|string $code
			 * @var  BuddyForms_Error|WP_Error $error
			 */
			foreach ( $global_error->get_global_error()->errors as $code => $error ) {
				$message = $global_error->get_global_error()->get_error_message( $code );
				$data    = $global_error->get_global_error()->get_error_data( $code );
				if ( empty( $form_slug ) ) {
					$form_slug = $global_error->get_global_error()->get_form_slug();
				}
				if ( empty( $message ) ) {
					continue;
				}
				$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, $message, $data, $form_slug ) );
			}
		}
	}
}

function buddyforms_add_activation_data_to_user( $user_id, $form_slug, $buddyforms, $source = 'registration' ) {
	$code            = sha1( $user_id . time() );
	$activation_page = get_home_url();
	if ( isset( $buddyforms[ $form_slug ][ $source ]['activation_page'] ) && $buddyforms[ $form_slug ][ $source ]['activation_page'] != 'home' ) {
		if ( $buddyforms[ $form_slug ][ $source ]['activation_page'] == 'referrer' || $buddyforms[ $form_slug ][ $source ]['activation_page'] == 'none' ) {
			if ( ! empty( $_POST["redirect_to"] ) ) {
				$activation_page = $activation_page . esc_url_raw( $_POST["redirect_to"] );
			}
		} else {
			$activation_page = get_permalink( $buddyforms[ $form_slug ][ $source ]['activation_page'] );
		}
	}
	$activation_link = add_query_arg( array(
		'key'       => $code,
		'user'      => $user_id,
		'form_slug' => $form_slug,
		'source'    => $source,
		'_wpnonce'  => buddyforms_create_nonce( 'buddyform_activate_user_link', $user_id )
	), $activation_page );

	add_user_meta( $user_id, 'has_to_be_activated', $code, true );
	add_user_meta( $user_id, 'bf_activation_link', $activation_link, true );

	return $activation_link;
}

// used for tracking error messages
/**
 * @return WP_Error
 */
function buddyforms_errors() {
	static $wp_error; // Will hold global variable safely

	return isset( $wp_error ) ? $wp_error : ( $wp_error = new WP_Error( null, null, null ) );
}

/**
 * Prepare and send the activation email to the user
 *
 * @param $activation_link
 * @param $new_user_id
 * @param string $form_slug
 * @param string $source Place where the data come from
 *
 * @return bool|void
 */
function buddyforms_activate_account_mail( $activation_link, $new_user_id, $form_slug = '', $source = 'registration' ) {
	global $buddyforms;

	if ( empty( $form_slug ) ) {
		global $form_slug;
	}

	delete_transient( 'buddyforms_get_users_pending_for_activation' );

	$blog_title  = get_bloginfo( 'name' );
	$siteurl     = get_bloginfo( 'wpurl' );
	$siteurlhtml = "<a href='$siteurl' target='_blank' >$siteurl</a>";
	$admin_email = get_option( 'admin_email' );
	$user_info   = get_userdata( $new_user_id );

	$usernameauth  = $user_info->user_login;
	$user_nicename = $user_info->user_nicename;
	$user_email    = $user_info->user_email;
	$first_name    = $user_info->user_firstname;
	$last_name     = $user_info->user_lastname;

	$subject   = isset( $buddyforms[ $form_slug ][ $source ]['activation_message_from_subject'] ) ? $buddyforms[ $form_slug ][ $source ]['activation_message_from_subject'] : '';
	$emailBody = isset( $buddyforms[ $form_slug ][ $source ]['activation_message_text'] ) ? $buddyforms[ $form_slug ][ $source ]['activation_message_text'] : '';

	$from_name = isset( $buddyforms[ $form_slug ][ $source ]['activation_message_from_name'] ) ? $buddyforms[ $form_slug ][ $source ]['activation_message_from_name'] : '';
	$from_name = str_replace( '[blog_title]', $blog_title, $from_name );

	$from_email = isset( $buddyforms[ $form_slug ][ $source ]['activation_message_from_email'] ) ? $buddyforms[ $form_slug ][ $source ]['activation_message_from_email'] : '';
	$from_email = str_replace( '[admin_email]', $admin_email, $from_email );

	$emailBody = str_replace( '[activation_link]', $activation_link, $emailBody );
	$emailBody = str_replace( '[blog_title]', $blog_title, $emailBody );
	$emailBody = str_replace( '[siteurl]', $siteurl, $emailBody );
	$emailBody = str_replace( '[siteurlhtml]', $siteurlhtml, $emailBody );
	$emailBody = str_replace( '[admin_email]', $admin_email, $emailBody );

	$emailBody = str_replace( '[user_login]', $usernameauth, $emailBody );
	$emailBody = str_replace( '[user_nicename]', $user_nicename, $emailBody );
	$emailBody = str_replace( '[user_email]', $user_email, $emailBody );
	$emailBody = str_replace( '[first_name]', $first_name, $emailBody );
	$emailBody = str_replace( '[last_name]', $last_name, $emailBody );

	if ( ! $user_email ) {
		return;
	}

	if ( isset( $buddyforms[ $form_slug ]['form_fields'] ) ) {
		foreach ( $buddyforms[ $form_slug ]['form_fields'] as $field_key => $field ) {
			if ( isset( $_POST[ $field['slug'] ] ) ) {
				$emailBody = str_replace( '[' . $field['slug'] . ']', $_POST[ $field['slug'] ], $emailBody );
			}
		}
	}

	$mail     = buddyforms_email( $user_email, $subject, $from_email, $from_email, $emailBody, array(), array(), $form_slug );

	return $mail;

}

add_filter( 'authenticate', 'buddyforms_auth_signon', 999, 3 );

/**
 * Determinate if the user can be login if they are active or not.
 *
 * @param $user
 *
 * @return WP_Error
 */
function buddyforms_auth_signon( $user ) {

	if ( is_wp_error( $user ) ) {
		return $user;
	}

	if ( ! isset( $user->ID ) ) {
		return $user;
	}

	$need_activation = get_user_meta( $user->ID, 'has_to_be_activated', true );

	if ( ! empty( $need_activation ) ) {
		$user = new WP_Error( 'activation_failed', __( '<strong>ERROR</strong>: User is not activated.', 'buddyforms' ) );
	}

	return $user;
}

add_filter( 'user_row_actions', 'buddyforms_add_view_author_page', 10, 2 );
/**
 * Add the actions to the user list to activate or resend the activation link
 *
 * @param $actions
 * @param $user
 *
 * @return array
 */
function buddyforms_add_view_author_page( $actions, $user ) {
	if ( ( current_user_can( 'edit_user', $user->ID ) ) || ( is_multisite() && current_user_can( 'manage_network_users' ) ) ) {
		$has_to_be_activated = get_user_meta( $user->ID, 'has_to_be_activated', true );
		$bf_activation_link  = get_user_meta( $user->ID, 'bf_activation_link', true );
		if ( ! empty( $has_to_be_activated ) && ! empty( $bf_activation_link ) ) {
			$actions['buddyforms_activate_user']     = "<a href='" . wp_nonce_url( "users.php?action=buddyforms_activate&amp;user=$user->ID", 'bf_activate_user' ) . "'>" . __( 'Activate', 'buddyforms' ) . "</a>";
			$actions['buddyforms_resend_activation'] = "<a href='" . wp_nonce_url( "users.php?action=buddyforms_resend_activation&amp;user=$user->ID", 'bf_resend_activation' ) . "'>" . __( 'Resend Activation', 'buddyforms' ) . "</a>";
		}
	}

	return ( $actions );
}

add_action( 'admin_action_buddyforms_activate', 'buddyforms_activate_action', 10, 3 );
/**
 * Process the activation link from the admin user list
 */
function buddyforms_activate_action() {
	if ( empty( $_GET['user'] ) ) {
		return;
	}
	if ( empty( $_GET['_wpnonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'bf_activate_user' ) ) {
		return;
	}
	remove_query_arg( array( 'bf_activate_user_notice', 'bf_resend_activation_user_notice' ) );
	$user_id = filter_input( INPUT_GET, 'user', FILTER_VALIDATE_INT );
	delete_user_meta( $user_id, 'has_to_be_activated' );
	delete_user_meta( $user_id, 'bf_activation_link' );

	do_action( 'buddyforms_after_user_activation', $user_id );

	wp_safe_redirect( add_query_arg( 'bf_activate_user_notice', 'true', 'users.php' ) );
}

add_filter( 'nonce_user_logged_out', 'buddyforms_resend_activation_user_id', 11, 2 );
/**
 * Set the user id for the resend activation link
 *
 * @param $uid
 * @param $action
 *
 * @return mixed
 */
function buddyforms_resend_activation_user_id( $uid, $action ) {
	if ( $action === 'buddyform_activate_user_link' ) {
		if ( empty( $_GET['user'] ) ) {
			return $uid;
		}
		$uid = filter_input( INPUT_GET, 'user', FILTER_VALIDATE_INT );
	}

	return $uid;
}

add_action( 'admin_action_buddyforms_resend_activation', 'buddyforms_resend_activate_action', 10, 3 );
/**
 * Process the resend activation link from the admin user list
 */
function buddyforms_resend_activate_action() {
	if ( empty( $_GET['user'] ) ) {
		return;
	}
	if ( empty( $_GET['_wpnonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'bf_resend_activation' ) ) {
		return;
	}
	global $buddyforms;
	$user_id = filter_input( INPUT_GET, 'user', FILTER_VALIDATE_INT );
	remove_query_arg( array( 'bf_activate_user_notice', 'bf_resend_activation_user_notice' ) );

	$bf_activation_link = get_user_meta( $user_id, 'bf_activation_link', true );
	$url_query          = wp_parse_url( $bf_activation_link );
	$args               = wp_parse_args( $url_query['query'] );
	$new_nonce          = buddyforms_create_nonce( 'buddyform_activate_user_link', $user_id );

	$args['_wpnonce'] = $new_nonce;
	$form_slug        = $args['form_slug'];
	$source           = ( ! empty( $args['source'] ) ) ? $args['source'] : 'registration';
	$activation_page  = get_home_url();
	if ( isset( $buddyforms[ $form_slug ][ $source ]['activation_page'] ) && $buddyforms[ $form_slug ][ $source ]['activation_page'] != 'home' ) {
		if ( $buddyforms[ $form_slug ][ $source ]['activation_page'] == 'referrer' || $buddyforms[ $form_slug ][ $source ]['activation_page'] == 'none' ) {
			if ( ! empty( $_POST["redirect_to"] ) ) {
				$activation_page = $activation_page . esc_url_raw( $_POST["redirect_to"] );
			}
		} else {
			$activation_page = get_permalink( $buddyforms[ $form_slug ][ $source ]['activation_page'] );
		}
	}

	$activation_link = add_query_arg( $args, $activation_page );

	$mail = buddyforms_activate_account_mail( $activation_link, $user_id, $form_slug, $source );

	update_user_meta( $user_id, 'bf_activation_link', $activation_link );
	wp_safe_redirect( add_query_arg( 'bf_resend_activation_user_notice', 'true', 'users.php' ) );
}

add_action( 'admin_notices', 'buddyforms_admin_users_notices' );
/**
 * Handle the notifications of the user admin list when they are activated or resend the activation
 */
function buddyforms_admin_users_notices() {
	if ( ! empty( $_REQUEST['bf_resend_activation_user_notice'] ) || ! empty( $_REQUEST['bf_activate_user_notice'] ) ) {
		echo '<div id="message" class="updated notice is-dismissible">';
		if ( ! empty( $_REQUEST['bf_resend_activation_user_notice'] ) ) {
			echo '<p>' . __( 'User Activation Send.', 'buddyforms' ) . '</p>';
		}
		if ( ! empty( $_REQUEST['bf_activate_user_notice'] ) ) {
			echo '<p>' . __( 'User Activated.', 'buddyforms' ) . '</p>';
		}
		echo '</div>';
	}
}

add_filter( 'views_users', 'buddyforms_admin_users_views', 50, 1 );
/**
 * Add a new view to get only the list of need for activation users
 *
 * @param $views
 *
 * @return mixed
 */
function buddyforms_admin_users_views( $views ) {
	if ( ! is_multisite() ) {
		$current_link_attributes = '';
		if ( ! empty( $_GET['bf_users_need_activation'] ) ) {
			$current_link_attributes = ' class="current" aria-current="page"';
		}
		$url                 = add_query_arg( 'bf_users_need_activation', 'true', 'users.php' );
		$name                = apply_filters( 'buddyforms_admin_user_list_head_filter_text', __( 'Need Activation', 'buddyforms' ) );
		$pending_users       = buddyforms_get_users_pending_for_activation();
		$name                = sprintf( __( '%1$s <span class="count">(%2$s)</span>' ), $name, number_format_i18n( $pending_users ) );
		$views['bf_pending'] = "<a href='" . esc_url( $url ) . "'$current_link_attributes>$name</a>";
	}

	return $views;
}

add_filter( 'users_list_table_query_args', 'buddyforms_admin_users_list_table_query_args', 50, 1 );
/**
 * Set the argument of the query for the admin user list table
 *
 * @param $views
 *
 * @return mixed
 */
function buddyforms_admin_users_list_table_query_args( $args ) {
	if ( ! is_multisite() ) {
		if ( ! empty( $_GET['bf_users_need_activation'] ) ) {
			$args['meta_key']     = 'bf_activation_link';
			$args['meta_compare'] = 'EXISTS';
		}
	}

	return $args;
}

/**
 * Count the amount of user where need activation
 *
 * @return int
 */
function buddyforms_get_users_pending_for_activation() {
	$count = get_transient( 'buddyforms_get_users_pending_for_activation' );
	if ( $count === false ) {
		$args  = array(
			'meta_key'     => 'bf_activation_link',
			'meta_compare' => 'EXISTS',
		);
		$query = new WP_User_Query( $args );
		$count = $query->get_total();
		set_transient( 'buddyforms_get_users_pending_for_activation', $count );
	}

	return $count;
}


add_action( 'template_redirect', 'buddyforms_activate_user', 0, 0 );
function buddyforms_activate_user() {
	global $buddyforms;

	if ( empty( $_GET['key'] ) ) {
		return false;
	}

	if ( empty( $_GET['user'] ) ) {
		return false;
	}

	if ( empty( $_GET['form_slug'] ) ) {
		return false;
	}

	if ( empty( $_GET['_wpnonce'] ) ) {
		return false;
	}

	$buddyforms_form_nonce_value = $_GET['_wpnonce'];
	if ( ! wp_verify_nonce( $buddyforms_form_nonce_value, 'buddyform_activate_user_link' ) ) {
		return false;
	}

	$user_id = filter_input( INPUT_GET, 'user', FILTER_VALIDATE_INT, array( 'options' => array( 'min_range' => 1 ) ) );
	if ( ! empty( $user_id ) ) {
		// get user meta activation hash field
		$code     = get_user_meta( $user_id, 'has_to_be_activated', true );
		$req_code = filter_input( INPUT_GET, 'key' );
		if ( ! empty( $code ) && $code === $req_code ) {
			delete_user_meta( $user_id, 'has_to_be_activated' );
			delete_user_meta( $user_id, 'bf_activation_link' );

			do_action( 'buddyforms_after_user_activation', $user_id );

			// Set the current user variables, and give him a cookie.
			wp_set_current_user( $user_id );
			wp_set_auth_cookie( $user_id );

			$form_slug = filter_input( INPUT_GET, 'form_slug' );
			$source    = filter_input( INPUT_GET, 'source' );
			if ( empty( $source ) ) {
				$source = 'registration';
			}
			/**
			 * Trigger after the user is activate.
			 *
			 * @param int The user id
			 * @param string The form slug
			 */
			do_action( 'buddyforms_after_activate_user', $user_id, $form_slug );
			if ( ! empty( $form_slug ) ) {
				remove_query_arg( 'key' );
				remove_query_arg( 'user' );
				remove_query_arg( 'form_slug' );
				remove_query_arg( '_wpnonce' );
				if ( isset( $buddyforms[ $form_slug ][ $source ]['activation_page'] ) ) {
					if ( isset( $buddyforms[ $form_slug ][ $source ]['activation_page'] ) && $buddyforms[ $form_slug ][ $source ]['activation_page'] == 'home' ) {
						$url = get_home_url();
						wp_safe_redirect( $url );
					} else {
						if ( ! ( $buddyforms[ $form_slug ][ $source ]['activation_page'] == 'referrer' || $buddyforms[ $form_slug ][ $source ]['activation_page'] == 'none' ) ) {
							$url = get_permalink( $buddyforms[ $form_slug ][ $source ]['activation_page'] );
							wp_safe_redirect( $url );
						}
					}
					exit;
				}
			}
		}
	}
}