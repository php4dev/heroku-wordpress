<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


class BuddyForms_Error extends WP_Error {
	/**
	 * @var string
	 */
	private $form_slug;

	public function __construct( $code = '', $message = '', $data = '', $form_slug = '' ) {
		$this->form_slug = $form_slug;
		parent::__construct( $code, $message, $data );
	}

	/**
	 * @return string
	 */
	public function get_form_slug() {
		return $this->form_slug;
	}

	/**
	 * @param string $form_slug
	 */
	public function set_form_slug( $form_slug ) {
		$this->form_slug = $form_slug;
	}

	public function add( $code, $message, $data = '', $form_slug = '' ) {
		if ( ! empty( $form_slug ) ) {
			$this->set_form_slug( $form_slug );
		}

		if ( ! empty( $data ) ) {
			$this->error_data[ $code ]      = $data;
			$this->errors[ $code ][ $data ] = $message;
		} else {
			$this->errors[ $code ][] = $message;
		}
	}


}