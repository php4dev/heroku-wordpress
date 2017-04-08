<?php 

extract(shortcode_atts(array("carousel_title" => '', "scroll_speed" => 'medium', 'easing' => 'easeInExpo', 'autorotate' => '', 'enable_animation' => '', 'delay' => '', 'autorotation_speed' => '5000','column_padding' => '' ,'script' => 'carouFredSel', 'desktop_cols' => '4', 'desktop_small_cols' => '3', 'tablet_cols' => '2','mobile_cols' => '1'), $atts));

$GLOBALS['nectar-carousel-script'] = $script;

if($script == 'carouFredSel') {
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
	<ul class="row carousel" data-scroll-speed="' . $scroll_speed . '" data-easing="' . $easing . '" data-autorotate="' . $autorotate . '">';

	echo $carousel_html . do_shortcode($content) . '</ul></div>';
} else if($script == 'owl_carousel') {
	$delay = intval($delay);
	echo '<div class="owl-carousel" data-enable-animation="'.$enable_animation.'" data-animation-delay="'.$delay.'" data-autorotate="' . $autorotate . '" data-autorotation-speed="'.$autorotation_speed.'" data-column-padding="'.$column_padding.'" data-desktop-cols="'.$desktop_cols.'" data-desktop-small-cols="'.$desktop_small_cols.'" data-tablet-cols="'.$tablet_cols.'" data-mobile-cols="'.$mobile_cols.'">'.do_shortcode($content).'</div>';
}

?>