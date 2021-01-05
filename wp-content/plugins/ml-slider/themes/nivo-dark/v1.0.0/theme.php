<?php
if (!defined('ABSPATH')) die('No direct access.');

/*
	Replace 'nivo-dark' by the theme's id
	Replace 

*/
if (!isset(MetaSlider_Theme_Base::$themes['nivo-dark'])) {
	// instanciate the theme
	new MetaSlider_Theme_Base(
		'nivo-dark', 		// ID
		'1.0.0', 		// version
		array( 			// assets
			array(
				'type' => 'css',
				'file' => '/v1.0.0/style.min.css',
				'dependencies' => array('metaslider-public')
			),
			array(
				'type' => 'js',
				'file' => '/v1.0.0/script.js',
				'dependencies' => array('jquery')
			)
		)
	);

	// Sets the slideshow arrows
	// Can use text, svg icons, Font Awesome or any icon fonts (Loading a whole icon set for 2 icons isn't recommended, so svg is a better option.)
	MetaSlider_Theme_Base::$themes['nivo-dark']->slider_parameters = array();
}
