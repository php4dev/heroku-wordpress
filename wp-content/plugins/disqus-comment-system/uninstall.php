<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @link       https://disqus.com
 * @since      3.0
 *
 * @package    Disqus
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

if ( ! current_user_can( 'install_plugins' ) ) {
	exit;
}

delete_option( 'disqus_forum_url' );
delete_option( 'disqus_sso_enabled' );
delete_option( 'disqus_public_key' );
delete_option( 'disqus_secret_key' );
delete_option( 'disqus_admin_access_token' );
delete_option( 'disqus_sso_button' );
delete_option( 'disqus_sync_token' );
delete_option( 'disqus_last_sync_message' );
delete_option( 'disqus_render_js' );
delete_option( 'disqus_manual_sync' ); // Legacy option.
