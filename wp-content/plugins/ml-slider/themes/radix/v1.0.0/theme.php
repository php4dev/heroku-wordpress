<?php

if (!defined('ABSPATH')) die('No direct access.');

/**
 * Main theme file
 */
class MetaSlider_Theme_Radix extends MetaSlider_Theme_Base {
	/**
	 * Theme ID
	 *
	 * @var string
	 */
	public $id = 'radix';

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
	public $slider_parameters = array(
		"prevText" => "''",
		"nextText" => "''"
	);


	public function __construct() {
		parent::__construct($this->id, $this->version);
		add_filter('metaslider_flex_slider_parameters', array($this, 'update_flexslider_counter'), 10, 2);
		add_filter('metaslider_responsive_slider_parameters', array($this, 'update_rslides_counter'), 10, 2);
		add_filter('metaslider_nivo_slider_parameters', array($this, 'update_nivo_counter'), 10, 2);
	}

	/**
     * Parameters
     *
	 * @param array  $options - The flexslider options
	 * @param string $id 	  - the id of the slideshow
	 *
	 * @return array
     */
	public function update_flexslider_counter($options, $id) {
		$options['before'] = isset($options['before']) ? $options['before'] : array();
		$options['start'] = isset($options['start']) ? $options['start'] : array();

		$options['before'] = array_merge($options['before'], array("
			$('.metaslider.has-dots-nav #metaslider_{$id} ol.flex-control-nav li a').hide();
			$('.metaslider.has-dots-nav #metaslider_{$id} ol.flex-control-nav li').eq(slider.animatingTo).children().show();"));

		$options['start'] = array_merge($options['start'], array("
			$('.metaslider.has-dots-nav #metaslider_{$id} ol.flex-control-nav').append('<li class=\'flex-slide-count\'></li>');
            $('.metaslider.has-dots-nav #metaslider_{$id} ol.flex-control-nav li a').hide().filter('.flex-active').show();
            $('.metaslider.has-dots-nav #metaslider_{$id} li.flex-slide-count').append('/ ' + slider.count);
			$('.metaslider.has-dots-nav #metaslider_{$id} .flex-control-nav').fadeTo('fast', 1);"));

		return $options;
	}

	/**
     * Parameters
     *
	 * @param array  $options - The flexslider options
	 * @param string $id 	  - the id of the slideshow
	 *
	 * @return array
     */
	public function update_rslides_counter($options, $id) {
		$options['before'] = isset($options['before']) ? $options['before'] : array();
		$options['before'] = array_merge($options['before'], array("$('.metaslider.has-dots-nav #metaslider_container_{$id} ul.rslides_tabs li:not(.rslides-slide-count)').hide();$('#metaslider_container_{$id} ul.rslides_tabs li').eq(slide).show();"));
		return $options;
	}

	/**
     * Parameters
     *
	 * @param array  $options - The flexslider options
	 * @param string $id 	  - the id of the slideshow
	 *
	 * @return array
     */
	public function update_nivo_counter($options, $id) {
		$options['afterChange'] = isset($options['afterChange']) ? $options['afterChange'] : array();
		$options['afterChange'] = array_merge($options['afterChange'], array("$('.metaslider.has-dots-nav #metaslider_container_{$id} div.nivo-controlNav a:not(.nivo-slide-count)').hide().filter('.active').show();"));
		return $options;
	}

	/**
	 * Enqueues theme specific styles and scripts
	 */
	public function enqueue_assets() {
		wp_enqueue_style('metaslider_radix_theme_styles', METASLIDER_THEMES_URL . $this->id . '/v1.0.0/style.min.css', array('metaslider-public'), '1.0.0');
		wp_enqueue_script('metaslider_radix_theme_script', METASLIDER_THEMES_URL . $this->id . '/v1.0.0/script.js', array('jquery'), '1.0.0', true);
	}
}

if (!isset(MetaSlider_Theme_Base::$themes['radix'])) new MetaSlider_Theme_Radix();
