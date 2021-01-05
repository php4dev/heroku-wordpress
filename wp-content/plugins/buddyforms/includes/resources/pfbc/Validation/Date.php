<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Validation_Date
 */
class Validation_Date extends Validation {
	/**
	 * @var string
	 */
	protected $message = "Error: %element% must contain a valid date.";

	/**
	 * @param $value
	 * @param $element
	 *
	 * @return bool
	 */
	public function isValid( $value, $element ) {
		try {
			$format = ! empty( $this->field_options['element_date_format'] ) ? $this->field_options['element_date_format'] : 'y/m/d';

			if ( ! empty( $this->field_options['enable_time'] ) && $this->field_options['enable_time'][0] == 'enable_time' ) {
				$format .= ' ';
				$format .= ! empty( $this->field_options['element_time_format'] ) ? $this->field_options['element_time_format'] : 'hh:mm tt';
			}

			$d = DateTime::createFromFormat( $format, $value );

			$result = $d && $d->format( $format ) === $value;

			return apply_filters( 'buddyforms_element_date_validation', $result, $element );
		} catch ( Exception $e ) {
			return false;
		}
	}
}
