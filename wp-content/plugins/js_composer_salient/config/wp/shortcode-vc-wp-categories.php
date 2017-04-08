<?php
return array(
	'name' => 'WP ' . __( 'Categories' ),
	'base' => 'vc_wp_categories',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'A list or dropdown of categories', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' ),
			'value' => __( 'Categories' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Display options', 'js_composer' ),
			'param_name' => 'options',
			'value' => array(
				__( 'Dropdown', 'js_composer' ) => 'dropdown',
				__( 'Show post counts', 'js_composer' ) => 'count',
				__( 'Show hierarchy', 'js_composer' ) => 'hierarchical',
			),
			'description' => __( 'Select display options for categories.', 'js_composer' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
	),
);