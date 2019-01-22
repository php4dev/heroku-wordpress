<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVLP')) :
	
require_once dirname( __FILE__ ) . '/config.php';
require_once dirname( __FILE__ ) . './../ipstore.php';

class BVLP {
	
	private $ip;
	private $time;
	private $category;
	private $username;
	private $message;
	public $config;
	public $bvmain;
	public $logger;
	public $ipstore;
	public static $requests_table = 'lp_requests';
	public static $unblock_ip_transient = 'bvlp_unblock_ip';

	#status
	const LOGINFAILURE = 1;
	const LOGINSUCCESS = 2;
	const LOGINBLOCKED = 3;

	#categories
	const CAPTCHABLOCK = 1;
	const TEMPBLOCK    = 2;
	const ALLBLOCKED   = 3;
	const UNBLOCKED    = 4;
	const BLACKLISTED  = 5;
	const BYPASSED     = 6;
	const ALLOWED      = 7;
	
	public function __construct($bvmain, $ip) {
		$this->bvmain = $bvmain;
		$this->ip = $ip;
		$this->config = new BVLPConfig($this->bvmain);
		$this->ipstore = new BVIPStore($bvmain);
		$this->logger = new BVLogger($this->bvmain->db, BVLPConfig::$requests_table);
		$this->time = strtotime(date("Y-m-d H:i:s"));
	}

	public function init() {
		if ($this->isActive()) {
			$this->lpInit();
		}
		add_action('clear_lp_config', array($this->config, 'clear'));
	}

	public function lpInit() {
		add_filter('authenticate', array($this, 'loginInit'), 30, 3);
		add_action('wp_login', array($this, 'loginSuccess'));
		add_action('wp_login_failed', array($this, 'loginFailed'));
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	public function setUserName($username) {
		$this->username = $username;
	}

	public function setCategory($category) {
		$this->category = $category;
	}

	public function getCaptchaLink() {
		$bvmain = $this->bvmain;
		$url = $bvmain->authenticatedUrl('/captcha/solve');
		$url .= "&adminurl=".base64_encode(get_admin_url());
		return $url;
	}

	public function getUserName() {
		return $this->username ? $this->username : '';
	}

	public function getMessage() {
		return $this->message ? $this->message : '';
	}

	public function getCategory() {
		return $this->category ? $this->category : BVLP::ALLOWED;
	}

	public function getCaptchaLimit() {
		return $this->config->getCaptchaLimit();
	}

	public function getTempBlockLimit() {
		return $this->config->getTempBlockLimit();
	}

	public function getBlockAllLimit() {
		return $this->config->getBlockAllLimit();
	}

	public function getLoginLogsTable() {
		global $bvdb;
		return $bvdb->getBVTable(BVLP::$requests_table);
	}

	public function getAllowLoginsTransient() {
		return $this->bvmain->info->getTransient('bvlp_allow_logins');
	}

	public function getBlockLoginsTransient() {
		return $this->bvmain->info->getTransient('bvlp_block_logins');
	}

	public function terminateTemplate() {
		$brandname = $this->bvmain->getBrandName();
		$templates = array (
			1 => "<p>Too many failed attempts, You are barred from logging into this site.</p><a href=".$this->getCaptchaLink()." 
					class='btn btn-default'>Click here</a> to unblock yourself.",
			2 => "You cannot login to this site for 30 minutes because of too many failed login attempts.",
			3 => "<p>Logins to this site are currently blocked.</p><a href=".$this->getCaptchaLink()." 
					class='btn btn-default'>Click here</a> to unblock yourself.",
			5 => "Your IP is blacklisted."
		);
			return "
			<div style='height: 98vh;'>
				<div style='text-align: center; padding: 10% 0; font-family: Arial, Helvetica, sans-serif;'>
					<div><p><img src=".plugins_url('../img/icon.png', __FILE__)."><h2>Login Protection</h2><h3>powered by</h3><h2>"
							.$brandname."</h2></p><div>
					<p>" . $templates[$this->getCategory()]. "</p>
				</div>
			</div>";
	}

	public function isProtecting() {
		return ($this->config->getMode() === BVLPConfig::PROTECT);
	}

	public function isActive() {
		return ($this->config->getMode() !== BVLPConfig::DISABLED);
	}

	public function isBlacklistedIP() {
		return $this->ipstore->checkIPPresent($this->ip, BVIPStore::BLACKLISTED, BVIPStore::LP);
	}

	public function isWhitelistedIP() {
		return $this->ipstore->checkIPPresent($this->ip, BVIPStore::WHITELISTED, BVIPStore::LP);
	}

	public function isUnBlockedIP() {
		$transient_name = BVLP::$unblock_ip_transient.$this->ip;
		$attempts = $this->bvmain->info->getTransient($transient_name);
		if ($attempts && $attempts > 0) {
			$this->bvmain->info->setTransient($transient_name, $attempts - 1, 600 * $attempts);
			return true;
		}
		return false;
	}

	public function isLoginBlocked() {
		if ($this->getAllowLoginsTransient() ||
				($this->getLoginCount(BVLP::LOGINFAILURE) < $this->getBlockAllLimit())) {
			return false;
		}
		return true;
	}

	public function log($status) {
		$data = array (
			"ip" => $this->ip,
			"status" => $status,
			"time" => $this->time,
			"category" => $this->getCategory(),
			"username" => $this->getUserName(),
			"message" => $this->getMessage());
		$this->logger->log($data);
	}

	public function terminateLogin() {
		$this->setMessage('Login Blocked');
		$this->log(BVLP::LOGINBLOCKED);
		if ($this->isProtecting()) {
			header("Cache-Control: no-cache, no-store, must-revalidate");
			header("Pragma: no-cache");
			header("Expires: 0");
			header('HTTP/1.0 403 Forbidden');
			die($this->terminateTemplate());
			exit;
		}
	}

	public function loginInit($user, $username = '', $password = '') {
		if ($this->isUnBlockedIP()) {
			$this->setCategory(BVLP::UNBLOCKED);
		} else {
			$failed_attempts = $this->getLoginCount(BVLP::LOGINFAILURE, $this->ip);
			if ($this->isBlacklistedIP()) {
				$this->setCategory(BVLP::BLACKLISTED);
				$this->terminateLogin();
			} else if ($this->isKnownLogin() || $this->isWhitelistedIP()) {
				$this->setCategory(BVLP::BYPASSED);
			} else if ($this->isLoginBlocked()) {
				$this->setCategory(BVLP::ALLBLOCKED);
				$this->terminateLogin();
			} else if ($failed_attempts >= $this->getTempBlockLimit()) {
				$this->setCategory(BVLP::TEMPBLOCK);
				$this->terminateLogin();
			} else if ($failed_attempts >= $this->getCaptchaLimit()) {
				$this->setCategory(BVLP::CAPTCHABLOCK);
				$this->terminateLogin();
			}
		}
		if (!empty($user) && !empty($password) && is_wp_error($user)) {
			$this->setMessage($user->get_error_code());
		}
		return $user;
	}

	public function loginFailed($username) {
		$this->setUserName($username);
		$this->log(BVLP::LOGINFAILURE);
	}

	public function loginSuccess($username) {
		$this->setUserName($username);
		$this->setMessage('Login Success');
		$this->log(BVLP::LOGINSUCCESS);
	}

	public function isKnownLogin() {
		return $this->getLoginCount(BVLP::LOGINSUCCESS, $this->ip, 3600) > 0;
	}

	public function getLoginCount($status, $ip = null, $gap = 1800) {
		$db = $this->bvmain->db;
		$table = $db->getBVTable(BVLP::$requests_table);
		$query = $db->prepare("SELECT COUNT(*) as count from `$table` WHERE status=%d && time > %d", array($status, ($this->time - $gap)));
		if ($ip) {
			$query .= $db->prepare(" && ip=%s", $ip);
		}
		$rows = $db->getResult($query);
		if (!$rows)
			return 0;
		return intval($rows[0]['count']);
	}
}
endif;