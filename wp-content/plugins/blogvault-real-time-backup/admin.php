<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVAdmin')) :

require_once dirname( __FILE__ ) . '/account.php';

class BVAdmin {
	public $bvmain;
	public $account;
	function __construct($bvmain) {
		$this->bvmain = $bvmain;
		$this->account = new BVAccountInfo($this->bvmain);
	}

	public function mainUrl($_params = '') {
		if (function_exists('network_admin_url')) {
			return network_admin_url('admin.php?page='.$this->bvmain->plugname.$_params);
		} else {
			return admin_url('admin.php?page='.$this->bvmain->plugname.$_params);
		}
	}

	public function initHandler() {
		if (!current_user_can('activate_plugins'))
			return;

		if (array_key_exists('bvnonce', $_REQUEST) &&
				wp_verify_nonce($_REQUEST['bvnonce'], "bvnonce") &&
				array_key_exists('blogvaultkey', $_REQUEST) &&
				(strlen($_REQUEST['blogvaultkey']) == 64) &&
				(array_key_exists('page', $_REQUEST) &&
				$_REQUEST['page'] == $this->bvmain->plugname)) {
			$keys = str_split($_REQUEST['blogvaultkey'], 32);
			$this->bvmain->auth->updateKeys($keys[0], $keys[1]);
			if (array_key_exists('redirect', $_REQUEST)) {
				$location = $_REQUEST['redirect'];
				wp_redirect($this->bvmain->appUrl()."/dash/redir?q=".urlencode($location));
				exit();
			}
		}
		if ($this->bvmain->isActivateRedirectSet()) {
			wp_redirect($this->mainUrl());
		}
	}

	public function menu() {
		$brand = $this->bvmain->getBrandInfo();
		if (!$brand || (!array_key_exists('hide', $brand) && !array_key_exists('hide_from_menu', $brand))) {
			$bname = $this->bvmain->getBrandName();
			add_menu_page($bname, $bname, 'manage_options', $this->bvmain->plugname,
					array($this, 'adminPage'), plugins_url('img/icon.png',  __FILE__ ));
		}
	}

	public function hidePluginDetails($plugin_metas, $slug) {
		$brand = $this->bvmain->getBrandInfo();
		$bvslug = $this->bvmain->slug;

		if ($slug === $bvslug && $brand && array_key_exists('hide_plugin_details', $brand)){
			foreach ($plugin_metas as $pluginKey => $pluginValue) {
				if (strpos($pluginValue, sprintf('>%s<', translate('View details')))) {
					unset($plugin_metas[$pluginKey]);
					break;
				}
			}
		}
		return $plugin_metas;
	}

	public function settingsLink($links, $file) {
		#XNOTE: Fix this
		if ( $file == plugin_basename( dirname(__FILE__).'/blogvault.php' ) ) {
			$brand = $this->bvmain->getBrandInfo();
			if (!$brand || !array_key_exists('hide_plugin_details', $brand)) {
				$links[] = '<a href="'.$this->mainUrl().'">'.__( 'Settings' ).'</a>';
			}
		}
		return $links;
	}

	public function getPluginLogo() {
		$brand = $this->bvmain->getBrandInfo();
		if ($brand && array_key_exists('logo', $brand)) {
			return $brand['logo'];
		}
		return $this->bvmain->logo;
	}

	public function getWebPage() {
		$brand = $this->bvmain->getBrandInfo();
		if ($brand && array_key_exists('webpage', $brand)) {
			return $brand['webpage'];
		}
		return $this->bvmain->webpage;
	}

	public function siteInfoTags() {
		$bvnonce = wp_create_nonce("bvnonce");
		$secret = $this->bvmain->auth->defaultSecret();
		$tags = "<input type='hidden' name='url' value='".$this->bvmain->info->wpurl()."'/>\n".
				"<input type='hidden' name='homeurl' value='".$this->bvmain->info->homeurl()."'/>\n".
				"<input type='hidden' name='siteurl' value='".$this->bvmain->info->siteurl()."'/>\n".
				"<input type='hidden' name='dbsig' value='".$this->bvmain->lib->dbsig(false)."'/>\n".
				"<input type='hidden' name='plug' value='".$this->bvmain->plugname."'/>\n".
				"<input type='hidden' name='adminurl' value='".$this->mainUrl()."'/>\n".
				"<input type='hidden' name='bvversion' value='".$this->bvmain->version."'/>\n".
	 			"<input type='hidden' name='serverip' value='".$_SERVER["SERVER_ADDR"]."'/>\n".
				"<input type='hidden' name='abspath' value='".ABSPATH."'/>\n".
				"<input type='hidden' name='secret' value='".$secret."'/>\n".
				"<input type='hidden' name='bvnonce' value='".$bvnonce."'/>\n";
		return $tags;
	}

	public function activateWarning() {
		global $hook_suffix;
		if (!$this->bvmain->isConfigured() && $hook_suffix == 'index.php' ) {
?>
			<div id="message" class="updated" style="padding: 8px; font-size: 16px; background-color: #dff0d8">
						<a class="button-primary" href="<?php echo $this->mainUrl(); ?>">Activate BlogVault</a>
						&nbsp;&nbsp;&nbsp;<b>Almost Done:</b> Activate your BlogVault account to backup & secure your site.
			</div>
<?php
		}
	}

	public function isConfigured() {
		$accounts = $this->account->allAccounts();
		return (is_array($accounts) && sizeof($accounts) >= 1);
	}

	public function adminPage() {
		wp_enqueue_style( 'bvsurface', plugins_url('css/bvmui.min.css', __FILE__));
		if (isset($_REQUEST['bvnonce']) && wp_verify_nonce( $_REQUEST['bvnonce'], 'bvnonce' )) {
			$this->account->remove($_REQUEST['pubkey']);
		}
		require_once dirname( __FILE__ ) . '/admin/header.php';
		if ($this->isConfigured()) {
			if (!isset($_REQUEST['add_account'])) {
				require_once dirname( __FILE__ ) . '/admin/main_page.php';
			} else {
				require_once dirname( __FILE__ ) . '/admin/add_new_acc.php';
			}
		} else {
			require_once dirname( __FILE__ ) . '/admin/add_new_acc.php';
		}
		require_once dirname( __FILE__ ) . '/admin/footer.php';
	}

	public function initBranding($plugins) {
		$slug = $this->bvmain->slug;
		$brand = $this->bvmain->getBrandInfo();
		if ($brand) {
			if (array_key_exists('hide', $brand)) {
				unset($plugins[$slug]);
			} else {
				if (array_key_exists('name', $brand)) {
					$plugins[$slug]['Name'] = $brand['name'];
				}
				if (array_key_exists('title', $brand)) {
					$plugins[$slug]['Title'] = $brand['title'];
				}
				if (array_key_exists('description', $brand)) {
					$plugins[$slug]['Description'] = $brand['description'];
				}
				if (array_key_exists('authoruri', $brand)) {
					$plugins[$slug]['AuthorURI'] = $brand['authoruri'];
				}
				if (array_key_exists('author', $brand)) {
					$plugins[$slug]['Author'] = $brand['author'];
				}
				if (array_key_exists('authorname', $brand)) {
					$plugins[$slug]['AuthorName'] = $brand['authorname'];
				}
				if (array_key_exists('pluginuri', $brand)) {
					$plugins[$slug]['PluginURI'] = $brand['pluginuri'];
				}
			}
		}
		return $plugins;
	}
}
endif;