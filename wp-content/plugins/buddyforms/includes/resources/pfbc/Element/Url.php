<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Url
 */
class Element_Url extends Element_Textbox {
	/**
	 * @var array
	 */
	protected $_attributes = array( 'type' => 'text', 'class' => 'bf-user-website', 'data-rule-user-website' => 'true' );

	public function render() {

		parent::render();
	}
}
