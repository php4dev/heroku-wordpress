<?php
if (!defined('ABSPATH')) exit;
if (!class_exists('BVProtect')) :
	
require_once dirname( __FILE__ ) . '/logger.php';
require_once dirname( __FILE__ ) . '/fw/fw.php';
require_once dirname( __FILE__ ) . '/lp/lp.php';

class BVProtect {
	public $bvmain;
	
	function __construct($bvmain) {
		$this->bvmain = $bvmain;
	}

	public function init() {
		$ip = $this->getIP();
		$fw = new BVFW($this->bvmain, $ip);
		$fw->init();
		$lp = new BVLP($this->bvmain, $ip);
		$lp->init();
	}

	public function getIP() {
		$ip = '127.0.0.1';
		if (($ipHeader = $this->bvmain->getIPHeader()) && is_array($ipHeader)) {
			if (array_key_exists($ipHeader['hdr'], $_SERVER)) {
				$_ips = preg_split("/(,| |\t)/", $_SERVER[$ipHeader['hdr']]);
				if (array_key_exists(intval($ipHeader['pos']), $_ips)) {
					$ip = $_ips[intval($ipHeader['pos'])];
				}
			}
		} else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		$ip = trim($ip);
		if (preg_match('/^\[([0-9a-fA-F:]+)\](:[0-9]+)$/', $ip, $matches)) {
			$ip = $matches[1];
		} elseif (preg_match('/^([0-9.]+)(:[0-9]+)$/', $ip, $matches)) {
			$ip = $matches[1];
		}
		return $ip;
	}
}
endif;
