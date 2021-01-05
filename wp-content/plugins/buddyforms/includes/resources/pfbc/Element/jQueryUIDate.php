<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_jQueryUIDate
 */
class Element_jQueryUIDate extends Element_Textbox {
	/**
	 * @var array
	 */
	protected $_attributes = array(
		"type"         => "text",
		"autocomplete" => "off"
	);
	/**
	 * @var
	 */
	protected $jQueryOptions;

	/**
	 * @return array
	 */
	public function getCSSFiles() {
		return array(
//			$this->_form->getPrefix() . "://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.min.css"
		);
	}

	/**
	 * @return array
	 */
	public function getJSFiles() {
		return array(
			$this->_form->getPrefix() . "://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"
		);
	}

	public function jQueryDocumentReady() {
		parent::jQueryDocumentReady();
		echo 'jQuery("#', $this->_attributes["id"], '").datepicker(', $this->jQueryOptions(), ');';
	}

	public function render() {
		$this->validation[] = new Validation_Date;
		parent::render();
	}
}
