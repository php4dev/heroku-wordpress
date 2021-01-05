<?php
if (!defined('ABSPATH')) die('No direct access.');

/*
	Replace 'starter' by the theme's id
	Replace 

*/
if (!isset(MetaSlider_Theme_Base::$themes['starter'])) {
	// instanciate the theme
	new MetaSlider_Theme_Base(
		'starter', 		// ID
		'1.0.0', 		// version
		array( 			// assets
			array(
				'type' => 'css',
				'file' => '/v1.0.0/style.min.css',
				'dependencies' => array('metaslider-public')
			),
		)
	);

	// Sets the slideshow arrows
	// Can use text, svg icons, Font Awesome or any icon fonts (Loading a whole icon set for 2 icons isn't recommended, so svg is a better option.)
	MetaSlider_Theme_Base::$themes['starter']->slider_parameters = array(
		'prevText' => "'<svg role=\'img\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 80 80\'><path fill=\'currentColor\' d=\'M57.506,79.616c-0.938,0-1.878-0.359-2.595-1.075L19.212,42.843c-1.434-1.434-1.434-3.758,0-5.191L55.598,1.267 c1.433-1.433,3.756-1.433,5.189,0c1.436,1.433,1.436,3.758,0,5.191l-33.789,33.79l33.102,33.103c1.436,1.433,1.436,3.758,0,5.19 C59.385,79.257,58.445,79.616,57.506,79.616z\'/></svg>'",
		'nextText' => "'<svg role=\'img\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 80 80\'><path fill=\'currentColor\' d=\'M22.495,0.192c0.938,0,1.878,0.359,2.595,1.075l35.699,35.698c1.434,1.434,1.434,3.758,0,5.191L24.403,78.541 c-1.433,1.434-3.756,1.434-5.189,0c-1.436-1.433-1.436-3.758,0-5.19l33.788-33.79L19.9,6.458c-1.436-1.433-1.436-3.758,0-5.19 C20.616,0.552,21.556,0.192,22.495,0.192z\'/></svg>'"
	);
}
