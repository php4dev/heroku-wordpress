<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_VC_TweetMeMe extends WPBakeryShortCode {
	protected function contentInline( $atts, $content = null ) {
		/**
		 * @var $type
		 */
		$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		$css = isset( $atts['css'] ) ? $atts['css'] : '';
		$el_class = isset( $atts['el_class'] ) ? $atts['el_class'] : '';

		$class_to_filter = 'wpb_googleplus vc_social-placeholder wpb_content_element';
		$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

		return '<div class="' . esc_attr( $css_class ) . '"></div>';
	}
}
