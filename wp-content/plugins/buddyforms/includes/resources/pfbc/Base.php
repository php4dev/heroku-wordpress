<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Base
 */
abstract class Base {
	/**
	 * @var array
	 */
	protected $field_options = array();

	/**
	 * @param array|null $properties
	 *
	 * @return $this
	 */
	public function configure( array $properties = null ) {
		if ( ! empty( $properties ) ) {
			$class = get_class( $this );

			/*The property_reference lookup array is created so that properties can be set
			case-insensitively.*/
			$available          = array_keys( get_class_vars( $class ) );
			$property_reference = array();
			foreach ( $available as $property ) {
				$property_reference[ trim( $property ) ] = $property;
			}

			/*The method reference lookup array is created so that "set" methods can be called
			case-insensitively.*/
			$available        = get_class_methods( $class );
			$method_reference = array();
			foreach ( $available as $method ) {
				$method_reference[ trim( $method ) ] = $method;
			}

			foreach ( $properties as $property => $value ) {
				$property = trim( $property );
				/*Properties beginning with "_" cannot be set directly.*/
				if ( $property[0] != "_" ) {
					/*If the appropriate class has a "set" method for the property provided, then
					it is called instead or setting the property directly.*/
					if ( isset ( $method_reference[ "set" . $property ] ) ) {
						$funcName = $method_reference[ "set" . $property ];
						$this->$funcName ( $value );
					} elseif ( isset( $property_reference[ $property ] ) ) {
						$funcName        = $property_reference[ $property ];
						$this->$funcName = $value;
					} /*Entries that don't match an available class property are stored in the attributes
                    property if applicable.  Typically, these entries will be element attributes such as
                    class, value, onkeyup, etc.*/
					else {
						$this->setAttribute( $property, $value );
					}
				}
			}
		}

		return $this;
	}

	/*This method can be used to view a class' state.*/

	/**
	 * @param $attribute
	 * @param $value
	 */
	public function setAttribute( $attribute, $value ) {
		if ( isset ( $this->_attributes ) ) {
			$this->_attributes[ $attribute ] = $value;
		}
	}

	/**
	 * @param $attribute
	 */
	public function unsetAttribute( $attribute ) {
		if ( isset ( $this->_attributes ) ) {
			unset( $this->_attributes[ $attribute ] );
		}
	}


	/*This method prevents double/single quotes in html attributes from breaking the markup.*/

	public function debug() {
		echo "<pre>", print_r( $this, true ), "</pre>";
	}

	/**
	 * @param $attribute
	 *
	 * @return string
	 */
	public function getAttribute( $attribute ) {
		if ( isset ( $this->_attributes[ $attribute ] ) ) {
			return ! empty( $this->_attributes[ $attribute ] ) ? $this->_attributes[ $attribute ] : '';
		}

		return '';
	}

	/**
	 * Method is used by the Form class and all Element classes to return a string of html  attributes
	 *
	 * @param Parameter|string $ignore Parameter allows special attributes from being included.
	 *
	 * @return string
	 */
	public function getAttributes( $ignore = '' ) {
		$str = '';
		if ( ! empty( $this->_attributes ) ) {
			if ( ! is_array( $ignore ) ) {
				$ignore = array( $ignore );
			}
			if ( ! empty( $this->_errors ) ) {
				if ( isset( $this->_attributes['class'] ) ) {
					$this->_attributes['class'] .= ' error';
				} else {
					$this->_attributes['class'] = 'error ';
				}
			}
			$attributes = array_diff( array_keys( $this->_attributes ), $ignore );
			$attributes = apply_filters( 'buddyforms_element_attribute', $attributes, $this );
			foreach ( $attributes as $attribute ) {
				$str .= ' ' . $attribute;
				if ( $this->_attributes[ $attribute ] !== "" ) {
					$str .= '="' . $this->filter( $this->_attributes[ $attribute ] ) . '"';
				}
			}
		}

		return $str;
	}

	/**
	 * Filter special characters
	 *
	 * @param $str
	 *
	 * @return string
	 */
	protected function filter( $str ) {
		if ( is_array( $str ) ) {
			return array_walk_recursive( $str, array( $this, 'apply_filter' ) );
		} else {
			return htmlspecialchars( $str );
		}
	}

	/**
	 * Convert special characters to HTML entities
	 *
	 * @param $str
	 *
	 * @internal
	 *
	 */
	public function apply_filter( &$str ) {
		$str = htmlspecialchars( $str );
	}

	/**
	 * @param $attribute
	 * @param $value
	 */
	public function appendAttribute( $attribute, $value ) {
		if ( isset ( $this->_attributes ) ) {
			if ( ! empty ( $this->_attributes[ $attribute ] ) ) {
				$this->_attributes[ $attribute ] .= " " . $value;
			} else {
				$this->_attributes[ $attribute ] = $value;
			}
		}
	}

	/**
	 * Get the Required Signal by default &nbsp;*&nbsp;
	 *
	 * @return string
	 */
	public function getRequiredSignal() {
		return apply_filters( 'buddyforms_render_required_signal', '&nbsp;&ast;&nbsp;' );
	}

	/**
	 * Get the Required Signal in plain string by default ` * `
	 *
	 * @return string
	 */
	public function getRequiredPlainSignal() {
		return apply_filters( 'buddyforms_render_plain_required_signal', ' * ' );
	}

	/**
	 * Output or return the required flag
	 *
	 * @param bool $echo
	 *
	 * @return string|void
	 */
	public function renderRequired( $echo = false ) {
		$html = sprintf( '&nbsp;<span class="required">%s</span>&nbsp;', $this->getRequiredSignal() );
		if ( $echo ) {
			echo $html;
		} else {
			return $html;
		}
	}

	/**
	 * @return array
	 */
	public function getFieldOptions() {
		return $this->field_options;
	}

	/**
	 * @param $attribute
	 *
	 * @return string
	 */
	public function getOption( $attribute ) {
		if ( ! empty ( $this->field_options[ $attribute ] ) ) {
			return $this->field_options[ $attribute ];
		}

		return '';
	}

	/**
	 * @param array $field_options
	 */
	public function setFieldOptions( $field_options ) {
		$this->field_options = $field_options;
	}
}
