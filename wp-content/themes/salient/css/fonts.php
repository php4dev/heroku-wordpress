<?php 

$options = get_nectar_theme_options();

$external_dynamic = (!empty($options['external-dynamic-css']) && $options['external-dynamic-css'] == 1) ? 'on' : 'off';


	$options = get_nectar_theme_options(); 

	$legacy_options = get_option('salient');
	$current_options = get_option('salient_redux');

	//load custom fonts
	if(!empty($current_options)) {
		$font_fields = array('navigation_font_family','navigation_dropdown_font_family','page_heading_font_family','page_heading_subtitle_font_family','off_canvas_nav_font_family','off_canvas_nav_subtext_font_family','body_font_family','h1_font_family','h2_font_family','h3_font_family','h4_font_family','h5_font_family','h6_font_family','i_font_family','label_font_family','nectar_slider_heading_font_family','home_slider_caption_font_family','testimonial_font_family','sidebar_footer_h_font_family','team_member_h_font_family','nectar_dropcap_font_family');
		
		//legacy formatting
		foreach($font_fields as $k => $v) { 
			$options[str_replace('_family', '', $v)] = (empty($options[$v]['font-family'])) ? '-' : $options[$v]['font-family'];
			$options[str_replace('_family', '', $v) . '_size'] = (empty($options[$v]['font-size'])) ? '-' : $options[$v]['font-size'];
			$options[str_replace('_family', '', $v) . '_line_height'] = (empty($options[$v]['line-height'])) ? '-' : $options[$v]['line-height'];
			$options[str_replace('_family', '', $v) . '_spacing'] = (empty($options[$v]['letter-spacing'])) ? '-' : $options[$v]['letter-spacing'];
			$options[str_replace('_family', '', $v) . '_weight'] = (empty($options[$v]['font-weight'])) ? '-' : $options[$v]['font-weight'];
			$options[str_replace('_family', '', $v) . '_transform'] = (empty($options[$v]['text-transform'])) ? '-' : $options[$v]['text-transform'];
			$options[str_replace('_family', '', $v) . '_style'] = (empty($options[$v]['font-weight'])) ? '-' : $options[$v]['font-weight'];

			if(!empty($options[$v]['font-weight']) && !empty($options[$v]['font-style'])) $options[str_replace('_family', '', $v) . '_style'] = $options[$v]['font-weight'] . $options[$v]['font-style'];
		}



	}


	
	if($external_dynamic != 'on') { ob_start(); }

	$body = $options['body_font'];
	$navigation = $options['navigation_font'];
	$navigation_dropdown = $options['navigation_dropdown_font'];
	$sidebar_carousel_footer_header = $options['sidebar_footer_h_font'];
	$team_member_names = $options['team_member_h_font'];
	
	if($external_dynamic != 'on') { echo '<style type="text/css">'; }

	/*-------------------------------------------------------------------------*/
	/*	Body Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['body_font_style']);

	( intval( substr($options['body_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['body_font_size'],0,-2)) * 1.8 .'px' : $line_height = null ;  ?>
	
	<?php echo 'body, .toggle h3 a, body .ui-widget, table, .bar_graph li span strong, #slide-out-widget-area .tagcloud a, body .container .woocommerce-message a.button, #search-results .result .title span, .woocommerce ul.products li.product h3, .woocommerce-page ul.products li.product h3, .row .col.section-title .nectar-love span, body .nectar-love span, body .nectar-social .nectar-love .nectar-love-count, body .carousel-heading h2, .sharing-default-minimal .nectar-social .social-text, body .sharing-default-minimal .nectar-love 
	{'; ?>
		<?php if($options['body_font'] != '-') {
			$font_family = (1 === preg_match('~[0-9]~', $options['body_font'])) ? '"'. $options['body_font'] .'"' : $options['body_font'];
		}
			  if($options['body_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['body_font_transform'] != '-') echo 'text-transform: ' . $options['body_font_transform'] .';'; 
			  if($options['body_font_spacing'] != '-') echo 'letter-spacing: ' . $options['body_font_spacing'] .';'; 
		      if($options['body_font_size'] != '-') echo 'font-size:' . $options['body_font_size'] .';'; ?>
		
		<?php 
		//user set line-height
		 if($options['body_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['body_font_line_height'] .';'; 
		 	$the_line_height = $options['body_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>

		<?php 
		if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; 
	
     if($options['body_font'] != '-') {
	   echo '.bold, strong, b { font-family: ' . $font_family .'; font-weight: 600; } ';
	 }
	
	 echo '.nectar-fancy-ul ul li .icon-default-style[class^="icon-"] {'; 
		if(!empty($the_line_height)) echo 'line-height:' . $the_line_height .'!important;';
	 echo '}'; ?>
	
	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Navigation Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['navigation_font_style']);
	
	( intval( substr($options['navigation_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['navigation_font_size'],0,-2)) *1.4 .'px' : $line_height = null ;  ?>
	
	<?php echo 'header#top nav > ul > li > a
	{'; ?>	
		<?php if($options['navigation_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['navigation_font'])) ? '"'. $options['navigation_font'] .'"' : $options['navigation_font'];
		}
			  if($options['navigation_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['navigation_font_transform'] != '-') echo 'text-transform: ' . $options['navigation_font_transform'] .';'; 
			  if($options['navigation_font_spacing'] != '-') echo 'letter-spacing: ' . $options['navigation_font_spacing'] .';'; 
		      if($options['navigation_font_size'] != '-') echo 'font-size:' . $options['navigation_font_size'] .';'; ?>
	
		<?php if(!empty($line_height)) echo 'line-height:' . $line_height .';'; ?>
		<?php 
		      if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
			  if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; 

		//increase spacing on larger nav fonts
	    if($options['navigation_font_size'] != '-' && intval(substr($options['navigation_font_size'],0,-2)) >= 15) { 
	    	echo '#header-outer[data-lhe="animated_underline"] header#top nav > ul > li > a,
	    	header#top nav > ul > li.button_solid_color > a, body #header-outer.transparent header#top nav > ul > li.button_solid_color > a,
			#header-outer[data-lhe="animated_underline"] header#top nav > ul > li.button_solid_color > a { margin-left: 13px!important;  margin-right: 13px!important; }';

			echo '#header-outer[data-lhe="default"] header#top nav > ul > li > a { padding-left: 13px;  padding-right: 13px; }';
			echo 'header#top nav > ul > li.button_solid_color > a, body #header-outer.transparent header#top nav > ul > li.button_solid_color > a, #header-outer[data-lhe="animated_underline"] header#top nav > ul > li.button_solid_color > a { padding-left: 23px!important; padding-right: 23px!important; }';
	    }

	    if($options['navigation_font_size'] != '-') {
	    	echo 'header#top nav > ul > li.button_solid_color > a:before, #header-outer.transparent header#top nav > ul > li.button_solid_color > a:before { 
	    		height: ' . ((intval(substr($options['navigation_font_size'],0,-2)) *1.4)+ 5)  .'px; 
	    	}';

	    	echo 'header#top nav > ul > li.button_bordered > a:before, #header-outer.transparent header#top nav > ul > li.button_bordered > a:before { 
	    		height: ' . ((intval(substr($options['navigation_font_size'],0,-2)) *1.4)+ 15)  .'px; 
	    	}';
		}

		//make search font match main nav font
		//if($options['navigation_font'] != '-') echo '#search-outer #search input[type="text"] { font-family: ' . $font_family .'; }';
	?>
	
	
	
	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Navigation Dropdown Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['navigation_dropdown_font_style']);
	( intval( substr($options['navigation_dropdown_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['navigation_dropdown_font_size'],0,-2)) + 10 .'px' : $line_height = null ;  ?>
	
	<?php echo 'header#top .sf-menu li ul li a, #header-secondary-outer nav > ul > li > a, #header-secondary-outer ul ul li a, #header-outer .widget_shopping_cart .cart_list a
	{';?>	
		<?php if($options['navigation_dropdown_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['navigation_dropdown_font'])) ? '"'. $options['navigation_dropdown_font'] .'"' : $options['navigation_dropdown_font'];
		}
			  if($options['navigation_dropdown_font'] != '-') echo 'font-family: ' . $font_family .';';
			  if($options['navigation_dropdown_font_transform'] != '-') echo 'text-transform: ' . $options['navigation_dropdown_font_transform'] .';'; 
			  if($options['navigation_dropdown_font_spacing'] != '-') echo 'letter-spacing: ' . $options['navigation_dropdown_font_spacing'] .';'; 
		      if($options['navigation_dropdown_font_size'] != '-') echo 'font-size:' . $options['navigation_dropdown_font_size'] .';'; ?>
			
		<?php 
		//user set line-height
		 if($options['navigation_dropdown_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['navigation_dropdown_font_line_height'] .';'; 
		 	$the_line_height = $options['navigation_dropdown_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
			  if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
			  if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>
	
	
	<?php echo '@media only screen 
	and (min-width : 1px) and (max-width : 1000px) 
	{
	  header#top .sf-menu a {
	  	font-family: '. $options['navigation_dropdown_font'] .'!important;
	  	font-size: 14px!important;
	  }
	}'; ?>
	
	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Page Heading Font - h1
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['h1_font_style']);
	
	( intval( substr($options['h1_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['h1_font_size'],0,-2)) +6 .'px' : $line_height = null ;  ?>
	
	<?php echo '#page-header-bg h1, body h1, body .row .col.section-title h1, .full-width-content .recent-post-container .inner-wrap h2
	{'; ?>	
		<?php if($options['h1_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['h1_font'])) ? '"'. $options['h1_font'] .'"' : $options['h1_font'];
		}
			  if($options['h1_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['h1_font_transform'] != '-') echo 'text-transform: ' . $options['h1_font_transform'] .';'; 
			  if($options['h1_font_spacing'] != '-') echo 'letter-spacing: ' . $options['h1_font_spacing'] .';'; 
		      if($options['h1_font_size'] != '-') echo 'font-size:' . $options['h1_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['h1_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['h1_font_line_height'] .';'; 
		 	$the_line_height = $options['h1_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
			  if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
			  if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>
	

	@media only screen and (max-width: 1300px) and (min-width: 1000px) {
		body .row .col.section-title h1, body h1, .full-width-content .recent-post-container .inner-wrap h2 {
			font-size: <?php if(!empty($options['h1_font_size']) && $options['h1_font_size'] != '-') echo $options['h1_font_size']*0.7 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.7) . 'px' ?>;
		}
	}
	@media only screen and (max-width: 1000px) and (min-width: 690px) {
		body .row .col.section-title h1, body h1 {
			font-size: <?php if(!empty($options['h1_font_size']) && $options['h1_font_size'] != '-') echo $options['h1_font_size']*0.65 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.65) . 'px' ?>;
		}
		.full-width-content .recent-post-container .inner-wrap h2 {
			font-size: <?php if(!empty($options['h1_font_size']) && $options['h1_font_size'] != '-') echo $options['h1_font_size']*0.6 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.6) . 'px' ?>;
		}
	}
	@media only screen and (max-width: 690px) {
		body .row .col.section-title h1, body h1 {
			font-size: <?php if(!empty($options['h1_font_size']) && $options['h1_font_size'] != '-') echo $options['h1_font_size']*0.6 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.6) . 'px' ?>;
		}
		.full-width-content .recent-post-container .inner-wrap h2 {
			font-size: <?php if(!empty($options['h1_font_size']) && $options['h1_font_size'] != '-') echo $options['h1_font_size']*0.45 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.45) . 'px' ?>;
		}
	}
	
	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Page Heading Font - h2
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['h2_font_style']);
	
	( intval( substr($options['h2_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['h2_font_size'],0,-2)) + intval(substr($options['h2_font_size'],0,-2))*0.65 .'px' : $line_height = null ;  ?>
	
	<?php echo '#page-header-bg h2, body h2, article.post .post-header h2, article.post.quote .post-content h2, article.post.link .post-content h2, article.post.format-status .post-content h2,
	#call-to-action span, .woocommerce .full-width-tabs #reviews h3, .row .col.section-title h2
	{'; ?>	
		<?php if($options['h2_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['h2_font'])) ? '"'. $options['h2_font'] .'"' : $options['h2_font'];
		}
			  if($options['h2_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['h2_font_transform'] != '-') echo 'text-transform: ' . $options['h2_font_transform'] .';'; 
			  if($options['h2_font_spacing'] != '-') echo 'letter-spacing: ' . $options['h2_font_spacing'] .';'; 
		      if($options['h2_font_size'] != '-') echo 'font-size:' . $options['h2_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['h2_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['h2_font_line_height'] .';'; 
		 	$the_line_height = $options['h2_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>

		<?php 
		     if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		     if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>

	@media only screen and (max-width: 1300px) and (min-width: 1000px) {
	 	body h2 {
	 		font-size: <?php if(!empty($options['h2_font_size']) && $options['h2_font_size'] != '-') echo $options['h2_font_size']*0.85 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.85) . 'px' ?>;
		}
		.row .span_2 h2, .row .span_3 h2, .row .span_4 h2, .row .vc_col-sm-2 h2, .row .vc_col-sm-3 h2, .row .vc_col-sm-4 h2 { 
			font-size: <?php if(!empty($options['h2_font_size']) && $options['h2_font_size'] != '-') echo $options['h2_font_size']*0.7 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.7) . 'px' ?>;
		}
	}

	@media only screen and (max-width: 690px) {
	.col h2 {
			font-size: <?php if(!empty($options['h2_font_size']) && $options['h2_font_size'] != '-') echo $options['h2_font_size']*0.85 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.85) . 'px' ?>;
		}
	}
	
	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Page Heading Font - h3
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['h3_font_style']);
	
	( intval( substr($options['h3_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['h3_font_size'],0,-2)) +8 .'px' : $line_height = null ;  ?>
	
	<?php echo 'body h3, .row .col h3, .toggle h3 a, .ascend #respond h3, .ascend h3#comments, .woocommerce ul.products li.product.text_on_hover h3, 
	.masonry.classic_enhanced .masonry-blog-item h3.title 
	{'; ?>	
		<?php if($options['h3_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['h3_font'])) ? '"'. $options['h3_font'] .'"' : $options['h3_font'];
		}
			  if($options['h3_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['h3_font_transform'] != '-') echo 'text-transform: ' . $options['h3_font_transform'] .';'; 
			  if($options['h3_font_spacing'] != '-') echo 'letter-spacing: ' . $options['h3_font_spacing'] .';'; 
		      if($options['h3_font_size'] != '-') echo 'font-size:' . $options['h3_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['h3_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['h3_font_line_height'] .';'; 
		 	$the_line_height = $options['h3_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		
		?>

		<?php 
              if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>
	
	@media only screen and (min-width: 1000px) {
		.ascend .comments-section .comment-wrap.full-width-section > h3, .blog_next_prev_buttons[data-post-header-style="default_minimal"] .col h3 {
			font-size: <?php if(!empty($options['h3_font_size']) && $options['h3_font_size'] != '-') echo $options['h3_font_size']*1.7 . 'px!important' ?>;
			line-height: <?php if(!empty($options['h3_font_size']) && $options['h3_font_size'] != '-') echo ($options['h3_font_size']*1.7) +8 . 'px!important' ?>;
		}

		.masonry.classic_enhanced .masonry-blog-item.large_featured h3.title {
			font-size: <?php if(!empty($options['h3_font_size']) && $options['h3_font_size'] != '-') echo $options['h3_font_size']*1.5 . 'px!important' ?>;
			line-height: <?php if(!empty($options['h3_font_size']) && $options['h3_font_size'] != '-') echo $the_line_height*1.5 . 'px!important' ?>;
		}
	}

	@media only screen and (min-width: 1300px) and (max-width: 1500px){
		body .portfolio-items.constrain-max-cols.masonry-items .col.elastic-portfolio-item h3 {
			font-size: <?php if(!empty($options['h3_font_size']) && $options['h3_font_size'] != '-') echo $options['h3_font_size']*0.85 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.85) . 'px' ?>;
		}
	}

	@media only screen and (max-width: 1300px) and (min-width: 1000px), (max-width: 690px) {
		.row .span_2 h3, .row .span_3 h3, .row .span_4 h3, .row .vc_col-sm-2 h3, .row .vc_col-sm-3 h3, .row .vc_col-sm-4 h3 {
			font-size: <?php if(!empty($options['h3_font_size']) && $options['h3_font_size'] != '-') echo $options['h3_font_size']*0.7 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.7) . 'px' ?>;
		}
	}
	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Page Heading Font - h4
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['h4_font_style']);
	
	( intval( substr($options['h4_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['h4_font_size'],0,-2)) +10 .'px' : $line_height = null ;  ?>
	
	<?php echo 'body h4, .row .col h4, .portfolio-items .work-meta h4, .list-icon-holder[data-icon_type="numerical"] span, .portfolio-items .col.span_3 .work-meta h4, #respond h3, h3#comments, .portfolio-items[data-ps="6"] .work-meta h4
	{'; ?>	
		<?php if($options['h4_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['h4_font'])) ? '"'. $options['h4_font'] .'"' : $options['h4_font'];
		}
			  if($options['h4_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['h4_font_transform'] != '-') echo 'text-transform: ' . $options['h4_font_transform'] .';'; 
			  if($options['h4_font_spacing'] != '-') echo 'letter-spacing: ' . $options['h4_font_spacing'] .';'; 
		      if($options['h4_font_size'] != '-') echo 'font-size:' . $options['h4_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['h4_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['h4_font_line_height'] .';'; 
		 	$the_line_height = $options['h4_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
              if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>
	
	@media only screen and (min-width: 690px) {
		.portfolio-items[data-ps="6"] .wide_tall .work-meta h4 {
			font-size: <?php if(!empty($options['h4_font_size']) && $options['h4_font_size'] != '-') echo $options['h4_font_size']*1.7 . 'px!important' ?>;
			line-height: <?php if(!empty($options['h4_font_size']) && $options['h4_font_size'] != '-') echo ($options['h4_font_size']*1.7) +8 . 'px!important' ?>;
		}

	}
	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Page Heading Font - h5
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['h5_font_style']);
	
	( intval( substr($options['h5_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['h5_font_size'],0,-2)) +10 .'px' : $line_height = null ;  ?>
	
	<?php echo 'body h5, .row .col h5, .portfolio-items .work-item.style-3-alt p
	{'; ?>	
		<?php if($options['h5_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['h5_font'])) ? '"'. $options['h5_font'] .'"' : $options['h5_font'];
		}
			  if($options['h5_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['h5_font_transform'] != '-') echo 'text-transform: ' . $options['h5_font_transform'] .';'; 
			  if($options['h5_font_spacing'] != '-') echo 'letter-spacing: ' . $options['h5_font_spacing'] .';'; 
		      if($options['h5_font_size'] != '-') echo 'font-size:' . $options['h5_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['h5_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['h5_font_line_height'] .';'; 
		 	$the_line_height = $options['h5_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
			  if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>



	body .wpb_column > .wpb_wrapper > .morphing-outline .inner > h5 {
		font-size: <?php if(!empty($options['h5_font_size']) && $options['h5_font_size'] != '-') echo ceil($options['h5_font_size']*1.35) . 'px!important' ?>;
	}
	
	<?php if( intval( substr($options['h5_font_size'],0,-2) ) > 16 ) { ?>
	@media only screen and (min-width: 1000px) and (max-width: 1300px) {
		
		.col.vc_span3 h5, .col.vc_span4 h5, .col.vc_col-sm-3 h5, .col.vc_col-sm-4 h5 {
			font-size: 16px!important;
		}
	}
	<?php } ?>

	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Page Heading Font - h6
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['h6_font_style']);
	
	( intval( substr($options['h6_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['h6_font_size'],0,-2)) +10 .'px' : $line_height = null ;  ?>
	
	<?php echo 'body h6, .row .col h6
	{'; ?>	
		<?php if($options['h6_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['h6_font'])) ? '"'. $options['h6_font'] .'"' : $options['h6_font'];
		}
			  if($options['h6_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['h6_font_transform'] != '-') echo 'text-transform: ' . $options['h6_font_transform'] .';'; 
			  if($options['h6_font_spacing'] != '-') echo 'letter-spacing: ' . $options['h6_font_spacing'] .';'; 
		      if($options['h6_font_size'] != '-') echo 'font-size:' . $options['h6_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['h6_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['h6_font_line_height'] .';'; 
		 	$the_line_height = $options['h6_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
		      if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>
	


	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Italic Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['i_font_style']);
	
	( intval( substr($options['i_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['i_font_size'],0,-2)) +10 .'px' : $line_height = null ;  ?>
	
	<?php echo 'body i, body em, .masonry.meta_overlaid article.post .post-header .meta-author > span, #post-area.masonry.meta_overlaid article.post .post-meta .date,
	#post-area.masonry.meta_overlaid article.post.quote .quote-inner .author, #post-area.masonry.meta_overlaid  article.post.link .post-content .destination
	{'; ?>	
		<?php if($options['i_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['i_font'])) ? '"'. $options['i_font'] .'"' : $options['i_font'];
		}
			  if($options['i_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['i_font_transform'] != '-') echo 'text-transform: ' . $options['i_font_transform'] .';'; 
			  if($options['i_font_spacing'] != '-') echo 'letter-spacing: ' . $options['i_font_spacing'] .';'; 
		      if($options['i_font_size'] != '-') echo 'font-size:' . $options['i_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['i_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['i_font_line_height'] .';'; 
		 	$the_line_height = $options['i_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
              if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>


	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Form Label Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['label_font_style']);
	
	( intval( substr($options['label_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['label_font_size'],0,-2)) +10 .'px' : $line_height = null ;  ?>
	
	<?php echo 'form label, .woocommerce-checkout-review-order-table .product-info .amount, .woocommerce-checkout-review-order-table .product-info .product-quantity,
	.nectar-progress-bar p, .nectar-progress-bar span strong i, .nectar-progress-bar span strong, .testimonial_slider blockquote span
	{'; ?>	
		<?php if($options['label_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['label_font'])) ? '"'. $options['label_font'] .'"' : $options['label_font'];
		}
			  if($options['label_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['label_font_transform'] != '-') echo 'text-transform: ' . $options['label_font_transform'] .';'; 
			  if($options['label_font_spacing'] != '-') echo 'letter-spacing: ' . $options['label_font_spacing'] .';'; 
		      if($options['label_font_size'] != '-') echo 'font-size:' . $options['label_font_size'] .'!important;'; ?>
	
		<?php 
		//user set line-height
		 if($options['label_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['label_font_line_height'] .';'; 
		 	$the_line_height = $options['label_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
              if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .'!important;'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>



	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Dropcap Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['nectar_dropcap_font_style']);
	
	( intval( substr($options['nectar_dropcap_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['nectar_dropcap_font_size'],0,-2)) +10 .'px' : $line_height = null ;  ?>
	
	<?php echo '.nectar-dropcap
	{'; ?>	
		<?php if($options['nectar_dropcap_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['nectar_dropcap_font'])) ? '"'. $options['nectar_dropcap_font'] .'"' : $options['nectar_dropcap_font'];
		}
			  if($options['nectar_dropcap_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['nectar_dropcap_font_transform'] != '-') echo 'text-transform: ' . $options['nectar_dropcap_font_transform'] .';'; 
			  if($options['nectar_dropcap_font_spacing'] != '-') echo 'letter-spacing: ' . $options['nectar_dropcap_font_spacing'] .';'; 
		      if($options['nectar_dropcap_font_size'] != '-') echo 'font-size:' . $options['nectar_dropcap_font_size'] .'!important;'; ?>
	
		<?php 
		//user set line-height
		 if($options['nectar_dropcap_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['nectar_dropcap_font_line_height'] .';'; 
		 	$the_line_height = $options['nectar_dropcap_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
              if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .'!important;'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>

	
	<?php 

	/*-------------------------------------------------------------------------*/
	/*	Page Header Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['page_heading_font_style']);
	
	( intval( substr($options['page_heading_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['page_heading_font_size'],0,-2)) +10 .'px' : $line_height = null ;  ?>
	
	<?php echo 'body #page-header-bg h1, html body .row .col.section-title h1, .nectar-box-roll .overlaid-content h1
	{'; ?>	
		<?php if($options['page_heading_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['page_heading_font'])) ? '"'. $options['page_heading_font'] .'"' : $options['page_heading_font'];
		}
			  if($options['page_heading_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['page_heading_font_transform'] != '-') echo 'text-transform: ' . $options['page_heading_font_transform'] .';'; 
			  if($options['page_heading_font_spacing'] != '-') echo 'letter-spacing: ' . $options['page_heading_font_spacing'] .';'; 
			  if($options['page_heading_font_size'] != '-') echo 'font-size:' . $options['page_heading_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['page_heading_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['page_heading_font_line_height'] .';'; 
		 	$the_line_height = $options['page_heading_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
		if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>

	@media only screen and (min-width: 690px) and (max-width: 1000px) {
		#page-header-bg .span_6 h1, .overlaid-content h1 {
			font-size: <?php if(!empty($options['page_heading_font_size']) && $options['page_heading_font_size'] != '-') echo $options['page_heading_font_size']*0.7 . 'px!important' ?>;
			line-height: <?php if(!empty($options['page_heading_font_size']) && $options['page_heading_font_size'] != '-') echo ($options['page_heading_font_size']*0.7) +4 . 'px!important' ?>;
		}
	}

	@media only screen and (min-width: 1000px) and (max-width: 1300px) {
		#page-header-bg .span_6 h1, .nectar-box-roll .overlaid-content h1 {
			font-size: <?php if(!empty($options['page_heading_font_size']) && $options['page_heading_font_size'] != '-') echo $options['page_heading_font_size']*0.85 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.85) . 'px' ?>;
		}
	}

	@media only screen and (min-width: 1300px) and (max-width: 1500px) {
		#page-header-bg .span_6 h1, .nectar-box-roll .overlaid-content h1 {
			font-size: <?php if(!empty($options['page_heading_font_size']) && $options['page_heading_font_size'] != '-') echo $options['page_heading_font_size']*0.9 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.9) . 'px' ?>;
		}
	}

	@media only screen and (max-width: 690px) {
		#page-header-bg.fullscreen-header .span_6 h1, .overlaid-content h1 {
			font-size: <?php if(!empty($options['page_heading_font_size']) && $options['page_heading_font_size'] != '-') echo $options['page_heading_font_size']*0.45 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.45) . 'px!important' ?>;
		}
	}


	<?php
	/*-------------------------------------------------------------------------*/
	/*	Page Header Subtitle Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['page_heading_subtitle_font_style']);
	
	( intval( substr($options['page_heading_subtitle_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['page_heading_subtitle_font_size'],0,-2)) +10 .'px' : $line_height = null ;  ?>
	
	<?php echo 'body #page-header-bg .span_6 span.subheader,  body .row .col.section-title > span, .nectar-box-roll .overlaid-content .subheader
	{'; ?>	
		<?php if($options['page_heading_subtitle_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['page_heading_subtitle_font'])) ? '"'. $options['page_heading_subtitle_font'] .'"' : $options['page_heading_subtitle_font'];
		}
			  if($options['page_heading_subtitle_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['page_heading_subtitle_font_transform'] != '-') echo 'text-transform: ' . $options['page_heading_subtitle_font_transform'] .';'; 
			  if($options['page_heading_subtitle_font_spacing'] != '-') echo 'letter-spacing: ' . $options['page_heading_subtitle_font_spacing'] .';'; 
			  if($options['page_heading_subtitle_font_size'] != '-') echo 'font-size:' . $options['page_heading_subtitle_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['page_heading_subtitle_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['page_heading_subtitle_font_line_height'] .';'; 
		 	$the_line_height = $options['page_heading_subtitle_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
              if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>
	
	@media only screen and (min-width: 1000px) and (max-width: 1300px) {
		body #page-header-bg:not(.fullscreen-header) .span_6 span.subheader,  body .row .col.section-title > span {
			font-size: <?php if(!empty($options['page_heading_subtitle_font_size']) && $options['page_heading_subtitle_font_size'] != '-') echo $options['page_heading_subtitle_font_size']*0.8 . 'px' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.8) . 'px' ?>;
		}
	}

	@media only screen and (min-width: 690px) and (max-width: 1000px) {
		body #page-header-bg.fullscreen-header .span_6 span.subheader, .overlaid-content .subheader {
			font-size: <?php if(!empty($options['page_heading_subtitle_font_size']) && $options['page_heading_subtitle_font_size'] != '-') echo $options['page_heading_subtitle_font_size']*0.9 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.9) . 'px!important' ?>;
		}
	}

	@media only screen and (max-width: 690px) {
		body #page-header-bg.fullscreen-header .span_6 span.subheader, .overlaid-content .subheader {
			font-size: <?php if(!empty($options['page_heading_subtitle_font_size']) && $options['page_heading_subtitle_font_size'] != '-') echo $options['page_heading_subtitle_font_size']*0.7 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.7) . 'px!important' ?>;
		}
	}



	<?php
	/*-------------------------------------------------------------------------*/
	/*	Off Canvas Navigation Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['off_canvas_nav_font_style']);
	
	( intval( substr($options['off_canvas_nav_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['off_canvas_nav_font_size'],0,-2)) +10 .'px' : $line_height = null ;  ?>
	
	<?php echo 'body #slide-out-widget-area .inner .off-canvas-menu-container li a, body #slide-out-widget-area.fullscreen .inner .off-canvas-menu-container li a,
	body #slide-out-widget-area.fullscreen-alt .inner .off-canvas-menu-container li a
	{'; ?>	
		<?php if($options['off_canvas_nav_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['off_canvas_nav_font'])) ? '"'. $options['off_canvas_nav_font'] .'"' : $options['off_canvas_nav_font'];
		}
			  if($options['off_canvas_nav_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['off_canvas_nav_font_transform'] != '-') echo 'text-transform: ' . $options['off_canvas_nav_font_transform'] .';'; 
			  if($options['off_canvas_nav_font_spacing'] != '-') echo 'letter-spacing: ' . $options['off_canvas_nav_font_spacing'] .';'; 
			  if($options['off_canvas_nav_font_size'] != '-') echo 'font-size:' . $options['off_canvas_nav_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['off_canvas_nav_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['off_canvas_nav_font_line_height'] .';'; 
		 	$the_line_height = $options['off_canvas_nav_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
              if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>


	@media only screen and (min-width: 690px) and (max-width: 1000px) {
		body #slide-out-widget-area.fullscreen .inner .off-canvas-menu-container li a,
		body #slide-out-widget-area.fullscreen-alt .inner .off-canvas-menu-container li a  {
			font-size: <?php if(!empty($options['off_canvas_nav_font_size']) && $options['off_canvas_nav_font_size'] != '-') echo $options['off_canvas_nav_font_size']*0.9 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.9) . 'px!important' ?>;
		}
	}

	@media only screen and (max-width: 690px) {
		body #slide-out-widget-area.fullscreen .inner .off-canvas-menu-container li a,
		body #slide-out-widget-area.fullscreen-alt .inner .off-canvas-menu-container li a {
			font-size: <?php if(!empty($options['off_canvas_nav_font_size']) && $options['off_canvas_nav_font_size'] != '-') echo $options['off_canvas_nav_font_size']*0.7 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.7) . 'px!important' ?>;
		}
	}



	<?php
	/*-------------------------------------------------------------------------*/
	/*	Off Canvas Navigation Font Subtext
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['off_canvas_nav_subtext_font_style']);
	
	( intval( substr($options['off_canvas_nav_subtext_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['off_canvas_nav_subtext_font_size'],0,-2)) +10 .'px' : $line_height = null ;  ?>
	
	<?php echo '#slide-out-widget-area .menuwrapper li small
	{'; ?>	
		<?php if($options['off_canvas_nav_subtext_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['off_canvas_nav_subtext_font'])) ? '"'. $options['off_canvas_nav_subtext_font'] .'"' : $options['off_canvas_nav_subtext_font'];
		}
			  if($options['off_canvas_nav_subtext_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['off_canvas_nav_subtext_font_transform'] != '-') echo 'text-transform: ' . $options['off_canvas_nav_subtext_font_transform'] .';'; 
			  if($options['off_canvas_nav_subtext_font_spacing'] != '-') echo 'letter-spacing: ' . $options['off_canvas_nav_subtext_font_spacing'] .';'; 
			  if($options['off_canvas_nav_subtext_font_size'] != '-') echo 'font-size:' . $options['off_canvas_nav_subtext_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['off_canvas_nav_subtext_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['off_canvas_nav_subtext_font_line_height'] .';'; 
		 	$the_line_height = $options['off_canvas_nav_subtext_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
              if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>


	@media only screen and (min-width: 690px) and (max-width: 1000px) {
		#slide-out-widget-area .menuwrapper li small {
			font-size: <?php if(!empty($options['off_canvas_nav_subtext_font_size']) && $options['off_canvas_nav_subtext_font_size'] != '-') echo $options['off_canvas_nav_subtext_font_size']*0.9 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.9) . 'px!important' ?>;
		}
	}

	@media only screen and (max-width: 690px) {
		#slide-out-widget-area .menuwrapper li small {
			font-size: <?php if(!empty($options['off_canvas_nav_subtext_font_size']) && $options['off_canvas_nav_subtext_font_size'] != '-') echo $options['off_canvas_nav_subtext_font_size']*0.7 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.7) . 'px!important' ?>;
		}
	}

	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Nectar Slider Heading Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['nectar_slider_heading_font_style']);
	( intval( substr($options['nectar_slider_heading_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['nectar_slider_heading_font_size'],0,-2)) + 19 .'px!important' : $line_height = null ;  ?>
	
	<?php echo '.swiper-slide .content h2
	{'; ?>
		<?php if($options['nectar_slider_heading_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['nectar_slider_heading_font'])) ? '"'. $options['nectar_slider_heading_font'] .'"' : $options['nectar_slider_heading_font'];	
	     }  
			  if($options['nectar_slider_heading_font'] != '-') echo 'font-family: ' . $font_family .';';
			  if($options['nectar_slider_heading_font_transform'] != '-') echo 'text-transform: ' . $options['nectar_slider_heading_font_transform'] .';';  
			  if($options['nectar_slider_heading_font_spacing'] != '-') echo 'letter-spacing: ' . $options['nectar_slider_heading_font_spacing'] .';'; 
			  if($options['nectar_slider_heading_font_size'] != '-') echo 'font-size:' . $options['nectar_slider_heading_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['nectar_slider_heading_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['nectar_slider_heading_font_line_height'] .';'; 
		 	$the_line_height = $options['nectar_slider_heading_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>

		<?php 

             if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		     if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>

	@media only screen and (min-width: 1000px) and (max-width: 1300px) {
		body .nectar-slider-wrap[data-full-width="true"] .swiper-slide .content h2, 
		body .nectar-slider-wrap[data-full-width="boxed-full-width"] .swiper-slide .content h2, 
		body .full-width-content .vc_span12 .swiper-slide .content h2 {
			font-size: <?php if(!empty($options['nectar_slider_heading_font_size']) && $options['nectar_slider_heading_font_size'] != '-') echo $options['nectar_slider_heading_font_size']*0.8 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.8) . 'px!important' ?>;
		}
	}

	@media only screen and (min-width: 690px) and (max-width: 1000px) {
		body .nectar-slider-wrap[data-full-width="true"] .swiper-slide .content h2, 
		body .nectar-slider-wrap[data-full-width="boxed-full-width"] .swiper-slide .content h2, 
		body .full-width-content .vc_span12 .swiper-slide .content h2 {
			font-size: <?php if(!empty($options['nectar_slider_heading_font_size']) && $options['nectar_slider_heading_font_size'] != '-') echo $options['nectar_slider_heading_font_size']*0.6 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.6) . 'px!important' ?>;
		}
	}

	@media only screen and (max-width: 690px) {
		body .nectar-slider-wrap[data-full-width="true"] .swiper-slide .content h2, 
		body .nectar-slider-wrap[data-full-width="boxed-full-width"] .swiper-slide .content h2, 
		body .full-width-content .vc_span12 .swiper-slide .content h2 {
			font-size: <?php if(!empty($options['nectar_slider_heading_font_size']) && $options['nectar_slider_heading_font_size'] != '-') echo $options['nectar_slider_heading_font_size']*0.5 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.5) . 'px!important' ?>;
		}
	}
	
	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Nectar/Home Slider Caption 
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['home_slider_caption_font_style']);
	( intval( substr($options['home_slider_caption_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['home_slider_caption_font_size'],0,-2)) + 19 .'px!important' : $line_height = null ;  ?>
	
	<?php echo '#featured article .post-title h2 span, .swiper-slide .content p, #portfolio-filters-inline #current-category, body .vc_text_separator div
	{'; ?>	
		<?php if($options['home_slider_caption_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['home_slider_caption_font'])) ? '"'. $options['home_slider_caption_font'] .'"' : $options['home_slider_caption_font'];	
		}  
			  if($options['home_slider_caption_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['home_slider_caption_font_transform'] != '-') echo 'text-transform: ' . $options['home_slider_caption_font_transform'] .';';  
			  if($options['home_slider_caption_font_spacing'] != '-') echo 'letter-spacing: ' . $options['home_slider_caption_font_spacing'] .';';  
		      if($options['home_slider_caption_font_size'] != '-') echo 'font-size:' . $options['home_slider_caption_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['home_slider_caption_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['home_slider_caption_font_line_height'] .';'; 
		 	$the_line_height = $options['home_slider_caption_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
              if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>
	
	
	<?php 
		  echo '#portfolio-filters-inline ul { line-height: '.$line_height.'; }';
		  echo '.swiper-slide .content p.transparent-bg span { '; $nectar_slider_line_height_2 = intval(substr($options["home_slider_caption_font_size"],0,-2)) + 25; ?>
	     <?php if(!empty($line_height)) echo 'line-height:' . $nectar_slider_line_height_2 .'px;'; ?>
	<?php echo '}'; ?>

	@media only screen and (min-width: 1000px) and (max-width: 1300px) {
		.nectar-slider-wrap[data-full-width="true"] .swiper-slide .content p, 
		.nectar-slider-wrap[data-full-width="boxed-full-width"] .swiper-slide .content p, 
		.full-width-content .vc_span12 .swiper-slide .content p {
			font-size: <?php if(!empty($options['home_slider_caption_font_size']) && $options['home_slider_caption_font_size'] != '-') echo $options['home_slider_caption_font_size']*0.8 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.8) . 'px!important' ?>;
		}
	}

	@media only screen and (min-width: 690px) and (max-width: 1000px) {
		.nectar-slider-wrap[data-full-width="true"] .swiper-slide .content p, 
		.nectar-slider-wrap[data-full-width="boxed-full-width"] .swiper-slide .content p, 
		.full-width-content .vc_span12 .swiper-slide .content p {
			font-size: <?php if(!empty($options['home_slider_caption_font_size']) && $options['home_slider_caption_font_size'] != '-') echo $options['home_slider_caption_font_size']*0.7 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.7) . 'px!important' ?>;
		}
	}

	@media only screen and (max-width: 690px) {
		body .nectar-slider-wrap[data-full-width="true"] .swiper-slide .content p, 
		body .nectar-slider-wrap[data-full-width="boxed-full-width"] .swiper-slide .content p, 
		body .full-width-content .vc_span12 .swiper-slide .content p {
			font-size: <?php if(!empty($options['home_slider_caption_font_size']) && $options['home_slider_caption_font_size'] != '-') echo $options['home_slider_caption_font_size']*0.7 . 'px!important' ?>;
			line-height: <?php if($the_line_height) echo ($the_line_height*0.7) . 'px!important' ?>;
		}
	}



	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Testimonial Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['testimonial_font_style']);
	( intval( substr($options['testimonial_font_size'],0,-2) ) > 8 ) ? $line_height =  intval(substr($options['testimonial_font_size'],0,-2)) + 19 .'px!important' : $line_height = null ;  ?>
	
	<?php echo '.testimonial_slider blockquote, .testimonial_slider blockquote span, blockquote
	{'; ?>	
		<?php if($options['testimonial_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['testimonial_font'])) ? '"'. $options['testimonial_font'] .'"' : $options['testimonial_font'];	
		}  
			  if($options['testimonial_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['testimonial_font_transform'] != '-') echo 'text-transform: ' . $options['testimonial_font_transform'] .';';  
			  if($options['testimonial_font_spacing'] != '-') echo 'letter-spacing: ' . $options['testimonial_font_spacing'] .';';  
		      if($options['testimonial_font_size'] != '-') echo 'font-size:' . $options['testimonial_font_size'] .';'; ?>
	
		<?php 
		//user set line-height
		 if($options['testimonial_font_line_height'] != '-') { 
		 	echo 'line-height:' . $options['testimonial_font_line_height'] .';'; 
		 	$the_line_height = $options['testimonial_font_line_height'];
		 } else if(!empty($line_height)) {
		//auto line-height
			echo 'line-height:' . $line_height .';';
			$the_line_height = $line_height;
		} else {
			$the_line_height = null;
		}
		?>
		<?php 
              if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		      if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  }
		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>
	
	
	

	
	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Sidear, Carousel & Nectar Button Header Font
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['sidebar_footer_h_font_style']);
	$line_height =  substr($options['sidebar_footer_h_font_size'],0,-2); ?>
	
	<?php echo '#footer-outer .widget h4, #sidebar h4, #call-to-action .container a, .uppercase, .nectar-button, .nectar-button.medium, .nectar-button.small, .nectar-3d-transparent-button, body .widget_calendar table th, body #footer-outer #footer-widgets .col .widget_calendar table th, .swiper-slide .button a,
	header#top nav > ul > li.megamenu > ul > li > a, .carousel-heading h2, body .gform_wrapper .top_label .gfield_label, body .vc_pie_chart .wpb_pie_chart_heading, #infscr-loading div, #page-header-bg .author-section a, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .ascend input[type="submit"], .ascend button[type="submit"],
	.widget h4, .text-on-hover-wrap .categories a, .text_on_hover.product .add_to_cart_button, .woocommerce-page div[data-project-style="text_on_hover"] .single_add_to_cart_button, .woocommerce div[data-project-style="text_on_hover"]  .cart .quantity input.qty, .woocommerce-page #respond input#submit,
	.meta_overlaid article.post .post-header h2, .meta_overlaid article.post.quote .post-content h2, .meta_overlaid article.post.link .post-content h2, .meta_overlaid article.post.format-status .post-content h2, .meta_overlaid article .meta-author a, .pricing-column.highlight h3 .highlight-reason,
	.blog-recent[data-style="minimal"] .col > span, .masonry.classic_enhanced .posts-container article .meta-category a, .nectar-recent-posts-slider .container .strong, #page-header-bg[data-post-hs="default_minimal"] .inner-wrap > a, .single .heading-title[data-header-style="default_minimal"] .meta-category a, .nectar-fancy-box .link-text
	{'; ?>	
		<?php if($options['sidebar_footer_h_font'] != '-') {
			   $font_family = (1 === preg_match('~[0-9]~', $options['sidebar_footer_h_font'])) ? '"'. $options['sidebar_footer_h_font'] .'"' : $options['sidebar_footer_h_font'];
		}
			  if($options['sidebar_footer_h_font'] != '-') echo 'font-family: ' . $font_family .';';
			  if($options['sidebar_footer_h_font_transform'] != '-') echo 'text-transform: ' . $options['sidebar_footer_h_font_transform'] .'!important;';  
			  if($options['sidebar_footer_h_font_spacing'] != '-') echo 'letter-spacing: ' . $options['sidebar_footer_h_font_spacing'] .';';  
		      if($options['sidebar_footer_h_font_size'] != '-') echo 'font-size:' . $options['sidebar_footer_h_font_size'] .';'; ?>
				
		<?php 

            if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		    if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  } 
			
			else {
			  	echo 'font-weight: normal;';
			}  ?>

		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
	<?php echo '}'; ?>
	
	

	
	<?php 
	/*-------------------------------------------------------------------------*/
	/*	Team member names & heading subtitles
	/*-------------------------------------------------------------------------*/
	$styles = explode('-', $options['team_member_h_font_style']);
	$line_height =  substr($options['team_member_h_font_size'],0,-2); ?>
	
	<?php echo '.team-member h4, .row .col.section-title p, .row .col.section-title span, #page-header-bg .subheader, .nectar-milestone .subject, .testimonial_slider blockquote span 
	{'; ?>	
	<?php if($options['team_member_h_font'] != '-') {
			  $font_family = (1 === preg_match('~[0-9]~', $options['team_member_h_font'])) ? '"'. $options['team_member_h_font'] .'"' : $options['team_member_h_font'];
	}  		
			  if($options['team_member_h_font'] != '-') echo 'font-family: ' . $font_family .';'; 
			  if($options['team_member_h_font_transform'] != '-') echo 'text-transform: ' . $options['team_member_h_font_transform'] .';';  
			  if($options['team_member_h_font_spacing'] != '-') echo 'letter-spacing: ' . $options['team_member_h_font_spacing'] .';';  
		      if($options['team_member_h_font_size'] != '-') echo 'font-size:' . $options['team_member_h_font_size'] .';'; ?>
			
		<?php 
             if(!empty($styles[0]) && $styles[0] == 'regular') $styles[0] = '400';
		     if(!empty($styles[0]) && strpos($styles[0],'italic') === false) { echo 'font-weight:' .  $styles[0] .';'; }
			  else if(!empty($styles[0]) && strpos($styles[0],'0italic') == true) {
			  	  $the_weight = explode("i",$styles[0]);
			  	  echo 'font-weight:' .  $the_weight[0] .';'; 
			  	  echo 'font-style: italic';
			  }
			  else if(!empty($styles[0])) {
			  	  if(strpos($styles[0],'italic') !== false) {
			  	    echo 'font-weight: 400;'; 
			  	    echo 'font-style: italic';
			  	 }
			  } 

		?>
		<?php if(!empty($styles[1])) echo 'font-style:' . $styles[1]; ?>
			
	<?php echo '}'; ?>
	
	
	<?php echo 'article.post .post-meta .month { line-height:'. ($line_height + -6) . 'px!important; }'; 
	

	if($external_dynamic != 'on') {

		echo '</style>';
		
		
		$dynamic_css = ob_get_contents();
		ob_end_clean();
		
		echo nectar_quick_minify($dynamic_css);	

	}
	


?>