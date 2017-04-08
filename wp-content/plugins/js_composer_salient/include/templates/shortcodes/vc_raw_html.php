<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $content - shortcode content
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Raw_html
 */
$el_class = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$content = rawurldecode( base64_decode( strip_tags( $content ) ) );

// template is also used by 'Raw JS' shortcode which doesn't have Design Options
if ( ! isset( $css ) ) {
	$css = '';
}

$class_to_filter = 'wpb_raw_code ' . ( ( 'vc_raw_html' === $this->settings['base'] ) ? 'wpb_content_element wpb_raw_html' : 'wpb_raw_js' );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '
	<div class="' . esc_attr( $css_class ) . '">
		<div class="wpb_wrapper">
			' . $content . '
		</div>
	</div>
';

echo $output;
