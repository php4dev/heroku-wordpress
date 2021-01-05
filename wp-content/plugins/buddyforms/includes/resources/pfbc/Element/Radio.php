<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Radio
 */
class Element_Radio extends OptionElement {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "radio" );
	/**
	 * @var
	 */
	protected $inline;

	public function render() {
		$labelClass = $this->getAttribute( 'class' );
		if ( ! empty( $this->inline ) ) {
			$labelClass .= "radio-inline";
		}

		$count = 0;
		echo '<div class="radio">';
		foreach ( $this->options as $value => $text ) {
			$value = $this->getOptionValue( $value );
			if ( ! empty( $labelClass ) ) {
				$label_start = sprintf( '<label class="%s">', $labelClass );
			} else {
				$label_start = '<label>';
			}
			$label_end = '</label>';
			$input     = array( '<input' );
			if ( ! empty( $this->_attributes['id'] ) ) {
				$input[] = sprintf( 'id="%s"', $this->_attributes['id'] . '-' . $count );
			}
			$input[] = $this->getAttributes( array( "id", "class", "value", "checked" ) );
			$input[] = sprintf( 'value="%s"', $this->filter( $value ) );
			if ( isset( $this->_attributes["value"] ) && $this->_attributes["value"] == $value ) {
				$input[] = 'checked="checked"';
			}
			$input[] = '/>';

			$text_out = sprintf( ' %s ',  $text );
			echo $label_start . join( ' ', $input ) . $text_out . $label_end;

			++ $count;
			if ( $labelClass != 'radio-inline' ) {
				echo '</div><div class="radio">';
			}
		}
		if ( $this->getAttribute( 'frontend_reset' ) ) {
			echo '<a href="#" class="button bf_reset_multi_input" data-group-name="' . $this->getAttribute( 'name' ) . '">Reset</a>';
		}
		echo '</div>';
	}
}
