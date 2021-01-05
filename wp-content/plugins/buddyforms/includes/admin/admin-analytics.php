<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


function buddyforms_track( $event_name, $data_args = array() ) {
	try {
		$is_debug = ( ! defined( 'WP_DEBUG' ) || ( defined( 'WP_DEBUG' ) && WP_DEBUG ) );
		if ( function_exists( 'buddyforms_core_fs' ) && ! empty( $event_name ) && ! $is_debug && is_admin() ) {
			$buddyforms_freemius = buddyforms_core_fs();
			if ( ! empty( $buddyforms_freemius ) ) {
				$is_allowed = $buddyforms_freemius->is_tracking_allowed();
				if ( ! empty( $is_allowed ) ) {

					$user = $buddyforms_freemius->get_user();
					if ( empty( $user ) ) {
						return;
					}

					$data = array();
					if ( ! empty( $data_args ) ) {
						$data['data'] = $data_args;
					}

					$data = array_merge( $data, array(
						'id'    => $user->id,
						'first' => $user->first,
						'last'  => $user->last,
						'email' => $user->email
					) );
					$data = array_merge( $data, array( 'action' => $event_name ) );

					$data = array( 'data' => base64_encode( json_encode( $data ) . '|' . wp_nonce_tick() ) );

					$free_track_api = new TkTrackApi();
					$res            = $free_track_api->track( $data );

					//Check for success
					if ( empty( $res ) || empty( $res->success ) ) {
						error_log( 'buddyforms::analytics', E_USER_NOTICE );
					}
				}
			}
		}
	} catch ( Exception $ex ) {
		error_log( 'buddyforms::' . $ex->getMessage(), E_USER_NOTICE );
	} catch ( \tk\GuzzleHttp\Exception\GuzzleException $ex ) {
		error_log( 'buddyforms::GuzzleException::' . $ex->getMessage(), E_USER_NOTICE );
	}
}

function buddyforms_track_admin_pages( $hook ) {
	if ( ! empty( $hook ) ) {
		if ( $hook === 'buddyforms_page_buddyforms-contact' || $hook === 'buddyforms_page_buddyforms-account' ||
		     $hook === 'buddyforms_page_buddyforms-affiliation' || $hook === 'buddyforms_page_buddyforms-addons' ||
		     $hook === 'buddyforms_page_buddyforms-pricing' || $hook === 'buddyforms_page_buddyforms_welcome_screen' ) {
			buddyforms_track( $hook );
		} else if ( $hook === 'post-new.php' ) {
			$action_create = empty( $_REQUEST['action'] );
			$is_buddyforms = ! empty( $_REQUEST['post_type'] ) && $_REQUEST['post_type'] === 'buddyforms';
			if ( $action_create && $is_buddyforms ) {
				$event = ! empty( $_REQUEST['wizard'] ) ? 'wizard-start' : 'builder-start';
				buddyforms_track( $event );
			}
		}
	}

}

add_action( 'admin_enqueue_scripts', 'buddyforms_track_admin_pages' );

if ( function_exists( 'buddyforms_core_fs' ) ) {
	$buddyforms_freemius = buddyforms_core_fs();
	if ( ! empty( $buddyforms_freemius ) ) {
		function buddyforms_add_freemius_permission( $permissions ) {
			$permissions['events']['desc'] = buddyforms_core_fs()->get_text_inline( 'Activation, deactivation, uninstall, performance and usage data ', 'events' );

			return $permissions;
		}

		$buddyforms_freemius->add_filter( 'permission_list', 'buddyforms_add_freemius_permission' );
	}
}
