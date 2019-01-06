<?php 
/**
 * Theme Module Interface
 *
 * @author Mike Ems
 * @package Mvied
 *
 */

interface Mvied_Theme_Module_Interface {

	/**
	 * Initializes the module
	 *
	 * @param none
	 * @return void
	 */
	public function init();

	/**
	 * Set Theme
	 * 
	 * @param Mvied_Theme_Modular $theme
	 * @return Mvied_Theme_Module
	 */
	public function setTheme( Mvied_Theme_Modular $theme );

	/**
	 * Get Theme
	 * 
	 * @param none
	 * @return Mvied_Theme_Modular
	 */
	public function getTheme();
}