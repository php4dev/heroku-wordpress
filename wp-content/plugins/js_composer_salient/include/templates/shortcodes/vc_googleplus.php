<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $annotation
 * @var $widget_width
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_GooglePlus
 */
$type = $annotation = $widget_width = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( empty( $annotation ) ) {
	$annotation = 'bubble';
}
$params = '';
$params .= ( '' !== $type ) ? ' size="' . $type . '"' : '';
$params .= ( '' !== $annotation ) ? ' annotation="' . $annotation . '"' : '';

if ( empty( $type ) ) {
	$type = 'standard';
}
if ( 'inline' === $annotation && strlen( $widget_width ) > 0 ) {
	$params .= ' width="' . (int) $widget_width . '"';
}

$class_to_filter = 'wpb_googleplus wpb_content_element wpb_googleplus_type_' . $type . ' vc_googleplus-annotation-' . $annotation;
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="' . esc_attr( $css_class ) . '"><g:plusone' . $params . '></g:plusone></div>';

echo $output;
