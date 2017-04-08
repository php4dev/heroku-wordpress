<?php 

extract(shortcode_atts(array("name" => '',"subtitle" => '', "quote" => '', 'image' => ''), $atts));

$has_bg = null;
$bg_markup = null;

if(!empty($image)){
	$image_src = wp_get_attachment_image_src($image, 'medium');
	$image = $image_src[0];

	$has_bg = 'has-bg';
	$bg_markup = 'style="background-image: url('.$image.');"';
}

echo '<blockquote> <div class="image-icon '.$has_bg.'" '.$bg_markup.'>&#8220;</div> <p>'.$quote.' <span class="bottom-arrow"></span></p>'. '<span>'.$name.'</span><span class="title">'.$subtitle.'</span></blockquote>';

?>