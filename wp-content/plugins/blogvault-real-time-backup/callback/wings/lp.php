<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVLoginProtectCallback')) :
	
require_once dirname( __FILE__ ) . '/../../lp/lp.php';

class BVLoginProtectCallback {
	public function unBlockLogins() {
		global $bvcb;
		$info = $bvcb->bvmain->info;
		$info->deleteTransient('bvlp_block_logins');
		$info->setTransient('bvlp_allow_logins', 'true', 1800);
		return $info->getTransient('bvlp_allow_logins');
	}

	public function blockLogins($time) {
		global $bvcb;
		$info = $bvcb->bvmain->info;
		$info->deleteTransient('bvlp_allow_logins');
		$info->setTransient('bvlp_block_logins', 'true', $time);
		return $info->getTransient('bvlp_block_logins');
	}

	public function unBlockIP($ip, $attempts, $time) {
		global $bvcb;
		$info = $bvcb->bvmain->info;
		$transient_name = BVLP::$unblock_ip_transient.$ip;
		$info->setTransient($transient_name, $attempts, $time);
		return $info->getTransient($transient_name);
	}
	
	public function process($method) {
		global $bvcb, $bvresp;
		$config = new BVLPConfig($bvcb->bvmain);
		switch ($method) {
		case "clrconfig":
			$bvresp->addStatus("clearconfig", $config->clear());
			break;
		case "setmode":
			$config->setMode($_REQUEST['mode']);
			$bvresp->addStatus("setmode", $config->getMode());
			break;
		case "setcaptchalimit":
			$config->setCaptchaLimit($_REQUEST['captcha_limit']);
			$bvresp->addStatus("captcha_limit", $config->getCaptchaLimit());
			break;
		case "settmpblklimit":
			$config->setTempBlockLimit($_REQUEST['temp_block_limit']);
			$bvresp->addStatus("temp_block_limit", $config->getTempBlockLimit());
			break;
		case "setblkalllimit":
			$config->setBlockAllLimit($_REQUEST['block_all_limit']);
			$bvresp->addStatus("block_all_limit", $config->getBlockAllLimit());
			break;
		case "unblklogins":
			$bvresp->addStatus("unblocklogins", $this->unBlockLogins());
			break;
		case "blklogins":
			$time = array_key_exists('time', $_REQUEST) ? $_REQUEST['time'] : 1800;
			$bvresp->addStatus("blocklogins", $this->blockLogins($time));
			break;
		case "unblkip":
			$bvresp->addStatus("unblockip", $this->unBlockIP($_REQUEST['ip'], $_REQUEST['attempts'], $_REQUEST['time']));
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;