<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }




include_once 'Error/BuddyForms_Error.php';

/**
 * Class ErrorHandler
 *
 * Manage all error in the plugin. This object store the global error
 *
 * @since 2.4.7
 */
class ErrorHandler {

	/**
	 * Instance of this class
	 *
	 * @var $instance ErrorHandler
	 */
	protected static $instance = null;
	/**
	 * @var BuddyForms_Error
	 */
	private $global_error;
	/**
	 * @var ErrorView_Standard
	 */
	private $error_view;
	/**
	 * @var Form
	 */
	private $form;

	public function __construct() {
		$this->set_global_error( new BuddyForms_Error( null, null, null, null ) );
		$this->error_view = new ErrorView_Standard;
	}

	/**
	 * Return an instance of this class.
	 *
	 *
	 * @return ErrorHandler A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function set_instance( $instance ) {
		self::$instance = $instance;
	}

	/**
	 * @return BuddyForms_Error
	 */
	public function get_global_error() {
		return $this->global_error;
	}

	public function clean_all_errors() {
		$this->global_error = new BuddyForms_Error( null, null, null, null );
	}

	/**
	 * @param BuddyForms_Error $global_error
	 */
	public function set_global_error( $global_error ) {
		$this->global_error = $global_error;
	}

	/**
	 * Add an error to the global error object
	 *
	 * @param WP_Error|BuddyForms_Error|string $error
	 */
	public function add_error( $error ) {
		if ( $error instanceof BuddyForms_Error ) {
			$this->get_global_error()->add( $error->get_error_code(), $error->get_error_message(), $error->get_error_data(), $error->get_form_slug() );
		} elseif ( $error instanceof WP_Error ) {
			$this->get_global_error()->add( $error->get_error_code(), $error->get_error_message(), $error->get_error_data() );
		} elseif ( is_array( $error ) ) {
			foreach ( $error as $item ) {
				if ( $item instanceof BuddyForms_Error || $item instanceof WP_Error ) {
					$this->get_global_error()->add( $item->get_error_code(), $item->get_error_message(), $item->get_error_data(), $item->get_form_slug() );
				} elseif ( $item instanceof WP_Error ) {
					$this->get_global_error()->add( $item->get_error_code(), $item->get_error_message(), $item->get_error_data() );
				} else {
					$this->get_global_error()->add( null, $item );
				}
			}
		} else {
			$this->get_global_error()->add( null, $error );
		}
	}

	/**
	 * Render errors when the form is process using Ajax
	 */
	public function renderAjaxErrorResponse() {
		$this->error_view->renderAjaxErrorResponse();
	}

	/**
	 * @return Form
	 */
	public function get_form() {
		return $this->form;
	}

	/**
	 * @param Form $form
	 */
	public function set_form( $form ) {
		$this->form = $form;
	}

	/**
	 * @return ErrorView_Standard
	 */
	public function get_error_view() {
		return $this->error_view;
	}
}
