<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://disqus.com
 * @since             3.0
 * @package           Disqus
 *
 * @wordpress-plugin
 * Plugin Name:       Disqus for WordPress
 * Plugin URI:        https://disqus.com/
 * Description:       Disqus helps publishers increase engagement and build loyal audiences. Supports syncing comments to your database for easy backup.
 * Version:           3.0.17
 * Author:            Disqus
 * Author URI:        https://disqus.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       disqus
 * Domain Path:       /languages
 */

$DISQUSVERSION = '3.0.17';

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation (but not during updates).
 */
function activate_disqus() {
	if ( version_compare( phpversion(), '5.4', '<' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( 'Disqus requires PHP version 5.4 or higher. Plugin was deactivated.' );
	}
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-disqus-deactivator.php
 */
function deactivate_disqus() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-disqus-deactivator.php';
	Disqus_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_disqus' );
register_deactivation_hook( __FILE__, 'deactivate_disqus' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-disqus.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0
 */
function run_disqus() {
	global $DISQUSVERSION;

	$plugin = new Disqus( $DISQUSVERSION );
	$plugin->run();

}
run_disqus();
