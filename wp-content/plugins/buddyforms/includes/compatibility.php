<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Add compatibility with Better Notifications for WordPress
 *
 * @url https://wordpress.org/plugins/bnfw
 * @url https://betternotificationsforwp.com/documentation/compatibility/support-plugins-front-end-forms/
 */

add_filter( 'bnfw_trigger_insert_post', '__return_true' );
add_action( 'wp_enqueue_scripts',  'front_js_loader1' , 1, 1 );

function front_js_loader1(){
    $current_theme = wp_get_theme()->get_template();
    if($current_theme === "enfold" ||$current_theme=== "enfold-child" ){
        $url_force = get_site_url().'/wp-includes/css/media-views.css';
        wp_register_style('media-views-alternative', $url_force);
        wp_enqueue_style( 'media-views-alternative' );
    }
}