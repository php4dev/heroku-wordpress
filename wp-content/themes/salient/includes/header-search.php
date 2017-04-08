<?php $options = get_nectar_theme_options(); 

if(!empty($options['header-disable-ajax-search']) && $options['header-disable-ajax-search'] == '1') {
	$ajax_search = 'no';	
} else {
	$ajax_search = 'yes';
} ?>

<div id="search-outer" class="nectar">
		
	<div id="search">
	  	 
		<div class="container">
		  	 	
		     <div id="search-box">
		     	
		     	<div class="col span_12">
			      	<form action="<?php echo home_url(); ?>" method="GET">
			      		<input type="text" name="s" <?php if($ajax_search == 'yes') { echo 'id="s"'; } ?> value="<?php echo __('Start Typing...', NECTAR_THEME_NAME); ?>" data-placeholder="<?php echo __('Start Typing...', NECTAR_THEME_NAME); ?>" />
			      	</form>
			      	<?php if(!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend' && $ajax_search == 'no') echo '<span><i>'.__("Press enter to begin your search",NECTAR_THEME_NAME).'</i></span>'; ?>
		        </div><!--/span_12-->
			      
		     </div><!--/search-box-->
		     
		     <div id="close"><a href="#"><span class="icon-salient-x" aria-hidden="true"></span></a></div>
		     
		 </div><!--/container-->
	    
	</div><!--/search-->
	  
</div><!--/search-outer-->