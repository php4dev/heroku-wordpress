<?php

if (!defined('ABSPATH')) die('No direct access.');

/**
 * Generic Slider super class. Extended by library specific classes.
 *
 * This class handles all slider related functionality, including saving settings and outputting
 * the slider HTML (front end and back end)
 */
class MetaSlider {

    public $id = 0; // slider ID
    public $identifier = 0; // unique identifier
    public $slides = array(); // slides belonging to this slider
    public $settings = array(); // slider settings

    /**
     * Constructor
     *
     * @param int   $id                 Slider ID
     * @param array $shortcode_settings Short code settings
     */
    public function __construct( $id, $shortcode_settings ) {
        $this->id = $id;
        $this->settings = array_merge( $shortcode_settings, $this->get_settings() );
        $this->identifier = 'metaslider_' . $this->id;
		$this->populate_slides();
    }

    /**
     * Return the unique identifier for the slider (used to avoid javascript conflicts)
     *
     * @return string unique identifier for slider
     */
    protected function get_identifier() {
        return $this->identifier;
    }

    /**
     * Get settings for the current slider
     *
     * @return array slider settings
     */
    private function get_settings() {
        $settings = get_post_meta( $this->id, 'ml-slider_settings', true );

        if ( is_array( $settings ) &&
            isset( $settings['type'] ) &&
            in_array( $settings['type'], array( 'flex', 'coin', 'nivo', 'responsive' ) ) ) {
            return $settings;
        } else {
            return $this->get_default_parameters();
        }
    }

    /**
     * Return an individual setting
     *
     * @param string $name Name of the setting
     * @return string setting value or 'false'
     */
    public function get_setting( $name ) {
        if ( !isset( $this->settings[$name] ) ) {
            $defaults = $this->get_default_parameters();

            if ( isset( $defaults[$name] ) ) {
                return $defaults[$name] ? $defaults[$name] : 'false';
            }
        } else {
            if ( strlen( $this->settings[$name] ) > 0 ) {
                return $this->settings[$name];
            }
        }

        return 'false';
    }

	/**
	 * Get the slider libary parameters, this lists all possible parameters and their
	 * default values. Slider subclasses override this and disable/rename parameters
	 * appropriately.
	 *
	 * @return string javascript options
	 */
	public function get_default_parameters() {
		$params = array(
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
			'theme' => 'default',
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
		return apply_filters('metaslider_default_parameters', $params);
	}

    /**
     * The main query for extracting the slides for the slideshow
     *
     * @return WP_Query
     */
    public function get_slides() {
		$slideshow_id = $this->id;
		$slideshow_settings = $this->settings;
        $args = array(
            'force_no_custom_order' => true,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post_type' => array('attachment', 'ml-slide'),
            'post_status' => array('inherit', 'publish'),
            'lang' => '', // polylang, ingore language filter
            'suppress_filters' => 1, // wpml, ignore language filter
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'ml-slider',
                    'field' => 'slug',
                    'terms' => $slideshow_id
                )
            )
        );

        // If there is a var set to include the trashed slides, then include it
        if (metaslider_viewing_trashed_slides($slideshow_id)) {
            $args['post_status'] = array('trash');
        }

		// Filter to update the args before the query is built
		$args = apply_filters('metaslider_populate_slides_args', $args, $slideshow_id, $slideshow_settings);

		$the_query = new WP_Query($args);
		
		// Filter to alter the query itself if needed
		return apply_filters('metaslider_get_slides_query', $the_query, $slideshow_id, $slideshow_settings);
    }

    /**
     * Return slides for the current slider
     *
     * @return array collection of slides belonging to the current slider
     */
    private function populate_slides() {
        $slides = array();
		$slideshow_id = $this->id;

		// Filter to alter the slides query before they are "built"
        $query = apply_filters('metaslider_populate_slides_query', $this->get_slides(), $slideshow_id);

        while ($query->have_posts()) {
			$query->next_post();
			$slide_id = $query->post->ID;

            $type = get_post_meta($slide_id, 'ml-slider_type', true);
            $type = $type ? $type : 'image'; // backwards compatibility, fall back to 'image'

            // Skip over deleted media files
            if ('image' === $type && 'ml-slide' === get_post_type($slide_id) && !get_post_thumbnail_id($slide_id)) {
                continue;
            }

			// As far as I can tell this filter is the "meat" of this plugin, so this check should always pass
			// for image slides, but handles showing only pro slides when the filter is available
            if (has_filter("metaslider_get_{$type}_slide")) {

				// Note: Extra $slide_id parameter added v3.10.0 as this filter is useless without it.
				$slide = apply_filters("metaslider_get_{$type}_slide", $slide_id, $slideshow_id, $slide_id);

				// The filter above can handle an array or a string, but it should be an array after this
				$slides = array_merge($slides, (array) $slide);
            }
        }

        // Shuffle slides as needed
        if (!is_admin() && filter_var($this->get_setting('random'), FILTER_VALIDATE_BOOLEAN)) {
            shuffle($slides);
        }

		// Last chance to add/remove/manipulate slide output (Added 3.10.0)
        $this->slides = apply_filters("metaslider_filter_available_slides", $slides, $slideshow_id);

        return $this->slides;
    }

    /**
     * Render each slide belonging to the slider out to the screen
     */
    public function render_admin_slides() {
        foreach ( $this->slides as $slide ) {
            echo $slide;
        }
    }

    /**
     * Output the HTML and Javascript for this slider
     *
     * @return string HTML & Javascrpt
     */
    public function render_public_slides() {
        $html[] = '<div id="metaslider-id-' . $this->id . '" style="' . $this->get_container_style() . '" class="' . esc_attr($this->get_container_class()) .'">';
        $html[] = '    <div id="' . $this->get_container_id() . '">';
        $html[] = '        ' . $this->get_html();
        $html[] = '        ' . $this->get_html_after();
        $html[] = '    </div>';
        $html[] = '</div>';

        $slideshow = implode( "\n", $html );

        $slideshow = apply_filters( 'metaslider_slideshow_output', $slideshow, $this->id, $this->settings );

        return $slideshow;
    }

    /**
     * Return the ID to use for the container
     */
    private function get_container_id() {
        $container_id = 'metaslider_container_' . $this->id;

        $id = apply_filters( 'metaslider_container_id', $container_id, $this->id, $this->settings );

        return $id;
    }

    /**
     * Return the classes to use for the slidehsow container
     */
    private function get_container_class() {

        // Add the version to the class name (if possible)
        $version_string = str_replace('.', '-', urlencode(METASLIDER_VERSION));
        $version_string .= defined('METASLIDERPRO_VERSION') ? ' ml-slider-pro-' . str_replace('.', '-', urlencode(METASLIDERPRO_VERSION)) : '';
        $class = "ml-slider-{$version_string} metaslider metaslider-{$this->get_setting('type')} metaslider-{$this->id} ml-slider";

        // apply the css class setting
        if ('false' != $this->get_setting('cssClass')) {
            $class .= " " . $this->get_setting('cssClass');
        }
        // when passed in the shortcode, the attribute names are lowercased.
        if ('false' != $this->get_setting('cssclass')) {
            $class .= " " . $this->get_setting('cssclass');
        }        

        // handle any custom classes
        $class = apply_filters('metaslider_css_classes', $class, $this->id, $this->settings);
        return $class;
    }

    /**
     * Return the inline CSS style for the slideshow container.
     */
    private function get_container_style() {
        // default
        $style = "max-width: {$this->get_setting( 'width' )}px;";

        // carousels are always 100% wide
        if ( $this->get_setting( 'carouselMode' ) == 'true' || ( $this->get_setting( 'fullWidth' ) == 'true' ) && $this->get_setting( 'type' ) != 'coin' ) {
            $style = "width: 100%;";
        }

        // percentWidth showcode parameter takes precedence
        if ( $this->get_setting( 'percentwidth' ) != 'false' && $this->get_setting( 'percentwidth' ) > 0 ) {
            $style = "width: {$this->get_setting( 'percentwidth' )}%;";
        }

        // center align the slideshow
        if ( $this->get_setting( 'center' ) != 'false' ) {
            $style .= " margin: 0 auto;";
        }

        // handle any custom container styles
        $style = apply_filters( 'metaslider_container_style', $style, $this->id, $this->settings );

        return $style;
    }

    /**
     * Return the Javascript to kick off the slider. Code is wrapped in a timer
     * to allow for themes that load jQuery at the bottom of the page.
     *
     * Delay execution of slider code until jQuery is ready (supports themes where
     * jQuery is loaded at the bottom of the page)
     *
     * @return string javascript
     */
    private function get_inline_javascript() {
        $custom_js_before = $this->get_custom_javascript_before();
        $custom_js_after = $this->get_custom_javascript_after();

        $identifier = $this->get_identifier();

        $script = "var " . $identifier . " = function($) {";
        $script .= $custom_js_before;
        $script .= "\n            $('#" . $identifier . "')." . $this->js_function . "({ ";
        $script .= "\n                " . $this->get_javascript_parameters();
        $script .= "\n            });";
        $script .= $custom_js_after;
        $script .= "\n            $(document).trigger('metaslider/initialized', '#$identifier');";
        $script .= "\n        };";

        $timer = "\n        var timer_" . $identifier . " = function() {";
        // this would be the sensible way to do it, but WordPress sometimes converts && to &#038;&
        // window.jQuery && jQuery.isReady ? {$identifier}(window.jQuery) : window.setTimeout(timer_{$identifier}, 1);";
        $timer .= "\n            var slider = !window.jQuery ? window.setTimeout(timer_{$this->identifier}, 100) : !jQuery.isReady ? window.setTimeout(timer_{$this->identifier}, 1) : {$this->identifier}(window.jQuery);";
        $timer .= "\n        };";
        $timer .= "\n        timer_" . $identifier . "();";

        $init = apply_filters("metaslider_timer", $timer, $this->identifier);

        return $script . $init;
    }

    /**
     * Custom HTML to add immediately below the markup
     */
    private function get_html_after() {
        $type = $this->get_setting( 'type' );

        $html = apply_filters( "metaslider_{$type}_slider_html_after", "", $this->id, $this->settings );

        if ( strlen( $html ) ) {
            return "        {$html}";
        }

        return "";
    }

    /**
     * Custom JavaScript to execute immediately before the slideshow is initialized
     */
    private function get_custom_javascript_before() {
        $type = $this->get_setting('type');
        $javascript = "";

		// theme/plugin conflict avoidance 
        if ('true' === $this->get_setting('noConflict') && 'flex' === $type) {
            $javascript = "$('#metaslider_{$this->id}').addClass('flexslider');";
        }

        $custom_js = apply_filters("metaslider_{$type}_slider_javascript_before", $javascript, $this->id);
		$custom_js .= apply_filters("metaslider_slider_javascript", "", $this->id, $this->identifier);

        return $custom_js;
    }

    /**
     * Custom Javascript to execute immediately after the slideshow is initialized
	 * 
	 * @return string
     */
    private function get_custom_javascript_after() {
        $type = $this->get_setting('type');
		$custom_js = apply_filters("metaslider_{$type}_slider_javascript", "", $this->id);
        $custom_js .= apply_filters("metaslider_slider_javascript", "", $this->id, $this->identifier);
        return $custom_js;
    }

    /**
     * Build the javascript parameter arguments for the slider.
     *
     * @return string parameters
     */
    private function get_javascript_parameters() {
        $options = array();

        // construct an array of all parameters
        foreach ( $this->get_default_parameters() as $name => $default ) {
            if ( $param = $this->get_param( $name ) ) {
                $val = $this->get_setting( $name );

                if ( gettype( $default ) == 'integer' || $val == 'true' || $val == 'false' ) {
                    $options[$param] = $val;
                } else {
                    $options[$param] = '"' . esc_js($val) . '"';
                }
            }
        }

        // deal with any customised parameters
        $type = $this->get_setting( 'type' );
        $options = apply_filters( "metaslider_{$type}_slider_parameters", $options, $this->id, $this->settings );
        $arg = $type == 'flex' ? 'slider' : '';

        // create key:value strings
        foreach ( $options as $key => $value ) {
            if ( is_array( $value ) ) {
                $pairs[] = "{$key}: function($arg) {\n                "
                    . implode( "\n                ", $value )
                    . "\n                }";
            } else {
                $pairs[] = "{$key}:{$value}";
            }
        }

        return implode( ",\n                ", $pairs );
    }

    /**
     * Polyfill to handle the wp_add_inline_script() function.
     *
     * @param  string $handle   [description]
     * @param  array  $data     [description]
     * @param  string $position [description]
     * @return array
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

	/**
	 * Include slider assets, JS and CSS paths are specified by child classes.
	 */
	public function enqueue_scripts() {
		if (filter_var($this->get_setting('printJs'), FILTER_VALIDATE_BOOLEAN)) {
			$handle = 'metaslider-' . $this->get_setting('type') . '-slider';
			wp_enqueue_script($handle, METASLIDER_ASSETS_URL . $this->js_path, array('jquery'), METASLIDER_VERSION);
			$this->wp_add_inline_script($handle, $this->get_inline_javascript());
		}

		if (filter_var($this->get_setting('printCss'), FILTER_VALIDATE_BOOLEAN)) {
			wp_enqueue_style('metaslider-' . $this->get_setting('type') . '-slider', METASLIDER_ASSETS_URL . $this->css_path, false, METASLIDER_VERSION);
			wp_enqueue_style('metaslider-public', METASLIDER_ASSETS_URL . 'metaslider/public.css', false, METASLIDER_VERSION);

			$extra_css = apply_filters("metaslider_css", "", $this->settings, $this->id);
			wp_add_inline_style('metaslider-public', $extra_css);
		}
		do_action('metaslider_register_public_styles');
	}

}
