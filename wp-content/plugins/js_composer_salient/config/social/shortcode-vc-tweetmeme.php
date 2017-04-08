<?php
return array(
	'name' => __( 'Tweetmeme Button', 'js_composer' ),
	'base' => 'vc_tweetmeme',
	'icon' => 'icon-wpb-tweetme',
	'show_settings_on_create' => false,
	'category' => __( 'Social', 'js_composer' ),
	'description' => __( '"Tweet" button', 'js_composer' ),
	'params' => array(
		/* Old fashion, since 2015 twitter changed behaviour, no more counter exists: see https://twittercommunity.com/t/a-new-design-for-tweet-and-follow-buttons/52791
		 * array(
			'type' => 'dropdown',
			'heading' => __( 'Button type', 'js_composer' ),
			'param_name' => 'type',
			'admin_label' => true,
			'value' => array(
				__( 'Horizontal with count', 'js_composer' ) => 'horizontal',
				__( 'Vertical with count', 'js_composer' ) => 'vertical',
				__( 'Horizontal', 'js_composer' ) => 'none',
			),
			'description' => __( 'Select button type.', 'js_composer' ),
		),*/
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		),
	),
);