<?php
if (!defined('ABSPATH')) {
    die('No direct access.');
}

/**
 * Adds a MetaSlider block to Gutenberg
 */
class MetaSlider_Gutenberg
{

    /**
     * Init
     */
    public function __construct()
    {
        add_action('enqueue_block_editor_assets', array($this,'enqueue_block_scripts'));
        if (isset($_REQUEST['override_preview_style']) && filter_var($_REQUEST['override_preview_style'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
            add_filter('metaslider_preview_styles', array($this, 'preview_styles'));
        }
    }

    /**
     * Enqueues gutenberg scripts
     */
    public function enqueue_block_scripts()
    {
        $version = MetaSliderPlugin::get_instance()->version;

        // Enqueue the bundled block JS file
        wp_enqueue_script(
            'metaslider-blocks',
            plugins_url('assets/dist/js/editor-block.js', __FILE__),
            array('wp-i18n', 'wp-element', 'wp-block-library', 'wp-components', 'wp-api'),
            $version
        );

        wp_localize_script('metaslider-blocks', 'metaslider_block_config', array(
            'preview_url' => add_query_arg('ms_gutenberg_preview', 1, set_url_scheme(home_url())),
            'plugin_page' => admin_url('admin.php?page=metaslider')
        ));

        /*
         * gutenberg_get_jed_locale_data uses WP function get_translations_for_domain,
         * which can be usefull if we want to use wp.18n.__ in the rest of the plugin.
         */
        $locale_data = $this->gutenberg_get_jed_locale_data('ml-slider');
        wp_add_inline_script(
            'metaslider-blocks',
            'wp.i18n.setLocaleData(' . json_encode($locale_data) . ', \'ml-slider\');',
            'before'
        );

        // Enqueue optional editor only styles
        wp_enqueue_style(
            'metaslider-blocks-editor-css',
            plugins_url('assets/dist/css/editor-block.css', __FILE__),
            array('wp-block-library'),
            $version
        );
    }

    /**
     * Preview styles
     *
     * @param string $styles The preview styles
     * @return string
     */
    public function preview_styles($styles)
    {
        ob_start(); ?>
		body, html {
			overflow: hidden;
			height: auto;
			margin:0;
			padding:0;
			box-sizing: border-box;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
			font-size: 14px;
		}
		.metaslider {
			margin: 0 auto;
		}
		<?php
        return ob_get_clean();
    }

    /**
     * Backup function for Gutenberg's gutenberg_get_jed_locale_data
     *
     * @param string $domain - The text domain for the strings
     */
    private function gutenberg_get_jed_locale_data($domain)
    {
        if (function_exists('gutenberg_get_jed_locale_data')) {
            return gutenberg_get_jed_locale_data($domain);
        }

        $translations = get_translations_for_domain($domain);
        $locale = array(
            '' => array(
                'domain' => $domain,
                'lang' => is_admin() && function_exists('get_user_locale') ? get_user_locale() : get_locale(),
            ),
        );

        if (!empty($translations->headers['Plural-Forms'])) {
            $locale['']['plural_forms'] = $translations->headers['Plural-Forms'];
        }

        foreach ($translations->entries as $msgid => $entry) {
            $locale[$msgid] = $entry->translations;
        }
        return $locale;
    }
}
