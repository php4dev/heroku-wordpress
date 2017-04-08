<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * WPBakery Visual Composer updater
 *
 * @package WPBakeryVisualComposer
 *
 */

/**
 * Vc updating manager.
 */
class Vc_Updater {
	/**
	 * @var string
	 */
	protected $version_url = 'http://wpbakery.com/version/?';

	/**
	 * Proxy URL that returns real download link
	 *
	 * @var string
	 */
	protected $download_link_url = 'http://support.wpbakery.com/updates/download-link';

	/**
	 * @var string
	 */
	public $title = 'WPBakery Visual Composer';

	/**
	 * @var bool
	 */
	protected $auto_updater = false;

	/**
	 * @var bool
	 */
	protected $upgrade_manager = false;

	/**
	 * @var bool
	 */
	protected $iframe = false;

	public function init() {
		add_filter( 'upgrader_pre_download', array( $this, 'preUpgradeFilter' ), 10, 4 );

		add_action( 'wp_ajax_nopriv_vc_check_license_key', array( $this, 'checkLicenseKeyFromRemote' ) );
	}

	public function checkLicenseKeyFromRemote() {
		vc_license()->checkLicenseKeyFromRemote();
	}

	/**
	 * Setter for manager updater.
	 *
	 * @param Vc_Updating_Manager $updater
	 */
	public function setUpdateManager( Vc_Updating_Manager $updater ) {
		$this->auto_updater = $updater;
	}

	/**
	 * Getter for manager updater.
	 *
	 * @return Vc_Updating_Manager
	 */
	public function updateManager() {
		return $this->auto_updater;
	}

	/**
	 * Get url for version validation
	 * @return string
	 */
	public function versionUrl() {
		return $this->version_url . time();
	}

	/**
	 * Get unique, short-lived download link
	 *
	 * @param string $license_key
	 *
	 * @return array|boolean JSON response or false if request failed
	 */
	public function getDownloadUrl( $license_key ) {
		$url = rawurlencode( $_SERVER['HTTP_HOST'] );
		$key = rawurlencode( $license_key );

		$url = $this->download_link_url . '?product=vc&url=' . $url . '&key=' . $key . '&version=' . WPB_VC_VERSION;

		$response = wp_remote_get( $url );

		if ( is_wp_error( $response ) ) {
			return false;
		}

		return json_decode( $response['body'], true );
	}

	/**
	 * Get link to newest VC
	 *
	 * @param $reply
	 * @param $package
	 * @param $updater
	 *
	 * @return mixed|string|WP_Error
	 */
	public function preUpgradeFilter( $reply, $package, $updater ) {
		$condition1 = isset( $updater->skin->plugin ) && $updater->skin->plugin === vc_plugin_name();
		$condition2 = isset( $updater->skin->plugin_info ) && $updater->skin->plugin_info['Name'] === $this->title;
		if ( ! $condition1 && ! $condition2 ) {
			return $reply;
		}

		$res = $updater->fs_connect( array( WP_CONTENT_DIR ) );
		if ( ! $res ) {
			return new WP_Error( 'no_credentials', __( "Error! Can't connect to filesystem", 'js_composer' ) );
		}

		$license_key = vc_license()->getLicenseKey();

		if ( ! $license_key || ! vc_license()->isActivated() ) {
			if ( vc_is_as_theme() ) {
				return false;
			}
			$url = esc_url( is_multisite() ? network_admin_url( 'admin.php?page=vc-updater' ) : admin_url( 'admin.php?page=vc-updater' ) );
			return new WP_Error( 'no_credentials', __( 'To receive automatic updates license activation is required. Please visit <a href="' . $url . '' . '" target="_blank">Settings</a> to activate your Visual Composer.', 'js_composer' ) . ' ' . sprintf( ' <a href="http://go.wpbakery.com/faq-update-in-theme" target="_blank">%s</a>', __( 'Got Visual Composer in theme?', 'js_composer' ) ) );
		}

		$updater->strings['downloading_package_url'] = __( 'Getting download link...', 'js_composer' );
		$updater->skin->feedback( 'downloading_package_url' );

		$response = $this->getDownloadUrl( $license_key );

		if ( ! $response ) {
			return new WP_Error( 'no_credentials', __( 'Download link could not be retrieved', 'js_composer' ) );
		}

		if ( ! $response['status'] ) {
			return new WP_Error( 'no_credentials', $response['error'] );
		}

		$updater->strings['downloading_package'] = __( 'Downloading package...', 'js_composer' );
		$updater->skin->feedback( 'downloading_package' );

		$downloaded_archive = download_url( $response['url'] );
		if ( is_wp_error( $downloaded_archive ) ) {
			return $downloaded_archive;
		}

		$plugin_directory_name = 'js_composer';

		// WP will use same name for plugin directory as archive name, so we have to rename it
		if ( basename( $downloaded_archive, '.zip' ) !== $plugin_directory_name ) {
			$new_archive_name = dirname( $downloaded_archive ) . '/' . $plugin_directory_name . '.zip';
			rename( $downloaded_archive, $new_archive_name );
			$downloaded_archive = $new_archive_name;
		}

		return $downloaded_archive;
	}

	/**
	 * Downloads new VC from Envato marketplace and unzips into temporary directory.
	 *
	 * @deprecated 4.8
	 *
	 * @param $reply
	 * @param $package
	 * @param $updater
	 *
	 * @return mixed|string|WP_Error
	 */
	public function upgradeFilterFromEnvato( $reply, $package, $updater ) {
		_deprecated_function( '\Vc_Updater::upgradeFilterFromEnvato', '4.8 (will be removed in 4.11)' );
		global $wp_filesystem;

		if ( ( isset( $updater->skin->plugin ) && $updater->skin->plugin === vc_plugin_name() ) ||
		     ( isset( $updater->skin->plugin_info ) && $updater->skin->plugin_info['Name'] === $this->title )
		) {
			$updater->strings['download_envato'] = __( 'Downloading package from envato market...', 'js_composer' );
			$updater->skin->feedback( 'download_envato' );
			$package_filename = 'js_composer.zip';
			$res = $updater->fs_connect( array( WP_CONTENT_DIR ) );
			if ( ! $res ) {
				return new WP_Error( 'no_credentials', __( "Error! Can't connect to filesystem", 'js_composer' ) );
			}
			$username = vc_settings()->get( 'envato_username' );
			$api_key = vc_settings()->get( 'envato_api_key' );
			$purchase_code = vc_license()->getLicenseKey();
			if ( ! vc_license()->isActivated() || empty( $username ) || empty( $api_key ) || empty( $purchase_code ) ) {
				return new WP_Error( 'no_credentials', __( 'To receive automatic updates license activation is required. Please visit <a href="' . admin_url( 'admin.php?page=vc-updater' ) . '' . '" target="_blank">Settings</a> to activate your Visual Composer.', 'js_composer' ) );
			}
			$json = wp_remote_get( $this->envatoDownloadPurchaseUrl( $username, $api_key, $purchase_code ) );
			$result = json_decode( $json['body'], true );
			if ( ! isset( $result['download-purchase']['download_url'] ) ) {
				return new WP_Error( 'no_credentials', __( 'Error! Envato API error', 'js_composer' ) . ( isset( $result['error'] ) ? ': ' . $result['error'] : '.' ) );
			}
			$result['download-purchase']['download_url'];
			$download_file = download_url( $result['download-purchase']['download_url'] );
			if ( is_wp_error( $download_file ) ) {
				return $download_file;
			}
			$upgrade_folder = $wp_filesystem->wp_content_dir() . 'uploads/js_composer_envato_package';
			if ( is_dir( $upgrade_folder ) ) {
				$wp_filesystem->delete( $upgrade_folder );
			}
			$result = unzip_file( $download_file, $upgrade_folder );
			if ( $result && is_file( $upgrade_folder . '/' . $package_filename ) ) {
				return $upgrade_folder . '/' . $package_filename;
			}

			return new WP_Error( 'no_credentials', __( 'Error on unzipping package', 'js_composer' ) );
		}

		return $reply;
	}

	/**
	 * @deprecated 4.8
	 */
	public function removeTemporaryDir() {
		_deprecated_function( '\Vc_Updater::removeTemporaryDir', '4.8 (will be removed in 4.11)' );
		global $wp_filesystem;
		if ( is_dir( $wp_filesystem->wp_content_dir() . 'uploads/js_composer_envato_package' ) ) {
			$wp_filesystem->delete( $wp_filesystem->wp_content_dir() . 'uploads/js_composer_envato_package', true );
		}
	}

	/**
	 * @deprecated 4.8
	 *
	 * @param $username
	 * @param $api_key
	 * @param $purchase_code
	 *
	 * @return string
	 */
	protected function envatoDownloadPurchaseUrl( $username, $api_key, $purchase_code ) {
		_deprecated_function( '\Vc_Updater::envatoDownloadPurchaseUrl', '4.8 (will be removed in 4.11)' );

		return 'http://marketplace.envato.com/api/edge/' . rawurlencode( $username ) . '/' . rawurlencode( $api_key ) . '/download-purchase:' . rawurlencode( $purchase_code ) . '.json';
	}

}