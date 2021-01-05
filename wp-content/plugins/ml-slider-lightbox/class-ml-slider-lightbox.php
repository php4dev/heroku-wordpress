<?php

if (!defined('ABSPATH')) die('No direct access.');

/**
 * Register the plugin.
 */
class MetaSliderLightboxPlugin {

	/**
	 * Lightbox version
	 *
	 * @var string
	 */
	public $version = '1.11.3';

	/**
	 * Instance object
	 *
	 * @var object
	 * @see get_instance()
	 */
	protected static $instance = NULL;

	/**
	 * An array of supported plugins
	 *
	 * @var array
	 * @see get_supported_plugins()
	 */
	private $supported_plugins = array();


	/**
	 * Used to access the instance
	 */
	public static function get_instance() {
		if (NULL === self::$instance) self::$instance = new self();
		return self::$instance;
	}

	/**
	 * Used to set up the plugin
	 */
	public function setup() {
		$this->supported_plugins = $this->get_supported_plugins();
		$this->add_settings();
		$this->setup_filters();
		$this->setup_admin_actions();
	}

	/**
	 * Constructor. Intentionally left empty and public.
	 */
	public function __construct() {}

	/**
	 * Run the filters for each slider type
	 */
	public function setup_filters() {

		if (is_admin()) {
			add_filter('metaslider_advanced_settings', array($this, 'add_settings'), 10, 2);
		}

		add_filter('metaslider_checkbox_settings', array($this, 'convert_checkboxes'), 10);

		add_filter('metaslider_flex_slider_anchor_attributes', array($this, 'add_attributes'), 10, 3 );
		add_filter('metaslider_nivo_slider_anchor_attributes', array($this, 'add_attributes'), 10, 3);
		add_filter('metaslider_responsive_slider_anchor_attributes', array($this, 'add_attributes'), 10, 3);
		add_filter('metaslider_coin_slider_anchor_attributes', array($this, 'add_attributes'), 10, 3);
		add_filter('metaslider_css_classes', array($this, 'add_classnames'), 10, 3);
	}

	/**
	 * Returns a list of supported plugins
	 *
	 * @return array
	 */
	public static function get_supported_plugins() {
		$supported_plugins_list = array(
			'ARI Fancy Lightbox' => array(
				'location' => 'ari-fancy-lightbox/ari-fancy-lightbox.php',
				'settings_url' => 'admin.php?page=ari-fancy-lightbox',
				'attributes' => array(
					'class' => 'fb-link ari-fancybox',
					'data-fancybox-group' => 'gallery',
					'data-caption' => ':caption'
				)
			),
			'Easy FancyBox' => array(
				'location' => 'easy-fancybox/easy-fancybox.php',
				'settings_url' => 'options-media.php',
				'rel' => 'lightbox',
			),
			'FooBox Image Lightbox' => array(
				'location' => 'foobox-image-lightbox/foobox-free.php',
				'settings_url' => 'admin.php?page=foobox-settings',
				'body_class' => 'gallery'
			),
			'FooBox HTML & Media Lightbox' => array(
				'location' => 'foobox-image-lightbox-premium/foobox-free.php',
				'settings_url' => 'options-general.php?page=foobox',
				'body_class' => 'gallery'
			),
			'Fancy Lightbox' => array(
				'location' => 'fancy-lightbox/fancy-lightbox.php',
				'settings_url' => '',
				'rel' => 'lightbox'
			),
			'Gallery Manager Lite' => array(
				'location' => 'fancy-gallery/plugin.php',
				'settings_url' => 'options-general.php?page=gallery-options'
			),
			'Gallery Manager Pro' => array(
				'location' => 'gallery-manager-pro/plugin.php',
				'settings_url' => 'options-general.php?page=gallery-options'
			),
			'imageLightbox' => array(
				'location' => 'imagelightbox/imagelightbox.php',
				'settings_url' => '',
				'rel' => 'lightbox',
				'attributes' => array(
					'data-imagelightbox' => '$slider_id'
				)
			),
			'jQuery Colorbox' => array(
				'location' => 'jquery-colorbox/jquery-colorbox.php',
				'settings_url' => 'options-general.php?page=jquery-colorbox/jquery-colorbox.php',
				'rel' => 'lightbox'
			),
			'Lightbox Plus' => array(
				'location' => 'lightbox-plus/lightboxplus.php',
				'settings_url' => 'themes.php?page=lightboxplus',
				'rel' => 'lightbox'
			),
			'Responsive Lightbox' => array(
				'location' => 'responsive-lightbox/responsive-lightbox.php',
				'settings_url' => 'options-general.php?page=responsive-lightbox',
				'rel' => 'lightbox'
			),
			'Simple Lightbox' => array(
				'location' => 'simple-lightbox/main.php',
				'settings_url' => 'themes.php?page=slb_options',
				'rel' => 'lightbox',
				'attributes' => array(
					'data-slb-group' => '$slider_id',
					'data-slb-active' => '1',
					'data-slb-internal' => '0',
					'data-slb-caption' => ':caption'
				)
			),
			'WP Colorbox' => array(
				'location' => 'wp-colorbox/main.php',
				'settings_url' => '',
				'rel' => 'lightbox',
				'attributes' => array(
					'class' => 'wp-colorbox-image cboxElement'
				)
			),
			'WP Featherlight' => array(
				'location' => 'wp-featherlight/wp-featherlight.php',
				'settings_url' => '',
				'rel' => 'lightbox',
				'body_class' => 'gallery'
			),
			'wp-jquery-lightbox' => array(
				'location' => 'wp-jquery-lightbox/wp-jquery-lightbox.php',
				'settings_url' => 'options-general.php?page=jquery-lightbox-options',
				'rel' => 'lightbox'
			),
			'WP Lightbox 2' => array(
				'location' => 'wp-lightbox-2/wp-lightbox-2.php',
				'settings_url' => 'admin.php?page=WP-Lightbox-2',
				'rel' => 'lightbox'
			),
			'WP Lightbox 2 Pro' => array(
				'location' => 'wp-lightbox-2-pro/wp-lightbox-2-pro.php',
				'settings_url' => 'admin.php?page=WP-Lightbox-2',
				'rel' => 'lightbox'
			),
			'WP Lightbox Ultimate' => array(
				'location' => 'wp-lightbox-ultimate/wp-lightbox.php',
				'settings_url' => ''
			),
			'WP Video Lightbox' => array(
				'location' => 'wp-video-lightbox/wp-video-lightbox.php',
				'settings_url' => 'options-general.php?page=wp_video_lightbox',
				'rel' => 'wp-video-lightbox'
			),
		);

		return apply_filters('metaslider_lightbox_supported_plugins', $supported_plugins_list);
	}

	/**
	 * Add classes required by the plugin, or classes used to identify the active version.
	 *
	 * @param string $attributes HTML attributes
	 * @param string $slide 	 The slide
	 * @param string $slider_id  The slide ID
	 *
	 * @return string The attributes
	 */
	public function add_attributes($attributes, $slide, $slider_id) {

		$settings = get_post_meta($slider_id, 'ml-slider_settings', true);
		$enabled = isset($settings['lightbox']) ? $settings['lightbox']: null;
		$thumbnail_id = ('attachment' === get_post_type($slide['id'])) ? $slide['id'] : get_post_thumbnail_id($slide['id']);

		if (filter_var($enabled, FILTER_VALIDATE_BOOLEAN)) {

			// Link to the full size image if nothing is set.
			if (empty($attributes['href'])) {
				$attributes['href'] = wp_get_attachment_url($thumbnail_id);
			}

			foreach ($this->supported_plugins as $name => $plugin) {
				if ($this->check_if_plugin_is_active($name, $plugin['location'])) {
					$attributes['rel'] = (isset($plugin['rel'])) ? $plugin['rel'] . "[{$slider_id}]" : '';

					// Cycle through the list of attributes
					if(isset($plugin['attributes'])) {
						foreach($plugin['attributes'] as $key => $value) {
							$attributes[$key] = ('$' === $value[0]) ?
								${ltrim($value, '$')} : $value;

							// Custom keywords to return specific info
							if (':caption' === $value) {
								$attributes[$key] = $slide['caption'];
							}
							if (':url' === $value) {
								$attributes[$key] = $attributes['href'];
							}
						}
					}
					break;
				}
			}
		}

		return $attributes;
	}

	/**
	 * Add classes required by the plugin, or classes used to identify the active version.
	 *
	 * @param string $class     Class used
	 * @param string $slider_id The current slider ID
	 * @param string $settings  MetaSlider settings
	 *
	 * @return string The class list
	 */
	public function add_classnames($class, $slider_id, $settings) {

		// Add the class for this plugin
		$class .= ' ml-slider-lightbox-'. sanitize_title($this->version);

		// The slideshow is unchecked or no ligthbox found
		$settings = get_post_meta($slider_id, 'ml-slider_settings', true);
		$enabled = isset($settings['lightbox']) ? $settings['lightbox'] : null;

		if (is_null($enabled) || 'false' == $enabled) {
			return $class . ' lightbox-disabled';
		}

		foreach ($this->supported_plugins as $name => $plugin) {
			if ($path = $this->check_if_plugin_is_active($name, $plugin['location'])) {
				$active_lightbox_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $path);
				if (isset($plugin['body_class'])) {

					// Add a class required by a specific plugin
					$class .= ' ' . $plugin['body_class'];
				}
				break;
			}
		}

		// No lightbox found
		if (!isset($active_lightbox_data['Version'])) {
			return $class . ' no-active-lightbox';
		}

		// Return the name of the active lightbox with it's version number
		return $class . ' ' . sanitize_title($active_lightbox_data['Name']  . ' ' . $active_lightbox_data['Version']);
	}

	/**
	 * This function checks whether a specific plugin is installed and active,
	 *
	 * @param string $name Specify "Plugin Name" to return details about it.
	 * @param string $path Expected path to the plugin
	 *
	 * @return string|bool Returns the plugin path or false.
	 */
	private function check_if_plugin_is_active($name, $path = '') {

		if (!function_exists('get_plugins')) include_once(ABSPATH.'wp-admin/includes/plugin.php');

		if (is_plugin_active($path)) return $path;

		// In case the directory structure has changed, look for the name too
		foreach (get_plugins() as $plugin_path => $plugin_data) {
			if ($name === $plugin_data['Name'] && is_plugin_active($plugin_path))
				return $plugin_path;

		}
		return false;
	}

	/**
	 * Display a warning on the plugins page if a dependancy
	 * is missing or a conflict might exist.
	 *
	 * @return bool
	 */
	public function check_dependencies() {

		$active_plugin_count = 0;
		$has_active_lightbox = false;

		foreach ($this->supported_plugins as $name => $plugin) {
			if ($this->check_if_plugin_is_active($name, $plugin['location'])){
				$has_active_lightbox = true;
				$active_plugin_count++;
			}
		}

		// Everything looks good
		if (1 === $active_plugin_count && $has_active_lightbox && $this->check_if_plugin_is_active('MetaSlider')) {
			return true;
		}

		// MetaSlider isn't installed or no supported lightbox found
		if (!$has_active_lightbox || !$this->check_if_plugin_is_active('MetaSlider')) {
			add_action('admin_notices', array($this, 'show_dependency_warning'), 10, 3);
			return false;
		}

		// Too many plugins
		if ($active_plugin_count > 1) {
			add_action('admin_notices', array($this, 'show_multiple_lightbox_warning'), 10, 3);
			return false;
		}
	}

	/**
	 * The warning message that is displayed if MetaSlider or Simple lightbox isn't activated
	 */
	public function show_dependency_warning() {
		?>
		<div class='metaslider-admin-notice notice notice-error is-dismissible'>
			<p><?php _e('MetaSlider Lightbox requires MetaSlider and at least one other supported lightbox plugin to be installed and activated.', 'ml-slider-lightbox'); ?> <a href='https://wordpress.org/plugins/ml-slider-lightbox#description-header' target='_blank'><?php _e('More info', 'ml-slider-lightbox'); ?></a></p>
		</div>
		<?php
	}

	/**
	 * The warning message that is displayed if more than one lightbox is activated
	 */
	public function show_multiple_lightbox_warning() {
		?>
		<div class='metaslider-admin-notice error'>
			<p><?php _e('There is more than one lightbox plugin activated. This may cause conflicts with MetaSlider Lightbox', 'ml-slider-lightbox'); ?></p>
		</div>
		<?php
	}

	/**
	 * Add a checkbox to enable the lightbox on the slider.
	 * Also links to the settings page
	 *
	 * @param array $aFields A list of advanced fields
	 * @param array $slider  The current slideshow ID
	 * @return array
	 */
	public function add_settings($aFields = array(), $slider = array()) {

		if (!function_exists('is_plugin_active')) {
			require_once(ABSPATH . '/wp-admin/includes/plugin.php');
		}

		foreach ($this->supported_plugins as $name => $plugin) {
			if ($path = $this->check_if_plugin_is_active($name, $plugin['location'])) {
				$active_lightbox_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $path);
				$lightbox_settings_url = $plugin['settings_url'];
				break;
			}
		}

		if (!isset($active_lightbox_data['Version'])) {
			return array_merge($aFields, array(
				'lightbox' => array(
					'priority' => 165,
					'type' => 'divider',
					'class' => 'warning',
					'value' => sprintf("%s <a href='https://wordpress.org/plugins/ml-slider-lightbox#description-header' target='_blank'>%s</a>", __("Warning: MetaSlider Lightbox is installed but no supported lightbox plugin is active.", "ml-slider"), __("More info", "ml-slider-lightbox"))
				)
			));
		}

		if (isset($slider->id)) {
			$settings = get_post_meta($slider->id, 'ml-slider_settings', true);
			$enabled = isset($settings['lightbox']) ? $settings['lightbox']: null;
			$link = !empty($lightbox_settings_url) ? sprintf("<br><a href='%s' target='_blank'>%s</a>", admin_url($lightbox_settings_url), __("Edit settings", "ml-slider-lightbox")) : '';

			$msl_lightbox = array(
				'lightbox' => array(
					'priority' => 165,
					'type' => 'checkbox',
					'label' => __('Open in lightbox?', 'ml-slider-lightbox') . $link,
					'class' => 'coin flex responsive nivo',
					'checked' => ('true' === $enabled) ? 'checked' : '',
					'helptext' => sprintf(_x("All slides will open in a lightbox, using %s", "Name of a plugin", "ml-slider-lightbox"), $active_lightbox_data['Name'])
				),
			);
			$aFields = array_merge($aFields, $msl_lightbox);
		}
		return $aFields;
	}

	/**
	 * Converting lightbox checkbox value (on/off) to true or false.
	 *
	 * @param array $checkboxes Array of checkboxes
	 * @return array
	 */
	public function convert_checkboxes($checkboxes) {
		array_push($checkboxes, 'lightbox');
		return $checkboxes;
	}

	/**
	 * Plugin dependancy check action
	 */
	public function setup_admin_actions() {
		add_action('admin_init', array($this, 'check_dependencies'), 10, 3);
	}
}
