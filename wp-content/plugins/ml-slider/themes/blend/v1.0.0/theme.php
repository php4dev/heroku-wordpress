<?php

if (!defined('ABSPATH')) die('No direct access.');

/**
 * Main theme file
 */
class MetaSlider_Theme_Blend extends MetaSlider_Theme_Base {
	/**
	 * Theme ID
	 *
	 * @var string
	 */
	public $id = 'blend';

	/**
	 * Theme Version
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	public function __construct() {
		parent::__construct($this->id, $this->version);
	}

	/**
	 * Parameters
	 *
	 * @var string
	 */
	public $slider_parameters = array();

	/**
	 * Enqueues theme specific styles and scripts
	 */
	public function enqueue_assets() {
		wp_enqueue_style('metaslider_blend_theme_styles', METASLIDER_THEMES_URL . $this->id . '/v1.0.0/style.min.css', array('metaslider-public'), '1.0.0');
		wp_enqueue_script('metaslider_theme_five_theme_script', METASLIDER_THEMES_URL . $this->id . '/v1.0.0/script.js', array('jquery'), '1.0.0', true);
	}

}

if (!isset(MetaSlider_Theme_Base::$themes['blend'])) new MetaSlider_Theme_Blend();
