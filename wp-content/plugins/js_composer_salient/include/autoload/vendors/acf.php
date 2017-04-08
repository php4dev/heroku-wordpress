<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @since 4.4 vendors initialization moved to hooks in autoload/vendors.
 *
 * Used to initialize advanced custom fields vendor.
 */

add_action( 'plugins_loaded', 'vc_init_vendor_acf' );
function vc_init_vendor_acf() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
	if ( class_exists( 'acf' ) || is_plugin_active( 'advanced-custom-fields/acf.php' ) || is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
		require_once vc_path_dir( 'VENDORS_DIR', 'plugins/class-vc-vendor-advanced-custom-fields.php' );
		$vendor = new Vc_Vendor_AdvancedCustomFields();
		add_action( 'vc_after_set_mode', array(
			$vendor,
			'load',
		) );
	}
}
