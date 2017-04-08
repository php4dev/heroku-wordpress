<!doctype html>


<html <?php language_attributes(); ?> >
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php $options = get_nectar_theme_options(); ?>

<?php if(!empty($options['responsive']) && $options['responsive'] == 1) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

<?php } else { ?>
	<meta name="viewport" content="width=1200" />
<?php } ?>	

<!--Shortcut icon-->
<?php if(!empty($options['favicon'])) { ?>
	<link rel="shortcut icon" href="<?php echo nectar_options_img($options['favicon']); ?>" />
<?php } ?>


<title> <?php wp_title("|",true, 'right'); ?> <?php if (!defined('WPSEO_VERSION')) { bloginfo('name'); } ?></title>

<?php wp_head(); ?>

<?php if(!empty($options['google-analytics'])) echo $options['google-analytics']; ?> 

</head>

<?php
 global $post; 
 global $woocommerce; 


//check if parallax nectar slider is being used
$parallax_nectar_slider = using_nectar_slider();
$force_effect = get_post_meta($post->ID, '_force_transparent_header', true);

// header transparent option
$transparency_markup = null;
$activate_transparency = null;

$using_fw_slider = using_nectar_slider();
$using_fw_slider = (!empty($options['transparent-header']) && $options['transparent-header'] == '1') ? $using_fw_slider : 0;
if($force_effect == 'on') $using_fw_slider = '1';
$disable_effect = get_post_meta($post->ID, '_disable_transparent_header', true);

if(!empty($options['transparent-header']) && $options['transparent-header'] == '1') {
	
	$starting_color = (empty($options['header-starting-color'])) ? '#ffffff' : $options['header-starting-color'];
	$activate_transparency = using_page_header($post->ID);
	$remove_border = (!empty($options['header-remove-border']) && $options['header-remove-border'] == '1') ? 'true' : 'false';
	$transparency_markup = ($activate_transparency == 'true') ? 'data-transparent-header="true" data-remove-border="'.$remove_border.'" class="transparent"' : null ;
}

//header vars
$logo_class = (!empty($options['use-logo']) && $options['use-logo'] == '1') ? null : 'class="no-image"'; 
$sideWidgetArea = (!empty($options['header-slide-out-widget-area'])) ? $options['header-slide-out-widget-area'] : 'off';
$sideWidgetClass = (!empty($options['header-slide-out-widget-area-style'])) ? $options['header-slide-out-widget-area-style'] : 'slide-out-from-right';
$sideWidgetIconAnimation = (!empty($options['header-slide-out-widget-area-icon-animation'])) ? $options['header-slide-out-widget-area-icon-animation'] : 'spin-and-transform';
if($sideWidgetClass == 'slide-out-from-right-hover') $sideWidgetIconAnimation = 'simple-transform';
$fullWidthHeader = (!empty($options['header-fullwidth']) && $options['header-fullwidth'] == '1') ? 'true' : 'false';
$headerSearch = (!empty($options['header-disable-search']) && $options['header-disable-search'] == '1') ? 'false' : 'true';
$headerFormat = (!empty($options['header_format'])) ? $options['header_format'] : 'default';
$mobile_fixed = (!empty($options['header-mobile-fixed'])) ? $options['header-mobile-fixed'] : 'false';
$fullWidthHeader = (!empty($options['header-fullwidth']) && $options['header-fullwidth'] == '1') ? 'true' : 'false';
$headerColorScheme = (!empty($options['header-color'])) ? $options['header-color'] : 'light';
$userSetBG = (!empty($options['header-background-color']) && $headerColorScheme == 'custom') ? $options['header-background-color'] : '#ffffff';
$trans_header = (!empty($options['transparent-header']) && $options['transparent-header'] == '1') ? $options['transparent-header'] : 'false';
$bg_header = (!empty($post->ID) && $post->ID != 0) ? using_page_header($post->ID) : 0;
$bg_header = ($bg_header == 1) ? 'true' : 'false'; //convert to string for references in css
$perm_trans = (!empty($options['header-permanent-transparent']) && $trans_header != 'false' && $bg_header == 'true') ? $options['header-permanent-transparent'] : 'false'; 
$headerLinkHoverEffect = (!empty($options['header-hover-effect'])) ? $options['header-hover-effect'] : 'default';
$hideHeaderUntilNeeded = (!empty($options['header-hide-until-needed'])) ? $options['header-hide-until-needed'] : '0';
$headerResize = (!empty($options['header-resize-on-scroll']) && $perm_trans != '1') ? $options['header-resize-on-scroll'] : '0'; 
$page_transition_effect = (!empty($options['transition-effect'])) ? $options['transition-effect'] : 'standard';
if($hideHeaderUntilNeeded == '1') $headerResize = '0';
$lightbox_script = (!empty($options['lightbox_script'])) ? $options['lightbox_script'] : 'pretty_photo';
$button_styling = (!empty($options['button-styling'])) ? $options['button-styling'] : 'default'; 
$form_style = (!empty($options['form-style'])) ? $options['form-style'] : 'default'; 
$fancy_rcs = (!empty($options['form-fancy-select'])) ? $options['form-fancy-select'] : 'default';
$footer_reveal = (!empty($options['footer-reveal'])) ? $options['footer-reveal'] : 'false'; 
$footer_reveal_shadow = (!empty($options['footer-reveal-shadow']) && $footer_reveal == '1') ? $options['footer-reveal-shadow'] : 'none'; 
$icon_style = (!empty($options['theme-icon-style'])) ? $options['theme-icon-style'] : 'inherit';
$has_main_menu = (has_nav_menu('top_nav')) ? 'true' : 'false';
$animate_in_effect = (!empty($options['header-animate-in-effect'])) ? $options['header-animate-in-effect'] : 'none';
if($headerColorScheme == 'dark') { $userSetBG = '#1f1f1f'; } 	
$userSetSideWidgetArea = $sideWidgetArea;
if($has_main_menu == 'true' && $mobile_fixed == '1') $sideWidgetArea = '1';
if($headerFormat == 'centered-menu-under-logo') $fullWidthHeader = 'false';
if($sideWidgetClass == 'slide-out-from-right-hover') $fullWidthHeader = 'true';
$column_animation_easing = (!empty($options['column_animation_easing'])) ? $options['column_animation_easing'] : 'linear'; 
$column_animation_duration = (!empty($options['column_animation_timing'])) ? $options['column_animation_timing'] : '650'; 
$prependTopNavMobile = (!empty($options['header-slide-out-widget-area-top-nav-in-mobile']) && $userSetSideWidgetArea == '1') ? $options['header-slide-out-widget-area-top-nav-in-mobile'] : 'false';
$smooth_scrolling = (!empty($options['smooth-scrolling'])) ? $options['smooth-scrolling'] : '0';
$page_full_screen_rows = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows', true) : '';
if($page_full_screen_rows == 'on') $smooth_scrolling = '0';

?>

<body <?php body_class(); ?> data-footer-reveal="<?php echo $footer_reveal; ?>" data-footer-reveal-shadow="<?php echo $footer_reveal_shadow; ?>" data-cae="<?php echo $column_animation_easing; ?>" data-cad="<?php echo $column_animation_duration; ?>" data-aie="<?php echo $animate_in_effect; ?>" data-ls="<?php echo $lightbox_script;?>" data-apte="<?php echo $page_transition_effect;?>" data-hhun="<?php echo $hideHeaderUntilNeeded; ?>" data-fancy-form-rcs="<?php echo $fancy_rcs; ?>" data-form-style="<?php echo $form_style; ?>" data-is="<?php echo $icon_style; ?>" data-button-style="<?php echo $button_styling; ?>" data-header-inherit-rc="<?php echo (!empty($options['header-inherit-row-color']) && $options['header-inherit-row-color'] == '1' && $perm_trans != 1) ? "true" : "false"; ?>" data-header-search="<?php echo $headerSearch; ?>" data-animated-anchors="<?php echo (!empty($options['one-page-scrolling']) && $options['one-page-scrolling'] == '1') ? 'true' : 'false'; ?>" data-ajax-transitions="<?php echo (!empty($options['ajax-page-loading']) && $options['ajax-page-loading'] == '1') ? 'true' : 'false'; ?>" data-full-width-header="<?php echo $fullWidthHeader; ?>" data-slide-out-widget-area="<?php echo ($sideWidgetArea == '1') ? 'true' : 'false';  ?>" data-slide-out-widget-area-style="<?php echo $sideWidgetClass; ?>" data-user-set-ocm="<?php echo $userSetSideWidgetArea; ?>" data-loading-animation="<?php echo (!empty($options['loading-image-animation'])) ? $options['loading-image-animation'] : 'none'; ?>" data-bg-header="<?php echo $bg_header; ?>" data-ext-responsive="<?php echo (!empty($options['responsive']) && $options['responsive'] == 1 && !empty($options['ext_responsive']) && $options['ext_responsive'] == '1') ? 'true' : 'false'; ?>" data-header-resize="<?php echo $headerResize; ?>" data-header-color="<?php echo (!empty($options['header-color'])) ? $options['header-color'] : 'light' ; ?>" <?php echo (!empty($options['transparent-header']) && $options['transparent-header'] == '1') ? null : 'data-transparent-header="false"'; ?> data-smooth-scrolling="<?php echo $smooth_scrolling; ?>" data-permanent-transparent="<?php echo $perm_trans; ?>" data-responsive="<?php echo (!empty($options['responsive']) && $options['responsive'] == 1) ? '1'  : '0' ?>" >

<?php if(!empty($options['boxed_layout']) && $options['boxed_layout'] == '1') { echo '<div id="boxed">'; } ?>

<?php $using_secondary = (!empty($options['header_layout'])) ? $options['header_layout'] : ' '; 

if($using_secondary == 'header_with_secondary') { ?>

	<div id="header-secondary-outer" data-full-width="<?php echo (!empty($options['header-fullwidth']) && $options['header-fullwidth'] == '1') ? 'true' : 'false' ; ?>" data-permanent-transparent="<?php echo $perm_trans; ?>" >
		<div class="container">
			<nav>
				<?php if(!empty($options['enable_social_in_header']) && $options['enable_social_in_header'] == '1') nectar_header_social_icons('secondary-nav'); ?>
				
				<?php if(has_nav_menu('secondary_nav')) { ?>
					<ul class="sf-menu">	
				   	   <?php wp_nav_menu( array('walker' => new Nectar_Arrow_Walker_Nav_Menu, 'theme_location' => 'secondary_nav', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>
				    </ul>
				<?php }	?>
				
			</nav>
		</div>
	</div>

<?php } 

$page_full_screen_rows = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows', true) : '';
if($perm_trans != 1 || $perm_trans == 1 && $bg_header == 'false' || $page_full_screen_rows == 'on') { ?> <div id="header-space" data-header-mobile-fixed='<?php echo $mobile_fixed; ?>'></div> <?php } ?>


<div id="header-outer" data-has-menu="<?php echo $has_main_menu; ?>" <?php echo $transparency_markup; ?> data-mobile-fixed="<?php echo $mobile_fixed; ?>" data-ptnm="<?php echo $prependTopNavMobile;?>" data-lhe="<?php echo $headerLinkHoverEffect; ?>" data-user-set-bg="<?php echo $userSetBG; ?>" data-format="<?php echo $headerFormat; ?>" data-permanent-transparent="<?php echo $perm_trans; ?>" data-cart="<?php echo ($woocommerce && !empty($options['enable-cart']) && $options['enable-cart'] == '1') ? 'true': 'false';?>" data-transparency-option="<?php if($disable_effect == 'on') { echo '0'; } else { echo $using_fw_slider; } ?>" data-shrink-num="<?php echo (!empty($options['header-resize-on-scroll-shrink-num'])) ? $options['header-resize-on-scroll-shrink-num'] : 6; ?>" data-full-width="<?php echo $fullWidthHeader; ?>" data-using-secondary="<?php echo ($using_secondary == 'header_with_secondary') ? '1' : '0'; ?>" data-using-logo="<?php if(!empty($options['use-logo'])) echo $options['use-logo']; ?>" data-logo-height="<?php if(!empty($options['logo-height'])) echo $options['logo-height']; ?>" data-m-logo-height="<?php if(!empty($options['mobile-logo-height'])) { echo $options['mobile-logo-height']; } else { echo '24'; } ?>" data-padding="<?php echo (!empty($options['header-padding'])) ? $options['header-padding'] : "28"; ?>" data-header-resize="<?php echo $headerResize; ?>">
	
	<?php if(empty($options['theme-skin'])) { 
		get_template_part('includes/header-search'); 
	} 
	elseif(!empty($options['theme-skin']) && $options['theme-skin'] != 'ascend')  {
		 get_template_part('includes/header-search');
	} ?>
	
	<header id="top">
		
		<div class="container">
			
			<div class="row">
				  
				<div class="col span_3">
					
					<a id="logo" href="<?php echo home_url(); ?>" <?php echo $logo_class; ?>>

						<?php nectar_logo_output($activate_transparency, $sideWidgetClass); ?> 

					</a>

				</div><!--/span_3-->
				
				<div class="col span_9 col_last">
					
					<?php if($has_main_menu == 'true' && $mobile_fixed == 'false' && $prependTopNavMobile != '1') { ?>
						<div class="slide-out-widget-area-toggle mobile-icon std-menu <?php echo $sideWidgetClass; ?>" data-icon-animation="simple-transform">
							<div> <a id="toggle-nav" href="#sidewidgetarea" class="closed"> <span> <i class="lines-button x2"> <i class="lines"></i> </i> </span> </a> </div> 
       					</div>
					<?php }
					
					if (!empty($options['enable-cart']) && $options['enable-cart'] == '1') { 
						if ($woocommerce) { ?> 
							<!--mobile cart link-->
							<a id="mobile-cart-link" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="icon-salient-cart"></i></a>
						<?php } 
					} 
					
					if($sideWidgetArea == '1') { ?>
						<div class="slide-out-widget-area-toggle mobile-icon <?php echo $sideWidgetClass; ?>" data-icon-animation="simple-transform">
							<div> <a href="#sidewidgetarea" class="closed"> <span> <i class="lines-button x2"> <i class="lines"></i> </i> </span> </a> </div> 
       					</div>
					<?php } ?>
					
					<nav>
						<ul class="buttons" data-user-set-ocm="<?php echo $userSetSideWidgetArea; ?>">
							<li id="search-btn"><div><a href="#searchbox"><span class="icon-salient-search" aria-hidden="true"></span></a></div> </li>
						
							<?php if($sideWidgetArea == '1') { ?>
								<li class="slide-out-widget-area-toggle" data-icon-animation="<?php echo $sideWidgetIconAnimation; ?>">
									<div> <a href="#sidewidgetarea" class="closed"> <span> <i class="lines-button x2"> <i class="lines"></i> </i> </span> </a> </div> 
       							</li>
							<?php } ?>
						</ul>
						<ul class="sf-menu">	
							<?php 
							if($has_main_menu == 'true') {
							    wp_nav_menu( array('walker' => new Nectar_Arrow_Walker_Nav_Menu, 'theme_location' => 'top_nav', 'container' => '', 'items_wrap' => '%3$s' ) ); 
							} else {
								echo '<li class="no-menu-assigned"><a href="#">No menu assigned</a></li>';
							}

							if(!empty($options['enable_social_in_header']) && $options['enable_social_in_header'] == '1' && $using_secondary != 'header_with_secondary') {
								echo '<li id="social-in-menu" class="button_social_group">';
								nectar_header_social_icons('main-nav');
								echo '</li>';
							}
							?>
						</ul>
						
					</nav>
					
				</div><!--/span_9-->
			
			</div><!--/row-->
			
		</div><!--/container-->
		
	</header>
	
	
	<?php if (!empty($options['enable-cart']) && $options['enable-cart'] == '1') { ?>
		<?php
		if ($woocommerce) { ?>
			
		<div class="cart-outer" data-user-set-ocm="<?php echo $userSetSideWidgetArea; ?>">
			<div class="cart-menu-wrap">
				<div class="cart-menu">
					<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><div class="cart-icon-wrap"><i class="icon-salient-cart"></i> <div class="cart-wrap"><span><?php echo $woocommerce->cart->cart_contents_count; ?> </span></div> </div></a>
				</div>
			</div>
			
			<div class="cart-notification">
				<span class="item-name"></span> <?php echo __('was successfully added to your cart.', NECTAR_THEME_NAME); ?>
			</div>
			
			<?php
				// Check for WooCommerce 2.0 and display the cart widget
				if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
					the_widget( 'WC_Widget_Cart', 'title= ' );
				} else {
					the_widget( 'WooCommerce_Widget_Cart', 'title= ' );
				}
			?>
				
		</div>
		
	 <?php } 
	 
   } 
   
   
   echo '<div class="ns-loading-cover"></div>';
   
   ?>		
	

</div><!--/header-outer-->

<?php if(!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') { get_template_part('includes/header-search'); } ?> 

<div id="mobile-menu" data-mobile-fixed="<?php echo $mobile_fixed; ?>">
	
	<div class="container">
		<ul>
			<?php 
				if($has_main_menu == 'true' && $mobile_fixed == 'false') {
					
				    wp_nav_menu( array('theme_location' => 'top_nav', 'menu' => 'Top Navigation Menu', 'container' => '', 'items_wrap' => '%3$s' ) ); 
					
					echo '<li id="mobile-search">  
					<form action="'.home_url().'" method="GET">
			      		<input type="text" name="s" value="" placeholder="'.__('Search..', NECTAR_THEME_NAME) .'" />
					</form> 
					</li>';
				}
				else {
					echo '<li><a href="">No menu assigned!</a></li>';
				}
			?>		
		</ul>
	</div>
	
</div>


<div id="ajax-loading-screen" data-disable-fade-on-click="<?php echo (!empty($options['disable-transition-fade-on-click'])) ? $options['disable-transition-fade-on-click'] : '0' ; ?>" data-effect="<?php echo $page_transition_effect; ?>" data-method="<?php echo (!empty($options['transition-method'])) ? $options['transition-method'] : 'ajax' ; ?>">
	
	<?php if($page_transition_effect == 'center_mask_reveal') { ?>
		<span class="mask-top"></span>
		<span class="mask-right"></span>
		<span class="mask-bottom"></span>
		<span class="mask-left"></span>
	<?php } else { ?>
		<span class="loading-icon <?php echo (!empty($options['loading-image-animation']) && !empty($options['loading-image'])) ? $options['loading-image-animation'] : null; ?>"> 
			<?php 
			$loading_icon = (isset($options['loading-icon'])) ? $options['loading-icon'] : 'default';
			$loading_img = (isset($options['loading-image'])) ? nectar_options_img($options['loading-image']) : null;
			if(empty($loading_img)) { 
				if($loading_icon == 'material') {
					echo '<span class="material-icon">
							<div class="spinner">
								<div class="right-side"><div class="bar"></div></div>
								<div class="left-side"><div class="bar"></div></div>
							</div>
							<div class="spinner color-2">
								<div class="right-side"><div class="bar"></div></div>
								<div class="left-side"><div class="bar"></div></div>
							</div>
						</span>';
				} else {
					if(!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') { 
						echo '<span class="default-loading-icon spin"></span>'; 
					} else { 
						echo '<span class="default-skin-loading-icon"></span>'; 
					} 
				}
			} 
			 ?> 
		</span>
	<?php } ?>
</div>

<div id="ajax-content-wrap">

<?php 
	if($sideWidgetArea == '1' && $sideWidgetClass == 'fullscreen') echo '<div class="blurred-wrap">'; 
?>

