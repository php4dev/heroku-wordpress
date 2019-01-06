<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVAuth')) :

class BVAuth {
	public $info;
	function __construct($info) {
		$this->info = $info;
	}

	public function defaultPublic() {
		return $this->info->getOption('bvPublic');
	}

	public function defaultSecret() {
		return $this->info->getOption('bvSecretKey');
	}

	public function allKeys() {
		$keys = $this->info->getOption('bvkeys');
		if (!is_array($keys)) {
			$keys = array();
		}
		$public = $this->defaultPublic();
		$secret = $this->defaultSecret();
		if ($public)
			$keys[$public] = $secret;
		$keys['default'] = $secret;
		return $keys;
	}

	public function publicParam() {
		if (array_key_exists('pubkey', $_REQUEST)) {
			return $_REQUEST['pubkey'];
		} else {
			return $this->defaultPublic();
		}
	}

	public function secretForPublic($public = false) {
		$bvkeys = $this->allKeys();
		if ($public && array_key_exists($public, $bvkeys) && isset($bvkeys[$public]))
			return $bvkeys[$public];
		else
			return $this->defaultSecret();
	}

	public function addKeys($public, $secret) {
		$bvkeys = $this->info->getOption('bvkeys');
		if ($bvkeys && is_array($bvkeys))
			$bvkeys[$public] = $secret;
		else
			$bvkeys = array($public => $secret);
		$this->info->updateOption('bvkeys', $bvkeys);
	}

	public function updateKeys($publickey, $secretkey) {
		$this->info->updateOption('bvPublic', $publickey);
		$this->info->updateOption('bvSecretKey', $secretkey);
		$this->addKeys($publickey, $secretkey);
	}
	
	public function rmKeys($publickey) {
		$bvkeys = $this->info->getOption('bvkeys');
		if ($bvkeys && is_array($bvkeys)) {
			unset($bvkeys[$publickey]);
			$this->info->updateOption('bvkeys', $bvkeys);
			return true;
		}
		return false;
	}

	public function validate($public, $method, $time, $version, $sig) {
		$secret = $this->secretForPublic($public);
		if ($time < intval($this->info->getOption('bvLastRecvTime')) - 300) {
			return false;
		}
		if (array_key_exists('sha1', $_REQUEST)) {
			$sig_match = sha1($method.$secret.$time.$version);
		} else {
			$sig_match = md5($method.$secret.$time.$version);
		}
		if ($sig_match !== $sig) {
			return $sig_match;
		}
		$this->info->updateOption('bvLastRecvTime', $time);
		return 1;
	}
	
	public function newAuthParams($version) {
		$args = array();
		$time = time();
		$public = $this->publicParam();
		$secret = $this->secretForPublic($public);

		$sig = sha1($public.$secret.$time.$version);
		$args['sig'] = $sig;
		$args['bvTime'] = $time;
		$args['bvPublic'] = $public;
		$args['bvVersion'] = $version;
		$args['sha1'] = '1';
		return $args;
	}
}
endif;