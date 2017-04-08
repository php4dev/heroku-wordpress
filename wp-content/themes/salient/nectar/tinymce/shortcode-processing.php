<?php

#-----------------------------------------------------------------#
# Columns
#-----------------------------------------------------------------# 

//half columns 
function nectar_one_half( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
    $parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_6' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'nectar_one_half');

function nectar_one_half_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_6 col_last' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">' . $box_border . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'nectar_one_half_last');



//one third columns
function nectar_one_third( $atts, $content = null ) {
	extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		 
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}

    return '<div class="col span_4' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'nectar_one_third');

function nectar_one_third_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_4 col_last' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'nectar_one_third_last');

function nectar_two_thirds( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		 
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_8' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div>';
}
add_shortcode('two_thirds', 'nectar_two_thirds');

function nectar_two_thirds_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_8 col_last' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_thirds_last', 'nectar_two_thirds_last');



//one fourth columns
function nectar_one_fourth( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_3' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'nectar_one_fourth');

function nectar_one_fourth_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_3 col_last' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'nectar_one_fourth_last');

function nectar_three_fourths( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		 
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_9' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourths', 'nectar_three_fourths');

function nectar_three_fourths_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_9 col_last' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourths_last', 'nectar_three_fourths_last');



//one sixth columns
function nectar_one_sixth( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_2' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'nectar_one_sixth');

function nectar_one_sixth_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_2 col_last' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'nectar_one_sixth_last');

function nectar_five_sixths( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		 
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_10' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixths', 'nectar_five_sixths');

function nectar_five_sixths_last( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		 
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_10 col_last' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixths_last', 'nectar_five_sixths_last');



function nectar_one_whole( $atts, $content = null ) {
    extract(shortcode_atts(array("boxed" => 'false', "centered_text" => 'false', 'animation' => '', 'delay' => '0'), $atts));
	$column_classes = null;
	$box_border = null;
	$parsed_animation = null;	
	
	if($boxed == 'true')  { $column_classes .= ' boxed'; $box_border = '<span class="bottom-line"></span>'; }
	if($centered_text == 'true') $column_classes .= ' centered-text';
	if(!empty($animation)) {
		 $column_classes .= ' has-animation';
		 
		 $parsed_animation = str_replace(" ","-",$animation);
		 $delay = intval($delay);
	}
	
    return '<div class="col span_12' . $column_classes . '" data-animation="'.strtolower($parsed_animation).'" data-delay="'.$delay.'">'. $box_border . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_whole', 'nectar_one_whole');

#-----------------------------------------------------------------#
# Elements
#-----------------------------------------------------------------# 

//full width section
function nectar_full_width_section($atts, $content = null) {
   	extract(shortcode_atts(array("top_padding" => "40", "bottom_padding" => "40", 'image_url'=> '', 'bg_pos'=> '', 'background_color'=> '', 'bg_repeat' => '', 'text_color' => 'light', 'parallax_bg' => '', 'class' => ''), $atts));
		
	$style = null;
	$etxra_class = null;

	$bg_props = null;
	$using_image_class = null;
	$using_bg_color_class = null;
	
	if(!empty($image_url)) {
		$bg_props .= 'background-image: url('. $image_url. '); ';
		$bg_props .= 'background-position: '. $bg_pos .'; ';
		
		//for pattern bgs
		if(strtolower($bg_repeat) == 'repeat'){
			$bg_props .= 'background-repeat: '. strtolower($bg_repeat) .'; ';
			$etxra_class = 'no-cover';
		} else {
			$bg_props .= 'background-repeat: '. strtolower($bg_repeat) .'; ';
			$etxra_class = null;
		}

		$using_image_class = 'using-image';
	}
	
	if(!empty($background_color)) {
		$style .= 'background-color: '. $background_color.'; ';
		$using_bg_color_class = 'using-bg-color';
	}
	
	if(strtolower($parallax_bg) == 'true'){
		$parallax_class = 'parallax_section';
	} else {
		$parallax_class = 'standard_section';
	}
	
	$style .= 'padding-top: '. $top_padding .'px; ';
	$style .= 'padding-bottom: '. $bottom_padding .'px; ';
	 
    return'
	<div id="'.uniqid("fws_").'" class="full-width-section '.$parallax_class . ' ' . $class . ' " style="'.$style.'"> 

	<div class="row-bg-wrap"> <div class="row-bg '.$using_image_class . ' ' . $using_bg_color_class . ' '. $etxra_class.'" style="'.$bg_props.'"></div> </div>

    <div class="col span_12 '.strtolower($text_color).'">'.do_shortcode($content).'</div></div>';
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode('full_width_section', 'nectar_full_width_section');
}

//image with animation
function nectar_image_with_animation($atts, $content = null) { 
    extract(shortcode_atts(array("animation" => 'Fade In', "delay" => '0', "image_url" => '', 'alt' => '', 'alignment' => 'left', 'img_link_target' => '_self', 'img_link' => '', 'img_link_large' => '', 'box_shadow' => 'none', 'box_shadow_direction' => 'middle', 'max_width' => '100%','el_class' => ''), $atts));
	
	$parsed_animation = str_replace(" ","-",$animation);
	(!empty($alt)) ? $alt_tag = $alt : $alt_tag = null;
	
	if(preg_match('/^\d+$/',$image_url)){
		$image_src = wp_get_attachment_image_src($image_url, 'full');
		$wp_img_alt_tag = get_post_meta( $image_url, '_wp_attachment_image_alt', true );
		if(!empty($wp_img_alt_tag)) $alt_tag = $wp_img_alt_tag;
		$image_url = $image_src[0];
		
	}
	
	$box_shadow_attrs = 'data-shadow="'.$box_shadow.'" data-shadow-direction="'.$box_shadow_direction.'"';
	
	if(!empty($img_link) || !empty($img_link_large)){
		
		if(!empty($img_link) && empty($img_link_large)) {
			
			return '<div class="img-with-aniamtion-wrap '.$alignment.'" data-max-width="'.$max_width.'"><div class="inner"><a href="'.$img_link.'" target="'.$img_link_target.'" class="'.$alignment.'"><img '.$box_shadow_attrs.' class="img-with-animation '.$el_class.'" data-delay="'.$delay.'" height="100%" width="100%" data-animation="'.strtolower($parsed_animation).'" src="'.$image_url.'" alt="'.$alt_tag.'" /></a></div></div>';
			
		} elseif(!empty($img_link_large)) {
			
			return '<div class="img-with-aniamtion-wrap '.$alignment.'" data-max-width="'.$max_width.'"><div class="inner"><a href="'.$image_url.'" class="pp '.$alignment.'"><img '.$box_shadow_attrs.' class="img-with-animation '.$el_class.'" data-delay="'.$delay.'" height="100%" width="100%" data-animation="'.strtolower($parsed_animation).'" src="'.$image_url.'" alt="'.$alt_tag.'" /></a></div></div>';
		}
		
	} else {
		return '<div class="img-with-aniamtion-wrap '.$alignment.'" data-max-width="'.$max_width.'"><div class="inner"><img '.$box_shadow_attrs.' class="img-with-animation '.$el_class.'" data-delay="'.$delay.'" height="100%" width="100%" data-animation="'.strtolower($parsed_animation).'" src="'.$image_url.'" alt="'.$alt_tag.'" /></div></div>';
	}
   
}

add_shortcode('image_with_animation', 'nectar_image_with_animation');


//testimonial slider
function nectar_testimonial_slider($atts, $content = null) { 
    extract(shortcode_atts(array("autorotate"=>''), $atts));
	
	
    return '<div class="col span_12 testimonial_slider" data-autorotate="'.$autorotate.'"><div class="slides">'.do_shortcode($content).'</div></div>';
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode('testimonial_slider', 'nectar_testimonial_slider');
}

//testimonial 
function nectar_testimonial($atts, $content = null) { 
    extract(shortcode_atts(array("name" => '', "quote" => ''), $atts));
	
    return '<blockquote><p>'.$quote.'</p>'. '<span>'.$name.'</span></blockquote>';
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode('testimonial', 'nectar_testimonial');
}


//heading
function nectar_heading($atts, $content = null) { 
    extract(shortcode_atts(array("title" => 'Title', "subtitle" => 'Subtitle'), $atts));
	$subtitle_holder = null;
	
	if($subtitle != 'Subtitle') $subtitle_holder = '<p>'.$subtitle.'</p>';
    return'
    <div class="col span_12 section-title text-align-center extra-padding">
		<h2>'.$content.'</h2>'. $subtitle_holder .'</div><div class="clear"></div>';
}
add_shortcode('heading', 'nectar_heading');



//divider
function nectar_divider($atts, $content = null) {  
    extract(shortcode_atts(array("line" => 'false', "custom_height" => '25', "line_type" => 'No Line', 'line_thickness' => '1', 'custom_line_width' => '20%', 'divider_color' => 'default', 'animate' => '', 'delay' => ''), $atts));
	
	if($line_type == 'Small Thick Line' || $line_type == 'Small Line' ){
		$height = (!empty($custom_height)) ? 'style="margin-top: '.intval($custom_height/2).'px; width: '.$custom_line_width.'px; height: '.$line_thickness.'px; margin-bottom: '.intval($custom_height/2).'px;"' : null;
		$divider = '<div '.$height.' data-width="'.$custom_line_width.'" data-animate="'.$animate.'" data-animation-delay="'.$delay.'" data-color="'.$divider_color.'" class="divider-small-border"></div>';
	} else if($line_type == 'Full Width Line'){
		$height = (!empty($custom_height)) ? 'style="margin-top: '.intval($custom_height/2).'px; height: '.$line_thickness.'px; margin-bottom: '.intval($custom_height/2).'px;"' : null;
		$divider = '<div '.$height.' data-width="100%" data-animate="'.$animate.'" data-animation-delay="'.$delay.'" data-color="'.$divider_color.'" class="divider-border"></div>';
	} else {
		$height = (!empty($custom_height)) ? 'style="height: '.intval($custom_height).'px;"' : null;
		$divider = '<div '.$height.' class="divider"></div>';
	}
	//old option
	if($line == 'true') $divider = '<div class="divider-border"></div>';
    return '<div class="divider-wrap">'.$divider.'</div>';
}
add_shortcode('divider', 'nectar_divider');


//divider
function nectar_dropcap_proc($atts, $content = null) {  
	 extract(shortcode_atts(array("color" => ''), $atts));

	 $color_str = null;
	if(!empty($color)) $color_str = 'style=" color: '.$color.';"'; 
    return '<span class="nectar-dropcap" '.$color_str.'>'.$content.'</span>';
}

add_shortcode('nectar_dropcap', 'nectar_dropcap_proc');


//milestone
function nectar_milestone($atts, $content = null) {  
    extract(shortcode_atts(array("subject" => '', 'symbol' => '', 'symbol_position' => 'after', 'symbol_alignment' => 'default', 'number_font_size' => '62', 'symbol_font_size' => '62', 'effect' => 'count', 'number' => '0', 'color' => 'Default'), $atts));
	
	if(!empty($symbol)) {
		$symbol_markup = 'data-symbol="'.$symbol.'" data-symbol-alignment="'.strtolower($symbol_alignment).'" data-symbol-pos="'.$symbol_position.'" data-symbol-size="'.$symbol_font_size.'"';
	} else {
		$symbol_markup = null;
	}

	$motion_blur = null;
	$milestone_wrap = null;
	$milestone_wrap_close = null;
	$span_open = null;
	$span_close = null;

	if($effect == 'motion_blur') {
		$motion_blur = 'motion_blur';
		$milestone_wrap = '<div class="milestone-wrap">';
		$milestone_wrap_close = '</div>';
	} else {
		$span_open = '<span>';
		$span_close = '</span>';
	}
	
	$number_markup = '<div class="number '.strtolower($color).'" data-number-size="'.$number_font_size.'">'.$span_open.$number.$span_close.'</div>';
	$subject_markup = '<div class="subject">'.$subject.'</div>';
	
    return $milestone_wrap . '<div class="nectar-milestone '. $motion_blur . '"'. $symbol_markup.'> '.$number_markup.' '.$subject_markup.' </div>' . $milestone_wrap_close;
}
add_shortcode('milestone', 'nectar_milestone');



//text with icon
function nectar_text_with_icon($atts, $content = null) {  
    extract(shortcode_atts(array('color' => 'Accent-Color', 'icon_type' => 'font_icon', 'icon' => 'icon-glass', 'icon_image' => ''), $atts));
	
	$icon_markup = null;
	$output = null;

	if($icon_type == 'font_icon'){
		$icon_markup = '<i class="icon-default-style '.$icon.' '. strtolower($color).'"></i>';
	} else {
		$icon_markup = wp_get_attachment_image_src($icon_image, 'medium');
		if(!empty($icon_markup)) {
			
			$icon_alt = get_post_meta($icon_image, '_wp_attachment_image_alt', true);
			
			$icon_markup = '<img src="'.$icon_markup[0].'" alt="'.$icon_alt.'" />';
		} else {
			$icon_markup = null;
		}
	}
	
	$output .= '<div class="iwithtext"><div class="iwt-icon"> '.$icon_markup.' </div>';
	$output .= '<div class="iwt-text"> '.do_shortcode($content).' </div><div class="clear"></div></div>';
	
    return $output;
}
add_shortcode('text-with-icon', 'nectar_text_with_icon');


//fancy list
function nectar_fancy_list($atts, $content = null) {  
    extract(shortcode_atts(array('color' => 'Accent-Color', 'icon_type' => 'standard_dash', 'icon' => 'icon-glass', 'enable_animation' => 'false', 'delay' => ''), $atts));
	
	$icon_markup = null;
	$output = null;
	$delay = intval($delay);

	if($icon_type == 'font_icon'){
		$icon_markup = 'data-list-icon="'.$icon.'" data-animation="'.$enable_animation.'" data-animation-delay="'.$delay.'" data-color="'. strtolower($color).'"';
	} else {
		$icon_markup = 'data-list-icon="icon-salient-thin-line" data-animation="'.$enable_animation.'" data-animation-delay="'.$delay.'" data-color="'. strtolower($color).'"';
	}
	
	$output .= '<div class="nectar-fancy-ul" '.$icon_markup.'> '.do_shortcode($content).' </div>';
	
    return $output;
}
add_shortcode('fancy-ul', 'nectar_fancy_list');




//button
function nectar_button($atts, $content = null) {  
    extract(shortcode_atts(array("size" => 'small', "url" => '#', 'color' => 'Accent-Color', 'color_override' => '', 'hover_color_override' => '', 'hover_text_color_override' => '#fff', "text" => 'Button Text', 'image' => '', 'open_new_tab' => '0'), $atts));
	
	$target = ($open_new_tab == 'true') ? 'target="_blank"' : null;
	
	//icon
	if(!empty($image) && strpos($image,'.svg') !== false) {
		if(!empty($image)) { $button_icon = '<img src="'.get_template_directory_uri() . '/css/fonts/svg/'.$image.'" alt="icon" />'; $has_icon = ' has-icon'; } else { $button_icon = null; $has_icon = null; }
	} else {
		if(!empty($image)) { $button_icon = '<i class="' . $image .'"></i>'; $has_icon = ' has-icon'; } else { $button_icon = null; $has_icon = null; }
	}
	
	//standard arrow icon
	if($image == 'default-arrow') $button_icon = '<i class="icon-button-arrow"></i>';
	
	$stnd_button = null;
	if( strtolower($color) == 'accent-color' || strtolower($color) == 'extra-color-1' || strtolower($color) == 'extra-color-2' || strtolower($color) == 'extra-color-3') {
		$stnd_button = " regular-button";
	}
	
	$button_open_tag = '';

	if($color == 'accent-color-tilt' || $color == 'extra-color-1-tilt' || $color == 'extra-color-2-tilt' || $color == 'extra-color-3-tilt') {
		$color = substr($color, 0, -5);
		$color = $color . ' tilt';
		$button_open_tag = '<div class="tilt-button-wrap"> <div class="tilt-button-inner">';
	}

	switch ($size) {
		case 'small' :
			$button_open_tag .= '<a class="nectar-button small '. strtolower($color) . $has_icon . $stnd_button.'" '. $target;
			break;
		case 'medium' :
			$button_open_tag .= '<a class="nectar-button medium ' . strtolower($color) . $has_icon . $stnd_button.'" '. $target;
			break;
		case 'large' :
			$button_open_tag .= '<a class="nectar-button large '. strtolower($color) . $has_icon . $stnd_button.'" '. $target;
			break;	
		case 'jumbo' :
			$button_open_tag .= '<a class="nectar-button jumbo '. strtolower($color) . $has_icon . $stnd_button.'" '. $target;
			break;	
		case 'extra_jumbo' :
			$button_open_tag .= '<a class="nectar-button extra_jumbo '. strtolower($color) . $has_icon . $stnd_button.'" '. $target;
			break;	
	}
	
	$color_or = (!empty($color_override)) ? 'data-color-override="'. $color_override.'" ' : 'data-color-override="false" ';	
	$hover_color_override = (!empty($hover_color_override)) ? ' data-hover-color-override="'. $hover_color_override.'"' : 'data-hover-color-override="false"';
	$hover_text_color_override = (!empty($hover_text_color_override)) ? ' data-hover-text-color-override="'. $hover_text_color_override.'"' :  null;	
	$button_close_tag = null;

	if($color == 'accent-color tilt' || $color == 'extra-color-1 tilt' || $color == 'extra-color-2 tilt' || $color == 'extra-color-3 tilt') $button_close_tag = '</div></div>';

	if($color != 'see-through-3d') {
		if($color == 'extra-color-gradient-1' || $color == 'extra-color-gradient-2' || $color == 'see-through-extra-color-gradient-1' || $color == 'see-through-extra-color-gradient-2')
			return $button_open_tag . ' href="' . $url . '" '.$color_or.$hover_color_override.$hover_text_color_override.'><span class="start loading">' . $text . $button_icon. '</span><span class="hover">' . $text . $button_icon. '</span></a>'. $button_close_tag;
		else
			return $button_open_tag . ' href="' . $url . '" '.$color_or.$hover_color_override.$hover_text_color_override.'><span>' . $text . '</span>'. $button_icon . '</a>'. $button_close_tag;
	

    	
	}
	else {

		$color = (!empty($color_override)) ? $color_override : '#ffffff';
		$border = ($size != 'jumbo') ? 8 : 10;
		if($size =='extra_jumbo') $border = 20;
		return '
		<div class="nectar-3d-transparent-button" data-size="'.$size.'">
		     <a href="'.$url.'"><span class="hidden-text">'.$text.'</span>
			<div class="inner-wrap">
				<div class="front-3d">
					<svg>
						<defs>
							<mask>
								<rect width="100%" height="100%" fill="#ffffff"></rect>
								<text class="mask-text button-text" fill="#000000" width="100%" text-anchor="middle">'.$text.'</text>
							</mask>
						</defs>
						<rect id="" fill="'.$color.'" width="100%" height="100%" ></rect>
					</svg>
				</div>
				<div class="back-3d">
					<svg>
						<rect stroke="'.$color.'" stroke-width="'.$border.'" fill="transparent" width="100%" height="100%"></rect>
						<text class="button-text" fill="'.$color.'" text-anchor="middle">'.$text.'</text>
					</svg>
				</div>
			</div>
			</a>
		</div>
		';
}
}
add_shortcode('button', 'nectar_button');



//icon
function nectar_icon($atts, $content = null) {
	extract(shortcode_atts(array("size" => 'large', 'color' => 'Accent-Color', 'image' => 'icon-circle', 'icon_size' => '64', 'enable_animation' => 'false', 'animation_delay' => '0', 'animation_speed' => 'medium'), $atts)); 
	
	if($size == 'large-2') {
		$size_class = 'icon-3x alt-style';
	} 
	else if($size == 'large') {
		$size_class = 'icon-3x';
	}
	else if($size == 'regular') {
		$size_class = 'icon-default-style';
	}  
	else if($size == 'tiny') {
		$size_class = 'icon-tiny';
	}
	else {
		$size_class = 'icon-normal'; 
	}
	
	($size == 'large') ? $border = '<i class="circle-border"></i>' : $border = ''; 
	
	if(strpos($image,'.svg') !== false) {

		//gradient loads from font family
		if(strtolower($color) == 'extra-color-gradient-1' || strtolower($color) == 'extra-color-gradient-2') {
			$converted_class = str_replace('_', '-', $image);
			$converted_class = str_replace('.svg', '', $converted_class);
			return '<i class="icon-'.$converted_class.'" data-color="'.strtolower($color).'" style="font-size: '.$icon_size.'px;"></i>';
		}
		//non gradient uses svg
		else {
			if(strtolower($animation_speed) == 'slow') $animation_speed_time = 200;
			if(strtolower($animation_speed) == 'medium') $animation_speed_time = 150;
			if(strtolower($animation_speed) == 'fast') $animation_speed_time = 65;

			$svg_icon = '<div class="svg-icon-holder" data-size="'. $icon_size . '" data-animation-speed="'.$animation_speed_time.'" data-animation="'.$enable_animation.'" data-animation-delay="'.$animation_delay.'" data-color="'.strtolower($color) .'"><span>'. get_template_directory_uri() . '/css/fonts/svg/' . $image .'</span></div>';
			return $svg_icon;
		} 
	}
	else {
		return '<i class="'. $size_class . ' ' . $image . ' ' . strtolower($color) .'">' . $border . '</i>';
	}
    
}
add_shortcode('icon', 'nectar_icon');



//bar graph - must remain for legacy users
function nectar_bar_graph($atts, $content = null) {  
    return do_shortcode($content);
}
add_shortcode('bar_graph', 'nectar_bar_graph');


function nectar_bar($atts, $content = null) {
	extract(shortcode_atts(array("title" => 'Title', "percent" => '1', 'color' => 'Accent-Color', 'id' => ''), $atts));  
	$bar = '
	<div class="nectar-progress-bar">
		<p>' . $title . '</p>
		<div class="bar-wrap"><span class="'.strtolower($color).'" data-width="' . $percent . '"> <strong><i>' . $percent . '</i>%</strong> </span></div>
	</div>';
    return $bar;
}
add_shortcode('bar', 'nectar_bar');



//Team Member
function nectar_team_member($atts, $content = null) {
	
    extract(shortcode_atts(array("description" => '', 'team_memeber_style' => '', 'color' => 'Accent-Color', 'name' => 'Name', 'job_position' => 'Job Position', 'image_url' => '', 'social' => '', 'link_element' => 'none', 'link_url' => '', 'link_url_2' => ''), $atts));
		
	$html = null;
			
	$html .= '<div class="team-member" data-style="'.$team_memeber_style.'">';
	
	if($team_memeber_style == 'meta_overlaid' || $team_memeber_style == 'meta_overlaid_alt'){
		
		$html .= '<div class="team-member-overlay"></div>';
		
		if(!empty($image_url)){
				
				if(preg_match('/^\d+$/',$image_url)){
					$image_src = wp_get_attachment_image_src($image_url, 'portfolio-thumb');
					$image_url = $image_src[0];
				}
				
				//image link
				if(!empty($link_url_2)){
					$html .= '<a href="'.$link_url_2.'"></a> <div class="team-member-image" style="background-image: url('.$image_url.');"></div>';
				} else {
					$html .= '<div class="team-member-image" style="background-image: url('.$image_url.');"></div>';
				}
				
			}
			else {
				//image link
				if(!empty($link_url_2)){
					$html .= '<a href="'.$link_url_2.'"></a><div class="team-member-image" style="background-image: url('. NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/team-member-default.jpg);"></div>';
				} else {
					$html .= '<div class="team-member-image" style="background-image: url('. NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/team-member-default.jpg);"></div>';
				}
		
			}
			
			//name link
			$html .= '<div class="team-meta">';
				$html .= '<h3>' . $name . '</h3>';
				$html .= '<p>' . $job_position . '<p>';
			$html .= '</div>';
			
	} else {
		
		if(!empty($image_url)){
			
			if(preg_match('/^\d+$/',$image_url)){
				$image_src = wp_get_attachment_image_src($image_url, 'full');
				$image_url = $image_src[0];
			}
			
			//image link
			if($link_element == 'image' || $link_element == 'both'){
				$html .= '<a href="'.$link_url.'"><img alt="'.$name.'" src="' . $image_url .'" title="' . $name . '" /></a>';
			} else {
				$html .= '<img alt="'.$name.'" src="' . $image_url .'" title="' . $name . '" />';
			}
			
		}
		else {
			//image link
			if($link_element == 'image' || $link_element == 'both'){
				$html .= '<a href="'.$link_url.'"><img alt="'.$name.'" src="' . NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/team-member-default.jpg" title="' . $name . '" /></a>';
			} else {
				$html .= '<img alt="'.$name.'" src="' . NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/team-member-default.jpg" title="' . $name . '" />';
			}
	
		}
		
		//name link
		if($link_element == 'name' || $link_element == 'both'){
			$html .= '<h4 class="light"><a class="'.strtolower($color).'" href="'.$link_url.'">' . $name . '</a></h4>';
		} else {
			$html .= '<h4 class="light">' . $name . '</h4>';
		}
	
		$html .= '<div class="position">' . $job_position . '</div>';
		$html .= '<p class="description">' . $description . '</p>';
		
		if (!empty($social)) {
			
	         $social_arr = explode(",", $social);
			 
			 $html .= '<ul class="social '.strtolower($color).'">';
	         for ($i = 0 ; $i < count($social_arr) ; $i = $i + 2) {
	         		
					$target = null;
	         	    $url_host = parse_url($social_arr[$i + 1], PHP_URL_HOST);
				    $base_url_host = parse_url(get_template_directory_uri(), PHP_URL_HOST);
				    if($url_host != $base_url_host || empty($url_host)) {
				    	$target = 'target="_blank"';
				    }
					
	               $html .=  "<li><a ".$target." href='" . $social_arr[$i + 1] . "'>" . $social_arr[$i] . "</a></li>";   
	         }
			 $html .= '</ul>';
	     }
		
     }
	
	$html .= '</div>';
	
	return str_replace("\r\n", '', $html);
	 
}
add_shortcode('team_member', 'nectar_team_member');



//carousel
function nectar_carousel($atts, $content = null) {  
    extract(shortcode_atts(array("carousel_title" => 'Title', "scroll_speed" => 'medium', 'easing' => 'easeInExpo'), $atts));
	
	$carousel_html = null;
	$carousel_html .= '
	<div class="carousel-wrap" data-full-width="false">
	<div class="carousel-heading">
		<div class="container">
			<h2 class="uppercase">'. $carousel_title .'</h2>
				<div class="control-wrap">
					<a class="carousel-prev" href="#"><i class="icon-angle-left"></i></a>
					<a class="carousel-next" href="#"><i class="icon-angle-right"></i></a>
				</div>
		</div>
	</div>
	</span><ul class="row carousel" data-scroll-speed="' . $scroll_speed . '" data-easing="' . $easing . '">';
	
    return $carousel_html . do_shortcode($content) . '</ul></div>';
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode('carousel', 'nectar_carousel');
}

function nectar_carousel_item($atts, $content = null) {  
    return '<li class="col span_4">' . do_shortcode($content) . '</li>';
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode('item', 'nectar_carousel_item');
}


//clients
function nectar_clients($atts, $content = null) {  
    extract(shortcode_atts(array("carousel" => "false", "fade_in_animation" => "false", "columns" => '4'), $atts));
	
	$opening = null;
	$closing = null;
	$column_class = null;
	
	switch ($columns) {
		case '2' :
			$column_class = 'two-cols';
			break;
		case '3' :
			$column_class = 'three-cols';
			break;
		case '4' :
			$column_class = 'four-cols';
			break;	
		case '5' :
			$column_class = 'five-cols';
			break;
		case '6' :
			$column_class = 'six-cols';
			break;
	}
	
	($fade_in_animation == "true") ? $animation = 'fade-in-animation' : $animation = null ;
	
	if($carousel == "true"){
		$opening .= '<div class="carousel-wrap"><div class="row carousel clients '.$column_class.' ' .$animation.'" data-max="'.$columns.'">';
		$closing .= '</div></div>';
	}
	else{
		$opening .= '<div class="clients no-carousel '.$column_class.' ' .$animation.'">';
		$closing .= '</div>';
	}
	
    return $opening . do_shortcode($content) . $closing;
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode('clients', 'nectar_clients');
}

function nectar_client($atts, $content = null) {
	extract(shortcode_atts(array("image" => "", "url" => '#', "alt" => ""), $atts));
	$client_content = null;
	$image_dimensions = null;
	
	if(preg_match('/^\d+$/',$image)){
		$image_src = wp_get_attachment_image_src($image, 'full');
		$image = $image_src[0];
		$image_dimensions = 'width="'.$image_src[1].'" height="'.$image_src[2].'"';
	}

	(!empty($alt)) ? $alt_tag = $alt : $alt_tag = 'client';
	if(!empty($url) && $url != 'none'){
		$client_content = '<div><a href="'.$url.'" target="_blank"><img src="'.$image.'" '.$image_dimensions.' alt="'.$alt_tag.'" /></a></div>';
	}  
	else {
		$client_content = '<div><img src="'.$image.'" '.$image_dimensions.' alt="'.$alt_tag.'" /></div>';
	}
    return $client_content;
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode('client', 'nectar_client');
}



//pricing tables
function nectar_pricing_table($atts, $content = null) {  
    extract(shortcode_atts(array("columns" => '4', "style" => "default"), $atts));
	$column_class = null;
	
	switch ($columns) {
		case '2' :
			$column_class = 'two-cols';
			break;
		case '3' :
			$column_class = 'three-cols';
			break;
		case '4' :
			$column_class = 'four-cols';
			break;	
		case '5' :
			$column_class = 'five-cols';
			break;
	}
	
    return '<div class="row pricing-table '.$column_class.'" data-style="'.$style.'">' . do_shortcode($content) . '</div>';
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode('pricing_table', 'nectar_pricing_table');
}

function nectar_pricing_column($atts, $content = null) {
	extract(shortcode_atts(array("title"=>'Column title', "highlight" => 'false', "highlight_reason" => 'Most Popular', 'color' => 'Accent-Color', "price" => "99", "currency_symbol" => '$', "interval" => 'Per Month'), $atts));
	
	$highlight_class = null;
	$hightlight_reason_html = null;
	
	if($highlight == 'true') {
		$highlight_class = 'highlight ' . strtolower($color); 
		$hightlight_reason_html = '<span class="highlight-reason">'.$highlight_reason.'</span>';
	}
	
    return '<div class="pricing-column '.$highlight_class.'">
  			<h3>'.$title. $hightlight_reason_html .'</h3>
            <div class="pricing-column-content">
				<h4> <span class="dollar-sign">'.$currency_symbol.'</span>'.$price.' </h4>
				<span class="interval">'.$interval.'</span>' . do_shortcode($content) . '</div></div>';
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode('pricing_column', 'nectar_pricing_column');
}



//tabbed sections
function nectar_tabs($atts, $content = null) {
    $GLOBALS['tab_count'] = 0;
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['tabs'] ) ){
		
		foreach( $GLOBALS['tabs'] as $tab ){
			$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
			$panes[] = '<div id="'.$tab['id'].'">'.$tab['content'].'</div>';
		}
		
		$return = '<div class="tabbed vc_clearfix"><ul>'.implode( "\n", $tabs ).'</ul>'.implode( "\n", $panes )."</div>\n";
	}
	return $return;
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode('tabbed_section', 'nectar_tabs');
}

function nectar_tab( $atts, $content ){
	extract(shortcode_atts(array( 'title' => '%d', 'id' => '%d'), $atts));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array(
		'title' => sprintf( $title, $GLOBALS['tab_count'] ),
		'content' =>  do_shortcode($content),
		'id' =>  $id );
	
	$GLOBALS['tab_count']++;
}
if (!class_exists('WPBakeryVisualComposerAbstract') || class_exists('WPBakeryVisualComposerAbstract') && !defined('SALIENT_VC_ACTIVE')) {
	add_shortcode( 'tab', 'nectar_tab' );
}

//toggle panel - accordion chosen
function nectar_toggles($atts, $content = null) { 
	extract(shortcode_atts(array("accordion" => 'false', 'style' => 'default'), $atts));  
	
	($accordion == 'true') ? $accordion_class = 'accordion': $accordion_class = null ;
    return '<div class="toggles '.$accordion_class.'" data-style="'.$style.'">' . do_shortcode($content) . '</div>'; 
}
add_shortcode('toggles', 'nectar_toggles');

//toggle
function nectar_toggle($atts, $content = null) {
	extract(shortcode_atts(array("title" => 'Title', 'color' => 'Accent-Color'), $atts));  
    return '<div class="toggle '.strtolower($color).'"><h3><a href="#"><i class="icon-plus-sign"></i>'. $title .'</a></h3><div>' . do_shortcode($content) . '</div></div>';
}
add_shortcode('toggle', 'nectar_toggle');



 



#-----------------------------------------------------------------#
# Nectar Slider 
#-----------------------------------------------------------------# 
function nectar_slider_processing($atts, $content = null) {
	
	extract(shortcode_atts(array("arrow_navigation" => 'false', "autorotate"=> '', "tablet_header_font_size" => "auto", "tablet_caption_font_size" => "auto", "phone_header_font_size" => "auto", "phone_caption_font_size" => "auto", "button_sizing"=> 'regular', "slider_button_styling"=> 'btn_with_count', "overall_style" => 'classic', "slider_transition"=> 'swipe', "flexible_slider_height"=> '', "min_slider_height"=> '', "loop" => 'false', 'fullscreen' => 'false', "bullet_navigation" => 'false', "bullet_navigation_style" => 'see_through', "parallax" => 'false', "full_width" => '', "slider_height" => '650', "desktop_swipe" => 'false', "location" => ''), $atts));   
    
    if($overall_style == 'directional') $desktop_swipe = 'false';

	$slider_config = array(
	  'slider_height' => $slider_height,
	  'full_width' => $full_width,
	  'flexible_slider_height' => $flexible_slider_height,
	  'min_slider_height' => $min_slider_height,
	  'autorotate' => $autorotate,
	  'arrow_navigation' => $arrow_navigation,
	  'bullet_navigation' => $bullet_navigation,
	  'bullet_navigation_style' => $bullet_navigation_style,
	  'desktop_swipe' => $desktop_swipe,
	  'parallax' => $parallax,
	  'slider_transition' => $slider_transition,
	  'overall_style' => $overall_style,
	  'slider_button_styling' => $slider_button_styling,
	  'loop' => $loop,
	  'fullscreen' => $fullscreen,
	  'button_sizing' => $button_sizing,
	  'location' => $location,
	  "tablet_header_font_size" => $tablet_header_font_size,
	  "tablet_caption_font_size" => $tablet_caption_font_size,
	  "phone_header_font_size" => $phone_header_font_size,
	  "phone_caption_font_size" => $phone_caption_font_size
	);
	 
	return do_shortcode(nectar_slider_display($slider_config));
}

add_shortcode('nectar_slider', 'nectar_slider_processing');



#-----------------------------------------------------------------#
# Social Buttons
#-----------------------------------------------------------------# 
function nectar_social_buttons($atts, $content = null) {
	extract(shortcode_atts(array("full_width_icons" => "", "hide_share_count" => "true", "nectar_love" => 'false', "facebook" => 'false', "twitter" => 'false', "google_plus" => 'false', "linkedin" => 'false', "nectar-love" => 'false', "pinterest" => 'false'), $atts));  
    
	$fw_class = ($full_width_icons == 'true') ? ' full-width' : null;
	$hide_share_count_class = ( $hide_share_count == 'true') ? ' hide-share-count' : null;
	
	$fw_items = 0;
	if($nectar_love == 'true') $fw_items += 1;
	if($facebook == 'true') $fw_items += 1;
	if($twitter == 'true') $fw_items += 1;
	if($google_plus == 'true') $fw_items += 1;
	if($linkedin == 'true') $fw_items += 1;
	if($pinterest == 'true') $fw_items += 1;
	
	global $post;
	
	$buttons = '<div class="nectar-social '. $hide_share_count_class . $fw_class.' items_'.$fw_items.'">';
	
    if($nectar_love == 'true'){
		$buttons .= '<span class="n-shortcode">'.nectar_love('return').'</span>';
    }
	
	if($facebook == 'true'){
    	$buttons .= "<a class='facebook-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-facebook'></i> <span class='count'></span></a>";
    }
	
	if($twitter == 'true'){
    	$buttons .= "<a class='twitter-share nectar-sharing' href='#' title='".__('Tweet this', NECTAR_THEME_NAME)."'> <i class='icon-twitter'></i> <span class='count'></span></a>";
    }

	if($google_plus == 'true'){
    	$buttons .= "<a class='google-plus-share nectar-sharing-alt' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-google-plus'></i> <span class='count'> ".GetGooglePlusShares(get_permalink($post->ID))." </span></a>";
    }
	
	if($linkedin == 'true'){
    	$buttons .= "<a class='linkedin-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-linkedin'></i> <span class='count'></span></a>";
    }
	
	if($pinterest == 'true'){
    	$buttons .= "<a class='pinterest-share nectar-sharing' href='#' title='".__('Pin this', NECTAR_THEME_NAME)."'> <i class='icon-pinterest'></i> <span class='count'></span></a>";
    }
	
	$buttons .= '</div>';
	
    return $buttons;
}
add_shortcode('social_buttons', 'nectar_social_buttons');


#-----------------------------------------------------------------#
# Portfolio/Blog
#-----------------------------------------------------------------# 


//Portfolio
function nectar_portfolio_processing($atts, $content = null) {
	extract(shortcode_atts(array("layout" => '3', 'category' => 'all', 'project_style' => '1', 'load_in_animation' => 'none','starting_category' => '', 'filter_color' => 'default' ,'masonry_style' => '0', 'enable_sortable' => '0', 'pagination_type' => '', 'constrain_max_cols' => 'false', 'remove_column_padding' => 'false', 'horizontal_filters' => '0','lightbox_only' => '0', 'enable_pagination' => '0', 'projects_per_page' => '-1'), $atts));   
	
	global $post;
	global $options;
	
	//calculate cols
	switch($layout){
		case '3':
			$cols = 'cols-3';
			break; 
		case '4':
			$cols = 'cols-4';
			break; 
		case 'fullwidth':
			$cols = 'elastic';
			break; 
	}
		
	switch($cols){
		case 'cols-3':
			$span_num = 'span_4';
			break; 
		case 'cols-4':
			$span_num = 'span_3';
			break; 
		case 'elastic':
			$span_num = 'elastic-portfolio-item';
			break; 
			
	}
		
	if($masonry_style == 'true' && $project_style == '6' && $layout != 'fullwidth') $masonry_style = 'false';

	$masonry_layout = ($masonry_style == 'true') ? 'true' : 'false';
	$constrain_col_class = (!empty($constrain_max_cols) && $constrain_max_cols == 'true') ? ' constrain-max-cols' : null ;
	$infinite_scroll_class = null;

	//disable masonry for default project style fullwidtrh
	if($project_style == '1' && $cols == 'elastic') $masonry_layout = 'false';
	
	$filters_id = ($horizontal_filters == 'true') ? 'portfolio-filters-inline' : 'portfolio-filters';
	
	if($pagination_type == 'infinite_scroll' && $enable_pagination == 'true') {
		$infinite_scroll_class = ' infinite_scroll';
	}

	ob_start(); 
	
	if( $enable_sortable == 'true' && $horizontal_filters == 'true') {

		$filters_width = (!empty($options['header-fullwidth']) && $options['header-fullwidth'] == '1' && $cols == 'elastic') ? 'full-width-content ': 'full-width-section ';

	 	?>
		<div class="<?php echo $filters_id . ' '; echo $filters_width; if($span_num != 'elastic-portfolio-item') echo 'non-fw'; ?>" data-color-scheme="<?php echo strtolower($filter_color); ?>">
			<div class="container">
				<span id="current-category"><?php echo __('All', NECTAR_THEME_NAME); ?></span>
				<ul>
				   <li id="sort-label"><?php echo (!empty($options['portfolio-sortable-text'])) ? $options['portfolio-sortable-text'] : __('Sort Portfolio',NECTAR_THEME_NAME); ?>:</li>
				   <li><a href="#" data-filter="*"><?php echo __('All', NECTAR_THEME_NAME); ?></a></li>
               	   <?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'project-type', 'show_option_none'   => '', 'walker' => new Walker_Portfolio_Filter())); ?>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
	<?php } else if($enable_sortable == 'true' && $horizontal_filters != 'true') { ?>
		<div class="<?php echo $filters_id;?>" data-color-scheme="<?php echo strtolower($filter_color); ?>">
			<a href="#" data-sortable-label="<?php echo (!empty($options['portfolio-sortable-text'])) ? $options['portfolio-sortable-text'] :'Sort Portfolio'; ?>" id="sort-portfolio"><span><?php echo (!empty($options['portfolio-sortable-text'])) ? $options['portfolio-sortable-text'] : __('Sort Portfolio',NECTAR_THEME_NAME); ?></span> <i class="icon-angle-down"></i></a> 
			<ul>
			   <li><a href="#" data-filter="*"><?php echo __('All', NECTAR_THEME_NAME); ?></a></li>
           	   <?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'project-type', 'show_option_none'   => '', 'walker' => new Walker_Portfolio_Filter())); ?>
			</ul>
		</div>
		<div class="clear portfolio-filter-clear"></div>
	<?php } ?>
	
	


	<div class="portfolio-wrap <?php if($project_style == '1' && $span_num == 'elastic-portfolio-item') echo 'default-style '; if($project_style == '6' && $span_num == 'elastic-portfolio-item') echo 'spaced'; ?>">
			
			<?php 
			$default_loader_class = (empty($options['loading-image']) && !empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') ? 'default-loader' : null; 
			$default_loader = (empty($options['loading-image']) && !empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') ? '<span class="default-loading-icon spin"></span>' : null;?>

			<span class="portfolio-loading <?php echo $default_loader_class; ?> <?php echo (!empty($options['loading-image-animation']) && !empty($options['loading-image'])) ? $options['loading-image-animation'] : null; ?>">  <?php echo $default_loader; ?> </span>

			
			<?php 
			//incase only all was selected
			if($category == 'all') {
				$category = null;
			}

		
			?>
			
			<div class="row portfolio-items <?php if($masonry_layout == 'true') echo 'masonry-items'; else { echo 'no-masonry'; } ?> <?php echo $infinite_scroll_class; ?> <?php echo $constrain_col_class; ?>" <?php if($layout != 'fullwidth') echo 'data-rcp="'.$remove_column_padding.'"'; ?> data-ps="<?php echo $project_style; ?>" data-starting-filter="<?php echo $starting_category; ?>" data-categories-to-show="<?php echo $category; ?>" data-col-num="<?php echo $cols; ?>">
				<?php 
				

				$posts_per_page = (!empty($projects_per_page)) ? $projects_per_page : '-1';

				if ( get_query_var('paged') ) {
				  $paged = get_query_var('paged');
				} elseif ( get_query_var('page') ) {
				  $paged = get_query_var('page');
				} else {
				  $paged = 1;
				}
	
				$portfolio_arr = array(
					'posts_per_page' => $posts_per_page,
					'post_type' => 'portfolio',
					'project-type'=> $category,
					'paged'=> $paged
				);
				
				query_posts($portfolio_arr);

 				if(have_posts()) : while(have_posts()) : the_post(); ?>
					
					<?php 
						
					   $terms = get_the_terms($post->id,"project-type");
					   $project_cats = NULL;
					   
					   if ( !empty($terms) ){
					      foreach ( $terms as $term ) {
					        $project_cats .= strtolower($term->slug) . ' ';
					      }
					   }
					  

					  global $post;

					  $masonry_item_sizing = ($masonry_layout == 'true') ? get_post_meta($post->ID, '_portfolio_item_masonry_sizing', true) : null;
	                  if(empty($masonry_item_sizing) && $masonry_layout == 'true') $masonry_item_sizing = 'regular';
					  
					  $masonry_item_content_pos = get_post_meta($post->ID, '_portfolio_item_masonry_content_pos', true);
					  if(empty($masonry_item_content_pos)) $masonry_item_content_pos = 'middle';

					  $custom_project_link = get_post_meta($post->ID, '_nectar_external_project_url', true);
					  $the_project_link = (!empty($custom_project_link)) ? $custom_project_link : get_permalink();
					  
					  $project_excerpt = get_post_meta($post->ID, '_nectar_project_excerpt', true);
					  $project_image_caption = get_post(get_post_thumbnail_id())->post_content;
					  $project_image_caption = strip_tags($project_image_caption);
					  
					  $project_accent_color = get_post_meta($post->ID, '_nectar_project_accent_color', true);
					  $project_title_color = get_post_meta($post->ID, '_nectar_project_title_color', true);
					  $project_subtitle_color = get_post_meta($post->ID, '_nectar_project_subtitle_color', true);

					?>
					
					<div class="col <?php echo $span_num . ' '. $masonry_item_sizing; ?> element <?php echo $project_cats; ?>"  data-project-cat="<?php echo $project_cats; ?>" <?php if(!empty($project_accent_color)) { echo 'data-project-color="' . $project_accent_color .'"'; } else { echo 'data-default-color="true"';} ?> data-title-color="<?php echo $project_title_color; ?>" data-subtitle-color="<?php echo $project_subtitle_color; ?>">
						
						<div class="inner-wrap animated" data-animation="<?php echo $load_in_animation; ?>">

						<?php //project style 1
							
							if($project_style == '1') { 

							$using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
							$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true); ?>
								
							<div class="work-item style-1" data-custom-content="<?php echo $using_custom_content; ?>">
								 
								<?php
				 				
				 				$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
								
								//custom thumbnail
								$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
								
								if( !empty($custom_thumbnail) ){
									echo '<img class="custom-thumbnail" src="'.nectar_ssl_check($custom_thumbnail).'" alt="'. get_the_title() .'" />';
								}
								else {
									
									if ( has_post_thumbnail() ) {
										 echo get_the_post_thumbnail($post->ID, $thumb_size, array('title' => '')); 
									} 
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}
										 echo '<img src="'.get_template_directory_uri().'/img/'.$no_image_size.'" alt="no image added yet." />';
									 }   
									
								} ?>
								
								<div class="work-info-bg"></div>
								<div class="work-info"> 
									
									<?php
									//custom content
									if($using_custom_content == 'on') {
										if(!empty($custom_project_link)) echo '<a href="'.$the_project_link.'"></a>';
										echo '<div class="vert-center"><div class="custom-content">' . do_shortcode($custom_content) . '</div></div></div></div>';
									//default
									} else { ?>

										<div class="vert-center">
											<?php 
											
											$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  							
											$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
											$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
											
											//video 
										    if( !empty($video_embed) || !empty($video_m4v) ) {
				
											    if( !empty( $video_embed) && floatval(get_bloginfo('version')) < "3.6") {
											    	
											    	echo '<a href="#video-popup-'.$post->ID.'" class="pretty_photo default-link">'.__("Watch Video", NECTAR_THEME_NAME).'</a> ';
													echo '<div id="video-popup-'.$post->ID.'">';
											        echo '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
													echo '</div>';
											    } 
											    
											    else {
													 echo '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo default-link" >'.__("Watch Video", NECTAR_THEME_NAME).'</a> ';	 
											     }
					
									        } 
											
											//image
										    else {

										       echo '<a href="'. $featured_image[0].'"'; 
										       if(!empty($project_image_caption)) echo 'title="'.$project_image_caption.'"';
										       echo 'class="pretty_photo default-link">'.__("View Larger", NECTAR_THEME_NAME).'</a> ';
										    }
											
											if($lightbox_only != 'true') {
										    	echo '<a class="default-link" href="' . $the_project_link . '">'.__("More Details", NECTAR_THEME_NAME).'</a>'; 
										    } ?>
										    
										</div><!--/vert-center-->
									</div>
								</div><!--work-item-->
								
								<div class="work-meta">
									<h4 class="title"><?php the_title(); ?></h4>
									
									<?php if(!empty($project_excerpt)) { echo '<p>'.$project_excerpt.'</p>'; } elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; ?>
									
								</div>
								<div class="nectar-love-wrap">
									<?php if( function_exists('nectar_love') ) nectar_love(); ?>
								</div><!--/nectar-love-wrap-->	

							<?php } 
						
						  } //project style 1 
						
						
						//project style 2
						else if($project_style == '2') { 

							$using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
							$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true); ?>
							
							<div class="work-item style-2" data-custom-content="<?php echo $using_custom_content; ?>">
								
								<?php
								$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
								
								//custom thumbnail
								$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
								
								if( !empty($custom_thumbnail) ){
									echo '<img class="custom-thumbnail" src="'.nectar_ssl_check($custom_thumbnail).'" alt="'. get_the_title() .'" />';
								}
								else {
									
									if ( has_post_thumbnail() ) {
										 echo get_the_post_thumbnail($post->ID, $thumb_size, array('title' => '')); 
									} 
									
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}
										 echo '<img src="'.get_template_directory_uri().'/img/'.$no_image_size.'" alt="no image added yet." />';
									 }   
									
								} ?>
				
								<div class="work-info-bg"></div>
								<div class="work-info">
									
									<?php
									//custom content
									if($using_custom_content == 'on') {
										if(!empty($custom_project_link)) echo '<a href="'.$the_project_link.'"></a>';
									//default
									} else { ?>

										
										<?php if($lightbox_only != 'true') { ?>
											
											<a href="<?php echo $the_project_link; ?>"></a>
										
										<?php } else {
											 
											$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  							
											$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
											$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
											
											//video 
										    if( !empty($video_embed) || !empty($video_m4v) ) {
				
											    if( !empty( $video_embed) && floatval(get_bloginfo('version')) < "3.6") {
											    	
											    	echo '<a href="#video-popup-'.$post->ID.'" class="pretty_photo"></a> ';
													echo '<div id="video-popup-'.$post->ID.'">';
											        echo '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
													echo '</div>';
											    } 
											    
											    else {
													 echo '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo" ></a> ';	 
											     }
					
									        } else { ?>
									        	
									        	<a href="<?php echo $featured_image[0]; ?>" <?php if(!empty($project_image_caption)) echo ' title="'.$project_image_caption.'" '; ?> class="pretty_photo"></a>
									        	
									        <?php  } 

											  }

										 } ?>
									
		
									<div class="vert-center">
										<?php 
										if(!empty($using_custom_content) && $using_custom_content == 'on') {
											echo '<div class="custom-content">' . do_shortcode($custom_content) . '</div>';
										} else { ?>	
											<h3><?php echo get_the_title(); ?></h3> 
											<?php if(!empty($project_excerpt)) { echo '<p>'.$project_excerpt.'</p>'; } elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; 
										} ?>
									</div><!--/vert-center-->
									
								</div>
							</div><!--work-item-->
							
						<?php } //project style 2 
						
												
						
						else if($project_style == '3') { 

							$using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
							$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true); ?>
							
							<div class="work-item style-3" data-custom-content="<?php echo $using_custom_content; ?>" data-text-align="<?php echo $masonry_item_content_pos; ?>">
								
								<?php
								$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';

								//custom thumbnail
								$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
								
								if( !empty($custom_thumbnail) ){
									echo '<img class="custom-thumbnail" src="'.nectar_ssl_check($custom_thumbnail).'" alt="'. get_the_title() .'" />';
								}
								else {
									
									if ( has_post_thumbnail() ) {
										 echo get_the_post_thumbnail($post->ID, $thumb_size, array('title' => '')); 
									} 
									
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}
										 echo '<img src="'.get_template_directory_uri().'/img/'.$no_image_size.'" class="no-img" alt="no image added yet." />';
									 }   
									
								} ?>
				
								<div class="work-info-bg"></div>
								<div class="work-info">
									
									<?php
									//custom content
									if($using_custom_content == 'on') {
										if(!empty($custom_project_link)) echo '<a href="'.$the_project_link.'"></a>';
									//default
									} else {

										 if($lightbox_only != 'true') { ?>
											
											<a href="<?php echo $the_project_link; ?>"></a>
										
										<?php } else {
											 
											$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  							
											$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
											$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
											
											//video 
										    if( !empty($video_embed) || !empty($video_m4v) ) {
				
											    if( !empty( $video_embed) && floatval(get_bloginfo('version')) < "3.6") {
											    	
											    	echo '<a href="#video-popup-'.$post->ID.'" class="pretty_photo"></a> ';
													echo '<div id="video-popup-'.$post->ID.'">';
											        echo '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
													echo '</div>';
											    } 
											    
											    else {
													 echo '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo" ></a> ';	 
											     }
					
									        } else { ?>
									        	
									        	<a href="<?php echo $featured_image[0]; ?>"  <?php if(!empty($project_image_caption)) echo ' title="'.$project_image_caption.'" '; ?> class="pretty_photo"></a>
									        	
									        <?php  } ?>

											
										<?php } 

									} ?>
									
				
									<div class="vert-center">
										<?php 
										if(!empty($using_custom_content) && $using_custom_content == 'on') {
											echo '<div class="custom-content">' . do_shortcode($custom_content) . '</div>';
										} else { ?>	
											<h3><?php echo get_the_title(); ?> </h3> 
											<?php if(!empty($project_excerpt)) { echo '<p>'.$project_excerpt.'</p>'; } elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; ?>
										<?php } ?>
									</div><!--/vert-center-->
									
								</div>
							</div><!--work-item-->
							
						<?php } //project style 3 
						
						
						else if($project_style == '4') { 
							
							$using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
							$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true); ?>

							<div class="work-item style-4" data-custom-content="<?php echo $using_custom_content; ?>">
								
								<?php
								$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
								
								//custom thumbnail
								$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
								
								if( !empty($custom_thumbnail) ){
									echo '<img class="custom-thumbnail" src="'.nectar_ssl_check($custom_thumbnail).'" alt="'. get_the_title() .'" />';
								}
								else {
									
									if ( has_post_thumbnail() ) {
										 echo get_the_post_thumbnail($post->ID, $thumb_size, array('title' => '')); 
									} 
									
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}
										 echo '<img src="'.get_template_directory_uri().'/img/'.$no_image_size.'" class="no-img" alt="no image added yet." />';
									 }   
									
								} 

								if(!empty($using_custom_content) && $using_custom_content == 'on' && !empty($project_accent_color)) echo '<div class="work-info-bg"></div>'; ?>

								<div class="work-info">
									
									<?php

									//custom content
									if($using_custom_content == 'on') {
										if(!empty($custom_project_link)) echo '<a href="'.$the_project_link.'"></a>';
									//default
									} else {

										 if($lightbox_only != 'true') { ?>
											
											<a href="<?php echo $the_project_link; ?>"></a>
										
										<?php } else {
											 
											$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  							
											$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
											$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
											
											//video 
										    if( !empty($video_embed) || !empty($video_m4v) ) {
				
											    if( !empty( $video_embed) && floatval(get_bloginfo('version')) < "3.6") {
											    	
											    	echo '<a href="#video-popup-'.$post->ID.'" class="pretty_photo"></a> ';
													echo '<div id="video-popup-'.$post->ID.'">';
											        echo '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
													echo '</div>';
											    } 
											    
											    else {
													 echo '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo" ></a> ';	 
											     }
					
									        } else { ?>
									        	
									        	<a href="<?php echo $featured_image[0]; ?>" <?php if(!empty($project_image_caption)) echo ' title="'.$project_image_caption.'" '; ?> class="pretty_photo"></a>
									        	
									        <?php  } 

											 }

										} 
									
									    if(!empty($using_custom_content) && $using_custom_content == 'on') {
											echo '<div class="vert-center"><div class="custom-content">' . do_shortcode($custom_content) . '</div></div>';
										} else { ?>	

										<div class="bottom-meta">
											<h3><?php echo get_the_title(); ?> </h3> 
											<?php if(!empty($project_excerpt)) { echo '<p>'.$project_excerpt.'</p>'; } elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; ?>
										</div><!--/bottom-meta-->

									<?php } ?>
									
								</div>
							</div><!--work-item-->
							
						<?php } //project style 4 

						else if($project_style == '5') { 

							$using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
							$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true); ?>
							
							<div class="work-item style-3-alt" data-custom-content="<?php echo $using_custom_content; ?>" data-text-align="<?php echo $masonry_item_content_pos; ?>">
								
								<?php
								$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
								
								//custom thumbnail
								$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
								
								if( !empty($custom_thumbnail) ){
									echo '<img class="custom-thumbnail" src="'.nectar_ssl_check($custom_thumbnail).'" alt="'. get_the_title() .'" />';
								}
								else {
									
									if ( has_post_thumbnail() ) {
										 echo get_the_post_thumbnail($post->ID, $thumb_size, array('title' => '')); 
									} 
									
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}
										 echo '<img src="'.get_template_directory_uri().'/img/'.$no_image_size.'" class="no-img" alt="'.get_the_title().'" />';
									 }   
									
								} ?>

								<div class="work-info-bg"></div>
								<div class="work-info">
									
									<?php 

									//custom content
									if($using_custom_content == 'on') {
										if(!empty($custom_project_link)) echo '<a href="'.$the_project_link.'"></a>';
									//default
									} else {

										if($lightbox_only != 'true') { ?>
											
											<a href="<?php echo $the_project_link; ?>"></a>
										
										<?php } else {
											 
											$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  							
											$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
											$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
											
											//video 
										    if( !empty($video_embed) || !empty($video_m4v) ) {
				
											    if( !empty( $video_embed) && floatval(get_bloginfo('version')) < "3.6") {
											    	
											    	echo '<a href="#video-popup-'.$post->ID.'" class="pretty_photo"></a> ';
													echo '<div id="video-popup-'.$post->ID.'">';
											        echo '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
													echo '</div>';
											    } 
											    
											    else {
													 echo '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo" ></a> ';	 
											     }
					
									        } else { ?>
									        	
									        	<a href="<?php echo $featured_image[0]; ?>"  <?php if(!empty($project_image_caption)) echo ' title="'.$project_image_caption.'" '; ?> class="pretty_photo"></a>
									        	
									        <?php  }

										   }

									} ?>
									
		
									<div class="vert-center">
										<?php 
										if(!empty($using_custom_content) && $using_custom_content == 'on') {
											echo '<div class="custom-content">' . do_shortcode($custom_content) . '</div>';
										} else { ?>	
											<h3><?php echo get_the_title(); ?> </h3> 
											<?php if(!empty($project_excerpt)) { echo '<p>'.$project_excerpt.'</p>'; } elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; ?>
										
										<?php }	?>
										
									</div><!--/vert-center-->
									
								</div>
							</div><!--work-item-->
							
						<?php } //project style 5 

						else if($project_style == '6') { 

							$using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
							$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true); ?>
							
							<div class="work-item style-5" data-custom-content="<?php echo $using_custom_content; ?>" data-text-align="<?php echo $masonry_item_content_pos; ?>">
								
								<?php
								$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
		
								$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
								$parallax_images = get_post_meta($post->ID, '_nectar_3d_parallax_images', true); 

								if(!empty($parallax_images)) {

									echo '<div class="parallaxImg">';

									$images = explode( ',', $parallax_images);
									$i = 0;
									foreach ( $images as $attach_id ) {
										$i++;

										$img = wp_get_attachment_image_src(  $attach_id, $thumb_size );
										//add one sizer img
										if($i == 1) echo '<img class="sizer" src="'.$img[0].'" alt="'.get_the_title().'" />';
    									echo '<div class="parallaxImg-layer" data-img="'.$img[0].'" Layer-'.$i.'"></div>';

									}

									echo '</div>';

								} 
								//no parallax images set
								else {
									
									if (!empty($custom_thumbnail)) {

										echo '<img class="sizer" src="'.$custom_thumbnail.'" alt="'.get_the_title().'" />';

										echo '<div class="parallaxImg">';
										echo '<div class="parallaxImg-layer" data-img="'.$custom_thumbnail.'"></div>';
										echo '<div class="parallaxImg-layer"><div class="bg-overlay"></div> <div class="work-meta"><div class="inner">';
										echo '	<h4 class="title"> '.get_the_title().'</h4>';
													
												if(!empty($project_excerpt)) echo '<p>'.$project_excerpt.'</p>';  
												elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; 
													
										echo '</div></div></div></div>';
										
									}

									else if ( has_post_thumbnail() ) {

										$thumbnail_id = get_post_thumbnail_id($post->ID);
										$thumbnail_url = wp_get_attachment_image_src($thumbnail_id,$thumb_size); 

										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}

										echo '<img class="sizer" src="'.get_template_directory_uri().'/img/'.$no_image_size.'" alt="'.get_the_title().'" />';

										echo '<div class="parallaxImg">';
										echo '<div class="parallaxImg-layer" data-img="'.$thumbnail_url[0].'"></div>';
										echo '<div class="parallaxImg-layer"><div class="bg-overlay"></div> <div class="work-meta"><div class="inner">';
										echo '	<h4 class="title"> '.get_the_title().'</h4>';
													
												if(!empty($project_excerpt)) echo '<p>'.$project_excerpt.'</p>';  
												elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; 
													
										echo '</div></div></div></div>';
									} 
									
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}

										echo '<img class="sizer" src="'.get_template_directory_uri().'/img/'.$no_image_size.'" alt="'.get_the_title().'" />';

										echo '<div class="parallaxImg">';
										echo '<div class="parallaxImg-layer" data-img="'.get_template_directory_uri().'/img/'.$no_image_size.'"></div>';
										echo '<div class="parallaxImg-layer"><div class="bg-overlay"></div> <div class="work-meta"><div class="inner">';
										echo '	<h4 class="title"> '.get_the_title().'</h4>';
													
												if(!empty($project_excerpt)) echo '<p>'.$project_excerpt.'</p>';  
												elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; 
													
										echo '</div></div></div></div>';

									 }   
								}

								if($lightbox_only != 'true') { ?>
											
									<a href="<?php echo $the_project_link; ?>"></a>
								
								<?php } else {
									 
									$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  							
									$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
									$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
									
									//video 
								    if( !empty($video_embed) || !empty($video_m4v) ) {
		
									    if( !empty( $video_embed) && floatval(get_bloginfo('version')) < "3.6") {
									    	
									    	echo '<a href="#video-popup-'.$post->ID.'" class="pretty_photo"></a> ';
											echo '<div id="video-popup-'.$post->ID.'">';
									        echo '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
											echo '</div>';
									    } 
									    
									    else {
											 echo '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo" ></a> ';	 
									     }
			
							        } else { ?>
							        	
							        	<a href="<?php echo $featured_image[0]; ?>"  <?php if(!empty($project_image_caption)) echo ' title="'.$project_image_caption.'" '; ?> class="pretty_photo"></a>
							        	
							        <?php  }

								   }
									
								?>

							
							</div><!--work-item-->

						
							
						<?php } //project style 6 ?>
						
						
					</div><!--/inner-wrap-->
					</div><!--/col-->
					
				<?php endwhile; endif; ?>

			</div><!--/portfolio-->
	   </div><!--/portfolio wrap-->
		
		<?php 

		 if( !empty($options['portfolio_extra_pagination']) && $options['portfolio_extra_pagination'] == '1' && $enable_pagination == 'true'){
		 	
				    global $wp_query, $wp_rewrite;  
			 		
					$fw_pagination = ($span_num == 'elastic-portfolio-item') ? 'fw-pagination': null;
					$masonry_padding = ($project_style != '2') ? 'alt-style-padding' : null;
					
	                $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1; 
				    $total_pages = $wp_query->max_num_pages;  
					
					$permalink_structure = get_option('permalink_structure');
					
				    $query_type = (count($_GET)) ? '&' : '?';	
				    $get_compiled = array_keys($_GET);
				  	$first_get_param = reset($get_compiled); 
				    if($first_get_param == 'paged') $query_type = '?';

			   	    // $format = empty( $permalink_structure ) ? $query_type.'paged=%#%' : 'page/%#%/';  
				    if ($total_pages > 1){  
				      
					  echo '<div id="pagination" class="'.$fw_pagination.' '.$masonry_padding. $infinite_scroll_class .'" data-is-text="'.__("All items loaded", NECTAR_THEME_NAME).'">';
					   
				      echo paginate_links(array(  
				          'base' => get_pagenum_link(1) .'%_%', 
	    			      'format' => $query_type.'paged=%#%',
				          'current' => $current,  
				          'total' => $total_pages,  
				        )); 
						
					  echo  '</div>'; 
						
				    }  
			}
			//regular pagination
			else if($enable_pagination == 'true'){
				
				$fw_pagination = ($span_num == 'elastic-portfolio-item') ? 'fw-pagination': null;
				$masonry_padding = ($project_style == '1') ? 'alt-style-padding' : null;
				
				if( get_next_posts_link() || get_previous_posts_link() ) { 
					echo '<div id="pagination" class="'.$fw_pagination.' '.$masonry_padding. $infinite_scroll_class.'" data-is-text="'.__("All items loaded", NECTAR_THEME_NAME).'">
					      <div class="prev">'.get_previous_posts_link('&laquo; Previous Entries').'</div>
					      <div class="next">'.get_next_posts_link('Next Entries &raquo;','').'</div>
				          </div>';
				
		        }
			}  
	
	
	
	wp_reset_query();
	
	$portfolio_markup = ob_get_contents();
	
	ob_end_clean();
	

	return $portfolio_markup;
}
add_shortcode('nectar_portfolio', 'nectar_portfolio_processing');




//blog
function nectar_blog_processing($atts, $content = null) {
	
	global $layout;
	
	extract(shortcode_atts(array("layout" => 'std-blog-sidebar', 'category' => 'all', 'enable_pagination' => 'false', 'load_in_animation' => 'none', 'posts_per_page' => '10', 'pagination_type' => ''), $atts));  
	
	
	ob_start(); ?>
	
	<div class="row">
	
	 <?php $options = get_nectar_theme_options(); 

		$masonry_class = null;
		$infinite_scroll_class = null;
		$full_width_article = ($posts_per_page == 1) ? 'full-width-article': null;

		//enqueue masonry script if selected
		if($layout == 'masonry-blog-sidebar' || $layout == 'masonry-blog-fullwidth' || $layout == 'masonry-blog-full-screen-width') {
			$masonry_class = 'masonry';
		}
		
		if($layout == 'masonry-blog-full-screen-width') {
			$masonry_class = 'masonry full-width-content';
		}

		if($pagination_type == 'infinite_scroll' && $enable_pagination == 'true') {
			$infinite_scroll_class = ' infinite_scroll';
		}
		
		if($masonry_class != null) {
			$masonry_style = (!empty($options['blog_masonry_type'])) ? $options['blog_masonry_type']: 'classic';
		}
		else {
			$masonry_style = null;
		}
		if($layout == 'std-blog-sidebar' || $layout == 'masonry-blog-sidebar'){
			echo '<div id="post-area" class="col span_9 '.$masonry_class.' '.$masonry_style.' '.$infinite_scroll_class.'"> <div class="posts-container" data-load-animation="'.$load_in_animation.'">';
		} else {
			echo '<div id="post-area" class="col span_12 col_last '.$masonry_class.' '.$masonry_style.' '.$infinite_scroll_class.' '.$full_width_article.'" > <div class="posts-container" data-load-animation="'.$load_in_animation.'">';
		}
			
			if ( get_query_var('paged') ) {
				  $paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
				  $paged = get_query_var('page');
			} else {
				  $paged = 1;
			}
			
			//incase only all was selected
			if($category == 'all') {
				$category = null;
			}
	
			$blog_arr = array(
				'posts_per_page' => $posts_per_page,
				'post_type' => 'post',
				'category_name' => $category,
				'paged'=> $paged
			);
		
			query_posts($blog_arr);
			
			if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				
				<?php 
				
				global $more;
				$more = 0;

				if ( floatval(get_bloginfo('version')) < "3.6" ) {
					//old post formats before they got built into the core
					 get_template_part( 'includes/post-templates-pre-3-6/entry', get_post_format() ); 
				} else {
					//WP 3.6+ post formats
					 get_template_part( 'includes/post-templates/entry', get_post_format() ); 
				} ?>

			<?php endwhile; endif; ?>
			
			</div><!--/posts container-->
			
			<?php

			global $options;
			//extra pagination
			if( !empty($options['extra_pagination']) && $options['extra_pagination'] == '1' && $enable_pagination == 'true'){
				
				    global $wp_query, $wp_rewrite; 
	      
				    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1; 
				    $total_pages = $wp_query->max_num_pages; 
				      
				    if ($total_pages > 1){  
				      
				      $permalink_structure = get_option('permalink_structure');
				      $query_type = (count($_GET)) ? '&' : '?';	
			      	  $format = empty( $permalink_structure ) ? $query_type.'paged=%#%' : 'page/%#%/';  
					
					  echo '<div id="pagination" data-is-text="'.__("All items loaded", NECTAR_THEME_NAME).'">';
					   
				      echo paginate_links(array(  
				          'base' => get_pagenum_link(1) . '%_%',  
				          'format' => $format,  
				          'current' => $current,  
				          'total' => $total_pages,  
				        )); 
						
					  echo  '</div>'; 
						
				    }  
			}
			//regular pagination
			else if($enable_pagination == 'true'){
				
				if( get_next_posts_link() || get_previous_posts_link() ) { 
					echo '<div id="pagination" data-is-text="'.__("All items loaded", NECTAR_THEME_NAME).'">
					      <div class="prev">'.get_previous_posts_link('&laquo; Previous Entries').'</div>
					      <div class="next">'.get_next_posts_link('Next Entries &raquo;','').'</div>
				          </div>';
				
		        }
			}
				
		?>
		
		</div><!--/span_9-->
		
		<?php  if($layout == 'std-blog-sidebar' || $layout == 'masonry-blog-sidebar') { ?>
			<div id="sidebar" class="col span_3 col_last">
				<?php get_sidebar(); ?>
			</div><!--/span_3-->
	   <?php } ?>

	</div>
	
	<?php 
	
	wp_reset_query();
	
	$blog_markup = ob_get_contents();
	
	ob_end_clean();
	
	return $blog_markup;
	
}
add_shortcode('nectar_blog', 'nectar_blog_processing');





//Recent Posts
function nectar_recent_posts($atts, $content = null) {
	extract(shortcode_atts(array("title_labels" => 'false', 'category' => 'all', 'slider_size' => '600', 'slider_above_text' => '', 'posts_per_page' => '4', 'columns' => '4', 'style' => 'default', 'post_offset' => '0'), $atts));  
	
	global $post;  
	global $options;
	
	$posts_page_id = get_option('page_for_posts');
	$posts_page = get_page($posts_page_id);
	$posts_page_title = $posts_page->post_title;
	$posts_page_link = get_page_uri($posts_page_id);
	
	$title_label_output = null;
	$recent_posts_title_text = (!empty($options['recent-posts-title'])) ? $options['recent-posts-title'] :'Recent Posts';		
	$recent_posts_link_text = (!empty($options['recent-posts-link'])) ? $options['recent-posts-link'] :'View All Posts';		
	
	//incase only all was selected
	if($category == 'all') {
		$category = null;
	}
	
	if($style != 'slider') {

		($title_labels == 'true') ? $title_label_output = '<h2 class="uppercase recent-posts-title">'.$recent_posts_title_text.'<a href="'. $posts_page_link.'" class="button"> / '. $recent_posts_link_text .'</a></h2>' : $title_label_output = null;
			
			ob_start(); 
			
			echo $title_label_output; ?>
			
			<div class="row blog-recent columns-<?php echo $columns; ?>" data-style="<?php echo $style; ?>">
				
				<?php 
			    $recentBlogPosts = array(
			      'showposts' => $posts_per_page,
			      'category_name' => $category,
			      'ignore_sticky_posts' => 1,
			      'offset' => $post_offset,
			      'tax_query' => array(
		              array( 'taxonomy' => 'post_format',
		                  'field' => 'slug',
		                  'terms' => array('post-format-link','post-format-quote'),
		                  'operator' => 'NOT IN'
		                  )
		              )
			    );

				$recent_posts_query = new WP_Query($recentBlogPosts);  

				if( $recent_posts_query->have_posts() ) :  while( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post();  


				if($columns == '4') {
					$col_num = 'span_3';
				} else if($columns == '3') {
					$col_num = 'span_4';
				} else if($columns == '2') {
					$col_num = 'span_6';
				} else {
					$col_num = 'span_12';
				}
				
				?>

				<div class="col <?php echo $col_num; ?>">
					
					<?php 
						
						$wp_version = floatval(get_bloginfo('version'));
						
						if($style == 'default') {

							if(get_post_format() == 'video'){

								 if ( $wp_version < "3.6" ) {
									 $video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
										
						             if( !empty( $video_embed ) ) {
						                 echo '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
						             } else { 
						                 nectar_video($post->ID); 
						             }
								 }
							  	 else {
									
									$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
								    $video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
								    $video_ogv = get_post_meta($post->ID, '_nectar_video_ogv', true); 
								    $video_poster = get_post_meta($post->ID, '_nectar_video_poster', true); 
								  
								    if( !empty($video_embed) || !empty($video_m4v) ){
				
						               $wp_version = floatval(get_bloginfo('version'));
												
									  //video embed
									  if( !empty( $video_embed ) ) {
										
							               echo '<div class="video">' . do_shortcode($video_embed) . '</div>';
										
							          } 
							          //self hosted video pre 3-6
							          else if( !empty($video_m4v) && $wp_version < "3.6") {
							        	
							          	   echo '<div class="video">'; 
							              	   nectar_video($post->ID); 
										   echo '</div>'; 
										 
							          } 
							          //self hosted video post 3-6
							          else if($wp_version >= "3.6"){
						
							        	  if(!empty($video_m4v) || !empty($video_ogv)) {
							        		
											  $video_output = '[video ';
											
											  if(!empty($video_m4v)) { $video_output .= 'mp4="'. $video_m4v .'" '; }
											  if(!empty($video_ogv)) { $video_output .= 'ogv="'. $video_ogv .'"'; }
											
											  $video_output .= ' poster="'.$video_poster.'"]';
											
							        		  echo '<div class="video">' . do_shortcode($video_output) . '</div>';	
							        	  }
							          }
									
								   } // endif for if there's a video
									
							    } // endif for 3.6 
							    
							} //endif for post format video
							
							else if(get_post_format() == 'audio'){ ?>
								<div class="audio-wrap">		
									<?php 
									if ( $wp_version < "3.6" ) {
									    nectar_audio($post->ID);
									} 
									else {
										$audio_mp3 = get_post_meta($post->ID, '_nectar_audio_mp3', true);
									    $audio_ogg = get_post_meta($post->ID, '_nectar_audio_ogg', true); 
										
										if(!empty($audio_ogg) || !empty($audio_mp3)) {
								        	
											$audio_output = '[audio ';
											
											if(!empty($audio_mp3)) { $audio_output .= 'mp3="'. $audio_mp3 .'" '; }
											if(!empty($audio_ogg)) { $audio_output .= 'ogg="'. $audio_ogg .'"'; }
											
											$audio_output .= ']';
											
							        		echo  do_shortcode($audio_output);	
							        	}
									} ?>
								</div><!--/audio-wrap-->
							<?php }
							
							else if(get_post_format() == 'gallery'){
								
								if ( $wp_version < "3.6" ) {
									
									if(MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'second-slide')) {
										nectar_gallery($post->ID);
									}
									
									else {
										if ( has_post_thumbnail() ) { echo get_the_post_thumbnail($post->ID, 'portfolio-thumb', array('title' => '')); }
									}
								}
								
								else {
									
									$gallery_ids = grab_ids_from_gallery(); ?>
						
									<div class="flex-gallery"> 
											 <ul class="slides">
											 	<?php 
												foreach( $gallery_ids as $image_id ) {
												     echo '<li>' . wp_get_attachment_image($image_id, 'portfolio-thumb', false) . '</li>';
												} ?>
									    	</ul>
								   	 </div><!--/gallery-->

						   <?php }
										
							}
							
							else {
								if ( has_post_thumbnail() ) { echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID, 'portfolio-thumb', array('title' => '')) . '</a>'; }
							}
					
						?>

							<div class="post-header">
								<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>	
								<span class="meta-author"><?php the_author_posts_link(); ?> </span> <span class="meta-category"> | <?php the_category(', '); ?> </span> <span class="meta-comment-count"> | <a href="<?php comments_link(); ?>">
								<?php comments_number( __('No Comments',NECTAR_THEME_NAME), __('One Comment',NECTAR_THEME_NAME), '% '. __('Comments',NECTAR_THEME_NAME) ); ?></a> </span>
							</div><!--/post-header-->
							
							<?php the_excerpt(); 

						} // default style
						else if($style == 'minimal') { ?>

							<a href="<?php the_permalink(); ?>"></a>
							<div class="post-header">
								<span class="meta"> <?php echo get_the_date() . ' ' . __('in',NECTAR_THEME_NAME); ?> <?php the_category(', '); ?> </span> 
								<h3 class="title"><?php the_title(); ?></h3>	
							</div><!--/post-header-->
							<?php the_excerpt(); ?>
							<span><?php echo __('Read More',NECTAR_THEME_NAME); ?> <i class="icon-button-arrow"></i></span>

						<?php } else if($style == 'title_only') { ?>

							<a href="<?php the_permalink(); ?>"></a>
							<div class="post-header">
								<span class="meta"> <?php echo get_the_date(); ?> </span> 
								<h2 class="title"><?php the_title(); ?></h2>	
							</div><!--/post-header-->

						<?php } ?>
					
				</div><!--/col-->
				
				<?php endwhile; endif; 
					  wp_reset_postdata();
				?>
		
			</div><!--/blog-recent-->
		
		<?php

		wp_reset_query();
		
		$recent_posts_content = ob_get_contents();
		
		ob_end_clean();
	
	} // regular recent posts


	else { //slider


		ob_start(); 
			
		echo $title_label_output; ?>
		
		<?php 
	    $recentBlogPosts = array(
	      'showposts' => $posts_per_page,
	      'category_name' => $category,
	      'ignore_sticky_posts' => 1,
	      'offset' => $post_offset,
	      'tax_query' => array(
              array( 'taxonomy' => 'post_format',
                  'field' => 'slug',
                  'terms' => array('post-format-link','post-format-quote'),
                  'operator' => 'NOT IN'
                  )
              )
	    );

		$recent_posts_query = new WP_Query($recentBlogPosts);  


	    $animate_in_effect = (!empty($options['header-animate-in-effect'])) ? $options['header-animate-in-effect'] : 'none';
		echo '<div class="nectar-recent-posts-slider" data-height="'.$slider_size.'" data-animate-in-effect="'.$animate_in_effect.'">';

		/*echo '<div class="nectar-recent-post-content"><div class="recent-post-container container"><div class="inner-wrap"><span class="strong">'.$slider_above_text.'</span>';
		$i = 0;
		if( $recent_posts_query->have_posts() ) :  while( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post(); global $post; ?>

				<h2 class="post-ref-<?php echo $i; ?>"><a href=" <?php echo get_permalink(); ?>" class="full-slide-link"> <?php echo the_title(); ?> </a></h2>
				<?php $i++; ?>

		<?php endwhile; endif; 
		echo '</div></div></div>'; */

		echo '<div class="nectar-recent-posts-slider-inner">'; 
		$i = 0;
		if( $recent_posts_query->have_posts() ) :  while( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post(); global $post; ?>

				<?php 
					$bg = get_post_meta($post->ID, '_nectar_header_bg', true);
					$bg_color = get_post_meta($post->ID, '_nectar_header_bg_color', true);
					$bg_image_id = null;
					$featured_img = null;
					
					if(!empty($bg)){
						//page header
						$featured_img = $bg;

					} elseif(has_post_thumbnail($post->ID)) {
						$bg_image_id = get_post_thumbnail_id($post->ID);
						$image_src = wp_get_attachment_image_src($bg_image_id, 'full');
						$featured_img = $image_src[0];
					}


				?>

				<div class="nectar-recent-post-slide <?php if($bg_image_id == null) echo 'no-bg-img'; ?> post-ref-<?php echo $i; ?>">

					<div class="nectar-recent-post-bg"  style=" <?php if(!empty($bg_color)) { ?> background-color: <?php echo $bg_color;?>; <?php } ?> background-image: url(<?php echo $featured_img;?>);" > </div>

					<?php 

					echo '<div class="recent-post-container container"><div class="inner-wrap">';

					echo '<span class="strong">';
							$categories = get_the_category();
							if ( ! empty( $categories ) ) {
								$output = null;
							    foreach( $categories as $category ) {
							        $output .= '<a class="'.$category->slug.'" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', NECTAR_THEME_NAME), $category->name ) ) . '"><span class="'.$category->slug.'">'.esc_html( $category->name ) .'</span></a>';
							    }
							    echo trim( $output);
							}
						echo '</span>'; ?>
					
						<h2 class="post-ref-<?php echo $i; ?>"><a href=" <?php echo get_permalink(); ?>" class="full-slide-link"> <?php echo the_title(); ?> </a></h2> 
					</div></div>
						

				</div>

				<?php $i++; ?>

		<?php endwhile; endif; 

			  wp_reset_postdata();
	
		 echo '</div></div>';

		wp_reset_query();
		
		$recent_posts_content = ob_get_contents();
		
		ob_end_clean();
	}


	return $recent_posts_content;

}
add_shortcode('recent_posts', 'nectar_recent_posts');


 
//recent projects
function nectar_recent_projects($atts, $content = null) {
	extract(shortcode_atts(array("title_labels" => 'false', 'project_style' => '', 'heading' => '', 'page_link_text' => '', 'control_text_color' => 'dark', 'page_link_url' => '', 'hide_controls' => 'false', 'lightbox_only' => '0', 'number_to_display' => '6','full_width' => 'false', 'category' => 'all'), $atts));   
	
	global $post; 
	global $options;
	global $nectar_love; 
	
	$options = get_nectar_theme_options(); 
	
	$title_label_output = null;
	$recent_projects_title_text = (!empty($options['carousel-title'])) ? $options['carousel-title'] : 'Recent Work';		
	$recent_projects_link_text = (!empty($options['carousel-link'])) ? $options['carousel-link'] : 'View All Work';		
	$portfolio_link = get_portfolio_page_link(get_the_ID()); 
	if(!empty($options['main-portfolio-link'])) $portfolio_link = $options['main-portfolio-link'];
	
	
	//project style
	if(empty($project_style) && $full_width == 'true') {
		$project_style = '2';
	} elseif(empty($project_style) && $full_width == 'false') {
		$project_style = '1';
	}

	
	$full_width_carousel = ($full_width == 'true') ? 'true': 'false';
			
	//incase only all was selected
	if($category == 'all') {
		$category = null;
	}
	
	$projects_to_display = (intval($number_to_display) == 0) ? '6' : $number_to_display; 
	
	if(!empty($heading)) {
		if($full_width_carousel == 'true'){
			$title_label_output = '<h2>'.$heading.'</h2>';
		} else {
			$title_label_output = '<h2>'.$heading;
			if(!empty($page_link_text)) $title_label_output .= '<a href="'. $page_link_url.'" class="button"> / '. $page_link_text .'</a>';
			$title_label_output .= '</h2>';
		}
	}
	
	//keep old label option to not break legacy users
	if($title_labels == 'true') { 
		$title_label_output = '<h2>'.$recent_projects_title_text;
		if(!empty($recent_projects_link_text) && strlen($recent_projects_link_text) > 2) $title_label_output .= '<a href="'. $portfolio_link.'" class="button"> / '. $recent_projects_link_text .'</a>';
		$title_label_output .= '</h2>';
	}

				$portfolio = array(
					'posts_per_page' => $projects_to_display,
					'post_type' => 'portfolio',
					'project-type'=> $category
				);

				$the_query = new WP_Query($portfolio);
				
				if($full_width_carousel == 'true'){
					$arrow_markup = '<div class="controls"><a class="portfolio-page-link" href="'.$page_link_url.'"><i class="icon-salient-back-to-all"></i></a>
									 <a class="carousel-prev" href="#"><i class="icon-salient-left-arrow-thin"></i></a>
					    	         <a class="carousel-next" href="#"><i class="icon-salient-right-arrow-thin"></i></a></div>';
				} else {
					$arrow_markup = '<div class="control-wrap"><a class="carousel-prev" href="#"><i class="icon-angle-left"></i></a>
					    	         <a class="carousel-next" href="#"><i class="icon-angle-right"></i></a></div>'; 
				} 
				
				if($hide_controls == 'true') $arrow_markup = null;
				
				?>
 
				
				<?php if ( $the_query->have_posts() ) { 
					
					$default_style = ($project_style == '1') ? 'default-style' : null;
					
					$recent_projects_content = '<div class="carousel-wrap recent-work-carousel '.$default_style.'" data-ctc="'.$control_text_color.'" data-full-width="'.$full_width_carousel.'">
					
					<div class="carousel-heading"><div class="container">'.$title_label_output . $arrow_markup .'</div></div>
					
					<ul class="row portfolio-items text-align-center carousel" data-scroll-speed="800" data-easing="easeInOutQuart">';
				 } 
				

				//standard layout
				if($project_style == '1'){
					
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();

						$project_image_caption = get_post(get_post_thumbnail_id())->post_content;
						$project_image_caption = strip_tags($project_image_caption);
						$project_image_caption_markup = null;
						if(!empty($project_image_caption)) $project_image_caption_markup = ' title="'.$project_image_caption.'" '; 	
					
						$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  
						$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
						$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
						$media = null;
						$date = null;
						$love = $nectar_love->add_love(); 
						
						$custom_project_link = get_post_meta($post->ID, '_nectar_external_project_url', true);
						$the_project_link = (!empty($custom_project_link)) ? $custom_project_link : get_permalink();
						
						//video 
					    if( !empty($video_embed) || !empty($video_m4v) ) {
		
						    if( !empty( $video_embed ) && floatval(get_bloginfo('version')) < "3.6" ) { 
						    	
						    	$media .= '<a href="#video-popup-'.$post->ID.'" class="pretty_photo default-link">'.__("Watch Video", NECTAR_THEME_NAME).' </a> ';
								$media .= '<div id="video-popup-'.$post->ID.'">';
						        $media .= '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
								$media .= '</div>';
						    } 
						    
						    else {
								 $media .= '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo default-link" >'.__("Watch Video", NECTAR_THEME_NAME).'</a> ';	 
						     } 
		
				        } 
						
						//image
					    else {
					       $media .= '<a href="'. $featured_image[0].'" class="pretty_photo default-link">'.__("View Larger", NECTAR_THEME_NAME).'</a> ';
					    }
						
						$project_excerpt = get_post_meta($post->ID, '_nectar_project_excerpt', true);

						if(!empty($project_excerpt)) {
							 $date = '<p>'.$project_excerpt.'</p>'; 
						} elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) {
							 $date = '<p>' . get_the_date() . '</p>'; 
						} 
									
						$project_img = '<img src="'.get_template_directory_uri().'/img/no-portfolio-item-small.jpg" alt="no image added yet." />';
						if ( has_post_thumbnail() ) { $project_img = get_the_post_thumbnail($post->ID, 'portfolio-thumb', array('title' => '')); } 
						
						//custom thumbnail
						$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
						
						if( !empty($custom_thumbnail) ){
							$project_img = '<img class="custom-thumbnail" src="'.nectar_ssl_check($custom_thumbnail).'" alt="'. get_the_title() .'" />';
						}
						
						$more_details_html = ($lightbox_only != 'true') ? '<a class="default-link" href="' . $the_project_link . '">'.__("More Details", NECTAR_THEME_NAME).'</a>' : null; 
					    
						$project_accent_color = get_post_meta($post->ID, '_nectar_project_accent_color', true);	 
						if(!empty($project_accent_color)) { $project_accent_color_markup = 'data-project-color="' . $project_accent_color .'"'; } else { $project_accent_color_markup = 'data-default-color="true"';} 
						$project_title_color = get_post_meta($post->ID, '_nectar_project_title_color', true);
					    $project_subtitle_color = get_post_meta($post->ID, '_nectar_project_subtitle_color', true);

					    $using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
						$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true);

						$recent_projects_content .='<li class="col span_4" '.$project_accent_color_markup.' data-title-color="'.$project_title_color.'" data-subtitle-color="'.$project_subtitle_color.'">
							<div class="inner-wrap animated" data-animation="none">
							<div class="work-item" data-custom-content="'.$using_custom_content.'">' . $project_img . '
			
								<div class="work-info-bg"></div>
								<div class="work-info">';
									
									if($using_custom_content == 'on') {
										if(!empty($custom_project_link)) echo '<a href="'.$the_project_link.'"></a>';
										$recent_projects_content .= '<div class="vert-center"><div class="custom-content">' . do_shortcode($custom_content) . '</div></div>';
									   //default
									} else { 
										$recent_projects_content .= '<div class="vert-center">' . $media . $more_details_html .'</div><!--/vert-center-->';
									}

								$recent_projects_content .= '</div>
							</div><!--work-item-->
							
							<div class="work-meta">
								<h4 class="title"> '. get_the_title() .'</h4>
								'.$date.'
							</div><div class="nectar-love-wrap">
							
							'.$love.'</div>
							
							<div class="clear"></div>
							</div>
						</li><!--/span_4-->';
					
					} 

				  } 
				
				} 
				
				//alt project style
				elseif($project_style == '2') {
					
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();

						$project_image_caption = get_post(get_post_thumbnail_id())->post_content;
						$project_image_caption = strip_tags($project_image_caption);
						$project_image_caption_markup = null;
						if(!empty($project_image_caption)) $project_image_caption_markup = ' title="'.$project_image_caption.'" '; 		
						
						$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  
						$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
						$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
						$media = null;
						$date = null;
						$love = $nectar_love->add_love(); 
						$margin = ($full_width_carousel == 'true') ? 'no-margin' : null;
						
						$custom_project_link = get_post_meta($post->ID, '_nectar_external_project_url', true);
						$the_project_link = (!empty($custom_project_link)) ? $custom_project_link : get_permalink();
						
						$project_excerpt = get_post_meta($post->ID, '_nectar_project_excerpt', true);
						if(!empty($project_excerpt)) {
							 $date = '<p>'.$project_excerpt.'</p>'; 
						} elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) {
							 $date = '<p>' . get_the_date() . '</p>'; 
						} 
									
						$project_img = '<img src="'.get_template_directory_uri().'/img/no-portfolio-item-small.jpg" alt="no image added yet." />';
						if ( has_post_thumbnail() ) { $project_img = get_the_post_thumbnail($post->ID, 'portfolio-thumb', array('title' => '')); } 
						
						//custom thumbnail
						$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
						
						if( !empty($custom_thumbnail) ){
							$project_img = '<img class="custom-thumbnail" src="'.nectar_ssl_check($custom_thumbnail).'" alt="'. get_the_title() .'" />';
						}
						
						if($lightbox_only != 'true') {
							$link_markup = '<a href="' . $the_project_link . '"></a>';
						} else {
							
							//video 
						    if( !empty($video_embed) || !empty($video_m4v) ) {
			
							    if( !empty( $video_embed ) && floatval(get_bloginfo('version')) < "3.6" ) { 
							    	
							    	$link_markup = '<a href="#video-popup-'.$post->ID.'" class="pretty_photo"> </a> ';
									$link_markup .= '<div id="video-popup-'.$post->ID.'">';
							        $link_markup .= '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
									$link_markup .= '</div>';
							    } 
							    
							    else {
									 $link_markup = '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo" ></a> ';	 
							     } 
			
					        } 
							
					        //image
					        else {
					        	$link_markup = '<a href="'. $featured_image[0].'" '.$project_image_caption_markup.' class="pretty_photo"></a>';
					        }
							
						}
						
						$project_accent_color = get_post_meta($post->ID, '_nectar_project_accent_color', true);	 
						if(!empty($project_accent_color)) { $project_accent_color_markup = 'data-project-color="' . $project_accent_color .'"'; } else { $project_accent_color_markup = 'data-default-color="true"';} 
						$project_title_color = get_post_meta($post->ID, '_nectar_project_title_color', true);
					    $project_subtitle_color = get_post_meta($post->ID, '_nectar_project_subtitle_color', true);

					    $using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
						$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true);

						$recent_projects_content .='<li class="col span_4 '.$margin.'" '.$project_accent_color_markup.' data-title-color="'.$project_title_color.'" data-subtitle-color="'.$project_subtitle_color.'">
							
							<div class="work-item style-2" data-custom-content="'.$using_custom_content.'">' . $project_img . '
			
								<div class="work-info-bg"></div>
								<div class="work-info">
									
									
									'.$link_markup;

									if($using_custom_content == 'on') {
										if(!empty($custom_project_link)) echo '<a href="'.$the_project_link.'"></a>';
										$recent_projects_content .= '<div class="vert-center"><div class="custom-content">' . do_shortcode($custom_content) . '</div></div>';
									   //default
									} else { 
										$recent_projects_content .= '<div class="vert-center"><h3>' . get_the_title() . '</h3> ' . $date.'</div><!--/vert-center-->';
									}

								$recent_projects_content .= '</div>
							</div><!--work-item-->

						</li><!--/span_4-->';
					
					}

                  }
					
					
				}//full width
				
				
				
				elseif($project_style == '3') {
							
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
							
							$project_image_caption = get_post(get_post_thumbnail_id())->post_content;
							$project_image_caption = strip_tags($project_image_caption);
							$project_image_caption_markup = null;
							if(!empty($project_image_caption)) $project_image_caption_markup = ' title="'.$project_image_caption.'" '; 	

							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  
							$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
							$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
							$media = null;
							$date = null;
							$love = $nectar_love->add_love(); 
							$margin = ($full_width_carousel == 'true') ? 'no-margin' : null;
							
							$custom_project_link = get_post_meta($post->ID, '_nectar_external_project_url', true);
							$the_project_link = (!empty($custom_project_link)) ? $custom_project_link : get_permalink();
							
							$project_excerpt = get_post_meta($post->ID, '_nectar_project_excerpt', true);
							if(!empty($project_excerpt)) {
								 $date = '<p>'.$project_excerpt.'</p>'; 
							} elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) {
								 $date = '<p>' . get_the_date() . '</p>'; 
							} 
										
							$project_img = '<img src="'.get_template_directory_uri().'/img/no-portfolio-item-small.jpg" alt="no image added yet." />';
							if ( has_post_thumbnail() ) { $project_img = get_the_post_thumbnail($post->ID, 'portfolio-thumb', array('title' => '')); } 
							
							//custom thumbnail
							$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
							
							if( !empty($custom_thumbnail) ){
								$project_img = '<img class="custom-thumbnail" src="'.nectar_ssl_check($custom_thumbnail).'" alt="'. get_the_title() .'" />';
							}
							
							if($lightbox_only != 'true') {
								$link_markup = '<a href="' . $the_project_link . '"></a>';
							} else {
								
								//video 
							    if( !empty($video_embed) || !empty($video_m4v) ) {
				
								    if( !empty( $video_embed ) && floatval(get_bloginfo('version')) < "3.6" ) { 
								    	
								    	$link_markup = '<a href="#video-popup-'.$post->ID.'" class="pretty_photo"> </a> ';
										$link_markup .= '<div id="video-popup-'.$post->ID.'">';
								        $link_markup .= '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
										$link_markup .= '</div>';
								    } 
								    
								    else {
										 $link_markup = '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo" ></a> ';	 
								     } 
				
						        } 
								
						        //image
						        else {
						        	$link_markup = '<a href="'. $featured_image[0].'" '.$project_image_caption_markup.' class="pretty_photo"></a>';
						        }
								
							}
							
							$project_accent_color = get_post_meta($post->ID, '_nectar_project_accent_color', true);	 
							if(!empty($project_accent_color)) { $project_accent_color_markup = 'data-project-color="' . $project_accent_color .'"'; } else { $project_accent_color_markup = 'data-default-color="true"';} 
							$project_title_color = get_post_meta($post->ID, '_nectar_project_title_color', true);
						    $project_subtitle_color = get_post_meta($post->ID, '_nectar_project_subtitle_color', true);

						    $using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
							$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true);

							$recent_projects_content .='<li class="col span_4 '.$margin.'" '.$project_accent_color_markup.' data-title-color="'.$project_title_color.'" data-subtitle-color="'.$project_subtitle_color.'">
								
								<div class="work-item style-3" data-custom-content="'.$using_custom_content.'">' . $project_img . '
				
									<div class="work-info-bg"></div>
									<div class="work-info">
										
										'.$link_markup;

										if(!empty($using_custom_content) && $using_custom_content == 'on') {
											if(!empty($custom_project_link)) echo '<a href="'.$the_project_link.'"></a>';
											$recent_projects_content .= '<div class="vert-center"><div class="custom-content">' . do_shortcode($custom_content) . '</div></div>';
										   //default
										} else { 
											$recent_projects_content .= '<div class="vert-center"><h3>' . get_the_title() . '</h3>' . $date.'</div><!--/vert-center-->';
										}
		
										
									$recent_projects_content .= '</div>
								</div><!--work-item-->
	
							</li><!--/span_4-->';
						
						}

                      }
						
					} //project style 3
				
				
				elseif($project_style == '4') {
							
						if ( $the_query->have_posts() ) {
						  while ( $the_query->have_posts() ) {
							$the_query->the_post();

							$project_image_caption = get_post(get_post_thumbnail_id())->post_content;
							$project_image_caption = strip_tags($project_image_caption);
							$project_image_caption_markup = null;
							if(!empty($project_image_caption)) $project_image_caption_markup = ' title="'.$project_image_caption.'" '; 	
						
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  
							$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
							$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
							$media = null;
							$date = null;
							$love = $nectar_love->add_love(); 
							$margin = ($full_width_carousel == 'true') ? 'no-margin' : null;
							
							$custom_project_link = get_post_meta($post->ID, '_nectar_external_project_url', true);
							$the_project_link = (!empty($custom_project_link)) ? $custom_project_link : get_permalink();
							
							$project_excerpt = get_post_meta($post->ID, '_nectar_project_excerpt', true);
							if(!empty($project_excerpt)) {
								 $date = '<p>'.$project_excerpt.'</p>'; 
							} elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) {
								 $date = '<p>' . get_the_date() . '</p>'; 
							} 
										
							$project_img = '<img src="'.get_template_directory_uri().'/img/no-portfolio-item-small.jpg" alt="no image added yet." />';
							if ( has_post_thumbnail() ) { $project_img = get_the_post_thumbnail($post->ID, 'portfolio-thumb', array('title' => '')); } 
							
							//custom thumbnail
							$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
							
							if( !empty($custom_thumbnail) ){
								$project_img = '<img class="custom-thumbnail" src="'.nectar_ssl_check($custom_thumbnail).'" alt="'. get_the_title() .'" />';
							}
							
							if($lightbox_only != 'true') {
								$link_markup = '<a href="' . $the_project_link . '"></a>';
							} else {
								
								//video 
							    if( !empty($video_embed) || !empty($video_m4v) ) {
				
								    if( !empty( $video_embed ) && floatval(get_bloginfo('version')) < "3.6" ) { 
								    	
								    	$link_markup = '<a href="#video-popup-'.$post->ID.'" class="pretty_photo"> </a> ';
										$link_markup .= '<div id="video-popup-'.$post->ID.'">';
								        $link_markup .= '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
										$link_markup .= '</div>';
								    } 
								    
								    else {
										 $link_markup = '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo" ></a> ';	 
								     } 
				
						        } 
								
						        //image
						        else {
						        	$link_markup = '<a href="'. $featured_image[0].'" '.$project_image_caption_markup.' class="pretty_photo"></a>';
						        }
								
							}
							
							$project_accent_color = get_post_meta($post->ID, '_nectar_project_accent_color', true);	 
							if(!empty($project_accent_color)) { $project_accent_color_markup = 'data-project-color="' . $project_accent_color .'"'; } else { $project_accent_color_markup = 'data-default-color="true"';} 
							$project_title_color = get_post_meta($post->ID, '_nectar_project_title_color', true);
						    $project_subtitle_color = get_post_meta($post->ID, '_nectar_project_subtitle_color', true);

						    $using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
							$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true);

							$recent_projects_content .='<li class="col span_4 '.$margin.'" '.$project_accent_color_markup.' data-title-color="'.$project_title_color.'" data-subtitle-color="'.$project_subtitle_color.'">
								
								<div class="work-item style-4" data-custom-content="'.$using_custom_content.'">' . $project_img . '
				
									<div class="work-info">
										
										'.$link_markup;
										
										if(!empty($using_custom_content) && $using_custom_content == 'on') {
											if(!empty($custom_project_link)) echo '<a href="'.$the_project_link.'"></a>';
											$recent_projects_content .= '<div class="vert-center"><div class="custom-content">' . do_shortcode($custom_content) . '</div></div>';
										   //default
										} else { 
											$recent_projects_content .= '<div class="bottom-meta"><h3>' . get_the_title() . '</h3>' . $date.'</div><!--/bottom-meta-->';
										}

									$recent_projects_content .= '</div>
								</div><!--work-item-->
	
							</li><!--/span_4-->';
						
						}

                      }
						
					} //project style 4
				
			
			if ( $the_query->have_posts() ) {
			 $recent_projects_content .= '</ul><!--/carousel--></div><!--/carousel-wrap-->';
			}

		wp_reset_postdata();


	
    return $recent_projects_content; 
	

}
add_shortcode('recent_projects', 'nectar_recent_projects');
 
 
 
 
 
//old video player	
if ( floatval(get_bloginfo('version')) < "3.6" ) {
		 
	//video
	function nectar_shortcode_video($atts, $content = null) {
		extract(shortcode_atts(array("title" => 'Title', 'm4v_url' => null, 'ogv_url' => null, 'image_url' => null, 'm4v' => null, 'ogv' => null, 'poster' => null), $atts));  
		$video_markup = null;
		
		$id = rand(); 
		$id = $id*rand(1,50);
	
		$video_m4v = null; 
		$video_ogv = null;
		$video_image = null;
		
		if (!empty($m4v_url)) { $video_m4v = $m4v_url; }
		if (!empty($m4v)) { $video_m4v = $m4v; }
		
		if (!empty($ogv_url)) { $video_ogv = $ogv_url; }
		if (!empty($ogv)) { $video_ogv = $ogv; }
		
		if (!empty($image_url)) { $video_image = $image_url; }
		if (!empty($poster)) { $video_image = $poster; } 

		if (empty($image_url) && empty($preview)) {
			$image_url = get_template_directory_uri().'/img/no-video-img.png'; 
		}

		$video_markup .= '<script type="text/javascript">
	    	jQuery(document).ready(function($){
			
	    		if( $().jPlayer ) {
	    			$("#jquery_jplayer_'.$id.'").jPlayer({
	    				ready: function () {
	    					$(this).jPlayer("setMedia", {
	    						m4v: "'.$video_m4v.'",
	    						ogv: "'. $video_ogv .'",
	    						poster: "'. $video_image .'"
	    					});
	    				},
	    				size: {
				          width: "100%",
				          height: "auto"
				        },
	    				swfPath: "'. get_template_directory_uri() .'/js",
	    				cssSelectorAncestor: "#jp_interface_'.$id.'",
	    				supplied: "m4v, ogv, all"
	    			});
	    		}
	    	});
	    </script>
	
	    <div id="jquery_jplayer_'.$id.'" class="jp-jplayer jp-jplayer-video"></div>
	
	    <div class="jp-video-container">
	        <div class="jp-video">
	            <div id="jp_interface_'.$id.'" class="jp-interface">
	                <ul class="jp-controls">
	                	<li><div class="seperator-first"></div></li>
	                    <li><div class="seperator-second"></div></li>
	                    <li><a href="#" class="jp-play" tabindex="1">play</a></li>
	                    <li><a href="#" class="jp-pause" tabindex="1">pause</a></li> 
	                    <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
	                    <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
	                </ul>
	                <div class="jp-progress">
	                    <div class="jp-seek-bar">
	                        <div class="jp-play-bar"></div>
	                    </div>
	                </div>
	                <div class="jp-volume-bar-container">
	                    <div class="jp-volume-bar">
	                        <div class="jp-volume-bar-value"></div>
	                    </div>
	                </div>
	            </div>
	
	        </div>
	    </div>';
		
		return $video_markup;
	
	}
	
	add_shortcode('video', 'nectar_shortcode_video');

}
 

 
//old audio player	 
if ( floatval(get_bloginfo('version')) < "3.6" ) {

	function nectar_shortcode_audio($atts, $content = null) {
		extract(shortcode_atts(array("title" => 'Title', 'mp3_url' => null, 'oga_url' => null, 'mp3' => null, 'ogg' => null), $atts));  
		$audio_markup = null;
		
		$id = rand();
		$id = $id*rand(1,50);
		
		$audio_mp3 = null;
		$audio_oga = null;
		
		if (!empty($mp3_url)) { $audio_mp3 = $m4v_url; }
		if (!empty($mp3)) { $audio_mp3 = $mp3; }
		
		if (!empty($oga_url)) { $audio_oga = $ogv_url; }
		if (!empty($ogg)) { $audio_oga = $ogg; }

		$audio_markup .= '<script type="text/javascript">
			
	    			jQuery(document).ready(function($){
		
	    				if( $().jPlayer ) {
	    					$("#jquery_jplayer_'.$id.'").jPlayer({
	    						ready: function () {
	    							$(this).jPlayer("setMedia", {
	    								mp3: "'.$audio_mp3.'",
	    								oga: "'.$audio_oga.'", 
	    							});
	    						},
	    						swfPath: "'. get_template_directory_uri().' /js",
	    						cssSelectorAncestor: "#jp_interface_'.$id.'",
	    						supplied: "oga, mp3, all"
	    					});
						
	    				}
	    			});
	    		</script>
				
				<div class="audio-wrap">
					
		    	    <div id="jquery_jplayer_'.$id.'" class="jp-jplayer jp-jplayer-audio"></div>
		
		            <div class="jp-audio-container">
		                <div class="jp-audio">
		                    <div id="jp_interface_'.$id.'" class="jp-interface">
		                        <ul class="jp-controls">
		                            <li><a href="#" class="jp-play" tabindex="1">play</a></li>
		                            <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
		                            <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
		                            <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
		                        </ul>
		                        <div class="jp-progress">
		                            <div class="jp-seek-bar">
		                                <div class="jp-play-bar"></div>
		                            </div>
		                        </div>
		                        <div class="jp-volume-bar-container">
		                            <div class="jp-volume-bar">
		                                <div class="jp-volume-bar-value"></div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
	            </div>';
	
	
	return $audio_markup;
	 
	}	
	
	add_shortcode('audio', 'nectar_shortcode_audio');

}

?>