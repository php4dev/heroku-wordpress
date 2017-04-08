<?php 

extract(shortcode_atts(array("autorotate"=>'', "disable_height_animation"=>'','style'=>'default', 'color' => ''), $atts));

$height_animation_class = null;
if($disable_height_animation == 'true') $height_animation_class = 'disable-height-animation';


echo '<div class="col span_12 testimonial_slider '.$height_animation_class.'" data-color="'.$color.'" data-autorotate="'.$autorotate.'" data-style="'.$style.'" ><div class="slides">'.do_shortcode($content).'</div></div>';

?>