<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Textbox
 */
class Element_Textbox extends Element {
	/**
	 * @var array
	 */
	protected $_attributes = array( "type" => "text" );
	/**
	 * @var
	 */
	protected $prepend;
	/**
	 * @var
	 */
	protected $append;

	public function render() {
		$addons = array();
		if ( ! empty( $this->prepend ) ) {
			$addons[] = "input-group";
		} else if ( ! empty( $this->append ) ) {
			$addons[] = "input-group";
		}
		if ( ! empty( $addons ) ) {
			echo '<div class="', implode( " ", $addons ), '">';
		}

		$this->renderAddOn( "prepend" );
		parent::render();
		$this->renderAddOn( "append" );

		if ( ! empty( $addons ) ) {
			echo '</div>';
		}
	}

	/**
	 * @param string $type
	 */
	protected function renderAddOn( $type = "prepend" ) {
		if ( empty ( $this->$type ) ) {
			return;
		}

		$span = true;
		if ( strpos( $this->$type, "<button" ) !== false ) {
			$span = false;
		}

		if ( $span ) {
			echo '<span class="input-group-addon">';
		} else {
			echo '<span class="input-group-btn">';
		}

		echo $this->$type;

		echo '</span>';
	}
}
