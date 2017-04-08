<?php get_header(); 

$options = get_nectar_theme_options();  

//calculate cols
if(!empty($options['main_portfolio_layout'])) {
	
	switch($options['main_portfolio_layout']){
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
	
} else {
	$cols = 'cols-3';
}
	
if(!empty($cols)) {
	
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
	
} 

$project_style = (!empty($options['main_portfolio_project_style'])) ? $options['main_portfolio_project_style'] : '1' ;
$masonry_layout = (!empty($options['portfolio_use_masonry']) && $options['portfolio_use_masonry'] == '1') ? 'true' : 'false';
$load_in_animation = (!empty($options['portfolio_loading_animation'])) ? $options['portfolio_loading_animation'] : 'none'; 
$lightbox_only = false;
$infinite_scroll_class = (!empty($options['portfolio_pagination_type']) && $options['portfolio_pagination_type'] == 'infinite_scroll') ? ' infinite_scroll' : null;

//disable masonry for default project style fullwidtrh
if($project_style == '1' && $cols == 'elastic') $masonry_layout = 'false';

$display_sortable = get_post_meta($post->ID, 'nectar-metabox-portfolio-display-sortable', true);
$inline_filters = (!empty($options['portfolio_inline_filters']) && $options['portfolio_inline_filters'] == '1') ? '1' : '0';
$filters_id = (!empty($options['portfolio_inline_filters']) && $options['portfolio_inline_filters'] == '1') ? 'portfolio-filters-inline' : 'portfolio-filters';
$bg = get_post_meta($post->ID, '_nectar_header_bg', true); 
?>

<style>
	<?php if($span_num == 'elastic-portfolio-item') { ?> 
		.container-wrap { padding-bottom: 0px!important; }
		#call-to-action .triangle { display: none; }
	<?php } ?>
	
	<?php if($span_num == 'elastic-portfolio-item' && !empty($bg)) { ?> 
		.container-wrap { padding-top: 0px!important; }
	<?php } ?>
</style>



 <div class="row page-header-no-bg">
    	<div class="container">	
			<div class="col span_12 section-title">
				
				<h1><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
				if($term) {
					echo $term->name;
				} else {
					wp_title("",true);
				} ?></h1>

			</div>
		</div>
	</div>



<div class="container-wrap">
	
	<div class="container main-content" data-col-num="cols-<?php echo $cols; ?>">

		<div class="portfolio-wrap <?php if($project_style == '1' && $span_num == 'elastic-portfolio-item') echo 'default-style'; if($project_style == '6' && $span_num == 'elastic-portfolio-item') echo 'spaced'; ?>">
			
		<span class="portfolio-loading"></span>
		
		<div id="portfolio" class="row portfolio-items <?php if($masonry_layout == 'true') echo 'masonry-items'; else { echo 'no-masonry'; } ?> <?php echo $infinite_scroll_class; ?>"  data-categories-to-show="" data-starting-filter="" data-ps="<?php echo $project_style; ?>" data-col-num="<?php echo $cols; ?>">
			<?php 
			
			$posts_per_page = '-1';
			if(!empty($options['portfolio_pagination']) && $options['portfolio_pagination'] == '1') {
				$posts_per_page = (!empty($options['portfolio_pagination_number'])) ? $options['portfolio_pagination_number'] : '-1';
			}
		
			
			if(have_posts()) : while(have_posts()) : the_post(); ?>
				
				
				<?php 
					
				   $terms = get_the_terms($post->id,"project-type");
				   $project_cats = NULL;
				   
				   if ( !empty($terms) ){
				     foreach ( $terms as $term ) {
				       $project_cats .= strtolower($term->slug) . ' ';
				     }
				   }
					
					
					
					global $masonry_layout;
					$masonry_item_sizing = ($masonry_layout == 'true') ? get_post_meta($post->ID, '_portfolio_item_masonry_sizing', true) : null;
	                if(empty($masonry_item_sizing) && $masonry_layout == 'true') $masonry_item_sizing = 'regular';
					  
					$project_accent_color = get_post_meta($post->ID, '_nectar_project_accent_color', true);	
					$project_title_color = get_post_meta($post->ID, '_nectar_project_title_color', true);
					$project_subtitle_color = get_post_meta($post->ID, '_nectar_project_subtitle_color', true);

					$custom_project_link = get_post_meta($post->ID, '_nectar_external_project_url', true);
					$the_project_link = (!empty($custom_project_link)) ? $custom_project_link : get_permalink();
					
				?>
				
				<div class="col <?php echo $span_num . ' '. $masonry_item_sizing; ?> element" data-project-cat="<?php echo $project_cats; ?>" <?php if(!empty($project_accent_color)) { echo 'data-project-color="' . $project_accent_color .'"'; } else { echo 'data-default-color="true"';} ?> data-title-color="<?php echo $project_title_color; ?>" data-subtitle-color="<?php echo $project_subtitle_color; ?>">
					
					<div class="inner-wrap animated" data-animation="<?php echo $load_in_animation; ?>">

					<?php //project style 1
							
							if($project_style == '1') { ?>
								
							<div class="work-item">
								 
								<?php
				 				
				 				$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
								
								//custom thumbnail
								$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
								
								if( !empty($custom_thumbnail) ){
									echo '<img class="custom-thumbnail" src="'.$custom_thumbnail.'" alt="'. get_the_title() .'" />';
								}
								else {
									
									if ( has_post_thumbnail() ) {
										 echo get_the_post_thumbnail($post->ID, $thumb_size, array('title' => '')); 
									} 
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}
										 echo '<img src="'.get_template_directory_uri().'/img/'.$no_image_size.'" alt="no image added yet." />';
									 }   
									
								} ?>
								
								<div class="work-info-bg"></div>
								<div class="work-info"> 
									
									<div class="vert-center">
										<?php 
										
										$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  							
										$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
										$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
										
										//video 
									    if( !empty($video_embed) || !empty($video_m4v) ) {
			
										    if( !empty( $video_embed) && floatval(get_bloginfo('version')) < "3.6") {
										    	
										    	echo '<a href="#video-popup-'.$post->ID.'"  class="pretty_photo default-link">'.__("Watch Video", NECTAR_THEME_NAME).'</a> ';
												echo '<div id="video-popup-'.$post->ID.'">';
										        echo '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
												echo '</div>';
										    } 
										    
										    else {
												 echo '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo default-link" >'.__("Watch Video", NECTAR_THEME_NAME).'</a> ';	 
										     }
				
								        } 
										
										//image
									    else {
									       echo '<a href="'. $featured_image[0].'" class="pretty_photo default-link" >'.__("View Larger", NECTAR_THEME_NAME).'</a> ';
									    }
										
									    echo '<a class="default-link" href="' . $the_project_link . '">'.__("More Details", NECTAR_THEME_NAME).'</a>'; ?>
									    
									</div><!--/vert-center-->
								</div>
							</div><!--work-item-->
							
							<div class="work-meta">
								<h4 class="title"><?php the_title(); ?></h4>
								
								<?php 
									if(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo get_the_date();
								?>
			
							</div>
							<div class="nectar-love-wrap">
								<?php if( function_exists('nectar_love') ) nectar_love(); ?>
							</div><!--/nectar-love-wrap-->	
						
						<?php } //project style 1 
						
						
						//project style 2
						else if($project_style == '2')  { ?>
							
							<div class="work-item style-2">
								
								<?php
								$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
								
								//custom thumbnail
								$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
								
								if( !empty($custom_thumbnail) ){
									echo '<img class="custom-thumbnail" src="'.$custom_thumbnail.'" alt="'. get_the_title() .'" />';
								}
								else {
									
									if ( has_post_thumbnail() ) {
										 echo get_the_post_thumbnail($post->ID, $thumb_size, array('title' => '')); 
									} 
									
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}
										 echo '<img src="'.get_template_directory_uri().'/img/'.$no_image_size.'" alt="no image added yet." />';
									 }   
									
								} ?>
				
								<div class="work-info-bg"></div>
								<div class="work-info">
									
									<i class="icon-salient-plus"></i> 
									
									<a href="<?php echo $the_project_link; ?>"></a>
		
									<div class="vert-center"><h3><?php echo get_the_title(); ?></h3> <p><?php if(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo get_the_date(); ?></p></div><!--/vert-center-->
									
								</div>
							</div><!--work-item-->
							
						<?php } //project style 2 
						
						
						

						
						else if($project_style == '3') { ?>
							
							<div class="work-item style-3">
								
								<?php
								$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
								
								//custom thumbnail
								$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
								
								if( !empty($custom_thumbnail) ){
									echo '<img class="custom-thumbnail" src="'.$custom_thumbnail.'" alt="'. get_the_title() .'" />';
								}
								else {
									
									if ( has_post_thumbnail() ) {
										 echo get_the_post_thumbnail($post->ID, $thumb_size, array('title' => '')); 
									} 
									
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}
										 echo '<img src="'.get_template_directory_uri().'/img/'.$no_image_size.'" alt="no image added yet." />';
									 }   
									
								} ?>
				
								<div class="work-info-bg"></div>
								<div class="work-info">

									<a href="<?php echo $the_project_link; ?>"></a>
									
									<div class="vert-center">
										<h3><?php echo get_the_title(); ?> </h3> 
										<?php if(!empty($project_excerpt)) { echo '<p>'.$project_excerpt.'</p>'; } elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; ?>
									</div><!--/vert-center-->
									
								</div>
							</div><!--work-item-->
							
						<?php } //project style 3 
						
						
						else if($project_style == '4') { ?>
							
							<div class="work-item style-4">
								
								<?php
								$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
								
								//custom thumbnail
								$custom_thumbnail = get_post_meta($post->ID, '_nectar_portfolio_custom_thumbnail', true); 
								
								if( !empty($custom_thumbnail) ){
									echo '<img class="custom-thumbnail" src="'.$custom_thumbnail.'" alt="'. get_the_title() .'" />';
								}
								else {
									
									if ( has_post_thumbnail() ) {
										 echo get_the_post_thumbnail($post->ID, $thumb_size, array('title' => '')); 
									} 
									
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}
										 echo '<img src="'.get_template_directory_uri().'/img/'.$no_image_size.'" alt="no image added yet." />';
									 }   
									
								} ?>

								<div class="work-info">
									
									<a href="<?php echo $the_project_link; ?>"></a>
									
									<div class="bottom-meta">
										<h3><?php echo get_the_title(); ?> </h3> 
										<?php if(!empty($project_excerpt)) { echo '<p>'.$project_excerpt.'</p>'; } elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; ?>
									</div><!--/bottom-meta-->
									
								</div>
							</div><!--work-item-->
							
						<?php } //project style 4 
						

						else if($project_style == '6') { 

							$using_custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true); 
							$custom_content = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item_content', true); ?>
							
							<div class="work-item style-5" data-custom-content="<?php echo $using_custom_content; ?>" >
								
								<?php
								$thumb_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
		

								$parallax_images = get_post_meta($post->ID, '_nectar_3d_parallax_images', true); 

								if(!empty($parallax_images)) {

									echo '<div class="parallaxImg">';

									$images = explode( ',', $parallax_images);
									$i = 0;
									foreach ( $images as $attach_id ) {
										$i++;

										$img = wp_get_attachment_image_src(  $attach_id, $thumb_size );
										//add one sizer img
										if($i == 1) echo '<img class="sizer" src="'.$img[0].'" alt="'.get_the_title().'" />';
    									echo '<div class="parallaxImg-layer" data-img="'.$img[0].'" Layer-'.$i.'"></div>';

									}

									echo '</div>';

								} 
								//no parallax images set
								else {
									if ( has_post_thumbnail() ) {

										$thumbnail_id = get_post_thumbnail_id($post->ID);
										$thumbnail_url = wp_get_attachment_image_src($thumbnail_id,$thumb_size); 

										echo '<img class="sizer" src="'.$thumbnail_url[0].'" alt="'.get_the_title().'" />';

										echo '<div class="parallaxImg">';
										echo '<div class="parallaxImg-layer" data-img="'.$thumbnail_url[0].'" "></div>';
										echo '<div class="parallaxImg-layer"><div class="bg-overlay"></div> <div class="work-meta"><div class="inner">';
										echo '	<h4 class="title"> '.get_the_title().'</h4>';
													
												if(!empty($project_excerpt)) echo '<p>'.$project_excerpt.'</p>';  
												elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; 
													
										echo '</div></div></div></div>';
									} 
									
									//no image added
									else {
										switch($thumb_size) {
											case 'wide':
												$no_image_size = 'no-portfolio-item-wide.jpg';
												break;
											case 'tall':
												$no_image_size = 'no-portfolio-item-tall.jpg';
												break;
											case 'regular':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											case 'wide_tall':
												$no_image_size = 'no-portfolio-item-tiny.jpg';
												break;
											default:
												$no_image_size = 'no-portfolio-item-small.jpg';
												break;
										}
										

										echo '<img class="sizer" src="'.get_template_directory_uri().'/img/'.$no_image_size.'" alt="'.get_the_title().'" />';

										echo '<div class="parallaxImg">';
										echo '<div class="parallaxImg-layer" data-img="'.get_template_directory_uri().'/img/'.$no_image_size.'" "></div>';
										echo '<div class="parallaxImg-layer"><div class="bg-overlay"></div> <div class="work-meta"><div class="inner">';
										echo '	<h4 class="title"> '.get_the_title().'</h4>';
													
												if(!empty($project_excerpt)) echo '<p>'.$project_excerpt.'</p>';  
												elseif(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) echo '<p>' . get_the_date() . '</p>'; 
													
										echo '</div></div></div></div>';

									 }   
								}

								if($lightbox_only != 'true') { ?>
											
									<a href="<?php echo $the_project_link; ?>"></a>
								
								<?php } else {
									 
									$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  							
									$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
									$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
									
									//video 
								    if( !empty($video_embed) || !empty($video_m4v) ) {
		
									    if( !empty( $video_embed) && floatval(get_bloginfo('version')) < "3.6") {
									    	
									    	echo '<a href="#video-popup-'.$post->ID.'" class="pretty_photo"></a> ';
											echo '<div id="video-popup-'.$post->ID.'">';
									        echo '<div class="video-wrap">' . stripslashes(htmlspecialchars_decode($video_embed)) . '</div>';
											echo '</div>';
									    } 
									    
									    else {
											 echo '<a href="'.get_template_directory_uri(). '/includes/portfolio-functions/video.php?post-id=' .$post->ID.'&iframe=true&width=854" class="pretty_photo" ></a> ';	 
									     }
			
							        } else { ?>
							        	
							        	<a href="<?php echo $featured_image[0]; ?>"  <?php if(!empty($project_image_caption)) echo ' title="'.$project_image_caption.'" '; ?> class="pretty_photo"></a>
							        	
							        <?php  }

								   }
									
								?>

							
							</div><!--work-item-->

						
							
						<?php } //project style 6 ?>
						
						
						
				</div><!--/inner-->

				</div><!--/col-->
				
			<?php endwhile; endif; ?>
		</div><!--/portfolio-->
	
		
		<?php 
		 if( !empty($options['portfolio_extra_pagination']) && $options['portfolio_extra_pagination'] == '1' ){
		 	
				    global $wp_query, $wp_rewrite;  
			 
			 		$fw_pagination = ($span_num == 'elastic-portfolio-item') ? 'fw-pagination': null;
					$masonry_padding = ($project_style != '1') ? 'alt-style-padding' : null;
			 
	                $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1; 
				    $total_pages = $wp_query->max_num_pages;  
					
					$permalink_structure = get_option('permalink_structure');
				    $format = empty( $permalink_structure ) ? '&paged=%#%' : 'page/%#%/';  
				    if ($total_pages > 1){  
				      
					  echo '<div id="pagination" class="'.$fw_pagination.' '.$masonry_padding. $infinite_scroll_class.'" data-is-text="'.__("All items loaded", NECTAR_THEME_NAME).'">';
					   
				      echo paginate_links(array(  
				          'base' => get_pagenum_link(1) .'%_%', 
	    			      'format' => $format,
				          'current' => $current,  
				          'total' => $total_pages,  
				        )); 
						
					  echo  '</div>'; 
						
				    }  
			}
			//regular pagination
			else{
				
				if( get_next_posts_link() || get_previous_posts_link() ) {
					
					$fw_pagination = ($span_num == 'elastic-portfolio-item') ? 'fw-pagination': null;
					$masonry_padding = ($project_style != '1') ? 'alt-style-padding' : null;
					 
					echo '<div id="pagination" class="'.$fw_pagination.' '.$masonry_padding. $infinite_scroll_class.'" data-is-text="'.__("All items loaded", NECTAR_THEME_NAME).'">
					      <div class="prev">'.get_previous_posts_link('&laquo; Previous Entries').'</div>
					      <div class="next">'.get_next_posts_link('Next Entries &raquo;','').'</div>
				          </div>';
				
		        }
			}  ?>
		
		</div><!--/container-->
		
	</div><!--/container-wrap-->

</div>

<?php get_footer(); ?>