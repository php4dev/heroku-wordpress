<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Validation
 */
abstract class Validation extends Base {
	/**
	 * @var string
	 */
	protected $message = "%element% is invalid.";

	/**
	 * Validation constructor.
	 *
	 * @param string $message
	 * @param array $field_options
	 */
	public function __construct( $message = "", array $field_options = null ) {
		if ( ! empty( $message ) ) {
			$this->message = $message;
		}

		if ( ! empty( $field_options ) ) {
			$this->field_options = $field_options;
		}
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param $value
	 *
	 * @return bool
	 */
	public function isNotApplicable( $value ) {
		if ( is_null( $value ) || is_array( $value ) || $value === "" ) {
			return true;
		}

		return false;
	}

	/**
	 * @param $value
	 * @param $element
	 *
	 * @since 2.4.6 added the $element parameter
	 *
	 * @return mixed
	 */
	public abstract function isValid( $value, $element );
}
