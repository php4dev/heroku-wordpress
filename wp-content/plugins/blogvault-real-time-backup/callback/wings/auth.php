<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVAuthCallback')) :
class BVAuthCallback {

	function process($method) {
		global $bvresp, $bvcb;
		$auth = $bvcb->bvmain->auth;
		switch ($method) {
		case "addkeys":
			$bvresp->addStatus("status", $auth->addKeys($_REQUEST['public'], $_REQUEST['secret']));
			break;
		case "updatekeys":
			$bvresp->addStatus("status", $auth->updateKeys($_REQUEST['public'], $_REQUEST['secret']));
			break;
		case "rmkeys":
			$bvresp->addStatus("status", $auth->rmKeys($_REQUEST['public']));
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;