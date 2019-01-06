<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVFirewallCallback')) :
	
require_once dirname( __FILE__ ) . '/../../fw/config.php';

class BVFirewallCallback {
	public function process($method) {
		global $bvcb, $bvresp;
		$config = new BVFWConfig($bvcb->bvmain);
		switch ($method) {
		case "clrconfig":
			$bvresp->addStatus("clearconfig", $config->clear());
			break;
		case "setmode":
			$config->setMode($_REQUEST['mode']);
			$bvresp->addStatus("setmode", $config->getMode());
			break;
		case "dsblrules":
			$config->setDisabledRules($_REQUEST['disabled_rules']);
			$bvresp->addStatus("disabled_rules", $config->getDisabledRules());
			break;
		case "setrulesmode":
			$config->setRulesMode($_REQUEST['rules_mode']);
			$bvresp->addStatus("rules_mode", $config->getRulesMode());
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;