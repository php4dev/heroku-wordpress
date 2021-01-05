<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class OptionElement
 */
abstract class OptionElement extends Element {
	/**
	 * @var array
	 */
	protected $options;

	/**
	 * OptionElement constructor.
	 *
	 * @param $label
	 * @param $name
	 * @param array|null $options
	 * @param array|null $properties
	 * @param array|null $field_options
	 */
	public function __construct( $label, $name, $options, array $properties = null, array $field_options = null ) {
		if ( ! is_array( $options ) ) {
			$options = Array();
		}
		$this->options = $options;
		if ( ! empty( $this->options ) && array_values( $this->options ) === $this->options ) {
			$this->options = array_combine( $this->options, $this->options );
		}

		parent::__construct( $label, $name, $properties, $field_options );
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	protected function getOptionValue( $value ) {
		$position = strpos( $value, ":pfbc" );
		if ( $position !== false ) {
			if ( $position == 0 ) {
				$value = "";
			} else {
				$value = substr( $value, 0, $position );
			}
		}

		return $value;
	}
}
