<?php
/*
Plugin Name: WooCommerce Template Hints
Plugin URI: https://github.com/growdev/woocommerce-template-hints/
Description: WooCommerce Template Hints adds a visual border around parts of all WooCommerce pages showing details about the template used.
Version: 1.0.0
Author: Shop Plugins
Author URI: http://shopplugins.com
Text Domain: woocommerce-template-hints

 * Copyright Shop Plugins
 *
 *     This file is part of WooCommerce Availability Chart,
 *     a plugin for WordPress.
 *
 *     WooCommerce Template Hints is free software:
 *     You can redistribute it and/or modify it under the terms of the
 *     GNU General Public License as published by the Free Software
 *     Foundation, either version 3 of the License, or (at your option)
 *     any later version.
 *
 *     WooCommerce Template Hints is distributed in the hope that
 *     it will be useful, but WITHOUT ANY WARRANTY; without even the
 *     implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
 *     PURPOSE. See the GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with WordPress. If not, see <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * WooCommerce Template Hints Main Class
 *
 * @package  WooCommerce Template Hints
 */

class WC_Template_Hints {

	protected static $instance = null;

	/**
	 *  Constructor
	 */
    function __construct() {

    	if ( class_exists( 'WooCommerce' ) ) {

    		if ( $this::can_see() ) {

    			add_action( 'wp_head', array( $this, 'css' ) );
		    	add_action( 'woocommerce_before_template_part', array( $this, 'output_before_template' ), 30, 4 );
		 		add_action( 'woocommerce_after_template_part', array( $this, 'output_after_template' ), 30, 4 );

		 	}

	 	} else {

	 		add_action( 'admin_notices', array( $this, 'woocommerce_missing_notice' ) );

	 	}

    }

	/**
	 * Start the Class when called
	 *
	 * @return WC_Template_Hints
	 */
	public static function get_instance() {
	  // If the single instance hasn't been set, set it now.
	  if ( null == self::$instance ) {
		self::$instance = new self;
	  }
	  return self::$instance;
	}

	/**
	 * Inline CSS
	 */
	public function css() { ?>

		<style type="text/css">
			fieldset.wcth {
				border: 1px red solid;
				padding: 25px 3px 3px;
				margin: 5px;
			}
			fieldset.wcth legend {
				padding: 2px 6px;
				background: red;
				color: white;
				font-size: 10px;
			}
			fieldset.wcth.wcth-theme {
				border: 1px blue solid;
			}
			fieldset.wcth.wcth-theme legend {
				background: blue;
			}
		</style>

	<?php }

	/**
	 * Output: Before template
	 *
	 * @param string $template_name
	 * @param string $template_path
	 * @param string $located       Path to the located template
	 * @return string
	 */
	public function output_before_template( $template_name, $template_path, $located, $args ) {

		// TODO account for 3rd party plugins' templates that could be in the plugin directory
		$core = ( strpos( $located, 'themes' ) ) ? 'theme' : 'core';
		echo '<fieldset class="wcth wcth-' . $core . '">';
	    echo '<legend title="' . $located . '">template: ' . $template_name . ' </legend>';

	}

	/**
	 * Output: After template
	 *
	 * @return string
	 */
	public function output_after_template( $template_name, $template_path, $located, $args ) {

		echo "</fieldset>";

	}

	/**
	 * Method: Can See (returns true for those with edit_posts cap but can be filtered through wcth_can_see)
	 *
	 * @return bool
	 */
	private static function can_see() {
		
		$return = current_user_can( 'edit_posts' ) ? true : false;
		return apply_filters( 'wcth_can_see', $return );

	}

	/**
	 * WooCommerce fallback notice.
	 *
	 * @return string
	 */
	public function woocommerce_missing_notice() {
		echo '<div class="error"><p>' . sprintf( __( 'WooCommerce Template Hints requires %s to be installed and active.', 'woocommerce-template-hints' ), '<a href="http://woocommerce.com/" target="_blank">' . __( 'WooCommerce', 'woocommerce-template-hints' ) . '</a>' ) . '</p></div>';
	}

}

add_action( 'plugins_loaded', array( 'WC_Template_Hints', 'get_instance' ) );