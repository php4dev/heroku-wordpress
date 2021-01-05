<?php
/**
 * A list of themes. For now they will be sorted outside this file,
 * but as the list grows we might want to start organizing this list
 * The type should be free, premium, or bonus
 */
return array(
	'cubic' => array(
		'folder' => 'cubic',
		'title' => 'Cubic',
		'type' => 'free',
		'supports' => array('flex', 'responsive', 'nivo', 'coin'),
		'tags' => array('light', 'square', 'bold', 'flat'),
		'description' => __('A simple, slick square design that looks good on darker images.', 'ml-slider'),
		'images' => array('andre-benz-631450-unsplash.jpg', 'etienne-beauregard-riverin-48305-unsplash.jpg', 'wabi-jayme-578762-unsplash.jpg', 'dorigo-wu-14676-unsplash.jpg', 'olav-ahrens-rotne-1087667-unsplash.jpg')
	),
	'outline' => array(
		'folder' => 'outline',
		'title' => 'Outline',
		'type' => 'free',
		'supports' => array('flex', 'responsive', 'nivo', 'coin'),
		'tags' => array('light', 'lines', 'bold', 'square'),
		'description' => __('A clean, subtle theme that features block arrows and bold design.', 'ml-slider'),
		'images' => array('wabi-jayme-578762-unsplash.jpg', 'nick-cooper-731773-unsplash.jpg', 'olav-ahrens-rotne-1087667-unsplash.jpg', 'muhammad-rizki-1094746-unsplash.jpg', 'dorigo-wu-14676-unsplash.jpg')
	),
	'bubble' => array(
		'folder' => 'bubble',
		'title' => 'Bubble',
		'type' => 'free',
		'supports' => array('flex', 'responsive', 'nivo', 'coin'),
		'tags' => array('light', 'bold', 'round'),
		'description' => __('A fun, circular design to brighten up your site. This theme works well with dark images', 'ml-slider'),
		'images' => array('timothy-eberly-728185-unsplash.jpg', 'wabi-jayme-578762-unsplash.jpg', 'ella-olsson-1094090-unsplash.jpg', 'fabio-mangione-236846-unsplash.jpg', 'victoria-shes-1096105-unsplash.jpg')
	),
	'simply-dark' => array(
		'folder' => 'simply-dark',
		'title' => 'Simply Dark',
		'type' => 'free',
		'supports' => array('flex', 'responsive', 'nivo', 'coin'),
		'tags' => array('dark', 'minimalist'),
		'description' => __('A minimalistic, no-frills design that was built to blend in with most themes.', 'ml-slider'),
		'images' => array(
			array(
				'filename' => 'etienne-beauregard-riverin-48305-unsplash.jpg',
				// 'caption' => 'Here is an example of a slide with a caption.',
				// 'title' => 'About Us',
				// 'alt' => 'A photo of our office',
				// 'description' => 'A description is also possible'
			),
			array(
				'filename' => 'danny-howe-361436-unsplash.jpg',
				// 'caption' => '<h2>Captions can have<br><span style="font-size:130%">HTML</span></h2>.'
			),
			array(
				'filename' => 'norbert-levajsics-203627-unsplash.jpg',
				// 'caption' => ''
			),
			array(
				'filename' => 'manki-kim-269196-unsplash.jpg', 
			),
			array(
				'filename' => 'danny-howe-361436-unsplash.jpg'
			)
		),
		'instructions' => 'Optionally you can add some special instructions for the user to follow. You can also use <strong>HTML</strong>'
	),
	'jenga' => array(
		'folder' => 'jenga',
		'title' => 'Jenga',
		'type' => 'free',
		'supports' => array('flex', 'responsive', 'nivo', 'coin'),
		'tags' => array('light', 'minimalist'),
		'description' => __('This theme places the controls vertically for a unique look.', 'ml-slider'),
		'images' => array('michael-discenza-unsplash.jpg', 'etienne-beauregard-riverin-48305-unsplash.jpg', 'wabi-jayme-578762-unsplash.jpg', 'dorigo-wu-14676-unsplash.jpg', 'nick-cooper-731773-unsplash.jpg')
	),
	'disjoint' => array(
		'folder' => 'disjoint',
		'title' => 'Disjoint',
		'type' => 'free',
		'supports' => array('flex', 'responsive', 'nivo', 'coin'),
		'tags' => array('light', 'bold', 'square'),
		'description' => __('A futuristic and linear design that goes will with a dark background.', 'ml-slider'),
		'images' => array('artem-bali-680991-unsplash.jpg', 'manki-kim-269196-unsplash.jpg', 'danny-howe-361436-unsplash.jpg', 'victoria-shes-1096105-unsplash.jpg', 'ella-olsson-1094090-unsplash.jpg')
	),
	'blend' => array(
		'folder' => 'blend',
		'title' => 'Blend',
		'type' => 'free',
		'supports' => array('flex', 'responsive', 'nivo', 'coin'),
		'tags' => array('light', 'minimalist', 'lines'),
		'description' => __('A simple theme that neatly blends into any existing website.', 'ml-slider'),
		'images' => array('manki-kim-269196-unsplash.jpg', 'dorigo-wu-14676-unsplash.jpg', 'artem-bali-680991-unsplash.jpg', 'fabio-mangione-236846-unsplash.jpg', 'olav-ahrens-rotne-1087667-unsplash.jpg')
	),
   	'precognition' => array(
      	'folder' => 'precognition',
      	'title' => 'Precognition',
      	'type' => 'free',
      	'supports' => array('flex', 'responsive', 'nivo', 'coin'),
      	'tags' => array('light', 'special'),
		'description' => __('This theme has a special additional functionality that uses image titles as the slide navigation. ', 'ml-slider'),
		'instructions' => 'If you would like to use the image titles as the navigation, you will need to use FlexSlider. Additionally, to change the slide navigation label, edit the image title in the media library or manually on the slide (SEO tab).',
      	'images' => array(
		  	array(
				'filename' => 'norbert-levajsics-203627-unsplash.jpg',
				'title' => 'Image by Norbert Levajsics'
			),
			array(
				'filename' => 'danny-howe-361436-unsplash.jpg',
				'title' => 'Image by Danny Howe'
			),
			array(
				'filename' => 'manki-kim-269196-unsplash.jpg',
				'title' => 'Image by Manki Kim'
			),
			array(
				'filename' => 'yoann-siloine-532511-unsplash.jpg',
				'title' => 'Image by Yoann Siloine'
			),
			array(
				'filename' => 'erol-ahmed-305920-unsplash.jpg',
				'title' => 'Image by Erol Ahmed'
			),
		)
	),
	'radix' => array(
		'folder' => 'radix',
		'title' => 'Radix',
		'type' => 'free',
		'supports' => array('flex', 'responsive', 'nivo', 'coin'),
		'tags' => array('light', 'special', 'square'),
		'description' => __('This theme has a unique design that gives it a sophisticated look.', 'ml-slider'),
		'images' => array('margo-brodowicz-183156-unsplash.jpg', 'manki-kim-269196-unsplash.jpg', 'artem-bali-680991-unsplash.jpg', 'ella-olsson-1094090-unsplash.jpg', 'muhammad-rizki-1094746-unsplash.jpg')
	),
	'highway' => array(
		'folder' => 'highway',
		'title' => 'Highway',
		'type' => 'free',
		'supports' => array('flex', 'responsive', 'nivo', 'coin'),
		'tags' => array('light', 'bold', 'square', 'rounded'),
		'description' => __('A bold and clear design that works well on a darker images.', 'ml-slider'),
		'images' => array('nick-cooper-731773-unsplash.jpg', 'victoria-shes-1096105-unsplash.jpg', 'tim-peterson-1099515-unsplash.jpg', 'ella-olsson-1094090-unsplash.jpg', 'olav-ahrens-rotne-1087667-unsplash.jpg')
	),
	'architekt' => array(
		'folder' => 'architekt',
		'title' => 'The Architekt',
		'type' => 'free',
		'supports' => array('flex', 'responsive', 'nivo'),
		'tags' => array('light', 'minimalist'),
		'description' => __('A minimalist theme that gets out of the way so you can showcasing your beautiful pictures.', 'ml-slider'),
		'images' => array('danny-howe-361436-unsplash.jpg', 'etienne-beauregard-riverin-48305-unsplash.jpg', 'luca-bravo-198062-unsplash.jpg', 'fabio-mangione-236846-unsplash.jpg', 'olav-ahrens-rotne-1087667-unsplash.jpg')
	),
	'nivo-light' => array(
		'folder' => 'nivo-light',
		'title' => 'Nivo Light',
		'type' => 'free', 
		'supports' => array('nivo'),
		'tags' => array('nivo only'),
		'description' => __('The Nivo Light theme included here for legacy purposes. Note: only works with Nivo Slider', 'ml-slider'),
	),
	'nivo-bar' => array(
		'folder' => 'nivo-bar',
		'title' => 'Nivo Bar',
		'type' => 'free',
		'supports' => array('nivo'),
		'tags' => array('nivo only'),
		'description' => __('The Nivo Bar theme included here for legacy purposes. Note: only works with Nivo Slider', 'ml-slider'),
	),
	'nivo-dark' => array(
		'folder' => 'nivo-dark',
		'title' => 'Nivo Dark',
		'type' => 'free',
		'supports' => array('nivo'),
		'tags' => array('nivo only'),
		'description' => __('The Nivo Dark theme included here for legacy purposes. Note: only works with Nivo Slider', 'ml-slider'),
	)
);
