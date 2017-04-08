<?php 

extract(shortcode_atts(array("size" => 'small', "url" => '#', 'button_style' => '', 'button_color_2' => '', 'button_color' => '', 'color_override' => '', 'hover_color_override' => '', 'hover_text_color_override' => '#fff', "text" => 'Button Text', 'icon_family' => '', 'icon_fontawesome' => '', 'icon_linecons' => '', 'icon_steadysets' => '', 'open_new_tab' => '0', 
	'margin_top' => '','margin_right' => '','margin_bottom' => '', 'margin_left' => ''), $atts));


$target = ($open_new_tab == 'true') ? 'target="_blank"' : null;
	
	//icon
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

	if(!empty($icon_family) && $icon_family != 'none') {
		$button_icon = '<i class="' . $icon .'"></i>'; $has_icon = ' has-icon'; 
	} 
	else {
		$button_icon = null; $has_icon = null;
	}

	$color = ($button_style == 'regular' || $button_style == 'see-through') ? $button_color_2 : $button_color;
	
	$stnd_button = null;
	if( strtolower($color) == 'accent-color' || strtolower($color) == 'extra-color-1' || strtolower($color) == 'extra-color-2' || strtolower($color) == 'extra-color-3') {
		$stnd_button = " regular-button";
	}
	
	$button_open_tag = '';

	if($button_style == 'regular-tilt') {
		$color = $color . ' tilt';
		$button_open_tag = '<div class="tilt-button-wrap"> <div class="tilt-button-inner">';
	}


	if($color == 'extra-color-gradient-1' && $button_style == 'see-through' || $color == 'extra-color-gradient-2' && $button_style == 'see-through')
		$style_color = $button_style . '-'. strtolower($color);
	else
		$style_color = $button_style . ' '. strtolower($color);

	//margins
	$margins = '';
	if(!empty($margin_top))
		$margins .= 'margin-top: '.intval($margin_top).'px; ';
	if(!empty($margin_right))
		$margins .= 'margin-right: '.intval($margin_right).'px; ';
	if(!empty($margin_bottom))
		$margins .= 'margin-bottom: '.intval($margin_bottom).'px; ';
	if(!empty($margin_left))
		$margins .= 'margin-left: '.intval($margin_left).'px;';

	switch ($size) {

		case 'small' :
			$button_open_tag .= '<a class="nectar-button small '. $style_color . $has_icon . $stnd_button.'" style="'.$margins.'" '. $target;
			break;
		case 'medium' :
			$button_open_tag .= '<a class="nectar-button medium ' . $style_color . $has_icon . $stnd_button.'" style="'.$margins.'" '. $target;
			break;
		case 'large' :
			$button_open_tag .= '<a class="nectar-button large '. $style_color . $has_icon . $stnd_button.'" style="'.$margins.'" '. $target;
			break;	
		case 'jumbo' :
			$button_open_tag .= '<a class="nectar-button jumbo '. $style_color . $has_icon . $stnd_button.'" style="'.$margins.'" '. $target;
			break;	
		case 'extra_jumbo' :
			$button_open_tag .= '<a class="nectar-button extra_jumbo '. $style_color . $has_icon . $stnd_button.'" style="'.$margins.'" '. $target;
			break;	
	}
	
	$color_or = (!empty($color_override)) ? 'data-color-override="'. $color_override.'" ' : 'data-color-override="false" ';	
	$hover_color_override = (!empty($hover_color_override)) ? ' data-hover-color-override="'. $hover_color_override.'"' : 'data-hover-color-override="false"';
	$hover_text_color_override = (!empty($hover_text_color_override)) ? ' data-hover-text-color-override="'. $hover_text_color_override.'"' :  null;	
	$button_close_tag = null;

	if($color == 'accent-color tilt' || $color == 'extra-color-1 tilt' || $color == 'extra-color-2 tilt' || $color == 'extra-color-3 tilt') $button_close_tag = '</div></div>';

	if($button_style != 'see-through-3d') {
		if($color == 'extra-color-gradient-1' || $color == 'extra-color-gradient-2')
			echo $button_open_tag . ' href="' . $url . '" '.$color_or.$hover_color_override.$hover_text_color_override.'><span class="start loading">' . $text . $button_icon. '</span><span class="hover">' . $text . $button_icon. '</span></a>'. $button_close_tag;
		else
			echo $button_open_tag . ' href="' . $url . '" '.$color_or.$hover_color_override.$hover_text_color_override.'><span>' . $text . '</span>'. $button_icon . '</a>'. $button_close_tag;
	

    	
	}
	else {

		$color = (!empty($color_override)) ? $color_override : '#ffffff';
		$border = ($size != 'jumbo') ? 8 : 10;
		if($size =='extra_jumbo') $border = 20;
		echo '
		<div class="nectar-3d-transparent-button" style="'.$margins.'" data-size="'.$size.'">
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



?>