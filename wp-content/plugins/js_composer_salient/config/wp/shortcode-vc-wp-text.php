<?php
return array(
	'name' => 'WP ' . __( 'Text' ),
	'base' => 'vc_wp_text',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Arbitrary text or HTML', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' ),
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __( 'Text', 'js_composer' ),
			'param_name' => 'content',
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
	),
);