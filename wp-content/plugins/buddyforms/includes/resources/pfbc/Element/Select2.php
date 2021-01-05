<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Select2
 */
class Element_Select2 extends Element {

	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "content" );

	/**
	 * @var string
	 */
	protected $message = "Error: %element% is a required field.";

	/**
	 * Element_HTML constructor.
	 *
	 * @param $value
	 * @param string $label
	 * @param string $name
	 * @param array $field_options
	 */
	public function __construct( $value, $label = "", $name = "", $field_options = array() ) {
		global $field_id;

		$properties = array(
			"value"    => $value,
			"field_id" => $field_id,
            "shortDesc" => $field_options['description']
		);

		if ( ! empty( $field_options ) && ! empty( $field_options['type'] ) ) {
			$this->setAttribute( 'type', $field_options['type'] );
		}

		if ( ! empty( $field_options ) && ! empty( $field_options['required'] ) && $field_options['required'][0] === 'required' ) {
			$this->setValidation( new Validation_Required( $this->message, $field_options ) );
		}

		parent::__construct( $label, $name, $properties, $field_options );
	}

	public function render() {
		echo $this->_attributes["value"];
	}
}
