<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_DateTime
 */
class Element_DateTime extends Element_Textbox {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "datetime" );
}
