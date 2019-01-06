<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVRecover')) :
class BVRecover {
	public $keyname;
	public $keysize;
	public $signature;
	public $original;

	function __construct($_sig, $_orig, $_keyname, $_keysize) {
		$this->keyname = $_keyname;
		$this->keysize = $_keysize;
		$this->signature = $_sig;
		$this->original = $_orig;
	}

	public function keyFile() {
		return dirname(__DIR__)."/publickeys/$this->keyname.pub";
	}

	public function getAsymKey() {
		return file_get_contents($this->keyFile());
	}

	public function asymEncrypt($source) {
		$output = '';
		$blocksize = 1 + floor(($this->keysize - 1) / 8) - 11;
		while ($source) {
			$input = substr($source, 0, $blocksize);
			$source = substr($source, $blocksize);
			openssl_public_encrypt($input, $encrypted, $this->getAsymKey());

			$output .= $encrypted;
		}
		return base64_encode($output);
	}

	public function validate() {
		global $bvresp;
		if (!preg_match('/^\w+$/', $this->keyname)) {
			$bvresp->addStatus('asymerror', 'badkey');
			return false;
		} else if (!file_exists($this->keyFile())) {
			$bvresp->addStatus('asymerror', 'missingkey');
			return false;
		} else if (!function_exists('openssl_public_decrypt')) {
			$bvresp->addStatus('asymerror', 'openssl_public_decrypt');
			return false;
		} else if (!function_exists('openssl_public_encrypt')) {
			$bvresp->addStatus('asymerror', 'openssl_public_encrypt');
			return false;
		}
		return true;
	}

	public function process() {
		openssl_public_decrypt($this->signature, $decrypted, $this->getAsymKey());
		if ((strlen($decrypted) >= 32) && ($this->original === substr($decrypted, 0, 32))) {
			return 1;
		}
		return false;
	}

	public function processKeyExchange() {
		global $bvresp, $bvcb;
		$bvmain = $bvcb->bvmain;
		$keys = $bvmain->auth->allKeys();
		$keys['dbsig'] = $bvmain->lib->dbsig(true);
		$keys['salt'] = $bvmain->lib->randString(32);
		$bvresp->addStatus("activatetime", $bvmain->info->getOption('bvActivateTime'));
		$bvresp->addStatus("currenttime", time());
		$bvresp->addStatus("keys", $this->asymEncrypt(serialize($keys)));
	}
}
endif;