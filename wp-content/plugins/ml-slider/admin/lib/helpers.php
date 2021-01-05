<?php

if (!defined('ABSPATH')) {
    die('No direct access.');
}

/**
 * Will be truthy if the plugin is installed
 *
 * @param  string $name name of the plugin 'ml-slider'
 * @return bool|string - will return path, ex. 'ml-slider/ml-slider.php'
 */
function metaslider_plugin_is_installed($name = 'ml-slider')
{
    if (!function_exists('get_plugins')) {
        include_once(ABSPATH.'wp-admin/includes/plugin.php');
    }
    foreach (get_plugins() as $plugin => $data) {
        if ($data['TextDomain'] == $name) {
            return $plugin;
        }
    }
    return false;
}
/**
 * checks if metaslider pro is installed
 *
 * @return bool
 */
function metaslider_pro_is_installed()
{
    return (bool) metaslider_plugin_is_installed('ml-slider-pro');
}

/**
 * Will be true if the plugin is active
 *
 * @return bool
 */
function metaslider_pro_is_active()
{
    return is_plugin_active(metaslider_plugin_is_installed('ml-slider-pro'));
}

/**
 * Returns true if the user does not have the pro version installed
 *
 * @return bool
 */
function metaslider_user_sees_upgrade_page()
{
    return (bool) apply_filters('metaslider_show_upgrade_page', !metaslider_pro_is_installed());
}

/**
 * Returns true if the user does not have the pro version installed
 *
 * @return bool
 */
function metaslider_user_has_at_least_one_slideshow()
{
    $posts = get_posts(array('posts_per_page' => 1, 'post_type' => 'ml-slider'));
    return (bool) is_array($posts) && count($posts);
}

/**
 * Returns true if the user does not have the pro version installed
 *
 * @return bool
 */
function metaslider_user_sees_call_to_action()
{
    return (bool) apply_filters('metaslider_show_upgrade_page', !metaslider_pro_is_installed());
}

/**
 * Returns true if the user is ready to see notices. Exceptions include
 * when they have no slideshows (first start) and while on the initial tour.
 *
 * @return boolean
 */
function metaslider_user_is_ready_for_notices()
{
    $args = array(
        'post_type' => 'ml-slider',
        'post_status' => 'publish',
        'suppress_filters' => 1, // wpml, ignore language filter
        'order' => 'ASC',
        'posts_per_page' => -1
    );

    // If no slideshows, don't show a notice
    if (!count(get_posts($args))) {
        return false;
    }

    // If they have slideshows but have yet to finish the tour or cancel it,
    // hold off on showing notices
    return (bool) get_option('metaslider_tour_cancelled_on');
}

/**
 * Returns true if the user is on the specified admin page
 *
 * @param  string $page_name Admin page name
 * @return boolean
 */
function metaslider_user_is_on_admin_page($page_name = 'admin.php')
{
    global $pagenow;
    return ($pagenow == $page_name);
}

/**
 * Returns the upgrade link
 *
 * @return string
 */
function metaslider_get_upgrade_link()
{
    return esc_url(apply_filters('metaslider_hoplink', add_query_arg(array(
        'utm_source' => 'lite',
        'utm_medium' => 'banner',
        'utm_campaign' => 'pro',
    ), 'https://www.metaslider.com/upgrade')));
}

/**
 * Returns an array of the trashed slides
 *
 * @param int $slider_id Slider ID
 * @return array
 */
function metaslider_has_trashed_slides($slider_id)
{
    return get_posts(array(
        'force_no_custom_order' => true,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_type' => array('attachment', 'ml-slide'),
        'post_status' => array('trash'),
        'lang' => '',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'ml-slider',
                'field' => 'slug',
                'terms' => $slider_id
            )
        )
    ));
}

/**
 * Returns whether we are looking at trashed slides
 *
 * @param int $slider_id - the id
 * @return bool
 */
function metaslider_viewing_trashed_slides($slider_id)
{

    // If there are no trashed slides, no need to see this page
    if (!count(metaslider_has_trashed_slides($slider_id))) {
        return false;
    }

    // Checks to see if the parameter is set and if it's boolean
    return isset($_REQUEST['show_trashed']) && filter_input(INPUT_GET, 'show_trashed', FILTER_VALIDATE_BOOLEAN);
}

/**
 * Returns the current pro version registered by WP
 *
 * @return string
 */
function metaslider_pro_version()
{
    $file = trailingslashit(WP_PLUGIN_DIR) . metaslider_plugin_is_installed('ml-slider-pro');
    $data = get_file_data($file, array('Version' => 'Version'));
    return $data['Version'];
}

/**
 * Returns the current version registered by WP
 *
 * @return string
 */
function metaslider_version()
{
    $file = trailingslashit(WP_PLUGIN_DIR) . metaslider_plugin_is_installed('ml-slider');
    $data = get_file_data($file, array('Version' => 'Version'));
    return $data['Version'];
}

/**
 * Returns whether we are looking at a trashed slide
 *
 * @param object $slide a slide object
 * @return bool
 */
function metaslider_this_is_trash($slide)
{
    return (is_object($slide) && "trash" === $slide->post_status);
}

/**
 * This will customize a URL with a correct Affiliate link
 *
 * This function can be updated to suit any URL as long as the URL is passed
 *
 * @param string $url   URL to be checked to see if it is an metaslider match.
 * @param string $text  Anchor Text
 * @param string $html  Any specific HTML to be added.
 * @param string $class Specify a class for the anchor tag.
 *
 * @return string Optimized affiliate link
 */
function metaslider_optimize_url($url, $text, $html = null, $class = '')
{

    // Check if the URL is metaslider.
    if (false !== strpos($url, 'metaslider.com')) {

        // Set URL with Affiliate ID.
        $url = metaslider_get_upgrade_link();
    }

    // Return URL - check if there is HTML such as Images.
    if (!empty($html)) {
        return sprintf('<a class="%1$s" href="%2$s">%3$s</a>', esc_attr($class), esc_attr($url), $html);
    } else {
        return sprintf('<a class="text-blue-dark underline %1$s" href="%2$s">%3$s</a>', esc_attr($class), esc_attr($url), htmlspecialchars($text));
    }
}
