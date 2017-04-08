<?php get_header(); ?>

<script>
jQuery(document).ready(function($){
	
	var $searchContainer = $('#search-results');
	
	$(window).load(function(){
		
		$searchContainer.isotope({
		   itemSelector: '.result',
		   layoutMode: 'packery',
		   packery: { columnWidth: $('#search-results').width() / 3 }
		});
		
		$searchContainer.css('visibility','visible');
				
	});
	
	$(window).resize(function(){
	   $searchContainer.isotope({
	   	  layoutMode: 'packery',
	      packery: { columnWidth: $('#search-results').width() / 3}
	   });
	});

	
});
</script>

<div class="container-wrap">
	
	<div class="container main-content">
		
		<div class="row">
			<div class="col span_12">
				<div class="col span_12 section-title">
					<h1><?php echo __('Results For', NECTAR_THEME_NAME); ?><span>"<?php echo esc_html( get_search_query( false ) ); ?>"</span></h1>
				</div>
			</div>
		</div>
		
		<div class="divider"></div>
		
		<div class="row">
			
			<div class="col span_9">
				
				<div id="search-results">
						
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						

							
							<?php if( get_post_type($post->ID) == 'post' ){ ?>
								<article class="result">
									<div class="inner-wrap">
										<span class="bottom-line"></span>
										<?php if(has_post_thumbnail( $post->ID )) {	
											echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
										} ?>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo __('Blog Post', NECTAR_THEME_NAME); ?></span></h2>
									</div>
								</article><!--/search-result-->	
							<?php }
							
							else if( get_post_type($post->ID) == 'page' ){ ?>
								<article class="result">
									<div class="inner-wrap">
										<span class="bottom-line"></span>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo __('Page', NECTAR_THEME_NAME); ?></span></h2>	
										
										<?php if(has_excerpt()) the_excerpt(); ?>
									</div>
								</article><!--/search-result-->	
							<?php }
							
							else if( get_post_type($post->ID) == 'portfolio' ){ ?>
								<article class="result">
									<div class="inner-wrap">
										<span class="bottom-line"></span>
										<?php if(has_post_thumbnail( $post->ID )) {	
											echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
										} ?>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo __('Portfolio Item', NECTAR_THEME_NAME); ?></span></h2>
									</div>
								</article><!--/search-result-->		
							<?php }
							
							else if( get_post_type($post->ID) == 'product' ){ ?>
								<article class="result">
									<div class="inner-wrap">
										<span class="bottom-line"></span>
										<?php if(has_post_thumbnail( $post->ID )) {	
											echo '<a href="'.get_permalink().'">'. get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
										} ?>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo __('Product', NECTAR_THEME_NAME); ?></span></h2>	
									</div>
								</article><!--/search-result-->	
							<?php } else { ?>
								<article class="result">
									<div class="inner-wrap">
										<span class="bottom-line"></span>
										<?php if(has_post_thumbnail( $post->ID )) {	
											echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
										} ?>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									</div>
								</article><!--/search-result-->	
							<?php } ?>
							
						
						
					<?php endwhile; 
					
					else: echo "<p>" . __('No results found', NECTAR_THEME_NAME) . "</p>"; endif;?>
				
						
				</div><!--/search-results-->
				
				
				<?php if( get_next_posts_link() || get_previous_posts_link() ) { ?>
					<div id="pagination">
						<div class="prev"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
						<div class="next"><?php next_posts_link('Next Entries &raquo;','') ?></div>
					</div>	
				<?php }?>
				
			</div><!--/span_9-->
			
			<div id="sidebar" class="col span_3 col_last">
				<?php get_sidebar(); ?>
			</div><!--/span_3-->
		
		</div><!--/row-->
		
	</div><!--/container-->

</div><!--/container-wrap-->

<?php get_footer(); ?>

