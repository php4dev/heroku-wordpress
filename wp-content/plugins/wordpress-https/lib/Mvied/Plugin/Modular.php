<?php
/**
 * Modular Plugin
 *
 * @author Mike Ems
 * @package Mvied
 */
class Mvied_Plugin_Modular extends Mvied_Modular {

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

	/**
	 * Load Module
	 *
	 * @param string $module
	 * @return $this
	 */
	public function loadModule( $module ) {
		$base_class = get_class($this);
		$module_full = 'Module\\' . $module;
		$filename = str_replace('\\', '/', $module);
		$filename = $filename . '.php';

		require_once($this->getModuleDirectory() . $filename);

		$class = $base_class . '_' . str_replace('\\', '_', $module_full);
		if ( ! isset($this->_modules[$class]) || ! is_object($this->_modules[$class]) || get_class($this->_modules[$class]) != $class ) {
			try {
				$object = new $class;
				$this->setModule($module_full, $object);
				$this->getModule($module)->setPlugin($this);
			} catch ( Exception $e ) {
				die('Unable to load module: \'' . $module . '\'. ' . $e->getMessage());
			}
		}

		return $this;
	}

}
