<?php
return array(
	'name' => 'WP ' . __( 'Pages' ),
	'base' => 'vc_wp_pages',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Your sites WordPress Pages', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' ),
			'value' => __( 'Pages' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', 'js_composer' ),
			'param_name' => 'sortby',
			'value' => array(
				__( 'Page title', 'js_composer' ) => 'post_title',
				__( 'Page order', 'js_composer' ) => 'menu_order',
				__( 'Page ID', 'js_composer' ) => 'ID',
			),
			'description' => __( 'Select how to sort pages.', 'js_composer' ),
			'admin_label' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Exclude', 'js_composer' ),
			'param_name' => 'exclude',
			'description' => __( 'Enter page IDs to be excluded (Note: separate values by commas (,)).', 'js_composer' ),
			'admin_label' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
	),
);