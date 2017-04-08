<?php 
add_action('add_meta_boxes', 'nectar_metabox_home_slider');
function nectar_metabox_home_slider(){
    
    $meta_box = array(
		'id' => 'nectar-metabox-home-slider',
		'title' => __('Slide Settings', NECTAR_THEME_NAME),
		'description' => __('If you want a full width header with background image, please fill out the fields below.', NECTAR_THEME_NAME),
		'post_type' => 'home_slider',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('Slide Image', NECTAR_THEME_NAME),
					'desc' => __('The image should be between 1600px - 2000px in width and have a minimum height of 700px for best results. Click the "Upload" button to begin uploading your image, followed by "Select File" once you have made your selection.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_image',
					'type' => 'file',
					'std' => ''
				),
			array( 
					'name' => __('Caption', NECTAR_THEME_NAME),
					'desc' => __('Enter in the slide caption. (should be fairly short)', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_caption',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Button Text', NECTAR_THEME_NAME),
					'desc' => __('If you would like a button to appear below your caption, please enter the text for it here.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_button',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Button Link', NECTAR_THEME_NAME),
					'desc' => __('Please enter the URL for the button here.', NECTAR_THEME_NAME),
					'id' => '_nectar_slider_button_url',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Slide Alignment', NECTAR_THEME_NAME),
					'desc' => __('Select the alignment for your caption and button.', NECTAR_THEME_NAME),
					'id' => '_nectar_slide_alignment',
					'type' => 'slide_alignment',
					'options' => array(
						'left' => 'Left',
						'centered' => 'Centered',
						'right' => 'Right',
					),
					'std' => 'left'
				)
		)
	);
	$callback = create_function( '$post,$meta_box', 'nectar_create_meta_box( $post, $meta_box["args"] );' );
	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
	
	
	
	
	
	#-----------------------------------------------------------------#
	# Video 
	#-----------------------------------------------------------------#

    $meta_box = array(
		'id' => 'nectar-metabox-slider-video',
		'title' => __('Slide Video Settings', NECTAR_THEME_NAME),
		'description' => __('If you want to feature a video in this slide, please fill out the fields below. <strong>Your video & image should be in a 16:9 aspect ratio.</strong>', NECTAR_THEME_NAME),
		'post_type' => 'home_slider',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('M4V File URL', NECTAR_THEME_NAME),
					'desc' => __('Please upload the .m4v video file. <br/><strong>You must include both formats.</strong>', NECTAR_THEME_NAME),
					'id' => '_nectar_video_m4v',
					'type' => 'media', 
					'std' => ''
				),
			array( 
					'name' => __('OGV File URL', NECTAR_THEME_NAME),
					'desc' => __('Please upload the .ogv video file  <br/><strong>You must include both formats.</strong>', NECTAR_THEME_NAME),
					'id' => '_nectar_video_ogv',
					'type' => 'media',
					'std' => ''
				),
			array( 
					'name' => __('Preview Image', NECTAR_THEME_NAME),
					'desc' => __('Image should be at least 680px wide. Click the "Upload" button to begin uploading your image, followed by "Select File" once you have made your selection. Only applies to self hosted videos.', NECTAR_THEME_NAME),
					'id' => '_nectar_video_poster',
					'type' => 'file',
					'std' => ''
				),
			array(
					'name' => __('Embedded Code', NECTAR_THEME_NAME),
					'desc' => __('If the video is an embed rather than self hosted, enter in a Vimeo or Youtube embed code here. <strong> Embeds work worse with the parallax effect, but if you must use this, Vimeo is recommended. </strong> ', NECTAR_THEME_NAME),
					'id' => '_nectar_video_embed',
					'type' => 'textarea',
					'std' => ''
				)
		
		)
	);

	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
	
}


?>