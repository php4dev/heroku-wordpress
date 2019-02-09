<?php
/**
 * =======================================
 * Advanced Custom Fields Font Awesome Loader 4
 * Used with FontAwesome 4.x icon set
 * =======================================
 * 
 * 
 * @author Matt Keys <https://profiles.wordpress.org/mattkeys>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACFFA_Loader_4
{
	public $api_endpoint		= 'https://data.jsdelivr.com/v1/package/resolve/gh/FortAwesome/Font-Awesome@4';
	public $cdn_baseurl			= 'https://cdn.jsdelivr.net/fontawesome/';
	public $cdn_filepath		= '/css/font-awesome.min.css';
	public $current_version		= false;
	private $version;

	public function __construct()
	{
		$this->version 			= 'v' . ACFFA_MAJOR_VERSION;
		$this->api_endpoint		= apply_filters( 'ACFFA_api_endpoint', $this->api_endpoint );
		$this->cdn_baseurl		= apply_filters( 'ACFFA_cdn_baseurl', $this->cdn_baseurl );
		$this->cdn_filepath		= apply_filters( 'ACFFA_cdn_filepath', $this->cdn_filepath );

		$this->current_version	= get_option( 'ACFFA_current_version' );

		if ( ! $this->current_version || version_compare( $this->current_version, '5.0.0', '>=' )  ) {
			$this->current_version = $this->check_latest_version();
		}

		if ( ! wp_next_scheduled ( 'ACFFA_refresh_latest_icons' ) ) {
			wp_schedule_event( time(), 'daily', 'ACFFA_refresh_latest_icons' );
		}

		add_action( 'ACFFA_refresh_latest_icons', array( $this, 'refresh_latest_icons' ) );
		add_action( 'wp_ajax_acf/fields/font-awesome/query', array( $this, 'select2_ajax_request' ) );
		add_filter( 'ACFFA_get_icons', array( $this, 'get_icons' ), 5, 1 );
		add_filter( 'ACFFA_get_fa_url', array( $this, 'get_fa_url' ), 5, 1 );
	}

	public function select2_ajax_request()
	{
		if ( ! acf_verify_ajax() ) {
			die();
		}

		$response = $this->get_ajax_query( $_POST );

		acf_send_ajax_results( $response );
	}

	private function get_ajax_query( $options = array() )
	{
   		$options = acf_parse_args($options, array(
			'post_id'		=> 0,
			's'				=> '',
			'field_key'		=> '',
			'paged'			=> 1
		));

   		$results = array();
   		$s = null;

   		if ( 'default_value' != $options['field_key'] ) {
			$field = acf_get_field( $options['field_key'] );
			if ( ! $field ) return false;
   		}

		if ( $options['s'] !== '' ) {
			$s = strval( $options['s'] );
			$s = wp_unslash( $s );
		}

		if ( isset( $field['icon_sets'] ) // Make sure we have an icon set
			 && in_array( 'custom', $field['icon_sets'] ) // Make sure that icon set is 'custom'
			 && isset( $field['custom_icon_set'] ) // Make sure a custom set has been chosen
			 && stristr( $field['custom_icon_set'], 'ACFFA_custom_icon_list_' . $this->version ) // Make sure that chosen custom set matches this version of FontAwesome
			 && $custom_icon_set = get_option( $field['custom_icon_set'] ) // Make sure we can retrieve the icon set from the DB/cache
		) {
			$fa_icons = array(
				'list'	=> $custom_icon_set
			);
		} else {
			$fa_icons = apply_filters( 'ACFFA_get_icons', array() );
		}

		if ( $fa_icons ) {
			foreach( $fa_icons['list'] as $k => $v ) {

				$v = strval( $v );

				if ( is_string( $s ) && false === stripos( $v, $s ) ) {
					continue;
				}

				$results[] = array(
					'id'	=> $k,
					'text'	=> $v
				);
			}
		}

		$response = array(
			'results'	=> $results
		);

		return $response;
	}

	public function refresh_latest_icons()
	{
		$latest_version = $this->check_latest_version( false );

		if ( ! $this->current_version || ! $latest_version ) {
			return;
		}

		if ( version_compare( $this->current_version, $latest_version, '<' ) ) {
			update_option( 'ACFFA_current_version', $latest_version, false );
			$this->current_version = $latest_version;

			$this->get_icons();
		}
	}

	private function check_latest_version( $update_option = true )
	{
		$latest_version = 'latest';

		$remote_get = wp_remote_get( $this->api_endpoint );

		if ( ! is_wp_error( $remote_get ) ) {
			$response_json = wp_remote_retrieve_body( $remote_get );

			if ( $response_json ) {
				$response = json_decode( $response_json );

				if ( isset( $response->versions ) && ! empty( $response->versions ) ) {
					$latest_version = max( $response->versions );
					$latest_version = ltrim( $latest_version, 'v' );

					if ( $update_option ) {
						update_option( 'ACFFA_current_version', $latest_version, false );
					}
				} else if ( isset( $response->version ) && ! empty( $response->version ) ) {
					$latest_version = $response->version;

					if ( $update_option ) {
						update_option( 'ACFFA_current_version', $latest_version, false );
					}
				}
			}
		}

		return $latest_version;
	}

	public function get_icons( $icons = array() )
	{
		$fa_icons = get_option( 'ACFFA_icon_data' );

		if ( empty( $fa_icons ) || ! isset( $fa_icons[ $this->current_version ] ) ) {
			$request_url	= $this->cdn_baseurl . $this->current_version . $this->cdn_filepath;
			$remote_get		= wp_remote_get( $request_url );

			if ( ! is_wp_error( $remote_get ) ) {
				$response = wp_remote_retrieve_body( $remote_get );

				if ( ! empty( $response ) ) {
					$icons = $this->find_icons( $response );

					if ( ! empty( $icons['details'] ) ) {
						$fa_icons = array(
							$this->current_version => $icons
						);

						update_option( 'ACFFA_icon_data', $fa_icons, false );
					}
				}
			} else {
				update_option( 'ACFFA_cdn_error', true );
			}
		}

		if ( isset( $fa_icons[ $this->current_version ] ) ) {
			return $fa_icons[ $this->current_version ];
		} else {
			return array();
		}
	}

	public function get_fa_url()
	{
		return $this->cdn_baseurl . $this->current_version . $this->cdn_filepath;
	}

	private function find_icons( $css )
	{
		// Modified from Better Font Awesome Library - Thanks Mickey Kay
		preg_match_all( '/\.((?:icon-|fa-)[^,}]*)\s*:before\s*{\s*(?:content:)\s*"(\\\\[^"]+)"/s', $css, $matches );

		$classes	= array_reverse( $matches[1] );
		$hex_codes	= array_reverse( $matches[2] );

		$icons = array(
			'list'		=> array(),
			'details'	=> array(),
			'prefix'	=> false
		);

		foreach ( $classes as $index => $class ) {
			if ( ! empty( $hex_codes[ $index ] ) ) {
				$hex = $hex_codes[ $index ];
			}

			if ( ! $icons['prefix'] ) {
				$icons['prefix'] = ( 0 === strpos( $class, 'icon-' ) ) ? 'icon-' : 'fa-';
			}

			$class_nicename	= str_replace( array( 'fa-', 'icon-' ), '', $class );
			$unicode		= '&#x' . ltrim( $hex, '\\') . ';';

			if ( 'fa-' == $icons['prefix'] ) {
				$element = '<i class="fa ' . $class . '" aria-hidden="true"></i>';
			} else {
				$element = '<i class="' . $class . '" aria-hidden="true"></i>';
			}

			$icons['list'][ $class ] = $unicode . ' ' . $class_nicename;

			$icons['details'][ $class ] = array(
				'hex'		=> $hex,
				'unicode'	=> $unicode
			);
		}

		ksort( $icons['list'] );

		return $icons;
	}
}

new ACFFA_Loader_4();
