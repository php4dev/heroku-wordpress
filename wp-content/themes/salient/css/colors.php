<?php 

$options = get_nectar_theme_options(); 
$external_dynamic = (!empty($options['external-dynamic-css']) && $options['external-dynamic-css'] == 1) ? 'on' : 'off';

	$options = get_nectar_theme_options(); 

	if($external_dynamic != 'on') { ob_start(); }
	
	$social_accent_color = (!empty($options["sharing_btn_accent_color"]) && $options["sharing_btn_accent_color"] == '1') ? 'body .twitter-share:hover i, .twitter-share.hovered i, body .linkedin-share:hover i, .linkedin-share.hovered i, body .google-plus-share:hover i, .google-plus-share.hovered i, .pinterest-share:hover i, .pinterest-share.hovered i, .facebook-share:hover i, .facebook-share.hovered i,' : null;
	$social_accent_color_rounded = (!empty($options["sharing_btn_accent_color"]) && $options["sharing_btn_accent_color"] == '1') ? 'body[data-button-style="rounded"] .wpb_wrapper .twitter-share:before, body[data-button-style="rounded"] .wpb_wrapper .twitter-share.hovered:before, body[data-button-style="rounded"] .wpb_wrapper .facebook-share:before, body[data-button-style="rounded"] .wpb_wrapper .facebook-share.hovered:before, body[data-button-style="rounded"] .wpb_wrapper .google-plus-share:before, body[data-button-style="rounded"] .wpb_wrapper .google-plus-share.hovered:before, body[data-button-style="rounded"] .wpb_wrapper .nectar-social:hover > *:before, body[data-button-style="rounded"] .wpb_wrapper .pinterest-share:before, body[data-button-style="rounded"] .wpb_wrapper .pinterest-share.hovered:before, body[data-button-style="rounded"] .wpb_wrapper .linkedin-share:before, body[data-button-style="rounded"] .wpb_wrapper .linkedin-share.hovered:before, ' : null;
	global $woocommerce; 
	if ($woocommerce) {
		$woocommerce_main = ', .woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce .product-wrap .add_to_cart_button.added, .single-product .facebook-share a:hover, .single-product .twitter-share a:hover, .single-product .pinterest-share a:hover, .woocommerce-message, .woocommerce-error, .woocommerce-info, .woocommerce-page table.cart a.remove:hover, .woocommerce .chzn-container .chzn-results .highlighted, .woocommerce .chosen-container .chosen-results .highlighted, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce .container-wrap nav.woocommerce-pagination ul li:hover span, .woocommerce a.button:hover, .woocommerce-page a.button:hover, .woocommerce button.button:hover, .woocommerce-page button.button:hover, .woocommerce input.button:hover, .woocommerce-page input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_layered_nav_filters ul li a:hover, .woocommerce-page .widget_layered_nav_filters ul li a:hover ';
	} else {
		$woocommerce_main = null;
	}
	
	if($external_dynamic != 'on') { echo '<style type="text/css">'; }
	
	echo 'body a { color: '.$options["accent-color"].'; }
	
	#header-outer:not([data-lhe="animated_underline"]) header#top nav > ul > li > a:hover, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.sfHover > a, header#top nav > ul > li.button_bordered > a:hover, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu li.current-menu-item > a,
	header#top nav .sf-menu li.current_page_item > a .sf-sub-indicator i, header#top nav .sf-menu li.current_page_ancestor > a .sf-sub-indicator i,
	#header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu li.current_page_ancestor > a, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu li.current-menu-ancestor > a, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu li.current_page_item > a,
	body header#top nav .sf-menu li.current_page_item > a .sf-sub-indicator [class^="icon-"], header#top nav .sf-menu li.current_page_ancestor > a .sf-sub-indicator [class^="icon-"],
    .sf-menu li ul li.sfHover > a .sf-sub-indicator [class^="icon-"], #header-outer:not(.transparent) #social-in-menu a i:after,
	ul.sf-menu > li > a:hover > .sf-sub-indicator i, ul.sf-menu > li > a:active > .sf-sub-indicator i, ul.sf-menu > li.sfHover > a > .sf-sub-indicator i,
	.sf-menu ul li.current_page_item > a , .sf-menu ul li.current-menu-ancestor > a, .sf-menu ul li.current_page_ancestor > a, .sf-menu ul a:focus ,
	.sf-menu ul a:hover, .sf-menu ul a:active, .sf-menu ul li:hover > a, .sf-menu ul li.sfHover > a, .sf-menu li ul li a:hover, .sf-menu li ul li.sfHover > a,
	#footer-outer a:hover, .recent-posts .post-header a:hover, article.post .post-header a:hover, article.result a:hover,  article.post .post-header h2 a, .single article.post .post-meta a:hover,
	.comment-list .comment-meta a:hover, label span, .wpcf7-form p span, .icon-3x[class^="icon-"], .icon-3x[class*=" icon-"], .icon-tiny[class^="icon-"], body .circle-border, article.result .title a, .home .blog-recent .col .post-header a:hover,
	.home .blog-recent .col .post-header h3 a, #single-below-header a:hover, header#top #logo:hover, .sf-menu > li.current_page_ancestor > a > .sf-sub-indicator [class^="icon-"], .sf-menu > li.current-menu-ancestor > a > .sf-sub-indicator [class^="icon-"],
	body #mobile-menu li.open > a [class^="icon-"], .pricing-column h3, .pricing-table[data-style="flat-alternative"] .pricing-column.accent-color h4, .pricing-table[data-style="flat-alternative"] .pricing-column.accent-color .interval,
	.comment-author a:hover, .project-attrs li i, #footer-outer #copyright li a i:hover, .col:hover > [class^="icon-"].icon-3x.accent-color.alt-style.hovered, .col:hover > [class*=" icon-"].icon-3x.accent-color.alt-style.hovered,
	#header-outer .widget_shopping_cart .cart_list a, .woocommerce .star-rating, .woocommerce-page table.cart a.remove, .woocommerce form .form-row .required, .woocommerce-page form .form-row .required, body #header-secondary-outer #social a:hover i,
	.woocommerce ul.products li.product .price, '.$social_accent_color.' .woocommerce-page ul.products li.product .price, .nectar-milestone .number.accent-color, header#top nav > ul > li.megamenu > ul > li > a:hover, header#top nav > ul > li.megamenu > ul > li.sfHover > a, body #portfolio-nav a:hover i,
	span.accent-color, .nectar-love:hover i, .nectar-love.loved i, .portfolio-items .nectar-love:hover i, .portfolio-items .nectar-love.loved i, body .hovered .nectar-love i, header#top nav ul #search-btn a:hover span, header#top nav ul .slide-out-widget-area-toggle a:hover span, #search-outer #search #close a span:hover, 
	.carousel-wrap[data-full-width="true"] .carousel-heading a:hover i, #search-outer .ui-widget-content li:hover a .title,  #search-outer .ui-widget-content .ui-state-hover .title,  #search-outer .ui-widget-content .ui-state-focus .title, .portfolio-filters-inline .container ul li a.active,
	body [class^="icon-"].icon-default-style, .svg-icon-holder[data-color="accent-color"], .team-member a.accent-color:hover, .ascend .comment-list .reply a, .wpcf7-form .wpcf7-not-valid-tip, .text_on_hover.product .add_to_cart_button, .blog-recent[data-style="minimal"] .col > span, .blog-recent[data-style="title_only"] .col:hover .post-header .title, .woocommerce-checkout-review-order-table .product-info .amount,
	.tabbed[data-style="minimal"] > ul li a.active-tab, .masonry.classic_enhanced  article.post .post-meta a:hover i,  .masonry.classic_enhanced article.post .post-meta .icon-salient-heart-2.loved, .single #single-meta ul li:not(.meta-share-count):hover i, .single #single-meta ul li:not(.meta-share-count):hover a, .single #single-meta ul li:not(.meta-share-count):hover span, .single #single-meta ul li.meta-share-count .nectar-social a:hover i, #project-meta  #single-meta ul li > a, #project-meta ul li.meta-share-count .nectar-social a:hover i,  #project-meta ul li:not(.meta-share-count):hover i, #project-meta ul li:not(.meta-share-count):hover span,
	div[data-style="minimal"] .toggle:hover h3 a, div[data-style="minimal"] .toggle.open h3 a, .nectar-icon-list[data-icon-style="border"][data-icon-color="accent-color"] .list-icon-holder[data-icon_type="numerical"] span, .nectar-icon-list[data-icon-color="accent-color"][data-icon-style="border"] .content h4
	{	
		color:'. $options["accent-color"].'!important;
	}
	
	.col:not(#post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.accent-color.alt-style.hovered, body .col:not(#post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.accent-color.alt-style.hovered,
	.ascend #header-outer:not(.transparent) .cart-outer:hover .cart-menu-wrap:not(.has_products) .icon-salient-cart {
		color:'. $options["accent-color"].'!important;
	}
	
	
	.orbit-wrapper div.slider-nav span.right, .orbit-wrapper div.slider-nav span.left, .flex-direction-nav a, .jp-play-bar,
	.jp-volume-bar-value, .jcarousel-prev:hover, .jcarousel-next:hover, .portfolio-items .col[data-default-color="true"] .work-item:not(.style-3) .work-info-bg, .portfolio-items .col[data-default-color="true"] .bottom-meta, 
	.portfolio-filters a, .portfolio-filters #sort-portfolio, .project-attrs li span, .progress li span, .nectar-progress-bar span,
	#footer-outer #footer-widgets .col .tagcloud a:hover, #sidebar .widget .tagcloud a:hover, article.post .more-link span:hover, #fp-nav.tooltip ul li .fp-tooltip .tooltip-inner,
	article.post.quote .post-content .quote-inner, article.post.link .post-content .link-inner, #pagination .next a:hover, #pagination .prev a:hover, 
	.comment-list .reply a:hover, input[type=submit]:hover, input[type="button"]:hover, #footer-outer #copyright li a.vimeo:hover, #footer-outer #copyright li a.behance:hover,
	.toggle.open h3 a, .tabbed > ul li a.active-tab, [class*=" icon-"], .icon-normal, .bar_graph li span, .nectar-button[data-color-override="false"].regular-button, .nectar-button.tilt.accent-color, body .swiper-slide .button.transparent_2 a.primary-color:hover, #footer-outer #footer-widgets .col input[type="submit"],
	.carousel-prev:hover, .carousel-next:hover, body .products-carousel .carousel-next:hover, body .products-carousel .carousel-prev:hover, .blog-recent .more-link span:hover, .post-tags a:hover, .pricing-column.highlight h3, .pricing-table[data-style="flat-alternative"] .pricing-column.highlight h3 .highlight-reason, .pricing-table[data-style="flat-alternative"] .pricing-column.accent-color:before, #to-top:hover, #to-top.dark:hover, body[data-button-style="rounded"] #to-top:after, #pagination a.page-numbers:hover,
	#pagination span.page-numbers.current, .single-portfolio .facebook-share a:hover, .single-portfolio .twitter-share a:hover, .single-portfolio .pinterest-share a:hover,  
	.single-post .facebook-share a:hover, .single-post .twitter-share a:hover, .single-post .pinterest-share a:hover, .mejs-controls .mejs-time-rail .mejs-time-current,
	.mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current, .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
	article.post.quote .post-content .quote-inner, article.post.link .post-content .link-inner, article.format-status .post-content .status-inner, article.post.format-aside .aside-inner, 
	body #header-secondary-outer #social li a.behance:hover, body #header-secondary-outer #social li a.vimeo:hover, #sidebar .widget:hover [class^="icon-"].icon-3x, .woocommerce-page div[data-project-style="text_on_hover"] .single_add_to_cart_button,
	article.post.quote .content-inner .quote-inner .whole-link, .masonry.classic_enhanced article.post.quote.wide_tall .post-content a:hover .quote-inner, .masonry.classic_enhanced article.post.link.wide_tall .post-content a:hover .link-inner, .iosSlider .prev_slide:hover, .iosSlider .next_slide:hover, body [class^="icon-"].icon-3x.alt-style.accent-color, body [class*=" icon-"].icon-3x.alt-style.accent-color, #slide-out-widget-area, #slide-out-widget-area-bg.fullscreen, #slide-out-widget-area-bg.fullscreen-alt .bg-inner,
	#header-outer .widget_shopping_cart a.button, '.$social_accent_color_rounded.' #header-outer a.cart-contents .cart-wrap span, .swiper-slide .button.solid_color a, .swiper-slide .button.solid_color_2 a, .portfolio-filters, button[type=submit]:hover, #buddypress button:hover, #buddypress a.button:hover, #buddypress ul.button-nav li.current a, 
	header#top nav ul .slide-out-widget-area-toggle a:hover i.lines, header#top nav ul .slide-out-widget-area-toggle a:hover i.lines:after, header#top nav ul .slide-out-widget-area-toggle a:hover i.lines:before, header#top nav ul .slide-out-widget-area-toggle[data-icon-animation="simple-transform"] a:hover i.lines-button:after,  #buddypress a.button:focus, .text_on_hover.product a.added_to_cart, .woocommerce div.product .woocommerce-tabs .full-width-content ul.tabs li a:after, 
    .woocommerce div[data-project-style="text_on_hover"]  .cart .quantity input.minus, .woocommerce div[data-project-style="text_on_hover"]  .cart .quantity input.plus, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce .span_4 input[type="submit"].checkout-button,
    .portfolio-filters-inline[data-color-scheme="accent-color"], body[data-fancy-form-rcs="1"] [type="radio"]:checked + label:after, .select2-container .select2-choice:hover, .select2-dropdown-open .select2-choice,
    header#top nav > ul > li.button_solid_color > a:before, #header-outer.transparent header#top nav > ul > li.button_solid_color > a:before, .tabbed[data-style="minimal"] > ul li a:after, .twentytwenty-handle, .twentytwenty-horizontal .twentytwenty-handle:before, .twentytwenty-horizontal .twentytwenty-handle:after, .twentytwenty-vertical .twentytwenty-handle:before, .twentytwenty-vertical .twentytwenty-handle:after, .masonry.classic_enhanced .posts-container article .meta-category a:hover, .masonry.classic_enhanced .posts-container article .video-play-button, .bottom_controls #portfolio-nav .controls li a i:after, .bottom_controls #portfolio-nav ul:first-child li#all-items a:hover i, .nectar_video_lightbox.nectar-button[data-color="default-accent-color"],  .nectar_video_lightbox.nectar-button[data-color="transparent-accent-color"]:hover,
    .testimonial_slider[data-style="multiple_visible"][data-color*="accent-color"] .flickity-page-dots .dot.is-selected:before, .testimonial_slider[data-style="multiple_visible"][data-color*="accent-color"] blockquote.is-selected p, .nectar-recent-posts-slider .container .strong span:before, #page-header-bg[data-post-hs="default_minimal"] .inner-wrap > a:hover,
    .single .heading-title[data-header-style="default_minimal"] .meta-category a:hover, body.single-post .sharing-default-minimal .nectar-love.loved, .nectar-fancy-box:after, .divider-small-border[data-color="accent-color"], .divider-border[data-color="accent-color"], div[data-style="minimal"] .toggle.open i:after, div[data-style="minimal"] .toggle:hover i:after, div[data-style="minimal"] .toggle.open i:before, div[data-style="minimal"] .toggle:hover i:before,
    .nectar-animated-title[data-color="accent-color"] .nectar-animated-title-inner:after, #fp-nav:not(.light-controls).tooltip_alt ul li a span:after, #fp-nav.tooltip_alt ul li a span:after, .nectar-video-box[data-color="default-accent-color"] a.nectar_video_lightbox, .span_12.dark .owl-theme .owl-dots .owl-dot.active span, .span_12.dark .owl-theme .owl-dots .owl-dot:hover span, .nectar_image_with_hotspots[data-stlye="color_pulse"][data-color="accent-color"] .nectar_hotspot, .nectar_image_with_hotspots .nectar_hotspot_wrap .nttip .tipclose span:before, .nectar_image_with_hotspots .nectar_hotspot_wrap .nttip .tipclose span:after '.$woocommerce_main.'
	{
		background-color:'.$options["accent-color"].'!important;
	}
	
	.col:hover > [class^="icon-"].icon-3x:not(.alt-style).accent-color.hovered, .col:hover > [class*=" icon-"].icon-3x:not(.alt-style).accent-color.hovered, body .nectar-button.see-through-2[data-hover-color-override="false"]:hover,
	.col:not(#post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x:not(.alt-style).accent-color.hovered, .col:not(#post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x:not(.alt-style).accent-color.hovered {
		background-color:'.$options["accent-color"].'!important;
	}
	

	.bottom_controls #portfolio-nav ul:first-child  li#all-items a:hover i { box-shadow: -.6em 0 '.$options["accent-color"].', -.6em .6em '.$options["accent-color"].', .6em 0 '.$options["accent-color"].', .6em -.6em '.$options["accent-color"].', 0 -.6em '.$options["accent-color"].', -.6em -.6em '.$options["accent-color"].', 0 .6em '.$options["accent-color"].', .6em .6em '.$options["accent-color"].';  }
	
	.tabbed > ul li a.active-tab, body[data-form-style="minimal"] label:after, body .recent_projects_widget a:hover img, .recent_projects_widget a:hover img, #sidebar #flickr a:hover img, body .nectar-button.see-through-2[data-hover-color-override="false"]:hover,
	#footer-outer #flickr a:hover img, '.$social_accent_color_rounded.' #featured article .post-title a:hover, #header-outer[data-lhe="animated_underline"] header#top nav > ul > li > a:after, body #featured article .post-title a:hover, div.wpcf7-validation-errors, body[data-fancy-form-rcs="1"] [type="radio"]:checked + label:before, body[data-fancy-form-rcs="1"] [type="radio"]:checked + label:after, body[data-fancy-form-rcs="1"] input[type="checkbox"]:checked + label > span, .select2-container .select2-choice:hover, .select2-dropdown-open .select2-choice,
	#header-outer:not(.transparent) header#top nav > ul > li.button_bordered > a:hover:before, .single #single-meta ul li:not(.meta-share-count):hover a, .single #project-meta ul li:not(.meta-share-count):hover a, div[data-style="minimal"] .toggle.default.open i, div[data-style="minimal"] .toggle.default:hover i, div[data-style="minimal"] .toggle.accent-color.open i, div[data-style="minimal"] .toggle.accent-color:hover i,
	.nectar_image_with_hotspots .nectar_hotspot_wrap .nttip .tipclose {
		border-color:'.$options["accent-color"].'!important;
	}

	#fp-nav:not(.light-controls).tooltip_alt ul li a.active span, #fp-nav.tooltip_alt ul li a.active span { box-shadow: inset 0 0 0 2px '.$options["accent-color"].'; -webkit-box-shadow: inset 0 0 0 2px '.$options["accent-color"].'; }

	.default-loading-icon:before { border-top-color:'.$options["accent-color"].'!important; }

	#header-outer a.cart-contents span:before, #fp-nav.tooltip ul li .fp-tooltip .tooltip-inner:after { border-color: transparent '.$options["accent-color"].'!important; }
	
	body .col:not(#post-area):not(.span_12):not(#sidebar):hover .hovered .circle-border, body #sidebar .widget:hover .circle-border, body .testimonial_slider[data-style="multiple_visible"][data-color*="accent-color"] blockquote .bottom-arrow:after, body .dark .testimonial_slider[data-style="multiple_visible"][data-color*="accent-color"] blockquote .bottom-arrow:after, .portfolio-items[data-ps="6"] .bg-overlay, .portfolio-items[data-ps="6"].no-masonry .bg-overlay { border-color:'.$options["accent-color"].'; }

	.gallery a:hover img { border-color:'.$options["accent-color"].'!important; }';
	
	
	if(!empty($options['responsive']) && $options['responsive'] == 1) { 
		
		echo '@media only screen 
		and (min-width : 1px) and (max-width : 1000px) {
			
			body #featured article .post-title > a { background-color:'. $options["accent-color"].'; }
			
			body #featured article .post-title > a { border-color:'. $options["accent-color"].'; }
		}';
	
	} 
	
	
	if(!empty($options["extra-color-1"])) { 
		/*Extra Color 1*/
		echo '
		
		.nectar-button.regular-button.extra-color-1, .nectar-button.tilt.extra-color-1 { background-color: '.$options["extra-color-1"].'!important; }
		
		.icon-3x[class^="icon-"].extra-color-1:not(.alt-style), .icon-tiny[class^="icon-"].extra-color-1, .icon-3x[class*=" icon-"].extra-color-1:not(.alt-style) , body .icon-3x[class*=" icon-"].extra-color-1:not(.alt-style)  .circle-border, .woocommerce-page table.cart a.remove, #header-outer .widget_shopping_cart .cart_list li a.remove,  #header-outer .woocommerce.widget_shopping_cart .cart_list li a.remove, .nectar-milestone .number.extra-color-1, span.extra-color-1,
		.team-member ul.social.extra-color-1 li a, .stock.out-of-stock, body [class^="icon-"].icon-default-style.extra-color-1, body [class^="icon-"].icon-default-style[data-color="extra-color-1"], .team-member a.extra-color-1:hover, 
		.pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-1 h3, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-1 h4, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-1 .interval,
		.svg-icon-holder[data-color="extra-color-1"], div[data-style="minimal"] .toggle.extra-color-1:hover h3 a, div[data-style="minimal"] .toggle.extra-color-1.open h3 a, .nectar-icon-list[data-icon-style="border"][data-icon-color="extra-color-1"] .list-icon-holder[data-icon_type="numerical"] span, .nectar-icon-list[data-icon-color="extra-color-1"][data-icon-style="border"] .content h4 {
			color: '.$options["extra-color-1"].'!important;
		}
		
		.col:hover > [class^="icon-"].icon-3x.extra-color-1:not(.alt-style), .col:hover > [class*=" icon-"].icon-3x.extra-color-1:not(.alt-style).hovered, body .swiper-slide .button.transparent_2 a.extra-color-1:hover,
		body .col:not(#post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-1:not(.alt-style).hovered, body .col:not(#post-area):not(#sidebar):not(.span_12):hover a [class*=" icon-"].icon-3x.extra-color-1:not(.alt-style).hovered, #sidebar .widget:hover [class^="icon-"].icon-3x.extra-color-1:not(.alt-style),
		.portfolio-filters-inline[data-color-scheme="extra-color-1"], .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-1:before, .pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-1 h3 .highlight-reason, .nectar-button.nectar_video_lightbox[data-color="default-extra-color-1"],  .nectar_video_lightbox.nectar-button[data-color="transparent-extra-color-1"]:hover,
		.testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-1"] .flickity-page-dots .dot.is-selected:before, .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-1"] blockquote.is-selected p, .nectar-fancy-box[data-color="extra-color-1"]:after, .divider-small-border[data-color="extra-color-1"], .divider-border[data-color="extra-color-1"], div[data-style="minimal"] .toggle.extra-color-1.open i:after, div[data-style="minimal"] .toggle.extra-color-1:hover i:after, div[data-style="minimal"] .toggle.open.extra-color-1 i:before, div[data-style="minimal"] .toggle.extra-color-1:hover i:before,
		.nectar-animated-title[data-color="extra-color-1"] .nectar-animated-title-inner:after, .nectar-video-box[data-color="extra-color-1"] a.nectar_video_lightbox, .nectar_image_with_hotspots[data-stlye="color_pulse"][data-color="extra-color-1"] .nectar_hotspot
		{
			background-color: '.$options["extra-color-1"].'!important;
		}
		
		body [class^="icon-"].icon-3x.alt-style.extra-color-1, body [class*=" icon-"].icon-3x.alt-style.extra-color-1, [class*=" icon-"].extra-color-1.icon-normal, .extra-color-1.icon-normal, .bar_graph li span.extra-color-1, .nectar-progress-bar span.extra-color-1, #header-outer .widget_shopping_cart a.button, .woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce-page table.cart a.remove:hover, .swiper-slide .button.solid_color a.extra-color-1, .swiper-slide .button.solid_color_2 a.extra-color-1, .toggle.open.extra-color-1 h3 a {
			background-color: '.$options["extra-color-1"].'!important;
		}
		
		.col:hover > [class^="icon-"].icon-3x.extra-color-1.alt-style.hovered, .col:hover > [class*=" icon-"].icon-3x.extra-color-1.alt-style.hovered, .no-highlight.extra-color-1 h3,
		.col:not(#post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-1.alt-style.hovered, body .col:not(#post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.extra-color-1.alt-style.hovered {
			color: '.$options["extra-color-1"].'!important;
		}
		
		body .col:not(#post-area):not(.span_12):not(#sidebar):hover .extra-color-1.hovered .circle-border, .woocommerce-page table.cart a.remove, #header-outer .woocommerce.widget_shopping_cart .cart_list li a.remove, #header-outer .woocommerce.widget_shopping_cart .cart_list li a.remove, body #sidebar .widget:hover .extra-color-1 .circle-border, .woocommerce-page table.cart a.remove,
		body .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-1"] blockquote .bottom-arrow:after,
		body .dark .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-1"] blockquote .bottom-arrow:after, div[data-style="minimal"] .toggle.open.extra-color-1 i, div[data-style="minimal"] .toggle.extra-color-1:hover i { border-color:'.$options["extra-color-1"].'; }
		
		.pricing-column.highlight.extra-color-1 h3 { background-color:'.$options["extra-color-1"].'!important; }
		
		';
	}
	
	/*Extra Color 2*/
	if(!empty($options["extra-color-2"])) { 
		echo '
		
		.nectar-button.regular-button.extra-color-2, .nectar-button.tilt.extra-color-2 { background-color: '.$options["extra-color-2"].'!important; }
			
		.icon-3x[class^="icon-"].extra-color-2:not(.alt-style), .icon-3x[class*=" icon-"].extra-color-2:not(.alt-style), .icon-tiny[class^="icon-"].extra-color-2, body .icon-3x[class*=" icon-"].extra-color-2  .circle-border, .nectar-milestone .number.extra-color-2, span.extra-color-2, .team-member ul.social.extra-color-2 li a, body [class^="icon-"].icon-default-style.extra-color-2, body [class^="icon-"].icon-default-style[data-color="extra-color-2"], .team-member a.extra-color-2:hover,
		.pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-2 h3, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-2 h4, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-2 .interval,
		.svg-icon-holder[data-color="extra-color-2"], div[data-style="minimal"] .toggle.extra-color-2:hover h3 a, div[data-style="minimal"] .toggle.extra-color-2.open h3 a, .nectar-icon-list[data-icon-style="border"][data-icon-color="extra-color-2"] .list-icon-holder[data-icon_type="numerical"] span, .nectar-icon-list[data-icon-color="extra-color-2"][data-icon-style="border"] .content h4 {
			color: '.$options["extra-color-2"].'!important;
		}
	
		.col:hover > [class^="icon-"].icon-3x.extra-color-2:not(.alt-style).hovered, .col:hover > [class*=" icon-"].icon-3x.extra-color-2:not(.alt-style).hovered, body .swiper-slide .button.transparent_2 a.extra-color-2:hover, 
		.col:not(#post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-2:not(.alt-style).hovered, .col:not(#post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.extra-color-2:not(.alt-style).hovered, #sidebar .widget:hover [class^="icon-"].icon-3x.extra-color-2:not(.alt-style), .pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-2 h3 .highlight-reason,  .nectar-button.nectar_video_lightbox[data-color="default-extra-color-2"],  .nectar_video_lightbox.nectar-button[data-color="transparent-extra-color-2"]:hover,
		.testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-2"] .flickity-page-dots .dot.is-selected:before, .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-2"] blockquote.is-selected p, .nectar-fancy-box[data-color="extra-color-2"]:after, .divider-small-border[data-color="extra-color-2"], .divider-border[data-color="extra-color-2"], div[data-style="minimal"] .toggle.extra-color-2.open i:after, div[data-style="minimal"] .toggle.extra-color-2:hover i:after, div[data-style="minimal"] .toggle.open.extra-color-2 i:before, div[data-style="minimal"] .toggle.extra-color-2:hover i:before,
		.nectar-animated-title[data-color="extra-color-2"] .nectar-animated-title-inner:after, .nectar-video-box[data-color="extra-color-2"] a.nectar_video_lightbox, .nectar_image_with_hotspots[data-stlye="color_pulse"][data-color="extra-color-2"] .nectar_hotspot
		{
			background-color: '.$options["extra-color-2"].'!important;
		}
	
	
		body [class^="icon-"].icon-3x.alt-style.extra-color-2, body [class*=" icon-"].icon-3x.alt-style.extra-color-2, [class*=" icon-"].extra-color-2.icon-normal, .extra-color-2.icon-normal, .bar_graph li span.extra-color-2, .nectar-progress-bar span.extra-color-2, .woocommerce .product-wrap .add_to_cart_button.added, .woocommerce-message, .woocommerce-error, .woocommerce-info, 
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .swiper-slide .button.solid_color a.extra-color-2, .swiper-slide .button.solid_color_2 a.extra-color-2, .toggle.open.extra-color-2 h3 a,
		.portfolio-filters-inline[data-color-scheme="extra-color-2"], .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-2:before {
			background-color: '.$options["extra-color-2"].'!important;
		}
	
		.col:hover > [class^="icon-"].icon-3x.extra-color-2.alt-style.hovered, .col:hover > [class*=" icon-"].icon-3x.extra-color-2.alt-style.hovered, .no-highlight.extra-color-2 h3, 
		.col:not(#post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-2.alt-style.hovered, body .col:not(#post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.extra-color-2.alt-style.hovered {
			color: '.$options["extra-color-2"].'!important;
		}
		
		body .col:not(#post-area):not(.span_12):not(#sidebar):hover .extra-color-2.hovered .circle-border, body #sidebar .widget:hover .extra-color-2 .circle-border,
		body .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-2"] blockquote .bottom-arrow:after,
		body .dark .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-2"] blockquote .bottom-arrow:after, div[data-style="minimal"] .toggle.open.extra-color-2 i, div[data-style="minimal"] .toggle.extra-color-2:hover i { border-color:'.$options["extra-color-2"].'; }
		
		.pricing-column.highlight.extra-color-2 h3 { background-color:'.$options["extra-color-2"].'!important; }
		';
	}
	
	
	/*Extra Color 3*/
	if(!empty($options["extra-color-3"])) { 
		echo '
		
		.nectar-button.regular-button.extra-color-3, .nectar-button.tilt.extra-color-3 { background-color: '.$options["extra-color-3"].'!important; }
			
	    .icon-3x[class^="icon-"].extra-color-3:not(.alt-style) , .icon-3x[class*=" icon-"].extra-color-3:not(.alt-style) , .icon-tiny[class^="icon-"].extra-color-3, body .icon-3x[class*=" icon-"].extra-color-3  .circle-border, .nectar-milestone .number.extra-color-3, span.extra-color-3, .team-member ul.social.extra-color-3 li a, body [class^="icon-"].icon-default-style.extra-color-3, body [class^="icon-"].icon-default-style[data-color="extra-color-3"], .team-member a.extra-color-3:hover,
	    .pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-3 h3, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-3 h4, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-3 .interval,
	    .svg-icon-holder[data-color="extra-color-3"], div[data-style="minimal"] .toggle.extra-color-3:hover h3 a, div[data-style="minimal"] .toggle.extra-color-3.open h3 a, .nectar-icon-list[data-icon-style="border"][data-icon-color="extra-color-3"] .list-icon-holder[data-icon_type="numerical"] span, .nectar-icon-list[data-icon-color="extra-color-3"][data-icon-style="border"] .content h4 {
			color: '.$options["extra-color-3"].'!important;
		}
	    .col:hover > [class^="icon-"].icon-3x.extra-color-3:not(.alt-style).hovered, .col:hover > [class*=" icon-"].icon-3x.extra-color-3:not(.alt-style).hovered, body .swiper-slide .button.transparent_2 a.extra-color-3:hover,
		.col:not(#post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-3:not(.alt-style).hovered, .col:not(#post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.extra-color-3:not(.alt-style).hovered, #sidebar .widget:hover [class^="icon-"].icon-3x.extra-color-3:not(.alt-style),
		.portfolio-filters-inline[data-color-scheme="extra-color-3"], .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-3:before, .pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-3 h3 .highlight-reason,  .nectar-button.nectar_video_lightbox[data-color="default-extra-color-3"],  .nectar_video_lightbox.nectar-button[data-color="transparent-extra-color-3"]:hover,
		.testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-3"] .flickity-page-dots .dot.is-selected:before, .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-3"] blockquote.is-selected p, .nectar-fancy-box[data-color="extra-color-3"]:after, .divider-small-border[data-color="extra-color-3"], .divider-border[data-color="extra-color-3"], div[data-style="minimal"] .toggle.extra-color-3.open i:after, div[data-style="minimal"] .toggle.extra-color-3:hover i:after, div[data-style="minimal"] .toggle.open.extra-color-3 i:before, div[data-style="minimal"] .toggle.extra-color-3:hover i:before,
		.nectar-animated-title[data-color="extra-color-3"] .nectar-animated-title-inner:after , .nectar-video-box[data-color="extra-color-3"] a.nectar_video_lightbox, .nectar_image_with_hotspots[data-stlye="color_pulse"][data-color="extra-color-3"] .nectar_hotspot
		{
			background-color: '.$options["extra-color-3"].'!important;
		}
		
		body [class^="icon-"].icon-3x.alt-style.extra-color-3, body [class*=" icon-"].icon-3x.alt-style.extra-color-3, .extra-color-3.icon-normal, [class*=" icon-"].extra-color-3.icon-normal, .bar_graph li span.extra-color-3, .nectar-progress-bar span.extra-color-3, .swiper-slide .button.solid_color a.extra-color-3, .swiper-slide .button.solid_color_2 a.extra-color-3, .toggle.open.extra-color-3 h3 a  {
			background-color: '.$options["extra-color-3"].'!important;
		}
	
		.col:hover > [class^="icon-"].icon-3x.extra-color-3.alt-style.hovered, .col:hover > [class*=" icon-"].icon-3x.extra-color-3.alt-style.hovered, .no-highlight.extra-color-3 h3,
		.col:not(#post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-3.alt-style.hovered, body .col:not(#post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.extra-color-3.alt-style.hovered {
			color: '.$options["extra-color-3"].'!important;
		}
		
		body .col:not(#post-area):not(.span_12):not(#sidebar):hover .extra-color-3.hovered .circle-border, body #sidebar .widget:hover .extra-color-3 .circle-border,
		body .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-3"] blockquote .bottom-arrow:after,
		body .dark .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-3"] blockquote .bottom-arrow:after, div[data-style="minimal"] .toggle.open.extra-color-3 i, div[data-style="minimal"] .toggle.extra-color-3:hover i { border-color:'.$options["extra-color-3"].'; }
		
		.pricing-column.highlight.extra-color-3 h3 { background-color:'.$options["extra-color-3"].'!important; }
		';
	}

	/*Extra Color Gradient 1*/
	if($options["extra-color-gradient"]['to'] && $options["extra-color-gradient"]['from']) {
		$accent_gradient_1_from = $options["extra-color-gradient"]['from'];
		$accent_gradient_1_to = $options["extra-color-gradient"]['to'];

		echo '.divider-small-border[data-color="extra-color-gradient-1"], .divider-border[data-color="extra-color-gradient-1"], .nectar-progress-bar span.extra-color-gradient-1 {
			background: '.$accent_gradient_1_from.'; 
		    background: linear-gradient(to right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.'); 
		}
		.icon-normal.extra-color-gradient-1,  body [class^="icon-"].icon-3x.alt-style.extra-color-gradient-1, .nectar-button.extra-color-gradient-1:after, .nectar-button.see-through-extra-color-gradient-1:after {
			background: '.$accent_gradient_1_from.'; 
		    background: linear-gradient(to bottom right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.'); 
		}

		.nectar-button.extra-color-gradient-1, .nectar-button.see-through-extra-color-gradient-1 {
			 border: 3px solid transparent;
		    -moz-border-image: -moz-linear-gradient(top right, '.$accent_gradient_1_from.' 0%, '.$accent_gradient_1_to.' 100%);
		    -webkit-border-image: -webkit-linear-gradient(top right, '.$accent_gradient_1_from.' 0%,'.$accent_gradient_1_to.' 100%);
		    border-image: linear-gradient(to bottom right, '.$accent_gradient_1_from.' 0%, '.$accent_gradient_1_to.' 100%);
		    border-image-slice: 1;
		}
		.nectar-gradient-text[data-color="extra-color-gradient-1"][data-direction="horizontal"] * { background-image: linear-gradient(to right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.');  }
		.nectar-gradient-text[data-color="extra-color-gradient-1"] *, .nectar-icon-list[data-icon-style="border"][data-icon-color="extra-color-gradient-1"] .list-icon-holder[data-icon_type="numerical"] span {
			 color: '.$accent_gradient_1_from.';
			  background: linear-gradient(to bottom right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.'); 
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: inline-block;
		}
		
		[class^="icon-"][data-color="extra-color-gradient-1"]:before, [class*=" icon-"][data-color="extra-color-gradient-1"]:before,
		[class^="icon-"].extra-color-gradient-1:not(.icon-normal):before, [class*=" icon-"].extra-color-gradient-1:not(.icon-normal):before {
			  color: '.$accent_gradient_1_from.';
			  background: linear-gradient(to bottom right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.'); 
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: initial; 
		}
		.nectar-button.extra-color-gradient-1 .hover, .nectar-button.see-through-extra-color-gradient-1 .start {
			  background: '.$accent_gradient_1_from.'; 
			  background: linear-gradient(to bottom right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.'); 
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: initial; 
		}
		.nectar-button.extra-color-gradient-1.no-text-grad .hover, .nectar-button.see-through-extra-color-gradient-1.no-text-grad .start {
			 background: transparent!important;
			 color: '.$accent_gradient_1_from.'!important; 
		}';
	}

	/*Extra Color Gradient 2*/
	if($options["extra-color-gradient-2"]['to'] && $options["extra-color-gradient-2"]['from']) {
		$accent_gradient_2_from = $options["extra-color-gradient-2"]['from'];
		$accent_gradient_2_to = $options["extra-color-gradient-2"]['to'];

		echo '.divider-small-border[data-color="extra-color-gradient-2"], .divider-border[data-color="extra-color-gradient-2"], .nectar-progress-bar span.extra-color-gradient-2 {
			background: '.$accent_gradient_2_from.';
		    background: linear-gradient(to right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');
		}
		.icon-normal.extra-color-gradient-2, body [class^="icon-"].icon-3x.alt-style.extra-color-gradient-2, .nectar-button.extra-color-gradient-2:after, .nectar-button.see-through-extra-color-gradient-2:after {
			background: '.$accent_gradient_2_from.';
		    background: linear-gradient(to bottom right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');
		}
		.nectar-button.extra-color-gradient-2, .nectar-button.see-through-extra-color-gradient-2 {
			 border: 3px solid transparent;
		    -moz-border-image: -moz-linear-gradient(top right, '.$accent_gradient_2_from.' 0%, '.$accent_gradient_2_to.' 100%);
		    -webkit-border-image: -webkit-linear-gradient(top right, '.$accent_gradient_2_from.' 0%,'.$accent_gradient_2_to.' 100%);
		    border-image: linear-gradient(to bottom right, '.$accent_gradient_2_from.' 0%, '.$accent_gradient_2_to.' 100%);
		    border-image-slice: 1;
		}
		.nectar-gradient-text[data-color="extra-color-gradient-2"][data-direction="horizontal"] * { background-image: linear-gradient(to right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');  }
		.nectar-gradient-text[data-color="extra-color-gradient-2"] *, .nectar-icon-list[data-icon-style="border"][data-icon-color="extra-color-gradient-2"] .list-icon-holder[data-icon_type="numerical"] span {
			 color: '.$accent_gradient_2_from.';
			  background: linear-gradient(to bottom right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.'); 
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: inline-block;
		}

		[class^="icon-"][data-color="extra-color-gradient-2"]:before, [class*=" icon-"][data-color="extra-color-gradient-2"]:before,
		[class^="icon-"].extra-color-gradient-2:not(.icon-normal):before, [class*=" icon-"].extra-color-gradient-2:not(.icon-normal):before {
			  color: '.$accent_gradient_2_from.'; 
			  background: linear-gradient(to bottom right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.'); 
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: initial; 
		}
		.nectar-button.extra-color-gradient-2 .hover, .nectar-button.see-through-extra-color-gradient-2 .start {
			  background: '.$accent_gradient_2_from.'; 
			  background: linear-gradient(to bottom right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.'); 
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: initial; 
		}
		.nectar-button.extra-color-gradient-2.no-text-grad .hover, .nectar-button.see-through-extra-color-gradient-2.no-text-grad .start {
			background: transparent!important;
			color: '.$accent_gradient_2_from.'!important; 
		}

		';
	}

	/*custom bg/font colors*/
	if(!empty($options['overall-bg-color'])) {
		echo 'html .container-wrap, .project-title, html .ascend .container-wrap, html .ascend .project-title, html body .vc_text_separator div, html .carousel-wrap[data-full-width="true"] .carousel-heading, html .carousel-wrap span.left-border, html .carousel-wrap span.right-border,
			html #page-header-wrap, html .page-header-no-bg, html #full_width_portfolio .project-title.parallax-effect, html .portfolio-items .col, html .page-template-template-portfolio-php .portfolio-items .col.span_3, html .page-template-template-portfolio-php .portfolio-items .col.span_4 
		{ background-color: '.$options['overall-bg-color'].'; }';
	}
	if(!empty($options['overall-font-color'])) {
		echo 'html body, body h1, body h2, body h3, body h4, body h5, body h6 { color: '.$options['overall-font-color'].'; }';
		echo '#project-meta .nectar-love { color: '.$options['overall-font-color'].'!important; }';
		/* dark color fixes */
		if($options['overall-font-color'] != '#000000' && $options['overall-font-color'] != '#0a0a0a' && $options['overall-font-color'] != '#111111' && $options['overall-font-color'] != '#222222' && $options['overall-font-color'] != '#333333') {
			echo '.full-width-section > .col.span_12.dark, .full-width-content > .col.span_12.dark {
				color: #676767;	
			}';
			echo '.full-width-section > .col.span_12.dark h1, .full-width-content > .col.span_12.dark h1,
			.full-width-section > .col.span_12.dark h2, .full-width-content > .col.span_12.dark h2,
			.full-width-section > .col.span_12.dark h3, .full-width-content > .col.span_12.dark h3,
			.full-width-section > .col.span_12.dark h4, .full-width-content > .col.span_12.dark h4,
			.full-width-section > .col.span_12.dark h5, .full-width-content > .col.span_12.dark h5,
			.full-width-section > .col.span_12.dark h6, .full-width-content > .col.span_12.dark h6 {
				color: #444;
			}';
		}
	}
	
	/*Custom header colors*/
	if(!empty($options['header-color']) && $options['header-color'] == 'custom') {
		
		if(!empty($options['header-background-color'])) {
			echo 'body #header-outer, body #search-outer { background-color:'.$options['header-background-color'].'; }';
		}

		 /*custom header bg opacity*/
		 if(!empty($options['header-bg-opacity'])) {

		 		 $navBGColor = $options['header-background-color'];
		 		 $navBGColor = substr($navBGColor,1);
				 $colorR = hexdec( substr( $navBGColor, 0, 2 ) );
				 $colorG = hexdec( substr( $navBGColor, 2, 2 ) );
				 $colorB = hexdec( substr( $navBGColor, 4, 2 ) );
				 $colorA = ($options['header-bg-opacity'] != '100') ? '0.'.$options['header-bg-opacity'] : $options['header-bg-opacity'];

				 echo 'body #header-outer, body[data-header-color="dark"] #header-outer { background-color: rgba('.$colorR.','.$colorG.','.$colorB.','.$colorA.'); }';	
		}

		if(!empty($options['header-font-color'])) {
			echo 'header#top nav > ul > li > a, header#top #logo, header#top .span_9 > .slide-out-widget-area-toggle i, .sf-sub-indicator [class^="icon-"], body[data-header-color="custom"].ascend #boxed #header-outer .cart-menu .cart-icon-wrap i,  body.ascend #boxed #header-outer .cart-menu .cart-icon-wrap i, .sf-sub-indicator [class*=" icon-"], header#top nav ul #search-btn a span, header#top #toggle-nav i, header#top #toggle-nav i, header#top #mobile-cart-link i, #header-outer .cart-menu .cart-icon-wrap .icon-salient-cart, #search-outer #search input[type="text"], #search-outer #search #close a span { color:'.$options['header-font-color'].'!important; }';
			echo 'header#top nav ul .slide-out-widget-area-toggle a i.lines, header#top nav ul .slide-out-widget-area-toggle a i.lines:after, .slide-out-widget-area-toggle[data-icon-animation="simple-transform"]:not(.mobile-icon) .lines-button:after, header#top nav ul .slide-out-widget-area-toggle a i.lines:before { background-color:'.$options['header-font-color'].'!important; }';
			echo 'header#top nav > ul > li.button_bordered > a:before { border-color:'.$options['header-font-color'].'; }';
		}
		
		if(!empty($options['header-font-hover-color'])) {
			echo '#header-outer:not([data-lhe="animated_underline"]) header#top nav > ul > li > a:hover, body #header-outer:not(.transparent) #social-in-menu a i:after, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.sfHover > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav > ul > li > a:hover, header#top #logo:hover, .ascend #header-outer:not(.transparent) .cart-outer:hover .cart-menu-wrap:not(.has_products) .icon-salient-cart, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.sfHover > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current-menu-item > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current_page_item > a .sf-sub-indicator i, body header#top nav .sf-menu > li.current_page_ancestor > a .sf-sub-indicator i, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.sfHover > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current_page_ancestor > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current-menu-ancestor > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current-menu-ancestor > a i,  body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current_page_item > a, body header#top nav .sf-menu > li.current_page_item > a .sf-sub-indicator [class^="icon-"], body header#top nav .sf-menu > li.current_page_ancestor > a .sf-sub-indicator [class^="icon-"], body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current-menu-ancestor > a, body .sf-menu > li.sfHover > a .sf-sub-indicator [class^="icon-"], body .sf-menu > li:hover > a .sf-sub-indicator [class^="icon-"], body .sf-menu > li:hover > a, header#top nav ul #search-btn a:hover span, header#top nav ul .slide-out-widget-area-toggle a:hover span, #search-outer #search #close a span:hover { color:'.$options['header-font-hover-color'].'!important; }';
			echo 'header#top nav ul .slide-out-widget-area-toggle a:hover i.lines, header#top nav ul .slide-out-widget-area-toggle a:hover i.lines:after, body header#top nav ul .slide-out-widget-area-toggle[data-icon-animation="simple-transform"] a:hover .lines-button:after, header#top nav ul .slide-out-widget-area-toggle a:hover i.lines:before { background-color:'.$options['header-font-hover-color'].'!important; }';
			echo '#header-outer[data-lhe="animated_underline"] header#top nav > ul > li > a:after { border-color:'.$options['header-font-hover-color'].'!important; }';
		}

		if(!empty($options['header-dropdown-background-color'])) {
			echo '#search-outer .ui-widget-content, header#top .sf-menu li ul li a, header#top nav > ul > li.megamenu > ul.sub-menu, body header#top nav > ul > li.megamenu > ul.sub-menu > li > a, #header-outer .widget_shopping_cart .cart_list a, #header-secondary-outer ul ul li a, #header-outer .widget_shopping_cart .cart_list li, .woocommerce .cart-notification, #header-outer .widget_shopping_cart_content { background-color:'.$options['header-dropdown-background-color'].'!important; }';
		}
		
		if(!empty($options['header-dropdown-background-hover-color'])) {
			echo 'header#top .sf-menu li ul li a:hover, body header#top nav .sf-menu ul li.sfHover > a, header#top .sf-menu li ul li.current-menu-item > a, header#top .sf-menu li ul li.current-menu-ancestor > a, header#top nav > ul > li.megamenu > ul ul li a:hover, header#top nav > ul > li.megamenu > ul ul li.current-menu-item a, #header-secondary-outer ul ul li a:hover, body #header-secondary-outer .sf-menu ul li.sfHover > a, #header-outer .widget_shopping_cart .cart_list li:hover, #header-outer .widget_shopping_cart .cart_list li:hover a, #search-outer .ui-widget-content li:hover, .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus { background-color:'.$options['header-dropdown-background-hover-color'].'!important; }';
		}
		
		if(!empty($options['header-dropdown-font-color'])) {
			echo '#search-outer .ui-widget-content li a, #search-outer .ui-widget-content i, header#top .sf-menu li ul li a, body #header-outer .widget_shopping_cart .cart_list a, #header-secondary-outer ul ul li a, .woocommerce .cart-notification .item-name, .cart-outer .cart-notification, .sf-menu li ul .sf-sub-indicator [class^="icon-"], .sf-menu li ul .sf-sub-indicator [class*=" icon-"], #header-outer .widget_shopping_cart .quantity { color:'.$options['header-dropdown-font-color'].'!important; }';
		}

		if(!empty($options['header-dropdown-font-hover-color'])) {
			echo '#search-outer .ui-widget-content li:hover a .title, #search-outer .ui-widget-content .ui-state-hover .title,  #search-outer .ui-widget-content .ui-state-focus .title, #search-outer .ui-widget-content li:hover a, #search-outer .ui-widget-content li:hover i,  #search-outer .ui-widget-content .ui-state-hover a,  #search-outer .ui-widget-content .ui-state-focus a,  #search-outer .ui-widget-content .ui-state-hover i,  #search-outer .ui-widget-content .ui-state-focus i, #search-outer .ui-widget-content .ui-state-hover span,  #search-outer .ui-widget-content .ui-state-focus span,  body header#top nav .sf-menu ul li.sfHover > a,  header#top nav > ul > li.megamenu > ul ul li.current-menu-item a, body #header-outer .widget_shopping_cart .cart_list li:hover a, #header-secondary-outer ul ul li:hover > a, body #header-secondary-outer ul ul li:hover > a i, body header#top nav .sf-menu ul li.sfHover > a .sf-sub-indicator i,  #header-outer .widget_shopping_cart li:hover .quantity, body header#top nav .sf-menu ul li:hover > a .sf-sub-indicator i, body header#top nav .sf-menu ul li:hover > a, header#top nav > ul > li.megamenu > ul > li > a:hover, header#top nav > ul > li.megamenu > ul > li.sfHover > a, body header#top nav .sf-menu ul li.current-menu-item > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu ul li.current-menu-item > a, body header#top nav .sf-menu ul li.current_page_item > a .sf-sub-indicator i, body header#top nav .sf-menu ul li.current_page_ancestor > a .sf-sub-indicator i, body header#top nav .sf-menu ul li.sfHover > a, #header-secondary-outer ul li.sfHover > a,  body header#top nav .sf-menu ul li.current_page_ancestor > a, body header#top nav .sf-menu ul li.current-menu-ancestor > a, body header#top nav .sf-menu ul li.current_page_item > a, body header#top nav .sf-menu ul li.current_page_item > a .sf-sub-indicator [class^="icon-"], body header#top nav .sf-menu ul li.current_page_ancestor > a .sf-sub-indicator [class^="icon-"], body header#top nav .sf-menu ul li.current-menu-ancestor > a, body header#top nav .sf-menu ul li.current_page_item > a, body .sf-menu ul li ul li.sfHover > a .sf-sub-indicator [class^="icon-"], body ul.sf-menu > li > a:active > .sf-sub-indicator i, body ul.sf-menu > li.sfHover > a > .sf-sub-indicator i, body .sf-menu ul li.current_page_item > a , body .sf-menu ul li.current-menu-ancestor > a, body .sf-menu ul li.current_page_ancestor > a, body .sf-menu ul a:focus , body .sf-menu ul a:hover, body .sf-menu ul a:active, body .sf-menu ul li:hover > a, body .sf-menu ul li.sfHover > a, .body sf-menu li ul li a:hover, body .sf-menu li ul li.sfHover > a, body header#top nav > ul > li.megamenu ul li:hover > a { color:'.$options['header-dropdown-font-hover-color'].'!important; }';
		}
		
		if(!empty($options['secondary-header-background-color'])) {
			echo '#header-secondary-outer { background-color:'.$options['secondary-header-background-color'].'!important; }';
		}
		
		if(!empty($options['secondary-header-font-color'])) {
			echo '#header-secondary-outer nav > ul > li > a, body #header-secondary-outer nav > ul > li > a span.sf-sub-indicator [class^="icon-"], #header-secondary-outer #social li a i { color:'.$options['secondary-header-font-color'].'!important; }';
		}
		
		if(!empty($options['secondary-header-font-hover-color'])) {
			echo '#header-secondary-outer #social li a:hover i,  #header-secondary-outer nav > ul > li:hover > a, #header-secondary-outer nav > ul > li.current-menu-item > a, #header-secondary-outer nav > ul > li.sfHover > a, #header-secondary-outer nav > ul > li.sfHover > a span.sf-sub-indicator [class^="icon-"], #header-secondary-outer nav > ul > li.current-menu-item > a span.sf-sub-indicator [class^="icon-"], #header-secondary-outer nav > ul > li.current-menu-ancestor > a,  #header-secondary-outer nav > ul > li.current-menu-ancestor > a span.sf-sub-indicator [class^="icon-"], body #header-secondary-outer nav > ul > li:hover > a span.sf-sub-indicator [class^="icon-"] { color:'.$options['secondary-header-font-hover-color'].'!important; }';
		}


		/*Custom slide out widget area colors*/
		if(!empty($options['header-slide-out-widget-area-background-color'])) {
			echo '#slide-out-widget-area:not(.fullscreen-alt):not(.fullscreen), #slide-out-widget-area-bg.fullscreen, #slide-out-widget-area-bg.fullscreen-alt .bg-inner { background-color:'.$options['header-slide-out-widget-area-background-color'].'!important; }';
		}

		if(!empty($options['header-slide-out-widget-area-color'])) {
			echo '#slide-out-widget-area, #slide-out-widget-area a, body #slide-out-widget-area a.slide_out_area_close .icon-default-style[class^="icon-"] { color:'.$options['header-slide-out-widget-area-color'].'!important; }';
			echo '#slide-out-widget-area .tagcloud a { border-color: '.$options['header-slide-out-widget-area-color'].'!important; }';
			echo '.slide-out-hover-icon-effect.slide-out-widget-area-toggle[data-icon-animation="simple-transform"] .lines:before, .slide-out-hover-icon-effect.slide-out-widget-area-toggle[data-icon-animation="simple-transform"] .lines:after, .slide-out-hover-icon-effect.slide-out-widget-area-toggle[data-icon-animation="simple-transform"] .lines-button:after { background-color:'.$options['header-slide-out-widget-area-color'].'!important; }';
		}

		if(!empty($options['header-slide-out-widget-area-header-color'])) {
			echo '#slide-out-widget-area h1, #slide-out-widget-area h2, #slide-out-widget-area h3, #slide-out-widget-area h4, #slide-out-widget-area h5 { color:'.$options['header-slide-out-widget-area-header-color'].'!important; }';
		}


		if(!empty($options['header-slide-out-widget-area-hover-color'])) {
			echo 'body #slide-out-widget-area.fullscreen a:hover, body #slide-out-widget-area.slide-out-from-right a:hover, #slide-out-widget-area.fullscreen-alt .inner .off-canvas-menu-container li a .clip-wrap, #slide-out-widget-area.slide-out-from-right-hover .inner .off-canvas-menu-container li a .clip-wrap, html body #slide-out-widget-area a.slide_out_area_close:hover .icon-default-style[class^="icon-"] { color:'.$options['header-slide-out-widget-area-hover-color'].'!important; }';
			echo '#slide-out-widget-area .tagcloud a:hover { border-color: '.$options['header-slide-out-widget-area-hover-color'].'!important; }';
		}

	} 


	/*Custom footer colors*/
	if(!empty($options['footer-custom-color']) && $options['footer-custom-color'] == '1') {
		
		if(!empty($options['footer-background-color'])) {
			echo '#footer-outer { background-color:'.$options['footer-background-color'].'!important; } #footer-outer #footer-widgets { border-bottom: none!important; } #footer-outer #footer-widgets .col ul li { border-bottom: 1px solid rgba(0,0,0,0.1)!important; } #footer-outer #footer-widgets .col .widget_recent_comments ul li { background-color: rgba(0, 0, 0, 0.07)!important; border-bottom: 0px!important;} ';
		}
		
		if(!empty($options['footer-font-color'])) {
			echo '#footer-outer, #footer-outer a:not(.nectar-button), body[data-form-style="minimal"] #footer-outer #footer-widgets .col input[type=text] { color:'.$options['footer-font-color'].'!important; }';
		}
		
		if(!empty($options['footer-secondary-font-color'])) {
			echo '#footer-outer .widget h4, #footer-outer .col .widget_recent_entries span, #footer-outer .col .recent_posts_extra_widget .post-widget-text span { color:'.$options['footer-secondary-font-color'].'!important; }';
		}
		
		if(!empty($options['footer-copyright-background-color'])) {
			echo '#footer-outer #copyright, body { border: none!important; background-color:'.$options['footer-copyright-background-color'].'!important; }';
		}
		
		if(!empty($options['footer-copyright-font-color'])) {
			echo '#footer-outer #copyright li a i, #footer-outer #copyright p { color:'.$options['footer-copyright-font-color'].'!important; }';
		}

		/*copyright border line*/
		if(!empty($options['footer-copyright-line']) && $options['footer-copyright-line'] == '1') {
			echo '#footer-outer #copyright { border-top: 1px solid rgba(255,255,255,0.18)!important; }';
		}
	}
 
	/*Custom CTA colors*/
	if(!empty($options['cta-background-color'])) {
		echo '#call-to-action { background-color:'.$options['cta-background-color'].'!important; }';
	}
	
	if(!empty($options['cta-text-color'])) {
		echo '#call-to-action span { color:'.$options['cta-text-color'].'!important; }';
	}
	
	/*slide out widget overlay*/
	$slide_out_widget_overlay = (!empty($options['header-slide-out-widget-area-overlay-opacity'])) ? $options['header-slide-out-widget-area-overlay-opacity'] : 'dark';
	if($slide_out_widget_overlay == 'dark') {
		echo 'body #slide-out-widget-area-bg { background-color: rgba(0,0,0,0.8); }';
	} else if($slide_out_widget_overlay == 'medium') {
		echo 'body #slide-out-widget-area-bg { background-color: rgba(0,0,0,0.6); }';
	} else {
		echo 'body #slide-out-widget-area-bg { background-color: rgba(0,0,0,0.4); }';
	}

	/*blog categories*/
	$masonry_type = (!empty($options['blog_masonry_type'])) ? $options['blog_masonry_type'] : 'classic'; 
	if($masonry_type == 'classic_enhanced') {

		$categories = get_categories();

		if(!empty($categories)){

			foreach($categories as $k => $v) {

				$t_id =  $v->term_id;
				$terms =  get_option( "taxonomy_$t_id" );

				if(!empty($terms['category_color']))
					echo '.single .heading-title[data-header-style="default_minimal"] .meta-category a.'.$v->slug . ':hover, .masonry.classic_enhanced .posts-container article .meta-category a.'.$v->slug . ':hover, #page-header-bg[data-post-hs="default_minimal"] .inner-wrap > a.'.$v->slug . ':hover, .nectar-recent-posts-slider .container .strong .'.$v->slug.':before { background-color: '.$terms['category_color'].'!important; }';
			}
		}
	}

	global $post;
	$page_full_screen_rows_bg_color = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows_overall_bg_color', true) : '#333333';
	$page_full_screen_rows_animation = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows_animation', true) : '';
	echo '#nectar_fullscreen_rows { background-color: '.$page_full_screen_rows_bg_color.'; }';
	if($page_full_screen_rows_animation == 'parallax') {
		echo '#nectar_fullscreen_rows > .wpb_row .full-page-inner-wrap { background-color: '.$page_full_screen_rows_bg_color.'; }';
	}

	if($external_dynamic != 'on') {

		echo '</style>'; 

		$dynamic_css = ob_get_contents();
		ob_end_clean();
		
		echo nectar_quick_minify($dynamic_css);	
	}





?>