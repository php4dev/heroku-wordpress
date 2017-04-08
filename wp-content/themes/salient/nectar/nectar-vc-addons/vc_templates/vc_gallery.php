<?php
$output = $title = $source = $type = $onclick = $custom_links = $img_size = $external_img_size = $custom_links_target = $images = $custom_srcs = $el_class = $interval = '';
extract(shortcode_atts(array(
    'title' => '',
    'source' => 'media_library',
    'external_img_size' => '',
    'custom_srcs' => '',
    'type' => 'flexslider',
    'flickity_controls' => 'default',
    'flickity_box_shadow' => '',
    'onclick' => 'link_image',
    'custom_links' => '',
    'custom_links_target' => '',
    'img_size' => 'thumbnail',
    'display_title_caption' => '',
    'gallery_style' => '',
    'constrain_max_cols' => '',
    'flexible_slider_height' => '',
    'hide_arrow_navigation' => '',
    'bullet_navigation' => '',
    'bullet_navigation_style' => 'see_through',
    'layout' => '',
    'images' => '',
    'el_class' => '',
    'interval' => '5',
    'img_size' => '600x400'
), $atts));
$gal_images = '';
$link_start = '';
$link_end = '';
$el_start = '';
$el_end = '';
$slides_wrap_start = '';
$slides_wrap_end = '';

$el_class = $this->getExtraClass($el_class);

if(!function_exists('wp_get_attachment')) {
	function wp_get_attachment( $attachment_id ) {
	
		$attachment = get_post( $attachment_id );
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => $attachment->guid,
			'title' => $attachment->post_title,
			'image_url' => get_post_meta( $attachment->ID, 'nectar_image_gal_url', true ),
		);
	}
}

if ( $type == 'flexslider_style' ) {
    $el_start = '<li>';
    $el_end = '</li>';
    $slides_wrap_start = '<ul class="slides">';
    $slides_wrap_end = '</ul>';
	
    wp_enqueue_script('flexslider');
	
} else if ( $type == 'nectarslider_style' ) {
    

    $el_start = '';
    $el_end = '';
	
   	$bulk_param = ($onclick != 'link_no') ? 'false' : 'true';

   	switch ( $source ) {
		case 'media_library':
			if($img_size == 'thumbnail') {
				$slide_height = '200';
			} else if ($img_size == 'full'){
				$slide_height = '1000';
			}
			else {
				$arr = explode("x", $img_size, 2);
				$slide_height = $arr[1];
			}
			break;

		case 'external_link':
			$arr = explode("x", $external_img_size, 2);
			$slide_height = $arr[1];

			break;
	}

	
	if($images == '') $bullet_navigation = false;
	$arrow_markup = ($hide_arrow_navigation == true) ? 'data-arrows="false"': 'data-arrows="true"';

	$slides_wrap_start .= '<div class="nectar-slider-wrap" style="height: '.$slide_height.'px" data-flexible-height="'.$flexible_slider_height.'" data-fullscreen="false"  data-full-width="false" data-parallax="false" data-autorotate="5500" id="ns-id-'.uniqid().'">';
	$slides_wrap_start .=	'<div class="swiper-container" style="height: '.$slide_height.'px"  data-loop="'.$bulk_param.'" data-height="'.$slide_height.'" data-bullets="'.$bullet_navigation.'" data-bullet_style="'.$bullet_navigation_style.'" '.$arrow_markup.' data-bullets="false" data-desktop-swipe="'.$bulk_param.'" data-settings="">';
	$slides_wrap_start .=	'<div class="swiper-wrapper">';
	

	$slides_wrap_end .= '</div>';

	if($hide_arrow_navigation != true) {
		$slides_wrap_end .= '<a href="" class="slider-prev"><i class="icon-salient-left-arrow"></i> <div class="slide-count"> <span class="slide-current">1</span> <i class="icon-salient-right-line"></i> <span class="slide-total"></span> </div> </a>
			     		<a href="" class="slider-next"><i class="icon-salient-right-arrow"></i> <div class="slide-count"> <span class="slide-current">1</span> <i class="icon-salient-right-line"></i> <span class="slide-total"></span> </div> </a>';
	}

	if($images != '') {
		$image_count = explode( ',', $images); 
		if($bullet_navigation == true && sizeof($image_count) > 1) { 
				$slides_wrap_end .= '<div class="slider-pagination"></div>';
		}	
	}
	$slides_wrap_end .= '<div class="nectar-slider-loading"></div>';
	$slides_wrap_end .= '</div></div>';
	
	
} else if ( $type == 'flickity_style' ) {

	wp_enqueue_script('flickity');

	$slides_wrap_start .= '<div class="nectar-flickity not-initialized" data-shadow="'.$flickity_box_shadow.'" data-controls="'.$flickity_controls.'">';
	

	$slides_wrap_end .= '</div>';

} else if ( $type == 'image_grid' ) {
   
	
	//calculate cols
	switch($layout){
		case '3':
			$cols = 'cols-3';
			break; 
		case '4':
			$cols = 'cols-4';
			break; 
		case 'fullwidth':
			$cols = 'elastic';
			break; 
	}
		
	switch($cols){
		case 'cols-3':
			$span_num = 'span_4';
			break; 
		case 'cols-4':
			$span_num = 'span_3';
			break; 
		case 'elastic':
			$span_num = 'elastic-portfolio-item';
			break; 
			
	}
		

	$constrain_col_class = (!empty($constrain_max_cols) && $constrain_max_cols == 'true') ? ' constrain-max-cols' : null ;

	ob_start(); ?>


	<div class="portfolio-wrap <?php if($gallery_style == '1' && $span_num == 'elastic-portfolio-item') echo 'default-style'; ?>">
			
			<span class="portfolio-loading"></span>

			<div id="portfolio" class="row portfolio-items no-masonry <?php echo $constrain_col_class; ?>" data-starting-filter="" data-categories-to-show="" data-col-num="<?php echo $cols; ?>">
				
			
		
	<?php 
	
	$slides_wrap_start = ob_get_contents();
	
	ob_end_clean();
	
	
	
	ob_start(); ?>
	
	<div class="col <?php echo $span_num; ?> element" data-project-cat="" data-default-color="true" data-title-color="" data-subtitle-color="">
	
	<?php 
			
	$el_start = ob_get_contents();
	
	ob_end_clean();
	
	$el_end = '</div>';

    
    $slides_wrap_end = '</div></div>';
	
	
	

	
	
}



$flex_fx = '';
if ( $type == 'flexslider_style' ) {
    $type = ' wpb_flexslider flex-gallery flexslider';
    $flex_fx = ' data-flex_fx="fade"';
} else if ( $type == 'nectarslider_style' ) {
    $type = 'nectarslider_style';
    $flex_fx = '';
} 


if ( $images == '' ) $images = '-1,-2,-3, -4';

$pretty_rel_random = ' rel="prettyPhoto[rel-'.rand().']"'; //rel-'.rand();

if ( $onclick == 'custom_link' ) { 
	$custom_links = vc_value_from_safe( $custom_links ); 
	$custom_links = explode( ',', $custom_links );
}

switch ( $source ) {
	case 'media_library':
		$images = explode( ',', $images );
		break;

	case 'external_link':
		$images = vc_value_from_safe( $custom_srcs );
		$images = explode( ',', $images );

		break;
}


$i = -1;

foreach ( $images as $attach_id ) {
    $i++;


    switch ( $source ) {
		case 'media_library':
			 if ($attach_id > 0) {
		        $post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ));
		        $fullsize_image = wp_get_attachment_image_src($attach_id, 'full');
		        $post_thumbnail['p_img_fullsize'] = $fullsize_image[0];
		    }
		    else {
		        $different_kitten = 400 + $i;
		        $post_thumbnail = array();
		        $post_thumbnail['thumbnail'] = '<img src="http://placekitten.com/g/'.$different_kitten.'/300" />';
		        $post_thumbnail['p_img_large'][0] = 'http://placekitten.com/g/1024/768';
		        $post_thumbnail['p_img_fullsize'] = 'http://placekitten.com/g/1024/768';
		    }
			break;

		case 'external_link':
			$image = esc_attr( $attach_id );
			$dimensions = vcExtractDimensions( $external_img_size );
			$hwstring = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';
			$post_thumbnail['thumbnail'] = '<img ' . $hwstring . ' src="' . $image . '" />';
			$post_thumbnail['p_img_large'][0] = $image;
			$post_thumbnail['p_img_fullsize'] = $image;
			break;
	}


  

    $thumbnail = $post_thumbnail['thumbnail'];

 	if($img_size == 'full') $post_thumbnail['p_img_large'][0] = $post_thumbnail['p_img_fullsize'];
 	
    $p_img_large = $post_thumbnail['p_img_large'];
    $link_start = $link_end = '';

    if ( $onclick == 'link_image' ) {
        $link_start = '<a href="'.$p_img_large[0].'"'.$pretty_rel_random.'>';
        $link_end = '</a>';
    }
    else if ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
        $link_start = '<a href="'.$custom_links[$i].'"' . (!empty($custom_links_target) ? ' target="'.$custom_links_target.'"' : '') . '>';
        $link_end = '</a>';
    }
	
	if($type == 'nectarslider_style') {

		switch ( $source ) {
			case 'media_library':
				$img = wp_get_attachment_image_src(  $attach_id, $img_size );
				break;

			case 'external_link':
				$image = esc_attr( $attach_id );
				$dimensions = vcExtractDimensions( $external_img_size );
				$hwstring = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';
				$img[0] = $image;
				break;
		}
		
		$thumbnail = '<div class="swiper-slide" data-bg-alignment="center" data-color-scheme="light" data-x-pos="centered" data-y-pos="middle"><div class="image-bg" style="background-image: url('. $img[0].');"></div>';
		
		if ( $onclick == 'link_image' ) {
	        $slide_link = '<a class="entire-slide-link" href="'.$p_img_large[0].'"'.$pretty_rel_random.'></a>';
	    }
	    else if ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
	        $slide_link = '<a class="entire-slide-link" href="'.$custom_links[$i].'"' . (!empty($custom_links_target) ? ' target="'.$custom_links_target.'"' : '') . '></a>';
	    } else {
	    	$slide_link = null;
	    }
		
		$thumbnail .= $slide_link;
		
		$link_start = null;
		$link_end = null;
		
		$thumbnail .= '<span class="ie-fix"></span> </div><!--/swiper-slide-->';

	}
	

	if($type == 'flickity_style') {
		
		switch ( $source ) {
			case 'media_library':
				if ($attach_id > 0) {
			        $post_thumbnail = wpb_getImageBySize(array( 'attach_id' => (int) $attach_id, 'thumb_size' => $img_size ));
			    }
			    else {
			        $post_thumbnail = array();
			        $post_thumbnail['thumbnail'] = '<img src="http://placehold.it/900x400" />';
			        $post_thumbnail['p_img_large'][0] = 'http://placehold.it/900x400';
			    }
				break;

			case 'external_link':
				$image = esc_attr( $attach_id );
				$dimensions = vcExtractDimensions( $external_img_size );
				$hwstring = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';
				$post_thumbnail['thumbnail'] = '<img ' . $hwstring . ' src="' . $image . '" />';
				$post_thumbnail['p_img_large'][0] = $image;
				break;
		}

	   

		$thumbnail = '<div class="cell">' . $post_thumbnail['thumbnail'];
		
		if ( $onclick == 'link_image' ) {
	        $slide_link = '<a class="entire-slide-link" href="'.$p_img_large[0].'"'.$pretty_rel_random.'></a>';
	    }
	    else if ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
	        $slide_link = '<a class="entire-slide-link" href="'.$custom_links[$i].'"' . (!empty($custom_links_target) ? ' target="'.$custom_links_target.'"' : '') . '></a>';
	    } else {
	    	$slide_link = null;
	    }
		
		$thumbnail .= $slide_link;
		
		$link_start = null;
		$link_end = null;
		
		$thumbnail .= '</div>';

	}
	
	
	
	if($type == 'image_grid'){ 
		
			
				ob_start(); ?>

						
						<?php //project style 1
							

							switch ( $source ) {
								case 'media_library':
									if ($attach_id > 0) {
								        $post_thumbnail = wpb_getImageBySize(array( 'attach_id' => (int) $attach_id, 'thumb_size' => $img_size ));
								    }
								    else {
								        $post_thumbnail = array();
								        $post_thumbnail['thumbnail'] = '<img src="http://placehold.it/500x500" />';
								        $post_thumbnail['p_img_large'][0] = 'http://placehold.it/500x500';
								    }
									break;

								case 'external_link':
									$image = esc_attr( $attach_id );
									$dimensions = vcExtractDimensions( $external_img_size );
									$hwstring = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';
									$post_thumbnail['thumbnail'] = '<img ' . $hwstring . ' src="' . $image . '" />';
									$post_thumbnail['p_img_large'][0] = $image;
									break;
							}

						

							if($gallery_style == '1') { ?>
								
							<div class="work-item">
								 
								<?php
								
								echo $post_thumbnail['thumbnail']; ?>
								
								<div class="work-info-bg"></div>
								<div class="work-info"> 
									
									<?php 
										if($attach_id > 0) { 
											$attachment_meta = wp_get_attachment($attach_id);

											if(!empty($attachment_meta['image_url'])) {
												echo '<div class="vert-center no-text"><a class="no-text" href="'.$attachment_meta['image_url'].'">'.__("View Larger", NECTAR_THEME_NAME).'</a> ';
											} else {
												echo '<div class="vert-center"><a ';
												 if(!empty($attachment_meta['description'])) echo 'title="'.$attachment_meta['description'].'"';
												echo 'href="'.$p_img_large[0].'"'.$pretty_rel_random.' class="default-link">'.__("View Larger", NECTAR_THEME_NAME).'</a> ';
											} ?>
											</div><!--/vert-center-->
										<?php } ?>

								</div>
							</div><!--work-item-->
							
							<?php if($display_title_caption == 'true') { ?>
								
								<div class="work-meta">
									<?php if($attach_id > 0) {  ?>
										<h4 class="title"><?php echo $attachment_meta['title']; ?></h4>
										<p><?php echo $attachment_meta['caption']; ?></p>
									<?php } ?>
								</div>
								
							<?php } ?>
	
						<?php } //project style 1 
						
						
						//project style 2
						else if($gallery_style == '2') { ?>
							
							<div class="work-item style-2">
								
								<?php
								echo $post_thumbnail['thumbnail']; ?>
			
								<div class="work-info-bg"></div>
								<div class="work-info">
								
									
									<?php 
									if($attach_id > 0) { 

										$attachment_meta = wp_get_attachment($attach_id); 
										if(!empty($attachment_meta['image_url'])) { ?>
									   		 <a <?php echo 'href="'.$attachment_meta['image_url'].'"'; ?>></a>
								   		<?php } else { ?>
								   			 <a <?php echo 'href="'.$p_img_large[0].'"';
								   			  if(!empty($attachment_meta['description'])) echo 'title="'.$attachment_meta['description'].'"';
								   			 echo ' '.$pretty_rel_random; ?>></a>
								   		<?php } ?>
			
										<div class="vert-center">
											<?php if($display_title_caption == 'true') { ?> 
												
												<h3><?php echo $attachment_meta['title']; ?></h3> 
												<p><?php echo $attachment_meta['caption']; ?></p>
												
											<?php } ?>
										</div><!--/vert-center-->

									<?php } ?>
									
									
								</div>
							</div><!--work-item-->
							
						<?php } //project style 2 
						
												
						
						else if($gallery_style == '3') { ?>
							
							<div class="work-item style-3">
								
								<?php
								echo $post_thumbnail['thumbnail']; 

								if($attach_id > 0) $attachment_meta = wp_get_attachment($attach_id);

								?>
				
								<div class="work-info-bg"></div>

								<?php if($attach_id > 0) { ?>

									<div class="work-info">
	    	
										<div class="vert-center">
											<?php if($display_title_caption == 'true') { ?> 
												
												<h3><?php echo $attachment_meta['title']; ?></h3> 
												<p><?php echo $attachment_meta['caption']; ?></p>
												
											<?php } ?>
										</div><!--/vert-center-->
										
										<?php 
										
										if(!empty($attachment_meta['image_url'])) { ?>
									   		 <a <?php echo 'href="'.$attachment_meta['image_url'].'"'; ?>></a>
								   		<?php } else { ?>
								   			 <a <?php echo 'href="'.$p_img_large[0].'"';
								   			  if(!empty($attachment_meta['description'])) echo 'title="'.$attachment_meta['description'].'"';
								   			 echo ' '.$pretty_rel_random; ?>></a>
								   		<?php } ?>
										
									</div>

								<?php } ?>

							</div><!--work-item-->
							
						<?php } //project style 3 
						
						
						else if($gallery_style == '4') { ?>
							
							<div class="work-item style-4">
								
								<?php
								echo $post_thumbnail['thumbnail']; ?>

								<div class="work-info">

								    <?php 

								    if($attach_id > 0) { 

									    $attachment_meta = wp_get_attachment($attach_id); 

									    if(!empty($attachment_meta['image_url'])) { ?>
									   		 <a <?php echo 'href="'.$attachment_meta['image_url'].'"'; ?>></a>
								   		<?php } else { ?>
								   			 <a <?php echo 'href="'.$p_img_large[0].'"';
								   			  if(!empty($attachment_meta['description'])) echo 'title="'.$attachment_meta['description'].'"';
								   			 echo ' '.$pretty_rel_random; ?>></a>
								   		<?php } ?>

										<div class="bottom-meta">
											<?php if($display_title_caption == 'true') { ?> 
												
											<h3><?php echo $attachment_meta['title']; ?></h3> 
											<p><?php echo $attachment_meta['caption']; ?></p>	 
											
											<?php } ?>
										</div><!--/bottom-meta-->

									<?php } ?>
									
								</div>
							</div><!--work-item-->
							
						<?php } //project style 4

						else if($gallery_style == '5') { ?>
							
							<div class="work-item style-3-alt">
								
								<?php							
								echo $post_thumbnail['thumbnail']; 
								if($attach_id > 0) $attachment_meta = wp_get_attachment($attach_id);
								?>
				
								<div class="work-info-bg"></div>
								<div class="work-info">
    				
									<div class="vert-center">
										<?php if($attach_id > 0) { ?>
											<?php if($display_title_caption == 'true') { ?> 
												
												<h3><?php echo $attachment_meta['title']; ?></h3> 
												<p><?php echo $attachment_meta['caption']; ?></p>
												
											<?php } ?>
										<?php } ?>
									</div><!--/vert-center-->
									
									<?php 

									if($attach_id > 0) { 

										if(!empty($attachment_meta['image_url'])) { ?>
									   		 <a <?php echo 'href="'.$attachment_meta['image_url'].'"'; ?>></a>
								   		<?php } else { ?>
								   			 <a <?php echo 'href="'.$p_img_large[0].'"';
								   			  if(!empty($attachment_meta['description'])) echo 'title="'.$attachment_meta['description'].'"';
								   			 echo ' '.$pretty_rel_random; ?>></a>
								   		<?php } ?>

								   	<?php } ?>
									
								</div>
							</div><!--work-item-->
							
						<?php } //project style 5

			
						$thumbnail = ob_get_contents();

						ob_end_clean();
						
						$link_start = null;
						$link_end = null;
		
		
	}
	
	
	
	
	
    $gal_images .= $el_start . $link_start . $thumbnail . $link_end . $el_end;
}
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gallery wpb_content_element'.$el_class.' clearfix', $this->settings['base']);
$output .= "\n\t".'<div class="'.$css_class.'">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_gallery_heading'));
$output .= '<div class="wpb_gallery_slides'.$type.'" data-interval="'.$interval.'"'.$flex_fx.'>'.$slides_wrap_start.$gal_images.$slides_wrap_end.'</div>';
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_gallery');

echo $output;