<?php 
add_action('add_meta_boxes', 'nectar_metabox_nectar_slider');
function nectar_metabox_nectar_slider(){
    
    $meta_box = array(
		'id' => 'nectar-metabox-nectar-slider',
		'title' => __('Slide Settings', NECTAR_THEME_NAME),
		'description' => __('Please fill out & configure the fileds below to create your slide. The only mandatory field is the "Slide Image".', NECTAR_THEME_NAME),
		'post_type' => 'nectar_slider',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
		
			array( 
					'name' => __('Background Type', NECTAR_THEME_NAME),
					'desc' => __('Please select the background type you would like to use for your slide.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_bg_type',
					'type' => 'choice_below',
					'options' => array(
						'image_bg' => 'Image Background',
						'video_bg' => 'Video Background'
					),
					'std' => 'image_bg'
				),
			array( 
					'name' => __('Slide Image', NECTAR_THEME_NAME),
					'desc' => __('Click the "Upload" button to begin uploading your image, followed by "Select File" once you have made your selection.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_image',
					'type' => 'file',
					'std' => ''
				),
			array( 
					'name' => __('Video WebM Upload', NECTAR_THEME_NAME),
					'desc' => __('Browse for your WebM video file here.<br/> This will be automatically played on load so make sure to use this responsibly for enhancing your design, rather than annoy your user. e.g. A video loop with no sound.<br/><strong>You must include this format & the mp4 format to render your video with cross browser compatibility. OGV is optional.</strong> <br/><strong>Video must be in a 16:9 aspect ratio.</strong>', NECTAR_THEME_NAME),
					'id' => '_nectar_media_upload_webm',
					'type' => 'media',
					'std' => ''
				),
			array( 
					'name' => __('Video MP4 Upload', NECTAR_THEME_NAME),
					'desc' => __('Browse for your mp4 video file here.<br/> See the note above for recommendations on how to properly use your video background.', NECTAR_THEME_NAME),
					'id' => '_nectar_media_upload_mp4',
					'type' => 'media',
					'std' => ''
				),
			array( 
					'name' => __('Video OGV Upload', NECTAR_THEME_NAME),
					'desc' => __('Browse for your OGV video file here.<br/>  See the note above for recommendations on how to properly use your video background.', NECTAR_THEME_NAME),
					'id' => '_nectar_media_upload_ogv',
					'type' => 'media',
					'std' => ''
				),
			array( 
					'name' => __('Preview Image', NECTAR_THEME_NAME),
					'desc' => __('This is the image that will be seen in place of your video on mobile devices & older browsers before your video is played (browsers like IE8 don\'t allow autoplaying).', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_preview_image',
					'type' => 'file',
					'std' => ''
				),	
			array(
					'name' =>  __('Add texture overlay to background', NECTAR_THEME_NAME),
					'desc' => __('If you would like a slight texture overlay on your background, activate this option.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_video_texture',
					'type' => 'checkbox',
	                'std' => 1
				),	
			
			array( 
					'name' => __('Background Alignment', NECTAR_THEME_NAME),
					'desc' => __('Please choose how you would like your slides background to be aligned', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_slide_bg_alignment',
					'type' => 'select',
					'std' => 'center',
					'options' => array(
						"top" => "Top",
				  		 "center" => "Center",
				  		 "bottom" => "Bottom"
					)
				),
				
			array( 
					'name' => __('Slide Font Color', NECTAR_THEME_NAME),
					'desc' => __('This gives you an easy way to make sure your text is visible regardless of the background.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_slide_font_color',
					'type' => 'select',
					'std' => '',
					'options' => array(
						'light' => 'Light',
						'dark' => 'Dark'
					)
				),
				
			array( 
					'name' => __('Heading', NECTAR_THEME_NAME),
					'desc' => __('Please enter in the heading for your slide.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_heading',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Caption', NECTAR_THEME_NAME),
					'desc' => __('If you have a caption for your slide, enter it here', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_caption',
					'type' => 'textarea',
					'std' => ''
				),
			array(
					'name' =>  __('Caption Background', NECTAR_THEME_NAME),
					'desc' => __('If you would like to add a semi transparent background to your caption, activate this option.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_caption_background',
					'type' => 'checkbox',
	                'std' => ''
				),	
			array( 
					'name' => __('Insert Down Arrow That Leads to Content Below?', NECTAR_THEME_NAME),
					'desc' => __('This is particularly useful when using tall sliders to let the user know there\'s content underneath.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_down_arrow',
					'type' => 'checkbox',
					'std' => ''
				),	
			array( 
					'name' => __('Link Type', NECTAR_THEME_NAME),
					'desc' => __('Please select how you would like to link your slide.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_link_type',
					'type' => 'choice_below',
					'options' => array(
						'button_links' => 'Button Links',
						'full_slide_link' => 'Full Slide Link'
					),
					'std' => 'button_links'
				),	
			array( 
					'name' => __('Button Text', NECTAR_THEME_NAME),
					'desc' => __('Enter the text for your button here.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_button',
					'type' => 'slider_button_textarea',
					'std' => '',
					'extra' => 'first'
				),
			array( 
					'name' => __('Button Link', NECTAR_THEME_NAME),
					'desc' => __('Enter a URL here.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_button_url',
					'type' => 'slider_button_textarea',
					'std' => '',
					'extra' => 'inline'
				),
			array( 
					'name' => __('Button Style', NECTAR_THEME_NAME),
					'desc' => __('Desired button style', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_button_style',
					'type' => 'slider_button_select',
					'std' => '',
					'options' => array(
						'solid_color' => __('Solid Color BG', NECTAR_THEME_NAME),
						'solid_color_2' => __('Solid Color BG W/ Tilt Hover', NECTAR_THEME_NAME),
						'transparent' => __('Transparent With Border', NECTAR_THEME_NAME),
						'transparent_2' => __('Transparent W/ Solid BG Hover', NECTAR_THEME_NAME)
					),
					'extra' => 'inline'
				),
			array( 
					'name' => __('Button Color', NECTAR_THEME_NAME),
					'desc' => __('Desired color', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_button_color',
					'type' => 'slider_button_select',
					'std' => '',
					'options' => array(
						'primary-color' => __('Primary Color', NECTAR_THEME_NAME),
						'extra-color-1' => __('Extra Color #1', NECTAR_THEME_NAME),
						'extra-color-2' => __('Extra Color #2', NECTAR_THEME_NAME),
						'extra-color-3' => __('Extra Color #3', NECTAR_THEME_NAME)
					),
					'extra' => 'last'
				),
				
			
			array( 
					'name' => __('Button Text', NECTAR_THEME_NAME),
					'desc' => __('Enter the text for your button here.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_button_2',
					'type' => 'slider_button_textarea',
					'std' => '',
					'extra' => 'first'
				),
			array( 
					'name' => __('Button Link', NECTAR_THEME_NAME),
					'desc' => __('Enter a URL here.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_button_url_2',
					'type' => 'slider_button_textarea',
					'std' => '',
					'extra' => 'inline'
				),
			array( 
					'name' => __('Button Style', NECTAR_THEME_NAME),
					'desc' => __('Desired button style', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_button_style_2',
					'type' => 'slider_button_select',
					'std' => '',
					'options' => array(
						'solid_color' => __('Solid Color Background', NECTAR_THEME_NAME),
						'solid_color_2' => __('Solid Color BG W/ Tilt Hover', NECTAR_THEME_NAME),
						'transparent' => __('Transparent With Border', NECTAR_THEME_NAME),
						'transparent_2' => __('Transparent W/ Solid BG Hover', NECTAR_THEME_NAME)
					),
					'extra' => 'inline'
				),
			array( 
					'name' => __('Button Color', NECTAR_THEME_NAME),
					'desc' => __('Desired color', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_button_color_2',
					'type' => 'slider_button_select',
					'std' => '',
					'options' => array(
						'primary-color' => __('Primary Color', NECTAR_THEME_NAME),
						'extra-color-1' => __('Extra Color #1', NECTAR_THEME_NAME),
						'extra-color-2' => __('Extra Color #2', NECTAR_THEME_NAME),
						'extra-color-3' => __('Extra Color #3', NECTAR_THEME_NAME)
					),
					'extra' => 'last'
				),
				
			array( 
					'name' => __('Slide Link', NECTAR_THEME_NAME),
					'desc' => __('Please enter your URL that will be used to link the slide.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_entire_link',
					'type' => 'text',
					'std' => ''
				),
				
			array( 
					'name' => __('Slide Video Popup', NECTAR_THEME_NAME),
					'desc' => __('Enter in an embed code from Youtube or Vimeo that will be used to display your video in a popup. (You can also use the WordPress video shortcode)', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_video_popup',
					'type' => 'textarea',
					'std' => ''
				),
				
			array( 
					'name' => __('Slide Content Alignment', NECTAR_THEME_NAME),
					'desc' => __('Horizontal Alignment', NECTAR_THEME_NAME),
					'id' => '_nectar_slide_xpos_alignment',
					'type' => 'caption_pos',
					'options' => array(
						'left' => 'Left',
						'centered' => 'Centered',
						'right' => 'Right',
					),
					'std' => 'left',
					'extra' => 'first'
				),
				
			array( 
					'name' => __('Slide Content Alignment', NECTAR_THEME_NAME),
					'desc' => __('Vertical Alignment', NECTAR_THEME_NAME),
					'id' => '_nectar_slide_ypos_alignment',
					'type' => 'caption_pos',
					'options' => array(
						'top' => 'Top',
						'middle' => 'Middle',
						'bottom' => 'Bottom',
					),
					'std' => 'middle',
					'extra' => 'last'
				),
			array( 
				'name' => __('Extra Class Name', NECTAR_THEME_NAME),
				'desc' => __('If you would like to enter a custom class name to this slide for css purposes, enter it here.', NECTAR_THEME_NAME),
				'id' => '_nectar_slider_slide_custom_class',
				'type' => 'text',
				'std' => ''
			)
		)
	);
	$callback = create_function( '$post,$meta_box', 'nectar_create_meta_box( $post, $meta_box["args"] );' );
	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
	
	
	
}


?>