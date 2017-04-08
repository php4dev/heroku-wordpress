<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Facebook
 */
$type = $css = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$url = get_permalink();
$el_class = isset( $el_class ) ? $el_class : '';

$class_to_filter = 'fb_like wpb_content_element fb_type_' . $type;
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="' . esc_attr( $css_class ) . '"><iframe src="//www.facebook.com/plugins/like.php?href='
	. $url . '&amp;layout='
	. $type . '&amp;show_faces=false&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>';

echo $output;
