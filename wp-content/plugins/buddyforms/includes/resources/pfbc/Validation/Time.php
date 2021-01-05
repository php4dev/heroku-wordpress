<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Validation_Date
 */
class Validation_Time extends Validation {
	/**
	 * @var string
	 */
	protected $message = "Error: %element% must contain a valid time.";

	/**
	 * @param $value
	 * @param $element
	 *
	 * @return bool
	 */
	public function isValid( $value, $element ) {
		try {
			$d = DateTime::createFromFormat( $this->field_options['element_time_format'], $value );

			$result = $d && $d->format( $this->field_options['element_time_format'] ) === $value;

			return apply_filters('buddyforms_element_time_validation', $result, $element );
		} catch ( Exception $e ) {
			return false;
		}
	}
}
