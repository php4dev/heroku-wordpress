<?php
/**
 * Smush integration with Rest API: Rest class
 *
 * @package Smush\Core
 * @since 2.8.0
 *
 * @author Anton Vanyukov <anton@incsub.com>
 *
 * @copyright (c) 2018, Incsub (http://incsub.com)
 */

namespace Smush\Core;

use WP_Smush;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Singleton class Rest for extending the WordPress REST API interface.
 *
 * @since 2.8.0
 */
class Rest {

	/**
	 * Rest constructor.
	 */
	public function __construct() {
		// Register smush meta fields and callbacks for the image object in the
		// wp-json/wp/v2/media REST API endpoint.
		add_action( 'rest_api_init', array( $this, 'register_smush_meta' ) );
	}

	/**
	 * Callback for rest_api_init action.
	 *
	 * @since 2.8.0
	 */
	public function register_smush_meta() {
		register_rest_field(
			'attachment',
			'smush',
			array(
				'get_callback' => array( $this, 'register_image_stats' ),
				'schema'       => array(
					'description' => __( 'Smush data.', 'wp-smushit' ),
					'type'        => 'string',
				),
			)
		);
	}

	/**
	 * Add image stats to the wp-json/wp/v2/media REST API endpoint.
	 *
	 * Will add the stats from wp-smpro-smush-data image meta key to the media REST API endpoint.
	 * If image is Smushed, the stats from the meta can be queried, if the not - the status of Smushing
	 * will be displayed as a string in the API.
	 *
	 * @since 2.8.0
	 *
	 * @link https://developer.wordpress.org/rest-api/reference/media/
	 *
	 * @param array $image  Image array.
	 *
	 * @return array|string
	 */
	public function register_image_stats( $image ) {
		if ( get_option( 'smush-in-progress-' . $image['id'], false ) ) {
			$status_txt = __( 'Smushing in progress', 'wp-smushit' );
			return $status_txt;
		}

		$wp_smush_data = get_post_meta( $image['id'], Modules\Smush::$smushed_meta_key, true );

		if ( empty( $wp_smush_data ) ) {
			$status_txt = __( 'Not processed', 'wp-smushit' );
			return $status_txt;
		}

		$wp_resize_savings  = get_post_meta( $image['id'], WP_SMUSH_PREFIX . 'resize_savings', true );
		$conversion_savings = get_post_meta( $image['id'], WP_SMUSH_PREFIX . 'pngjpg_savings', true );

		$combined_stats = WP_Smush::get_instance()->core()->combined_stats( $wp_smush_data, $wp_resize_savings );
		$combined_stats = WP_Smush::get_instance()->core()->combine_conversion_stats( $combined_stats, $conversion_savings );

		return $combined_stats;
	}

}
