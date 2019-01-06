<?php
/**
 * Modular base class for a WordPress plugin or theme
 *
 * @author Mike Ems
 * @package Mvied
 */
class Mvied_Modular extends Mvied_Base {

	/**
	 * Module directory
	 *
	 * @var string
	 */
	protected $_module_directory;

	/**
	 * Loaded Modules
	 *
	 * @var array
	 */
	protected $_modules = array();

	/**
	 * Set Module Directory
	 * 
	 * @param string $module_directory
	 * @return object $this
	 */
	public function setModuleDirectory( $module_directory ) {
		$this->_module_directory = $module_directory;
		return $this;
	}

	/**
	 * Get Module Directory
	 * 
	 * @param none
	 * @return string
	 */
	public function getModuleDirectory() {
		return $this->_module_directory;
	}

	/**
	 * Get Available Modules
	 *
	 * @param none
	 * @return array $modules
	 */
	public function getAvailableModules() {
		$modules = array();
		if ( is_dir($this->getModuleDirectory()) && $module_directory = opendir($this->getModuleDirectory()) ) {
			while ( false !== ($entry = readdir($module_directory)) ) {
				if ( strpos($entry, '.') !== 0 && strpos($entry, '.php') !== false ) {
					$module = str_replace('.php', '', $entry);
					if ( $module != 'Interface' ) {
						$modules[] = $module;
						if ( is_dir($this->getModuleDirectory() . $module) && $sub_module_directory = opendir($this->getModuleDirectory() . $module) ) {
							while ( false !== ($entry = readdir($sub_module_directory)) ) {
								if ( $entry != '.' && $entry != '..' ) {
									$sub_module = str_replace('.php', '', $entry);
									$modules[] = $module . '\\' . $sub_module;
								}
							}
						}
					}
				}
			}
		}
		return $modules;
	}

	/**
	 * Get Module
	 *
	 * @param string $module
	 * @return object
	 */
	public function getModule( $module ) {
		$module = 'Module\\' . $module;
		if ( isset($module) ) {
			if ( isset($this->_modules[$module]) ) {
				return $this->_modules[$module];
			}
		}

		die('Module not found: \'' . $module . '\'.');
	}

	/**
	 * Get Modules
	 * 
	 * Returns an array of all loaded modules
	 *
	 * @param none
	 * @return array $modules
	 */
	public function getModules() {
		$modules = array();
		if ( isset($this->_modules) ) {
			$modules = $this->_modules;
		}
		return $modules;
	}

	/**
	 * Set Module
	 *
	 * @param string $module
	 * @param object $object
	 * @return $this
	 */
	public function setModule( $module, $object ) {
		$this->_modules[$module] = $object;
		return $this;
	}

	/**
	 * Init
	 * 
	 * Initializes all of the modules.
	 *
	 * @param none
	 * @return $this
	 */
	public function init() {
		$modules = $this->getModules();
		foreach( $modules as $module ) {
			$module->init();
		}
		if ( isset($this->_slug) ) {
			do_action($this->_slug . '_init');
		}
		return $this;
	}

	/**
	 * Is Module Loaded?
	 *
	 * @param string $module
	 * @return boolean
	 */
	public function isModuleLoaded( $module ) {
		if ( is_object($this->getModule($module)) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Load Modules
	 * 
	 * Load specified modules. If no modules are specified, all modules are loaded.
	 *
	 * @param array $modules
	 * @return $this
	 */
	public function loadModules( $modules = array() ) {
		if ( sizeof($modules) == 0 ) {
			$modules = $this->getAvailableModules();
		}

		foreach( $modules as $module ) {
			$this->loadModule( $module );
		}
		return $this;
	}

	/**
	 * Unload Module
	 *
	 * @param string $module
	 * @return $this
	 */
	public function unloadModule( $module ) {
		$base_class = get_class($this);
		$module = 'Module\\' . $module;

		$modules = $this->getModules();

		unset($modules[$module]);

		$this->_modules = $modules;

		return $this;
	}

}