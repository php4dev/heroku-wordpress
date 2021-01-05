<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 if ( ! defined( 'ABSPATH' ) ) { exit; } class FS_Admin_Menu_Manager { protected $_module_unique_affix; protected $_module_id; protected $_module_type; private $_menu_slug; private $_parent_slug; private $_parent_type; private $_type; private $_is_top_level; private $_is_override_exact; private $_default_submenu_items; private $_first_time_path; private $_menu_exists; private $_network_menu_exists; protected $_logger; private static $_instances = array(); static function instance( $module_id, $module_type, $module_unique_affix ) { $key = 'm_' . $module_id; if ( ! isset( self::$_instances[ $key ] ) ) { self::$_instances[ $key ] = new FS_Admin_Menu_Manager( $module_id, $module_type, $module_unique_affix ); } return self::$_instances[ $key ]; } protected function __construct( $module_id, $module_type, $module_unique_affix ) { $this->_logger = FS_Logger::get_logger( WP_FS__SLUG . '_' . $module_id . '_admin_menu', WP_FS__DEBUG_SDK, WP_FS__ECHO_DEBUG_SDK ); $this->_module_id = $module_id; $this->_module_type = $module_type; $this->_module_unique_affix = $module_unique_affix; } private function get_option( &$options, $key, $default = false ) { return ! empty( $options[ $key ] ) ? $options[ $key ] : $default; } private function get_bool_option( &$options, $key, $default = false ) { return isset( $options[ $key ] ) && is_bool( $options[ $key ] ) ? $options[ $key ] : $default; } function init( $menu, $is_addon = false ) { $this->_menu_exists = ( isset( $menu['slug'] ) && ! empty( $menu['slug'] ) ); $this->_network_menu_exists = ( ! empty( $menu['network'] ) && true === $menu['network'] ); $this->_menu_slug = ( $this->_menu_exists ? $menu['slug'] : $this->_module_unique_affix ); $this->_default_submenu_items = array(); $this->_type = 'page'; $this->_is_top_level = true; $this->_is_override_exact = false; $this->_parent_slug = false; $this->_parent_type = 'page'; if ( isset( $menu ) ) { if ( ! $is_addon ) { $this->_default_submenu_items = array( 'contact' => $this->get_bool_option( $menu, 'contact', true ), 'support' => $this->get_bool_option( $menu, 'support', true ), 'affiliation' => $this->get_bool_option( $menu, 'affiliation', true ), 'account' => $this->get_bool_option( $menu, 'account', true ), 'pricing' => $this->get_bool_option( $menu, 'pricing', true ), 'addons' => $this->get_bool_option( $menu, 'addons', true ), ); $this->_type = $this->get_option( $menu, 'type', 'page' ); } $this->_is_override_exact = $this->get_bool_option( $menu, 'override_exact' ); if ( isset( $menu['parent'] ) ) { $this->_parent_slug = $this->get_option( $menu['parent'], 'slug' ); $this->_parent_type = $this->get_option( $menu['parent'], 'type', 'page' ); $this->_is_top_level = ( $this->_parent_slug === $this->_menu_slug ); } else { } $first_path = $this->get_option( $menu, 'first-path', false ); if ( ! empty( $first_path ) && is_string( $first_path ) ) { $this->_first_time_path = $first_path; } } } function is_top_level() { return $this->_is_top_level; } function is_override_exact() { return $this->_is_override_exact; } function get_first_time_path( $is_network = false ) { if ( empty ( $this->_first_time_path ) ) { return $this->_first_time_path; } if ( $is_network ) { return network_admin_url( $this->_first_time_path ); } else { return admin_url( $this->_first_time_path ); } } function has_custom_parent() { return ! $this->_is_top_level && is_string( $this->_parent_slug ); } function has_menu() { return $this->_menu_exists; } function has_network_menu() { return $this->_network_menu_exists; } function set_slug_and_network_menu_exists_flag($menu_slug ) { $this->_menu_slug = $menu_slug; $this->_network_menu_exists = false; } function is_submenu_item_visible( $id, $default = true, $ignore_menu_existence = false ) { if ( ! $ignore_menu_existence && ! $this->has_menu() ) { return false; } return fs_apply_filter( $this->_module_unique_affix, 'is_submenu_visible', $this->get_bool_option( $this->_default_submenu_items, $id, $default ), $id ); } function get_slug( $page = '' ) { return ( ( false === strpos( $this->_menu_slug, '.php?' ) ) ? $this->_menu_slug : $this->_module_unique_affix ) . ( empty( $page ) ? '' : ( '-' . $page ) ); } function get_parent_slug() { return $this->_parent_slug; } function get_type() { return $this->_type; } function is_cpt() { return ( 0 === strpos( $this->_menu_slug, 'edit.php?post_type=' ) || 'cpt' === $this->_type ); } function get_parent_type() { return $this->_parent_type; } function get_raw_slug() { return $this->_menu_slug; } function get_original_menu_slug() { if ( 'cpt' === $this->_type ) { return add_query_arg( array( 'post_type' => $this->_menu_slug ), 'edit.php' ); } if ( false === strpos( $this->_menu_slug, '.php?' ) ) { return $this->_menu_slug; } else { return $this->_module_unique_affix; } } function get_top_level_menu_slug() { return $this->has_custom_parent() ? $this->get_parent_slug() : $this->get_raw_slug(); } function is_main_settings_page( $show_opt_in_on_themes_page = false ) { return $this->is_activation_page( $show_opt_in_on_themes_page ); } function is_activation_page( $show_opt_in_on_themes_page = false ) { if ( $show_opt_in_on_themes_page ) { return ( ( WP_FS__MODULE_TYPE_THEME === $this->_module_type ) && Freemius::is_themes_page() && fs_request_get_bool( $this->_module_unique_affix . '_show_optin' ) ); } if ( $this->_menu_exists && ( fs_is_plugin_page( $this->_menu_slug ) || fs_is_plugin_page( $this->_module_unique_affix ) ) ) { return true; } return false; } function override_submenu_action( $parent_slug, $menu_slug, $function ) { global $submenu; $menu_slug = plugin_basename( $menu_slug ); $parent_slug = plugin_basename( $parent_slug ); if ( ! isset( $submenu[ $parent_slug ] ) ) { return false; } $found_submenu_item = false; foreach ( $submenu[ $parent_slug ] as $submenu_item ) { if ( $menu_slug === $submenu_item[2] ) { $found_submenu_item = $submenu_item; break; } } if ( false === $found_submenu_item ) { return false; } $hookname = get_plugin_page_hookname( $menu_slug, $parent_slug ); remove_all_actions( $hookname ); add_action( $hookname, $function ); return $hookname; } private function find_top_level_menu() { global $menu; $position = - 1; $found_menu = false; $menu_slug = $this->get_raw_slug(); $hook_name = get_plugin_page_hookname( $menu_slug, '' ); foreach ( $menu as $pos => $m ) { if ( $menu_slug === $m[2] ) { $position = $pos; $found_menu = $m; break; } } if ( false === $found_menu ) { return false; } return array( 'menu' => $found_menu, 'position' => $position, 'hook_name' => $hook_name ); } private function find_main_submenu() { global $submenu; $top_level_menu_slug = $this->get_top_level_menu_slug(); if ( ! isset( $submenu[ $top_level_menu_slug ] ) ) { return false; } $submenu_slug = $this->get_raw_slug(); $position = - 1; $found_submenu = false; $hook_name = get_plugin_page_hookname( $submenu_slug, '' ); foreach ( $submenu[ $top_level_menu_slug ] as $pos => $sub ) { if ( $submenu_slug === $sub[2] ) { $position = $pos; $found_submenu = $sub; } } if ( false === $found_submenu ) { return false; } return array( 'menu' => $found_submenu, 'parent_slug' => $top_level_menu_slug, 'position' => $position, 'hook_name' => $hook_name ); } private function remove_all_submenu_items() { global $submenu; $menu_slug = $this->get_raw_slug(); if ( ! isset( $submenu[ $menu_slug ] ) ) { return false; } $submenu_ref = &$submenu; $submenu_ref[ $menu_slug ] = array(); return true; } function remove_menu_item( $remove_top_level_menu = false ) { $this->_logger->entrance(); $top_level_menu = $this->find_top_level_menu(); if ( false === $top_level_menu ) { return false; } remove_all_actions( $top_level_menu['hook_name'] ); $this->remove_all_submenu_items(); if ( $remove_top_level_menu ) { global $menu; unset( $menu[ $top_level_menu['position'] ] ); } return $top_level_menu; } function main_menu_url() { $this->_logger->entrance(); if ( $this->_is_top_level ) { $menu = $this->find_top_level_menu(); } else { $menu = $this->find_main_submenu(); } $parent_slug = isset( $menu['parent_slug'] ) ? $menu['parent_slug'] : 'admin.php'; return admin_url( $parent_slug . ( false === strpos( $parent_slug, '?' ) ? '?' : '&' ) . 'page=' . $menu['menu'][2] ); } function override_menu_item( $function ) { $found_menu = $this->remove_menu_item(); if ( false === $found_menu ) { return false; } if ( ! $this->is_top_level() || ! $this->is_cpt() ) { $menu_slug = plugin_basename( $this->get_slug() ); $hookname = get_plugin_page_hookname( $menu_slug, '' ); add_action( $hookname, $function ); } else { global $menu; unset( $menu[ $found_menu['position'] ] ); $hookname = self::add_page( $found_menu['menu'][3], $found_menu['menu'][0], 'manage_options', $this->get_slug(), $function, $found_menu['menu'][6], $found_menu['position'] ); } return $hookname; } function add_counter_to_menu_item( $counter = 1, $class = '' ) { global $menu, $submenu; $mask = '%s <span class="update-plugins %s count-%3$s" aria-hidden="true"><span>%3$s<span class="screen-reader-text">%3$s notifications</span></span></span>'; $menu_ref = &$menu; $submenu_ref = &$submenu; if ( $this->_is_top_level ) { $found_menu = $this->find_top_level_menu(); if ( false !== $found_menu ) { $menu_ref[ $found_menu['position'] ][0] = sprintf( $mask, $found_menu['menu'][0], $class, $counter ); } } else { $found_submenu = $this->find_main_submenu(); if ( false !== $found_submenu ) { $submenu_ref[ $found_submenu['parent_slug'] ][ $found_submenu['position'] ][0] = sprintf( $mask, $found_submenu['menu'][0], $class, $counter ); } } } static function add_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null ) { $fn = 'add_menu' . '_page'; return $fn( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position ); } function add_page_and_update( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null ) { $this->_menu_slug = $menu_slug; $this->_is_top_level = true; $this->_menu_exists = true; $this->_network_menu_exists = true; return self::add_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position ); } static function add_subpage( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' ) { $fn = 'add_submenu' . '_page'; return $fn( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function ); } function add_subpage_and_update( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' ) { $this->_menu_slug = $menu_slug; $this->_parent_slug = $parent_slug; $this->_is_top_level = false; $this->_menu_exists = true; $this->_network_menu_exists = true; return self::add_subpage( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function ); } }