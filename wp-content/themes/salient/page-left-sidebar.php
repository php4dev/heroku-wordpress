<?php 
/*template name: Sidebar - Left*/
get_header(); ?>

<?php nectar_page_header($post->ID); ?>

<div class="container-wrap">
	
	<div class="container main-content">
		
		<div class="row">
			
			<div id="post-area" class="col span_9 col_last">
				<?php 
				
				if(have_posts()) : while(have_posts()) : the_post(); ?>
					
					<?php the_content(); ?>
	
				<?php endwhile; endif; ?>
				
			</div><!--/span_9-->
			
			<div id="sidebar" class="col span_3 left-sidebar">
				<?php get_sidebar(); ?>
			</div><!--/span_9-->
			
			
		</div><!--/row-->
		
	</div><!--/container-->

</div><!--/container-wrap-->

<?php get_footer(); ?>

