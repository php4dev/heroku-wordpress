<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * BuddyForms Session
 *
 * This is a wrapper class for BF_Session / PHP $_SESSION and handles the storage of form sessions, etc
 *
 * @package     BuddyForms
 * @subpackage  Classes/Session
 * @copyright   Original work Copyright (c) 2015, Pippin Williamson, Modified work Copyright 2017 Sven Lehnert
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * buddyforms_Session Class
 *
 * @since 2.1.0.3
 */
class BuddyForms_Session {

	/**
	 * Holds our session data
	 *
	 * @var array|BF_Session
	 * @access private
	 * @since 2.1.0.3
	 */
	private $session;

	/**
	 * Session index prefix
	 *
	 * @var string
	 * @access private
	 * @since 2.1.0.3
	 */
	private $prefix = '';


	/**
	 * Get things started
	 *
	 * Defines our BF_Session constants, includes the necessary libraries and
	 * retrieves the WP Session instance
	 *
	 * @since 2.1.0.3
	 */
	public function __construct() {

		// Use BF_Session (default)
		if ( ! defined( 'WP_SESSION_COOKIE' ) ) {
			define( 'WP_SESSION_COOKIE', 'buddyforms_wp_session' );
		}

		if ( ! class_exists( 'Recursive_ArrayAccess' ) ) {
			require_once BUDDYFORMS_INCLUDES_PATH . '/resources/sessions/class-recursive-arrayaccess.php';
		}

		if ( ! class_exists( 'BF_Session' ) ) {
			require_once BUDDYFORMS_INCLUDES_PATH . '/resources/sessions/class-bf-session.php';
			require_once BUDDYFORMS_INCLUDES_PATH . '/resources/sessions/bf-session.php';
		}

		add_action( 'init', array( $this, 'init' ), - 1 );

	}

	/**
	 * Setup the BF_Session instance
	 *
	 * @access public
	 * @since 2.1.0.3
	 *
	 * @return BF_Session
	 */
	public function init() {
		$this->session = BF_Session::get_instance();

		return $this->session;
	}


	/**
	 * Retrieve session ID
	 *
	 * @access public
	 * @since 2.1.0.3
	 * @return string Session ID
	 */
	public function get_id() {
		return $this->session->session_id;
	}

	/**
	 * Retrieve a session variable
	 *
	 * @access public
	 * @since 2.1.0.3
	 *
	 * @param string $key Session key
	 *
	 * @return string Session variable
	 */
	public function get( $key ) {
		$key = sanitize_key( $key );

		return isset( $this->session[ $key ] ) ? maybe_unserialize( $this->session[ $key ] ) : false;
	}

	/**
	 * Set a session variable
	 *
	 * @since 2.1.0.3
	 *
	 * @param string $key Session key
	 * @param integer $value Session variable
	 *
	 * @return string Session variable
	 */
	public function set( $key, $value ) {
		$key = sanitize_key( $key );
		if ( is_array( $value ) ) {
			$this->session[ $key ] = serialize( $value );
		} else {
			$this->session[ $key ] = $value;
		}

		return $this->session[ $key ];
	}
}

new BuddyForms_Session();
