<?php 

$options = get_nectar_theme_options(); 
global $post;
$cta_link = ( !empty($options['cta-btn-link']) ) ? $options['cta-btn-link'] : '#';
$using_footer_widget_area = (!empty($options['enable-main-footer-area']) && $options['enable-main-footer-area'] == 1) ? 'true' : 'false';
$disable_footer_copyright = (!empty($options['disable-copyright-footer-area']) && $options['disable-copyright-footer-area'] == 1) ? 'true' : 'false';
$footer_reveal = (!empty($options['footer-reveal'])) ? $options['footer-reveal'] : 'false'; 
$midnight_non_reveal = ($footer_reveal != 'false') ? null : 'data-midnight="light"';

  
$exclude_pages = (!empty($options['exclude_cta_pages'])) ? $options['exclude_cta_pages'] : array(); 

?>

<div id="footer-outer" <?php echo $midnight_non_reveal; ?> data-using-widget-area="<?php echo $using_footer_widget_area; ?>">
	
	<?php if(!empty($options['cta-text']) && current_page_url() != $cta_link && !in_array($post->ID, $exclude_pages)) {  
		$cta_btn_color = (!empty($options['cta-btn-color'])) ? $options['cta-btn-color'] : 'accent-color'; ?>

		<div id="call-to-action">
			<div class="container">
				<div class="triangle"></div>
				<span> <?php echo $options['cta-text']; ?> </span>
				<a class="nectar-button <?php if($cta_btn_color != 'see-through') echo 'regular-button '; ?> <?php echo $cta_btn_color;?>" data-color-override="false" href="<?php echo $cta_link ?>"><?php if(!empty($options['cta-btn'])) echo $options['cta-btn']; ?> </a>
			</div>
		</div>

	<?php } ?>

	<?php if( $using_footer_widget_area == 'true') { ?>
		
	<div id="footer-widgets">
		
		<div class="container">
			
			<div class="row">
				
				<?php 
				
				$footerColumns = (!empty($options['footer_columns'])) ? $options['footer_columns'] : '4'; 
				
				if($footerColumns == '2'){
					$footerColumnClass = 'span_6';
				} else if($footerColumns == '3'){
					$footerColumnClass = 'span_4';
				} else {
					$footerColumnClass = 'span_3';
				}
				?>
				
				<div class="col <?php echo $footerColumnClass;?>">
				      <!-- Footer widget area 1 -->
		              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 1') ) : else : ?>	
		              	  <div class="widget">		
						  	 <h4 class="widgettitle">Widget Area 1</h4>
						 	 <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>">Click here to assign a widget to this area.</a></p>
				     	  </div>
				     <?php endif; ?>
				</div><!--/span_3-->
				
				<div class="col <?php echo $footerColumnClass;?>">
					 <!-- Footer widget area 2 -->
		             <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 2') ) : else : ?>	
		                  <div class="widget">			
						 	 <h4 class="widgettitle">Widget Area 2</h4>
						 	 <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>">Click here to assign a widget to this area.</a></p>
				     	  </div>
				     <?php endif; ?>
				     
				</div><!--/span_3-->
				
				<?php if($footerColumns == '3' || $footerColumns == '4') { ?>
					<div class="col <?php echo $footerColumnClass;?>">
						 <!-- Footer widget area 3 -->
			              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 3') ) : else : ?>		
			              	  <div class="widget">			
							  	<h4 class="widgettitle">Widget Area 3</h4>
							  	<p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>">Click here to assign a widget to this area.</a></p>
							  </div>		   
					     <?php endif; ?>
					     
					</div><!--/span_3-->
				<?php } ?>
				
				<?php if($footerColumns == '4') { ?>
					<div class="col <?php echo $footerColumnClass;?>">
						 <!-- Footer widget area 4 -->
			              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Area 4') ) : else : ?>	
			              	<div class="widget">		
							    <h4>Widget Area 4</h4>
							    <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>">Click here to assign a widget to this area.</a></p>
							 </div><!--/widget-->	
					     <?php endif; ?>
					     
					</div><!--/span_3-->
				<?php } ?>
				
			</div><!--/row-->
			
		</div><!--/container-->
	
	</div><!--/footer-widgets-->
	
	<?php } //endif for enable main footer area


	   if( $disable_footer_copyright == 'false') { ?>

	
		<div class="row" id="copyright">
			
			<div class="container">
				
				<div class="col span_5">
					
					<?php if(!empty($options['disable-auto-copyright']) && $options['disable-auto-copyright'] == 1) { ?>
						<p><?php if(!empty($options['footer-copyright-text'])) echo $options['footer-copyright-text']; ?> </p>	
					<?php } else { ?>
						<p>&copy; <?php echo date('Y') . ' ' . get_bloginfo('name'); ?>. <?php if(!empty($options['footer-copyright-text'])) echo $options['footer-copyright-text']; ?> </p>
					<?php } ?>
					
				</div><!--/span_5-->
				
				<div class="col span_7 col_last">
					<ul id="social">
						<?php  if(!empty($options['use-twitter-icon']) && $options['use-twitter-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['twitter-url']; ?>"><i class="icon-twitter"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-facebook-icon']) && $options['use-facebook-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['facebook-url']; ?>"><i class="icon-facebook"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-vimeo-icon']) && $options['use-vimeo-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['vimeo-url']; ?>"> <i class="icon-vimeo"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-pinterest-icon']) && $options['use-pinterest-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['pinterest-url']; ?>"><i class="icon-pinterest"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-linkedin-icon']) && $options['use-linkedin-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['linkedin-url']; ?>"><i class="icon-linkedin"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-youtube-icon']) && $options['use-youtube-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['youtube-url']; ?>"><i class="icon-youtube-play"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-tumblr-icon']) && $options['use-tumblr-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['tumblr-url']; ?>"><i class="icon-tumblr"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-dribbble-icon']) && $options['use-dribbble-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['dribbble-url']; ?>"><i class="icon-dribbble"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-rss-icon']) && $options['use-rss-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo (!empty($options['rss-url'])) ? $options['rss-url'] : get_bloginfo('rss_url'); ?>"><i class="icon-rss"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-github-icon']) && $options['use-github-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['github-url']; ?>"><i class="icon-github-alt"></i></a></li> <?php } ?>
						<?php  if(!empty($options['use-behance-icon']) && $options['use-behance-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['behance-url']; ?>"> <i class="icon-be"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-google-plus-icon']) && $options['use-google-plus-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['google-plus-url']; ?>"><i class="icon-google-plus"></i> </a></li> <?php } ?>
						<?php  if(!empty($options['use-instagram-icon']) && $options['use-instagram-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['instagram-url']; ?>"><i class="icon-instagram"></i></a></li> <?php } ?>
						<?php  if(!empty($options['use-stackexchange-icon']) && $options['use-stackexchange-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['stackexchange-url']; ?>"><i class="icon-stackexchange"></i></a></li> <?php } ?>
						<?php  if(!empty($options['use-soundcloud-icon']) && $options['use-soundcloud-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['soundcloud-url']; ?>"><i class="icon-soundcloud"></i></a></li> <?php } ?>
						<?php  if(!empty($options['use-flickr-icon']) && $options['use-flickr-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['flickr-url']; ?>"><i class="icon-flickr"></i></a></li> <?php } ?>
						<?php  if(!empty($options['use-spotify-icon']) && $options['use-spotify-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['spotify-url']; ?>"><i class="icon-salient-spotify"></i></a></li> <?php } ?>
						<?php  if(!empty($options['use-vk-icon']) && $options['use-vk-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['vk-url']; ?>"><i class="icon-vk"></i></a></li> <?php } ?>
						<?php  if(!empty($options['use-vine-icon']) && $options['use-vine-icon'] == 1) { ?> <li><a target="_blank" href="<?php echo $options['vine-url']; ?>"><i class="fa-vine"></i></a></li> <?php } ?>
					</ul>
				</div><!--/span_7-->
			
			</div><!--/container-->
			
		</div><!--/row-->
		
		<?php } //endif for enable main footer copyright ?>

</div><!--/footer-outer-->


<?php 

$mobile_fixed = (!empty($options['header-mobile-fixed'])) ? $options['header-mobile-fixed'] : 'false';
$has_main_menu = (has_nav_menu('top_nav')) ? 'true' : 'false';

$sideWidgetArea = (!empty($options['header-slide-out-widget-area'])) ? $options['header-slide-out-widget-area'] : 'off';
$userSetSideWidgetArea = $sideWidgetArea;
if($has_main_menu == 'true' && $mobile_fixed == '1') $sideWidgetArea = '1';

$fullWidthHeader = (!empty($options['header-fullwidth']) && $options['header-fullwidth'] == '1') ? true : false;
$sideWidgetClass = (!empty($options['header-slide-out-widget-area-style'])) ? $options['header-slide-out-widget-area-style'] : 'slide-out-from-right';
$sideWidgetOverlayOpacity = (!empty($options['header-slide-out-widget-area-overlay-opacity'])) ? $options['header-slide-out-widget-area-overlay-opacity'] : 'dark';
$prependTopNavMobile = (!empty($options['header-slide-out-widget-area-top-nav-in-mobile'])) ? $options['header-slide-out-widget-area-top-nav-in-mobile'] : 'false';

if($sideWidgetArea == '1') { 

	if($sideWidgetClass == 'fullscreen') echo '</div><!--blurred-wrap-->'; ?>

	<div id="slide-out-widget-area-bg" class="<?php echo $sideWidgetClass . ' '. $sideWidgetOverlayOpacity; ?>"><?php if($sideWidgetClass == 'fullscreen-alt') echo '<div class="bg-inner"></div>';?></div>
	<div id="slide-out-widget-area" class="<?php echo $sideWidgetClass; ?>" data-back-txt="<?php echo __('Back', NECTAR_THEME_NAME); ?>">

		<?php if($sideWidgetClass == 'fullscreen' || $sideWidgetClass == 'fullscreen-alt') echo '<div class="inner-wrap">'; ?>

		<div class="inner">

		  <a class="slide_out_area_close" href="#"><span class="icon-salient-x icon-default-style"></span></a>


		   <?php  

		   if($userSetSideWidgetArea == 'off' || $prependTopNavMobile == '1' && $has_main_menu == 'true') { ?>
			   <div class="off-canvas-menu-container mobile-only">
			  		<ul class="menu">
					   <?php 
					  		////use default top nav menu if ocm is not activated
					  	     ////but is needed for mobile when the mobile fixed nav is on
					   		wp_nav_menu( array('theme_location' => 'top_nav', 'container' => '', 'items_wrap' => '%3$s')); 
					   ?>
		
					</ul>
				</div>
			<?php } 
		 
		  if(has_nav_menu('off_canvas_nav') && $userSetSideWidgetArea != 'off') { ?>
		 	 <div class="off-canvas-menu-container">
		  		<ul class="menu">
					    <?php wp_nav_menu( array('theme_location' => 'off_canvas_nav', 'container' => '', 'items_wrap' => '%3$s'));	?>		  
				</ul>
		    </div>
		    
		  <?php } 
		  
		   //widget area
		   if($sideWidgetClass != 'slide-out-from-right-hover') {
			   if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Off Canvas Menu') ) : elseif(!has_nav_menu('off_canvas_nav') && $userSetSideWidgetArea != 'off') : ?>	
			      <div class="widget">			
				 	 <h4 class="widgettitle">Side Widget Area</h4>
				 	 <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>">Click here to assign widgets to this area.</a></p>
			 	  </div>
			 <?php endif; 

			} ?>

		</div>

		<?php

			$usingSocialOrBottomText = (!empty($options['header-slide-out-widget-area-social']) && $options['header-slide-out-widget-area-social'] == '1' || !empty($options['header-slide-out-widget-area-bottom-text'])) ? true : false;
			
			echo '<div class="bottom-meta-wrap">';

			if($sideWidgetClass == 'slide-out-from-right-hover') {
			   if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Off Canvas Menu') ) : elseif(!has_nav_menu('off_canvas_nav') && $userSetSideWidgetArea != 'off') : ?>	
			      <div class="widget">			
				 	 <h4 class="widgettitle">Side Widget Area</h4>
				 	 <p class="no-widget-added"><a href="<?php echo admin_url('widgets.php'); ?>">Click here to assign widgets to this area.</a></p>
			 	  </div>
			 <?php endif; 

			} 

			global $using_secondary;
		 	/*social icons*/
			 if(!empty($options['header-slide-out-widget-area-social']) && $options['header-slide-out-widget-area-social'] == '1') {
			 	$social_link_arr = array('twitter-url','facebook-url','vimeo-url','pinterest-url','linkedin-url','youtube-url','tumblr-url','dribbble-url','rss-url','github-url','behance-url','google-plus-url','instagram-url','stackexchange-url','soundcloud-url','flickr-url','spotify-url','vk-url','vine-url');
			 	$social_icon_arr = array('icon-twitter','icon-facebook','icon-vimeo','icon-pinterest','icon-linkedin','icon-youtube','icon-tumblr','icon-dribbble','icon-rss','icon-github-alt','icon-be','icon-google-plus','icon-instagram','icon-stackexchange','icon-soundcloud','icon-flickr','icon-salient-spotify','icon-vk','fa-vine');
			 	
			 	echo '<ul class="off-canvas-social-links">';

			 	for($i=0; $i<sizeof($social_link_arr); $i++) {
			 		
			 		if(!empty($options[$social_link_arr[$i]]) && strlen($options[$social_link_arr[$i]]) > 1) echo '<li><a target="_blank" href="'.$options[$social_link_arr[$i]].'"><i class="'.$social_icon_arr[$i].'"></i></a></li>';
			 	}

			 	echo '</ul>';
			 } else if (!empty($options['enable_social_in_header']) && $options['enable_social_in_header'] == '1' && $using_secondary != 'header_with_secondary') {
			 	echo '<ul class="off-canvas-social-links mobile-only">';
				nectar_header_social_icons('secondary-nav');
				echo '</ul>';
			 }

			 /*bottom text*/
			 if(!empty($options['header-slide-out-widget-area-bottom-text'])) {
			 	$desktop_social = (!empty($options['enable_social_in_header']) && $options['enable_social_in_header'] == '1') ? 'false' : 'true';
			 	echo '<p class="bottom-text" data-has-desktop-social="'. $desktop_social .'">'.$options['header-slide-out-widget-area-bottom-text'].'</p>';
			 }

			echo '</div><!--/bottom-meta-wrap-->';

			if($sideWidgetClass == 'fullscreen' || $sideWidgetClass == 'fullscreen-alt') echo '</div> <!--/inner-wrap-->'; ?>

	</div>
<?php } ?>


</div> <!--/ajax-content-wrap-->

<?php if(!empty($options['boxed_layout']) && $options['boxed_layout'] == '1') { echo '</div>'; } ?>

<?php if(!empty($options['back-to-top']) && $options['back-to-top'] == 1) { ?>
	<a id="to-top" class="<?php if(!empty($options['back-to-top-mobile']) && $options['back-to-top-mobile'] == 1) echo 'mobile-enabled'; ?>"><i class="icon-angle-up"></i></a>
<?php } 

$body_border = (!empty($options['body-border'])) ? $options['body-border'] : 'off';
if($body_border == '1') {
	echo '<div class="body-border-top"></div>
		<div class="body-border-right"></div>
		<div class="body-border-bottom"></div>
		<div class="body-border-left"></div>';
} 

wp_footer(); ?>	

</body>
</html>