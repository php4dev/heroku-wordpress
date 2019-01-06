<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVCallback')) :
	
require_once dirname( __FILE__ ) . '/callback/response.php';

class BVCallback {
	public $bvmain;
	function __construct($bvmain) {
		$this->bvmain = $bvmain;
	}

	public function serversig($full = false) {
		$sig = sha1($_SERVER['SERVER_ADDR'].ABSPATH);
		if ($full)
			return $sig;
		else
			return substr($sig, 0, 6);
	}

	public function terminate($with_basic, $bvdebug = false) {
		global $bvresp;
		$public = $this->bvmain->auth->defaultPublic();
		$bvresp->addStatus("signature", "Blogvault API");
		$bvresp->addStatus("asymauth", "true");
		$bvresp->addStatus("sha1", "true");
		$bvresp->addStatus("dbsig", $this->bvmain->lib->dbsig(false));
		$bvresp->addStatus("serversig", $this->serversig(false));
		$bvresp->addStatus("public", substr($public, 0, 6));
		if ($with_basic) {
			$binfo = array();
			$this->bvmain->info->basic($binfo);
			$bvresp->addStatus("basic", $binfo);
			$bvresp->addStatus("bvversion", $this->bvmain->version);
		}

		if ($bvdebug) {
			$bvresp->addStatus("inreq", $_REQUEST);
		}

		$bvresp->finish();
		exit;
	}

	public function processParams() {
		if (array_key_exists('concat', $_REQUEST)) {
			foreach ($_REQUEST['concat'] as $key) {
				$concated = '';
				$count = intval($_REQUEST[$key]);
				for ($i = 1; $i <= $count; $i++) {
					$concated .= $_REQUEST[$key."_bv_".$i];
				}
				$_REQUEST[$key] = $concated;
			}
		}
		if (array_key_exists('b64', $_REQUEST)) {
			foreach ($_REQUEST['b64'] as $key) {
				if (is_array($_REQUEST[$key])) {
					$_REQUEST[$key] = array_map('base64_decode', $_REQUEST[$key]);
				} else {
					$_REQUEST[$key] = base64_decode($_REQUEST[$key]);
				}
			}
		}
		if (array_key_exists('unser', $_REQUEST)) {
			foreach ($_REQUEST['unser'] as $key) {
				$_REQUEST[$key] = json_decode($_REQUEST[$key], TRUE);
			}
		}
		if (array_key_exists('b642', $_REQUEST)) {
			foreach ($_REQUEST['b642'] as $key) {
				if (is_array($_REQUEST[$key])) {
					$_REQUEST[$key] = array_map('base64_decode', $_REQUEST[$key]);
				} else {
					$_REQUEST[$key] = base64_decode($_REQUEST[$key]);
				}
			}
		}
		if (array_key_exists('dic', $_REQUEST)) {
			foreach ($_REQUEST['dic'] as $key => $mkey) {
				$_REQUEST[$mkey] = $_REQUEST[$key];
				unset($_REQUEST[$key]);
			}
		}
		if (array_key_exists('clacts', $_REQUEST)) {
			foreach ($_REQUEST['clacts'] as $action) {
				remove_all_actions($action);
			}
		}
		if (array_key_exists('clallacts', $_REQUEST)) {
			global $wp_filter;
			foreach ( $wp_filter as $filter => $val ){
				remove_all_actions($filter);
			}
		}
		if (array_key_exists('memset', $_REQUEST)) {
			$val = intval(urldecode($_REQUEST['memset']));
			@ini_set('memory_limit', $val.'M');
		}
	}

	public function recover() {
		$recover = new BVRecover(base64_decode($_REQUEST['sig']), $_REQUEST['orig'],
				$_REQUEST['keyname'], $_REQUEST["keysize"]);
		if ($recover->validate() && ($recover->process() === 1)) {
			$recover->processKeyExchange();
			return 1;
		}
		return false;
	}

	public function preauth() {
		global $bvresp;
		if (array_key_exists('obend', $_REQUEST) && function_exists('ob_end_clean'))
			@ob_end_clean();
		if (array_key_exists('op_reset', $_REQUEST) && function_exists('output_reset_rewrite_vars'))
			@output_reset_rewrite_vars();
		if (array_key_exists('binhead', $_REQUEST)) {
			header("Content-type: application/binary");
			header('Content-Transfer-Encoding: binary');
		}
		if (array_key_exists('bvrcvr', $_REQUEST)) {
			require_once dirname( __FILE__ ) . '/callback/recover.php';
			if ($this->recover() !== 1) {
				$bvresp->addStatus("statusmsg", 'failed authentication');
			}
			$this->terminate(false, array_key_exists('bvdbg', $_REQUEST));
			return false;
		}
		return 1;
	}

	public function authenticate() {
		global $bvresp;
		$auth = $this->bvmain->auth;
		$method = $_REQUEST['bvMethod'];
		$time = intval($_REQUEST['bvTime']);
		$version = $_REQUEST['bvVersion'];
		$sig = $_REQUEST['sig'];
		$public = $auth->publicParam();

		$bvresp->addStatus("requestedsig", $sig);
		$bvresp->addStatus("requestedtime", $time);
		$bvresp->addStatus("requestedversion", $version);

		$sig_match = $auth->validate($public, $method, $time, $version, $sig);
		if ($sig_match === 1) {
			return 1;
		} else {
			$bvresp->addStatus("sigmatch", substr($sig_match, 0, 6));
			$bvresp->addStatus("statusmsg", 'failed authentication');
			return false;
		}
	}

	public function route($wing, $method) {
		global $bvresp;
		$bvresp->addStatus("callback", $method);
		switch ($wing) {
		case 'manage':
			require_once dirname( __FILE__ ) . '/callback/wings/manage.php';
			$module = new BVManageCallback();
			break;
		case 'fs':
			require_once dirname( __FILE__ ) . '/callback/wings/fs.php';
			$module = new BVFSCallback();
			break;
		case 'db':
			require_once dirname( __FILE__ ) . '/callback/wings/db.php';
			$module = new BVDBCallback();
			break;
		case 'info':
			require_once dirname( __FILE__ ) . '/callback/wings/info.php';
			$module = new BVInfoCallback();
			break;
		case 'dynsync':
			require_once dirname( __FILE__ ) . '/callback/wings/dynsync.php';
			$module = new BVDynSyncCallback();
			break;
		case 'ipstr':
			require_once dirname( __FILE__ ) . '/callback/wings/ipstore.php';
			$module = new BVIPStoreCallback();
			break;
		case 'auth':
			require_once dirname( __FILE__ ) . '/callback/wings/auth.php';
			$module = new BVAuthCallback();
			break;
		case 'fw':
			require_once dirname( __FILE__ ) . '/callback/wings/fw.php';
			$module = new BVFirewallCallback();
			break;
		case 'lp':
			require_once dirname( __FILE__ ) . '/callback/wings/lp.php';
			$module = new BVLoginProtectCallback();
			break;
		case 'monit':
			require_once dirname( __FILE__ ) . '/callback/wings/monit.php';
			$module = new BVMonitCallback();
			break;
		case 'brand':
			require_once dirname( __FILE__ ) . '/callback/wings/brand.php';
			$module = new BVBrandCallback();
			break;
		case 'pt':
			require_once dirname( __FILE__ ) . '/callback/wings/protect.php';
			$module = new BVProtectCallback();
			break;
		case 'act':
			require_once dirname( __FILE__ ) . '/callback/wings/account.php';
			$module = new BVAccountCallback();
			break;
		default:
			require_once dirname( __FILE__ ) . '/callback/wings/misc.php';
			$module = new BVMiscCallback();
			break;
		}
		$rval = $module->process($method);
		if ($rval === false) {
			$bvresp->addStatus("statusmsg", "Bad Command");
			$bvresp->addStatus("status", false);
		}
		return 1;
	}

	public function execute() {
		global $bvresp;
		$this->processParams();
		if ($bvresp->startStream()) {
			$this->route($_REQUEST['wing'], $_REQUEST['bvMethod']);
			$bvresp->endStream();
		}
		$this->terminate(true, array_key_exists('bvdbg', $_REQUEST));
	}
}
endif;