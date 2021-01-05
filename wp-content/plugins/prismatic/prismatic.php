<?php 
/*
	Plugin Name: Prismatic
	Plugin URI: https://perishablepress.com/prismatic/
	Description: Display beautiful syntax-highlighted code snippets with Prism.js or Highlight.js
	Tags: code, snippets, syntax, highlight, language,  snippet, pre, prettify, prism, css, fence
	Author: Jeff Starr
	Contributors: specialk
	Author URI: https://plugin-planet.com/
	Donate link: https://monzillamedia.com/donate.html
	Requires at least: 4.1
	Tested up to: 5.6
	Stable tag: 2.6
	Version: 2.6
	Requires PHP: 5.6.20
	Text Domain: prismatic
	Domain Path: /languages
	License: GPL v2 or later
*/

/*
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 
	2 of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	with this program. If not, visit: https://www.gnu.org/licenses/
	
	Copyright 2020 Monzilla Media. All rights reserved.
*/

if (!defined('ABSPATH')) die();

if (!class_exists('Prismatic')) {
	
	final class Prismatic {
		
		private static $instance;
		
		public static function instance() {
			
			if (!isset(self::$instance) && !(self::$instance instanceof Prismatic)) {
				
				self::$instance = new Prismatic;
				self::$instance->constants();
				self::$instance->includes();
				
				add_action('admin_init',          array(self::$instance, 'check_plugin'));
				add_action('admin_init',          array(self::$instance, 'check_version'));
				add_action('plugins_loaded',      array(self::$instance, 'load_i18n'));
				add_filter('plugin_action_links', array(self::$instance, 'action_links'), 10, 2);
				add_filter('plugin_row_meta',     array(self::$instance, 'plugin_links'), 10, 2);
				
				add_action('wp_enqueue_scripts',         'prismatic_block_styles');
				add_action('wp_enqueue_scripts',         'prismatic_enqueue');
				add_action('admin_enqueue_scripts',      'prismatic_enqueue');
				add_action('admin_enqueue_scripts',      'prismatic_enqueue_settings');
				add_action('admin_enqueue_scripts',      'prismatic_enqueue_buttons');
				add_action('admin_print_footer_scripts', 'prismatic_add_quicktags');
				add_action('admin_notices',              'prismatic_admin_notice');
				add_action('admin_menu',                 'prismatic_menu_pages');
				add_action('admin_init',                 'prismatic_register_settings');
				add_action('admin_init',                 'prismatic_reset_options');
				add_action('admin_init',                 'prismatic_buttons');
				
				add_action('init', 'prismatic_register_block_assets');
				add_action('init', 'prismatic_add_filters');
				
				add_shortcode('prismatic_code', 'prismatic_code_shortcode');
				
			}
			
			return self::$instance;
			
		}
		
		public static function options_general() {
			
			$options = array(
				
				'library' => 'none',
				'disable_block_styles' => false,
				
			);
			
			return apply_filters('prismatic_options_general', $options);
			
		}
		
		public static function options_prism() {
			
			$options = array(
				
				'prism_theme'     => 'default',
				'filter_content'  => 'none',
				'filter_excerpts' => 'none',
				'filter_comments' => 'none',
				'line_highlight'  => false,
				'line_numbers'    => false,
				'show_language'   => false,
				'copy_clipboard'  => false,
				'singular_only'   => true,
				
			);
			
			return apply_filters('prismatic_options_prism', $options);
			
		}
		
		public static function options_highlight() {
			
			$options = array(
				
				'highlight_theme' => 'default',
				'filter_content'  => 'none',
				'filter_excerpts' => 'none',
				'filter_comments' => 'none',
				'init_javascript' => 'hljs.initHighlightingOnLoad();',
				'singular_only'   => true,
				
			);
			
			return apply_filters('prismatic_options_highlight', $options);
			
		}
		
		public static function options_plain() {
			
			$options = array(
				
				'filter_content'  => 'none',
				'filter_excerpts' => 'none',
				'filter_comments' => 'none',
				
			);
			
			return apply_filters('prismatic_options_plain', $options);
			
		}
		
		private function constants() {
			
			if (!defined('PRISMATIC_VERSION')) define('PRISMATIC_VERSION', '2.6');
			if (!defined('PRISMATIC_REQUIRE')) define('PRISMATIC_REQUIRE', '4.1');
			if (!defined('PRISMATIC_NAME'))    define('PRISMATIC_NAME',    'Prismatic');
			if (!defined('PRISMATIC_AUTHOR'))  define('PRISMATIC_AUTHOR',  'Jeff Starr');
			if (!defined('PRISMATIC_HOME'))    define('PRISMATIC_HOME',    'https://perishablepress.com/prismatic/');
			if (!defined('PRISMATIC_URL'))     define('PRISMATIC_URL',     plugin_dir_url(__FILE__));
			if (!defined('PRISMATIC_DIR'))     define('PRISMATIC_DIR',     plugin_dir_path(__FILE__));
			if (!defined('PRISMATIC_FILE'))    define('PRISMATIC_FILE',    plugin_basename(__FILE__));
			if (!defined('PRISMATIC_SLUG'))    define('PRISMATIC_SLUG',    basename(dirname(__FILE__)));
			
		}
		
		private function includes() {
			
			require_once PRISMATIC_DIR .'inc/prismatic-blocks.php';
			require_once PRISMATIC_DIR .'inc/prismatic-buttons.php';
			require_once PRISMATIC_DIR .'inc/prismatic-core.php';
			require_once PRISMATIC_DIR .'inc/resources-enqueue.php';
			require_once PRISMATIC_DIR .'inc/settings-callbacks.php';
			require_once PRISMATIC_DIR .'inc/settings-display.php';
			require_once PRISMATIC_DIR .'inc/settings-register.php';
			require_once PRISMATIC_DIR .'inc/settings-reset.php';
			require_once PRISMATIC_DIR .'inc/settings-validate.php';
			
		}
		
		public function action_links($links, $file) {
			
			if ($file == PRISMATIC_FILE && (current_user_can('manage_options'))) {
				
				$prismatic_links = '<a href="'. admin_url('options-general.php?page=prismatic') .'">'. esc_html__('Settings', 'prismatic') .'</a>';
				array_unshift($links, $prismatic_links);
				
			}
			
			return $links;
			
		}
		
		public function plugin_links($links, $file) {
			
			if ($file == plugin_basename(__FILE__)) {
				
				$home_href  = 'https://perishablepress.com/prismatic/';
				$home_title = esc_attr__('Plugin Homepage', 'prismatic');
				$home_text  = esc_html__('Homepage', 'prismatic');
				
				$links[] = '<a target="_blank" rel="noopener noreferrer" href="'. $home_href .'" title="'. $home_title .'">'. $home_text .'</a>';
				
				$rate_href  = 'https://wordpress.org/support/plugin/'. PRISMATIC_SLUG .'/reviews/?rate=5#new-post';
				$rate_title = esc_attr__('Click here to rate and review this plugin on WordPress.org', 'prismatic');
				$rate_text  = esc_html__('Rate this plugin', 'prismatic') .'&nbsp;&raquo;';
				
				$links[]    = '<a target="_blank" rel="noopener noreferrer" href="'. $rate_href .'" title="'. $rate_title .'">'. $rate_text .'</a>';
				
				$pro_href   = 'https://plugin-planet.com/prismatic-pro/?plugin';
				$pro_title  = esc_attr__('Get Prismatic Pro!', 'prismatic');
				$pro_text   = esc_html__('Go&nbsp;Pro', 'prismatic');
				$pro_style  = 'padding:1px 5px;color:#eee;background:#333;border-radius:1px;';
				
				// $links[]    = '<a target="_blank" rel="noopener noreferrer" href="'. $pro_href .'" title="'. $pro_title .'" style="'. $pro_style .'">'. $pro_text .'</a>';
				
			}
			
			return $links;
			
		}
		
		public function check_plugin() {
			
			if (class_exists('Prismatic_Pro')) {
				
				if (is_plugin_active(PRISMATIC_FILE)) {
					
					deactivate_plugins(PRISMATIC_FILE);
					
					$msg  = '<strong>'. esc_html__('Warning:', 'prismatic') .'</strong> ';
					$msg .= esc_html__('Pro version of Prismatic currently active. Free and Pro versions cannot be activated at the same time. ', 'prismatic');
					$msg .= esc_html__('Please return to the', 'prismatic') .' <a href="'. admin_url() .'">'. esc_html__('WP Admin Area', 'prismatic') .'</a> '; 
					$msg .= esc_html__('and try again.', 'prismatic');
					
					wp_die($msg);
					
				}
				
			}
			
		}
		
		public function check_version() {
			
			$wp_version = get_bloginfo('version');
			
			if (isset($_GET['activate']) && $_GET['activate'] == 'true') {
				
				if (version_compare($wp_version, PRISMATIC_REQUIRE, '<')) {
					
					if (is_plugin_active(PRISMATIC_FILE)) {
						
						deactivate_plugins(PRISMATIC_FILE);
						
						$msg  = '<strong>'. PRISMATIC_NAME .'</strong> '. esc_html__('requires WordPress ', 'prismatic') . PRISMATIC_REQUIRE;
						$msg .= esc_html__(' or higher, and has been deactivated! ', 'prismatic');
						$msg .= esc_html__('Please return to the', 'prismatic') .' <a href="'. admin_url() .'">';
						$msg .= esc_html__('WP Admin Area', 'prismatic') .'</a> '. esc_html__('to upgrade WordPress and try again.', 'prismatic');
						
						wp_die($msg);
						
					}
					
				}
				
			}
			
		}
		
		public function load_i18n() {
			
			load_plugin_textdomain('prismatic', false, PRISMATIC_DIR .'languages/');
			
		}
		
		public function __clone() {
			
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&rsquo; huh?', 'prismatic'), PRISMATIC_VERSION);
			
		}
		
		public function __wakeup() {
			
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&rsquo; huh?', 'prismatic'), PRISMATIC_VERSION);
			
		}
		
	}
	
}

if (class_exists('Prismatic')) {
		
	$prismatic_options_general = get_option('prismatic_options_general', Prismatic::options_general());
	$prismatic_options_general = apply_filters('prismatic_get_options_general', $prismatic_options_general);
	
	$prismatic_options_prism = get_option('prismatic_options_prism', Prismatic::options_prism());
	$prismatic_options_prism = apply_filters('prismatic_get_options_prism', $prismatic_options_prism);
	
	$prismatic_options_highlight = get_option('prismatic_options_highlight', Prismatic::options_highlight());
	$prismatic_options_highlight = apply_filters('prismatic_get_options_highlight', $prismatic_options_highlight);
	
	$prismatic_options_plain = get_option('prismatic_options_plain', Prismatic::options_plain());
	$prismatic_options_plain = apply_filters('prismatic_get_options_plain', $prismatic_options_plain);
	
	if (!function_exists('prismatic')) {
		
		function prismatic() {
			
			do_action('prismatic');
			
			return Prismatic::instance();
		}
		
	}
	
	prismatic();
	
}
