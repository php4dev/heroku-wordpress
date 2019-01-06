<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVInfoCallback')) :
class BVInfoCallback {
	public function getPosts($post_type, $count = 5) {
		global $bvresp;
		$output = array();
		$args = array('numberposts' => $count, 'post_type' => $post_type);
		$posts = get_posts($args);
		$keys = array('post_title', 'guid', 'ID', 'post_date');
		foreach ($posts as $post) {
			$pdata = array();
			$post_array = get_object_vars($post);
			foreach ($keys as $key) {
				$pdata[$key] = $post_array[$key];
			}
			$bvresp->addArrayToStatus("posts", $pdata);
		}
	}

	public function getStats() {
		global $bvresp;
		$bvresp->addStatus("posts", get_object_vars(wp_count_posts()));
		$bvresp->addStatus("pages", get_object_vars(wp_count_posts("page")));
		$bvresp->addStatus("comments", get_object_vars(wp_count_comments()));
	}

	public function getPlugins() {
		global $bvresp;
		if (!function_exists('get_plugins')) {
			require_once (ABSPATH."wp-admin/includes/plugin.php");
		}
		$plugins = get_plugins();
		foreach ($plugins as $plugin_file => $plugin_data) {
			$pdata = array(
				'file' => $plugin_file,
				'title' => $plugin_data['Title'],
				'version' => $plugin_data['Version'],
				'active' => is_plugin_active($plugin_file),
				'network' => $plugin_data['Network']
			);
			$bvresp->addArrayToStatus("plugins", $pdata);
		}
	}

	public function themeToArray($theme) {
		if (is_object($theme)) {
			$pdata = array(
				'name' => $theme->Name,
				'title' => $theme->Title,
				'stylesheet' => $theme->get_stylesheet(),
				'template' => $theme->Template,
				'version' => $theme->Version
			);
		} else {
			$pdata = array(
				'name' => $theme["Name"],
				'title' => $theme["Title"],
				'stylesheet' => $theme["Stylesheet"],
				'template' => $theme["Template"],
				'version' => $theme["Version"]
			);
		}
		return $pdata;
	}

	public function getThemes() {
		global $bvresp;
		$themes = function_exists('wp_get_themes') ? wp_get_themes() : get_themes();
		foreach($themes as $theme) {
			$pdata = $this->themeToArray($theme);
			$bvresp->addArrayToStatus("themes", $pdata);
		}
		$theme = function_exists('wp_get_theme') ? wp_get_theme() : get_current_theme();
		$pdata = $this->themeToArray($theme);
		$bvresp->addStatus("currenttheme", $pdata);
	}

	public function getSystemInfo() {
		global $bvresp;
		$sys_info = array(
			'serverip' => $_SERVER['SERVER_ADDR'],
			'host' => $_SERVER['HTTP_HOST'],
			'phpversion' => phpversion(),
			'AF_INET6' => defined('AF_INET6')
		);
		if (function_exists('get_current_user')) {
			$sys_info['user'] = get_current_user();
		}
		if (function_exists('getmygid')) {
			$sys_info['gid'] = getmygid();
		}
		if (function_exists('getmyuid')) {
			$sys_info['uid'] = getmyuid();
		}
		if (function_exists('posix_getuid')) {
			$sys_info['webuid'] = posix_getuid();
			$sys_info['webgid'] = posix_getgid();
		}
		$bvresp->addStatus("sys", $sys_info);
	}

	public function getWpInfo() {
		global $wp_version, $wp_db_version, $wp_local_package;
		global $bvresp, $bvcb;
		$upload_dir = wp_upload_dir();
		$info = $bvcb->bvmain->info;

		$wp_info = array(
			'dbprefix' => $bvcb->bvmain->db->dbprefix(),
			'wpmu' => $info->isMultisite(),
			'mainsite' => $info->isMainSite(),
			'name' => get_bloginfo('name'),
			'siteurl' => $info->siteurl(),
			'homeurl' => $info->homeurl(),
			'charset' => get_bloginfo('charset'),
			'wpversion' => $wp_version,
			'dbversion' => $wp_db_version,
			'abspath' => ABSPATH,
			'uploadpath' => $upload_dir['basedir'],
			'uploaddir' => wp_upload_dir(),
			'contentdir' => defined('WP_CONTENT_DIR') ? WP_CONTENT_DIR : null,
			'contenturl' => defined('WP_CONTENT_URL') ? WP_CONTENT_URL : null,
			'plugindir' => defined('WP_PLUGIN_DIR') ? WP_PLUGIN_DIR : null,
			'dbcharset' => defined('DB_CHARSET') ? DB_CHARSET : null,
			'disallow_file_edit' => defined('DISALLOW_FILE_EDIT'),
			'disallow_file_mods' => defined('DISALLOW_FILE_MODS'),
			'locale' => get_locale(),
			'wp_local_string' => $wp_local_package,
			'charset_collate' => $bvcb->bvmain->db->getCharsetCollate()
		);
		$bvresp->addStatus("wp", $wp_info);
	}

	public function getUsers($args = array(), $full) {
		global $bvresp, $bvcb;
		$results = array();
		$users = get_users($args);
		if ('true' == $full) {
			$results = $bvcb->bvmain->lib->objectToArray($users);
		} else {
			foreach( (array) $users as $user) {
				$result = array();
				$result['user_email'] = $user->user_email;
				$result['ID'] = $user->ID;
				$result['roles'] = $user->roles;
				$result['user_login'] = $user->user_login;
				$result['display_name'] = $user->display_name;
				$result['user_registered'] = $user->user_registered;
				$result['user_status'] = $user->user_status;
				$result['user_url'] = $user->url;

				$results[] = $result;
			}
		}
		$bvresp->addStatus("users", $results);
	}
	
	public function availableFunctions(&$info) {
		if (extension_loaded('openssl')) {
			$info['openssl'] = "1";
		}
		if (function_exists('is_ssl') && is_ssl()) {
			$info['https'] = "1";
		}
		if (function_exists('openssl_public_encrypt')) {
			$info['openssl_public_encrypt'] = "1";
		}
		if (function_exists('openssl_public_decrypt')) {
			$info['openssl_public_decrypt'] = "1";
		}
		$info['sha1'] = "1";
		$info['apissl'] = "1";
		if (function_exists('base64_encode')) {
			$info['b64encode'] = true;
		}
		if (function_exists('base64_decode')) {
			$info['b64decode'] = true;
		}
		return $info;
	}
	
	public function servicesInfo(&$info) {
		global $bvcb;
		$bvinfo = $bvcb->bvmain->info;
		$info['dynsync'] = $bvinfo->getOption('bvDynSyncActive');
		$info['woodyn'] = $bvinfo->getOption('bvWooDynSync');
		$info['dynplug'] = $bvinfo->getOption('bvdynplug');
		$info['ptplug'] = $bvinfo->getOption('bvptplug');
		$info['fw'] = $this->getFWConfig();
		$info['lp'] = $this->getLPConfig();
		$info['brand'] = $bvinfo->getOption($bvcb->bvmain->brand_option);
		$info['badgeinfo'] = $bvinfo->getOption($bvcb->bvmain->badgeinfo);
	}

	public function getLPConfig() {
		global $bvcb;
		$config = array();
		$bvinfo = $bvcb->bvmain->info;
		$mode = $bvinfo->getOption('bvlpmode');
		$cplimit = $bvinfo->getOption('bvlpcaptchalimit');
		$tplimit = $bvinfo->getOption('bvlptempblocklimit');
		$bllimit = $bvinfo->getOption('bvlpblockAllLimit');
		$config['mode'] = intval($mode ? $mode : 1);
		$config['captcha_limit'] = intval($cplimit ? $cplimit : 3);
		$config['temp_block_limit'] = intval($tplimit? $tplimit : 6);
		$config['block_all_limit'] = intval($bllimit ? $bllimit : 100);
		return $config;
	}

	public function getFWConfig() {
		global $bvcb;
		$config = array();
		$bvinfo = $bvcb->bvmain->info;
		$mode = $bvinfo->getOption('bvfwmode');
		$drules = $bvinfo->getOption('bvfwdisabledrules');
		$rmode = $bvinfo->getOption('bvfwrulesmode');
		$config['mode'] = intval($mode ? $mode : 1);
		$config['disabled_rules'] = $drules ? $drules : array();
		$config['rules_mode'] = intval($rmode ? $rmode : 1);
		return $config;
	}

	public function dbconf(&$info) {
		global $bvcb;
		if (defined('DB_CHARSET'))
			$info['dbcharset'] = DB_CHARSET;
		$info['dbprefix'] = $bvcb->bvmain->db->dbprefix();
		$info['charset_collate'] = $bvcb->bvmain->db->getCharsetCollate();
		return $info;
	}
	
	public function activate() {
		global $bvcb, $bvresp;
		$resp = array();
		$bvcb->bvmain->info->basic($resp);
		$this->servicesInfo($resp);
		$this->dbconf($resp);
		$this->availableFunctions($resp);
		$bvresp->addStatus('actinfo', $resp);
	}

	public function process($method) {
		global $bvresp, $bvcb;
		switch ($method) {
		case "activateinfo":
			$this->activate();
			break;
		case "gtpsts":
			$count = 5;
			if (array_key_exists('count', $_REQUEST))
				$count = $_REQUEST['count'];
			$this->getPosts($_REQUEST['post_type'], $count);
			break;
		case "gtsts":
			$this->getStats();
			break;
		case "gtplgs":
			$this->getPlugins();
			break;
		case "gtthms":
			$this->getThemes();
			break;
		case "gtsym":
			$this->getSystemInfo();
			break;
		case "gtwp":
			$this->getWpInfo();
			break;
		case "getoption":
			$bvresp->addStatus("option", $bvresp->getOption($_REQUEST['name']));
			break;
		case "gtusrs":
			$full = false;
			if (array_key_exists('full', $_REQUEST))
				$full = true;
			$this->getUsers($_REQUEST['args'], $full);
			break;
		case "gttrnsnt":
			$transient = $bvcb->bvmain->info->getTransient($_REQUEST['name']);
			if ($transient && array_key_exists('asarray', $_REQUEST))
				$transient = $bvcb->bvmain->lib->objectToArray($transient);
			$bvresp->addStatus("transient", $transient);
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;