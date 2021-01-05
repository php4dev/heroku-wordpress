<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Start the email notification process
 *
 * @param $args
 */
function mail_submission_trigger_sent( $args ) {
	global $form_slug, $buddyforms;

	if ( ! isset( $args['post_id'] ) ) {
		return;
	}

	$form_slug = $args['form_slug'];
	$post_id   = $args['post_id'];

	$post = get_post( $post_id );

	if ( isset( $buddyforms[ $form_slug ]['mail_submissions'] ) && is_array( $buddyforms[ $form_slug ]['mail_submissions'] ) ) {
		$continue = apply_filters( 'buddyforms_trigger_mail_submission', true, $post_id, $form_slug );
		if ( $continue ) {
			foreach ( $buddyforms[ $form_slug ]['mail_submissions'] as $notification ) {
				buddyforms_send_mail_submissions( $notification, $post );
			}
		}
	}

}

add_action( 'buddyforms_process_submission_end', 'mail_submission_trigger_sent' );


/**
 *
 * Sent mail notifications for contact forms
 *
 * @param $notification
 * @param $post
 */
function buddyforms_send_mail_submissions( $notification, $post ) {
	global $form_slug, $buddyforms;

	$post_ID = $post->ID;

	$author_id   = $post->post_author;
	$post_title  = $post->post_title;
	$postperma   = get_permalink( $post_ID );
	$user_info   = get_userdata( $author_id );
	$admin_email = get_option( 'admin_email' );

	$usernameauth  = ! empty( $user_info ) ? $user_info->user_login : '';
	$user_nicename = ! empty( $user_info ) ? $user_info->user_nicename : '';

	$mail_notification_trigger = $notification;

	$user_email = ! empty( $_POST['user_email'] ) ? $_POST['user_email'] : '';
	if ( empty( $user_email ) ) {
		$user_email = ! empty( $user_info ) && ! empty( $user_info->user_email ) ? $user_info->user_email : '';
	}

	$mail_to = array();

	// Check the Sent mail to checkbox
	if ( isset( $mail_notification_trigger['mail_to'] ) ) {
		foreach ( $mail_notification_trigger['mail_to'] as $key => $mail_address ) {
			if ( $mail_address == 'submitter' && ! empty( $user_email ) ) {
				array_push( $mail_to, $user_email );
			}

			if ( $mail_address == 'admin' ) {
				array_push( $mail_to, $admin_email );
			}
		}
	}

	// Check if mail to addresses
	if ( isset( $mail_notification_trigger['mail_to_address'] ) ) {
		$mail_to_address = explode( ',', str_replace( ' ', '', $mail_notification_trigger['mail_to_address'] ) );
		foreach ( $mail_to_address as $mail_address ) {
			if ( ! empty( $mail_address ) ) {
				$mail_address = buddyforms_get_field_value_from_string( $mail_address, $post_ID, $form_slug );
				array_push( $mail_to, $mail_address );
			}
		}
	}

	// Check if CC
	$mail_to_cc = array();
	if ( isset( $mail_notification_trigger['mail_to_cc_address'] ) ) {
		$mail_to_address = explode( ',', str_replace( ' ', '', $mail_notification_trigger['mail_to_cc_address'] ) );
		foreach ( $mail_to_address as $key => $mail_address ) {
			if ( ! empty( $mail_address ) ) {
				$mail_address = buddyforms_get_field_value_from_string( $mail_address, $post_ID, $form_slug );
				array_push( $mail_to_cc, $mail_address );
			}
		}
	}

	// Check if BCC
	$mail_to_bcc = array();
	if ( isset( $mail_notification_trigger['mail_to_bcc_address'] ) ) {
		$mail_to_address = explode( ',', str_replace( ' ', '', $mail_notification_trigger['mail_to_bcc_address'] ) );
		foreach ( $mail_to_address as $key => $mail_address ) {
			if ( ! empty( $mail_address ) ) {
				$mail_address = buddyforms_get_field_value_from_string( $mail_address, $post_ID, $form_slug );
				array_push( $mail_to_bcc, $mail_address );
			}
		}
	}

	$first_name = ! empty( $_POST['user_first'] ) ? $_POST['user_first'] : '';
	if ( empty( $first_name ) ) {
		$first_name = ! empty( $user_info ) && ! empty( $user_info->user_firstname ) ? $user_info->user_firstname : '';
	}
	$last_name = ! empty( $_POST['user_last'] ) ? $_POST['user_last'] : '';
	if ( empty( $last_name ) ) {
		$last_name = ! empty( $user_info ) && ! empty( $user_info->user_lastname ) ? $user_info->user_lastname : '';
	}

	$blog_title  = get_bloginfo( 'name' );
	$siteurl     = get_bloginfo( 'wpurl' );
	$siteurlhtml = "<a href='" . esc_url( $siteurl ) . "' target='_blank' >" . esc_url( $siteurl ) . "</a>";

	$subject = isset( $_POST['subject'] ) ? $_POST['subject'] : $mail_notification_trigger['mail_subject'];
	$subject = buddyforms_get_field_value_from_string( $subject, $post_ID, $form_slug );

	$from_name = isset( $mail_notification_trigger['mail_from_name'] ) ? $mail_notification_trigger['mail_from_name'] : 'blog_title';

	switch ( $from_name ) {
		case 'user_login':
			$from_name = $usernameauth;
			break;
		case 'user_first':
			$from_name = $first_name;
			break;
		case 'user_last':
			$from_name = $last_name;
			break;
		case 'user_first_last':
			$from_name = $first_name . ' ' . $last_name;
			break;
		case 'custom':
			$from_name = buddyforms_get_field_value_from_string( $mail_notification_trigger['mail_from_name_custom'], $post_ID, $form_slug );
			break;
		default:
			$from_name = $blog_title;
			break;
	}

	$from_email = isset( $mail_notification_trigger['mail_from'] ) ? $mail_notification_trigger['mail_from'] : 'admin';


	switch ( $from_email ) {
		case 'submitter':
			if ( ! empty( $user_email ) ) {
				$from_email = $user_email;
			} else {
				$from_email = $admin_email;
			}
			break;
		case 'admin':
			$from_email = $admin_email;
			break;
		case 'custom':
			$from_email = isset( $mail_notification_trigger['mail_from_custom'] ) ? $mail_notification_trigger['mail_from_custom'] : $from_email;
			$from_email = buddyforms_get_field_value_from_string( $from_email, $post_ID, $form_slug );
			break;
		default:
			$from_email = $user_email;
			break;
	}

	$emailBody = isset( $mail_notification_trigger['mail_body'] ) ? $mail_notification_trigger['mail_body'] : '';

	$post_link_html = ! empty( $postperma ) ? sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( $postperma ), $postperma ) : '';

	$short_codes_and_values = array(
		'[user_login]'                => $usernameauth,
		'[user_nicename]'             => $user_nicename,
		'[user_email]'                => $user_email,
		'[first_name]'                => $first_name,
		'[last_name]'                 => $last_name,
		'[published_post_link_plain]' => $postperma,
		'[published_post_link_html]'  => $post_link_html,
		'[published_post_title]'      => $post_title,
		'[site_name]'                 => $blog_title,
		'[site_url]'                  => $siteurl,
		'[site_url_html]'             => $siteurlhtml,
		'[form_elements_table]'       => buddyforms_mail_notification_form_elements_as_table( $form_slug, $post ),
	);

	// If we have content let us check if there are any tags we need to replace with the correct values.
	if ( ! empty( $emailBody ) ) {
		$emailBody = stripslashes( $emailBody );
		$emailBody = buddyforms_get_field_value_from_string( $emailBody, $post_ID, $form_slug );

		foreach ( $short_codes_and_values as $shortcode => $short_code_value ) {
			$emailBody = buddyforms_replace_shortcode_for_value( $emailBody, $shortcode, $short_code_value );
		}
	} else {
		if ( isset( $buddyforms[ $form_slug ]['form_fields'] ) ) {
			$emailBody = $short_codes_and_values['[form_elements_table]'];
		}
	}

	$mail_to = apply_filters('buddyforms_mail_to_before_send_notification', $mail_to, $notification, $form_slug, $post_ID);

	buddyforms_email( $mail_to, $subject, $from_name, $from_email, $emailBody, $mail_to_cc, $mail_to_bcc, $form_slug, $post_ID );
}

/**
 * Prepare header and body to send and email with wp_email
 *
 * @param $mail_to
 * @param $subject
 * @param $from_name
 * @param $from_email
 * @param $email_body
 * @param array $mail_to_cc
 * @param array $mail_to_bcc
 * @param string $form_slug
 * @param string $post_id
 * @param bool $is_testing
 * @param bool $is_html
 *
 * @return bool
 * @since 2.5.19 Added a flag to force html email.
 *                  Autodetect when the email body have html.
 *                  Add a filter `buddyforms_email_html` to allow create email templates from code
 * @since 2.5.12 Added the flag $is_testing to include a header to track test emails.
 * @since 2.5.10 Added the $form_slug and $post_id as parameter.
 *                Also added the filters `buddyforms_email_body`, `buddyforms_email_headers_priority`, `buddyforms_email_headers_mime_version`,
 *                `buddyforms_email_headers_content_type` and `buddyforms_email_headers_content_transfer_encoding`
 * @since 2.2.8
 */
function buddyforms_email( $mail_to, $subject, $from_name, $from_email, $email_body, $mail_to_cc = array(), $mail_to_bcc = array(), $form_slug = '', $post_id = '', $is_testing = false, $is_html = false ) {
	mb_internal_encoding( 'UTF-8' );
	$encoded_subject   = mb_encode_mimeheader( $subject, 'UTF-8', 'B', "\r\n", strlen( 'Subject: ' ) );
	$encoded_from_name = mb_encode_mimeheader( $from_name, 'UTF-8', 'B' );
	// Create the email header
	$mail_header[] = apply_filters( 'buddyforms_email_headers_mime_version', "MIME-Version: 1.0", $subject, $from_name, $from_email, $form_slug, $post_id );
	$mail_header[] = apply_filters( 'buddyforms_email_headers_priority', "X-Priority: 1", $subject, $from_name, $from_email, $form_slug, $post_id );
	$mail_header[] = apply_filters( 'buddyforms_email_headers_content_type', "Content-Type: text/html; charset='UTF-8'", $subject, $from_name, $from_email, $form_slug, $post_id );
//	$mail_header[] = apply_filters( 'buddyforms_email_headers_content_transfer_encoding', "Content-Transfer-Encoding: 7bit", $subject, $from_name, $from_email, $form_slug, $post_id );
	$mail_header[] = "From: $encoded_from_name <$from_email>";
	$mail_header[] = buddyforms_email_prepare_cc_bcc( $mail_to_cc );
	$mail_header[] = buddyforms_email_prepare_cc_bcc( $mail_to_bcc, 'Bcc' );

	if ( $is_testing ) {
		$mail_header[] = 'X-Mailer-Type:WPMailSMTP/Admin/Test';
	}

	if ( ! buddyforms_string_have_html( $email_body ) && $is_html == false ) {
		$email_body = nl2br( $email_body );
	}

	$encoded_email_body = BuddyFormsEncoding::toUTF8( $email_body );
	$encoded_email_body = apply_filters( 'buddyforms_email_body', $encoded_email_body, $mail_header, $subject, $from_name, $from_email, $form_slug, $post_id );
	$encoded_email_html = apply_filters( 'buddyforms_email_html', '<html><head></head><body>%s</body></html>', $encoded_email_body, $mail_header, $subject, $from_name, $from_email, $form_slug, $post_id );
	$message            = sprintf( $encoded_email_html, $encoded_email_body );

	/**
	 * @since 2.5.9
	 */
	$mail_header = apply_filters( 'buddyforms_email_headers', $mail_header, $subject, $from_name, $from_email, $mail_to_cc, $mail_to_bcc );

	// OK Let us sent the mail
	return wp_mail( $mail_to, $encoded_subject, $message, $mail_header );
}

/**
 * Check if the given string have html tags
 *
 * @param $string
 *
 * @return bool
 */
function buddyforms_string_have_html( $string ) {
	if ( empty( $string ) ) {
		return false;
	}

	return ( $string != strip_tags( $string ) );
}

/**
 * Prepare the string header for Cc or Bcc form array of emails
 *
 * @param $email_array
 * @param string $type
 *
 * @return string
 * @since 2.2.8
 *
 */
function buddyforms_email_prepare_cc_bcc( $email_array, $type = 'Cc' ) {
	$result = '';
	if ( ! empty( $email_array ) ) {
		if ( is_array( $email_array ) ) {
			$result = $type . ':' . join( ',', $email_array );
		} elseif ( is_string( $email_array ) ) {
			$result .= sprintf( "%s: %s", $type, $email_array );
		}
	}

	return $result;
}

/**
 *
 *  Lets us check for post status change and sent notifications if on transition_post_status
 *
 * @param $new_status
 * @param $old_status
 * @param $post
 */
function buddyforms_transition_post_status( $new_status, $old_status, $post ) {
	global $form_slug, $buddyforms;

	if ( $new_status === $old_status ) {
		return;
	}

	if ( empty( $form_slug ) ) {
		$form_slug = get_post_meta( $post->ID, '_bf_form_slug', true );
	}

	if ( empty( $form_slug ) ) {
		return;
	}

	if ( ! isset( $buddyforms[ $form_slug ]['mail_notification'][ $new_status ] ) ) {
		return;
	}
	$continue = apply_filters( 'buddyforms_trigger_mail_transition', true, $post->ID, $form_slug );
	if ( $continue ) {
		buddyforms_send_post_status_change_notification( $post );
	}
}

add_action( 'transition_post_status', 'buddyforms_transition_post_status', 10, 3 );

/**
 *
 * Create the mail content and sent it with wp_mail
 *
 * @param $post
 */
function buddyforms_send_post_status_change_notification( $post ) {
	global $form_slug, $buddyforms;

	if ( ! isset( $buddyforms[ $form_slug ] ) ) {
		return;
	}

	$post_ID = $post->ID;

	$author_id  = $post->post_author;
	$post_title = $post->post_title;
	$postperma  = get_permalink( $post_ID );
	$user_info  = get_userdata( $author_id );

	$usernameauth  = ! empty( $user_info ) ? $user_info->user_login : '';
	$user_nicename = ! empty( $user_info ) ? $user_info->user_nicename : '';

	$post_status = get_post_status( $post_ID );

	$mail_notification_trigger = $buddyforms[ $form_slug ]['mail_notification'][ $post_status ];

	$user_email = ! empty( $user_info ) ? $user_info->user_email : '';

	$mail_to = array();

	if ( isset( $mail_notification_trigger['mail_to'] ) ) {
		foreach ( $mail_notification_trigger['mail_to'] as $key => $mail_address ) {
			if ( $mail_address == 'author' && ! empty( $user_email ) ) {
				array_push( $mail_to, $user_email );
			}

			if ( $mail_address == 'admin' ) {
				array_push( $mail_to, get_option( 'admin_email' ) );
			}
		}
	}

	if ( isset( $mail_notification_trigger['mail_to_address'] ) ) {
		$mail_to_address = explode( ',', str_replace( ' ', '', $mail_notification_trigger['mail_to_address'] ) );
		foreach ( $mail_to_address as $mail_address ) {
			if ( ! empty( $mail_address ) ) {
				$mail_address = buddyforms_get_field_value_from_string( $mail_address, $post_ID, $form_slug );
				array_push( $mail_to, $mail_address );
			}
		}
	}

	$first_name = ! empty( $user_info ) ? $user_info->user_firstname : '';
	$last_name  = ! empty( $user_info ) ? $user_info->user_lastname : '';

	$blog_title  = get_bloginfo( 'name' );
	$siteurl     = get_bloginfo( 'wpurl' );
	$siteurlhtml = "<a href='" . esc_url( $siteurl ) . "' target='_blank' >" . esc_url( $siteurl ) . "</a>";

	$subject    = isset( $_POST['subject'] ) ? $_POST['subject'] : $mail_notification_trigger['mail_subject'];
	$subject    = buddyforms_get_field_value_from_string( $subject, $post_ID, $form_slug );
	$from_name  = buddyforms_get_field_value_from_string( $mail_notification_trigger['mail_from_name'], $post_ID, $form_slug );
	$from_email = buddyforms_get_field_value_from_string( $mail_notification_trigger['mail_from'], $post_ID, $form_slug );
	$emailBody  = $mail_notification_trigger['mail_body'];
	$emailBody  = stripslashes( $emailBody );

	$post_link_html = "<a href='" . esc_url( $postperma ) . "' target='_blank'>" . esc_url( $postperma ) . "</a>";

	$short_codes_and_values = array(
		'[user_login]'                => $usernameauth,
		'[user_nicename]'             => $user_nicename,
		'[user_email]'                => $user_email,
		'[first_name]'                => $first_name,
		'[last_name]'                 => $last_name,
		'[published_post_link_plain]' => $postperma,
		'[published_post_link_html]'  => $post_link_html,
		'[published_post_title]'      => $post_title,
		'[site_name]'                 => $blog_title,
		'[site_url]'                  => $siteurl,
		'[site_url_html]'             => $siteurlhtml,
		'[form_elements_table]'       => buddyforms_mail_notification_form_elements_as_table( $form_slug, $post ),
	);

	// If we have content let us check if there are any tags we need to replace with the correct values.
	if ( ! empty( $emailBody ) ) {
		$emailBody = stripslashes( $emailBody );
		$emailBody = buddyforms_get_field_value_from_string( $emailBody, $post_ID, $form_slug );

		foreach ( $short_codes_and_values as $shortcode => $short_code_value ) {
			$emailBody = buddyforms_replace_shortcode_for_value( $emailBody, $shortcode, $short_code_value );
		}
	} else {
		if ( isset( $buddyforms[ $form_slug ]['form_fields'] ) ) {
			$emailBody = $short_codes_and_values['[form_elements_table]'];
		}
	}

	buddyforms_email( $mail_to, $subject, $from_name, $from_email, $emailBody, array(), array(), $form_slug, $post_ID );
}


/**
 * @param $form_slug
 * @param $post
 *
 * @return string
 */
function buddyforms_mail_notification_form_elements_as_table( $form_slug, $post ) {
	global $buddyforms;
	$striped_c = 0;

	// Table start
	$message = '<table rules="all" style="border-color: #666;" cellpadding="10">';
	// Loop all form elements and add as table row
	foreach ( $buddyforms[ $form_slug ]['form_fields'] as $key => $field ) {
		if ( in_array( $field['slug'], buddyforms_get_exclude_field_slugs() ) ) {
			continue;
		}
		$striped = ( $striped_c ++ % 2 == 1 ) ? "style='background: #eee;'" : '';
		// Check if the form element exist and have is not empty.
		$message .= "<tr " . $striped . "><td><strong>" . mb_convert_encoding( $field['name'], 'UTF-8' ) . "</strong> </td><td>[" . $field['slug'] . "]</td></tr>";
	}
	// Table end
	$message .= "</table>";

	//Convert all field shortcode into field values
	$message = buddyforms_get_field_value_from_string( $message, $post->ID, $form_slug );

	// Let us return the form elements table
	return $message;
}
