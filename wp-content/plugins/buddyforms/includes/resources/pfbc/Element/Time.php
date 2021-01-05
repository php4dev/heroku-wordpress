<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Time
 */
class Element_Time extends Element_Textbox {
	/**
	 * Element_Date constructor.
	 *
	 * @param $label
	 * @param $name
	 * @param $field_options
	 * @param array|null $properties
	 */
	public function __construct( $label, $name, $field_options, array $properties = null ) {
		if ( ! empty( $properties['class'] ) ) {
			$properties['class'] .= ' bf_jquerytimeaddon ';
		} else {
			$properties['class'] = ' bf_jquerytimeaddon ';
		}

		$show_label = isset( $field_options['is_inline'] ) && isset( $field_options['is_inline'][0] ) && $field_options['is_inline'][0] === 'is_inline';
		if ( $show_label ) {
			$properties['label'] = $label;
		}

		parent::__construct( $label, $name, $properties, $field_options );
	}

	public function render() {
		wp_enqueue_script( 'buddyforms-jquery-ui-timepicker-addon-js', BUDDYFORMS_ASSETS . 'resources/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.js', array(
			'jquery-ui-core',
			'jquery-ui-datepicker',
			'jquery-ui-slider'
		) );
		wp_enqueue_style( 'buddyforms-jquery-ui-timepicker-addon-css', BUDDYFORMS_ASSETS . 'resources/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.css' );

		$expected_format = ! empty( $this->field_options['element_time_format'] ) ? $this->field_options['element_time_format'] : '';

		if ( ! empty( $expected_format ) ) {
			$this->validation[] = new Validation_Time ( "Error: The %element% field must match the following time format: " . ! empty( $expected_format ) ? $expected_format : '', $this->field_options );
		}
		parent::render();
	}
}
