<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVAccountCallback')) :

require_once dirname( __FILE__ ) . '/../../account.php';

class BVAccountCallback {

	function process($method) {
		global $bvresp, $bvcb;
		$account = new BVAccountInfo($bvcb->bvmain);
		switch ($method) {
		case "updt":
			$info = array();
			$info['email'] = $_REQUEST['email'];
			$info['url'] = $_REQUEST['url'];
			$info['pubkey'] = $_REQUEST['pubkey'];
			$account->add($info);
			$bvresp->addStatus("status", $account->doesAccountExists($_REQUEST['pubkey']));
			break;
		case "disc":
			$account->remove($_REQUEST['pubkey']);
			$bvresp->addStatus("status", !$account->doesAccountExists($_REQUEST['pubkey']));
		case "fetch":
			$bvresp->addStatus("status", $account->allAccounts());
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;