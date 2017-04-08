<?php get_header(); 

$fwp = get_post_meta($post->ID, '_nectar_portfolio_item_layout', true);
if(empty($fwp)) $fwp = 'false';

$hidden_featured_media = get_post_meta($post->ID, '_nectar_hide_featured', true);
$hidden_project_title = get_post_meta($post->ID, '_nectar_hide_title', true);

global $post;

$bg = get_post_meta($post->ID, '_nectar_header_bg', true);
$bg_color = get_post_meta($post->ID, '_nectar_header_bg_color', true);
			
$featured_src =  (has_post_thumbnail( $post->ID )) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full') : array('empty') ;
$full_width_portfolio = (!empty($fwp) && $fwp == 'enabled') ? 'id="full_width_portfolio" data-featured-img="'. $featured_src[0] .'"' : 'data-featured-img="'. $featured_src[0] .'"';

$options = get_nectar_theme_options(); 
$single_nav_pos = (!empty($options['portfolio_single_nav'])) ? $options['portfolio_single_nav'] : 'in_header';
$subtitle = get_post_meta($post->ID, '_nectar_header_subtitle', true);

?>
<div <?php echo $full_width_portfolio; if(!empty($bg) && $fwp != 'enabled' || !empty($bg_color) && $fwp != 'enabled') echo ' data-project-header-bg="true"'?> >
	  		
	  		<?php nectar_page_header($post->ID); 
			
			if(empty($bg) && empty($bg_color)) {?>
	  		
				<div class="row project-title">
					<div class="container">
						<div class="title-wrap">
						<div class="col span_12 section-title <?php if(empty($options['portfolio_social']) || $options['portfolio_social'] == 0 || empty($options['portfolio_date']) || $options['portfolio_date'] == 0 ) echo 'no-date'?>">
							
							<h1><?php the_title(); ?></h1>
							<?php if(!empty($subtitle)) { ?> <span class="subheader"><?php echo $subtitle; ?></span> <?php } ?>

							<?php if($single_nav_pos == 'in_header') project_single_controls(); ?>
					 
						</div> 
					</div>
				</div> 
			
			</div><!--/row-->
			
		<?php } //project header ?>
		
	<div class="container-wrap" data-nav-pos="<?php echo $single_nav_pos; ?>">
		
		<div class="container main-content"> 
			
			<?php 

			$enable_gallery_slider = get_post_meta( get_the_ID(), '_nectar_gallery_slider', true ); ?>
			
			<div class="row <?php if(!empty($enable_gallery_slider) && $enable_gallery_slider == 'on') echo 'gallery-slider'; ?>">
				
				<?php if(have_posts()) : while(have_posts()) : the_post(); 
				
					if ( function_exists( 'yoast_breadcrumb' ) ){ yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } 
				?>
					
					<div id="post-area" class="col <?php if($fwp != 'enabled') { echo 'span_9'; } else { echo 'span_12'; } ?>">
						
						<?php 

	 						if(!post_password_required()) {
							 
								$video_embed = get_post_meta($post->ID, '_nectar_video_embed', true);
								$video_m4v = get_post_meta($post->ID, '_nectar_video_m4v', true);
								$video_ogv = get_post_meta($post->ID, '_nectar_video_ogv', true); 
								$video_poster = get_post_meta($post->ID, '_nectar_video_poster', true); 
						
								//Gallery
								  
								if(class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'second-slide') || !empty($enable_gallery_slider) && $enable_gallery_slider == 'on'){
									
									if ( floatval(get_bloginfo('version')) < "3.6" ) {
										if(MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'second-slide')) {
											nectar_gallery($post->ID);
										}
									}
									else {
										
										if(!empty($enable_gallery_slider) && $enable_gallery_slider == 'on') { $gallery_ids = grab_ids_from_gallery(); ?>
									
										<div class="flex-gallery"> 
											 <ul class="slides">
											 	<?php 
												foreach( $gallery_ids as $image_id ) {
												     echo '<li>' . wp_get_attachment_image($image_id, '', false) . '</li>';
												} ?>
									    	</ul>
								   	  </div><!--/gallery-->
								   	  	
								   	 <?php }	
										
									}
									
								}
								
								//Video
								else if( !empty($video_embed) && $hidden_featured_media != 'on' || !empty($video_m4v) && $hidden_featured_media != 'on' ){
									
												
									//video embed
									if( !empty( $video_embed ) ) {
										
							             echo '<div class="video">' . do_shortcode($video_embed) . '</div>';
										
							        } 
							        //self hosted video pre 3-6
							        else if( !empty($video_m4v) && floatval(get_bloginfo('version')) < "3.6") {
							        	
							        	 echo '<div class="video">'; 
							            	 nectar_video($post->ID); 
										 echo '</div>'; 
										 
							        } 
							        //self hosted video post 3-6
							        else if(floatval(get_bloginfo('version')) >= "3.6"){
						
							        	if(!empty($video_m4v) || !empty($video_ogv)) {
							        		
											$video_output = '[video ';
											
											if(!empty($video_m4v)) { $video_output .= 'mp4="'. $video_m4v .'" '; }
											if(!empty($video_ogv)) { $video_output .= 'ogv="'. $video_ogv .'"'; }
											
											$video_output .= ' poster="'.$video_poster.'" width="1280"]';
											
							        		echo '<div class="video">' . do_shortcode($video_output) . '</div>';	
							        	}
							        }
									
								}
								
								//Regular Featured Img
								else if($hidden_featured_media != 'on') {
									 
									if (has_post_thumbnail()) { echo get_the_post_thumbnail($post->ID, 'full', array('title' => '')); } else {
										echo '<img src="'.get_template_directory_uri().'/img/no-portfolio-item.jpg" alt="no image added yet." />'; 
									}
								}
						
							}
					?>
						
						<?php
							//extra content 
							$options = get_nectar_theme_options(); 
							if(!post_password_required()) {
								
								$portfolio_extra_content = get_post_meta($post->ID, '_nectar_portfolio_extra_content', true);
								
								if(!empty($portfolio_extra_content)){
									echo '<div id="portfolio-extra">';
									
									$extra_content = shortcode_empty_paragraph_fix(apply_filters( 'the_content', $portfolio_extra_content ));
									echo do_shortcode($extra_content);
									
									echo '</div>';
								}
							} else if($fwp == 'enabled') {
								the_content(); 
							}
						
						

				        $theme_skin = (!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') ? 'ascend' : 'default';

						if(comments_open() && $theme_skin != 'ascend') { ?>
						
							<div class="comments-section">
				   			   <?php comments_template(); ?>
							</div>
						
						<?php } ?>  
						
					</div><!--/post-area-->
					
					
					<?php if($fwp != 'enabled') { ?>
					<div id="sidebar" class="col span_3 col_last" data-follow-on-scroll="<?php echo (!empty($options['portfolio_sidebar_follow']) && $options['portfolio_sidebar_follow'] == 1) ? 1 : 0; ?>">
									
						<div id="sidebar-inner">
							
							<div id="project-meta" data-sharing="<?php echo ( !empty($options['portfolio_social']) && $options['portfolio_social'] == 1 ) ? '1' : '0'; ?>">

									
									<ul class="project-sharing"> 


								<?php
									// portfolio social sharting icons
									if( !empty($options['portfolio_social']) && $options['portfolio_social'] == 1 ) {
										
										echo '<li class="meta-share-count"><a href="#"><i class="icon-default-style steadysets-icon-share"></i><span class="share-count-total">0</span> <span class="plural">'. __('Shares',NECTAR_THEME_NAME) . '</span> <span class="singular">'. __('Share',NECTAR_THEME_NAME) .'</span></a> <div class="nectar-social">';
										
										
										//facebook
										if(!empty($options['portfolio-facebook-sharing']) && $options['portfolio-facebook-sharing'] == 1) { 
											echo "<a class='facebook-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-facebook'></i> <span class='count'></span></a>";
										}
										//twitter
										if(!empty($options['portfolio-twitter-sharing']) && $options['portfolio-twitter-sharing'] == 1) {
											echo "<a class='twitter-share nectar-sharing' href='#' title='".__('Tweet this', NECTAR_THEME_NAME)."'> <i class='icon-twitter'></i> <span class='count'></span></a>";
										}
										//google plus
										if(!empty($options['portfolio-google-plus-sharing']) && $options['portfolio-google-plus-sharing'] == 1) {
											echo "<a class='google-plus-share nectar-sharing-alt' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-google-plus'></i> <span class='count'> ".GetGooglePlusShares(get_permalink($post->ID))." </span></a>";
										}
										
										//linkedIn
										if(!empty($options['portfolio-linkedin-sharing']) && $options['portfolio-linkedin-sharing'] == 1) {
											echo "<a class='linkedin-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-linkedin'></i> <span class='count'> </span></a>";
										}
										//pinterest
										if(!empty($options['portfolio-pinterest-sharing']) && $options['portfolio-pinterest-sharing'] == 1) {
											echo "<a class='pinterest-share nectar-sharing' href='#' title='".__('Pin this', NECTAR_THEME_NAME)."'> <i class='icon-pinterest'></i> <span class='count'></span></a>";
										}
										
										echo '</div></li>';

									}

									echo '<li><span class="n-shortcode">'.nectar_love('return').'</span></li>';
									

									if(!empty($options['portfolio_date']) && $options['portfolio_date'] == 1) {
									   if( empty($options['portfolio_social']) || $options['portfolio_social'] == 0 ) { ?>

											<li class="project-date">
												<?php the_time('F d, Y'); ?>
											</li>
									   <?php } 
								    
										}
									?>
								</ul><!--sharing-->

								<div class="clear"></div>
							</div><!--project-meta-->
							
							<?php the_content(); ?>
							
							
							<?php 
							$project_attrs = get_the_terms( $post->ID, 'project-attributes' );
							 if (!empty($project_attrs)){ ?>
								<ul class="project-attrs checks">
									<?php 
									foreach($project_attrs as $attr){
										echo '<li>' . $attr->name . '</li>';
									}	 
									?>
								</ul>
							<?php } ?>
						
			
						</div>
						
					</div><!--/sidebar-->
					
				<?php } 
				
				endwhile; endif; ?>
				
			</div>


			<?php if(comments_open() && $theme_skin == 'ascend') { ?>
						
				<div class="comments-section row">
	   			   <?php comments_template(); ?>
				</div>
			
			<?php } ?>  

		</div><!--/container-->

		<?php if($single_nav_pos == 'after_project') { 
			echo '<div class="bottom_controls"> <div class="container">';  
			project_single_controls();
			echo '</div></div>';  
		} ?>

	
	</div><!--/container-wrap-->

</div><!--/if portfolio fullwidth-->
	
<?php get_footer(); ?>