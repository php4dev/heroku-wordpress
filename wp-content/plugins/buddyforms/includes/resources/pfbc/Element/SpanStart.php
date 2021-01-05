<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_SpanStart
 */
class Element_SpanStart extends Element_HTML {
	/**
	 * Element_SpanStart constructor.
	 *
	 * @param $value
	 * @param int $size
	 */
	public function __construct( $value, $size = 6 ) {
		if ( empty ( $size ) ) {
			$size = 6;
		}
		$html = "<div class='col-md-{$size}'>";
		if ( $value == 1 ) {
			$html = "<div class='row'>" . $html;
		}

		if ( $value > 1 ) {
			$html = "</div>" . $html;
		} else if ( $value == 0 ) {
			$html = "</div></div>";
		}

		parent::__construct( $html );
	}
}
