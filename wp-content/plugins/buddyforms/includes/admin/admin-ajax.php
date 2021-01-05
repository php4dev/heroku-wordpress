<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


use tk\GuzzleHttp\Client;
use tk\GuzzleHttp\Psr7\Request;

add_action( 'wp_ajax_buddyforms_post_types_taxonomies', 'buddyforms_post_types_taxonomies' );
function buddyforms_post_types_taxonomies() {

	if ( ! isset( $_POST['post_type'] ) ) {
		echo 'false';
		die();
	}

	$post_type             = $_POST['post_type'];
	$buddyforms_taxonomies = buddyforms_taxonomies( $post_type );

	$tmp = '';
	foreach ( $buddyforms_taxonomies as $name => $label ) {
		$tmp .= '<option value="' . $name . '">' . $label . '</option>';
	}

	echo $tmp;
	die();

}

add_action( 'wp_ajax_buddyforms_close_submission_default_page_notification', 'buddyforms_close_submission_default_page_notification' );
/**
 * @return bool
 */
function buddyforms_close_submission_default_page_notification() {
	if ( ! ( is_array( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		die();
	}
	if ( ! isset( $_POST['action'] ) || wp_verify_nonce( $_POST['nonce'], 'fac_drop' ) === false || $_POST['action'] !== 'buddyforms_close_submission_default_page_notification' ) {
		die();
	}
	update_option( 'close_submission_default_page_notification', 1 );
	die();
}

add_action( 'wp_ajax_buddyforms_update_taxonomy_default', 'buddyforms_update_taxonomy_default' );
function buddyforms_update_taxonomy_default() {

	if ( ! isset( $_POST['taxonomy'] ) || $_POST['taxonomy'] == 'none' ) {
		$tmp = '<option value="none">' . __( 'First you need to select a Taxonomy to select the Taxonomy defaults', 'buddyforms' ) . '</option>';
		echo $tmp;
		die();
	}

	$taxonomy = $_POST['taxonomy'];

	$args = array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => false,
		'fields'     => 'id=>name',
	);

	$terms = get_terms( $taxonomy, $args );

	$tmp = '<option value="none">none</option>';
	foreach ( $terms as $key => $term_name ) {
		$tmp .= '<option value="' . $key . '">' . $term_name . '</option>';
	}

	echo $tmp;

	die();

}

add_action( 'wp_ajax_buddyforms_new_page', 'buddyforms_new_page' );
/**
 * Create the holder page to be use as endpoint
 */
function buddyforms_new_page() {

	if ( ! is_admin() ) {
		return;
	}

	// Check if a title is entered
	if ( empty( $_POST['page_name'] ) ) {
		$json['error'] = __( 'Please enter a name', 'buddyforms' );
		echo json_encode( $json );
		die();
	}

	// Create post object
	$new_page = array(
		'post_title'   => wp_strip_all_tags( $_POST['page_name'] ),
		'post_content' => '',
		'post_status'  => 'publish',
		'post_type'    => 'page'
	);

	// Insert the post into the database
	$new_page = wp_insert_post( $new_page );

	// Check if page creation worked successfully
	if ( is_wp_error( $new_page ) ) {
		$json['error'] = $new_page;
	} else {
		$json['id']   = $new_page;
		$json['name'] = wp_strip_all_tags( $_POST['page_name'] );
	}

	echo json_encode( $json );
	die();

}

add_action( 'wp_ajax_buddyforms_url_builder', 'buddyforms_url_builder' );
function buddyforms_url_builder() {
	global $post;
	$page_id   = $_POST['attached_page'];
	$form_slug = $_POST['form_slug'];
	$post      = get_post( $page_id );

	if ( isset( $post->post_name ) ) {
		$json['permalink'] = get_permalink( $page_id );
		$json['form_slug'] = $form_slug;
		echo json_encode( $json );
		die();
	}
	echo json_encode( 'none' );
	die();
}

/**
 * Ajax to process the passive
 *
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function buddyforms_passive_feedback_ajax() {
	try {

		if ( ! ( is_array( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			wp_send_json_error();
		}
		if ( ! isset( $_POST['action'] ) || ! isset( $_POST['nonce'] ) ) {
			wp_send_json_error();
		}
		if ( ! wp_verify_nonce( $_POST['nonce'], 'fac_drop' ) ) {
			wp_send_json_error();
		}

		if ( empty( $_POST['passive_feedback_text'] ) || empty( $_POST['passive_feedback_screenshot'] ) || empty( $_POST['passive_feedback_url'] ) ) {
			wp_send_json_error();
		}

		$encoded_image = $_POST['passive_feedback_screenshot'];
		$upload_dir    = wp_upload_dir();
		$upload_path   = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;

		$img             = str_replace( ' ', '+', str_replace( 'data:image/png;base64,', '', $encoded_image ) );
		$decoded         = base64_decode( $img );
		$filename        = 'passive_feedback.png';
		$hashed_filename = md5( $filename . microtime() ) . '_' . $filename;
		$image_upload    = file_put_contents( $upload_path . $hashed_filename, $decoded );

		//HANDLE UPLOADED FILE
		if ( ! function_exists( 'wp_handle_sideload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

		// Without that I'm getting a debug error!?
		if ( ! function_exists( 'wp_get_current_user' ) ) {
			require_once( ABSPATH . 'wp-includes/pluggable.php' );
		}
		if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
		}
		$file             = array();
		$file['error']    = '';
		$file['tmp_name'] = $upload_path . $hashed_filename;
		$file['name']     = $hashed_filename;
		$file['type']     = 'image/jpeg';
		$file['size']     = filesize( $upload_path . $hashed_filename );
		// upload file to server
		// use $file instead of $image_upload
		$file_return = wp_handle_sideload( $file, array( 'test_form' => false ) );
		$filename    = $file_return['file'];
		$attachment  = array(
			'post_mime_type' => $file_return['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
			'post_content'   => '',
			'post_status'    => 'inherit',
			'guid'           => $upload_dir['url'] . '/' . basename( $filename )
		);

		$attach_id = wp_insert_attachment( $attachment, $filename );
		/// generate thumbnails of newly uploaded image
		$attachment_meta = wp_generate_attachment_metadata( $attach_id, $filename );
		wp_update_attachment_metadata( $attach_id, $attachment_meta );

		$attach_thumb_url = wp_get_attachment_image_url( $attach_id );
		$attach_full_url  = wp_get_attachment_image_url( $attach_id, 'full' );

		$freemius_user_id    = 0;
		$freemius_user_email = '';
		$buddyforms_freemius = buddyforms_core_fs();
		if ( ! empty( $buddyforms_freemius ) ) {
			$user = $buddyforms_freemius->get_user();
			if ( ! empty( $user ) ) {
				$freemius_user_id    = $user->id;
				$freemius_user_email = $user->email;
			}
		}

		$data = array(
			'passive_feedback_text'             => $_POST['passive_feedback_text'],
			'passive_feedback_screenshot_thumb' => $attach_thumb_url,
			'passive_feedback_screenshot_full'  => $attach_full_url,
			'passive_feedback_url'              => $_POST['passive_feedback_url'],
			'passive_feedback_fuid'             => $freemius_user_id,
			'passive_feedback_email'            => $freemius_user_email,
		);

		$args = array( 'data' => base64_encode( json_encode( $data ) . '|' . wp_nonce_tick() ) );

		$free_track_api = new TkTrackApi();
		$res            = $free_track_api->passive_feedback( $args );

		//Check for success
		if ( empty( $res ) || empty( $res->success ) ) {
			error_log( 'buddyforms::passive_feedback', E_USER_NOTICE );
		}

		wp_schedule_single_event( strtotime( '+1 day' ), 'buddyforms_passive_feedback_attachment_delete', array( $attach_id ) );
	} catch ( \GuzzleHttp\Exception\GuzzleException $ex ) {
		wp_send_json_error( $ex->getMessage() );
	} catch ( \tk\GuzzleHttp\Exception\GuzzleException $ex ) {
		wp_send_json_error( $ex->getMessage() );
	} catch ( Exception $ex ) {
		wp_send_json_error( $ex->getMessage() );
	}
}

add_action( 'wp_ajax_buddyforms_passive_feedback_ajax', 'buddyforms_passive_feedback_ajax' );

/**
 * Ajax callback to process the user satisfaction.
 */
function buddyforms_user_satisfaction_ajax() {
	try {
		if ( ! ( is_array( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			wp_send_json_error();
		}
		if ( ! isset( $_POST['action'] ) || ! isset( $_POST['nonce'] ) ) {
			wp_send_json_error();
		}
		if ( ! wp_verify_nonce( $_POST['nonce'], 'fac_drop' ) ) {
			wp_send_json_error();
		}

		if ( ! isset( $_POST['user_satisfaction_key'] ) || empty( $_POST['user_satisfaction_value'] ) ) {
			wp_send_json_error();
		}

		$us_key   = sanitize_text_field( $_POST['user_satisfaction_key'] );
		$us_value = sanitize_textarea_field( $_POST['user_satisfaction_value'] );

		switch ( $us_key ) {
			case 'satisfaction_recommendation':
				if ( ! isset( $us_value ) || empty( $us_value ) ) {
					wp_send_json_error();
				}
				buddyforms_track( '$experiment_started', array( 'Experiment name' => 'User Satisfaction', 'Variant name' => 'v1', 'action' => 'satisfaction-rate', 'rate' => intval( $us_value ) ) );
				update_option( 'buddyforms_user_satisfaction_sent', 1 );

				wp_send_json( '' );
				break;
			case 'satisfaction_comments':
				if ( isset( $us_value ) && ! empty( $us_value ) ) {
					buddyforms_track( '$experiment_started', array( 'Experiment name' => 'User Satisfaction', 'Variant name' => 'v1', 'action' => 'satisfaction-comment', 'comment' => $us_value ) );
				}

				wp_send_json( '' );
				break;
			default:
				wp_send_json_error();
				break;
		}

	} catch ( Exception $ex ) {
		wp_send_json_error( $ex->getMessage() );
	}
}

add_action( 'wp_ajax_buddyforms_user_satisfaction_ajax', 'buddyforms_user_satisfaction_ajax' );

/**
 * Ajax callback to close for ever or close one time the marketing popups
 */
function buddyforms_marketing_hide_for_ever_close() {
	try {
		if ( ! ( is_array( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			die();
		}
		if ( ! isset( $_POST['action'] ) || ! isset( $_POST['nonce'] ) ) {
			die();
		}
		if ( ! wp_verify_nonce( $_POST['nonce'], 'fac_drop' ) ) {
			die();
		}

		if ( ! empty( $_POST['popup_key'] ) ) {
			$key     = sanitize_text_field( $_POST['popup_key'] );
			$options = get_option( 'buddyforms_marketing_hide_for_ever_close' );
			if ( ! empty( $options ) && is_array( $options ) ) {
				if ( empty( $options[ $key ] ) ) {
					$options[ $key ] = true;
				}
			} else {
				$options = array( $key => true );
			}
			update_option( 'buddyforms_marketing_hide_for_ever_close', $options );
		}

		wp_send_json( '' );
	} catch ( Exception $ex ) {
		BuddyForms::error_log( $ex->getMessage() );
	}
	die();
}

add_action( 'wp_ajax_buddyforms_marketing_hide_for_ever_close', 'buddyforms_marketing_hide_for_ever_close' );

/**
 * Ajax callback for the user reset permission related to Marketing in the setting page
 */
function buddyforms_marketing_reset_permissions() {
	try {
		if ( ! ( is_array( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			die();
		}
		if ( ! isset( $_POST['action'] ) || ! isset( $_POST['nonce'] ) ) {
			die();
		}
		if ( ! wp_verify_nonce( $_POST['nonce'], 'fac_drop' ) ) {
			die();
		}

		$result1 = delete_option( 'buddyforms_marketing_hide_for_ever_close' );
		$result2 = delete_option( 'buddyforms_user_satisfaction_sent' );
		$result  = $result1 && $result2;

		wp_send_json( $result );
	} catch ( Exception $ex ) {
		BuddyForms::error_log( $ex->getMessage() );
	}
	die();
}

add_action( 'wp_ajax_buddyforms_marketing_reset_permissions', 'buddyforms_marketing_reset_permissions' );

function buddyforms_custom_form_template_tracking() {
	if ( ! ( is_array( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		die();
	}
	if ( ! isset( $_POST['action'] ) || ! isset( $_POST['nonce'] ) ) {
		die();
	}
	if ( ! wp_verify_nonce( $_POST['nonce'], 'fac_drop' ) ) {
		die();
	}
	buddyforms_track( 'selected-form-template', array( 'template' => 'custom', 'type' => 'custom' ) );
}

add_action( 'wp_ajax_buddyforms_custom_form_template', 'buddyforms_custom_form_template_tracking' );
