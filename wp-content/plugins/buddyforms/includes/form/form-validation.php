<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/*
 * The default validation is already covert. Let us do some extra work and also do the advanced validation server site.
 */
add_filter( 'buddyforms_form_custom_validation', 'buddyforms_server_validation', 2, 2 );
/**
 *
 * Server Site Validation
 *
 * @param $valid
 * @param $form_slug
 *
 * @return bool
 */
function buddyforms_server_validation( $valid, $form_slug ) {
	global $buddyforms;

	$form = $buddyforms[ $form_slug ];

	if ( isset( $form['form_fields'] ) ) {
		$global_error = ErrorHandler::get_instance();
		foreach ( $form['form_fields'] as $key => $form_field ) {

			//if field not have a value send in the $_POST pass to next one
			// @since 4.2.3
			if ( ! isset( $_POST[ $form_field['slug'] ] ) ) {
				continue;
			}

			//If the value of the field is empty then don´t run the validation
            //This means that the field is not mandatory and empty values are allowed.
            if (isset( $_POST[ $form_field['slug'] ] ) ) {
			    $field_value = $_POST[ $form_field['slug'] ];
			    if(empty($field_value)){
                    continue;
                }
            }

			if ( isset( $form_field['validation_min'] ) && $form_field['validation_min'] > 0 ) {
				if ( ! is_numeric( $_POST[ $form_field['slug'] ] ) || ( ( $form_field['validation_min'] !== $form_field['validation_max'] ) && $_POST[ $form_field['slug'] ] < $form_field['validation_min'] ) ) {
					$valid                    = false;
					$validation_error_message = __( 'Please enter a value greater than or equal to ', 'buddyforms' ) . $form_field['validation_min'];
					$global_error->add_error(new BuddyForms_Error( 'buddyforms_form_' . $form_slug, $validation_error_message, $form_field['name'] ));
				}
			}

			if ( isset( $form_field['validation_max'] ) && $form_field['validation_max'] > 0 ) {
				if ( ! is_numeric( $_POST[ $form_field['slug'] ] ) || ( ( $form_field['validation_min'] !== $form_field['validation_max'] ) && $_POST[ $form_field['slug'] ] > $form_field['validation_max'] ) ) {
					$valid                    = false;
					$validation_error_message = __( 'Please enter a value less than or equal to ', 'buddyforms' ) . $form_field['validation_max'];
					$global_error->add_error(new BuddyForms_Error( 'buddyforms_form_' . $form_slug, $validation_error_message, $form_field['name'] ));
				}
			}

			if ( isset( $form_field['validation_minlength'] ) && $form_field['validation_minlength'] > 0 ) {
				if ( strlen( trim( $_POST[ $form_field['slug'] ] ) ) < $form_field['validation_minlength'] ) {
					$valid                    = false;
					$validation_error_message = sprintf( __( 'Please enter at least %d characters.', 'buddyforms' ), $form_field['validation_minlength'] );
					$global_error->add_error(new BuddyForms_Error( 'buddyforms_form_' . $form_slug, $validation_error_message, $form_field['name'] ));
				}
			}

			if ( isset( $form_field['validation_maxlength'] ) && $form_field['validation_maxlength'] > 0 ) {
				if ( strlen( trim( $_POST[ $form_field['slug'] ] ) ) > $form_field['validation_maxlength'] ) {
					$valid                    = false;
					$validation_error_message = sprintf( __( 'Please enter no more than %d characters.', 'buddyforms' ), $form_field['validation_maxlength'] );
					$global_error->add_error(new BuddyForms_Error( 'buddyforms_form_' . $form_slug, $validation_error_message, $form_field['name'] ));
				}
			}

		}

	}

	return $valid;
}

/*
 * Browser Validation - Generate the jquery validation js
 *
 * @deprecated since 2.5.0
 */
function buddyforms_jquery_validation() {
	global $buddyforms;

	if ( ! isset( $buddyforms ) || ! is_array( $buddyforms ) ) {
		return;
	}

	$form_html = '<script type="text/javascript">';

	foreach ( $buddyforms as $form_slug => $form ) {
			// Create the needed Validation JS.
      $form_html .=  '
      jQuery(function() { ';
    $validator_init = '
      jQuery("#buddyforms_form_' . $form_slug . '").submit(function(){}).validate({
        errorPlacement: function(label, element) {
          if (element.is("TEXTAREA")) {
              label.insertAfter(element);
          } else if(element.is("input[type=\"radio\"]")) {
              label.insertBefore(element);
          } else {
              label.insertAfter(element);
          }
        }
      });';

    //allow the validate script to be altered
    $form_html .= apply_filters('buddyforms_jquery_validator_init', $validator_init, $form_slug);

    $field_types_avoid_jquery_validation = apply_filters( 'buddyforms_jquery_validator_field_to_pass', array( 'upload', 'featured_image' ) );

    $form_html .= 'if (jQuery.validator) {
      setTimeout(function() {';

		if ( isset( $form['form_fields'] ) ) {
			foreach ( $form['form_fields'] as $key => $form_field ) {
				if(in_array($form_field['type'], $field_types_avoid_jquery_validation)){
					continue;
				}

				if ( isset( $form_field['required'] ) ) {


					$form_html .= 'jQuery("form [name=\'' . $form_field['slug'] . '\']:active").rules("add", { ';

					$form_html .= 'required: true, ';

					if ( isset( $form_field['validation_min'] ) && $form_field['validation_min'] > 0 ) {
						$form_html .= 'min: ' . $form_field['validation_min'] . ', ';
					}

					if ( isset( $form_field['validation_max'] ) && $form_field['validation_max'] > 0 ) {
						$form_html .= 'max: ' . $form_field['validation_max'] . ', ';
					}

					if ( isset( $form_field['validation_minlength'] ) && $form_field['validation_minlength'] > 0 ) {
						$form_html .= 'minlength: ' . $form_field['validation_minlength'] . ', ';
					}

					if ( isset( $form_field['validation_maxlength'] ) && $form_field['validation_maxlength'] > 0 ) {
						$form_html .= 'maxlength: ' . $form_field['validation_maxlength'] . ', ';
					}

					$validation_error_message = isset( $form_field['validation_error_message'] ) ? $form_field['validation_error_message'] : __( 'This field is required.', 'buddyforms' );
					$form_html                .= ' messages:{ required: "' . $validation_error_message . '" }';
					$form_html                .= '});';
				}
			}

			if ( isset( $form_field['type'] ) && $form_field['type'] == 'gdpr' && isset( $form_field['options'] ) ) {
				foreach ( $form_field['options'] as $key => $option ) {
					$form_html                .= 'jQuery("form [name=\'' . $form_field['slug'] . '_' . $key . '[]\']:active").rules("add", { ';
					$validation_error_message = isset( $option['error_message'] ) ? $option['error_message'] : __( 'This field is required.', 'buddyforms' );
					$form_html                .= ' messages:{ required: "' . $validation_error_message . '" }';
					$form_html                .= '});';
				}
			}
		}

		$form_html .= '
    }, 0);} });';

	}
	$form_html .= '
	</script>';
	echo $form_html;
}

function buddyforms_sanitize( $type, $value ) {

	switch ( $type ) {
		case 'subject':
			$value = sanitize_text_field( $value );
			break;
		case 'message':
			$value = esc_textarea( $value );
			break;
		case 'display_name':
			$value = sanitize_text_field( $value );
			break;
		case 'user_login':
			$value = sanitize_user( $value );
			break;
		case 'user_email':
			$value = sanitize_email( $value );
			break;
		case 'user_first':
			$value = sanitize_text_field( $value );
			break;
		case 'user_last':
			$value = sanitize_text_field( $value );
			break;
		case 'user_pass':
			$value = esc_attr( $value );
			break;
		case 'user_website':
			$value = esc_url( $value );
			break;
		case 'user_bio':
			$value = esc_textarea( $value );
			break;
		case 'number':
			$value = is_numeric( $value ) ? $value : 0;
			break;
		case 'title':
			$value = sanitize_text_field( $value );
			break;
		case 'content':
			$value = esc_textarea( $value );
			break;
		case 'mail':
			$value = sanitize_email( $value );
			break;
		case 'textarea':
			$value = sanitize_textarea_field( $value );
			break;
		case 'text':
			$value = sanitize_text_field( $value );
			break;
		case 'link':
			$value = esc_url( $value );
			break;
		default :
			if ( is_array( $value ) ) {
				array_walk_recursive( $value, 'sanitize_text_field' );
			} else {
				$value = apply_filters( 'buddyforms_sanitize', sanitize_text_field( $value ), $type );
			}
			break;
	}

	return $value;
}
