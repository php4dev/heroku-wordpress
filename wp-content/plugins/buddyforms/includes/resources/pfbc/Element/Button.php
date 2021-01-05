<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Button
 */
class Element_Button extends Element {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "submit", "value" => "Submit" );
	/**
	 * @var
	 */
	protected $icon;

	/**
	 * Element_Button constructor.
	 *
	 * @param string $label
	 * @param string $type
	 * @param array|null $properties
	 */
	public function __construct( $label = "Submit", $type = "", array $properties = null ) {
		if ( ! is_array( $properties ) ) {
			$properties = array();
		}

		if ( ! empty( $type ) ) {
			$properties["type"] = $type;
		}

		$class = "btn";
		if ( empty( $type ) || $type == "submit" ) {
			$class .= " btn-primary";
		}

		if(!empty($type) && $type === 'button' && $properties['name'] === 'draft'){
			$class .= " btn-alt bf-draft";
		}

		if ( ! empty( $properties["class"] ) ) {
			$properties["class"] .= " " . $class;
		} else {
			$properties["class"] = $class;
		}

		$properties["value"] = __( 'Submit', 'buddyforms' );
		if ( ! empty( $label ) ) {
			$properties["value"] = $label;
		}

		parent::__construct( $label, "", $properties );
	}

	public function render() {
		$value = $this->getAttribute( "value" );
		if ( ! empty ( $this->icon ) ) {
			if ( $this->icon[0] == 'f' && $this->icon[1] == 'a' ) {
				$value = '<i class="' . $this->icon . '"></i> ' . $value;
			} else {
				$value = '<span class="' . $this->icon . '"></span> ' . $value;
			}
		}
		echo '<button', $this->getAttributes( array( 'value' ) ), '>', $value, '</button> ';
	}
}
