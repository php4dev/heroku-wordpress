<?php
if (!defined('ABSPATH')) exit;
if (!class_exists('BVIPStore')) :

	class BVIPStore {

		public $bvmain;
		public static $name = 'ip_store';

		#TYPE
		const BLACKLISTED = 1;
		const WHITELISTED = 2;

		#CATEGORY
		const FW = 3;
		const LP = 4;

		function __construct($bvmain) {
			$this->bvmain = $bvmain;
		} 

		function init() {
			add_action('clear_ip_store', array($this, 'clearConfig'));
		}

		public function clearConfig() {
			$this->bvmain->db->dropBVTable(BVIPStore::$name);
		}

		public function hasIPv6Support() {
			return defined('AF_INET6');
		}

		public static function isValidIP($ip) {
			return filter_var($ip, FILTER_VALIDATE_IP) !== false;
		}

		public function bvInetPton($ip) {
			$pton = $this->isValidIP($ip) ? ($this->hasIPv6Support() ? inet_pton($ip) : $this->_bvInetPton($ip)) : false;
			return $pton;
		}

		public function _bvInetPton($ip) {
			if (preg_match('/^(?:\d{1,3}(?:\.|$)){4}/', $ip)) {
				$octets = explode('.', $ip);
				$bin = chr($octets[0]) . chr($octets[1]) . chr($octets[2]) . chr($octets[3]);
				return $bin;
			}

			if (preg_match('/^((?:[\da-f]{1,4}(?::|)){0,8})(::)?((?:[\da-f]{1,4}(?::|)){0,8})$/i', $ip)) {
				if ($ip === '::') {
					return "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0";
				}
				$colon_count = substr_count($ip, ':');
				$dbl_colon_pos = strpos($ip, '::');
				if ($dbl_colon_pos !== false) {
					$ip = str_replace('::', str_repeat(':0000',
						(($dbl_colon_pos === 0 || $dbl_colon_pos === strlen($ip) - 2) ? 9 : 8) - $colon_count) . ':', $ip);
					$ip = trim($ip, ':');
				}

				$ip_groups = explode(':', $ip);
				$ipv6_bin = '';
				foreach ($ip_groups as $ip_group) {
					$ipv6_bin .= pack('H*', str_pad($ip_group, 4, '0', STR_PAD_LEFT));
				}

				return strlen($ipv6_bin) === 16 ? $ipv6_bin : false;
			}

			if (preg_match('/^(?:\:(?:\:0{1,4}){0,4}\:|(?:0{1,4}\:){5})ffff\:(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})$/i', $ip, $matches)) {
				$octets = explode('.', $matches[1]);
				return chr($octets[0]) . chr($octets[1]) . chr($octets[2]) . chr($octets[3]);
			}

			return false;
		}

		public function checkIPPresent($ip, $type, $category) {
			$db = $this->bvmain->db;
			$table = $db->getBVTable(BVIPStore::$name);
			if ($db->isTablePresent($table)) {
				$binIP = $this->bvInetPton($ip);
				if ($binIP !== false) {
					$category_str = ($category == BVIPStore::FW) ? "`is_fw` = true" : "`is_lp` = true";
					$query_str = "SELECT * FROM $table WHERE %s >= `start_ip_range` && %s <= `end_ip_range` && " . $category_str . " && `type` = %d LIMIT 1;";
					$query = $db->prepare($query_str, array($binIP, $binIP, $type));
					if ($db->getVar($query) > 0)
						return true;
				}
				return false;
			}
			return false;
		}

	}
endif;