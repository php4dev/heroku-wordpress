<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $width
 * @var $align
 * @var $css
 * @var $el_class
 * @var $featured_image
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Gitem_Col
 */
$width = $align = $css = $el_class = $featured_image = '';

$atts = shortcode_atts( array(
	'width' => '1/1',
	'align' => 'left',
	'css' => '',
	'el_class' => '',
	'featured_image' => '',
), $atts );
extract( $atts );
// TODO: Note that vc_map_get_attributes doesnt return align so it should be checked in next bug fix

$style = '';
$width = wpb_translateColumnWidthToSpan( $width );
$css_class = $width
	. ( strlen( $el_class ) ? ' ' . $el_class : '' )
	. ' vc_gitem-col vc_gitem-col-align-' . $align
	. vc_shortcode_custom_css_class( $css, ' ' );

if ( 'yes' === $featured_image ) {
	$style = '{{ post_image_background_image_css }}';
}
echo '<div class="' . $css_class . '"'
	. ( strlen( $style ) > 0 ? ' style="' . $style . '"' : '' )
	. '>'
	. do_shortcode( $content )
	. '</div>';
