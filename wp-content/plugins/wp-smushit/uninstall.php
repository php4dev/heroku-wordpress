<?php
/**
 * Remove plugin settings data.
 *
 * @since 1.7
 * @package Smush
 */

use Smush\Core\Settings;

// If uninstall not called from WordPress exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

if ( ! class_exists( '\\Smush\\Core\\Settings' ) ) {
	if ( ! defined( 'WP_SMUSH_PREFIX' ) ) {
		define( 'WP_SMUSH_PREFIX', 'wp-smush-' );
	}
	/* @noinspection PhpIncludeInspection */
	include_once plugin_dir_path( __FILE__ ) . '/core/class-settings.php';
}
$keep_data = Settings::get_instance()->get( 'keep_data' );

// Check if someone want to keep the stats and settings.
if ( ( defined( 'WP_SMUSH_PRESERVE_STATS' ) && WP_SMUSH_PRESERVE_STATS ) || true === $keep_data ) {
	return;
}

global $wpdb;

$smushit_keys = array(
	'resmush-list',
	'nextgen-resmush-list',
	'resize_sizes',
	'transparent_png',
	'image_sizes',
	'super_smushed',
	'super_smushed_nextgen',
	'settings_updated',
	'hide_smush_welcome',
	'hide_upgrade_notice',
	'hide_update_info',
	'install-type',
	'version',
	'scan',
	'settings',
	'cdn_status',
	'lazy_load',
	'last_run_sync',
	'networkwide',
	'cron_update_running',
	'hide-conflict-notice',
	'show_upgrade_modal',
	// This could have been set in 3.7.1. The UI that set this was removed in 3.7.2.
	'hide_tutorials_from_bulk_smush',
);

$db_keys = array(
	'skip-smush-setup',
	'smush_global_stats',
);

// Cache Keys.
$cache_keys = array(
	'smush_global_stats',
);

$cache_smush_group = array(
	'exceeding_items',
	'wp-smush-resize_savings',
	'pngjpg_savings',
);

$cache_nextgen_group = array(
	'wp_smush_images',
	'wp_smush_images_smushed',
	'wp_smush_images_unsmushed',
	'wp_smush_stats_nextgen',
);

if ( ! is_multisite() ) {
	// Delete Options.
	foreach ( $smushit_keys as $key ) {
		$key = 'wp-smush-' . $key;
		delete_option( $key );
		delete_site_option( $key );
	}

	foreach ( $db_keys as $key ) {
		delete_option( $key );
		delete_site_option( $key );
	}

	// Delete Cache data.
	foreach ( $cache_keys as $key ) {
		wp_cache_delete( $key );
	}

	foreach ( $cache_smush_group as $s_key ) {
		wp_cache_delete( $s_key, 'smush' );
	}

	foreach ( $cache_nextgen_group as $n_key ) {
		wp_cache_delete( $n_key, 'nextgen' );
	}
}

// Delete Directory Smush stats.
delete_option( 'dir_smush_stats' );
delete_option( 'wp_smush_scan' );
delete_option( 'wp_smush_api_auth' );
delete_site_option( 'wp_smush_api_auth' );

// Delete Post meta.
$meta_type  = 'post';
$meta_key   = 'wp-smpro-smush-data';
$meta_value = '';
$delete_all = true;

if ( is_multisite() ) {
	$offset = 0;
	$limit  = 100;
	while ( $blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs} LIMIT $offset, $limit", ARRAY_A ) ) {
		if ( $blogs ) {
			foreach ( $blogs as $blog ) {
				switch_to_blog( $blog['blog_id'] );
				delete_metadata( $meta_type, null, $meta_key, $meta_value, $delete_all );
				delete_metadata( $meta_type, null, 'wp-smush-lossy', '', $delete_all );
				delete_metadata( $meta_type, null, 'wp-smush-resize_savings', '', $delete_all );
				delete_metadata( $meta_type, null, 'wp-smush-original_file', '', $delete_all );
				delete_metadata( $meta_type, null, 'wp-smush-pngjpg_savings', '', $delete_all );

				foreach ( $smushit_keys as $key ) {
					$key = 'wp-smush-' . $key;
					delete_option( $key );
					delete_site_option( $key );
				}

				foreach ( $db_keys as $key ) {
					delete_option( $key );
					delete_site_option( $key );
				}

				// Delete Cache data.
				foreach ( $cache_keys as $key ) {
					wp_cache_delete( $key );
				}

				foreach ( $cache_smush_group as $s_key ) {
					wp_cache_delete( $s_key, 'smush' );
				}

				foreach ( $cache_nextgen_group as $n_key ) {
					wp_cache_delete( $n_key, 'nextgen' );
				}
			}
			restore_current_blog();
		}
		$offset += $limit;
	}
} else {
	delete_metadata( $meta_type, null, $meta_key, $meta_value, $delete_all );
	delete_metadata( $meta_type, null, 'wp-smush-lossy', '', $delete_all );
	delete_metadata( $meta_type, null, 'wp-smush-resize_savings', '', $delete_all );
	delete_metadata( $meta_type, null, 'wp-smush-original_file', '', $delete_all );
	delete_metadata( $meta_type, null, 'wp-smush-pngjpg_savings', '', $delete_all );
}
// Delete Directory smush table.
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}smush_dir_images" );

// Delete directory scan data.
delete_option( 'wp-smush-scan-step' );

// Delete all WebP images.
global $wp_filesystem;
if ( is_null( $wp_filesystem ) ) {
	WP_Filesystem();
}

$upload_dir = wp_get_upload_dir();
$webp_dir   = dirname( $upload_dir['basedir'] ) . '/smush-webp';
$wp_filesystem->delete( $webp_dir, true );

// Delete WebP test image.
$webp_img = $upload_dir['basedir'] . '/smush-webp-test.png';
$wp_filesystem->delete( $webp_img );

// TODO: Add procedure to delete backup files
// TODO: Update NextGen Metadata to remove Smush stats on plugin deletion.
