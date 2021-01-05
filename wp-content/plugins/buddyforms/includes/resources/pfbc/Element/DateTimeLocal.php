<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_DateTimeLocal
 */
class Element_DateTimeLocal extends Element_Textbox {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "datetime-local" );
}
