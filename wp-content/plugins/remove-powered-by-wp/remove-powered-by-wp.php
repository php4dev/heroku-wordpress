<?php
/*
 * Plugin Name: Remove "Powered by Wordpress"
 * Version: 1.3.5
 * Plugin URI: https://webd.uk/product/remove-powered-by-wp-donation/
 * Description: Removes the Wordpress credit on the default Wordpress theme and inserts a widget area
 * Author: Webd Ltd
 * Author URI: https://webd.uk
 * Text Domain: remove-powered-by-wp
 */



if (!class_exists('remove_powered_by_wp_class')) {

	class remove_powered_by_wp_class {

        public static $version = '1.3.5';

        public static $rpbw_compatible_themes = array(
            'Twenty Ten' => 'twentyten',
            'Twenty Eleven' => 'twentyeleven', 
            'Twenty Twelve' => 'twentytwelve', 
            'Twenty Thirteen' => 'twentythirteen', 
            'Twenty Fourteen' => 'twentyfourteen', 
            'Twenty Fifteen' => 'twentyfifteen', 
            'Twenty Sixteen' => 'twentysixteen',
            'Twenty Seventeen' => 'twentyseventeen',
            'Twenty Nineteen' => 'twentynineteen',
            'Twenty Twenty' => 'twentytwenty',
            'Twenty Twenty One' => 'twentytwentyone'
        );

		function __construct() {

        	register_activation_hook(__FILE__, array($this, 'rpbw_activation'));
            add_action('customize_register', array($this, 'rpbw_customize_register'));
            add_action('wp_head' , array($this, 'rpbw_header_output'));

            if (get_template() != 'twentynineteen' && get_template() != 'twentytwenty' && get_template() != 'twentytwentyone') {

                add_action('widgets_init', array($this, 'rpbw_site_info_sidebar_init'));

		    }

            if (is_admin()) {

                add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'rpbw_add_plugin_action_links'));
                add_action('admin_notices', 'rpbwCommon::admin_notices');
                add_action('wp_ajax_dismiss_rpbw_notice_handler', 'rpbwCommon::ajax_notice_handler');
                add_action('rpbw_admin_notice_donate', array($this, 'rpbw_admin_notice_upsell'));

            }

		}

		function rpbw_add_plugin_action_links($links) {

			$settings_links = rpbwCommon::plugin_action_links(add_query_arg('autofocus[section]', (get_template() == 'twentytwenty' ? 'options' : 'theme_options'), admin_url('customize.php')));

			return array_merge($settings_links, $links);

		}

        public static function rpbw_compatible_theme_installed() {

            $installed_themes = wp_get_themes();

            foreach (self::$rpbw_compatible_themes as $key => $value) {

                if (isset($installed_themes[$value]) && $installed_themes[$value]) {

                    return true;
                    break;

                }

            }

            return false;

        }

        function rpbw_customize_register($wp_customize) {

            foreach (array(
                'Twenty Seventeen' => 'twentyseventeen',
                'Twenty Nineteen' => 'twentynineteen',
                'Twenty Twenty' => 'twentytwenty',
                'Twenty Twenty One' => 'twentytwentyone'
            ) as $key => $value) {

                if (get_template() == $value && !class_exists('options_for_' . str_replace(' ', '_', strtolower($key)) . '_class')) {

                    $wp_customize->add_section('more_theme_options', array(
                        'title'     => __('More Theme Options', 'remove-powered-by-wp'),
                        'description'  => sprintf(__('Would you like even more options and features for your theme %s?', 'remove-powered-by-wp'), $key),
                        'priority'     => 0
                    ));

                    rpbwCommon::add_hidden_control($wp_customize, 'install_' . $value, 'more_theme_options', __('Options for ' . $key), 
                    
                    sprintf(wp_kses(__('<a href="%s" class="button">Install Options for %s Plugin</a>', 'remove-powered-by-wp'), array('a' => array('href' => array(), 'class' => array()))), esc_url(add_query_arg(array(
                            's' => $value . ' please our modification',
                            'tab' => 'search',
                            'type' => 'term'
                        ), admin_url('plugin-install.php'))), $key));

                }

            }

            if (get_template() != 'twentyseventeen' & get_template() != 'twentytwenty') {

                $wp_customize->add_section('theme_options', array(
                    'title'    => __('Theme Options', 'remove-powered-by-wp'),
                    'priority' => 130
                ));

            }

            $wp_customize->add_setting('remove_powered_by_wordpress', array(
                'default'       => false,
                'type'          => 'theme_mod',
                'transport'     => 'refresh',
                'sanitize_callback' => 'rpbwCommon::sanitize_boolean'
            ));

            if (get_template() == 'twentynineteen' || get_template() == 'twentytwentyone') {

                $description = __('Removes the "Proudly powered by WordPress" text displayed in the website footer.', 'remove-powered-by-wp');

            } elseif (get_template() == 'twentytwenty') {

                $description = __('Removes the "Powered by WordPress" text displayed in the website footer.', 'remove-powered-by-wp');

            } else {

                $description = __('Removes the "Proudly powered by WordPress" text displayed in the website footer and replaces with the content of the "Site Info" widget area.', 'remove-powered-by-wp');

            }

            $wp_customize->add_control('remove_powered_by_wordpress', array(
                'label'         => __('Remove Powered by WordPress', 'remove-powered-by-wp'),
                'description'   => $description,
                'section'       => (get_template() == 'twentytwenty' ? 'options' : 'theme_options'),
                'settings'      => 'remove_powered_by_wordpress',
                'type'          => 'checkbox'
            ));

        }

        function rpbw_header_output() {

?>
<!--Customizer CSS--> 
<style type="text/css">
<?php

            if (get_theme_mod('remove_powered_by_wordpress')) {

                switch (get_template()) {

                    case 'twentyten':

                        add_action('twentyten_credits', array($this, 'rpbw_get_site_info_sidebar'));
                        rpbwCommon::generate_css('#footer #site-generator>a', 'display', 'remove_powered_by_wordpress', '', '', 'none');

?>
#site-generator a {
    background-image: none;
    display: inline;
    padding-left: 0;
}
#site-generator p {
    margin: 0;
}
<?php

                        break;

                    case 'twentyeleven':

                        add_action('twentyeleven_credits', array($this, 'rpbw_get_site_info_sidebar'));

?>
#site-generator>span {
    display: none;
}
#site-generator>a:last-child {
    display: none;
}
#site-generator p {
    margin: 0;
}
<?php

                        break;

                    case 'twentytwelve':

                        add_action('twentytwelve_credits', array($this, 'rpbw_get_site_info_sidebar'));

?>
.site-info>span {
    display: none;
}
.site-info>a:last-child {
    display: none;
}
<?php

                        break;

                    case 'twentythirteen':

                        add_action('twentythirteen_credits', array($this, 'rpbw_get_site_info_sidebar'));

?>
.site-info>span {
    display: none;
}
.site-info>a:last-child {
    display: none;
}
.site-info p {
    margin: 0;
}
<?php

                        break;

                    case 'twentyfourteen':

                        add_action('twentyfourteen_credits', array($this, 'rpbw_get_site_info_sidebar'));

?>
.site-info>span {
    display: none;
}
.site-info>a:last-child {
    display: none;
}
.site-info p {
    margin: 0;
}
<?php

                        break;

                    case 'twentyfifteen':
                        add_action('twentyfifteen_credits', array($this, 'rpbw_get_site_info_sidebar'));
?>
.site-info>span {
    display: none;
}
.site-info>a:last-child {
    display: none;
}
<?php

                        break;

                    case 'twentysixteen':

                        add_action('twentysixteen_credits', array($this, 'rpbw_get_site_info_sidebar'));

?>
.site-footer span[role=separator] {
    display: none;
}
.site-info>a:last-child {
    display: none;
}
.site-footer .site-title:after {
    display: none;
}
<?php

                        break;

                    case 'twentyseventeen':

                        add_action('get_template_part_template-parts/footer/site', array($this, 'rpbw_get_site_info_sidebar'));

?>
.site-info:last-child a:last-child {
    display: none;
}
.site-info:last-child span {
    display: none;
}
.site-info p {
    margin: 0;
}
<?php

                        break;

                    case 'twentynineteen':

                        add_action('wp_footer', array($this, 'rpbw_remove_site_info_comma'));

?>
.site-info>.imprint {
    display: none;
}
.site-name {
    margin-right: 1rem;
}
<?php

                        break;

                    case 'twentytwenty':

?>
.powered-by-wordpress {
    display: none;
}
<?php

                        break;

                    case 'twentytwentyone':

?>
.powered-by {
    display: none;
}
<?php

                        break;

                }

            }

?>
</style> 
<!--/Customizer CSS-->
<?php

        }

        function rpbw_site_info_sidebar_init() {

        	register_sidebar( array(
        		'name'          => __('Site Info', 'remove-powered-by-wp'),
        		'id'            => 'site-info',
        		'description'   => __('Add widgets here to appear in your footer site info.', 'remove-powered-by-wp'),
		        'before_widget' => '',
        		'after_widget'  => '',
        		'before_title'  => '<h2 class="widget-title">',
        		'after_title'   => '</h2>',
        	) );

        }

        function rpbw_get_site_info_sidebar() {

            if (is_active_sidebar('site-info')) {

                switch (get_template()) {

                    case 'twentyten':
                        dynamic_sidebar('site-info');
                        break;

                    case 'twentyeleven':
                        dynamic_sidebar('site-info');
                        break;

                    case 'twentytwelve':
                        dynamic_sidebar('site-info');
                        break;

                    case 'twentythirteen':
                        dynamic_sidebar('site-info');
                        break;

                    case 'twentyfourteen':
                        dynamic_sidebar('site-info');
                        break;

                    case 'twentyfifteen':
                        dynamic_sidebar('site-info');
                        break;

                    case 'twentysixteen':
                        dynamic_sidebar('site-info');
                        break;

                    case 'twentyseventeen':
                        echo('<div class="site-info">');
                        dynamic_sidebar('site-info');
                        echo('</div>');
                        break;

                }

            }

        }

        function rpbw_remove_site_info_comma() {

?>
<script type="text/javascript">
    (function() {
        document.getElementsByClassName('site-info')[0].innerHTML = document.getElementsByClassName('site-info')[0].innerHTML.split('</a>,\n\t\t\t\t\t\t').join('</a>');
    })();
</script>
<?php

        }

        function rpbw_activation() {

            set_theme_mod('remove_powered_by_wordpress', true);

        }

        function rpbw_admin_notice_upsell() {

            foreach (array(
                'Twenty Seventeen' => 'twentyseventeen',
                'Twenty Nineteen' => 'twentynineteen',
                'Twenty Twenty' => 'twentytwenty',
                'Twenty Twenty One' => 'twentytwentyone'
            ) as $key => $value) {

                if (get_template() == $value) {

                    echo '<p>';
                    printf(
                        __('You are using %s theme so you should try %s plugin which has loads more options and features!', 'remove-powered-by-wp'),
                        '<strong>' . $key . '</strong>',
                        '<strong><a href="' . add_query_arg(array(
                            's' => $value . ' please our modification',
                            'tab' => 'search',
                            'type' => 'term'
                        ), admin_url('plugin-install.php')) . '" title="' . __('Options for ' . $key, 'remove-powered-by-wp') . '">' . __('Options for ' . $key, 'remove-powered-by-wp') . '</a></strong>'
                    );
                    echo '</p>';

                }

            }

        }

	}

    if (!class_exists('rpbwCommon')) {

        require_once(dirname(__FILE__) . '/includes/class-rpbw-common.php');

    }

    if (in_array(get_template(), remove_powered_by_wp_class::$rpbw_compatible_themes, true)) {

    	$remove_powered_by_wp_object = new remove_powered_by_wp_class();

    } else {

        if (!remove_powered_by_wp_class::rpbw_compatible_theme_installed()) {

            add_action('admin_notices', 'rpbw_wrong_theme_notice');

        }

        add_action('after_setup_theme', 'rpbw_is_theme_being_previewed');

    }

    function rpbw_wrong_theme_notice() {

?>
<div class="notice notice-error">
<p><strong><?php _e('Remove "Powered by Wordpress" Plugin Error', 'remove-powered-by-wp'); ?></strong><br />
<?php

        printf(
            __('This plugin requires one of the default Wordpress themes to be active or live previewed in order to function. Your theme "%s" is not compatible. Please install and activate or live preview one of these themes (or a child theme thereof):', 'remove-powered-by-wp'),
            get_template()
        );

        $theme_list = array();

        foreach (remove_powered_by_wp_class::$rpbw_compatible_themes as $key => $value) {

            $theme_list[] = '<a href="' . add_query_arg('search', $value, admin_url('theme-install.php')) . '" title="' .  __($key, 'remove-powered-by-wp') . '">' .  __($key, 'remove-powered-by-wp') . '</a>';

        }

        echo ' ' . implode(', ', $theme_list) . '.';

?></p>
</div>
<?php

    }

    function rpbw_is_theme_being_previewed() {

        if (remove_powered_by_wp_class::rpbw_compatible_theme_installed()) {

            global $wp_customize;

            if (($wp_customize instanceof WP_Customize_Manager) && $wp_customize->is_preview() && in_array($wp_customize->get_template(), remove_powered_by_wp_class::$rpbw_compatible_themes, true)) {

                $remove_powered_by_wp_object = new remove_powered_by_wp_class();

            }

        }

    }

}

?>
