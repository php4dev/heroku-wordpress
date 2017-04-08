<?php
$output = $el_class = $width = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'width' => '1/1',
    'offset' => '',
    'css' => '',
    "boxed" => 'false', 
    "centered_text" => 'false', 
    'enable_animation' => '',
    'animation' => '', 
    'column_padding' => 'no-extra-padding',
    'column_padding_position'=> 'all',
    'delay' => '0',
    'background_color' => '',
    'background_color_hover' => '',
    'background_hover_color_opacity' => '1',
    'background_color_opacity' => '1',
    'background_image' => '',
    'enable_bg_scale' => '',
    'column_link' => '',
    'font_color' => ''
), $atts));

//var init
$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = vc_column_offset_class_merge($offset, $width);
$box_border = null;
$parsed_animation = null;	
$style = 'style="';

$el_class .= ' wpb_column column_container vc_column_container col';
if($boxed == 'true' && empty($background_image) && empty($background_color))  { $el_class .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
if($centered_text == 'true') $el_class .= ' centered-text';


//style related
$background_color_string = null;
$has_bg_color = 'false';
if(!empty($background_color)) {
	$background_color_string .= $background_color;	
    $has_bg_color = 'true';
}
if(!empty($background_image)) {
	
	$bg_image_src = wp_get_attachment_image_src($background_image, 'full');
	$style .= ' background-image: url(\''.$bg_image_src[0].'\'); ';
}
if(!empty($font_color)) $style .= ' color: '.$font_color.';';
(empty($background_color) && empty($background_image) && empty($font_color)) ? $style = null : $style .= '"';

$using_bg = (!empty($background_image) || !empty($background_color)) ? 'data-using-bg="true"': null;

$using_reveal_animation = false;


if(!empty($animation) && $animation != 'none' && $enable_animation == 'true') {
	 $el_class .= ' has-animation';
	
	 $parsed_animation = str_replace(" ","-",$animation);
	 $delay = intval($delay);

      if($animation == 'reveal-from-right' || $animation == 'reveal-from-bottom' || $animation == 'reveal-from-left' || $animation == 'reveal-from-top')
        $using_reveal_animation = true;
}

if($using_reveal_animation == false) $el_class .= ' '. $column_padding;
if($using_reveal_animation == true) {
    $style2 = $style;
    $style = null;
}

$column_link_html = (!empty($column_link)) ? '<a class="column-link" href="'.$column_link.'"></a>' : null;
$column_bg_color_html = (!empty($column_link)) ? '<a class="column-link" href="'.$column_link.'"></a>' : null;
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t".'<div '.$style.' class="'.$css_class.'" '.$using_bg.' data-bg-cover="'.$enable_bg_scale.'" data-padding-pos="'. $column_padding_position .'" data-has-bg-color="'.$has_bg_color.'" data-bg-color="'.$background_color_string.'" data-bg-opacity="'.$background_color_opacity.'" data-hover-bg="'.$background_color_hover.'" data-hover-bg-opacity="'.$background_hover_color_opacity.'" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">' . $column_link_html;
if($using_reveal_animation == true) $output .= "\n\t\t".'<div class="column-inner-wrap"><div '.$style2.' data-bg-cover="'.$enable_bg_scale.'" class="column-inner '.$column_padding.'">';
else $output .= "\n\t\t".'<div class="vc_column-inner">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper'); 
if($using_reveal_animation == true) $output .= "\n\t\t".'</div></div>';
else $output .= "\n\t".'</div>';
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;