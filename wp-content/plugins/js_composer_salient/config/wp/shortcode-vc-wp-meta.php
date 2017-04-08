<?php
return array(
	'name' => 'WP ' . __( 'Meta' ),
	'base' => 'vc_wp_meta',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Log in/out, admin, feed and WordPress links', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' ),
			'value' => __( 'Meta' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
	),
);