<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVSiteInfo')) :

class BVSiteInfo {
	public function getOption($key) {
		$res = false;
		if (function_exists('get_site_option')) {
			$res = get_site_option($key, false);
		}
		if ($res === false) {
			$res = get_option($key, false);
		}
		return $res;
	}

	public function deleteOption($key) {
		if (function_exists('delete_site_option')) {
			return delete_site_option($key);
		} else {
			return delete_option($key);
		}
	}

	public function updateOption($key, $value) {
		if (function_exists('update_site_option')) {
			return update_site_option($key, $value);
		} else {
			return update_option($key, $value);
		}
	}

	public function setTransient($name, $value, $time) {
		if (function_exists('set_site_transient')) {
			return set_site_transient($name, $value, $time);
		}
		return false;
	}

	public function deleteTransient($name) {
		if (function_exists('delete_site_transient')) {
			return delete_site_transient($name);
		}
		return false;
	}

	public function getTransient($name) {
		if (function_exists('get_site_transient')) {
			return get_site_transient($name);
		}
		return false;
	}

	public function wpurl() {
		if (function_exists('network_site_url'))
			return network_site_url();
		else
			return get_bloginfo('wpurl');
	}

	public function siteurl() {
		if (function_exists('site_url')) {
			return site_url();
		} else {
			return get_bloginfo('wpurl');
		}
	}

	public function homeurl() {
		if (function_exists('home_url')) {
			return home_url();
		} else {
			return get_bloginfo('url');
		}
	}

	public function isMultisite() {
		if (function_exists('is_multisite'))
			return is_multisite();
		return false;
	}

	public function isMainSite() {
		if (!function_exists('is_main_site' ) || !$this->isMultisite())
			return true;
		return is_main_site();
	}

	public function basic(&$info) {
		$info['wpurl'] = $this->wpurl();
		$info['siteurl'] = $this->siteurl();
		$info['homeurl'] = $this->homeurl();
		$info['serverip'] = $_SERVER['SERVER_ADDR'];
		$info['abspath'] = ABSPATH;
		return $info;
	}
}
endif;