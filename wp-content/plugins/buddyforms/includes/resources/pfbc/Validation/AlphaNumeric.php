<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Validation_AlphaNumeric
 */
class Validation_AlphaNumeric extends Validation_RegExp {
	/**
	 * @var string
	 */
	protected $message = "Error: %element% must be alphanumeric (contain only numbers, letters, underscores, and/or hyphens).";

	/**
	 * Validation_AlphaNumeric constructor.
	 *
	 * @param string $message
	 */
	public function __construct( $message = "" ) {
		parent::__construct( '/^[a-zA-Z0-9_\-\s\:\,\&]+$/', $message );
	}
}
