<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class ErrorView_Standard
 */
class ErrorView_Standard extends ErrorView {
	public function render() {
		$global_error    = ErrorHandler::get_instance();
		$global_bf_error = $global_error->get_global_error();
		if ( ! empty( $global_bf_error ) ) {
			if ( $global_bf_error->has_errors() ) {
				$all_errors_groups = $global_bf_error->errors;
				$all_errors        = array();
				foreach ( $all_errors_groups as $code => $errors ) {
					if ( is_array( $errors ) ) {
						foreach ( $errors as $error ) {
							$all_errors[] = $error[0];
						}
					} else {
						$all_errors[] = $global_bf_error->get_error_message( $code );
					}
				}
				$size = sizeof( $all_errors );

				$errors_string = implode( "</li><li>", $all_errors );

				ob_start();

				// create the plugin template path
				$template_path = BUDDYFORMS_TEMPLATE_PATH . 'buddyforms/bf-error-container.php';

				// Check if template exist in the child or parent theme and use this path if available
				if ( $template_file = locate_template( "buddyforms/bf-error-container.php", false, false ) ) {
					$template_path = $template_file;
				}

				// Do the include
				include $template_path;

				echo ob_get_clean();
			}
		}
	}

	public function renderAjaxErrorResponse() {
		$global_error    = ErrorHandler::get_instance();
		$global_bf_error = $global_error->get_global_error();
		if ( ! empty( $global_bf_error ) ) {
			if ( $global_bf_error->has_errors() ) {
				header( "Content-type: application/json" );
				$errors = (array) $global_bf_error->errors;
				echo wp_json_encode( array( "errors" => $errors ) );
				die;
			}
		}
	}

	public function renderCSS() {

	}
}
