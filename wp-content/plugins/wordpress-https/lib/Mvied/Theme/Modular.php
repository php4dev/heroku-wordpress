<?php
/**
 * Modular Theme
 *
 * @author Mike Ems
 * @package Mvied
 */
class Mvied_Theme_Modular extends Mvied_Modular {

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
				$this->getModule($module)->setTheme($this);
			} catch ( Exception $e ) {
				die('Unable to load module: \'' . $module . '\'. ' . $e->getMessage());
			}
		}

		return $this;
	}

}
