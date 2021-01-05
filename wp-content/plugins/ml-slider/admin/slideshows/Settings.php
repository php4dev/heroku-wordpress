<?php

if (!defined('ABSPATH')) die('No direct access.');

/**
 * Class to handle individual slideshow settings
 */
class MetaSlider_Slideshow_Settings {

	/**
	 * Themes class
	 *
	 * @var object | bool
	 */
	private $settings;

	/**
	 * Constructor
	 *
	 * @param string|null $slideshow_id The settings object
	 */
	public function __construct($slideshow_id = null) {
		$this->settings = get_post_meta($slideshow_id, 'ml-slider_settings', true);
	}

	/**
	 * Returns settings
	 *
	 * @return object
	 */
	public function get_settings() {
		return $this->settings ? $this->settings : self::defaults();
	}

	/**
	 * Returns a single setting
	 *
	 * @param string $setting A single setting name
	 *
	 * @return mixed|WP_error The setting result or an error object
	 */
	public function get_single($setting) {
		return isset($this->settings[$setting]) ? $this->settings[$setting] : new WP_Error('invalid_setting', 'The setting was not found', array('status' => 404));
	}

	/**
	 * Returns the default settings
	 *
	 * @return array
	 */
	public static function defaults() {
		$defaults = array(
			'title' => __('New Slideshow', 'ml-slider'),
			'type' => 'flex',
			'random' => false,
			'cssClass' => '',
			'printCss' => true,
			'printJs' => true,
			'width' => 700,
			'height' => 300,
			'spw' => 7,
			'sph' => 5,
			'delay' => 3000,
			'sDelay' => 30,
			'opacity' => 0.7,
			'titleSpeed' => 500,
			'effect' => 'random',
			'navigation' => true,
			'links' => true,
			'hoverPause' => true,
			'theme' => 'none',
			'direction' => 'horizontal',
			'reverse' => false,
			'animationSpeed' => 600,
			'prevText' => __('Previous', 'ml-slider'),
			'nextText' => __('Next', 'ml-slider'),
			'slices' => 15,
			'center' => false,
			'smartCrop' => true,
			'carouselMode' => false,
			'carouselMargin' => 5,
			'firstSlideFadeIn' => false,
			'easing' => 'linear',
			'autoPlay' => true,
			'thumb_width' => 150,
			'thumb_height' => 100,
			'responsive_thumbs' => true,
			'thumb_min_width' => 100,
			'fullWidth' => true,
			'noConflict' => true
		);
		$defaults = apply_filters('metaslider_default_parameters', $defaults);
		$overrides = get_option('metaslider_default_settings');
		return is_array($overrides) ? array_merge($defaults, $overrides) : $defaults;
	}
}
