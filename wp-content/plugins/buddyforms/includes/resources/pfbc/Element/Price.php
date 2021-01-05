<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Date
 */
class Element_Price extends Element_Textbox {
	public function render() {
		if ( ! empty( $this->field_options ) ) {
			$this->_attributes["class"] .= ' bf_woo_price ';
		}
		//include the asset
		wp_enqueue_script( 'jquery.priceformat', BUDDYFORMS_PLUGIN_URL . 'assets/resources/jquery.priceformat.min.js', array( 'jquery' ), BUDDYFORMS_VERSION );

		parent::render();
	}

	public static function builder_element_options( $form_fields, $form_slug, $field_type, $field_id, $buddyform ) {
        $thousands_separator     = isset( $buddyform['form_fields'][ $field_id ]['thousands_separator'] ) ? stripslashes( $buddyform['form_fields'][ $field_id ]['thousands_separator'] ) : '.';
        $prefix = isset( $buddyform['form_fields'][ $field_id ]['prefix'] ) ? $buddyform['form_fields'][ $field_id ]['prefix'] : '$ ';
        $suffix = isset( $buddyform['form_fields'][ $field_id ]['suffix'] ) ? $buddyform['form_fields'][ $field_id ]['suffix'] : '';
        $cents_separator = isset( $buddyform['form_fields'][ $field_id ]['cents_separator'] ) ? $buddyform['form_fields'][ $field_id ]['cents_separator'] : ',';

        $form_fields['general']['thousands_separator'] = new Element_Textbox( '<b>' . __( 'Thousands Separator', 'buddyforms' ) . '</b>', "buddyforms_options[form_fields][" . $field_id . "][thousands_separator]", array( 'value' => $thousands_separator ) );
        $form_fields['general']['prefix'] = new Element_Textbox( '<b>' . __( 'Prefix', 'buddyforms' ) . '</b>', "buddyforms_options[form_fields][" . $field_id . "][prefix]", array( 'value' => $prefix ) );
        $form_fields['general']['suffix'] = new Element_Textbox( '<b>' . __( 'Suffix', 'buddyforms' ) . '</b>', "buddyforms_options[form_fields][" . $field_id . "][suffix]", array( 'value' => $suffix ) );
        $form_fields['general']['cents_separator'] = new Element_Textbox( '<b>' . __( 'Cents Separator', 'buddyforms' ) . '</b>', "buddyforms_options[form_fields][" . $field_id . "][cents_separator]", array( 'value' => $cents_separator ) );
		return $form_fields;
	}
}
