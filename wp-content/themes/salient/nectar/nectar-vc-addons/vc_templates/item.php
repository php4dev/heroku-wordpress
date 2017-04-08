<?php 

if($GLOBALS['nectar-carousel-script'] == 'carouFredSel') {
	echo '<li class="col span_4">' . do_shortcode($content) . '</li>';
} else if($GLOBALS['nectar-carousel-script'] == 'owl_carousel') {
	echo '<div class="carousel-item">' . do_shortcode($content) . '</div>';
}

?>