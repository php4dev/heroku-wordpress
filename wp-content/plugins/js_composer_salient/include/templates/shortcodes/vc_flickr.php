<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $title
 * @var $flickr_id
 * @var $count
 * @var $type
 * @var $display
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_flickr
 */
$el_class = $title = $flickr_id = $css = $count = $type = $display = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'wpb_flickr_widget wpb_content_element';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '
	<div class="' . esc_attr( $css_class ) . '">
		<div class="wpb_wrapper">
			' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_flickr_heading' ) ) . '
			<script type="text/javascript" src="//www.flickr.com/badge_code_v2.gne?count=' . $count . '&amp;display=' . $display . '&amp;size=s&amp;layout=x&amp;source=' . $type . '&amp;' . $type . '=' . $flickr_id . '"></script>
			<p class="flickr_stream_wrap"><a class="wpb_follow_btn wpb_flickr_stream" href="//www.flickr.com/photos/' . $flickr_id . '">' . __( 'View stream on flickr', 'js_composer' ) . '</a></p>
		</div>
	</div>
';

echo $output;
