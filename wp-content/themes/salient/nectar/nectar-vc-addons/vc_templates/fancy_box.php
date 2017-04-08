<?php

$title = $el_class = $value = $label_value= $units = '';
extract(shortcode_atts(array(
	'image_url' => '',
	'link_url' => '',
	'link_new_tab' => '',
	'link_text' => '',
	'min_height' => '300',
	'color' => 'accent-color'
), $atts));

$style = null;

$new_tab_markup = ($link_new_tab == true) ? 'target="_blank"' : null;

if(!empty($image_url)) {
	
	$bg_image_src = wp_get_attachment_image_src($image_url, 'full');
	$style .= ' style="background-image: url(\''.$bg_image_src[0].'\'); "';
}

$box_link = null;
if(!empty($link_url)) {
	$box_link = '<a '.$new_tab_markup.' href="'.$link_url.'" class="box-link"></a>';
}
$text_link = null;
if(!empty($link_text)) {
	$text_link = '<div class="link-text">'.$link_text.'<span class="arrow"></span></div>';
}

$output = '<div class="nectar-fancy-box" data-color="'.strtolower($color).'">';
$output .= '<div class="box-bg" '.$style.'></div> <div class="inner" style="min-height: '.$min_height.'px">'.do_shortcode($content).'</div> '.$text_link.' '.$box_link.' </div>';


echo $output;