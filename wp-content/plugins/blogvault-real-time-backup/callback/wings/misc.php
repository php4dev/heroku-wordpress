<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVMiscCallback')) :
	
class BVMiscCallback {

	function process($method) {
		global $bvcb, $bvresp;
		$info = $bvcb->bvmain->info;
		switch ($method) {
		case "enablebadge":
			$option = $bvcb->bvmain->badgeinfo;
			$badgeinfo = array();
			$badgeinfo['badgeurl'] = $_REQUEST['badgeurl'];
			$badgeinfo['badgeimg'] = $_REQUEST['badgeimg'];
			$badgeinfo['badgealt'] = $_REQUEST['badgealt'];
			$info->updateOption($option, $badgeinfo);
			$bvresp->addStatus("status", $info->getOption($option));
			break;
		case "disablebadge":
			$option = $bvcb->bvmain->badgeinfo;
			$info->deleteOption($option);
			$bvresp->addStatus("status", !$info->getOption($option));
			break;
		case "getoption":
			$bvresp->addStatus('getoption', $info->getOption($_REQUEST['opkey']));
			break;
		case "setdynplug":
			$info->updateOption('bvdynplug', $_REQUEST['dynplug']);
			$bvresp->addStatus("setdynplug", $info->getOption('bvdynplug'));
			break;
		case "unsetdynplug":
			$info->deleteOption('bvdynplug');
			$bvresp->addStatus("unsetdynplug", $info->getOption('bvdynplug'));
			break;
		case "setptplug":
			$info->updateOption('bvptplug', $_REQUEST['ptplug']);
			$bvresp->addStatus("setptplug", $info->getOption('bvptplug'));
			break;
		case "unsetptplug":
			$info->deleteOption('bvptlug');
			$bvresp->addStatus("unsetptplug", $info->getOption('bvptlug'));
			break;
		case "wpupplgs":
			$bvresp->addStatus("wpupdateplugins", wp_update_plugins());
			break;
		case "wpupthms":
			$bvresp->addStatus("wpupdatethemes", wp_update_themes());
			break;
		case "wpupcre":
			$bvresp->addStatus("wpupdatecore", wp_version_check());
			break;
		case "rmmonitime":
			$bvcb->bvmain->unSetMonitTime();
			$bvresp->addStatus("rmmonitime", !$bvcb->bvmain->getMonitTime());
			break;
		case "phpinfo":
			phpinfo();
			die();
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;