<?php
if (!defined('ABSPATH')) exit;
if (!class_exists('BVAccountInfo')) :

class BVAccountInfo {
	public $bvmain;
	
	function __construct($bvmain) {
		$this->bvmain = $bvmain;
	}

	public function add($info) {
		$accounts = $this->allAccounts();
		if(!is_array($accounts)) {
			$accounts = array();
		}
		$pubkey = $info['pubkey'];
		$accounts[$pubkey]['lastbackuptime'] = time();
		$accounts[$pubkey]['url'] = $info['url'];
		$accounts[$pubkey]['email'] = $info['email'];
		$this->update($accounts);
	}

	public function remove($pubkey) {
		$bvkeys = $this->bvmain->info->getOption('bvkeys');
		$accounts = $this->allAccounts();
		$this->bvmain->auth->rmkeys($pubkey);
		$this->bvmain->setup($this->bvmain->lib->randString(32));
		if ($accounts && is_array($accounts)) {
			unset($accounts[$pubkey]);
			$this->update($accounts);
			return true;
		}
		return false;
	}

	public function allAccounts() {
		return $this->bvmain->info->getOption('bvAccounts');
	}

	public function doesAccountExists($pubkey) {
		$accounts = $this->allAccounts();
		return	array_key_exists($pubkey, $accounts);
	}

	public function update($accounts) {
		$this->bvmain->info->updateOption('bvAccounts', $accounts);
	}
}
endif;