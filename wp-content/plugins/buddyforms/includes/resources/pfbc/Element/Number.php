<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Number
 */
class Element_Number extends Element_Textbox {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "number" );

	public function render() {
		$this->validation[] = new Validation_Numeric;
		parent::render();
	}
}
