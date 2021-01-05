<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class View_Inline
 */
class View_Inline extends FormView {
	/**
	 * @var string
	 */
	protected $class = "form-inline";

	/**
	 * @param Element $element
	 */
	public function renderElement( $element ) {
		if ( $element instanceof Element_Hidden || $element instanceof Element_HTML || $element instanceof Element_Button ) {
			$element->render();

			return;
		}
		if ( ! $element instanceof Element_Radio && ! $element instanceof Element_Checkbox && ! $element instanceof Element_File ) {
			$element->appendAttribute( "class", "form-control" );
		}

		$attr_error   = $element->getAttribute( 'error' );
		$opt_error    = $element->getOption( 'error' );
		if ( ! empty( $attr_error ) || ! empty( $opt_error ) ) {
			$element->appendAttribute( 'class', 'error' );
		}

		if ( $this->noLabel ) {
			$label = $element->getLabel();
			$element->setAttribute( "placeholder", $label );
			$element->setLabel( "" );
		}

		echo '<div class="bf_field_group elem-' . $element->getAttribute( "id" ) . '"> ', $this->renderLabel( $element );
		echo $element->render(), $this->renderDescriptions( $element );
		echo "</div> ";
	}

	/**
	 * @param Element $element
	 */
	protected function renderLabel( Element $element ) {
		$label = $element->getLabel();

		if ( $element->isRequired() ) {
			$label = $label . $this->renderRequired();
		}

		echo sprintf(' <label for="%s">%s</label>', $element->getAttribute( "id" ), $label);
	}
}
