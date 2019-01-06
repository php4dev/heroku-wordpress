<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVUpgraderSkin')) :
class BVUpgraderSkin extends WP_Upgrader_Skin {
	public $action = '';
	public $plugin_info = array();
	public $theme_info = array();

	function __construct($type, $package = '') {
		$this->action = $type;
		$this->package = $package;
		parent::__construct(array());
	}

	function header() {}

	function footer() {}

	function get_key() {
		$key = "bvgeneral";
		switch ($this->action) {
		case "theme_upgrade":
			if (!empty($this->theme_info))
				$key = $this->theme_info['Name'];
			break;
		case "plugin_upgrade":
			if (!empty($this->plugin_info))
				$key = $this->plugin_info['Name'];
			break;
		case "installer":
			if (!empty($this->package))
				$key = $this->package;
			break;
		}
		return $key;
	}

	function error($errors) {
		global $bvresp;
		$key = $this->get_key();
		$message = array();
		$message['error'] = true;
		if (is_string($errors)) {
			$message['message'] = $errors;
		} elseif (is_wp_error($errors) && $errors->get_error_code()) {
			$message['data'] = $errors->get_error_data();
			$message['code'] = $errors->get_error_code();
		}
		$bvresp->addArrayToStatus($this->action.':'.$key, $message);
	}

	function feedback($string) {
		global $bvresp;
		if ( empty($string) )
			return;
		$key = $this->get_key();
		$message = array();
		$message['message'] = $string;
		$bvresp->addArrayToStatus($this->action.':'.$key, $message);
	}
}
endif;