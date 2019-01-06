<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVBrandCallback')) :

class BVBrandCallback {
	public function process($method) {
		global $bvresp, $bvcb;
		$info = $bvcb->bvmain->info;
		$option_name = $bvcb->bvmain->brand_option;
		switch($method) {
		case 'setbrand':
			$brandinfo = array();
			if (array_key_exists('hide', $_REQUEST)) {
				$brandinfo['hide'] = $_REQUEST['hide'];
			} else {
				$brandinfo['name'] = $_REQUEST['name'];
				$brandinfo['title'] = $_REQUEST['title'];
				$brandinfo['description'] = $_REQUEST['description'];
				$brandinfo['pluginuri'] = $_REQUEST['pluginuri'];
				$brandinfo['author'] = $_REQUEST['author'];
				$brandinfo['authorname'] = $_REQUEST['authorname'];
				$brandinfo['authoruri'] = $_REQUEST['authoruri'];
				$brandinfo['menuname'] = $_REQUEST['menuname'];
				$brandinfo['logo'] = $_REQUEST['logo'];
				$brandinfo['webpage'] = $_REQUEST['webpage'];
				$brandinfo['appurl'] = $_REQUEST['appurl'];
				if (array_key_exists('hide_plugin_details', $_REQUEST)) {
					$brandinfo['hide_plugin_details'] = $_REQUEST['hide_plugin_details'];
				}
				if (array_key_exists('hide_from_menu', $_REQUEST)) {
					$brandinfo['hide_from_menu'] = $_REQUEST['hide_from_menu'];
				}
			}
			$info->updateOption($option_name, $brandinfo);
			$bvresp->addStatus("setbrand", $info->getOption($option_name));
			break;
		case 'rmbrand':
			$info->deleteOption($option_name);
			$bvresp->addStatus("rmbrand", !$info->getOption($option_name));
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;