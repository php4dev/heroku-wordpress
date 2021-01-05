<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class ErrorView
 */
abstract class ErrorView extends Base {
	/**
	 * @var Form
	 */
	protected $_form;

	/**
	 * ErrorView constructor.
	 *
	 * @param array|null $properties
	 */
	public function __construct( array $properties = null ) {
		$this->configure( $properties );
	}

	public abstract function render();

	public abstract function renderCSS();

	public abstract function renderAjaxErrorResponse();

	public function clear() {
		echo 'jQuery("#', $this->_form->getAttribute( "id" ), ' .alert-error").remove();';
	}
}
