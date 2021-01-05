<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Validation_Phone
 */
class Validation_Phone extends Validation {


	protected $message = "Error: The %element% field is not valid phone number.";

	/**
	 * @param $value
	 * @param $element
	 *
	 * @return mixed
	 * @since 2.4.6 added the $element parameter
	 *
	 */
	public function isValid( $value, $element ) {
		if ( ! empty( $value ) ) {
			$pattern       = '/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.0-9]*$/';
			$result        = preg_match( $pattern, $value );
			$element_vars  = get_object_vars( $element );
			$label         = isset( $element_vars['field_options']['name'] ) ? $element_vars['field_options']['name'] : "";
			$this->message = str_replace( "%element%", $label, $this->message );

			return apply_filters( 'buddyforms_element_phone_validation', $result, $element );
		} else {
			return apply_filters( 'buddyforms_element_phone_validation', true, $element );
		}
	}
}