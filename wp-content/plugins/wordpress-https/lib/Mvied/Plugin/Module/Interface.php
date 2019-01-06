<?php 
/**
 * Plugin Module Interface
 *
 * @author Mike Ems
 * @package Mvied
 *
 */

interface Mvied_Plugin_Module_Interface {

	/**
	 * Initializes the module
	 *
	 * @param none
	 * @return void
	 */
	public function init();

	/**
	 * Set Plugin
	 * 
	 * @param Mvied_Plugin_Modular $plugin
	 * @return Mvied_Plugin_Module
	 */
	public function setPlugin( Mvied_Plugin_Modular $plugin );

	/**
	 * Get Plugin
	 * 
	 * @param none
	 * @return Mvied_Plugin_Modular
	 */
	public function getPlugin();
}