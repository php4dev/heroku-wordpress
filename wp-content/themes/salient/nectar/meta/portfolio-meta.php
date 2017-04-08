<?php


#-----------------------------------------------------------------#
# Create the Portfolio meta boxes
#-----------------------------------------------------------------# 

add_action('add_meta_boxes', 'nectar_metabox_portfolio');
function nectar_metabox_portfolio(){
	
	
	$options = get_nectar_theme_options(); 
	if(!empty($options['transparent-header']) && $options['transparent-header'] == '1') {
		$disable_transparent_header = array( 
					'name' =>  __('Disable Transparency From Navigation', NECTAR_THEME_NAME),
					'desc' => __('You can use this option to force your navigation header to stay a solid color even if it qaulifies to trigger to <a target="_blank" href="'. admin_url('?page=redux_options&tab=4#header-padding') .'"> transparent effect</a> you have activate in the Salient options panel.', NECTAR_THEME_NAME),
					'id' => '_disable_transparent_header',
					'type' => 'checkbox',
	                'std' => ''
				);
	} else {
		$disable_transparent_header = null;
	}
	
	#-----------------------------------------------------------------#
	# Extra Content
	#-----------------------------------------------------------------# 
	$meta_box = array(
		'id' => 'nectar-metabox-portfolio-extra',
		'title' =>  __('Extra Content', NECTAR_THEME_NAME),
		'description' => __('Please use this section to place any extra content you would like to appear in the main content area under your portfolio item. (The above default editor is only used to populate your items sidebar content)', NECTAR_THEME_NAME),
		'post_type' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
    		array( 
				'name' => '',
				'desc' => '',
				'id' => '_nectar_portfolio_extra_content',
				'type' => 'editor',
				'std' => ''
			),
		)
	);
	
    $callback = create_function( '$post,$meta_box', 'nectar_create_meta_box( $post, $meta_box["args"] );' );
	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
		
    
	
	
	$portfolio_pages = array('default'=>'Default');
			
	//grab all pages that are using the portfolio layout
	$portfolio_pages_ft = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'page-portfolio.php'
	));
	
	if(!empty($portfolio_pages_ft)) {
		foreach($portfolio_pages_ft as $page){
			$portfolio_pages[$page->ID] = $page->post_title;
		}
	}
	
	$portfolio_pages_ft_new = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'template-portfolio.php'
	));
	
	if(!empty($portfolio_pages_ft_new)) {
		foreach($portfolio_pages_ft_new as $page){
			$portfolio_pages[$page->ID] = $page->post_title;
		}
	}
	
	
	//grab all pages that contain the portfolio shortcode
	global $wpdb;
	
	$results = $wpdb->get_results("SELECT * FROM $wpdb->posts
	WHERE post_content LIKE '%[nectar_portfolio%' AND post_type='page'");
	 
	if(!empty($results)) {
	    foreach ($results as $result) {
	       $portfolio_pages[$result->ID] = $result->post_title;
	    }
	}
	
	
	#-----------------------------------------------------------------#
	# Project Configuration
	#-----------------------------------------------------------------# 
	if ( floatval(get_bloginfo('version')) < "3.6" ) {
		$meta_box = array(
			'id' => 'nectar-metabox-custom-thummbnail',
			'title' =>  __('Project Configuration', NECTAR_THEME_NAME),
			'description' => __('', NECTAR_THEME_NAME),
			'post_type' => 'portfolio',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array( 
						'name' => __('Full Width Portfolio Item Layout', NECTAR_THEME_NAME),
						'desc' => __('This will remove the sidebar and allow you to use fullwidth sections and sliders', NECTAR_THEME_NAME),
						'id' => '_nectar_portfolio_item_layout',
						'type' => 'choice_below',
						'options' => array(
							'disabled' => 'Disabled',
							'enabled' => 'Enabled'
						),
						'std' => 'disabled'
				),
	    		array( 
					'name' => __('Custom Thumbnail Image', NECTAR_THEME_NAME),
					'desc' => __('If you would like to have a separate thumbnail for your portfolio item, upload it here. If left blank, a cropped version of your featured image will be automatically used instead. The recommended dimensions are 600px by 403px.', NECTAR_THEME_NAME),
					'id' => '_nectar_portfolio_custom_thumbnail',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' =>  __('Hide Featured Image/Video on Single Project Page?', NECTAR_THEME_NAME),
					'desc' => __('You can choose to hide your featured image/video from automatically displaying on the top of the main project page.', NECTAR_THEME_NAME),
					'id' => '_nectar_hide_featured',
					'type' => 'checkbox',
	                'std' => 1
				),
				array( 
					'name' => __('Masonry Item Sizing', NECTAR_THEME_NAME),
					'desc' => __('This will only be used if you choose to display your portfolio in the masonry format', NECTAR_THEME_NAME),
					'id' => '_portfolio_item_masonry_sizing',
					'type' => 'select',
					'std' => 'tall_regular',
					'options' => array(
						"regular" => "Regular",
				  		"wide" => "Wide",
				  		"tall" => "Tall",
				  		"wide_tall" => "Wide & Tall"
					)
				),
				array( 
					'name' => __('Masonry Content Position', NECTAR_THEME_NAME),
					'desc' => __('This will only be used on project styles which show the content overlaid before hover', NECTAR_THEME_NAME),
					'id' => '_portfolio_item_masonry_content_pos',
					'type' => 'select',
					'std' => 'middle',
					'options' => array(
						"middle" => "Middle",
				  		"left" => "Left",
				  		"right" => "Right",
				  		"top" => "Top",
				  		"bottom" => "Bottom"
					)
				),
				array( 
					'name' => __('External Project URL', NECTAR_THEME_NAME),
					'desc' => __('If you would like your project to link to a custom location, enter it here (remember to include "http://")', NECTAR_THEME_NAME),
					'id' => '_nectar_external_project_url',
					'type' => 'text',
					'std' => ''
				),
				array( 
					'name' => __('Parent Portfolio Override', NECTAR_THEME_NAME),
					'desc' => __('This allows you to manually assign where your "Back to all" button will take the user on your single portfolio item pages.', NECTAR_THEME_NAME),
					'id' => 'nectar-metabox-portfolio-parent-override',
					'type' => 'select',
					'options' => $portfolio_pages,
					'std' => 'default'
				),
				array( 
					'name' => __('Project Excerpt', NECTAR_THEME_NAME),
					'desc' => __('If you would like your project to display a small excerpt of text under the title in portfolio element, enter it here.', NECTAR_THEME_NAME),
					'id' => '_nectar_project_excerpt',
					'type' => 'text',
					'std' => ''
				)
				
			)
		);
	} 
	
	//wp 3.6+
	else {
		
		
		//show gallery slider option for legacy users only if they're using it
		global $post;
		if($post) {
			$using_gallery_slider = get_post_meta($post->ID, '_nectar_gallery_slider', true);
			if(!empty($using_gallery_slider) && $using_gallery_slider == 'on'){
				$gallery_slider = array(
						'name' =>  __('Gallery Slider', NECTAR_THEME_NAME),
						'desc' => __('This will turn all default WordPress galleries attached to this post into a simple slider.', NECTAR_THEME_NAME),
						'id' => '_nectar_gallery_slider',
						'type' => 'checkbox',
		                'std' => 1
					);
			} else {
				$gallery_slider = null;
			}
		} else {
			$gallery_slider = null;
		}

		$meta_box = array(
			'id' => 'nectar-metabox-project-configuration',
			'title' =>  __('Project Configuration', NECTAR_THEME_NAME),
			'description' => __('', NECTAR_THEME_NAME),
			'post_type' => 'portfolio',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array( 
						'name' => __('Full Width Portfolio Item Layout', NECTAR_THEME_NAME),
						'desc' => __('This will remove the sidebar and allow you to use fullwidth sections and sliders', NECTAR_THEME_NAME),
						'id' => '_nectar_portfolio_item_layout',
						'type' => 'choice_below',
						'options' => array(
							'disabled' => 'Disabled',
							'enabled' => 'Enabled'
						),
						'std' => 'disabled'
				),
				array( 
						'name' => __('Custom Content Grid Item', NECTAR_THEME_NAME),
						'desc' => __('This will all you to place custom content using the above editor that will appear in your portfolio grid. By using this option the single project page will be disabled, however you can still link the item to a custom URL if desired.', NECTAR_THEME_NAME),
						'id' => '_nectar_portfolio_custom_grid_item',
						'type' => 'choice_below',
						'options' => array(
							'off' => 'Disabled',
							'on' => 'Enabled'
						),
						'std' => 'off'
				),
				array( 
					'name' => __('Custom Content Grid Item Content', NECTAR_THEME_NAME),
					'desc' => __('Use this to populate what will display as your project content in place of the default meta info', NECTAR_THEME_NAME),
					'id' => '_nectar_portfolio_custom_grid_item_content',
					'type' => 'slim_editor',
					'std' => ''
				),
	    		array( 
					'name' => __('Custom Thumbnail Image', NECTAR_THEME_NAME),
					'desc' => __('If you would like to have a separate thumbnail for your portfolio item, upload it here. If left blank, a cropped version of your featured image will be automatically used instead. The recommended dimensions are 600px by 403px.', NECTAR_THEME_NAME),
					'id' => '_nectar_portfolio_custom_thumbnail',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' =>  __('Hide Featured Image/Video on Single Project Page?', NECTAR_THEME_NAME),
					'desc' => __('You can choose to hide your featured image/video from automatically displaying on the top of the main project page.', NECTAR_THEME_NAME),
					'id' => '_nectar_hide_featured',
					'type' => 'checkbox',
	                'std' => 1
				),
				array( 
					'name' => __('Masonry Item Sizing', NECTAR_THEME_NAME),
					'desc' => __('This will only be used if you choose to display your portfolio in the masonry format', NECTAR_THEME_NAME),
					'id' => '_portfolio_item_masonry_sizing',
					'type' => 'select',
					'std' => 'tall_regular',
					'options' => array(
						"regular" => "Regular",
				  		"wide" => "Wide",
				  		"tall" => "Tall",
				  		"wide_tall" => "Wide & Tall",
					)
				),
				array( 
					'name' => __('Masonry Content Position', NECTAR_THEME_NAME),
					'desc' => __('This will only be used on project styles which show the content overlaid before hover', NECTAR_THEME_NAME),
					'id' => '_portfolio_item_masonry_content_pos',
					'type' => 'select',
					'std' => 'middle',
					'options' => array(
						"middle" => "Middle",
				  		"left" => "Left",
				  		"right" => "Right",
				  		"top" => "Top",
				  		"bottom" => "Bottom"
					)
				),
				$gallery_slider,
				array( 
					'name' => __('External Project URL', NECTAR_THEME_NAME),
					'desc' => __('If you would like your project to link to a custom location, enter it here (remember to include "http://")', NECTAR_THEME_NAME),
					'id' => '_nectar_external_project_url',
					'type' => 'text',
					'std' => ''
				),
				array( 
					'name' => __('Parent Portfolio Override', NECTAR_THEME_NAME),
					'desc' => __('This allows you to manually assign where your "Back to all" button will take the user on your single portfolio item pages.', NECTAR_THEME_NAME),
					'id' => 'nectar-metabox-portfolio-parent-override',
					'type' => 'select',
					'options' => $portfolio_pages,
					'std' => 'default'
				),
				array( 
					'name' => __('Project Excerpt', NECTAR_THEME_NAME),
					'desc' => __('If you would like your project to display a small excerpt of text under the title in portfolio element, enter it here.', NECTAR_THEME_NAME),
					'id' => '_nectar_project_excerpt',
					'type' => 'text',
					'std' => ''
				),
				array( 
					'name' => __('Project Accent Color', NECTAR_THEME_NAME),
					'desc' => __('This will be used in applicable project styles in the portfolio thumbnail view.', NECTAR_THEME_NAME),
					'id' => '_nectar_project_accent_color',
					'type' => 'color',
					'std' => ''
				),
				array( 
					'name' => __('Project Title Color', NECTAR_THEME_NAME),
					'desc' => __('This will be used in applicable project styles in the portfolio thumbnail view.', NECTAR_THEME_NAME),
					'id' => '_nectar_project_title_color',
					'type' => 'color',
					'std' => ''
				),
				array( 
					'name' => __('Project Date/Custom excerpt Color', NECTAR_THEME_NAME),
					'desc' => __('This will be used in applicable project styles in the portfolio thumbnail view.', NECTAR_THEME_NAME),
					'id' => '_nectar_project_subtitle_color',
					'type' => 'color',
					'std' => ''
				)
				/*array( 
					'name' => __('3D Parallax Images', NECTAR_THEME_NAME),
					'desc' => 'Add images here that will be used to create the 3d parallax effect when using the relevant project style.',
					'id' => '_nectar_3d_parallax_images',
					'type' => 'canvas_shape_group',
					'class' => '_nectar_3d_parallax_images',
					'std' => ''
				)*/
			)
		);

	}//endif

	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
		
	
	
	
	#-----------------------------------------------------------------#
	# Header Settings
	#-----------------------------------------------------------------#
    $meta_box = array(
		'id' => 'nectar-metabox-page-header',
		'title' => __('Project Header Settings', NECTAR_THEME_NAME),
		'description' => __('Here you can configure how your page header will appear. ', NECTAR_THEME_NAME),
		'post_type' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => __('Page Header Image', NECTAR_THEME_NAME),
					'desc' => __('The image should be between 1600px - 2000px wide and have a minimum height of 475px for best results.', NECTAR_THEME_NAME),
					'id' => '_nectar_header_bg',
					'type' => 'file',
					'std' => ''
				),
			array(
					'name' =>  __('Parallax Header?', NECTAR_THEME_NAME),
					'desc' => __('If you would like your header to have a parallax scroll effect check this box.', NECTAR_THEME_NAME),
					'id' => '_nectar_header_parallax',
					'type' => 'checkbox',
	                'std' => 1
				),	
			array( 
					'name' => __('Page Header Height', NECTAR_THEME_NAME),
					'desc' => __('How tall do you want your header? <br/>Don\'t include "px" in the string. e.g. 350 <br/><strong>This only applies when you are using an image/bg color.</strong>', NECTAR_THEME_NAME),
					'id' => '_nectar_header_bg_height',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Page Header Background Color', NECTAR_THEME_NAME),
					'desc' => __('Set your desired page header background color if not using an image', NECTAR_THEME_NAME),
					'id' => '_nectar_header_bg_color',
					'type' => 'color',
					'std' => ''
				),
			array( 
					'name' => __('Page Header Subtitle', NECTAR_THEME_NAME),
					'desc' => __('Enter in the page header subtitle', NECTAR_THEME_NAME),
					'id' => '_nectar_header_subtitle',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => __('Page Header Font Color', NECTAR_THEME_NAME),
					'desc' => __('Set your desired page header font color - will only be used if using a header bg image/color', NECTAR_THEME_NAME),
					'id' => '_nectar_header_font_color',
					'type' => 'color',
					'std' => ''
				),
			$disable_transparent_header
		)
	);
	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
	
	
    #-----------------------------------------------------------------#
	# Video 
	#-----------------------------------------------------------------#
		
	
    $meta_box = array( 
		'id' => 'nectar-metabox-portfolio-video',
		'title' => __('Video Settings', NECTAR_THEME_NAME),
		'description' => __('If you have a video, please fill out the fields below.', NECTAR_THEME_NAME),
		'post_type' => 'portfolio',
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
					'desc' => __('Please upload the .ogv video file. <br/><strong>You must include both formats.</strong>', NECTAR_THEME_NAME),
					'id' => '_nectar_video_ogv',
					'type' => 'media',
					'std' => ''
				),
			array( 
					'name' => __('Video Height', NECTAR_THEME_NAME),
					'desc' => __('This only needs to be filled out if your self hosted video is not in a 16:9 aspect ratio. Enter your height based on an 845px width. This is used to calculate the iframe height for the "Watch Video" link. <br/> <strong>Don\'t include "px" in the string. e.g. 480</strong>', NECTAR_THEME_NAME),
					'id' => '_nectar_video_height',
					'type' => 'text',
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
					'desc' => __('If the video is an embed rather than self hosted, enter in a Youtube or Vimeo embed code here. The width should be a minimum of 670px with any height.', NECTAR_THEME_NAME),
					'id' => '_nectar_video_embed',
					'type' => 'textarea',
					'std' => ''
				)
		)
	);


	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );


}