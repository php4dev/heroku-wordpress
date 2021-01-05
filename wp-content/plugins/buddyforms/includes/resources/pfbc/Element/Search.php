<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Search
 */
class Element_Search extends Element_Textbox {
	/**
	 * @var array
	 */
	protected $_attributes = array(
		"class" => "search-query",
	);
	/**
	 * @var string
	 */
	protected $append = '<button class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>';
}
