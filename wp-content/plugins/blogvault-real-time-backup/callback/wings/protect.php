<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVProtectCallback')) :

require_once dirname( __FILE__ ) . '/../../protect.php';

class BVProtectCallback {
	public function process($method) {
		global $bvcb, $bvresp;
		$protect = new BVProtect($bvcb->bvmain);
		$info = $bvcb->bvmain->info;
		switch ($method) {
		case "gtipprobeinfo":
			$headers = $_REQUEST['hdrs'];
			$hdrsinfo = array();
			if ($headers && is_array($headers)) {
				foreach($headers as $hdr) {
					if (array_key_exists($hdr, $_SERVER)) {
						$hdrsinfo[$hdr] = $_SERVER[$hdr];
					}
				}
			}
			$bvresp->addStatus("hdrsinfo", $hdrsinfo);
			if ($iphdr = $info->getOption($bvcb->bvmain->ip_header_option)) {
				$bvresp->addStatus("iphdr", $iphdr);
			}
			break;
		case "gtraddr":
			$raddr = array_key_exists('REMOTE_ADDR', $_SERVER) ? $_SERVER['REMOTE_ADDR'] : false;
			$bvresp->addStatus("raddr", $raddr);
			break;
		case "gtallhdrs":
			$data = (function_exists('getallheaders')) ? getallheaders() : false;
			$bvresp->addStatus("allhdrs", $data);
			break;
		case "gtsvr":
			$bvresp->addStatus("svr", $_SERVER);
			break;
		case "gtip":
			$bvresp->addStatus("ip", $protect->getIP());
			break;
		case "stiphdr":
			$option_name = $bvcb->bvmain->ip_header_option;
			$iphdr = array('hdr' => $_REQUEST['hdr'], 'pos' => $_REQUEST['pos']);
			$info->updateOption($option_name, $iphdr);
			$bvresp->addStatus("iphdr", $info->getOption($option_name));
			break;
		case "gtiphdr":
			$bvresp->addStatus("iphdr", $info->getOption($bvcb->bvmain->ip_header_option));
			break;
		case "rmiphdr":
			$option_name = $bvcb->bvmain->ip_header_option;
			$info->deleteOption($option_name);
			$bvresp->addStatus("iphdr", $info->getOption($option_name));
			break;
		default:
			return false;
		}
	}
}
endif;