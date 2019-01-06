<?php
/**
 * Base class for a WordPress plugin or theme
 *
 * @author Mike Ems
 * @package Mvied
 */
class Mvied_Base {

	/**
	 * Base directory
	 *
	 * @var string
	 */
	protected $_directory;

	/**
	 * Logger
	 *
	 * @var Mvied_Logger_Interface
	 */
	protected $_logger;

	/**
	 * Settings
	 *
	 * @var array
	 */
	protected $_settings = array();

	/**
	 * Slug
	 *
	 * Used as a unqiue identifier for the plugin.
	 *
	 * @var string
	 */
	protected $_slug;

	/**
	 * Version
	 *
	 * @var string
	 */
	protected $_version;

	/**
	 * View Directory
	 * 
	 * @var string
	 */
	protected $_view_directory;

	protected $_option_cache = array();
	protected $_blog_option_cache = array();

	/**
	 * Set Directory
	 * 
	 * @param string $directory
	 * @return object $this
	 */
	public function setDirectory( $directory ) {
		$this->_directory = $directory;
		return $this;
	}

	/**
	 * Get Directory
	 * 
	 * @param none
	 * @return string
	 */
	public function getDirectory() {
		return $this->_directory;
	}

	/**
	 * Set Logger
	 * 
	 * @param object $logger
	 * @return object $this
	 */
	public function setLogger( Mvied_Logger_Interface $logger ) {
		$this->_logger = $logger;
		return $this;
	}

	/**
	 * Get Logger
	 * 
	 * @param none
	 * @return object
	 */
	public function getLogger() {
		if ( ! isset($this->_logger) ) {
			die(__CLASS__ . ' missing Logger dependency.');
		}

		return $this->_logger->getInstance();
	}

	/**
	 * Get Setting
	 *
	 * @param string $setting
	 * @param int $setting_blog_id
	 * @return mixed
	 */
	public function getSetting( $setting, $blog_id = 0 ) {
		$setting_full = $this->getSlug() . '_' . $setting;
		if ( $blog_id > 0 ) {
			if (!isset($this->_blog_option_cache[$blog_id]))
				$this->_blog_option_cache[$blog_id] = array();
			if (isset($this->_blog_option_cache[$blog_id][$setting_full]))
				$value = $this->_blog_option_cache[$blog_id][$setting_full];
			else {
				$value = get_blog_option($blog_id, $setting_full);
				$this->_blog_option_cache[$blog_id][$setting_full] = $value;
			}
		} else {
			if (isset($this->_option_cache[$setting_full]))
				$value = $this->_option_cache[$setting_full];
			else {
				$value = get_option($setting_full);
				$this->_option_cache[$setting_full] = $value;
			}
		}

		// Load default option
		if ( $value === false && array_key_exists($setting, $this->_settings) ) {
			$value = $this->_settings[$setting];
		}
		// Convert 1's and 0's to boolean
		switch( $value ) {
			case "1":
				$value = true;
			break;
			case "0":
				$value = false;
			break;
		}
		return $value;
	}

	/**
	 * Get Settings
	 *
	 * @param none
	 * @return array
	 */
	public function getSettings() {
		return $this->_settings;
	}

	/**
	 * Set Setting
	 *
	 * @param string $setting
	 * @param mixed $value
	 * @param int $blog_id
	 * @return $this
	 */
	public function setSetting( $setting, $value, $blog_id = 0 ) {
		$setting_full = $this->getSlug() . '_' . $setting;
		if ( $blog_id > 0 ) {
			update_blog_option($blog_id, $setting_full, $value);
		} else {
			update_option($setting_full, $value);
		}
		return $this;
	}

	/**
	 * Set Slug
	 * 
	 * @param string $slug
	 * @return object $this
	 */
	public function setSlug( $slug ) {
		$this->_slug = $slug;
		return $this;
	}

	/**
	 * Get Slug
	 * 
	 * @param none
	 * @return string
	 */
	public function getSlug() {
		return $this->_slug;
	}

	/**
	 * Set Version
	 * 
	 * @param string $version
	 * @return object $this
	 */
	public function setVersion( $version ) {
		$this->_version = $version;
		return $this;
	}

	/**
	 * Get Version
	 * 
	 * @param none
	 * @return string
	 */
	public function getVersion() {
		return $this->_version;
	}

	/**
	 * Set View Directory
	 *
	 * @param string $view_directory
	 * @return object $this
	 */
	public function setViewDirectory( $view_directory ) {
		$this->_view_directory = $view_directory;
		return $this;
	}

	/**
	 * Get View Directory
	 *
	 * @param none
	 * @return string
	 */
	public function getViewDirectory() {
		return $this->_view_directory;
	}

	/**
	 * Render View
	 *
	 * @param none
	 * @return string
	 */
	public function renderView( $view = '', $args = array() ) {
		extract($args);
		include($this->getViewDirectory() . DIRECTORY_SEPARATOR . $view . '.php');
	}

}