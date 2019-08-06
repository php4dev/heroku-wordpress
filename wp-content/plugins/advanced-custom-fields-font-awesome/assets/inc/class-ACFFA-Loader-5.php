<?php
/**
 * =======================================
 * Advanced Custom Fields Font Awesome Loader 5
 * Used with FontAwesome 5.x icon set
 * =======================================
 * 
 * 
 * @author Matt Keys <https://profiles.wordpress.org/mattkeys>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACFFA_Loader_5
{
	private $api_endpoint		= false;
	private $free_api_endpoint	= 'https://data.jsdelivr.com/v1/package/resolve/gh/mattkeys/FontAwesome-Free-Manifest@5';
	private $pro_api_endpoint	= 'https://data.jsdelivr.com/v1/package/resolve/gh/mattkeys/FontAwesome-Pro-Manifest@5';
	private $cdn_baseurl		= false;
	private $free_cdn_baseurl	= 'https://use.fontawesome.com/releases/v';
	private $pro_cdn_baseurl	= 'https://pro.fontawesome.com/releases/v';
	private $manifest_url		= false;
	private $free_manifest_url	= 'http://cdn.jsdelivr.net/gh/mattkeys/FontAwesome-Free-Manifest/5.x/manifest.yml';
	private $pro_manifest_url	= 'http://cdn.jsdelivr.net/gh/mattkeys/FontAwesome-Pro-Manifest/5.x/manifest.yml';
	private $cdn_filepath		= '/css/all.css';
	private $current_version	= false;
	private $pro_icons_enabled	= false;
	private $active_icon_set	= false;
	private $version;

	public function __construct()
	{
		$this->version 				= 'v' . ACFFA_MAJOR_VERSION;
		$acffa_settings				= get_option( 'acffa_settings' );
		$this->pro_icons_enabled	= isset( $acffa_settings['acffa_pro_cdn'] ) ? true : false;

		if ( $this->pro_icons_enabled ) {
			$this->api_endpoint = $this->pro_api_endpoint;
			$this->cdn_baseurl	= $this->pro_cdn_baseurl;
			$this->manifest_url	= $this->pro_manifest_url;
		} else {
			$this->api_endpoint = $this->free_api_endpoint;
			$this->cdn_baseurl	= $this->free_cdn_baseurl;
			$this->manifest_url	= $this->free_manifest_url;
		}

		$this->api_endpoint		= apply_filters( 'ACFFA_api_endpoint', $this->api_endpoint );
		$this->cdn_baseurl		= apply_filters( 'ACFFA_cdn_baseurl', $this->cdn_baseurl );
		$this->manifest_url		= apply_filters( 'ACFFA_manifest_url', $this->manifest_url );
		$this->cdn_filepath		= apply_filters( 'ACFFA_cdn_filepath', $this->cdn_filepath );

		$this->current_version	= get_option( 'ACFFA_current_version' );
		$this->active_icon_set	= get_option( 'ACFFA_active_icon_set' );

		if ( ! $this->current_version || version_compare( $this->current_version, '5.0.0', '<' ) || ! $this->active_icon_set || ( $this->pro_icons_enabled && 'pro' !== $this->active_icon_set ) || ( ! $this->pro_icons_enabled && 'free' !== $this->active_icon_set ) ) {
			$this->current_version = $this->check_latest_version();
		}

		if ( ! wp_next_scheduled ( 'ACFFA_refresh_latest_icons' ) ) {
			wp_schedule_event( time(), 'daily', 'ACFFA_refresh_latest_icons' );
		}

		add_action( 'ACFFA_refresh_latest_icons', array( $this, 'refresh_latest_icons' ) );
		add_action( 'wp_ajax_acf/fields/font-awesome/query', array( $this, 'select2_ajax_request' ) );
		add_filter( 'ACFFA_get_icons', array( $this, 'get_icons' ), 5, 1 );
		add_filter( 'ACFFA_get_fa_url', array( $this, 'get_fa_url' ), 5, 1 );
		add_filter( 'ACFFA_icon_prefix', array( $this, 'get_prefix' ), 5, 2 );
		add_filter( 'ACFFA_icon_prefix_label', array( $this, 'get_prefix_label' ), 5, 2 );
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
			'paged'			=> 0
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
			foreach ( $fa_icons['list'] as $prefix => $icons ) {
				if ( ! empty( $field['icon_sets'] ) && ! in_array( 'custom', $field['icon_sets'] ) && ! in_array( $prefix, $field['icon_sets'] ) ) {
					continue;
				}

				$prefix_icons = array();
				foreach( $icons as $k => $v ) {

					$v = strval( $v );

					if ( is_string( $s ) && false === stripos( $v, $s ) ) {
						continue;
					}

					$prefix_icons[] = array(
						'id'	=> $k,
						'text'	=> $v
					);
				}
				$results[] = array(
					'id'		=> 'fab',
					'text'		=> apply_filters( 'ACFFA_icon_prefix_label', 'Regular', $prefix ),
					'children'	=> $prefix_icons
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

		if ( version_compare( $this->current_version, $latest_version, '<' ) || defined( 'ACFFA_FORCE_REFRESH' ) || ! $this->active_icon_set || ( $this->pro_icons_enabled && 'pro' !== $this->active_icon_set ) || ( ! $this->pro_icons_enabled && 'free' !== $this->active_icon_set ) ) {
			update_option( 'ACFFA_current_version', $latest_version, false );
			$this->current_version = $latest_version;

			$this->get_icons();
		}
	}

	private function check_latest_version( $update_option = true )
	{
		$latest_version = false;

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

		if ( empty( $fa_icons ) || defined( 'ACFFA_FORCE_REFRESH' ) || ! isset( $fa_icons[ $this->current_version ] ) || ! $this->active_icon_set || ( $this->pro_icons_enabled && 'pro' !== $this->active_icon_set ) || ( ! $this->pro_icons_enabled && 'free' !== $this->active_icon_set ) ) {
			$remote_get	= wp_remote_get( $this->manifest_url );

			if ( ! is_wp_error( $remote_get ) && isset( $remote_get['response']['code'] ) && '200' == $remote_get['response']['code'] ) {
				$response = wp_remote_retrieve_body( $remote_get );

				if ( ! empty( $response ) ) {
					require_once( 'spyc/spyc.php' );
					$parsed_icons = spyc_load( $response );

					if ( is_array( $parsed_icons ) && ! empty( $parsed_icons ) ) {
						$icons = $this->find_icons( $parsed_icons );

						if ( ! empty( $icons['details'] ) ) {
							$fa_icons = array(
								$this->current_version => $icons
							);

							$active_set = ( $this->pro_icons_enabled ) ? 'pro' : 'free';

							update_option( 'ACFFA_icon_data', $fa_icons, false );
							update_option( 'ACFFA_active_icon_set', $active_set, false );
						}
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

	private function find_icons( $manifest )
	{
		$icons = array(
			'list'		=> array(),
			'details'	=> array()
		);

		foreach ( $manifest as $icon => $details ) {
			foreach( $details['styles'] as $style ) {
				$prefix = apply_filters( 'ACFFA_icon_prefix', '', $style );

				if ( ! isset( $icons['list'][ $prefix ] ) ) {
					$icons['list'][ $prefix ] = array();
				}

				if ( 'fad' == $prefix ) {
					$icons['list'][ $prefix ][ $prefix . ' fa-' . $icon ] = '<i class="' . $prefix . ' fa-' . $icon . '"></i> ' . $icon;
				} else {
					$icons['list'][ $prefix ][ $prefix . ' fa-' . $icon ] = '<i class="' . $prefix . '">&#x' . $details['unicode'] . ';</i> ' . $icon;
				}

				$icons['details'][ $prefix ][ $prefix . ' fa-' . $icon ] = array(
					'hex'		=> '\\' . $details['unicode'],
					'unicode'	=> '&#x' . $details['unicode'] . ';'
				);
			}
		}

		return $icons;
	}

	public function get_prefix( $prefix = 'far', $style )
	{
		switch ( $style ) {
			case 'solid':
				$prefix = 'fas';
				break;

			case 'brands':
				$prefix = 'fab';
				break;

			case 'light':
				$prefix = 'fal';
				break;

			case 'duotone':
				$prefix = 'fad';
				break;

			case 'regular':
			default:
				$prefix = 'far';
				break;
		}

		return $prefix;
	}

	public function get_prefix_label( $label = 'Regular', $prefix )
	{
		switch ( $prefix ) {
			case 'fas':
				$label = __( 'Solid', 'acf-font-awesome' );
				break;

			case 'fab':
				$label = __( 'Brands', 'acf-font-awesome' );
				break;

			case 'fal':
				$label = __( 'Light', 'acf-font-awesome' );
				break;

			case 'fad':
				$label = __( 'Duotone', 'acf-font-awesome' );
				break;

			case 'far':
			default:
				$label = __( 'Regular', 'acf-font-awesome' );
				break;
		}

		return $label;
	}
}

new ACFFA_Loader_5();
