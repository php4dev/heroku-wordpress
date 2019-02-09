<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

delete_option( 'acffa_settings' );
delete_option( 'ACFFA_cdn_error' );
delete_option( 'ACFFA_icon_data' );
delete_option( 'ACFFA_current_version' );
delete_option( 'ACFFA_active_icon_set' );

$ACFFA_custom_icon_sets_list = get_option( 'ACFFA_custom_icon_sets_list' );
if ( $ACFFA_custom_icon_sets_list ) {
	foreach ( $ACFFA_custom_icon_sets_list as $version => $custom_icon_sets ) {
		foreach ( $custom_icon_sets as $option_name => $list_label ) {
			delete_option( $option_name );	
		}
	}
	delete_option( 'ACFFA_custom_icon_sets_list' );	
}

$timestamp = wp_next_scheduled( 'ACFFA_refresh_latest_icons' );

if ( $timestamp ) {
	wp_unschedule_event( $timestamp, 'ACFFA_refresh_latest_icons' );
}
