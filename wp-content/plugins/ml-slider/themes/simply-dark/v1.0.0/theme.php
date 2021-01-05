<?php

if (!defined('ABSPATH')) {
    die('No direct access.');
}

if (!isset(MetaSlider_Theme_Base::$themes['simply-dark'])) {

    // instanciate the theme
    $ms_theme_simply_dark = new MetaSlider_Theme_Base(
        'simply-dark', 	// ID
        '1.0.0', 		// version
        array( 			// assets
            array(
                'type' => 'css',
                'file' => '/v1.0.0/style.min.css',
                'dependencies' => array('metaslider-public')
            )
        )
    );

    // sets the slideshow arrows
    // to avoid the variable, it could also be MetaSlider_Theme_Base::$themes['simply-dark']->slider_parameters
    $ms_theme_simply_dark->slider_parameters = array(
        'prevText' => "'<svg aria-labelledBy=\'simply-dark-prev-title\' role=\'img\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 256 512\' data-fa-i2svg=\'\'><title id=\'simply-dark-prev-title\'>" . __('Previous Slide', 'ml-slider') . "</title><path fill=\'currentColor\' d=\'M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z\'></path></svg>'",

        'nextText' => "'<svg aria-labelledBy=\'simply-dark-next-title\' role=\'img\' xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 256 512\' data-fa-i2svg=\'\'><title id=\'simply-dark-next-title\'>" . __('Next Slide', 'ml-slider') . "</title><path fill=\'currentColor\' d=\'M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z\'></path></svg>'"
    );
}
