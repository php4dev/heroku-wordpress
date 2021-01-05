<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Hidden
 */
class Element_Hidden extends Element {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "hidden" );

	/**
	 * Element_Hidden constructor.
	 *
	 * @param $name
	 * @param string $value
	 * @param array|null $properties
	 */
	public function __construct( $name, $value = "", array $properties = null ) {
		if ( ! is_array( $properties ) ) {
			$properties = array();
		}

		if ( ! empty( $value ) ) {
			$properties["value"] = $value;
		}

		parent::__construct( "", $name, $properties );
	}
}
