<?php
/**
 * Base Plugin
 *
 * @author Mike Ems
 * @package Mvied
 */
class Mvied_Plugin_Base extends Mvied_Base {

	/**
	 * Plugin URL
	 *
	 * @var string
	 */
	protected $_plugin_url;

	/**
	 * Set Plugin Url
	 *
	 * @param string $plugin_url
	 * @return object $this
	 */
	public function setPluginUrl( $plugin_url ) {
		$this->_plugin_url = $plugin_url;
		return $this;
	}

	/**
	 * Get Plugin Url
	 *
	 * @param none
	 * @return string
	 */
	public function getPluginUrl() {
		return $this->_plugin_url;
	}

}
