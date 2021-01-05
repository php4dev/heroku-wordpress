<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Validation_Email
 */
class Validation_Email extends Validation {
	/**
	 * @var string
	 */
	protected $message = "Error: %element% is not a valid email address.";

	/**
	 * @param $value
	 * @param $element
	 *
	 * @return bool
	 */
	public function isValid( $value, $element ) {
		$result = $this->isNotApplicable( $value ) || filter_var( $value, FILTER_VALIDATE_EMAIL );

		return apply_filters( 'buddyforms_element_email_validation', $result, $element );
	}
}
