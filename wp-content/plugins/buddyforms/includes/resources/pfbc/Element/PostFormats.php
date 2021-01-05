<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_PostFormats
 */
class Element_PostFormats extends Element_Select {

	public function render() {
		parent::render();
	}

	public static function required_validate( $is_valid, $value, $instance ) {
		if ( $instance instanceof Element_PostFormats ) {
			$is_valid = ! empty( $value ) && ($value !== 'Select a Post Format' || $value !== 'Select a Post Format *');
		}

		return $is_valid;
	}


}
