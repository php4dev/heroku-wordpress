<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Validation_Url
 */
class Validation_Url extends Validation {
	/**
	 * @var string
	 */
	protected $message = "Error: %element% must contain a url (e.g. http://www.google.com).";

	/**
	 * @param $value
	 * @param $element
	 *
	 * @return bool
	 */
	public function isValid( $value, $element ) {
		$result = $this->isNotApplicable( $value ) || filter_var( $value, FILTER_VALIDATE_URL );

		return apply_filters( 'buddyforms_element_url_validation', $result, $element );
	}
}
