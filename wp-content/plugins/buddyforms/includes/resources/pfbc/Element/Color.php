<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Color
 */
class Element_Color extends Element {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "text" );

	public function __construct( $label, $name, $props ) {

		if ( isset( $props['value']['style'] ) ) {
			$props["value_style"] = $props['value']['style'];
		}

		if ( isset( $props['value']['color'] ) ) {
			$props["value"] = $props['value']['color'];
		} else {
			$props["value"] = '';
		}

		parent::__construct( $label, $name, $props );
	}

	public function render() {
		global $field_id;

		$value_style = '';
		if ( isset( $this->_attributes["value_style"] ) ) {
			$value_style = $this->_attributes["value_style"];
		}

		$this->_attributes["name"]    = $this->_attributes["name"] . '[color]';
		$this->_attributes["pattern"] = "#[a-g0-9]{6}";
		$this->_attributes["class"]   = isset( $this->_attributes["class"] ) ? $this->_attributes["class"] . " bf-color" : "bf-color";
		$this->_attributes["title"]   = "6-digit hexidecimal color (e.g. #000000)";
		$this->validation[]           = new Validation_RegExp( "/" . $this->_attributes["pattern"] . "/", "Error: The %element% field must contain a " . $this->_attributes["title"] );

		$style = str_replace( '[color]', '[style]', $this->_attributes["name"] );

		echo '
		<p style="display: inline; font-size: 11px; line-height: 2.5;">
		<input data-field_id="' . sanitize_title( $this->_attributes["name"] ) . '" class="bf-color-radio" ' . checked( $value_style, 'auto', false ) . ' type="radio" name="' . $style . '" value="auto"> Auto 
		<input data-field_id="' . sanitize_title( $this->_attributes["name"] ) . '" class="bf-color-radio" ' . checked( $value_style, 'transparent', false ) . ' type="radio" name="' . $style . '" value="transparent"> Transparent 
		<input data-field_id="' . sanitize_title( $this->_attributes["name"] ) . '" class="bf-color-radio" ' . checked( $value_style, 'color', false ) . ' type="radio" name="' . $style . '" value="color"> Color
		</p><br><br>
		';

		$hidden = $value_style != "color" ? "bf-color-hidden" : "";
		echo '<div id="bf_color_container_' . sanitize_title( $this->_attributes["name"] ) . '" class="' . $hidden . '">';
		parent::render();
		echo '</div>';

	}
}
