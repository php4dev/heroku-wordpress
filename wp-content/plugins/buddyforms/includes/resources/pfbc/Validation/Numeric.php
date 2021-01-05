<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Validation_Numeric
 */
class Validation_Numeric extends Validation {
	/**
	 * @var string
	 */
	protected $message = "Error: %element% must be numeric.";

	/**
	 * @param $value
	 * @param $element
	 *
	 * @return bool
	 */
	public function isValid( $value, $element ) {
		$result = $this->isNotApplicable( $value ) || is_numeric( $value );

		return apply_filters( 'buddyforms_element_numeric_validation', $result, $element );
	}
}
