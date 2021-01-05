<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Email
 */
class Element_Email extends Element_Textbox {
	/**
	 * @var array
	 */
	protected $_attributes = array( 'type' => 'text' );

	public function render() {
		if ( ! empty( $this->field_options ) && ! empty( $this->field_options['required'] ) && $this->field_options['required'][0] === 'required' ) {
			$this->validation[]                   = new Validation_Email();
			$this->_attributes['data-rule-bf-email'] = 'true';
		}
		parent::render();
	}
}
