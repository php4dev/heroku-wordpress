<?php 

$top = $left = $position = '';
extract(shortcode_atts(array(
	'top' => '',
	'left' => '',
	'position' => 'top',
), $atts));

$hotspot_icon = ($GLOBALS['nectar-image_hotspot-icon'] == 'plus_sign') ? '': $GLOBALS['nectar-image_hotspot-count'];
$click_class = ($GLOBALS['nectar-image_hotspot-tooltip-func'] == 'click') ? 'click': null;

$tooltip_content_class = (empty($content)) ? 'empty-tip' : null;

echo '<div class="nectar_hotspot_wrap" style="top: '.$top.'; left: '.$left.';"><div class="nectar_hotspot '.$click_class.'"><span>'.$hotspot_icon.'</span></div><div class="nttip '.$tooltip_content_class.'" data-tooltip-position="'.$position.'"><div class="inner">'.$content.'</div></div></div>';

$GLOBALS['nectar-image_hotspot-count']++;


?>