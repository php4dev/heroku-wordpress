<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class View_Frontend
 */
class View_Frontend extends FormView {
	/**
	 * @var string
	 */
	protected $class = "form-inline";

	/**
	 * @param null $onlyElement
	 */
	public function render( $onlyElement = null ) {
		global $buddyforms, $form_slug;

		$field_id     = $this->_form->getAttribute( "field_id" );
		$layout_style = buddyforms_layout_style( $field_id );

		$this->class = apply_filters( 'buddyforms_forms_classes', $this->class, $this, $form_slug );
		if ( $this->class ) {
			$this->_form->appendAttribute( "class", $this->class );
		}

		$this->_form->getErrorView()->render();
		echo '<form ', $this->_form->getAttributes(), "><!--csrftoken--><fieldset> ";
		if ( $onlyElement && $onlyElement == 'open' ) {
			return;
		}

		$elements     = $this->_form->getElements();
		$elementSize  = sizeof( $elements );
		$elementCount = 0;
		for ( $e = 0; $e < $elementSize; ++ $e ) {
			$element = $elements[ $e ];
			$element = apply_filters( 'buddyforms_pre_render_element', $element, $this );
			if ( $element instanceof Element_Button ) {
				if ( $e == 0 || ! $elements[ ( $e - 1 ) ] instanceof Element_Button ) {
					echo '<div class="form-actions ' . $layout_style . '">';
				} else {
					echo ' ';
				}
				$element->render();
				if ( ( $e + 1 ) == $elementSize || ! $elements[ ( $e + 1 ) ] instanceof Element_Button ) {
					echo '</div>';
				}

			} else {
				$this->renderElement( $element );
			}
			++ $elementCount;
		}

		$this->renderFormClose();
	}

	/**
	 * @param Element $element
	 */
	public function renderElement( $element ) {
		global $form_slug, $buddyforms;

		$field_id     = $element->getAttribute( "field_id" );
		$layout_style = buddyforms_layout_style( $field_id );

		$is_first_row = false;

		if ( ! empty( $buddyforms[ $form_slug ]['layout']['cords'] ) && isset( $buddyforms[ $form_slug ]['layout']['cords'][ $field_id ] ) ) {
			$reverse_layout_fields = array_reverse( $buddyforms[ $form_slug ]['layout']['cords'] );
			foreach ( $buddyforms[ $form_slug ]['layout']['cords'] as $key => $val ) {
				$reverse_layout_fields[ $key ] = 100 / intval( $val );
			}
			$total_width = 0;
			foreach ( $reverse_layout_fields as $reverse_field_id => $width ) {
				$total_width                                                               += $width;
				$buddyforms[ $form_slug ]['form_fields'][ $reverse_field_id ]['first_row'] = ( $total_width === 100 );
				if ( $total_width === 100 ) {
					$total_width = 0;
				}
			}

			$is_first_row = $buddyforms[ $form_slug ]['form_fields'][ $field_id ]['first_row'];
		}

		if ( $element instanceof Element_Hidden ) {
			$element->render();

			return;
		}

		if ( $element instanceof Element_InlineHTML ) {
			$element->render();

			return;
		}

		$style_first_row = ! empty( $is_first_row ) ? ' bf-start-row' : '';
		echo '<div class="' . $layout_style . $style_first_row . '">';

		if ( $element instanceof Element_HTML || $element instanceof Element_Content ) {
			$element->render();
			echo "</div>";

			return;
		}

		$attr_error = $element->getAttribute( 'error' );
		$opt_error  = $element->getOption( 'error' );
		if ( ! empty( $attr_error ) || ! empty( $opt_error ) ) {
			$element->appendAttribute( 'class', 'error' );
		}

		$date_is_inline = false;
		if ( $element instanceof Element_Date ) {
			$date_is_inline = isset( $buddyforms[ $form_slug ]['form_fields'][ $field_id ] )
			                  && isset( $buddyforms[ $form_slug ]['form_fields'][ $field_id ] )
			                  && isset( $buddyforms[ $form_slug ]['form_fields'][ $field_id ]['is_inline'] )
			                  && $buddyforms[ $form_slug ]['form_fields'][ $field_id ]['is_inline'][0] === 'is_inline';
		}

		if ( ! $element instanceof Element_Range && ! $element instanceof Element_Radio && ! $element instanceof Element_Checkbox && ! $element instanceof Element_File && ! $date_is_inline ) {

			$element->appendAttribute( "class", "form-control" );

			if ( isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) && $buddyforms[ $form_slug ]['layout']['labels_layout'] == 'inline' ) {

				if ( empty( $label ) ) {
					$label = $element->getLabel();
				}

				if ( ! $element instanceof Element_Upload && ! $element instanceof Element_File ) {
					if ( $element->isRequired() ) {
						$label = $label . html_entity_decode( $this->getRequiredPlainSignal() );
					}
				}

				$element->setAttribute( "placeholder", $label );
				$element->setLabel( "" );
			}
		}

		echo '<div class="bf_field_group elem-' . $element->getAttribute( "id" ) . '"> ', $this->renderLabel( $element ), '<div class="bf-input">';
		if ( isset( $buddyforms[ $form_slug ]['layout']['desc_position'] ) && $buddyforms[ $form_slug ]['layout']['desc_position'] == 'above_field' ) {
			echo $this->renderDescriptions( $element );
			echo $element->render();
		} else {
			echo $element->render();
			echo $this->renderDescriptions( $element );
		}
		echo "</div></div></div>";
	}

	/**
	 * @param Element $element
	 */
	protected function renderLabel( Element $element ) {
		global $form_slug, $buddyforms;

		$label    = $element->getLabel();
		$field_id = $element->getAttribute( "field_id" );

		$date_is_inline = false;
		if ( $element instanceof Element_Date ) {
			$date_is_inline = isset( $buddyforms[ $form_slug ]['form_fields'][ $field_id ] )
			                  && isset( $buddyforms[ $form_slug ]['form_fields'][ $field_id ] )
			                  && isset( $buddyforms[ $form_slug ]['form_fields'][ $field_id ]['is_inline'] )
			                  && $buddyforms[ $form_slug ]['form_fields'][ $field_id ]['is_inline'][0] === 'is_inline';
		}

		//No echo label for captcha
		if ( $element instanceof Element_Captcha ) {
			return;
		}

		//TODO not echo label if the textarea already have it
		if ( $element instanceof Element_Textarea || $element instanceof Element_PostExcerpt ) {
			$val = $element->getAttribute("value");
			if ( ! empty( $val) && is_string( $val ) ) {
				$have_label_string = strpos( $val, '</label>' );
				if ( $have_label_string !== false ) {
					return;
				}
			}
		}

		//TODO improve required flag position adding new layout option to place before/after the label or the placeholder
		if ( isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) && $buddyforms[ $form_slug ]['layout']['labels_layout'] != 'inline' || $date_is_inline || $element instanceof Element_Checkbox || $element instanceof Element_Radio ) {
			if ( $element->isRequired() ) {
				$gdpr_required = false;
				if ( $element->getAttribute( 'data-element-slug' ) ) {
					$gdpr_required = $element->getAttribute( 'data-element-slug' ) === 'gdpr-agreement' ? true : false;
				}
				if ( ! $gdpr_required ) {
					$label = $label . html_entity_decode( $this->renderRequired() );
				}

			}
		}

		echo sprintf( ' <label for="%s">%s</label>', $element->getAttribute( "id" ), $label );
	}
}


function buddyforms_layout_style( $field_id ) {
	global $buddyforms, $form_slug;

	$layout_style = isset( $buddyforms[ $form_slug ]['layout']['cords'][ $field_id ] ) ? $buddyforms[ $form_slug ]['layout']['cords'][ $field_id ] : '1';

	$custom_class = '';
	if ( ! empty( $field_id ) && ! empty( $buddyforms[ $form_slug ]['form_fields'] ) ) {
		$custom_class = ! empty( $buddyforms[ $form_slug ]['form_fields'][ $field_id ]['custom_class'] ) ? 'col-' . stripcslashes( $buddyforms[ $form_slug ]['form_fields'][ $field_id ]['custom_class'] ) : '';
	}

	switch ( $layout_style ) {
		case '1' :
			$layout_style = 'col-xs-12';
			break;
		case '2' :
			$layout_style = 'col-md-6';
			break;
		case '3' :
			$layout_style = 'col-md-4';
			break;
		case '4' :
			$layout_style = 'col-md-3';
			break;
		case '5' :
			$layout_style = 'col-md-8';
			break;
		case '6' :
			$layout_style = 'col-md-9';
			break;
		default:
			$layout_style = 'col-xs-12';
			break;
	}

	return apply_filters( 'buddyforms_layout_style', $layout_style . ' ' . $custom_class, $field_id );
}
