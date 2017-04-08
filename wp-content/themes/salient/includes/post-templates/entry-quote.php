<?php 
$options = get_nectar_theme_options(); 
global $post;

$masonry_size_pm = get_post_meta($post->ID, '_post_item_masonry_sizing', true); 
$masonry_item_sizing = (!empty($masonry_size_pm)) ? $masonry_size_pm : 'regular'; 
$using_masonry = null;
$masonry_type = (!empty($options['blog_masonry_type'])) ? $options['blog_masonry_type'] : 'classic'; 
global $layout;
$blog_type = $options['blog_type']; 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($masonry_item_sizing.' quote'); ?>>
	
	<div class="inner-wrap animated">

		<div class="post-content">
			
			<?php if( !is_single() ) { ?>
				
				<div class="post-meta">
		
					<div class="date">
						<?php 
						if(
						$blog_type == 'masonry-blog-sidebar' && substr( $layout, 0, 3 ) != 'std' || 
						$blog_type == 'masonry-blog-fullwidth' && substr( $layout, 0, 3 ) != 'std' || 
						$blog_type == 'masonry-blog-full-screen-width' && substr( $layout, 0, 3 ) != 'std' || 
						$layout == 'masonry-blog-sidebar' || $layout == 'masonry-blog-fullwidth' || $layout == 'masonry-blog-full-screen-width') {
							$using_masonry = true;
							echo get_the_date();
						}
						else { ?>
						
							<span class="month"><?php the_time('M'); ?></span>
							<span class="day"><?php the_time('d'); ?></span>
							<?php global $options; 
							if(!empty($options['display_full_date']) && $options['display_full_date'] == 1) {
								echo '<span class="year">'. get_the_time('Y') .'</span>';
							}
						} ?>
					</div><!--/date-->
					
					<?php if($using_masonry == true && $masonry_type == 'meta_overlaid') { } else { ?> 
						<div class="nectar-love-wrap">
							<?php if( function_exists('nectar_love') ) nectar_love(); ?>
						</div><!--/nectar-love-wrap-->	
					<?php } ?>
								
				</div><!--/post-meta-->
			
			<?php } ?>
			
			<?php 
				$img_size = ($blog_type == 'masonry-blog-sidebar' && substr( $layout, 0, 3 ) != 'std' || $blog_type == 'masonry-blog-fullwidth' && substr( $layout, 0, 3 ) != 'std' || $blog_type == 'masonry-blog-full-screen-width' && substr( $layout, 0, 3 ) != 'std' || $layout == 'masonry-blog-sidebar' || $layout == 'masonry-blog-fullwidth' || $layout == 'masonry-blog-full-screen-width') ? 'large' : 'full';
			 	if($using_masonry == true && $masonry_type == 'meta_overlaid') $img_size = (!empty($masonry_item_sizing)) ? $masonry_item_sizing : 'portfolio-thumb';
			 	if($using_masonry == true && $masonry_type == 'classic_enhanced') $img_size = (!empty($masonry_item_sizing) && $masonry_item_sizing == 'regular') ? 'portfolio-thumb' : 'full';
				
				if($using_masonry == true && $masonry_type == 'classic_enhanced' && $masonry_item_sizing != 'regular') echo'<a href="' . get_permalink() . '" class="img-link"><span class="post-featured-img">'.get_the_post_thumbnail($post->ID, $img_size, array('title' => '')) .'</span></a>'; 
			?>

			<div class="content-inner">

				<?php 
				$quote = get_post_meta($post->ID, '_nectar_quote', true);
				?>

				<?php if( !is_single() ) { ?> <a href="<?php the_permalink(); ?>"><?php } ?> 

				<div class="quote-inner">
					
					
						<span class="quote-wrap">
								
								<?php 
									$h_num = '2';
									if($using_masonry == true && $masonry_type == 'classic_enhanced') {
										$h_num = '3';
									} 	
								?>
								<h<?php echo $h_num; ?> class="title">
									<?php echo $quote; ?>
								</h<?php echo $h_num; ?>>
							
							
					    	<span class="author"> 
					    		<?php the_title(); ?>
					    	</span> 
					    </span>
			    	<span title="Quote" class="icon"></span>

			    
			    	
				</div><!--/quote-inner-->

				<?php if( !is_single() ) { ?> </a> <?php } ?>

				<?php 
				$below_content = get_the_content();
				if(is_single() && !empty( $below_content )){ ?>
					<div class="quote-below-content">	
						<?php the_content('<span class="continue-reading">'. __("Read More", NECTAR_THEME_NAME) . '</span>'); ?>
					</div>
				<?php } ?>
				
				<?php global $options;
					if( $options['display_tags'] == true ){
						 
						if( is_single() && has_tag() ) {
						
							echo '<div class="post-tags"><h4>'.__('Tags:').'</h4>'; 
							the_tags('','','');
							echo '<div class="clear"></div></div> ';
							
						}
					}
				?>
				
			</div><!--/content-inner-->
			
		</div><!--/post-content-->
		
	</div><!--/inner-wrap-->
		
</article><!--/article-->