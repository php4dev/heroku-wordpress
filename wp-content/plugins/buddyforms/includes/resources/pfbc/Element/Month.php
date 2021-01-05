<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Month
 */
class Element_Month extends Element_Textbox {
	/**
	 * @var array
	 */
	protected $_attributes = array(
		"type"    => "month",
		"pattern" => "\d{4}-\d{2}"
	);

	/**
	 * Element_Month constructor.
	 *
	 * @param $label
	 * @param $name
	 * @param array|null $properties
	 */
	public function __construct( $label, $name, array $properties = null ) {
		$this->_attributes["placeholder"] = "YYYY-MM (e.g. " . date( "Y-m" ) . ")";
		$this->_attributes["title"]       = $this->_attributes["placeholder"];

		parent::__construct( $label, $name, $properties );
	}

	public function render() {
		$this->validation[] = new Validation_RegExp( "/" . $this->_attributes["pattern"] . "/", "Error: The %element% field must match the following date format: " . $this->_attributes["title"] );
		parent::render();
	}
}
