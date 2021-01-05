<?php

if (!defined('ABSPATH')) die('No direct access.');

/**
 * Main theme file
 */
class MetaSlider_Theme_Precognition extends MetaSlider_Theme_Base {
	/**
	 * Theme ID
	 *
	 * @var string
	 */
	public $id = 'precognition';

	/**
	 * Theme Version
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Parameters
	 *
	 * @var string
	 */
	public $slider_parameters = array();

	public function __construct() {
		parent::__construct($this->id, $this->version);
		add_filter('metaslider_flex_slider_parameters', array($this, 'use_manual_controls'), 10, 3);
		add_filter('metaslider_flex_slider_get_html', array($this, 'add_title_to_replace_dots'), 10, 3);
	}

	/**
	 * Add manual controls to this theme
	 *
	 * @param array  $options	   - The flexslider options
	 * @param string $slideshow_id - the id of the slideshow
	 * @param array  $settings     - the id of the slideshow
	 *
	 * @return array
	 */
	public function use_manual_controls($options, $slideshow_id, $settings) {

		// Only do this on this theme
		$theme = get_post_meta($slideshow_id, 'metaslider_slideshow_theme', true);
		if ($this->id !== $theme['folder']) return $options;

		// Only enable this for dots nav
		if ('true' === $settings['navigation']) {
			$options['manualControls'] = "'.titleNav-{$slideshow_id} li a'";
		}
		return $options;
	}

	/**
	 * Enqueues theme specific styles and scripts
	 */
	public function enqueue_assets() {
		wp_enqueue_style('metaslider_precognition_theme_styles', METASLIDER_THEMES_URL . $this->id . '/v1.0.0/style.min.css', array('metaslider-public'), '1.0.0');
		wp_enqueue_script('metaslider_precognition_theme_script', METASLIDER_THEMES_URL . $this->id . '/v1.0.0/script.js', array('jquery'), '1.0.0', true);
	}
}

if (!isset(MetaSlider_Theme_Base::$themes['precognition'])) new MetaSlider_Theme_Precognition();
