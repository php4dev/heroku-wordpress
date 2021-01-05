<?php
/**
 * Smush API class that handles communications with WPMU DEV API: API class
 *
 * @since 3.0
 * @package Smush\Core\Api
 */

namespace Smush\Core\Api;

use Exception;
use WP_Error;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class API.
 */
class API {

	/**
	 * Endpoint name.
	 *
	 * @since 3.0
	 *
	 * @var string
	 */
	public $name = 'smush';

	/**
	 * Endpoint version.
	 *
	 * @since 3.0
	 *
	 * @var string
	 */
	public $version = 'v1';

	/**
	 * API key.
	 *
	 * @since 3.0
	 *
	 * @var string
	 */
	public $api_key = '';

	/**
	 * API request instance.
	 *
	 * @since 3.0
	 *
	 * @var Request
	 */
	private $request;

	/**
	 * API constructor.
	 *
	 * @since 3.0
	 *
	 * @param string $key  API key.
	 *
	 * @throws Exception  API Request exception.
	 */
	public function __construct( $key ) {
		$this->api_key = $key;
		$this->request = new Request( $this );
	}

	/**
	 * Check CDN status (same as verify the is_pro status).
	 *
	 * @since 3.0
	 *
	 * @param bool $manual  If it's a manual check. Only manual on button click.
	 *
	 * @return mixed|WP_Error
	 */
	public function check( $manual = false ) {
		return $this->request->get(
			"check/{$this->api_key}",
			array(
				'api_key' => $this->api_key,
				'domain'  => $this->request->get_this_site(),
			),
			$manual
		);
	}

	/**
	 * Enable CDN for site.
	 *
	 * @since 3.0
	 *
	 * @param bool $manual  If it's a manual check. Overwrites the exponential back off.
	 *
	 * @return mixed|WP_Error
	 */
	public function enable( $manual = false ) {
		return $this->request->post(
			'cdn',
			array(
				'api_key' => $this->api_key,
				'domain'  => $this->request->get_this_site(),
			),
			$manual
		);
	}

}
