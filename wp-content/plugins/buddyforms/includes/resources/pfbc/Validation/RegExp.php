<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Validation_RegExp
 */
class Validation_RegExp extends Validation {
	/**
	 * @var string
	 */
	protected $message = "Error: %element% contains invalid characters.";
	/**
	 * @var string
	 */
	protected $pattern;

	/**
	 * Validation_RegExp constructor.
	 *
	 * @param string $pattern
	 * @param string $message
	 */
	public function __construct( $pattern, $message = "" ) {
		$this->pattern = $pattern;
		parent::__construct( $message );
	}

	/**
	 * @param $value
	 * @param $element
	 *
	 * @return bool
	 */
	public function isValid( $value, $element ) {
		$result = $this->isNotApplicable( $value ) || preg_match( $this->pattern, $value );

		return apply_filters( 'buddyforms_element_regex_validation', $result, $element );
	}
}
