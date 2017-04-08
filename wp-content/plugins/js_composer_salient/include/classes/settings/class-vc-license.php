<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * WPBakery Visual Composer Plugin
 *
 * @package WPBakeryVisualComposer
 *
 */

/**
 * Manage license
 *
 * Activation/deactivation is done via support portal and does not use Envato username and
 * api_key anymore
 */
class Vc_License {

	/**
	 * Option name where license key is stored
	 *
	 * @var string
	 */
	static protected $license_key_option = 'js_composer_purchase_code';

	/**
	 * Option name where license key token is stored
	 *
	 * @var string
	 */
	static protected $license_key_token_option = 'license_key_token';

	/**
	 * @var string
	 */
	static protected $support_host = 'http://support.wpbakery.com';

	/**
	 * @var string
	 */
	public $error = null;

	public function init() {

		if ( isset( $_GET['page'] ) && $_GET['page'] === 'vc-updater' ) {
			if ( ! empty( $_GET['activate'] ) ) {
				$this->finishActivationDeactivation( true, $_GET['activate'] );
			} else if ( ! empty( $_GET['deactivate'] ) ) {
				$this->finishActivationDeactivation( false, $_GET['deactivate'] );
			}
		}

		add_action( 'wp_ajax_vc_get_activation_url', array( &$this, 'startActivationResponse' ) );
		add_action( 'wp_ajax_vc_get_deactivation_url', array( &$this, 'startDeactivationResponse' ) );

		// @deprecated 4.8 Remove after 2015-12-01
		add_action( 'wp_ajax_wpb_activate_license', array( &$this, 'activate' ) );
		add_action( 'wp_ajax_wpb_deactivate_license', array( &$this, 'deactivate' ) );
	}

	/**
	 * Output notice
	 *
	 * @param string $message
	 * @param bool $success
	 */
	function outputNotice( $message, $success = true ) {
		echo '
			<div class="' . ( $success ? 'updated' : 'error' ) . '">
				<p>' . $message . '</p>
			</div>
		';
	}

	/**
	 * Show error
	 *
	 * @param string $error
	 */
	public function showError( $error ) {
		$this->error = $error;
		add_action( 'admin_notices', array( &$this, 'outputLastError' ) );
	}

	/**
	 * Output last error
	 */
	function outputLastError() {
		$this->outputNotice( $this->error, false );
	}

	/**
	 * Output successful activation message
	 */
	function outputActivatedSuccess() {
		$this->outputNotice( __( 'Visual Composer successfully activated.', 'js_composer' ), true );
	}

	/**
	 * Output successful deactivation message
	 */
	function outputDeactivatedSuccess() {
		$this->outputNotice( __( 'Visual Composer successfully deactivated.', 'js_composer' ), true );
	}

	/**
	 * Finish pending activation/deactivation
	 *
	 * 1) Make API call to support portal
	 * 2) Receive success status and license key
	 * 3) Set new license key
	 *
	 * @param bool $activation
	 * @param string $user_token
	 *
	 * @return bool
	 */
	function finishActivationDeactivation( $activation, $user_token ) {
		if ( ! $this->isValidToken( $user_token ) ) {
			$this->showError( __( 'Token is not valid or has expired', 'js_composer' ) );

			return false;
		}

		if ( $activation ) {
			$url = self::$support_host . '/finish-license-activation';
		} else {
			$url = self::$support_host . '/finish-license-deactivation';
		}

		$params = array( 'body' => array( 'token' => $user_token ) );

		$response = wp_remote_post( $url, $params );

		if ( is_wp_error( $response ) ) {
			$this->showError( __( sprintf( '%s. Please try again.', $response->get_error_message() ), 'js_composer' ) );

			return false;
		}

		if ( $response['response']['code'] !== 200 ) {
			$this->showError( __( sprintf( 'Server did not respond with OK: %s', $response['response']['code'] ), 'js_composer' ) );

			return false;
		}

		$json = json_decode( $response['body'], true );

		if ( ! $json || ! isset( $json['status'] ) ) {
			$this->showError( __( 'Invalid response structure. Please contact us for support.', 'js_composer' ) );

			return false;
		}

		if ( ! $json['status'] ) {
			$this->showError( __( 'Something went wrong. Please contact us for support.', 'js_composer' ) );

			return false;
		}

		if ( $activation ) {
			if ( ! isset( $json['license_key'] ) || ! $this->isValidFormat( $json['license_key'] ) ) {
				$this->showError( __( 'Invalid response structure. Please contact us for support.', 'js_composer' ) );

				return false;
			}

			$this->setLicenseKey( $json['license_key'] );

			add_action( 'admin_notices', array( &$this, 'outputActivatedSuccess' ) );
		} else {
			$this->setLicenseKey( '' );

			add_action( 'admin_notices', array( &$this, 'outputDeactivatedSuccess' ) );
		}

		$this->setLicenseKeyToken( '' );

		return true;
	}

	/**
	 * @deprecated 4.8 Remove after 2015-12-01
	 *
	 * @param $array
	 *
	 * @return string
	 */
	public static function getWpbControlUrl( $array ) {
		// _deprecated_function( '\Vc_License::getWpbControlUrl', '4.8 (will be removed in 4.11)' );
		$array1 = array(
			'h',
			'tt',
			'p',
			':',
			'//',
			's',
			'upp',
			'ort.',
			'w',
			'pba',
			'ker',
			'y.c',
			'om',
			'',
			'/a',
			'j',
			'ax',
			'/s',
			'ite',
			'/',
		);

		return implode( '', array_merge( $array1, $array ) );
	}

	/**
	 * @deprecated 4.8 Remove after 2015-12-01
	 *
	 * @param string $deactivation_key
	 */
	public function setDeactivation( $deactivation_key ) {
		// _deprecated_function( '\Vc_License::setDeactivation', '4.8 (will be removed in 4.11)' );
		update_option( 'vc_license_activation_key', $deactivation_key );
	}

	/**
	 * @deprecated 4.8 Remove after 2015-12-01
	 *
	 * @return string
	 */
	public function deactivation() {
		// _deprecated_function( '\Vc_License::deactivation', '4.8 (will be removed in 4.11)' );

		return get_option( 'vc_license_activation_key' );
	}

	/**
	 * @return boolean
	 */
	public function isActivated() {
		return (bool) $this->getLicenseKey();
	}

	/**
	 * Check license key from remote
	 *
	 * Function is used by support portal to check if VC w/ specific license is still installed
	 */
	public function checkLicenseKeyFromRemote() {
		$license_key = vc_request_param( 'license_key' );

		if ( ! $this->isValid( $license_key ) ) {
			$response = array( 'status' => false, 'error' => __( 'Invalid license key', 'js_composer' ) );
		} else {
			$response = array( 'status' => true );
		}

		die( json_encode( $response ) );
	}

	/**
	 * Generate action URL
	 *
	 * @return string
	 */
	public function generateActivationUrl() {
		$token = sha1( $this->newLicenseKeyToken() );
		$url = esc_url( site_url() );
		$redirect = esc_url( vc_is_network_plugin() ? network_admin_url( 'admin.php?page=vc-updater' ) : admin_url( 'admin.php?page=vc-updater' ) );

		return sprintf( '%s/activate-license?token=%s&url=%s&redirect=%s', self::$support_host, $token, $url, $redirect );
	}

	/**
	 * Generate action URL
	 *
	 * @return string
	 */
	public function generateDeactivationUrl() {
		$license_key = $this->getLicenseKey();
		$token = sha1( $this->newLicenseKeyToken() );
		$url = esc_url( site_url() );
		$redirect = esc_url( vc_is_network_plugin() ? network_admin_url( 'admin.php?page=vc-updater' ) : admin_url( 'admin.php?page=vc-updater' ) );

		return sprintf( '%s/deactivate-license?license_key=%s&token=%s&url=%s&redirect=%s', self::$support_host, $license_key, $token, $url, $redirect );
	}

	/**
	 * Start activation process and output redirect URL as JSON
	 */
	public function startActivationResponse() {
		vc_user_access()
			->checkAdminNonce()
			->validateDie()
			->wpAny( 'manage_options' )
			->validateDie()
			->part( 'settings' )
			->can( 'vc-updater-tab' )
			->validateDie();

		$response = array(
			'status' => true,
			'url' => $this->generateActivationUrl()
		);

		die( json_encode( $response ) );
	}

	/**
	 * Start deactivation process and output redirect URL as JSON
	 */
	public function startDeactivationResponse() {
		vc_user_access()
			->checkAdminNonce()
			->validateDie()
			->wpAny( 'manage_options' )
			->validateDie()
			->part( 'settings' )
			->can( 'vc-updater-tab' )
			->validateDie();

		$response = array(
			'status' => true,
			'url' => $this->generateDeactivationUrl()
		);

		die( json_encode( $response ) );
	}

	/**
	 * Old activation process
	 *
	 * @deprecated 4.8 Remove after 2015-12-01
	 */
	public function activate() {
		// _deprecated_function( '\Vc_License::active', '4.8 (will be removed in 4.11)' );
		vc_user_access()
			->checkAdminNonce()
			->validateDie()
			->wpAny( 'manage_options' )
			->validateDie()
			->part( 'settings' )
			->can( 'vc-updater-tab' )
			->validateDie();

		$params = array();
		$params['username'] = vc_post_param( 'username' );
		$params['version'] = WPB_VC_VERSION;
		$params['key'] = vc_post_param( 'key' );
		$params['api_key'] = vc_post_param( 'api_key' );
		$params['url'] = get_site_url();
		$params['ip'] = isset( $_SERVER['SERVER_ADDR'] ) ? $_SERVER['SERVER_ADDR'] : '';
		$params['dkey'] = vc_random_string( 20 );
		$string = 'activatelicense?';
		$request_url = self::getWpbControlUrl( array(
			$string,
			http_build_query( $params, '', '&' ),
		) );
		$response = wp_remote_get( $request_url, array( 'timeout' => 300 ) );
		if ( is_wp_error( $response ) ) {
			echo json_encode( array( 'result' => false ) );
			die();
		}
		$result = json_decode( $response['body'] );
		if ( ! is_object( $result ) ) {
			echo json_encode( array( 'result' => false ) );
			die();
		}
		if ( true === (boolean) $result->result || ( 401 === (int) $result->code && isset( $result->deactivation_key ) ) ) {
			$this->setDeactivation( isset( $result->code ) && (int) $result->code === 401 ? $result->deactivation_key : $params['dkey'] );
			vc_settings()->set( 'envato_username', $params['username'] );
			vc_settings()->set( 'envato_api_key', $params['api_key'] );
			vc_license()->setLicenseKey( $params['key'] );
			echo json_encode( array( 'result' => true ) );
			die();
		}
		echo $response['body'];
		die();
	}

	/**
	 * Set license key
	 *
	 * @param string $license_key
	 */
	public function setLicenseKey( $license_key ) {
		vc_settings()->set( self::$license_key_option, $license_key );
	}

	/**
	 * Get license key
	 *
	 * @return string
	 */
	public function getLicenseKey() {
		return vc_settings()->get( self::$license_key_option );
	}

	/**
	 * Check if specified license key is valid
	 *
	 * @param string $license_key
	 *
	 * @return bool
	 */
	public function isValid( $license_key ) {
		return $license_key === $this->getLicenseKey();
	}

	/**
	 * Old deactivation process
	 *
	 * @deprecated 4.8 Remove after 2015-12-01
	 */
	public function deactivate() {
		// _deprecated_function( '\Vc_License::active', '4.8 (will be removed in 4.11)' );
		vc_user_access()
			->checkAdminNonce()
			->validateDie()
			->wpAny( 'manage_options' )
			->validateDie()
			->part( 'settings' )
			->can( 'vc-updater-tab' )
			->validateDie();

		$params = array();
		$params['dkey'] = $this->deactivation();
		$string = 'deactivatelicense?';
		$request_url = self::getWpbControlUrl( array(
			$string,
			http_build_query( $params, '', '&' ),
		) );
		$response = wp_remote_get( $request_url, array( 'timeout' => 300 ) );
		if ( is_wp_error( $response ) ) {
			echo json_encode( array( 'result' => false ) );
			die();
		}
		$result = json_decode( $response['body'] );
		if ( (boolean) $result->result ) {
			$this->setDeactivation( '' );
		}
		echo $response['body'];
		die();
	}

	/**
	 * Set up license activation notice if needed
	 *
	 * Don't show notice on dev environment
	 */
	public function setupReminder() {
		if ( self::isDevEnvironment() ) {
			return;
		}

		if ( ! $this->isActivated() && empty( $_COOKIE['vchideactivationmsg'] ) && ! vc_is_network_plugin() && ! vc_is_as_theme() ) {
			add_action( 'admin_notices', array( &$this, 'adminNoticeLicenseActivation', ) );
		}
	}

	/**
	 * Check if current enviroment is dev
	 *
	 * Environment is considered dev if host is:
	 * - ip address
	 * - tld is local, dev, wp, test, example, localhost or invalid
	 * - no tld (localhost, custom hosts)
	 *
	 * @param string $host Hostname to check. If null, use HTTP_HOST
	 *
	 * @return boolean
	 */
	public static function isDevEnvironment( $host = null ) {
		if ( ! $host ) {
			$host = $_SERVER['HTTP_HOST'];
		}

		$chunks = explode( '.', $host );

		if ( 1 === count( $chunks ) ) {
			return true;
		}

		if ( in_array( end( $chunks ), array( 'local', 'dev', 'wp', 'test', 'example', 'localhost', 'invalid' ) ) ) {
			return true;
		}

		if ( preg_match( '/^[0-9\.]+$/', $host ) ) {
			return true;
		}

		return false;
	}

	public function adminNoticeLicenseActivation() {
		update_option( 'wpb_js_composer_license_activation_notified', 'yes' );
		echo '<div class="updated vc_license - activation - notice"><p>' . sprintf( __( 'Hola! Please <a href=" % s">activate your copy</a> of Visual Composer to receive automatic updates.', 'js_composer' ), wp_nonce_url( admin_url( 'admin.php?page=vc-updater' ) ) ) . '</p></div>';
	}

	/**
	 * Get license key token
	 *
	 * @return string
	 */
	public function getLicenseKeyToken() {
		return get_option( self::$license_key_token_option );
	}

	/**
	 * Set license key token
	 *
	 * @param string $token
	 *
	 * @return string
	 */
	public function setLicenseKeyToken( $token ) {
		return update_option( self::$license_key_token_option, $token );
	}

	/**
	 * Return new license key token
	 *
	 * Token is used to change license key from remote location
	 *
	 * Format is: timestamp|20-random-characters
	 *
	 * @return string
	 */
	public function generateLicenseKeyToken() {
		$token = time() . '|' . vc_random_string( 20 );

		return $token;
	}

	/**
	 * Generate and set new license key token
	 *
	 * @return string
	 */
	public function newLicenseKeyToken() {
		$token = $this->generateLicenseKeyToken();

		$this->setLicenseKeyToken( $token );

		return $token;
	}

	/**
	 * Check if specified license key token is valid
	 *
	 * @param string $token_to_check SHA1 hashed token
	 * @param int $ttl_in_seconds Time to live in seconds. Default = 20min
	 *
	 * @return boolean
	 */
	public function isValidToken( $token_to_check, $ttl_in_seconds = 1200 ) {
		$token = $this->getLicenseKeyToken();

		if ( ! $token_to_check || $token_to_check !== sha1( $token ) ) {
			return false;
		}

		$chunks = explode( '|', $token );

		if ( intval( $chunks[0] ) < ( time() - $ttl_in_seconds ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Check if license key format is valid
	 *
	 * license key is version 4 UUID, that have form xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx
	 * where x is any hexadecimal digit and y is one of 8, 9, A, or B.
	 *
	 * @param string $license_key
	 *
	 * @return boolean
	 */
	public function isValidFormat( $license_key ) {
		$pattern = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

		return (bool) preg_match( $pattern, $license_key );
	}
}
