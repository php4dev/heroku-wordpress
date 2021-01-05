<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


function buddyforms_gdpr_shortcode_data_request( $atts ) {

    // Captcha
    $number_one = rand( 1, 9 );
    $number_two = rand( 1, 9 );

    if ( function_exists( 'wp_create_user_request' ) ) {

        // Display the form
        ob_start();
        ?>
        <style>
            /**
             * Public CSS rules for the GDPR Form
             */
            #buddyforms-gdpr-radio-label {
                font-weight: 800;
                display: block;
                margin-bottom: .5em;
            }
            .buddyforms-gdpr-data-type-input, .buddyforms-gdpr-data-type-label {
                display: inline-block;
            }
            .buddyforms-success {
                display: block;
                margin: 0 0 1em 0;
                padding: .5em 1em;
                background-color: #ecf7ed;
                border-left: 4px #46b450 solid;
            }
            .buddyforms-errors {
                display: block;
                margin: 0 0 1em 0;
                padding: .5em 1em;
                background-color: #fbeaea;
                border-left: 4px #dc3232 solid;
            }
        </style>
        <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="buddyforms-gdpr-form">
            <input type="hidden" name="action" value="buddyforms_gdpr_data_request">
            <input type="hidden" name="buddyforms_gdpr_data_human_key" id="buddyforms-gdpr-data-human-key" value="<?php echo $number_one . '000' . $number_two; ?>" />
            <input type="hidden" name="buddyforms_gdpr_data_nonce" id="buddyforms-gdpr-data-nonce" value="<?php echo wp_create_nonce( 'buddyforms_gdpr_nonce' ); ?>" />

            <div class="buddyforms-gdpr-field buddyforms-gdpr-field-action" role="radiogroup" aria-labelledby="buddyforms-gdpr-radio-label">
                <p id="buddyforms-gdpr-radio-label">
                    <?php esc_html_e( 'Select your request:', 'buddyforms' ); ?>
                </p>

                <input id="buddyforms-gdpr-data-type-export" class="buddyforms-gdpr-data-type-input" type="radio" name="buddyforms_gdpr_data_type" value="export_personal_data">
                <label for="buddyforms-gdpr-data-type-export" class="buddyforms-gdpr-data-type-label">
                    <?php esc_html_e( 'Export Personal Data', 'buddyforms' ); ?>
                </label>
                <br />
                <input id="buddyforms-gdpr-data-type-remove" class="buddyforms-gdpr-data-type-input" type="radio" name="buddyforms_gdpr_data_type" value="remove_personal_data">
                <label for="buddyforms-gdpr-data-type-remove" class="buddyforms-gdpr-data-type-label">
                    <?php esc_html_e( 'Remove Personal Data', 'buddyforms' ); ?>
                </label>
            </div>

            <p class="buddyforms-gdpr-field buddyforms-gdpr-field-email">
                <label for="buddyforms-gdpr-data-email">
                    <?php esc_html_e( 'Your email address (required)', 'buddyforms' ); ?>
                </label>
                <input type="email" id="buddyforms-gdpr-data-email" name="buddyforms_gdpr_data_email" required />
            </p>

            <p class="buddyforms-gdpr-field buddyforms-gdpr-field-human">
                <label for="buddyforms-gdpr-data-human">
                    <?php esc_html_e( 'Human verification (required):', 'buddyforms' ); ?>
                    <?php echo $number_one . ' + ' . $number_two . ' = ?'; ?>
                </label>
                <input type="text" id="buddyforms-gdpr-data-human" name="buddyforms_gdpr_data_human" required />
            </p>

            <p class="buddyforms-gdpr-field buddyforms-gdpr-field-submit">
                <input id="buddyforms-gdpr-submit-button" type="submit" value="<?php esc_html_e( 'Send request', 'buddyforms' ); ?>" />
            </p>
        </form>
        <?php
        return ob_get_clean();
    } else {
        // Display error message
        return esc_html__( 'This plugin requires WordPress 4.9.6.', 'buddyforms' );
    }
}
add_shortcode( 'buddyforms_gpdr', 'buddyforms_gdpr_shortcode_data_request' );


function buddyforms_gdpr_data_request() {
	$buddyforms_gdpr_error      = array();
	$buddyforms_gdpr_type       = sanitize_key( $_POST['buddyforms_gdpr_data_type'] );
	$buddyforms_gdpr_email      = sanitize_email( $_POST['buddyforms_gdpr_data_email'] );
	$buddyforms_gdpr_human      = absint( filter_input( INPUT_POST, 'buddyforms_gdpr_data_human', FILTER_SANITIZE_NUMBER_INT ) );
	$buddyforms_gdpr_human_key  = esc_html( filter_input( INPUT_POST, 'buddyforms_gdpr_data_human_key', FILTER_SANITIZE_STRING ) );
	$buddyforms_gdpr_numbers    = explode( '000', $buddyforms_gdpr_human_key );
	$buddyforms_gdpr_answer     = absint( $buddyforms_gdpr_numbers[0] ) + absint( $buddyforms_gdpr_numbers[1] );
	$buddyforms_gdpr_nonce      = esc_html( filter_input( INPUT_POST, 'buddyforms_gdpr_data_nonce', FILTER_SANITIZE_STRING ) );

	if ( ! function_exists( 'wp_create_user_request' ) ) {
		wp_send_json_success( esc_html__( 'The request can’t be processed on this website. This feature requires WordPress 4.9.6 at least.', 'buddyforms' ) );
		die();
	}

	if ( ! empty( $buddyforms_gdpr_email ) && ! empty( $buddyforms_gdpr_human ) ) {
		if ( ! wp_verify_nonce( $buddyforms_gdpr_nonce, 'buddyforms_gdpr_nonce' ) ) {
			$buddyforms_gdpr_error[] = esc_html__( 'Security check failed, please refresh this page and try to submit the form again.', 'buddyforms' );
		} else {
			if ( ! is_email( $buddyforms_gdpr_email ) ) {
				$buddyforms_gdpr_error[] = esc_html__( 'This is not a valid email address.', 'buddyforms' );
			}
			if ( intval( $buddyforms_gdpr_answer ) !== intval( $buddyforms_gdpr_human ) ) {
				$buddyforms_gdpr_error[] = esc_html__( 'Security check failed, invalid human verification field.', 'buddyforms' );
			}
			if ( ! in_array( $buddyforms_gdpr_type, array( 'export_personal_data', 'remove_personal_data' ), true ) ) {
				$buddyforms_gdpr_error[] = esc_html__( 'Request type invalid, please refresh this page and try to submit the form again.', 'buddyforms' );
			}
		}
	} else {
		$buddyforms_gdpr_error[] = esc_html__( 'All fields are required.', 'buddyforms' );
	}
	if ( empty( $buddyforms_gdpr_error ) ) {
		$request_id = wp_create_user_request( $buddyforms_gdpr_email, $buddyforms_gdpr_type );
		if ( is_wp_error( $request_id ) ) {
			wp_send_json_success( $request_id->get_error_message() );
		} elseif ( ! $request_id ) {
			wp_send_json_success( esc_html__( 'Unable to initiate confirmation request. Please contact the administrator.', 'buddyforms' ) );
		} else {
			$send_request = wp_send_user_request( $request_id );
			wp_send_json_success( 'success' );
		}
	} else {
		wp_send_json_success( join( '<br />', $buddyforms_gdpr_error ) );
	}
	die();
}

add_action( 'wp_ajax_buddyforms_gdpr_data_request', 'buddyforms_gdpr_data_request' );
add_action( 'wp_ajax_nopriv_buddyforms_gdpr_data_request', 'buddyforms_gdpr_data_request' );