<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_TweetMeMe
 */
$type = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'twitter-share-button';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

//data-count="'. $type . '" -> old fashion see :https://twittercommunity.com/t/a-new-design-for-tweet-and-follow-buttons/52791
$output = '<a href="//twitter.com/share" class="' . esc_attr( $css_class ) . '">' . __( 'Tweet', 'js_composer' ) . '</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';

echo $output;
