<?php
/**
 * WPMU DEV Hub endpoints.
 *
 * Class allows syncing plugin data with the Hub.
 *
 * @since 3.7.0
 * @package Smush\Core\Api
 */

namespace Smush\Core\Api;

use Smush\Core\Settings;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Hub
 */
class Hub {

	/**
	 * Endpoints array.
	 *
	 * @since 3.7.0
	 * @var array
	 */
	private $endpoints = array(
		'get_stats',
	);

	/**
	 * Hub constructor.
	 *
	 * @since 3.7.0
	 */
	public function __construct() {
		add_filter( 'wdp_register_hub_action', array( $this, 'add_endpoints' ) );
	}

	/**
	 * Add Hub endpoints.
	 *
	 * Every Hub Endpoint name is build following the structure: 'smush-$endpoint-$action'
	 *
	 * @since 3.7.0
	 * @param array $actions  Endpoint action.
	 *
	 * @return array
	 */
	public function add_endpoints( $actions ) {
		foreach ( $this->endpoints as $endpoint ) {
			$actions[ "smush_{$endpoint}" ] = array( $this, 'action_' . $endpoint );
		}

		return $actions;
	}

	/**
	 * Retrieve data for endpoint.
	 *
	 * @since 3.7.0
	 * @param array  $params  Parameters.
	 * @param string $action  Action.
	 */
	public function action_get_stats( $params, $action ) {
		$status   = array();
		$settings = Settings::get_instance();

		$status['cdn']   = $settings->get( 'cdn' );
		$status['super'] = $settings->get( 'lossy' );

		$lazy = $settings->get_setting( WP_SMUSH_PREFIX . 'lazy_load' );

		$status['lazy'] = array(
			'enabled' => $settings->get( 'lazy_load' ),
			'native'  => $lazy['native'],
		);

		$core = \WP_Smush::get_instance()->core();

		if ( ! isset( $core->stats ) ) {
			// Setup stats, if not set already.
			$core->setup_global_stats();
		}
		// Total, Smushed, Unsmushed, Savings.
		$status['count_total']   = $core->total_count;
		$status['count_smushed'] = $core->smushed_count;
		// Considering the images to be resmushed.
		$status['count_unsmushed'] = $core->remaining_count;
		$status['savings']         = $core->stats;


		$status['dir']   = $core->dir_stats;

		wp_send_json_success( (object) $status );
	}

}
