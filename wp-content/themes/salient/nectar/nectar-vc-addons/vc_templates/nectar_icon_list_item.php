<?php 

extract(shortcode_atts(array("icon_type" => "numerical", 'icon_family' => 'fontawesome', 'icon_fontawesome' => '', 'icon_linea' => '', 'icon_steadysets' => '', "header" => "", "text" => ""), $atts));

$icon_markup = null;
switch($icon_family) {
	case 'fontawesome':
		$icon = $icon_fontawesome;
		break;
	case 'steadysets':
		$icon = $icon_steadysets;
		break;
	case 'linecons':
		$icon = $icon_linecons;
		break;
	default:
		$icon = '';
		break;
}

if($icon_family == 'linea' && $icon_type != 'numerical' ) wp_enqueue_style('linea'); 

if(!empty($icon)) {
	if($GLOBALS['nectar-list-item-icon-style'] == 'border' || $GLOBALS['nectar-list-item-icon-style'] == 'no-border')
		$icon_markup = '<i class="icon-default-style '.$icon.'" data-color="'.strtolower($GLOBALS['nectar-list-item-icon-color']).'"></i>';
	else
		$icon_markup = '<i class="icon-default-style '.$icon.'"></i>';
}

$icon_output = ($icon_type == 'numerical') ? '<span>'. $GLOBALS['nectar-list-item-count'] . '</span>' : $icon_markup;

echo '<div class="nectar-icon-list-item"><div class="list-icon-holder" data-icon_type="'.$icon_type.'">'.$icon_output.'</div><div class="content"><h4>'.$header.'</h4>'.$text.'</div></div>';

$GLOBALS['nectar-list-item-count']++;

?>