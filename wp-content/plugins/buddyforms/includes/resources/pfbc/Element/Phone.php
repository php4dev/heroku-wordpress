<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Phone
 */
class Element_Phone extends Element_Textbox {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "text" );

    public function render() {

        $this->validation[] = new Validation_Phone() ;
        $this->_attributes['data-rule-bf-tel'] = "true";
        parent::render();
    }
}
