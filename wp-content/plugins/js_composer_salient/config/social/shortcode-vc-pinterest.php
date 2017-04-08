<?php
return array(
	'name' => __( 'Pinterest', 'js_composer' ),
	'base' => 'vc_pinterest',
	'icon' => 'icon-wpb-pinterest',
	'category' => __( 'Social', 'js_composer' ),
	'description' => __( 'Pinterest button', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button type', 'js_composer' ),
			'param_name' => 'type',
			'admin_label' => true,
			'value' => array(
				__( 'Horizontal', 'js_composer' ) => 'horizontal',
				__( 'Vertical', 'js_composer' ) => 'vertical',
				__( 'No count', 'js_composer' ) => 'none',
			),
			'description' => __( 'Select button layout.', 'js_composer' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		),
	),
);