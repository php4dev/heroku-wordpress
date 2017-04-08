<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @var $vc_btn WPBakeryShortCode_VC_Btn
 * @var $post WP_Post
 * @var $atts
 *
 * @var $style
 * @var $shape
 * @var $color
 * @var $custom_background
 * @var $size
 * @var $align
 * @var $link
 * @var $url
 * @var $title
 * @var $button_block
 * @var $el_class
 * @var $outline_custom_color
 * @var $outline_custom_hover_background
 * @var $outline_custom_hover_text
 * @var $css
 * @var $add_icon
 * @var $i_align
 * @var $i_type
 */
$atts = array();
parse_str( $data, $atts );

VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_VC_Btn' );
$vc_btn = new WPBakeryShortCode_VC_Btn( array( 'base' => 'vc_btn' ) );

$inline_css = '';
$icon_wrapper = false;
$icon_html = false;
$attributes = array();

/** @var $vc_btn WPBakeryShortCode_VC_Btn */
$atts = vc_map_get_attributes( $vc_btn->getShortcode(), $atts );
extract( $atts );
//parse link

$class_to_filter = 'vc_btn3-container ' . $vc_btn->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $vc_btn->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $vc_btn->settings( 'base' ), $atts );

$button_class = ' vc_btn3-size-' . $size . ' vc_btn3-shape-' . $shape . ' vc_btn3-style-' . $style;
$button_html = $title;

if ( '' === trim( $title ) ) {
	$button_class .= ' vc_btn3-o-empty';
	$button_html = '<span class="vc_btn3-placeholder">&nbsp;</span>';
}
if ( 'true' === $button_block && 'inline' !== $align ) {
	$button_class .= ' vc_btn3-block';
}
if ( 'true' === $add_icon ) {
	$button_class .= ' vc_btn3-icon-' . $i_align;
	vc_icon_element_fonts_enqueue( $i_type );

	if ( isset( ${'i_icon_' . $i_type} ) ) {
		switch ( $i_type ) {
			case 'pixelicons':
				$icon_wrapper = true;
				break;
		}
		$iconClass = ${'i_icon_' . $i_type};
	} else {
		$iconClass = 'fa fa-info';
	}

	if ( $icon_wrapper ) {
		$icon_html = '<i class="vc_btn3-icon"><span class="vc_btn3-icon-inner ' . esc_attr( $iconClass ) . '"></span></i>';
	} else {
		$icon_html = '<i class="vc_btn3-icon ' . esc_attr( $iconClass ) . '"></i>';
	}

	if ( 'left' === $i_align ) {
		$button_html = $icon_html . ' ' . $button_html;
	} else {
		$button_html .= ' ' . $icon_html;
	}
}

if ( 'custom' === $style ) {
	$inline_css = vc_get_css_color( 'background-color', $custom_background ) . vc_get_css_color( 'color', $custom_text );
} elseif ( 'outline-custom' === $style ) {
	$inline_css = vc_get_css_color( 'border-color', $outline_custom_color ) . vc_get_css_color( 'color', $outline_custom_color );
	$attributes[] = 'onmouseenter="this.style.borderColor=\'' . $outline_custom_hover_background . '\'; this.style.backgroundColor=\'' . $outline_custom_hover_background . '\'; this.style.color=\'' . $outline_custom_hover_text . '\'"';
	$attributes[] = 'onmouseleave="this.style.borderColor=\'' . $outline_custom_color . '\'; this.style.backgroundColor=\'transparent\'; this.style.color=\'' . $outline_custom_color . '\'"';
} else {
	$button_class .= ' vc_btn3-color-' . $color . ' ';
}

if ( '' !== $inline_css ) {
	$inline_css = ' style="' . $inline_css . '"';
}

$attributes = implode( ' ', $attributes );

$link = trim( $link );
// Add link
$use_link = strlen( $link ) > 0 && 'none' !== $link;
$link_output = '';
if ( $use_link ) {
	$link_output = vc_gitem_create_link_real( $atts, $post, 'vc_general vc_btn3 ' . trim( $button_class ), $title );
}
$output = '<div class="'
	. esc_attr( trim( $css_class ) )
	. ' vc_btn3-' . esc_attr( $align ) . '">';
if ( preg_match( '/href=\"[^\"]+/', $link_output ) ) :
	$output .= '<' . $link_output . ' ' . $inline_css . ' ' . $attributes . '>' . $button_html . '</a>';
elseif ( 'load-more-grid' === $link ) :
	$output .= '<a href="javascript:;" class="vc_general vc_btn3 ' . esc_attr( $button_class ) . '" ' . $inline_css . ' ' . $attributes . '>' . $button_html . '</a>';
else :
	$output .= '<button class="vc_general vc_btn3 ' . esc_attr( $button_class ) . '"' . $inline_css . ' ' . $attributes . '>' .
		$button_html . '</button>';
endif;
$output .= '</div>';

return $output;
