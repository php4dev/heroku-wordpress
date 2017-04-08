<?php
return array(
	'name' => __( 'Facebook Like', 'js_composer' ),
	'base' => 'vc_facebook',
	'icon' => 'icon-wpb-balloon-facebook-left',
	'category' => __( 'Social', 'js_composer' ),
	'description' => __( 'Facebook "Like" button', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button type', 'js_composer' ),
			'param_name' => 'type',
			'admin_label' => true,
			'value' => array(
				__( 'Horizontal', 'js_composer' ) => 'standard',
				__( 'Horizontal with count', 'js_composer' ) => 'button_count',
				__( 'Vertical with count', 'js_composer' ) => 'box_count',
			),
			'description' => __( 'Select button type.', 'js_composer' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		),
	),
);