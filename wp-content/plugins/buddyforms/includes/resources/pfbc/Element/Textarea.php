<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Textarea
 */
class Element_Textarea extends Element {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "textarea", "rows" => "5" );

	/**
	 * @var string
	 */
	protected $message = "Error: %element% is a required field.";

	/**
	 * Element_Content constructor.
	 *
	 * @param $label
	 * @param $name
	 * @param $value
	 * @param $field_options
	 */
	public function __construct( $label, $name, $value, array $field_options = null ) {
		global $field_id;

		$properties = array(
			"value"    => $value,
			"field_id" => $field_id
		);
		if ( ! empty( $properties["value"] ) && is_array( $properties["value"] ) ) {
			//Only include this attributes if the textarea to build is not a HTML string
			if ( ! empty( $field_options ) ) {
				$this->shortDesc = isset( $field_options['description'] ) ? $field_options['description'] : null;
			} elseif ( ! empty( $value['shortDesc'] ) ) {
				$this->shortDesc = $value['shortDesc'];
			}
			if ( ! empty( $field_options ) && ! empty( $field_options['required'] ) && ( $field_options['required'][0] === 'required' || $field_options['required'] == 'required' || $field_options['required'] ) ) {
				$validation_message = ! empty( $field_options['validation_error_message'] ) ? $field_options['validation_error_message'] : str_replace( "%element%", $this->getLabel(), $this->message );
				$this->setValidation( new Validation_Required( $validation_message, $field_options ) );
			}
		}
		parent::__construct( $label, $name, $properties, $field_options );
	}

	public function render( $echo = true ) {
		if ( ! empty( $this->_attributes["value"] ) && is_array( $this->_attributes["value"] ) ) {
		    $data_rule_minlength = "";
            $data_rule_maxlength = "";
            if ( ! empty( $this->_attributes["value"]['data-rule-minlength'] ) ) {
                $data_rule_minlength = sprintf('data-rule-minlength ="%s"', $this->_attributes["value"]['data-rule-minlength'] );
            }
            if ( ! empty( $this->_attributes["value"]['data-rule-maxlength'] ) ) {
                $data_rule_maxlength = sprintf('data-rule-maxlength ="%s"', $this->_attributes["value"]['data-rule-maxlength'] );
            }
			$output = '<textarea' . $this->getAttributes("value" ) .$data_rule_maxlength .' '.$data_rule_minlength.'>';
			if ( ! empty( $this->_attributes["value"]['value'] ) ) {
				$output .= $this->filter( $this->_attributes["value"]['value'] );
			}

			$output .= '</textarea>';
		} elseif ( ! empty( $this->_attributes["value"] ) && is_string( $this->_attributes["value"] ) ) {
			$output = $this->_attributes["value"];
		}

		if ( $echo ) {
			echo $output;

			return '';
		} else {
			return $output;
		}
	}

	public function isValid( $value ) {
		if ( ! empty( $this->field_options ) && ! empty( $this->field_options['required'] ) && $this->field_options['required'][0] === 'required' ) {
			$validation = new Validation_Required( $this->message, $this->field_options );

			$value = $this->getAttribute( 'value' );
			if ( ! empty( $value ) && is_array( $value ) ) {
				$value = $value['value'];
			}
			preg_match_all( '/<textarea .*?>(.*?)<\/textarea>/s', $value, $matches );

			$is_empty      = ! empty( $matches[1][0] );
			$is_applicable = $validation->isNotApplicable( $value );

			$is_valid = ! $is_empty || ! $is_applicable;

			if ( ! $is_valid ) {
				$this->_errors[] = str_replace( "%element%", $this->getLabel(), $validation->getMessage() );
			}

			return apply_filters( 'buddyforms_element_textarea_validation', $is_valid, $this );
		} else {
			return true;
		}
	}
}
