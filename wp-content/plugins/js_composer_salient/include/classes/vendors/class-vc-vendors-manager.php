<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
// _deprecated_file( 'class-vc-vendors-manager.php', '4.4 (will be removed in 4.10)', 'autoload logic', ' will be removed in 4.9' );

/**
 * Vendors manager to load required classes and functions to work with VC.
 * @deprecated due to autoload logic introduced in 4.4
 * @since 4.3
 */
class Vc_Vendors_Manager {
	/**
	 * @var array
	 */
	protected $vendors = array();

	/**
	 * @deprecated 4.4
	 */
	function __construct() {
		// _deprecated_function( 'Vc_Vendors_Manager::__construct', '4.4 (will be removed in 4.10)', 'autoload logic' );
		add_action( 'vc_before_init_base', array( &$this, 'init' ) );
	}

	/**
	 * @deprecated 4.4
	 */
	public function init() {
		// _deprecated_function( 'Vc_Vendors_Manager::init', '4.4 (will be removed in 4.10)', 'autoload logic' );

		require_once vc_path_dir( 'VENDORS_DIR', '_autoload.php' );
		$this->load();
	}

	/**
	 * @deprecated 4.4
	 *
	 * @param Vc_Vendor_Interface $vendor
	 */
	public function add( Vc_Vendor_Interface $vendor ) {
		// _deprecated_function( 'Vc_Vendors_Manager::add', '4.4 (will be removed in 4.10)', 'autoload logic' );

		$this->vendors[] = $vendor;
	}

	/**
	 * @deprecated 4.4
	 */
	public function load() {
		// _deprecated_function( 'Vc_Vendors_Manager::load', '4.4 (will be removed in 4.10)', 'autoload logic' );

		foreach ( $this->vendors as $vendor ) {
			/**
			 * @var $vendor Vc_Vendor_Interface
			 */
			$vendor->load();
		}
	}
}
