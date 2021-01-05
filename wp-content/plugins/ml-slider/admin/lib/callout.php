<?php

if (!defined('ABSPATH')) { die('No direct access.'); }

/**
 * TODO: combine this with custom tours that can introduce a new feature
 * Use this file to add a pointer notice that will only show once.
 * Typically you will just want to edit these three variables (the image will default to the MetaSlider logo)
 */

$metaslider_callout_name = 'toolbar';
$nonce = wp_create_nonce('metaslider_request');
$tour_reset = "event.preventDefault();var link = window.jQuery(this);window.jQuery.post(ajaxurl, {action: \'set_tour_status\',current_step: \'0\',\'METASLIDER_NONCE\':\'{$nonce}\'}, function(data){window.location = link.attr(\'href\');});";

$metaslider_callout_text = sprintf(__('A new look! With our new toolbar, it is much easier to duplicate your slideshows. Pro users can now add custom CSS. Need a reminder how MetaSlider works? <a href="%s" onclick="%s">Take the tour</a>', 'ml-slider'), self_admin_url('admin.php?page=metaslider'), esc_attr($tour_reset));

$metaslider_callout_image = '';

/**
 * Also allow users to hide indefinitely
 */
if (defined('METASLIDER_HIDE_CALLOUT') && METASLIDER_HIDE_CALLOUT) return;

new MetaSlider_Callout($metaslider_callout_name, $metaslider_callout_text, $metaslider_callout_image);

/**
 * Class to handle a callout
 */
class MetaSlider_Callout {

	/**
	 * The notice key
	 *
	 * @var string
	 */
	protected $key;

	/**
	 * The notice text
	 *
	 * @var string
	 */
	protected $text;

	/**
	 * The image html
	 *
	 * @var string
	 */
	protected $image;

	/**
	 * The page to show it on
	 * get_current_screen()->id
	 *
	 * @var string
	 */
	protected $page;

	/**
	 * Constructor
	 *
	 * @param string 	  $key   The key of the callout (should be unique)
	 * @param string 	  $text  The text of the callout
	 * @param string|null $image The html of the image
	 * @param string 	  $page  The page to show the callout
	 */
	public function __construct($key, $text, $image = null, $page = 'plugins') {

		$this->key = $key;
		$this->text = $text;
		$this->page = $page;

		// Default to the MetaSlider logo
		$this->image = $image ? $image : "<img width=\"50\" height=\"50\" src=\"" . METASLIDER_ADMIN_URL . "/images/metaslider_logo_large.png\" alt=\"MetaSlider\">";

		// Load the scripts and initialize
		add_action('admin_enqueue_scripts', array($this, 'setup_callout'));
	}

	/**
	 * Method to load in call out scripts
	 */
	public function setup_callout() {

		// Only show to users who can access MetaSlider
		$capability = apply_filters('metaslider_capability', 'edit_others_posts');
		if (!current_user_can($capability)) return;

        // Only show on the specified page
		if ($this->page !== get_current_screen()->id) return;

		// Only show once
		if ((bool) get_user_option('metaslider_user_saw_callout_' . $this->key)) return;
		update_user_option(get_current_user_id(), 'metaslider_user_saw_callout_' . $this->key, true);

		// Add all the necessary scripts and styles
		wp_enqueue_script('metaslider-tether-js-callout', METASLIDER_ADMIN_URL . 'assets/tether/dist/js/tether.min.js', METASLIDER_VERSION, true);
		wp_enqueue_script('metaslider-shepherd-js-callout', METASLIDER_ADMIN_URL . 'assets/tether-shepherd/dist/js/shepherd.min.js', array('metaslider-tether-js-callout'), METASLIDER_VERSION, true);
		$this->wp_add_inline_script('metaslider-shepherd-js-callout', "
			try {
				window.jQuery(function($) {
					var ms_callout_tour = new Shepherd.Tour();
					ms_callout_tour.options.defaults = {
						classes: 'shepherd-theme-arrows metaslider-callout-tip',
						showCancelLink: true,
						tetherOptions: {
							offset: '0 5px'
						}
					};
					ms_callout_tour.addStep('welcome', {
						title: 'Check out what\'s new!',
						text: '<div class=\"metaslider-callout-image\">{$this->image}</div><div>{$this->text}</div>',
						attachTo: 'li#toplevel_page_metaslider right',
						buttons: []
					});
					ms_callout_tour.start();
				});
			} catch (e) {
				console.log('MetaSlider: There was an error with the callout');
			}
		");

		wp_enqueue_style('metaslider-shepherd-css-callout', METASLIDER_ADMIN_URL . 'assets/tether-shepherd/dist/css/shepherd-theme-arrows.css', false, METASLIDER_VERSION);
		wp_add_inline_style('metaslider-shepherd-css-callout', "
			.metaslider-callout-tip {
				z-index: 999999;
				min-width: 300px;
			}
			.metaslider-callout-tip .shepherd-content {
				border-radius: 3px!important;
				filter: none!important;
				box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15), 0px 10px 40px rgba(0, 0, 0, 0.15);
			}
			.metaslider-callout-tip header {
				background-color: #DD6823!important;
				border-radius: 3px 3px 0 0!important;
			}
			.metaslider-callout-tip header h3 {
				color: white;
				font-size: 1.1em;
			}
			.metaslider-callout-tip .shepherd-text {
				min-height: 100px;
				max-width: 400px;
				display: flex;
				align-items: center;
			}
			.metaslider-callout-tip .shepherd-text > p {
				display: none;
			}
			.metaslider-callout-tip .shepherd-text > div {
				flex: 1;
			}
			.metaslider-callout-image {
				display: flex;
				justify-content: center;
				align-items: center;
				max-width: 66px;
				margin-right: 0.5rem;
			}
			.shepherd-element.shepherd-theme-arrows.shepherd-has-title .shepherd-content header a.shepherd-cancel-link {
				opacity: 0.7;
				color: rgba(255, 255, 255, 0);
				font-size: 0.8em;
				border: 1px solid #FFF;
				border-radius: 50%;
				width: 22px;
				height: 22px;
				line-height: 20px;
				padding: 0;
				text-align: center;
				float: none;
				position: absolute;
				right: 11px;
				top: 12px;
			}
			.shepherd-element.shepherd-theme-arrows.shepherd-has-title .shepherd-content header a.shepherd-cancel-link::before {
				color: #FFF;
				content: '" . __('Close', 'As in to close a modal window', 'ml-slider') . "';
				position: absolute;
				right: 20px;
				padding-right: 10px;
			}
			.shepherd-element.shepherd-theme-arrows.shepherd-has-title .shepherd-content header a.shepherd-cancel-link::after {
				content: '" . esc_html('\f335') . "';
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
				font-family: dashicons;
				color: #FFF;
				position: absolute;
				left: 2px;
				line-height: 21px;
				font-size: 16px;
			}
		");
	}

	/**
     * Polyfill to handle the wp_add_inline_script() function.
     *
     * @param  string $handle   The script identifier
     * @param  string $data     The script to add, without <script> tags
     * @param  string $position Whether to output before or after
	 *
     * @return object|bool
     */
    public function wp_add_inline_script($handle, $data, $position = 'after') {
        if (function_exists('wp_add_inline_script')) return wp_add_inline_script($handle, $data, $position);
        global $wp_scripts;
        if (!$data) return false;

        // First fetch any existing scripts
        $script = $wp_scripts->get_data($handle, 'data');

        // Append to the end
        $script .= $data;

        return $wp_scripts->add_data($handle, 'data', $script);
    }
}
