<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Content
 */
class Element_Content extends Element {

	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "content" );

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
	public function __construct( $label, $name, $value, $field_options ) {
		global $field_id;

		$properties = array(
			"value"    => $value,
			"field_id" => $field_id
		);

		if ( ! empty( $field_options ) && ! empty( $field_options['required'] ) && $field_options['required'][0] === 'required' ) {
			$this->setValidation(new Validation_Required( $this->message, $field_options ));
		}

		parent::__construct( $label, $name, $properties, $field_options );
	}

//	public function isValid( $value ) {
//		if ( ! empty( $this->field_options ) && ! empty( $this->field_options['required'] ) && $this->field_options['required'][0] === 'required' ) {
//			$validation = new Validation_Required( $this->message, $this->field_options );
//
//			$value = $this->getAttribute( 'value' );
	/*			preg_match_all( '/<textarea .*?>(.*?)<\/textarea>/s', $value, $matches );*/
//
//			$result = ! empty( $matches[1][0] );
//
//			if ( ! $result ) {
//				$global_error = ErrorHandler::get_instance();
//				$form_slug    = $this->_form->getAttribute('id');
//				if ( ! empty( $form_slug ) ) {
//					$global_error->add_error( new BuddyForms_Error( 'buddyforms_form_' . $form_slug, $validation->getMessage(), $this->getOption( 'slug' ), $form_slug ) );
//				} else {
//					$this->_errors[] = str_replace( "%element%", $this->getLabel(), $validation->getMessage() );
//				}
//			}
//
//			return apply_filters( 'buddyforms_element_content_validation', $result, $this );
//		} else {
//			return true;
//		}
//	}


	public function render() {
		wp_enqueue_style( 'wp_editor_css', includes_url( '/css/editor.css' ) );
		echo $this->_attributes["value"];
	}
}
