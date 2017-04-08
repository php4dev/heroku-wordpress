<?php 

#-----------------------------------------------------------------#
# Default theme constants
#-----------------------------------------------------------------#
define('NECTAR_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/nectar/');
define('NECTAR_THEME_NAME', 'salient');

#-----------------------------------------------------------------#
# Load text domain
#-----------------------------------------------------------------#

add_action('after_setup_theme', 'lang_setup');
function lang_setup(){
	
	load_theme_textdomain(NECTAR_THEME_NAME, get_template_directory() . '/lang');
	
}

#-----------------------------------------------------------------#
# Register/Enqueue JS
#-----------------------------------------------------------------#

$options = get_nectar_theme_options(); 
$nectar_get_template_directory_uri = get_template_directory_uri();

function nectar_register_js() {	
	
	global $options;
	global $post;
	global $nectar_get_template_directory_uri;

	if (!is_admin()) { 
		
		// Register 
		wp_register_script('modernizer', $nectar_get_template_directory_uri . '/js/modernizr.js', 'jquery', '2.6.2');
		wp_register_script('respond', $nectar_get_template_directory_uri . '/js/respond.js', 'jquery', '1.1', TRUE);
		wp_register_script('superfish', $nectar_get_template_directory_uri . '/js/superfish.js', 'jquery', '1.4.8', TRUE);
		wp_register_script('respond', $nectar_get_template_directory_uri . '/js/respond.js', 'jquery', '1.1',TRUE);
		wp_register_script('touchswipe', $nectar_get_template_directory_uri . '/js/touchswipe.min.js', 'jquery', '1.0', TRUE);
		wp_register_script('flexslider', $nectar_get_template_directory_uri . '/js/flexslider.min.js', array('jquery', 'touchswipe'), '2.1', TRUE);
		wp_register_script('orbit', $nectar_get_template_directory_uri . '/js/orbit.js', 'jquery', '1.4', TRUE);
		wp_register_script('flickity', $nectar_get_template_directory_uri . '/js/flickity.min.js', 'jquery', '1.1.1', TRUE);
		wp_register_script('nicescroll', $nectar_get_template_directory_uri . '/js/nicescroll.js', 'jquery', '3.5.4' ,TRUE);
		wp_register_script('sticky', $nectar_get_template_directory_uri . '/js/sticky.js', 'jquery', '1.0', TRUE);
		wp_register_script('nectar_prettyPhoto', $nectar_get_template_directory_uri . '/js/prettyPhoto.js', 'jquery', '7.0.1', TRUE);
		wp_register_script('magnific', $nectar_get_template_directory_uri . '/js/magnific.js', 'jquery', '7.0.1', TRUE);
		wp_register_script('nectar_parallax', $nectar_get_template_directory_uri . '/js/parallax.js', 'jquery', '1.0', TRUE);
		wp_register_script('isotope', $nectar_get_template_directory_uri . '/js/isotope.min.js', 'jquery', '7.5' ,TRUE);
		wp_register_script('select2', $nectar_get_template_directory_uri . '/js/select2.min.js', 'jquery', '3.5.2' ,TRUE);
		wp_register_script('nectarSlider', $nectar_get_template_directory_uri . '/js/nectar-slider.js', 'jquery', '7.5', TRUE);
		wp_register_script('iosSlider', $nectar_get_template_directory_uri . '/js/jquery.iosslider.min.js', 'jquery', '7.5', TRUE);
		wp_register_script('fullPage', $nectar_get_template_directory_uri . '/js/jquery.fullPage.min.js', 'jquery', '7.0.1', TRUE);
		wp_register_script('vivus', $nectar_get_template_directory_uri . '/js/vivus.min.js', 'jquery', '6.0.1', TRUE);
		wp_register_script('nectarParticles', $nectar_get_template_directory_uri . '/js/nectar-particles.js', 'jquery', '6.0.1', TRUE);
		wp_register_script('ajaxify', $nectar_get_template_directory_uri . '/js/ajaxify.js', 'jquery', '7.0', TRUE);
		wp_register_script('tweenmax', $nectar_get_template_directory_uri . '/js/tweenmax.min.js', 'jquery', '1.18.0', TRUE);
		wp_register_script('caroufredsel', $nectar_get_template_directory_uri . '/js/caroufredsel.min.js', array('jquery', 'touchswipe'), '7.0.1', TRUE);
		wp_register_script('owl_carousel', $nectar_get_template_directory_uri . '/js/owl.carousel.min.js', 'jquery', '1.3.3', TRUE);
		wp_register_script('midnight', $nectar_get_template_directory_uri . '/js/midnight.js', 'jquery', '1.0', TRUE);
		wp_register_script('twentytwenty', $nectar_get_template_directory_uri . '/js/jquery.twentytwenty.js', 'jquery', '1.0', TRUE);

		if ( floatval(get_bloginfo('version')) < "3.6" ) {
			wp_register_script('jplayer', $nectar_get_template_directory_uri . '/js/jplayer.min.js', 'jquery', '2.1', TRUE);
		}
		wp_register_script('nectarFrontend', $nectar_get_template_directory_uri . '/js/init.js', array('jquery', 'superfish'), '7.5', TRUE);
		
		// Dequeue
		$lightbox_script = (!empty($options['lightbox_script'])) ? $options['lightbox_script'] : 'pretty_photo';
		//if($lightbox_script == 'pretty_photo') 
			wp_dequeue_script( 'prettyPhoto' );
		
		

		// Enqueue
		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizer');

		////only load for IE8
		if(preg_match('/(?i)msie [2-8]/',$_SERVER['HTTP_USER_AGENT'])) {
			wp_enqueue_script('respond');
		}
		
		$portfolio_extra_content = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_portfolio_extra_content', true) : '';
		$post_content = (isset($post->post_content)) ? $post->post_content : '';

		if(!empty($options['smooth-scrolling']) && $options['smooth-scrolling'] == '1') wp_enqueue_script('nicescroll');
		if(!empty($options['portfolio_sidebar_follow']) && $options['portfolio_sidebar_follow'] == '1' && is_singular('portfolio') ) wp_enqueue_script('sticky'); 
		
		if($lightbox_script == 'pretty_photo')  wp_enqueue_script('nectar_prettyPhoto');
		else if ($lightbox_script == 'magnific') wp_enqueue_script('magnific');

		if(stripos( $post_content, 'nectar_portfolio') !== FALSE || stripos( $portfolio_extra_content, 'nectar_portfolio') !== FALSE ||
		   stripos( $post_content, 'nectar_blog') !== FALSE || stripos( $portfolio_extra_content, 'nectar_blog') !== FALSE || 
		   stripos( $post_content, 'vc_gallery type="image_grid"') !== FALSE || stripos( $portfolio_extra_content, 'vc_gallery type="image_grid"') !== FALSE ||
		   stripos( $post_content, "vc_gallery type='image_grid'") !== FALSE || stripos( $portfolio_extra_content, "vc_gallery type='image_grid'") !== FALSE ||
		   stripos( $post_content, 'type="image_grid"') !== FALSE || stripos( $portfolio_extra_content, 'type="image_grid"') !== FALSE ||
		   stripos( $post_content, "type='image_grid'") !== FALSE || stripos( $portfolio_extra_content, "type='image_grid'") !== FALSE || 
		   is_page_template('template-portfolio.php') || is_archive() || is_home() || is_search()) {

			wp_enqueue_script('isotope');
	    }


	    $page_full_screen_rows = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows', true) : '';
	    if($page_full_screen_rows == 'on') wp_enqueue_script('fullPage');

		if ( floatval(get_bloginfo('version')) < "3.6" ) {
			wp_enqueue_script('jplayer');
		}
		
		if(stripos( $post_content, '[recent_projects') !== FALSE || stripos( $portfolio_extra_content, '[recent_projects') !== FALSE
		|| stripos($post_content, '[carousel') !== FALSE || stripos( $portfolio_extra_content, '[carousel') !== FALSE
		|| stripos($post_content, 'carousel="true"') !== FALSE || stripos( $portfolio_extra_content, 'carousel="true"') !== FALSE
		|| stripos($post_content, 'carousel="1"') !== FALSE || stripos( $portfolio_extra_content, 'carousel="1"') !== FALSE
		|| is_page_template('template-home-1.php')) {
			wp_enqueue_script('caroufredsel');	
		}

		if( stripos( $post_content, 'script="owl_carousel"') !== FALSE || stripos( $portfolio_extra_content, 'script="owl_carousel"') !== FALSE ) {
			wp_enqueue_script('owl_carousel');	
		}

		if(!empty($options['header-permanent-transparent']) && $options['header-permanent-transparent'] == '1') {
			wp_enqueue_script('midnight');	
		}

		wp_enqueue_script('nectarFrontend');

		$bg_type = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_slider_bg_type', true) : ''; 
		if(is_singular('post') && (!empty($options['blog_next_post_link']) && $options['blog_next_post_link'] == '1') ||
		   stripos( $post_content, 'project_style="3"') !== FALSE || stripos( $portfolio_extra_content, 'project_style="3"') !== FALSE ||
		   stripos( $post_content, 'project_style="5"') !== FALSE || stripos( $portfolio_extra_content, 'project_style="5"') !== FALSE || 
		   stripos( $post_content, 'gallery_style="3"') !== FALSE || stripos( $portfolio_extra_content, 'gallery_style="3"') !== FALSE ||
		   stripos( $post_content, 'gallery_style="5"') !== FALSE || stripos( $portfolio_extra_content, 'gallery_style="5"') !== FALSE ||
		   stripos( $post_content, "project_style='3'") !== FALSE || stripos( $portfolio_extra_content, "project_style='3'") !== FALSE ||
		   stripos( $post_content, "project_style='5'") !== FALSE || stripos( $portfolio_extra_content, "project_style='5'") !== FALSE || 
		   stripos( $post_content, "gallery_style='3'") !== FALSE || stripos( $portfolio_extra_content, "gallery_style='3'") !== FALSE ||
		   is_page_template('template-portfolio.php') || $bg_type == 'particle_bg' || (get_post_type() == 'portfolio' && is_archive()) ) {
			wp_enqueue_script('tweenmax');
		}

		$transition_method = (!empty($options['transition-method'])) ? $options['transition-method'] : 'ajax';
		if(!empty($options['ajax-page-loading']) && $options['ajax-page-loading'] == '1' && $transition_method == 'ajax') {
			wp_enqueue_script('nectarSlider');
			wp_enqueue_script('fullPage');
			wp_enqueue_script('ajaxify');
		}
		else if(!empty($options['ajax-page-loading']) && $options['ajax-page-loading'] == '1' && $transition_method == 'standard') {
			//simulated ajax workaround will go here
		}


		
	}
}

add_action('wp_enqueue_scripts', 'nectar_register_js');



function nectar_page_specific_js() {
	
	global $post;
	global $options;
	global $nectar_get_template_directory_uri;

	if(!is_object($post)) $post = (object) array('post_content'=>' ', 'ID' => ' ');
    $template_name = get_post_meta( $post->ID, '_wp_page_template', true );
	
	//home
	if ( is_page_template('template-home-1.php') || $template_name == 'salient/template-home-1.php' ||
	     is_page_template('template-home-2.php') || $template_name == 'salient/template-home-2.php' ||
	     is_page_template('template-home-3.php') || $template_name == 'salient/template-home-3.php' ||
	     is_page_template('template-home-4.php') || $template_name == 'salient/template-home-4.php') {
		wp_enqueue_script('orbit');
		wp_enqueue_script('touchswipe');
	}

	////infinite scroll
	$portfolio_extra_content = get_post_meta($post->ID, '_nectar_portfolio_extra_content', true);
	$post_content = $post->post_content;
	$posttype = get_post_type($post);

	if(stripos( $post->post_content, '[nectar_blog') !== FALSE || stripos( $portfolio_extra_content, '[nectar_blog') !== FALSE
	|| stripos( $post->post_content, 'pagination_type="infinite_scroll"') !== FALSE || stripos( $portfolio_extra_content, 'pagination_type="infinite_scroll"') !== FALSE
	|| (!empty($options['blog_pagination_type']) && $options['blog_pagination_type'] == 'infinite_scroll')
	|| (!empty($options['portfolio_pagination_type']) && $options['portfolio_pagination_type'] == 'infinite_scroll')
	|| (((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_tag())) && ( $posttype == 'post') && (!is_singular())) ) {
		

		wp_register_script('infinite_scroll', $nectar_get_template_directory_uri . '/js/infinitescroll.js', array('jquery'), '1.1', TRUE);

		wp_enqueue_script('infinite_scroll');
		
		if ( floatval(get_bloginfo('version')) >= "3.6" ) {
			wp_enqueue_script('wp-mediaelement');
			wp_enqueue_style('wp-mediaelement');
		} 
		
		if (class_exists('WPBakeryVisualComposerAbstract') && defined( 'SALIENT_VC_ACTIVE')) {
			wp_register_script('progressCircle', vc_asset_url('lib/bower/progress-circle/ProgressCircle.min.js'));
       		wp_register_script('vc_pie', vc_asset_url('lib/vc_chart/jquery.vc_chart.min.js'), array('jquery', 'progressCircle'));
			//wp_enqueue_script('vc_pie');
		}

		wp_enqueue_script('flickity');	
			
	}
	
	
	//nectarSlider mediaElement 
	if(stripos( $post_content, '[nectar_slider') !== FALSE || stripos( $portfolio_extra_content, '[nectar_slider') !== FALSE
	|| stripos($post_content, 'type="nectarslider_style"') !== FALSE || stripos( $portfolio_extra_content, 'type="nectarslider_style"') !== FALSE) {
		
		wp_enqueue_script('nectarSlider');	
	}

	//touch swipe
	$box_roll = get_post_meta($post->ID, '_nectar_header_box_roll', true); 
	
	if(stripos($post_content, '[testimonial_slider') !== FALSE || stripos( $portfolio_extra_content, '[testimonial_slider') !== FALSE
	|| stripos($post_content, "[testimonial_slider") !== FALSE || stripos( $portfolio_extra_content, "[testimonial_slider") !== FALSE
	|| $box_roll == 'on') {	
		wp_enqueue_script('touchswipe');	
	}

	//flickity
	if(stripos($post_content, '[vc_gallery type="flickity"') !== FALSE || stripos( $portfolio_extra_content, '[vc_gallery type="flickity"') !== FALSE
	|| stripos($post_content, 'style="multiple_visible"') !== FALSE || stripos( $portfolio_extra_content, 'style="multiple_visible"') !== FALSE
	|| stripos($post_content, 'style="slider"') !== FALSE || stripos( $portfolio_extra_content, 'style="slider"') !== FALSE) {
		
		wp_enqueue_script('flickity');	
	}

	//fancy select
	$fancy_rcs = (!empty($options['form-fancy-select'])) ? $options['form-fancy-select'] : 'default';
	if($fancy_rcs == '1') {
		wp_enqueue_script('select2');		
	}
	
	//svg icon animation
	if(strpos($post_content,'.svg') !== false || strpos($portfolio_extra_content,'.svg') !== false) {
	     wp_enqueue_script('vivus'); 
	       
	}


	//comments
	if ( is_singular() && comments_open() && get_option('thread_comments') )
	wp_enqueue_script('comment-reply');
	
}

add_action('wp_enqueue_scripts', 'nectar_page_specific_js'); 




//Remove wooCommerce prettyPhoto
global $woocommerce;
if($woocommerce) {
	
	function removeWooPrettyPhoto(){
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	    wp_dequeue_script( 'prettyPhoto-init' );
		wp_dequeue_script( 'prettyPhoto' );
	}
	
	add_action( 'wp_enqueue_scripts', 'removeWooPrettyPhoto', 99 );

}

if (!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
    }
    add_action('wp_enqueue_scripts', 'remove_wp_open_sans');

endif;


#-----------------------------------------------------------------#
# Register/Enqueue CSS
#-----------------------------------------------------------------#


//Main Styles
function nectar_main_styles() {	
		 
		 global $nectar_get_template_directory_uri;

		 // Register 
		 wp_register_style('rgs', $nectar_get_template_directory_uri . '/css/rgs.css', '', '6.0.1');
		 wp_register_style('orbit', $nectar_get_template_directory_uri . '/css/orbit.css');
		 wp_register_style('twentytwenty', $nectar_get_template_directory_uri . '/css/twentytwenty.css');
		 wp_register_style('woocommerce', $nectar_get_template_directory_uri . '/css/woocommerce.css','', '7.5');
		 wp_register_style('font-awesome', $nectar_get_template_directory_uri . '/css/font-awesome.min.css');
		 wp_register_style('linea', $nectar_get_template_directory_uri . '/css/fonts/svg/font/arrows_styles.css');
		 wp_register_style("main-styles", $nectar_get_template_directory_uri . "/style.css", '', '7.5');
		 wp_register_style("pretty_photo", $nectar_get_template_directory_uri . "/css/prettyPhoto.css", '', '7.0.1');
		 wp_register_style("magnific", $nectar_get_template_directory_uri . "/css/magnific.css", '', '6.2');
		 wp_register_style("responsive", $nectar_get_template_directory_uri . "/css/responsive.css", '', '7.5');
		 wp_register_style("select2", $nectar_get_template_directory_uri . "/css/select2.css", '', '6.2');
		 wp_register_style("non-responsive", $nectar_get_template_directory_uri . "/css/non-responsive.css");
		 wp_register_style("skin-ascend", $nectar_get_template_directory_uri . "/css/ascend.css", '', '7.5');
		 wp_register_style("box-roll", $nectar_get_template_directory_uri . "/css/box-roll.css");
		 wp_register_style("nectar-ie8", $nectar_get_template_directory_uri . "/css/ie8.css");

		 
		 global $options;

		 $lightbox_script = (!empty($options['lightbox_script'])) ? $options['lightbox_script'] : 'pretty_photo';

		 // Enqueue
		 wp_enqueue_style('rgs'); 
		 wp_enqueue_style('font-awesome'); 
		 wp_enqueue_style('main-styles');
		 if($lightbox_script == 'pretty_photo') wp_enqueue_style('pretty_photo');
		 else if ($lightbox_script == 'magnific') wp_enqueue_style('magnific');
		 wp_enqueue_style('nectar-ie8'); 
		 
		 //responsive
	
		 if( !empty($options['responsive']) && $options['responsive'] == 1 ) { 
			wp_enqueue_style('responsive');
		 } else { 
			wp_enqueue_style('non-responsive');
			
			add_filter('body_class','salient_non_responsive');
			function salient_non_responsive($classes) {
				// add 'class-name' to the $classes array
				$classes[] = 'salient_non_responsive';
				// return the $classes array
				return $classes;
			}
			
		 } 

		 ////Default fonts with extended chars
		 global $options;
		 if(!empty($options['extended-theme-font']) && $options['extended-theme-font'] != '0') {
			wp_enqueue_style( "options_typography_OpenSans_ext", "https://fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C600%2C700&subset=latin%2Clatin-ext", false, null, 'all' );
			
		 }
		 
		 //IE 
		 global $wp_styles;
		 $wp_styles->add_data("nectar-ie8", 'conditional', 'lt IE 9');
		 
		//ajaxify needed 
		$transition_method = (!empty($options['transition-method'])) ? $options['transition-method'] : 'ajax';
		if(!empty($options['ajax-page-loading']) && $options['ajax-page-loading'] == '1' && $transition_method == 'ajax') {
			wp_enqueue_style('wp-mediaelement');
		}
}

add_action('wp_enqueue_scripts', 'nectar_main_styles');


function nectar_page_sepcific_styles() {
	global $post;
	if(!is_object($post)) $post = (object) array('post_content'=>' ', 'ID' => ' ');
	$portfolio_extra_content = get_post_meta($post->ID, '_nectar_portfolio_extra_content', true);
	$post_content = $post->post_content;

	//home
	if ( is_page_template('template-home-1.php') || is_page_template('template-home-2.php') || is_page_template('template-home-3.php') || is_page_template('template-home-4.php')) {
		wp_enqueue_style('orbit'); 
	}
	
	//WooCommerce
    if ( function_exists( 'is_woocommerce' ) ) {
    	wp_enqueue_style('woocommerce'); 
	}

	if(strpos($post_content,'.svg') !== false && strpos($post_content,'icon color="Extra-Color-Gradient-1"') !== false || 
	   strpos($post_content,'.svg') !== false && strpos($post_content,'icon color="Extra-Color-Gradient-2"') !== false ||
	   strpos($post_content,'.svg') !== false && strpos($post_content,"icon color='Extra-Color-Gradient-1'") !== false ||
	   strpos($post_content,'.svg') !== false && strpos($post_content,"icon color='Extra-Color-Gradient-2'") !== false ||
	   strpos($portfolio_extra_content,'.svg') !== false && strpos($portfolio_extra_content,'icon color="Extra-Color-Gradient-1"') !== false ||
	   strpos($portfolio_extra_content,'.svg') !== false && strpos($portfolio_extra_content,'icon color="Extra-Color-Gradient-2"') !== false ||
	   strpos($portfolio_extra_content,'.svg') !== false && strpos($portfolio_extra_content,"icon color='Extra-Color-Gradient-1'") !== false ||
	   strpos($portfolio_extra_content,'.svg') !== false && strpos($portfolio_extra_content,"icon color='Extra-Color-Gradient-2'") !== false ) {
		wp_enqueue_style('linea'); 
	}

	global $options;
	$fancy_rcs = (!empty($options['form-fancy-select'])) ? $options['form-fancy-select'] : 'default';
	if($fancy_rcs == '1') {
		wp_enqueue_style('select2');		
	}

}

add_action('wp_enqueue_scripts', 'nectar_page_sepcific_styles');


$page_transition_bg = (!empty($options['transition-bg-color'])) ? $options['transition-bg-color'] : '#ffffff';
$transition_method = (!empty($options['transition-method'])) ? $options['transition-method'] : 'ajax';
function nectar_page_transition_bg_fix() {
	global $page_transition_bg;
	//set html bg color to match preloading screen to avoid white flash in chrome
	$css = "html:not(.page-trans-loaded) { background-color: ".$page_transition_bg."; }";
	wp_add_inline_style( 'main-styles', $css );

}

if($page_transition_bg != '#ffffff' &&  !empty($options['ajax-page-loading']) && $options['ajax-page-loading'] == '1' && $transition_method == 'standard') add_action('wp_enqueue_scripts', 'nectar_page_transition_bg_fix');


#-----------------------------------------------------------------#
# Dynamic Styles
#-----------------------------------------------------------------#



function nectar_quick_minify( $css ) {

	$css = preg_replace( '/\s+/', ' ', $css );
	
	$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
	
	$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
	
	$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
	
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	
	return trim( $css );

}

if (!function_exists('nectar_colors_css_output')) {
	function nectar_colors_css_output(){
		include('css/colors.php');
	}
}
if (!function_exists('nectar_custom_css_output')) {
	function nectar_custom_css_output(){
		include('css/custom.php');
	}
}

if (!function_exists('nectar_fonts_output')) {
	function nectar_fonts_output(){
		include('css/fonts.php');
	}
}


if (!function_exists('nectar_page_specific_dynamic')) {
	function nectar_page_specific_dynamic(){

		 ob_start(); 

		 echo '<style type="text/css">';

		 ////page header
		 global $post;
		 global $options;

		 $font_color = get_post_meta($post->ID, '_nectar_header_font_color', true);
		 if(!empty($font_color)) {
			 echo '#page-header-bg h1, #page-header-bg .subheader,  .nectar-box-roll .overlaid-content h1, .nectar-box-roll .overlaid-content .subheader, #portfolio-nav a i, .page-header-no-bg h1, body .section-title #portfolio-nav a:hover i, .page-header-no-bg span, #portfolio-nav a i, page-header-bg #portfolio-nav a i, #page-header-bg span { color: '. $font_color .'!important; } ';
			 echo 'body #page-header-bg a.pinterest-share i, body #page-header-bg a.facebook-share i, body #page-header-bg .twitter-share i, body #page-header-bg .google-plus-share i, 
		 	 body #page-header-bg .icon-salient-heart, body #page-header-bg .icon-salient-heart-2 { color: '. $font_color .'; }';
		 }   echo 'body .section-title #portfolio-nav a:hover i { opacity: 0.75; }';

		$logo_height = (!empty($options['use-logo']) && !empty($options['logo-height'])) ? intval($options['logo-height']) : 30;
		$header_padding = (!empty($options['header-padding'])) ? intval($options['header-padding']) : 28;
		$nav_font_size = (!empty($options['use-custom-fonts']) && $options['use-custom-fonts'] == 1 && !empty($options['navigation_font_size']) && $options['navigation_font_size'] != '-') ? intval(substr($options['navigation_font_size'],0,-2) *1.4 ) : 20;
		$dd_indicator_height = (!empty($options['use-custom-fonts']) && $options['use-custom-fonts'] == 1 && !empty($options['navigation_font_size']) && $options['navigation_font_size'] != '-') ? intval(substr($options['navigation_font_size'],0,-2)) -1 : 20;
		
		$padding_top = ceil(($logo_height/2)) - ceil(($nav_font_size/2));
		$padding_bottom = (ceil(($logo_height/2)) - ceil(($nav_font_size/2))) + $header_padding;
		
		$search_padding_top = ceil(($logo_height/2)) - ceil(21/2) +1;
		$search_padding_bottom =  (ceil(($logo_height/2)) - ceil(21/2));
		
		$using_secondary = (!empty($options['header_layout'])) ? $options['header_layout'] : ' ';
		
		if($using_secondary == 'header_with_secondary'){
		 	$header_space = $logo_height + ($header_padding*2) + 34;
		}
		else {
		 	$header_space = $logo_height + ($header_padding*2);
		}
		
		//woo product title
		$wooSocial = ( !empty($options['woo_social']) && $options['woo_social'] == 1 ) ? '1' : '0';
		$wooSocialCount = 0;
		$wooProductTitlePadding = 0;
		
		if($wooSocial == '1') {
			if(!empty($options['woo-facebook-sharing']) && $options['woo-facebook-sharing'] == 1) $wooSocialCount++;
			if(!empty($options['woo-twitter-sharing']) && $options['woo-twitter-sharing'] == 1) $wooSocialCount++;
			if(!empty($options['woo-pinterest-sharing']) && $options['woo-pinterest-sharing'] == 1) $wooSocialCount++;
			if(!empty($options['woo-google-plus-sharing']) && $options['woo-google-plus-sharing'] == 1) $wooSocialCount++;
			if(!empty($options['woo-linkedin-sharing']) && $options['woo-linkedin-sharing'] == 1) $wooSocialCount++;

			$wooProductTitlePadding = ($wooSocialCount*52) + 50;
		}
	

		 //// header transparent option
		if(!empty($options['transparent-header']) && $options['transparent-header'] == '1') {
			
			$starting_color = (empty($options['header-starting-color'])) ? '#ffffff' : $options['header-starting-color'];
			$activate_transparency = using_page_header($post->ID);
			
			echo '
					#header-outer.transparent header#top #logo, #header-outer.transparent header#top #logo:hover {
					 	color: '.$starting_color.'!important;
					 }

					 #header-outer.transparent header#top nav > ul > li > a, 
					 #header-outer.transparent header#top nav ul #search-btn a span.icon-salient-search, 
					 #header-outer.transparent nav > ul > li > a > .sf-sub-indicator [class^="icon-"], 
					 #header-outer.transparent nav > ul > li > a > .sf-sub-indicator [class*=" icon-"],
					 #header-outer.transparent .cart-menu .cart-icon-wrap .icon-salient-cart,
					 .ascend #boxed #header-outer.transparent .cart-menu .cart-icon-wrap .icon-salient-cart
					  {
					 	color: '.$starting_color.'!important;
					 	opacity: 0.75!important;
						transition: opacity 0.2s linear, color 0.2s linear;
					 }
					#header-outer.transparent:not([data-lhe="animated_underline"]) header#top nav > ul > li > a:hover, #header-outer.transparent:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.sfHover > a, #header-outer.transparent:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current_page_ancestor > a, 
					#header-outer.transparent header#top nav .sf-menu > li.current-menu-item > a, #header-outer.transparent:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current-menu-ancestor > a, #header-outer.transparent:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current_page_item > a,
					#header-outer.transparent header#top nav > ul > li > a:hover > .sf-sub-indicator > i, #header-outer.transparent header#top nav > ul > li.sfHover > a > span > i, #header-outer.transparent header#top nav ul #search-btn a:hover span, #header-outer.transparent header#top nav ul .slide-out-widget-area-toggle a:hover span,
					#header-outer.transparent header#top nav .sf-menu > li.current-menu-item > a i, #header-outer.transparent header#top nav .sf-menu > li.current-menu-ancestor > a i,
					#header-outer.transparent .cart-outer:hover .icon-salient-cart, .ascend #boxed #header-outer.transparent .cart-outer:hover .cart-menu .cart-icon-wrap .icon-salient-cart
					
					{
						opacity: 1!important;
						color: '.$starting_color.'!important;
					}

					#header-outer.transparent[data-lhe="animated_underline"] header#top nav > ul > li > a:hover, #header-outer.transparent[data-lhe="animated_underline"] header#top nav .sf-menu > li.sfHover > a,
					 #header-outer.transparent[data-lhe="animated_underline"] header#top nav .sf-menu > li.current-menu-ancestor > a, #header-outer.transparent[data-lhe="animated_underline"] header#top nav .sf-menu > li.current_page_item > a {
						opacity: 1!important;
					}

					#header-outer[data-lhe="animated_underline"].transparent header#top nav > ul > li > a:after, #header-outer.transparent header#top nav>ul>li.button_bordered>a:before {
						border-color: '.$starting_color.'!important;
					}


					#header-outer.transparent:not(.directional-nav-effect) > header#top nav ul .slide-out-widget-area-toggle a i.lines, 
					#header-outer.transparent:not(.directional-nav-effect) > header#top nav ul .slide-out-widget-area-toggle a i.lines:before,
					#header-outer.transparent:not(.directional-nav-effect) > header#top nav ul .slide-out-widget-area-toggle a i.lines:after,
					#header-outer.transparent:not(.directional-nav-effect) > header#top nav ul .slide-out-widget-area-toggle[data-icon-animation="simple-transform"] .lines-button:after,
					#header-outer.transparent.directional-nav-effect > header#top nav ul .slide-out-widget-area-toggle a span.light .lines-button i, #header-outer.transparent.directional-nav-effect > header#top nav ul .slide-out-widget-area-toggle a span.light .lines-button i:after, #header-outer.transparent.directional-nav-effect > header#top nav ul .slide-out-widget-area-toggle a span.light .lines-button i:before,
					#header-outer.transparent:not(.directional-nav-effect) .midnightHeader.nectar-slider header#top nav ul .slide-out-widget-area-toggle a i.lines, 
					#header-outer.transparent:not(.directional-nav-effect) .midnightHeader.nectar-slider header#top nav ul .slide-out-widget-area-toggle a i.lines:before,
					#header-outer.transparent:not(.directional-nav-effect) .midnightHeader.nectar-slider header#top nav ul .slide-out-widget-area-toggle a i.lines:after,
					#header-outer.transparent.directional-nav-effect .midnightHeader.nectar-slider header#top nav ul .slide-out-widget-area-toggle a span.light .lines-button i, #header-outer.transparent.directional-nav-effect .midnightHeader.nectar-slider header#top nav ul .slide-out-widget-area-toggle a span.light .lines-button i:after, #header-outer.transparent.directional-nav-effect .midnightHeader.nectar-slider header#top nav ul .slide-out-widget-area-toggle a span.light .lines-button i:before  {
						background-color: '.$starting_color.'!important;
					}
					#header-outer.transparent header#top nav ul .slide-out-widget-area-toggle a i.lines,
					#header-outer.transparent header#top nav ul .slide-out-widget-area-toggle[data-icon-animation="simple-transform"] a i.lines-button:after {
						opacity: 0.75!important;
					}
					#header-outer.transparent.side-widget-open header#top nav ul .slide-out-widget-area-toggle a i.lines,
					#header-outer.transparent header#top nav ul .slide-out-widget-area-toggle[data-icon-animation="simple-transform"] a:hover i.lines-button:after, 
					#header-outer.transparent header#top nav ul .slide-out-widget-area-toggle a:hover i.lines, 
					#header-outer.transparent header#top nav ul .slide-out-widget-area-toggle a:hover i.lines:before,
					#header-outer.transparent header#top nav ul .slide-out-widget-area-toggle a:hover i.lines:after {
						opacity: 1!important;
					}
			';

			$dark_header_color = (!empty($options['header-transparent-dark-color'])) ? $options['header-transparent-dark-color'] : '#000000';

			echo '#header-outer.transparent.dark-slide > header#top nav > ul > li > a, 
			#header-outer.transparent.dark-row > header#top nav > ul > li > a,
			 #header-outer.transparent.dark-slide:not(.directional-nav-effect) > header#top nav ul #search-btn a span, 
			  #header-outer.transparent.dark-row:not(.directional-nav-effect) > header#top nav ul #search-btn a span, 
			 #header-outer.transparent.dark-slide > header#top nav > ul > li > a > .sf-sub-indicator [class^="icon-"], 
			 #header-outer.transparent.dark-slide > header#top nav > ul > li > a > .sf-sub-indicator [class*=" icon-"],
			  #header-outer.transparent.dark-row > header#top nav > ul > li > a > .sf-sub-indicator [class*=" icon-"],
			 #header-outer.transparent.dark-slide:not(.directional-nav-effect) .cart-menu .cart-icon-wrap .icon-salient-cart,
			  #header-outer.transparent.dark-row:not(.directional-nav-effect) .cart-menu .cart-icon-wrap .icon-salient-cart,
			 body.ascend[data-header-color="custom"] #boxed #header-outer.transparent.dark-slide > header#top .cart-outer .cart-menu .cart-icon-wrap i,
			 body.ascend #boxed #header-outer.transparent.dark-slide > header#top .cart-outer .cart-menu .cart-icon-wrap i,
			 #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav > ul > li > a, 
			 #header-outer.transparent.dark-slide:not(.directional-nav-effect) .midnightHeader.nectar-slider header#top nav ul #search-btn a span, 
			 #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav > ul > li > a > .sf-sub-indicator [class^="icon-"], 
			 #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav > ul > li > a > .sf-sub-indicator [class*=" icon-"],
			 #header-outer.transparent.dark-slide:not(.directional-nav-effect) .midnightHeader.nectar-slider header#top .cart-menu .cart-icon-wrap .icon-salient-cart,
			 body.ascend[data-header-color="custom"] #boxed #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top .cart-outer .cart-menu .cart-icon-wrap i,
			 body.ascend #boxed #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top .cart-outer .cart-menu .cart-icon-wrap i{
			 	color: '.$dark_header_color.'!important;
			 }

			#header-outer.transparent.dark-slide:not(.directional-nav-effect) > header#top nav ul .slide-out-widget-area-toggle a .lines-button i, 
			#header-outer.transparent.dark-slide:not(.directional-nav-effect) > header#top nav ul .slide-out-widget-area-toggle a .lines-button i:after,
			#header-outer.transparent.dark-slide:not(.directional-nav-effect) > header#top nav ul .slide-out-widget-area-toggle a .lines-button i:before,
			#header-outer.transparent.dark-slide:not(.directional-nav-effect) .midnightHeader.nectar-slider header#top nav ul .slide-out-widget-area-toggle a .lines-button i, 
			#header-outer.transparent.dark-slide:not(.directional-nav-effect) .midnightHeader.nectar-slider header#top nav ul .slide-out-widget-area-toggle a .lines-button i:after,
			#header-outer.transparent.dark-slide:not(.directional-nav-effect) .midnightHeader.nectar-slider header#top nav ul .slide-out-widget-area-toggle a .lines-button i:before,
			#header-outer.transparent.dark-slide:not(.directional-nav-effect) > header#top nav ul .slide-out-widget-area-toggle[data-icon-animation="simple-transform"] .lines-button:after,
			#header-outer.transparent.dark-slide:not(.directional-nav-effect) .midnightHeader.nectar-slider header#top nav ul .slide-out-widget-area-toggle[data-icon-animation="simple-transform"] .lines-button:after  {
				background-color: '.$dark_header_color.'!important;
			}

			#header-outer.transparent.dark-slide > header#top nav > ul > li > a:hover, #header-outer.transparent.dark-slide > header#top nav .sf-menu > li.sfHover > a, #header-outer.transparent.dark-slide > header#top nav .sf-menu > li.current_page_ancestor > a, 
			#header-outer.transparent.dark-slide > header#top nav .sf-menu > li.current-menu-item > a, #header-outer.transparent.dark-slide > header#top nav .sf-menu > li.current-menu-ancestor > a, #header-outer.transparent.dark-slide > header#top nav .sf-menu > li.current_page_item > a,
			#header-outer.transparent.dark-slide > header#top nav > ul > li > a:hover > .sf-sub-indicator > i, #header-outer.transparent.dark-slide > header#top nav > ul > li.sfHover > a > span > i, #header-outer.transparent.dark-slide > header#top nav ul #search-btn a:hover span,
			#header-outer.transparent.dark-slide > header#top nav .sf-menu > li.current-menu-item > a i, #header-outer.transparent.dark-slide > header#top nav .sf-menu > li.current-menu-ancestor > a i,
			#header-outer.transparent.dark-slide  > header#top .cart-outer:hover .icon-salient-cart,
			body.ascend[data-header-color="custom"] #boxed #header-outer.transparent.dark-slide > header#top .cart-outer:hover .cart-menu .cart-icon-wrap i,
			#header-outer.transparent.dark-slide > header#top #logo,
			#header-outer[data-permanent-transparent="1"].transparent.dark-slide .midnightHeader.nectar-slider header#top .span_9 > .slide-out-widget-area-toggle i,
			#header-outer.transparent:not([data-lhe="animated_underline"]).dark-slide header#top nav .sf-menu > li.current_page_item > a,
			#header-outer.transparent:not([data-lhe="animated_underline"]).dark-slide header#top nav .sf-menu > li.current-menu-ancestor > a,
			#header-outer.transparent:not([data-lhe="animated_underline"]).dark-slide header#top nav > ul > li > a:hover, #header-outer.transparent:not([data-lhe="animated_underline"]).dark-slide header#top nav .sf-menu > li.sfHover > a,
			#header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav > ul > li > a:hover, #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav .sf-menu > li.sfHover > a, #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav .sf-menu > li.current_page_ancestor > a, 
			#header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav .sf-menu > li.current-menu-item > a, #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav .sf-menu > li.current-menu-ancestor > a, #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav .sf-menu > li.current_page_item > a,
			#header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav > ul > li > a:hover > .sf-sub-indicator > i, #header-outer.transparent.dark-slide header#top nav > ul > li.sfHover > a > span > i, #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav ul #search-btn a:hover span,
			#header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav .sf-menu > li.current-menu-item > a i, #header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top nav .sf-menu > li.current-menu-ancestor > a i,
			#header-outer.transparent.dark-slide  .midnightHeader.nectar-slider header#top .cart-outer:hover .icon-salient-cart,
			body.ascend[data-header-color="custom"] #boxed #header-outer.transparent.dark-slide > header#top .cart-outer:hover .cart-menu .cart-icon-wrap i,
			#header-outer.transparent.dark-slide .midnightHeader.nectar-slider header#top #logo,
			.swiper-wrapper .swiper-slide[data-color-scheme="dark"] .slider-down-arrow i.icon-default-style[class^="icon-"],
			.slider-prev.dark-cs i, .slider-next.dark-cs i, .swiper-container .dark-cs.slider-prev .slide-count span, .swiper-container .dark-cs.slider-next .slide-count span {
				color: '.$dark_header_color.'!important;
			}
			#header-outer[data-lhe="animated_underline"].transparent.dark-slide header#top nav > ul > li > a:after,
			#header-outer[data-lhe="animated_underline"].transparent:not(.side-widget-open) .midnightHeader.dark header#top nav > ul > li > a:after,
			#header-outer[data-lhe="animated_underline"].transparent:not(.side-widget-open) .midnightHeader.default header#top nav > ul > li > a:after,
			#header-outer.dark-slide.transparent:not(.side-widget-open) header#top nav>ul>li.button_bordered>a:before {
				border-color: '.$dark_header_color.'!important;
			}
			.swiper-container[data-bullet_style="scale"] .slider-pagination.dark-cs .swiper-pagination-switch.swiper-active-switch i,
			.swiper-container[data-bullet_style="scale"] .slider-pagination.dark-cs .swiper-pagination-switch:hover i {
				background-color: '.$dark_header_color.';
			}

			.slider-pagination.dark-cs .swiper-pagination-switch {
				 border: 1px solid '.$dark_header_color.';
				 background-color: transparent;
			}
			.slider-pagination.dark-cs .swiper-pagination-switch:hover {
				background: none repeat scroll 0 0 '.$dark_header_color.';
			}

			.slider-pagination.dark-cs .swiper-active-switch {
				 background: none repeat scroll 0 0 '.$dark_header_color.';
			}
			';

		     $dark_header_color = str_replace("#", "", $dark_header_color);;
			 $darkcolorR = hexdec( substr( $dark_header_color, 0, 2 ) );
			 $darkcolorG = hexdec( substr( $dark_header_color, 2, 2 ) );
			 $darkcolorB = hexdec( substr( $dark_header_color, 4, 2 ) );
			 echo '
			 #fp-nav:not(.light-controls) ul li a span:after { background-color: #'.$dark_header_color.'; }
			 #fp-nav:not(.light-controls) ul li a span { box-shadow: inset 0 0 0 8px rgba('.$darkcolorR.','.$darkcolorG.','.$darkcolorB.',0.3); -webkit-box-shadow: inset 0 0 0 8px rgba('.$darkcolorR.','.$darkcolorG.','.$darkcolorB.',0.3); }
			 body #fp-nav ul li a.active span  { box-shadow: inset 0 0 0 2px rgba('.$darkcolorR.','.$darkcolorG.','.$darkcolorB.',0.8); -webkit-box-shadow: inset 0 0 0 2px rgba('.$darkcolorR.','.$darkcolorG.','.$darkcolorB.',0.8); }';


			if($activate_transparency){
				
				//old IE versions
				echo '.no-rgba #header-space { display: none;  } ';
				
				echo '@media only screen and (min-width: 1000px) {
					
					 #header-space {
					 	 display: none; 
					 } 
					 .nectar-slider-wrap.first-section, .parallax_slider_outer.first-section, .full-width-content.first-section, 
					 .parallax_slider_outer.first-section .swiper-slide .content, .nectar-slider-wrap.first-section .swiper-slide .content, #page-header-bg, .nder-page-header, #page-header-wrap,
					 .full-width-section.first-section {
					 	 margin-top: 0!important;
					 }
					 
					 
					 body #page-header-bg, body #page-header-wrap {
					 	height: '.$header_space.'px;
					 }
					 
					 .swiper-container .slider-prev, .swiper-container .slider-next {
					 	top: 52%!important;	
					 }
					 
					 .first-section .nectar-slider-loading .loading-icon { opacity: 0 }
					 
					 body #search-outer { z-index: 100000; }
					 
					 
			}';
			} else if(!empty($options['header-bg-opacity'])) {
				$header_space_bg_color = (!empty($options['overall-bg-color'])) ? $options['overall-bg-color'] : '#ffffff';
				echo '#header-space { background-color: '.$header_space_bg_color.'}';
			}

		}

		echo '.pagination-navigation { -webkit-filter: url("'.esc_url(get_permalink()).'#goo"); filter: url("'.esc_url(get_permalink()).'#goo"); }';

		global $woocommerce;

		if($woocommerce && $woocommerce->cart->cart_contents_count > 0 && !empty($options['enable-cart']) && $options['enable-cart'] == '1' && !empty($options['header-fullwidth']) && $options['header-fullwidth'] == '1') {
			echo '@media only screen and (min-width: 1080px) {
				#header-outer[data-full-width="true"] header#top nav > ul.product_added.buttons {
			 	 padding-right: 80px!important; 
		        }
		        body:not(.ascend) #header-outer[data-full-width="true"][data-remove-border="true"].transparent header#top nav > ul.product_added .slide-out-widget-area-toggle,
		        body:not(.ascend) #header-outer[data-full-width="true"][data-remove-border="true"].side-widget-open header#top nav > ul.product_added .slide-out-widget-area-toggle {
		          margin-right: -20px!important; 
		    	}
		    }';
		} elseif($woocommerce && !empty($options['enable-cart']) && $options['enable-cart'] == '1' && !empty($options['header-fullwidth']) && $options['header-fullwidth'] == '1') {
			echo '@media only screen and (min-width: 1080px) {
				#header-outer[data-full-width="true"] header#top nav > ul.product_added.buttons {
			 	 padding-right: 80px!important; 
		        }
		        body:not(.ascend) #header-outer[data-full-width="true"][data-remove-border="true"].transparent header#top nav > ul.product_added .slide-out-widget-area-toggle,
		        body:not(.ascend) #header-outer[data-full-width="true"][data-remove-border="true"].side-widget-open header#top nav > ul.product_added .slide-out-widget-area-toggle {
		          margin-right: -20px!important; 
		    	}
		    }';
		}

		if($woocommerce && !empty($options['product_tab_position']) && $options['product_tab_position'] == 'fullwidth') echo '
		 .woocommerce.single-product #single-meta { position: relative!important; top: 0!important; margin: 0; left: 8px; height: auto; } 
		 .woocommerce.single-product #single-meta:after { display: block; content: " "; clear: both; height: 1px;  } 
		 .woocommerce-tabs { margin-top: 40px; clear: both; }
		 @media only screen and (min-width: 1000px) {
			 .woocommerce #reviews #comments, .woocommerce #reviews #review_form_wrapper {  float: left; width: 47%; }
			 .woocommerce #reviews #comments { margin-right: 3%; width: 50%; } 
			 .ascend.woocommerce #respond { margin-top: 0px!important; }
			 .woocommerce .woocommerce-tabs > div { margin-top: 15px!important; }
			 .woocommerce #reviews #reply-title { margin-top: 5px!important; }
		 }';

		if($woocommerce && $woocommerce->cart->cart_contents_count > 0 && !empty($options['enable-cart']) && $options['enable-cart'] == '1') {
			echo '@media only screen and (min-width: 1080px) and (max-width: 1475px) {
			    header#top nav > ul.buttons {
				  padding-right: 20px!important; 
			    } 
				#boxed header#top nav > ul.product_added.buttons {
					padding-right: 0px!important; 
				}
				#search-outer #search #close a {
					right: 110px;
				}
			 }';
		}
		elseif($woocommerce && !empty($options['enable-cart']) && $options['enable-cart'] == '1') {
			echo '@media only screen and (min-width: 1080px) and (max-width: 1475px) {
			    header#top nav > ul.product_added {
				  padding-right: 20px!important; 
			    } 
				#boxed header#top nav > ul.product_added.buttons {
					padding-right: 0px!important; 
				}
				#search-outer #search #close a.product_added {
					right: 110px;
				}
			 }';
		 }

		 //boxed css
		if(!empty($options['boxed_layout']) && $options['boxed_layout'] == '1')  {
			
			$attachment = $options["background-attachment"];
			$position = $options["background-position"];
			$repeat = $options["background-repeat"];
			$background_color = $options["background-color"];
			
			echo 'body {
			 	background-image: url("'.nectar_options_img($options["background_image"]).'");
				background-position: '.$position.';
				background-repeat: '.$repeat.';
				background-color: '.$background_color.'!important;
				background-attachment: '.$attachment.';';
				if(!empty($options["background-cover"]) && $options["background-cover"] == '1') {
					echo 'background-size: cover;
					-moz-background-size: cover;
					-webkit-background-size: cover;
					-o-background-size: cover;';
				}
				
			 echo '}';
		}

		//blog next post coloring
		if(is_singular('post')){

			$next_post = get_previous_post();
			if (!empty( $next_post )) {
				$blog_next_bg_color = get_post_meta($next_post->ID, '_nectar_header_bg_color', true);
				$blog_next_font_color = get_post_meta($next_post->ID, '_nectar_header_font_color', true);
				if(!empty($blog_next_font_color)){
					echo '.blog_next_prev_buttons .col h3, .blog_next_prev_buttons span {  
						color: '.$blog_next_font_color.';
					}';
				}
				if(!empty($blog_next_bg_color)){
					echo '.blog_next_prev_buttons {  
						background-color: '.$blog_next_bg_color.';
					}';
				}
			}
		}

		echo '</style>';

		$dynamic_css = ob_get_contents();
		ob_end_clean();

		echo nectar_quick_minify($dynamic_css);	

	}
}


function generate_options_css() {

	$options = get_nectar_theme_options(); 

	if(!empty($options['external-dynamic-css']) && $options['external-dynamic-css'] == 1){

		$css_dir = get_stylesheet_directory() . '/css/'; // Shorten code, save 1 call
		ob_start(); // Capture all output (output buffering)

		//include css
		nectar_colors_css_output();
		nectar_custom_css_output();
		//if(!empty($options['use-custom-fonts']) && $options['use-custom-fonts'] == 1){
		nectar_fonts_output();
		//}

		$css = ob_get_clean(); // Get generated CSS (output buffering)
		file_put_contents($css_dir . 'dynamic-combined.css', $css, LOCK_EX); // Save it
		
	}
}

function nectar_enqueue_dynamic_css() {
	wp_register_style('dynamic-css', get_stylesheet_directory_uri() . '/css/dynamic-combined.css');
	wp_enqueue_style( 'dynamic-css');
}


//loaded in head
$external_dynamic = (!empty($options['external-dynamic-css']) && $options['external-dynamic-css'] == 1) ? 'on' : 'off';
if($external_dynamic != 'on') {

	add_action('wp_head', 'nectar_colors_css_output');
	add_action('wp_head', 'nectar_custom_css_output');
	add_action('wp_head', 'nectar_fonts_output'); 

} 
//written to static css file
else {
	add_action('wp_enqueue_scripts', 'nectar_enqueue_dynamic_css');

	//handle page specific dynamic 
	add_action('wp_head', 'nectar_page_specific_dynamic');
}


$font_fields = array('navigation_font_family','navigation_dropdown_font_family','page_heading_font_family','page_heading_subtitle_font_family','off_canvas_nav_font_family','off_canvas_nav_subtext_font_family','body_font_family','h1_font_family','h2_font_family','h3_font_family','h4_font_family','h5_font_family','h6_font_family','i_font_family','label_font_family','nectar_slider_heading_font_family','home_slider_caption_font_family','testimonial_font_family','sidebar_footer_h_font_family','team_member_h_font_family','nectar_dropcap_font_family');

if( !function_exists('nectar_lovelo_font')) {
	function nectar_lovelo_font(){
		echo "
		<!-- A font fabric font - http://fontfabric.com/lovelo-font/ -->
		<style> @font-face { font-family: 'Lovelo'; src: url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.eot'); src: url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.eot?#iefix') format('embedded-opentype'), url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.woff') format('woff'),  url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.ttf') format('truetype'), url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.svg#loveloblack') format('svg'); font-weight: normal; font-style: normal; } </style>";
	}
}

foreach($font_fields as $k => $v){
	if(isset($options[$v]['font-family']) && $options[$v]['font-family'] == 'Lovelo, sans-serif') { 
		add_action('wp_head', 'nectar_lovelo_font');
		break;
	}
}
 



#-----------------------------------------------------------------#
# Post formats
#-----------------------------------------------------------------#

add_theme_support( 'post-formats', array('quote','video','audio','gallery','link') );


#-----------------------------------------------------------------#
# Category Custom Meta
#-----------------------------------------------------------------#

include("nectar/meta/category-meta.php");

#-----------------------------------------------------------------#
# Automatic Feed Links
#-----------------------------------------------------------------#

if(function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
}

#-----------------------------------------------------------------#
# Image sizes 
#-----------------------------------------------------------------#

if (!function_exists('nectar_add_image_sizes')) {
	
	function nectar_add_image_sizes(){

		add_theme_support( 'post-thumbnails' );
		add_image_size( 'blog-widget', 50, 50, true ); 
		add_image_size( 'portfolio-thumb', 600, 403, true ); 
		add_image_size( 'portfolio-widget', 100, 100, true ); 

		add_image_size( 'wide', 1000, 500, true );  
		add_image_size( 'regular', 500, 500, true ); 
		add_image_size( 'tall', 500, 1000, true ); 
		add_image_size( 'wide_tall', 1000, 1000, true );
		add_image_size( 'large_featured', 1700, 700, true );  

	}
}

nectar_add_image_sizes();


 function nectar_list_thumbnail_sizes(){
     global $_wp_additional_image_sizes;
     	$sizes = array();
 		foreach( get_intermediate_image_sizes() as $s ){
 			$sizes[ $s ] = array( 0, 0 );
 			if( in_array( $s, array( 'thumbnail', 'medium', 'large' ) ) ){
 				$sizes[ $s ][0] = get_option( $s . '_size_w' );
 				$sizes[ $s ][1] = get_option( $s . '_size_h' );
 			}else{
 				if( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $s ] ) )
 					$sizes[ $s ] = array( $_wp_additional_image_sizes[ $s ]['width'], $_wp_additional_image_sizes[ $s ]['height'], );
 			}
 		}
 
 		foreach( $sizes as $size => $atts ){
 			echo $size . ' ' . implode( 'x', $atts ) . "\n";
 		}
 }


#-----------------------------------------------------------------#
# Custom menu
#-----------------------------------------------------------------#
if ( function_exists( 'register_nav_menus' ) ) {

	$sideWidgetArea = (!empty($options['header-slide-out-widget-area'])) ? $options['header-slide-out-widget-area'] : 'off';
	if($sideWidgetArea == '1') {
		$nectar_menu_arr = array(
		  'top_nav' => 'Top Navigation Menu',
		  'secondary_nav' => 'Secondary Navigation Menu <br /> <small>Will only display if applicable header layout is selected.</small>',
		  'off_canvas_nav' => 'Off Canvas Navigation Menu'
		);
	} else {
		$nectar_menu_arr = array(
		  'top_nav' => 'Top Navigation Menu',
		  'secondary_nav' => 'Secondary Navigation Menu <br /> <small>Will only display if applicable header layout is selected.</small>'
		);
	}
	
	register_nav_menus($nectar_menu_arr);
}	


//dropdown arrows
if ( !function_exists( 'nectar_walker_nav_menu' ) ) {
	function nectar_walker_nav_menu() {

		class Nectar_Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
		    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
		        $id_field = $this->db_fields['id'];
		        global $options;
		        $theme_skin = (!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') ? 'ascend' : 'default';

		        //button styling
		        $button_style = get_post_meta( $element->$id_field, 'menu-item-nectar-button-style', true);
		        if(!empty($button_style))
		        	$element->classes[] = $button_style;

		        if (!empty($children_elements[$element->$id_field]) && $element->menu_item_parent == 0 && $theme_skin !='ascend') { 
		            $element->title =  $element->title . '<span class="sf-sub-indicator"><i class="icon-angle-down"></i></span>'; 
					$element->classes[] = 'sf-with-ul';
		        }
				
				if (!empty($children_elements[$element->$id_field]) && $element->menu_item_parent != 0) { 
		            $element->title =  $element->title . '<span class="sf-sub-indicator"><i class="icon-angle-right"></i></span>'; 
		        }
			    
		        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		    }
		}

	}
}

nectar_walker_nav_menu();



if ( !function_exists( 'nectar_description_walker_nav_menu' ) ) {
	function nectar_description_walker_nav_menu( $item_output, $item, $depth, $args ) {
		if ( 'off_canvas_nav' == $args->theme_location && $item->description ) {
			$item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><small class="nav_desc">' . $item->description . '</small>', $item_output );
		}

		return $item_output;
	}
}

add_filter( 'walker_nav_menu_start_el', 'nectar_description_walker_nav_menu', 10, 4 );




//menu button style option
require_once('nectar/assets/functions/wp-menu-custom-items/menu-item-custom-fields.php');


if(!function_exists('nectar_nav_button_style')) {

	add_action('wp_nav_menu_item_custom_fields', 'nectar_nav_button_style', 10, 4);

	$nectar_custom_menu_fields = array(
		'menu-item-nectar-button-style' => ''
	);

	function nectar_nav_button_style($output, $item, $depth, $args) {

        $item_id = $item->ID;
		$name  = "menu-item-nectar-button-style"; 
		$value = get_post_meta($item_id, $name, true);

        ?>

        <p class="description description-wide">
			<label for="<?php echo $name . "-". $item_id;?>">
				<?php echo __( 'Menu Item Style',NECTAR_THEME_NAME); ?> <br />
				<select id="<?php echo $name . "-". $item_id; ?>" class="widefat edit-menu-item-target" name="<?php echo $name . "[".$item_id."]"; ?>">
					<option value="" <?php selected( $value,  ''); ?>><?php echo __('Standard', NECTAR_THEME_NAME); ?> </option>
					<option value="button_solid_color" <?php selected( $value, 'button_solid_color'); ?>><?php echo __('Button With Solid Color', NECTAR_THEME_NAME); ?> </option>
					<option value="button_bordered" <?php selected( $value, 'button_bordered'); ?>><?php echo __('Button With Border', NECTAR_THEME_NAME); ?> </option>
				</select>
			</label>
		</p>
           
	 <?php }
	
	add_action( 'wp_update_nav_menu_item', 'nectar_nav_button_style_update', 10, 3 );
	function nectar_nav_button_style_update( $menu_id, $menu_item_db_id, $menu_item_args ) {

		global $nectar_custom_menu_fields;
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}
		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		foreach ( $nectar_custom_menu_fields as $key => $label ) {

			// Sanitize
			if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
				// Do some checks here...
				$value = sanitize_text_field($_POST[ $key ][ $menu_item_db_id ]);
			}
			else {
				$value = null;
			}
			
			// Update
			if ( ! is_null( $value ) ) {
				update_post_meta( $menu_item_db_id, $key, $value );
			}
			else {
				delete_post_meta( $menu_item_db_id, $key );
			}
		}
	}


	
}




#-----------------------------------------------------------------#
# TGM
#-----------------------------------------------------------------#

require_once('nectar/tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once('nectar/tgm-plugin-activation/required_plugins.php');

#-----------------------------------------------------------------#
# Nectar VC
#-----------------------------------------------------------------#

//Add Nectar Functionality to VC/*
if (class_exists('WPBakeryVisualComposerAbstract') && defined( 'SALIENT_VC_ACTIVE')) {
	function add_nectar_to_vc(){
		require_once locate_template('/nectar/nectar-vc-addons/nectar-addons.php');
	}

	add_action('init','add_nectar_to_vc', 5);
	add_action('admin_enqueue_scripts', 'nectar_vc_styles');
	
	function nectar_vc_styles() {
		global $nectar_get_template_directory_uri;
		wp_enqueue_style('nectar_vc', $nectar_get_template_directory_uri .'/nectar/nectar-vc-addons/nectar-addons.css', array(), time(), 'all');
	}

} else if (class_exists('WPBakeryVisualComposerAbstract')) {

	function nectar_font_awesome() {
		global $nectar_get_template_directory_uri;
	 	wp_enqueue_style('font-awesome', $nectar_get_template_directory_uri . '/css/font-awesome.min.css');
	}

	if (!is_admin()) { 
		add_action('init','nectar_font_awesome', 99);
	}

}


#-----------------------------------------------------------------#
# Theme Skin
#-----------------------------------------------------------------#

if(!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend'){

	$nectar_theme_skin = 'ascend';

	add_filter('body_class','nectar_theme_skin_class');

	function nectar_theme_skin_class($classes) {
		// add 'class-name' to the $classes array
		$classes[] = 'ascend';
		// return the $classes array
		return $classes;
	}


	function nectar_theme_skin_css(){
		wp_enqueue_style('skin-ascend'); 
	}
	
	add_action('wp_enqueue_scripts', 'nectar_theme_skin_css');

} else {
	$nectar_theme_skin = 'default';
}



#-----------------------------------------------------------------#
# Ajax Search
#-----------------------------------------------------------------#

$ajax_search = (!empty($options['header-disable-ajax-search']) && $options['header-disable-ajax-search'] == '1') ? 'no' : 'yes';

if($ajax_search == 'yes'){
	require_once('nectar/assets/functions/ajax-search/wp-search-suggest.php');
}


#-----------------------------------------------------------------#
# If Using Ajaxify 
#-----------------------------------------------------------------#


function ajaxify_non_cached_scripts( $url ) {
if ( FALSE !== strpos( $url, 'nectar-slider.js' )) { 
	//return "$url' class='always";
}

if( FALSE !== strpos( $url, 'vc_chart.js' )) {
	return "$url' class='always";
}

if( FALSE !== strpos( $url, 'ProgressCircle.js' )){
	return "$url' class='always";
}

// not our file
return $url;

}

if(!empty($options['ajax-page-loading']) && $options['ajax-page-loading'] == '1') {
	add_filter( 'clean_url', 'ajaxify_non_cached_scripts', 11, 1 );
}

#-----------------------------------------------------------------#
# Widget areas
#-----------------------------------------------------------------#
if(function_exists('register_sidebar')) {
	
	register_sidebar(array('name' => 'Blog Sidebar', 'id' => 'blog-sidebar', 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget'  => '</div>', 'before_title'  => '<h4>', 'after_title'   => '</h4>'));
	register_sidebar(array('name' => 'Page Sidebar', 'id' => 'page-sidebar','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget'  => '</div>', 'before_title'  => '<h4>', 'after_title'   => '</h4>'));
	register_sidebar(array('name' => 'WooCommerce Sidebar', 'id' => 'woocommerce-sidebar', 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget'  => '</div>', 'before_title'  => '<h4>', 'after_title'   => '</h4>'));
	
	register_sidebar(array('name' => 'Footer Area 1', 'id' => 'footer-area-1', 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget'  => '</div>', 'before_title'  => '<h4>', 'after_title'   => '</h4>'));
	register_sidebar(array('name' => 'Footer Area 2', 'id' => 'footer-area-2','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget'  => '</div>', 'before_title'  => '<h4>', 'after_title'   => '</h4>'));
	
	global $options; 
	$footerColumns = (!empty($options['footer_columns'])) ? $options['footer_columns'] : '4';
	if($footerColumns == '3' || $footerColumns == '4'){
		register_sidebar(array('name' => 'Footer Area 3', 'id' => 'footer-area-3', 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget'  => '</div>', 'before_title'  => '<h4>', 'after_title'   => '</h4>'));
	}
	if($footerColumns == '4'){
		register_sidebar(array('name' => 'Footer Area 4', 'id' => 'footer-area-4', 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget'  => '</div>', 'before_title'  => '<h4>', 'after_title'   => '</h4>'));
	}

	$sideWidgetArea = (!empty($options['header-slide-out-widget-area'])) ? $options['header-slide-out-widget-area'] : 'off';
	if($sideWidgetArea == '1') {
		register_sidebar(array('name' => 'Off Canvas Menu', 'id' => 'slide-out-widget-area', 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget'  => '</div>', 'before_title'  => '<h4>', 'after_title'   => '</h4>'));
	}

}

#-----------------------------------------------------------------#
# Custom widgets
#-----------------------------------------------------------------#

//Recent Posts Extra
include('includes/custom-widgets/recent-posts-extra-widget.php');

//Recent portfolio items
include('includes/custom-widgets/recent-projects-widget.php');

//allow shortcodes in text widget
add_filter('widget_text', 'do_shortcode');

#-----------------------------------------------------------------#
# Excerpt related 
#-----------------------------------------------------------------#


//excerpt length
if(!function_exists('excerpt_length')){
	function excerpt_length( $length ) {
		
		global $options;
		$excerpt_length = (!empty($options['blog_excerpt_length'])) ? intval($options['blog_excerpt_length']) : 30; 

	    return $excerpt_length;
	}
}

add_filter( 'excerpt_length', 'excerpt_length', 999 );

//custom excerpt ending
if(!function_exists('excerpt_more')){
	function excerpt_more( $more ) {
		return '...';
	}
}
add_filter('excerpt_more', 'excerpt_more');


function nectar_excerpt($limit) {

	if(has_excerpt()) {
		$the_excerpt = get_the_excerpt();
		$the_excerpt = preg_replace('/\[[^\]]+\]/', '', $the_excerpt);  # strip shortcodes, keep shortcode content
	    return wp_trim_words($the_excerpt, $limit);
	} else {
		$the_content = get_the_content();
		$the_content = preg_replace('/\[[^\]]+\]/', '', $the_content);  # strip shortcodes, keep shortcode content
	    return wp_trim_words($the_content, $limit);
	}
}

//fixing filtering for shortcodes
function shortcode_empty_paragraph_fix($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}

add_filter('the_content', 'shortcode_empty_paragraph_fix');


//remove the page jump when clicking read more button
function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');



if(!function_exists('nectar_auto_gallery_lightbox')){
	function nectar_auto_gallery_lightbox($content){
		
		preg_match_all('/<a(.*?)href=(?:\'|")([^<]*?).(bmp|gif|jpeg|jpg|png)(?:\'|")(.*?)>/i', $content, $links);
		if(isset($links[0])) {
			$rel_hash = '[gallery-'.wp_generate_password(4, FALSE, FALSE).']';
			
			foreach($links[0] as $id => $link) { 
				if(preg_match('/<a.*?rel=(?:\'|")(.*?)(?:\'|").*?>/', $link, $result) === 1) {
					$content = str_replace($link, preg_replace('/rel=(?:\'|")(.*?)(?:\'|")/', 'rel="prettyPhoto'.$rel_hash, $link), $content);
				}
				else {
					$content = str_replace($link, '<a'.$links[1][$id].'href="'.$links[2][$id].'.'.$links[3][$id].'"'.$links[4][$id].' rel="prettyPhoto'. $rel_hash .'">', $content);
				}
			}
			
		}
		
		return $content;
		
	}
}

if(!empty($options['default-lightbox']) && $options['default-lightbox'] == '1'){
	add_filter('the_content', 'nectar_auto_gallery_lightbox');
	
	add_filter('body_class','nectar_auto_gallery_lightbox_class');
	function nectar_auto_gallery_lightbox_class($classes) {
		// add 'class-name' to the $classes array
		$classes[] = 'nectar-auto-lightbox';
		// return the $classes array
		return $classes;
	}
}


#-----------------------------------------------------------------#
# Add URL option into attachment details for visual composer image gallery element
#-----------------------------------------------------------------#

function nectar_add_attachment_field_credit( $form_fields, $post ) {
    $form_fields['image-url'] = array(
        'label' => 'Image URL',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'nectar_image_gal_url', true ),
        'helps' => ''
    );

     $form_fields['shape-bg-color'] = array(
        'label' => 'BG Color',
        'input' => 'text',
        'value' => esc_attr( get_post_meta( $post->ID, 'nectar_particle_shape_bg_color', true ) ),
        'helps' => 'Enter your color in hex format e.g. "#1ed760'
    );

    $color_mapping = null;
    $color_mapping_options = array('original'=>'Original', 'solid'=>'Solid Color', 'random'=>'Random');
    $meta = get_post_meta( $post->ID, 'nectar_particle_shape_color_mapping', true );
    foreach( $color_mapping_options as $key => $option ) {
		$color_mapping .= '<option value="' . $key . '"';
		if( $meta ){
			if( $meta == $key ) $color_mapping .= ' selected="selected"'; 
		} 
		$color_mapping .=  '>'. $option .'</option>';
	} 

	$density = null;
    $density_options = array('very_low'=>'Very Low', 'low'=>'Low', 'medium'=>'Medium', 'high'=>'High', 'very_high'=>'Very High');
    $meta = get_post_meta( $post->ID, 'nectar_particle_shape_density', true );
    foreach( $density_options as $key => $option ) {
		$density .= '<option value="' . $key . '"';
		if( $meta ){
			if( $meta == $key ) $density .= ' selected="selected"'; 
		} 
		$density .=  '>'. $option .'</option>';
	} 

	$alpha = null;
    $alpha_options = array('original'=>'Original', 'random'=>'Random');
    $meta = get_post_meta( $post->ID, 'nectar_particle_shape_color_alpha', true );
    foreach( $alpha_options as $key => $option ) {
		$alpha .= '<option value="' . $key . '"';
		if( $meta ){
			if( $meta == $key ) $alpha .= ' selected="selected"'; 
		} 
		$alpha .=  '>'. $option .'</option>';
	} 

    $form_fields["shape-color-mapping"] = array(
     	'label' => 'Color Mapping',
     	'input' => 'html',
        'html' => "<select name='attachments[{$post->ID}][shape-color-mapping]' id='attachments[{$post->ID}][shape-color-mapping]'>".$color_mapping."</select>",
		'helps' => '',
		'value' => get_post_meta( $post->ID, 'nectar_particle_shape_color_mapping', true )
	);

	$form_fields["shape-color-alpha"] = array(
     	'label' => 'Color Alpha',
     	'input' => 'html',
        'html' => "<select name='attachments[{$post->ID}][shape-color-alpha]' id='attachments[{$post->ID}][shape-color-alpha]'>".$alpha."</select>",
		'helps' => '',
		'value' => get_post_meta( $post->ID, 'nectar_particle_shape_color_alpha', true )
	);

    $form_fields['shape-particle-color'] = array(
        'label' => 'Particle Color',
        'input' => 'text',
        'value' => esc_attr( get_post_meta( $post->ID, 'nectar_particle_shape_color', true ) ),
        'helps' => 'Will only be used if Color Mapping is set to "Solid Color". Enter your color in hex format e.g. "#1ed760'
    );

	$form_fields["shape-density"] = array(
     	'label' => 'Particle Density',
     	'input' => 'html',
        'html' => "<select name='attachments[{$post->ID}][shape-density]' id='attachments[{$post->ID}][shape-density]'>".$density."</select>",
		'helps' => 'The lower the density, the higher the performance',
		'value' => get_post_meta( $post->ID, 'nectar_particle_shape_density', true )
	);

	$form_fields['shape-max-particle-size'] = array(
        'label' => 'Max Particle Size',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'nectar_particle_max_particle_size', true ),
        'helps' => 'The default is 3'
    );

    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'nectar_add_attachment_field_credit', 10, 2 );

function nectar_add_attachment_field_credit_save( $post, $attachment ) {
    if( isset( $attachment['image-url'] ) )
    update_post_meta( $post['ID'], 'nectar_image_gal_url', $attachment['image-url'] );
	
	if( isset( $attachment['shape-bg-color'] ) )
    update_post_meta( $post['ID'], 'nectar_particle_shape_bg_color', $attachment['shape-bg-color'] );

	if( isset( $attachment['shape-particle-color'] ) )
    update_post_meta( $post['ID'], 'nectar_particle_shape_color', $attachment['shape-particle-color'] );

	if( isset( $attachment['shape-color-mapping'] ) )
    update_post_meta( $post['ID'], 'nectar_particle_shape_color_mapping', $attachment['shape-color-mapping'] );

	if( isset( $attachment['shape-color-alpha'] ) )
    update_post_meta( $post['ID'], 'nectar_particle_shape_color_alpha', $attachment['shape-color-alpha'] );

	if( isset( $attachment['shape-density'] ) )
    update_post_meta( $post['ID'], 'nectar_particle_shape_density', $attachment['shape-density'] );

	if( isset( $attachment['shape-max-particle-size'] ) )
    update_post_meta( $post['ID'], 'nectar_particle_max_particle_size', $attachment['shape-max-particle-size'] );

    return $post;
}
add_filter( 'attachment_fields_to_save', 'nectar_add_attachment_field_credit_save', 10, 2 );



#-----------------------------------------------------------------#
# Custom password form
#-----------------------------------------------------------------#

add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
	global $post;
	$post = get_post( $post );
	$label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
	<p>' . __( 'This content is password protected. To view it please enter your password below:' ) . '</p>
	<p><label for="' . $label . '">' . __( 'Password:' ) . ' </label>  <input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit' ) . '" /></p></form>';
	return $output;
}

#-----------------------------------------------------------------#
# Category Rel Fix
#-----------------------------------------------------------------#

function remove_category_list_rel( $output ) {
    // Remove rel attribute from the category list
    return str_replace( ' rel="category tag"', '', $output );
}
 
add_filter( 'wp_list_categories', 'remove_category_list_rel' );
add_filter( 'the_category', 'remove_category_list_rel' );

#-----------------------------------------------------------------#
# Search related 
#-----------------------------------------------------------------#

if(!function_exists('change_wp_search_size')){
	function change_wp_search_size($query) {
		if ( $query->is_search ) 
			$query->query_vars['posts_per_page'] = 12; 

		return $query; 
	}
}
if(!is_admin()) {
	add_filter('pre_get_posts', 'change_wp_search_size');
}




#-----------------------------------------------------------------#
# Portfolio Exclude External / Custom Grid Content Projects From Next/Prev 
#-----------------------------------------------------------------#

if(!is_admin()) {
	$excluded_projects = array();
	$exlcuded_projects_string = '';
									
	$portfolio = array( 'post_type' => 'portfolio','posts_per_page' => '-1');
	$the_query = new WP_Query($portfolio);
	
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			
			$custom_project_link = get_post_meta($post->ID, '_nectar_external_project_url', true);
			$custom_content_project = get_post_meta($post->ID, '_nectar_portfolio_custom_grid_item', true);

			if(!empty($custom_project_link) || !empty($custom_content_project) && $custom_content_project == 'on') $excluded_projects[] = $post->ID;
		}
	
		
		$exlcuded_projects_string = implode(",", $excluded_projects);
		
		if(!empty($exlcuded_projects_string)){
			add_filter( 'get_previous_post_where', 'so16495117_mod_adjacent_bis' );
			add_filter( 'get_next_post_where', 'so16495117_mod_adjacent_bis' );
		}
	}
	
	wp_reset_postdata();
	
	function so16495117_mod_adjacent_bis( $where ) {
	    global $wpdb;
		global $exlcuded_projects_string;
	    return $where . " AND p.ID NOT IN ($exlcuded_projects_string)";
	}	
}




#-----------------------------------------------------------------#
# Nectar Options Panel Images 
#-----------------------------------------------------------------#
if(!function_exists('fjarrett_get_attachment_id_from_url')){
	function fjarrett_get_attachment_id_from_url( $url ) {
	 
		// Split the $url into two parts with the wp-content directory as the separator.
		$parse_url = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );
		 
		// Get the host of the current site and the host of the $url, ignoring www.
		$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
		$file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );
		 
		// Return nothing if there aren't any $url parts or if the current host and $url host do not match.
		if ( ! isset( $parse_url[1] ) || empty( $parse_url[1] ) || ( $this_host != $file_host ) )
		return;
		 
		// Now we're going to quickly search the DB for any attachment GUID with a partial path match.
		// Example: /uploads/2013/05/test-image.jpg
		global $wpdb;
		 
		$prefix = $wpdb->prefix;
		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM " . $prefix . "posts WHERE guid RLIKE %s;", $parse_url[1] ) );
		 
		return (!empty($attachment)) ? $attachment[0] : null;
	}
}


function nectar_options_img($image_arr_or_str){

	//dummy data import from external
	if(isset($image_arr_or_str['thumbnail']) && strpos($image_arr_or_str['thumbnail'],'http://themenectar.com') !== false && $_SERVER['SERVER_NAME'] != 'themenectar.com') {
 		return $image_arr_or_str['thumbnail'];
	}

	//check if URL or ID is passed
	if(isset($image_arr_or_str['id'])) {
		$image = wp_get_attachment_image_src($image_arr_or_str['id'], 'full');
		return $image[0];
	} 

	else if (isset($image_arr_or_str['url'])) {
		return $image_arr_or_str['url'];
	} 

	else {
		
		$image_id = fjarrett_get_attachment_id_from_url( $image_arr_or_str );

		if(!is_null($image_id) && !empty($image_id)) { 
			$image = wp_get_attachment_image_src($image_id, 'full');
			return $image[0];
		} else {
			return $image_arr_or_str;
		}
	}
}


$nectar_is_ssl = is_ssl();

function nectar_ssl_check($src) {
	
	global $nectar_is_ssl;

	if(strpos($src,'http://') !== false  && $nectar_is_ssl == true) {
		$converted_start = str_replace('http://', 'https://', $src ); 
		return $converted_start;
	}
	
	else 
		return $src;
}	


#-----------------------------------------------------------------#
# Current Page Url
#-----------------------------------------------------------------#
if(!function_exists('current_page_url')){
	function current_page_url() {
		$pageURL = 'http';
		if( isset($_SERVER["HTTPS"]) ) {
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}
#-----------------------------------------------------------------#
# Options panel
#-----------------------------------------------------------------#

$using_nectar_redux_framework = false;

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/nectar/redux-framework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/nectar/redux-framework/ReduxCore/framework.php' );
    $using_nectar_redux_framework = true;
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/nectar/redux-framework/options-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/nectar/redux-framework/options-config.php' );
}

//add nectar redux styling/custom deps
function nectar_redux_deps($hook_suffix) {
	global $using_nectar_redux_framework;
	if ( strstr($hook_suffix,'Salient') || strstr($hook_suffix,'salient') ) {

		wp_enqueue_style('nectar_redux_admin_style', get_template_directory_uri() .'/nectar/redux-framework/ReduxCore/assets/css/salient-redux-styling.css', array(), time(), 'all');
		
		if($using_nectar_redux_framework == false) {
			wp_enqueue_style('nectar_redux_select_2', get_template_directory_uri() .'/nectar/redux-framework/extensions/vendor_support/vendor/select2/select2.css', array(), time(), 'all');
			wp_enqueue_script('nectar_redux_ace', get_template_directory_uri() .'/nectar/redux-framework/extensions/vendor_support/vendor/ace_editor/ace.js', array(), time(), 'all');
		}

	}
}
add_action('admin_enqueue_scripts', 'nectar_redux_deps');


function removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}

add_action('init', 'removeDemoModeLink');


if (is_admin()) {

	add_action( 'admin_menu', 'remove_redux_menu',12 );
	function remove_redux_menu() {
	    remove_submenu_page('tools.php','redux-about');
	}

	if( !function_exists('nectar_admin_lovelo_font')) {
		function nectar_admin_lovelo_font(){
			echo "
			<!-- A font fabric font - http://fontfabric.com/lovelo-font/ -->
			<style> @font-face { font-family: 'Lovelo'; src: url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.eot'); src: url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.eot?#iefix') format('embedded-opentype'), url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.woff') format('woff'),  url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.ttf') format('truetype'), url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.svg#loveloblack') format('svg'); font-weight: normal; font-style: normal; } </style>";
		}
	}
	add_action('admin_head', 'nectar_admin_lovelo_font');	

}



	

	

//helper function to grab theme options - to not break legacy users that are upgrading
function get_nectar_theme_options() {

	$legacy_options = get_option('salient');
	$current_options = get_option('salient_redux');

	//use new options
	if(!empty($current_options)) {
		return $current_options;
	} else if(!empty($legacy_options)) {
		return $legacy_options;
	} else {
		return $current_options;
	}
}

if (!function_exists('nectar_logo_output')) {
	function nectar_logo_output($activate_transparency = false, $off_canvas_style = 'slide-out-from-right') {
		
		global $options;

		if(!empty($options['use-logo'])) {
			
			$default_logo_class = ( !empty($options['retina-logo']['id']) || !empty($options['retina-logo']['url']) ) ? 'default-logo' : null;
			$dark_default_class = ( empty($options['header-starting-logo-dark']['id']) && empty($options['header-starting-logo-dark']['url']) ) ? ' dark-version': null; 

			 echo '<img class="stnd '.$default_logo_class. $dark_default_class.'" alt="'. get_bloginfo('name') .'" src="' . nectar_options_img($options['logo']) . '" />';
			 
			 if( !empty($options['retina-logo']['id']) || !empty($options['retina-logo']['url']) ) echo '<img class="retina-logo '.$dark_default_class.'" alt="'. get_bloginfo('name') .'" src="' . nectar_options_img($options['retina-logo']) . '" />';
		 	 
			 //starting logo 
			 if($activate_transparency == 'true' || $off_canvas_style == 'fullscreen-alt'){
			 	 if( !empty($options['header-starting-logo']['id']) || !empty($options['header-starting-logo']['url']) ) echo '<img class="starting-logo '.$default_logo_class.'"  alt="'. get_bloginfo('name') .'" src="' . nectar_options_img($options['header-starting-logo']) . '" />';
				 if( !empty($options['header-starting-retina-logo']['id']) || !empty($options['header-starting-retina-logo']['url']) ) echo '<img class="retina-logo starting-logo" alt="'. get_bloginfo('name') .'" src="' . nectar_options_img($options['header-starting-retina-logo']) . '" />';

				 if( !empty($options['header-starting-logo-dark']['id']) || !empty($options['header-starting-logo-dark']['url']) ) echo '<img class="starting-logo dark-version '.$default_logo_class.'"  alt="'. get_bloginfo('name') .'" src="' . nectar_options_img($options['header-starting-logo-dark']) . '" />';
				 if( !empty($options['header-starting-retina-logo-dark']['id']) || !empty($options['header-starting-retina-logo-dark']['url']) ) echo '<img class="retina-logo starting-logo dark-version " alt="'. get_bloginfo('name') .'" src="' . nectar_options_img($options['header-starting-retina-logo-dark']) . '" />';
				 
			 }
			 
		 } else { echo get_bloginfo('name'); }
	}
}

function nectar_get_full_page_options() {

	global $post;
	
	$page_full_screen_rows = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows', true) : '';
	$page_full_screen_rows_animation = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows_animation', true) : '';
	$page_full_screen_rows_animation_speed = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows_animation_speed', true) : '';
	$page_full_screen_rows_anchors = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows_anchors', true) : '';
	$page_full_screen_rows_dot_navigation = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows_dot_navigation', true) : '';
	$page_full_screen_rows_footer = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows_footer', true) : '';
	$page_full_screen_rows_content_overflow = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows_content_overflow', true) : '';
	$page_full_screen_rows_bg_img_animation = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows_row_bg_animation', true) : ''; 

	$nectar_full_page_options = array(
		'page_full_screen_rows' => $page_full_screen_rows,
		'page_full_screen_rows_animation' => $page_full_screen_rows_animation,
		'page_full_screen_rows_animation_speed' => $page_full_screen_rows_animation_speed,
		'page_full_screen_rows_anchors' => $page_full_screen_rows_anchors,
		'page_full_screen_rows_dot_navigation' => $page_full_screen_rows_dot_navigation,
		'page_full_screen_rows_footer' => $page_full_screen_rows_footer,
		'page_full_screen_rows_content_overflow' => $page_full_screen_rows_content_overflow,
		'page_full_screen_rows_bg_img_animation' => $page_full_screen_rows_bg_img_animation
	);

	return $nectar_full_page_options;
}




function nectar_header_social_icons($location) {
	global $options;

	$social_networks = array(
		'twitter' => 'icon-twitter',
		'facebook' => 'icon-facebook',
		'vimeo' => 'icon-vimeo',
		'pinterest' => 'icon-pinterest',
		'linkedin' => 'icon-linkedin',
		'youtube' => 'icon-youtube-play',
		'tumblr' => 'icon-tumblr',
		'dribbble' => 'icon-dribbble',
		'rss' => 'icon-rss',
		'github' => 'icon-github-alt',
		'google-plus' => 'icon-google-plus',
		'instagram' => 'icon-instagram',
		'stackexchange' => 'icon-stackexchange',
		'soundcloud' => 'icon-soundcloud',
		'flickr' => 'icon-flickr',
		'spotify' => 'icon-salient-spotify',
		'vk' => 'icon-vk',
		'vine' => 'fa-vine',
		'behance' => 'icon-be'
	);
	$social_output_html = '';

	if($location == 'main-nav') {
		$social_link_before = '';
		$social_link_after = '';
	} else {
		$social_link_before = '<li>';
		$social_link_after = '</li>';
	}

	if($location == 'secondary-nav')
		$social_output_html .= '<ul id="social">';

		foreach($social_networks as $network_name => $icon_class) {
			
			if($network_name == 'rss') {
				if(!empty($options['use-'.$network_name.'-icon-header']) && $options['use-'.$network_name.'-icon-header'] == 1) 
					$social_output_html .= $social_link_before.'<a target="_blank" href="'.(!empty($options['rss-url'])) ? $options['rss-url'] : get_bloginfo('rss_url').'"><i class="'.$icon_class.'"></i> </a>'.$social_link_after;
			}
			else {
				if(!empty($options['use-'.$network_name.'-icon-header']) && $options['use-'.$network_name.'-icon-header'] == 1) 
					$social_output_html .= $social_link_before.'<a target="_blank" href="'.$options[$network_name."-url"].'"><i class="'.$icon_class.'"></i> </a>'.$social_link_after;
			}
		}

	if($location == 'secondary-nav')	
		$social_output_html .= '</ul>';

	echo $social_output_html;
}




#-----------------------------------------------------------------#
# Add multiple thumbnail support                         
#-----------------------------------------------------------------#
if ( floatval(get_bloginfo('version')) < "3.6") { 
	include("nectar/assets/functions/multi-post-thumbnails/multi-post-thumbnails.php");
}




#-----------------------------------------------------------------#
# Nectar love
#-----------------------------------------------------------------#

require_once ( 'nectar/love/nectar-love.php' );


function GetGooglePlusShares($url) {
	if(function_exists('curl_exec') && !empty($url)) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		$curl_results = curl_exec($curl);
		curl_close ($curl);
		$json = json_decode($curl_results, true);
		return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
	} else {
		return 0;
	}
}


#-----------------------------------------------------------------#
# Page meta
#-----------------------------------------------------------------# 

include("nectar/meta/page-meta.php");


#-----------------------------------------------------------------#
# Create admin slider section
#-----------------------------------------------------------------# 
function slider_register() {  
    
	$labels = array(
	 	'name' => __( 'Slides', 'taxonomy general name', NECTAR_THEME_NAME),
		'singular_name' => __( 'Slide', NECTAR_THEME_NAME),
		'search_items' =>  __( 'Search Slides', NECTAR_THEME_NAME),
		'all_items' => __( 'All Slides', NECTAR_THEME_NAME),
		'parent_item' => __( 'Parent Slide', NECTAR_THEME_NAME),
		'edit_item' => __( 'Edit Slide', NECTAR_THEME_NAME),
		'update_item' => __( 'Update Slide', NECTAR_THEME_NAME),
		'add_new_item' => __( 'Add New Slide', NECTAR_THEME_NAME),
	    'menu_name' => __( 'Home Slider', NECTAR_THEME_NAME)
	 );
	 
	 $homeslider_menu_icon = (floatval(get_bloginfo('version')) >= "3.8") ? 'dashicons-admin-home' : NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/icons/home-slider.png';
	 
	 $args = array(
			'labels' => $labels,
			'singular_label' => __('Home Slider', NECTAR_THEME_NAME),
			'public' => true,
			'show_ui' => true,
			'hierarchical' => false,
			'menu_position' => 10,
			'menu_icon' => $homeslider_menu_icon,
			'exclude_from_search' => true,
			'supports' => false
       );  
   
    register_post_type( 'home_slider' , $args );  
}  

add_action('init', 'slider_register');


#-----------------------------------------------------------------#
# Custom slider columns
#-----------------------------------------------------------------# 
 
add_filter('manage_edit-home_slider_columns', 'edit_columns_home_slider');  

function edit_columns_home_slider($columns){  
	$column_thumbnail = array( 'thumbnail' => 'Thumbnail' );
	$column_caption = array( 'caption' => 'Caption' );
	$columns = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
	$columns = array_slice( $columns, 0, 2, true ) + $column_caption + array_slice( $columns, 2, NULL, true );
	return $columns;
}  
  
  
add_action('manage_home_slider_posts_custom_column',  'home_slider_custom_columns', 10, 2);   

function home_slider_custom_columns($portfolio_columns, $post_id){  

	switch ($portfolio_columns) {
	    case 'thumbnail':
	        $thumbnail = get_post_meta($post_id, '_nectar_slider_image', true);
	        
	        if( !empty($thumbnail) ) {
	            echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
	        } else {
	            echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit"><img class="slider-thumb" src="' . NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-thumb.jpg" /></a>' .
	                 '<strong><a class="row-title" href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit">No image added yet</a></strong>';
	        }
	    break; 
		
		case 'caption':
			$caption = get_post_meta($post_id, '_nectar_slider_caption', true);
	        echo $caption;
	    break;  
		
		   
		default:
			break;
	}  
}  


add_action( 'admin_menu', 'nectar_home_slider_ordering' );

function nectar_home_slider_ordering() {
	add_submenu_page(
		'edit.php?post_type=home_slider',
		'Order Slides',
		'Order', 
		'edit_pages', 'slide-order',
		'nectar_home_slider_order_page'
	);
}

function nectar_home_slider_order_page(){ ?>
	
	<div class="wrap">
		<h2><?php echo __('Sort Slides', NECTAR_THEME_NAME); ?></h2>
		<p><?php echo __('Simply drag the slide up or down and they will be saved in that order.', NECTAR_THEME_NAME); ?></p>
	<?php $slides = new WP_Query( array( 'post_type' => 'home_slider', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order' ) ); ?>
	<?php if( $slides->have_posts() ) : ?>
		
		<?php wp_nonce_field( basename(__FILE__), 'nectar_meta_box_nonce' ); ?>
		
		<table class="wp-list-table widefat fixed posts" id="sortable-table">
			<thead>
				<tr>
					<th class="column-order"><?php echo __('Order', NECTAR_THEME_NAME); ?></th>
					<th class="manage-column column-thumbnail"><?php echo __('Image', NECTAR_THEME_NAME); ?></th>
					<th class="manage-column column-caption"><?php echo __('Caption', NECTAR_THEME_NAME); ?></th>
				</tr>
			</thead>
			<tbody data-post-type="home_slider">
			<?php while( $slides->have_posts() ) : $slides->the_post(); ?>
				<tr id="post-<?php the_ID(); ?>">
					<td class="column-order"><img src="<?php echo NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/sortable.png'; ?>" title="" alt="Move Icon" width="25" height="25" class="" /></td>
					<td class="thumbnail column-thumbnail">
						<?php 
						global $post;
						$thumbnail = get_post_meta($post->ID, '_nectar_slider_image', true);
	        
				        if( !empty($thumbnail) ) {
				           echo '<img class="slider-thumb" src="' . $thumbnail . '" />' ;
				        } 
				        else {
				            echo '<img class="slider-thumb" src="' . NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-thumb.jpg" />' .
				                 '<strong>No image added yet</strong>';
				        } ?>
						
					</td>
					<td class="caption column-caption">
						<?php 
						$caption = get_post_meta($post->ID, '_nectar_slider_caption', true);
	        			echo $caption; ?>
					</td>
				</tr>
			<?php endwhile; ?>
			</tbody>
			<tfoot>
				<tr>
					<th class="column-order"><?php echo __('Order', NECTAR_THEME_NAME); ?></th>
					<th class="manage-column column-thumbnail"><?php echo __('Image', NECTAR_THEME_NAME); ?></th>
					<th class="manage-column column-caption"><?php echo __('Caption', NECTAR_THEME_NAME); ?></th>
				</tr>
			</tfoot>

		</table>

	<?php else: ?>

		<p>No slides found, why not <a href="post-new.php?post_type=home_slider">create one?</a></p>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	</div><!-- .wrap -->
	
<?php }


add_action( 'admin_enqueue_scripts', 'home_slider_enqueue_scripts' );

function home_slider_enqueue_scripts() {
	global $typenow;
    if( 'home_slider' == $typenow ) {
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'nectar-reorder', NECTAR_FRAMEWORK_DIRECTORY . 'assets/js/nectar-reorder.js' );
	}
}


add_action( 'wp_ajax_nectar_update_slide_order', 'nectar_update_slide_order' );

//slide order ajax callback 
function nectar_update_slide_order() {
	
	    global $wpdb;
	 	

	    $post_type     = sanitize_text_field($_POST['postType']);
	    $order        = $_POST['order'];
		
		if (  !isset($_POST['nectar_meta_box_nonce']) || !wp_verify_nonce( $_POST['nectar_meta_box_nonce'], basename( __FILE__ ) ) )
			return;
		
	    foreach( $order as $menu_order => $post_id ) {
	        $post_id         = intval( str_ireplace( 'post-', '', $post_id ) );
	        $menu_order     = intval($menu_order);
			
	        wp_update_post( array( 'ID' => stripslashes(htmlspecialchars($post_id)), 'menu_order' => stripslashes(htmlspecialchars($menu_order)) ) );
    	}
 
	    die( '1' );
}


//order the default home slider page correctly 
function set_home_slider_admin_order($wp_query) {  
   
  
    $post_type = $wp_query->query['post_type'];  
  
    if ( $post_type == 'home_slider') {  
   
      $wp_query->set('orderby', 'menu_order');  
      $wp_query->set('order', 'ASC');  
    }  
    
}  

if (is_admin()) { 
	add_filter('pre_get_posts', 'set_home_slider_admin_order'); 
}

#-----------------------------------------------------------------#
# Home slider meta
#-----------------------------------------------------------------# 

include("nectar/meta/home-slider-meta.php");






 


#-----------------------------------------------------------------#
# Create nectar slider section
#-----------------------------------------------------------------# 
function nectar_slider_register() {  
    
	$labels = array(
	 	'name' => __( 'Slides', 'taxonomy general name', NECTAR_THEME_NAME),
		'singular_name' => __( 'Slide', NECTAR_THEME_NAME),
		'search_items' =>  __( 'Search Slides', NECTAR_THEME_NAME),
		'all_items' => __( 'All Slides', NECTAR_THEME_NAME),
		'parent_item' => __( 'Parent Slide', NECTAR_THEME_NAME),
		'edit_item' => __( 'Edit Slide', NECTAR_THEME_NAME),
		'update_item' => __( 'Update Slide', NECTAR_THEME_NAME),
		'add_new_item' => __( 'Add New Slide', NECTAR_THEME_NAME),
	    'menu_name' => __( 'Nectar Slider', NECTAR_THEME_NAME)
	 );
	 
	 $nectarslider_menu_icon = (floatval(get_bloginfo('version')) >= "3.8") ? 'dashicons-star-empty' : NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/icons/nectar-slider.png';
	 
	 $args = array(
			'labels' => $labels,
			'singular_label' => __('Nectar Slider', NECTAR_THEME_NAME),
			'public' => false,
			'show_ui' => true,
			'hierarchical' => false,
			'menu_position' => 10,
			'menu_icon' => $nectarslider_menu_icon,
			'exclude_from_search' => true,
			'supports' => false
       );  
   
    register_post_type( 'nectar_slider' , $args );  
}  
 

$slider_locations_labels = array(
	'name' => __( 'Slider Locations', NECTAR_THEME_NAME),
	'singular_name' => __( 'Slider Location', NECTAR_THEME_NAME),
	'search_items' =>  __( 'Search Slider Locations', NECTAR_THEME_NAME),
	'all_items' => __( 'All Slider Locations', NECTAR_THEME_NAME),
	'edit_item' => __( 'Edit Slider Location', NECTAR_THEME_NAME),
	'update_item' => __( 'Update Slider Location', NECTAR_THEME_NAME),
	'add_new_item' => __( 'Add New Slider Location', NECTAR_THEME_NAME),
	'new_item_name' => __( 'New Slider Location', NECTAR_THEME_NAME),
    'menu_name' => __( 'Slider Locations', NECTAR_THEME_NAME)
); 	
 
register_taxonomy('slider-locations',
	array('nectar_slider'),
	array('hierarchical' => true,
    'labels' => $slider_locations_labels,
    'show_ui' => true,
    'public' => false,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'slider-locations' )
));




add_action('init', 'nectar_slider_register'); 







#-----------------------------------------------------------------#
# Custom slider columns
#-----------------------------------------------------------------# 

add_filter('manage_edit-nectar_slider_columns', 'edit_columns_nectar_slider');  

function edit_columns_nectar_slider($columns){  
	$column_thumbnail = array( 'thumbnail' => 'Thumbnail' );
	$column_caption = array( 'caption' => 'Caption' );
	$columns = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
	$columns = array_slice( $columns, 0, 2, true ) + $column_caption + array_slice( $columns, 2, NULL, true );
	return $columns;
}  
  
  
add_action('manage_nectar_slider_posts_custom_column',  'nectar_slider_custom_columns', 10, 2);  

function nectar_slider_custom_columns($portfolio_columns, $post_id){  

	switch ($portfolio_columns) { 
	    case 'thumbnail':
			
			$background_type = get_post_meta($post_id, '_nectar_slider_bg_type', true);
			if($background_type == 'image_bg') {
				
				$thumbnail = get_post_meta($post_id, '_nectar_slider_image', true);
	        
		        if( !empty($thumbnail) ) {
		            echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
		        } else {
		            echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit"><img class="slider-thumb" src="' . NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-thumb.jpg" /></a>' .
		                 '<strong><a class="row-title" href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit">No image added yet</a></strong>';
		        }
			} 

			else {
				 $thumbnail = get_post_meta($post_id, '_nectar_slider_preview_image', true);
	        
		        if( !empty($thumbnail) ) {
		            echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
		        } else {
		            echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit"><img class="slider-thumb" src="' . NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-video-thumb.jpg" /></a>' .
		                 '<strong><a class="row-title" href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit">No video preview image added yet</a></strong>';
		        }
			}	
			
	        
	    break; 
		
		case 'caption':
			$caption = get_post_meta($post_id, '_nectar_slider_caption', true);
			$heading = get_post_meta($post_id, '_nectar_slider_heading', true);
	        echo '<h2>'.$heading.'</h2><p>'.$caption.'</p>';
	    break;  
		
		   
		default:
			break; 
	}  
}  


add_action( 'admin_menu', 'nectar_slider_ordering' );

function nectar_slider_ordering() {
	add_submenu_page(
		'edit.php?post_type=nectar_slider',
		'Order Slides',
		'Slide Ordering',
		'edit_pages', 'nectar-slide-order',
		'nectar_slider_order_page'
	);
}

function nectar_slider_order_page(){ ?>
	
	<div class="wrap" data-base-url="<?php echo admin_url('edit.php?post_type=nectar_slider&page=nectar-slide-order'); ?>">
		<h2><?php echo __('Sort Slides', NECTAR_THEME_NAME); ?></h2>
		<p><?php echo __('Choose your slider location below and simply drag your slides up or down - they will automatically be saved in that order.', NECTAR_THEME_NAME); ?></p>
		
	<?php 
	(isset($_GET['slider-location'])) ? $location = $_GET['slider-location'] : $location = false ;
	$slides = new WP_Query( array( 'post_type' => 'nectar_slider', 'slider-locations' => $location, 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order' ) ); ?>
	<?php if( $slides->have_posts() ) : ?>
		
		<?php wp_nonce_field( basename(__FILE__), 'nectar_meta_box_nonce' );
		echo '<div class="slider-locations">'; 
		global $typenow;
	    $args=array( 'public' => false, '_builtin' => false ); 
	    $post_types = get_post_types($args);
	    if ( in_array($typenow, $post_types) ) {
	    $filters = get_object_taxonomies($typenow);
	        foreach ($filters as $tax_slug) {
	            $tax_obj = get_taxonomy($tax_slug);
	            wp_dropdown_categories(array(
	                'show_option_all' => 'Slider Locations',
	                'taxonomy' => $tax_slug,
	                'name' => $tax_obj->name,
	                //'orderby' => 'term_order',
	                'selected' => isset($location) ? $location : false,
	                'hierarchical' => $tax_obj->hierarchical,
	                'show_count' => false,
	                'hide_empty' => true
	            ));
	        } 
	    }
		echo '</div>';
		if(isset($location) && $location != false) { 
	    ?>
		
		<table class="wp-list-table widefat fixed posts" id="sortable-table">
			<thead>
				<tr>
					<th class="column-order"><?php echo __('Order', NECTAR_THEME_NAME); ?></th>
					<th class="manage-column column-thumbnail"><?php echo __('Image', NECTAR_THEME_NAME); ?></th>
					<th class="manage-column column-caption"><?php echo __('Caption', NECTAR_THEME_NAME); ?></th>
				</tr>
			</thead>
			<tbody data-post-type="nectar_slider">
			<?php while( $slides->have_posts() ) : $slides->the_post(); ?>
				<tr id="post-<?php the_ID(); ?>">
					<td class="column-order"><img src="<?php echo NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/sortable.png'; ?>" title="" alt="Move Icon" width="25" height="25" class="" /></td>
					<td class="thumbnail column-thumbnail">
						<?php 
						global $post;
						$post_id = $post->ID;
						
						$background_type = get_post_meta($post_id, '_nectar_slider_bg_type', true);
						if($background_type == 'image_bg') {
							
							$thumbnail = get_post_meta($post_id, '_nectar_slider_image', true);
				        
					        if( !empty($thumbnail) ) {
					            echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
					        } else {
					            echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit"><img class="slider-thumb" src="' . NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-thumb.jpg" /></a>' .
					                 '<strong><a class="row-title" href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit">No image added yet</a></strong>';
					        }
						} 
			
						else {
							 $thumbnail = get_post_meta($post_id, '_nectar_slider_preview_image', true);
				        
					        if( !empty($thumbnail) ) {
					            echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
					        } else {
					            echo '<a href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit"><img class="slider-thumb" src="' . NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-video-thumb.jpg" /></a>' .
					                 '<strong><a class="row-title" href="'.get_admin_url() . 'post.php?post=' . $post_id.'&action=edit">No video preview image added yet</a></strong>';
					        }
						}	 ?>
						
					</td>
					<td class="caption column-caption">
						<?php 
						$caption = get_post_meta($post->ID, '_nectar_slider_caption', true);
	        			echo $caption; ?>
					</td>
				</tr>
			<?php endwhile; ?>
			</tbody>
			<tfoot>
				<tr>
					<th class="column-order"><?php echo __('Order', NECTAR_THEME_NAME); ?></th>
					<th class="manage-column column-thumbnail"><?php echo __('Image', NECTAR_THEME_NAME); ?></th>
					<th class="manage-column column-caption"><?php echo __('Caption', NECTAR_THEME_NAME); ?></th>
				</tr>
			</tfoot>

		</table>
	<?php } ?>
	
	<?php else: ?>

		<p>No slides found, why not <a href="post-new.php?post_type=nectar_slider">create one?</a></p>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	</div><!-- .wrap -->
	
<?php }


add_action( 'admin_enqueue_scripts', 'nectar_slider_enqueue_scripts' );

function nectar_slider_enqueue_scripts() {
	global $typenow;
	global $nectar_get_template_directory_uri;
    if( 'nectar_slider' == $typenow) {
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'nectar-reorder', NECTAR_FRAMEWORK_DIRECTORY . 'assets/js/nectar-reorder.js' );
	}	
	
	wp_register_script('chosen', $nectar_get_template_directory_uri . '/nectar/tinymce/shortcode_generator/js/chosen/chosen.jquery.min.js', array('jquery'), time(), true);
	wp_register_style( 'chosen', $nectar_get_template_directory_uri .'/nectar/tinymce/shortcode_generator/css/chosen/chosen.css', array(), time(), 'all');

	wp_enqueue_style('chosen');
	wp_enqueue_script('chosen');
	
}


add_action( 'wp_ajax_nectar_update_slide_order', 'nectar_slider_update_order' );

/*
if(defined('WPCF7_VERSION')) { add_filter( 'wpcf7_form_elements', 'do_shortcode' ); } //allow shortcodes to be used in cf7
*/

//slide order ajax callback 
function nectar_slider_update_order() {
	
	    global $wpdb;
	 
	    $post_type     = sanitize_text_field($_POST['postType']);
	    $order        = $_POST['order'];
		
		if (  !isset($_POST['nectar_meta_box_nonce']) || !wp_verify_nonce( $_POST['nectar_meta_box_nonce'], basename( __FILE__ ) ) )
			return;
		
	    foreach( $order as $menu_order => $post_id ) {
	        $post_id         = intval( str_ireplace( 'post-', '', $post_id ) );
	        $menu_order     = intval($menu_order);
			
	        wp_update_post( array( 'ID' => stripslashes(htmlspecialchars($post_id)), 'menu_order' => stripslashes(htmlspecialchars($menu_order)) ) );
    	}
 
	    die( '1' );
}


//order the default nectar slider page correctly 
function set_nectar_slider_admin_order($wp_query) {  

    $post_type = $wp_query->query['post_type'];  
  
    if ( $post_type == 'nectar_slider') {  
   
      $wp_query->set('orderby', 'menu_order');  
      $wp_query->set('order', 'ASC');  
    }  
  
}  

if (is_admin()) {  
	add_filter('pre_get_posts', 'set_nectar_slider_admin_order'); 
}


function my_restrict_manage_posts() {
    global $typenow;
    $args = array( 'public' => false, '_builtin' => false ); 
    $post_types = get_post_types($args);
    if ( in_array($typenow, $post_types) ) {
    		
    	$filters = get_object_taxonomies($typenow);
		if($typenow != 'product'){
	        foreach ($filters as $tax_slug) {
	            $tax_obj = get_taxonomy($tax_slug);
	            wp_dropdown_categories(array(
	                'show_option_all' => __('Show All '.$tax_obj->label ),
	                'taxonomy' => $tax_slug,
	                'name' => $tax_obj->name,
	                //'orderby' => 'term_order',
	                'selected' => isset($_GET[$tax_obj->query_var]) ? $_GET[$tax_obj->query_var] : false,
	                'hierarchical' => $tax_obj->hierarchical,
	                'show_count' => false,
	                'hide_empty' => true
	            ));
	        }
		}

    }
}
function my_convert_restrict($query) {
    global $pagenow;
    global $typenow;
    if ($pagenow=='edit.php') {
        $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $var = &$query->query_vars[$tax_slug];
            if ( isset($var) ) {
                $term = get_term_by('id',$var,$tax_slug);
				if($term) $var = $term->slug; ;
            }
        }
    }
}
add_action('restrict_manage_posts', 'my_restrict_manage_posts' );
add_filter('parse_query','my_convert_restrict');


 

#-----------------------------------------------------------------#
# Nectar slider meta
#-----------------------------------------------------------------# 

include("nectar/meta/nectar-slider-meta.php");



#-----------------------------------------------------------------#
# Nectar slider display
#-----------------------------------------------------------------# 

$real_fs = 0;


if (!function_exists('nectar_slider_display')) {
	
	function nectar_slider_display($config_arr){
		 
		 global $post;
		 global $options;
		 global $real_fs;
		 
		 $midnight_parallax = null;
	     $midnight_regular = null;

	     //disable parallax for full page
	     $page_full_screen_rows = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows', true) : '';
	     if($page_full_screen_rows == "on")
	     	$config_arr['parallax'] = 'false';

	     $animate_in_effect = (!empty($options['header-animate-in-effect'])) ? $options['header-animate-in-effect'] : 'none';

		 //adding parallax wrapper if selected
		 if($config_arr['parallax'] == 'true') {
	
			 if( stripos( $post->post_content, '[nectar_slider') !== FALSE  && stripos( $post->post_content, '[nectar_slider') === 0  &&  $real_fs == 0) { $first_section = 'first-section';  $real_fs = 1; } else { $first_section = ''; }
	   		 
	   		 $midnight_parallax = 'data-midnight="nectar-slider"';
			 $midnight_regular = null;

			 $slider = '<div style="height: '.$config_arr['slider_height'].'px" '.$midnight_parallax.' class="parallax_slider_outer '.$first_section.'">'; 
		 
		 } else { $slider = ''; }
		 
		 $boxed = (!empty($options['boxed_layout']) && $options['boxed_layout'] == '1') ? '1' : '0';
		if($config_arr['full_width'] == 'true' && $boxed != '1') {  $fullwidth = 'true'; }
		else if($config_arr['full_width'] == 'true' && $boxed == '1') { $fullwidth = 'boxed-full-width'; }
		else { $fullwidth = 'false'; }
		
		if($config_arr['parallax'] != 'true') {
		 	 if( stripos( $post->post_content, '[nectar_slider') !== FALSE  && stripos( $post->post_content, '[nectar_slider') === 0 && $real_fs == 0) { $first_section =  'first-section'; $real_fs = 1; $midnight_parallax = null; $midnight_regular = 'data-midnight="nectar-slider"'; } else { $first_section = ''; }  
		 } else {
		 	 $midnight_parallax = null;
	    	 $midnight_regular = null;
		 	 $first_section = ''; 
		 }
			
			$text_overrides = null;
			if(!empty($config_arr['tablet_header_font_size'])) {
				$text_overrides .= ' data-tho="'.$config_arr['tablet_header_font_size'].'"';
			}
			if(!empty($config_arr['tablet_caption_font_size'])) {
				$text_overrides .= ' data-tco="'.$config_arr['tablet_caption_font_size'].'"';
			}
			if(!empty($config_arr['phone_header_font_size'])) {
				$text_overrides .= ' data-pho="'.$config_arr['phone_header_font_size'].'"';
			}
			if(!empty($config_arr['phone_caption_font_size'])) {
				$text_overrides .= ' data-pco="'.$config_arr['phone_caption_font_size'].'"';
			}

			$slider .= '<div style="height: '.$config_arr['slider_height'].'px" '.$midnight_regular.' data-transition="'.$config_arr['slider_transition'].'" data-overall_style="'.$config_arr['overall_style'].'" data-flexible-height="'.$config_arr['flexible_slider_height'].'" data-animate-in-effect="'.$animate_in_effect.'" data-fullscreen="'.$config_arr['fullscreen'].'" data-button-sizing="'.$config_arr['button_sizing'].'" data-button-styling="'.$config_arr['slider_button_styling'].'" data-autorotate="'.$config_arr['autorotate'].'" data-parallax="'.$config_arr['parallax'].'" data-full-width="'.$fullwidth.'" class="nectar-slider-wrap '.$first_section.'" id="ns-id-'.uniqid().'">
			<div style="height: '.$config_arr['slider_height'].'px" class="swiper-container" '.$text_overrides.' data-loop="'.$config_arr['loop'].'" data-height="'. $config_arr["slider_height"] .'" data-min-height="'.$config_arr['min_slider_height'].'" data-arrows="' . $config_arr["arrow_navigation"].'" data-bullets="'.$config_arr["bullet_navigation"].'" data-bullet_style="'.$config_arr["bullet_navigation_style"].'" data-desktop-swipe="'. $config_arr["desktop_swipe"].'" data-settings="">
				    <div class="swiper-wrapper">';
				     
				      $slide_count = 0;
					  
					  //get slider location by slug instead of raw name
					  $slider_terms = get_term_by('name',$config_arr['location'],'slider-locations');
			
				      //loop through and get all the slides in selected location
				      $slides = new WP_Query( array( 'post_type' => 'nectar_slider', 'tax_query' => array( array( 'taxonomy' => 'slider-locations', 'field' => 'slug', 'terms' => $slider_terms->slug ) ), 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order' ) ); 
					 
					  if( $slides->have_posts() ) :  while( $slides->have_posts() ) : $slides->the_post(); 
					  
						  global $post;
					  	  
						  $background_type = get_post_meta($post->ID, '_nectar_slider_bg_type', true);
						  $background_alignment = get_post_meta($post->ID, '_nectar_slider_slide_bg_alignment', true); 
						  
						  $slide_title = get_post_meta($post->ID, '_nectar_slider_heading', true);
						  
					      $slide_description = get_post_meta($post->ID, '_nectar_slider_caption', true);
						  $slide_description_wrapped = '<span>'.$slide_description.'</span>';
						  $slide_description_bg = get_post_meta($post->ID, '_nectar_slider_caption_background', true);
						  $caption_bg = ( $slide_description_bg == 'on') ? 'class="transparent-bg"' : '';
						  
						  $down_arrow = get_post_meta($post->ID, '_nectar_slider_down_arrow', true);
						   
						  $poster = get_post_meta($post->ID, '_nectar_slider_preview_image', true);
						  $poster_markup = (!empty($poster)) ? 'poster="'.$poster.'"' : null ;
						  
						  $x_pos = get_post_meta($post->ID, '_nectar_slide_xpos_alignment', true); 
					  	  $y_pos = get_post_meta($post->ID, '_nectar_slide_ypos_alignment', true);
						  
						  $link_type = get_post_meta($post->ID, '_nectar_slider_link_type', true);  
						  
						  $full_slide_link = get_post_meta($post->ID, '_nectar_slider_entire_link', true);
						  
						  $button_1_text = get_post_meta($post->ID, '_nectar_slider_button', true); 
						  $button_1_link = get_post_meta($post->ID, '_nectar_slider_button_url', true); 
						  $button_1_style = get_post_meta($post->ID, '_nectar_slider_button_style', true); 
						  $button_1_color = get_post_meta($post->ID, '_nectar_slider_button_color', true); 
					  	  
						  $button_2_text = get_post_meta($post->ID, '_nectar_slider_button_2', true); 
						  $button_2_link = get_post_meta($post->ID, '_nectar_slider_button_url_2', true); 
						  $button_2_style = get_post_meta($post->ID, '_nectar_slider_button_style_2', true); 
						  $button_2_color = get_post_meta($post->ID, '_nectar_slider_button_color_2', true); 
						  
					  	  $video_mp4 = get_post_meta($post->ID, '_nectar_media_upload_mp4', true);
						  $video_webm = get_post_meta($post->ID, '_nectar_media_upload_webm', true);
						  $video_ogv = get_post_meta($post->ID, '_nectar_media_upload_ogv', true); 
						  $video_texture = get_post_meta($post->ID, '_nectar_slider_video_texture', true);  
						  
						  $slide_image = get_post_meta($post->ID, '_nectar_slider_image', true); 
						  $img_bg = null; 
						  
						  $slide_color = get_post_meta($post->ID, '_nectar_slider_slide_font_color', true); 
						  
						  $custom_class = get_post_meta($post->ID, '_nectar_slider_slide_custom_class', true); 
						  $custom_css_class = (!empty($custom_class)) ? ' '.$custom_class : null;
	
						  if($background_type == 'image_bg') { $bg_img_markup = 'style="background-image: url('. nectar_ssl_check($slide_image).');"'; } else { $bg_img_markup = null;}	
						  
						  (!empty($x_pos)) ? $x_pos_markup = $x_pos : $x_pos_markup = 'center';
						  (!empty($y_pos)) ? $y_pos_markup = $y_pos : $y_pos_markup = 'middle';
						  
						                         		                                             
					      $slider .= '<div class="swiper-slide'.$custom_css_class.'" data-bg-alignment="'.$background_alignment.'" data-color-scheme="'. $slide_color .'" data-x-pos="'.$x_pos_markup.'" data-y-pos="'.$y_pos_markup.'"> 
								';
								
								if($background_type == 'image_bg') $slider .='<div class="image-bg" '.$bg_img_markup.'> &nbsp; </div>';

								 if(!empty($slide_title) || !empty($slide_description) || !empty($button_1_text) || !empty($button_2_text)) {
								 	
									 $slider .= '<div class="container">
									<div class="content">';
		
										 if(!empty($slide_title)) { $slider .=  '<h2>'.$slide_title.'</h2>'; } 
										 if(!empty($slide_description)) { $slider .=  '<p '. $caption_bg.' >'. $slide_description_wrapped.'</p>'; } 
										
	
										   if($link_type == 'button_links' && !empty($button_1_text) || $link_type == 'button_links' && !empty($button_2_text)) { 
											$slider .= '<div class="buttons">';
												
												 if(!empty($button_1_text)) {
												 		
												 	$button_1_link = !empty($button_1_link) ? $button_1_link : '#';
													
													//check button link to see if it's a video or googlemap
													$link_extra = null;
													
													if(strpos($button_1_link, 'youtube.com/watch') !== false) $link_extra = 'pp '; 
													if(strpos($button_1_link, 'vimeo.com/') !== false) $link_extra = 'pp '; 
													if(strpos($button_1_link, 'maps.google.com/maps') !== false) $link_extra = 'map-popup '; 
													
													//wrapper for tilt button
													$button_wrap_begin = ($button_1_style == 'solid_color_2') ? "<div class='button-wrap'>": null; 
													$button_wrap_end = ($button_1_style == 'solid_color_2') ? "</div>": null; 

												 	$slider .= 
												 	'<div class="button '.$button_1_style.'">
												 		'.$button_wrap_begin .' <a class="'.$link_extra .$button_1_color .'" href="'.$button_1_link.'">'.$button_1_text.'</a>'. $button_wrap_end.'
												 	 </div>';
												 } 
												 
												
												 if(!empty($button_2_text)) {
												 		
												 	$button_2_link = !empty($button_2_link) ? $button_2_link : '#';
													
													//check button link to see if it's a video or googlemap
													$link_extra = null;
													
													if(strpos($button_2_link, 'youtube.com/watch') !== false) $link_extra = 'pp '; 
													if(strpos($button_2_link, 'vimeo.com/') !== false) $link_extra = 'pp '; 
													if(strpos($button_2_link, 'maps.google.com/maps') !== false) $link_extra = 'map-popup '; 
													
												 	$slider .= 
												 	'<div class="button '.$button_2_style.'">
												 		 <a class="'.$link_extra . $button_2_color .'" href="'.$button_2_link.'">'.$button_2_text.'</a>
												 	 </div>';
												 }
												 
											$slider .= '</div>';
										 } 
	
									$slider .= '</div>
								</div><!--/container-->';
								
								}
								
								if(!empty($down_arrow) && $down_arrow == 'on') { $slider .=  '<a href="#" class="slider-down-arrow"><i class="icon-salient-down-arrow icon-default-style"> <span class="ie-fix"></span> </i></a>'; }  
								

								$active_texture = ($video_texture == 'on') ? 'active_texture' : '';
								$slider .=  '<div class="video-texture '.$active_texture.'"> <span class="ie-fix"></span> </div>';
								
								 if($background_type == 'video_bg') {
								 	 
									$slider .= '
									
									<div class="mobile-video-image" style="background-image: url('.$poster.')"> <span class="ie-fix"></span>  </div>
									<div class="video-wrap">
										
										
										<video class="slider-video" width="1800" height="700" preload="auto" loop>';
	
										    if(!empty($video_webm)) { $slider .= '<source type="video/webm" src="'.$video_webm.'">'; }
										    if(!empty($video_mp4)) { $slider .= '<source type="video/mp4" src="'.$video_mp4.'">'; }
										    if(!empty($video_ogv)) { $slider .= '<source type="video/ogg" src="'. $video_ogv.'">'; }
										  
									$slider .='</video>
										
										
									</div>';
									
								} 
							
							if($link_type == 'full_slide_link' && !empty($full_slide_link)) {
									$slider .= '<a href="'. $full_slide_link.'" class="entire-slide-link"> <span class="ie-fix"></span> </a>';
							}
							
					     $slider .= '</div><!--/swiper-slide-->';
						
						 $slide_count ++; 
						 
				    endwhile; endif;
					
					wp_reset_postdata();
				    
				   $slider .= '</div>';
	
				     if($config_arr['arrow_navigation'] == 'true' && $slide_count > 1 && $config_arr['slider_button_styling'] != 'btn_with_preview' && $config_arr['overall_style'] != 'directional') {

					     $slider .= '<a href="" class="slider-prev"><i class="icon-salient-left-arrow"></i> <div class="slide-count"> <span class="slide-current">1</span> <i class="icon-salient-right-line"></i> <span class="slide-total"></span> </div> </a>
				     		<a href="" class="slider-next"><i class="icon-salient-right-arrow"></i> <div class="slide-count"> <span class="slide-current">1</span> <i class="icon-salient-right-line"></i> <span class="slide-total"></span> </div> </a>';
				      } 

					 else if($config_arr['arrow_navigation'] == 'true' && $slide_count > 1 && $config_arr['slider_button_styling'] == 'btn_with_preview' || $config_arr['overall_style'] == 'directional') {
					     $slider .= '<a href="" class="slider-prev"><i class="icon-angle-left"></i> </a>
				     		<a href="" class="slider-next"><i class="icon-angle-right"></i> </a>';
				      } 

					 if($config_arr['bullet_navigation'] == 'true' && $slide_count > 1){ 
				     	$slider .= '<div class="slider-pagination"></div>';
				     }
				    
				$loading_animation = (!empty($options['loading-image-animation']) && !empty($options['loading-image'])) ? $options['loading-image-animation'] : null; 
				$default_loader = (empty($options['loading-image']) && !empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') ? '<span class="default-loading-icon spin"></span>' : null;
				$default_loader_class = (empty($options['loading-image']) && !empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') ? 'default-loader' : null;
				$slider .= '<div class="nectar-slider-loading '.$default_loader_class.'"> <span class="loading-icon '.$loading_animation.'"> '.$default_loader.'  </span> </div> </div> 
				
			</div>';
		
		if($config_arr['parallax'] == 'true') { $slider .= '</div>'; }
		
		return $slider;
	
	}

}









#-----------------------------------------------------------------#
# Create admin portfolio section
#-----------------------------------------------------------------# 
function portfolio_register() {  
    	 
	 $portfolio_labels = array(
	 	'name' => __( 'Portfolio', 'taxonomy general name', NECTAR_THEME_NAME),
		'singular_name' => __( 'Portfolio Item', NECTAR_THEME_NAME),
		'search_items' =>  __( 'Search Portfolio Items', NECTAR_THEME_NAME),
		'all_items' => __( 'Portfolio', NECTAR_THEME_NAME),
		'parent_item' => __( 'Parent Portfolio Item', NECTAR_THEME_NAME),
		'edit_item' => __( 'Edit Portfolio Item', NECTAR_THEME_NAME),
		'update_item' => __( 'Update Portfolio Item', NECTAR_THEME_NAME),
		'add_new_item' => __( 'Add New Portfolio Item', NECTAR_THEME_NAME)
	 );
	 
	 global $options;
     $custom_slug = null;		
	 
	 if(!empty($options['portfolio_rewrite_slug'])) $custom_slug = $options['portfolio_rewrite_slug'];
	
	 $portolfio_menu_icon = (floatval(get_bloginfo('version')) >= "3.8") ? 'dashicons-art' : NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/icons/portfolio.png';
	
	 $args = array(
			'labels' => $portfolio_labels,
			'rewrite' => array('slug' => $custom_slug,'with_front' => false),
			'singular_label' => __('Project', NECTAR_THEME_NAME),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'hierarchical' => false,
			'menu_position' => 9,
			'menu_icon' => $portolfio_menu_icon,
			'supports' => array('title', 'editor', 'thumbnail', 'comments', 'revisions')  
       );  
  
    register_post_type( 'portfolio' , $args );  
}  
add_action('init', 'portfolio_register');


#-----------------------------------------------------------------#
# Add taxonomys attached to portfolio 
#-----------------------------------------------------------------# 


if (!function_exists('nectar_add_portfolio_taxonomies')) {
	
	function nectar_add_portfolio_taxonomies(){

		$category_labels = array(
			'name' => __( 'Project Categories', NECTAR_THEME_NAME),
			'singular_name' => __( 'Project Category', NECTAR_THEME_NAME),
			'search_items' =>  __( 'Search Project Categories', NECTAR_THEME_NAME),
			'all_items' => __( 'All Project Categories', NECTAR_THEME_NAME),
			'parent_item' => __( 'Parent Project Category', NECTAR_THEME_NAME),
			'edit_item' => __( 'Edit Project Category', NECTAR_THEME_NAME),
			'update_item' => __( 'Update Project Category', NECTAR_THEME_NAME),
			'add_new_item' => __( 'Add New Project Category', NECTAR_THEME_NAME),
		    'menu_name' => __( 'Project Categories', NECTAR_THEME_NAME)
		); 	

		register_taxonomy("project-type", 
				array("portfolio"), 
				array("hierarchical" => true, 
						'labels' => $category_labels,
						'show_ui' => true,
		    			'query_var' => true,
						'rewrite' => array( 'slug' => 'project-type' )
		));

		$attributes_labels = array(
			'name' => __( 'Project Attributes', NECTAR_THEME_NAME),
			'singular_name' => __( 'Project Attribute', NECTAR_THEME_NAME),
			'search_items' =>  __( 'Search Project Attributes', NECTAR_THEME_NAME),
			'all_items' => __( 'All Project Attributes', NECTAR_THEME_NAME),
			'parent_item' => __( 'Parent Project Attribute', NECTAR_THEME_NAME),
			'edit_item' => __( 'Edit Project Attribute', NECTAR_THEME_NAME),
			'update_item' => __( 'Update Project Attribute', NECTAR_THEME_NAME),
			'add_new_item' => __( 'Add New Project Attribute', NECTAR_THEME_NAME),
			'new_item_name' => __( 'New Project Attribute', NECTAR_THEME_NAME),
		    'menu_name' => __( 'Project Attributes', NECTAR_THEME_NAME)
		); 	

		register_taxonomy('project-attributes',
			array('portfolio'),
			array('hierarchical' => true,
		    'labels' => $attributes_labels,
		    'show_ui' => true,
		    'query_var' => true,
		    'rewrite' => array( 'slug' => 'project-attributes' )
		));

	}

}

nectar_add_portfolio_taxonomies();

#-----------------------------------------------------------------#
# Add multiple Post thumbnails
#-----------------------------------------------------------------# 

if ( floatval(get_bloginfo('version')) < "3.6" && class_exists('MultiPostThumbnails')) { 
	
	//Portfolio
	new MultiPostThumbnails( 
		array( 
			'label' => 'Second Image', 
			'id' => 'second-slide', 
			'post_type' => 'portfolio' 
		));
	new MultiPostThumbnails( 
		array( 
			'label' => 'Third Image', 
			'id' => 'third-slide', 
			'post_type' => 'portfolio' 
		));
	new MultiPostThumbnails( 
		array( 
			'label' => 'Fourth Image', 
			'id' => 'fourth-slide', 
			'post_type' => 'portfolio' 
		));
	new MultiPostThumbnails( 
		array( 
			'label' => 'Fifth Image', 
			'id' => 'fifth-slide', 
			'post_type' => 'portfolio' 
		));
	new MultiPostThumbnails( 
		array( 
			'label' => 'Sixth Image', 
			'id' => 'sixth-slide', 
			'post_type' => 'portfolio' 
		));
	
	//Posts
	new MultiPostThumbnails( 
		array( 
			'label' => 'Second Image', 
			'id' => 'second-slide', 
			'post_type' => 'post' 
		));
	new MultiPostThumbnails( 
		array( 
			'label' => 'Third Image', 
			'id' => 'third-slide', 
			'post_type' => 'post' 
		));
	new MultiPostThumbnails( 
		array( 
			'label' => 'Fourth Image', 
			'id' => 'fourth-slide', 
			'post_type' => 'post' 
		));
	new MultiPostThumbnails( 
		array( 
			'label' => 'Fifth Image', 
			'id' => 'fifth-slide', 
			'post_type' => 'post' 
		));
	new MultiPostThumbnails( 
		array( 
			'label' => 'Sixth Image', 
			'id' => 'sixth-slide', 
			'post_type' => 'post' 
		));
	
}



//utility function for nectar shortcode generator conditional
function is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;


    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}


//utility function for WPML duplicate content
if(defined('ICL_LANGUAGE_CODE')) {
	add_filter( 'icl_ls_languages', 'wmpl_duplicate_content_fix' );
	function wmpl_duplicate_content_fix( $languages ) {
		wp_reset_query();
		return $languages;
	}
}


#-----------------------------------------------------------------#
# Portfolio single page controls
#-----------------------------------------------------------------#
function project_single_controls() {

		global $options;
		global $post;

		$back_to_all_override = get_post_meta($post->ID, 'nectar-metabox-portfolio-parent-override', true);
		if(empty($back_to_all_override)) $back_to_all_override = 'default';
		
		//attempt to find parent portfolio page - if unsuccessful default to main portfolio page
		$terms = get_the_terms($post->id,"project-type");
		$project_cat = null;
		$portfolio_link = null; 
		$single_nav_pos = (!empty($options['portfolio_single_nav'])) ? $options['portfolio_single_nav'] : 'in_header';

	    if(empty($terms)) $terms = array('1' => (object) array('name' => 'nothing', 'slug' => 'none'));
		
     	 foreach ( $terms as $term ) {
      	 	$project_cat = strtolower($term->name);
     	 }
		 
		 $page = get_page_by_title_search($project_cat);
		 if(empty($page)) $page = array( '0' => (object) array('ID' => 'nothing'));
		 
		 $page_link = verify_portfolio_page($page[0]->ID);
		
		 //if a page has been found for the category
		 if(!empty($page_link) && $back_to_all_override == 'default') {
		 	$portfolio_link = $page_link; 

		 ?>
			 
			 <div id="portfolio-nav">
			 	<ul>
			 		<li id="all-items"><a href="<?php echo $portfolio_link; ?>"><i class="icon-salient-back-to-all"></i></a></li>               
			 	</ul>
				<ul class="controls">                                 
					<?php if($single_nav_pos == 'after_project') { ?>

						<li id="prev-link"><?php be_next_post_link('%link','<i class="icon-angle-left"></i> <span>' . __("Previous Project", NECTAR_THEMEN_NAME) .'</span>' ,TRUE, null,'project-type'); ?></li>
						<li id="next-link"><?php be_previous_post_link('%link', '<span>'. __('Next Project', NECTAR_THEMEN_NAME) . '</span><i class="icon-angle-right"></i>',TRUE, null, 'project-type'); ?></li> 
				
					<?php } else { ?>

						<li id="prev-link"><?php be_next_post_link('%link','<i class="icon-salient-left-arrow-thin"></i>',TRUE, null,'project-type'); ?></li>
						<li id="next-link"><?php be_previous_post_link('%link','<i class="icon-salient-right-arrow-thin"></i>',TRUE, null, 'project-type'); ?></li> 

					<?php } ?>
					
				</ul>
			</div>
			 
	<?php  } 
		 
		 //if no category page exists
		 else {

		 	$portfolio_link = get_portfolio_page_link(get_the_ID()); 
			if(!empty($options['main-portfolio-link'])) $portfolio_link = $options['main-portfolio-link']; 
			
			if($back_to_all_override != 'default') $portfolio_link = get_page_link($back_to_all_override); 

				
			?>
			<div id="portfolio-nav">
				<ul>
					<li id="all-items"><a href="<?php echo $portfolio_link; ?>" title="<?php echo __('Back to all projects', NECTAR_THEME_NAME); ?>"><i class="icon-salient-back-to-all"></i></a></li>  
				</ul>

				<ul class="controls">    
					<?php 
					if(!empty($options['portfolio_same_category_single_nav']) && $options['portfolio_same_category_single_nav'] == '1') { 

						// get_posts in same custom taxonomy
						$terms = get_the_terms($post->id,"project-type");
						$project_cat = null;
						
					    if(empty($terms)) $terms = array('1' => (object) array('name' => 'nothing', 'slug' => 'none'));
						
				     	foreach ( $terms as $term ) {
				      	 	$project_cat = strtolower($term->slug);
				     	}

						$postlist_args = array(
						   'posts_per_page'  => -1,
						   'orderby'         => 'menu_order title',
						   'order'           => 'ASC',
						   'post_type'       => 'portfolio',
						   'project-type' => $project_cat
						); 
						$postlist = get_posts( $postlist_args );

						// get ids of posts retrieved from get_posts
						$ids = array();
						foreach ($postlist as $thepost) {
						   $ids[] = $thepost->ID;
						}

						// get and echo previous and next post in the same taxonomy        
						$thisindex = array_search($post->ID, $ids);
						
						$previd = (isset($ids[$thisindex-1])) ? $ids[$thisindex-1] : null;
						$nextid = (isset($ids[$thisindex+1])) ? $ids[$thisindex+1] : null;
						if ( !empty($previd) ) {
						  if($single_nav_pos == 'after_project') 
						  	 echo '<li id="prev-link" class="from-sing"><a href="' . get_permalink($previd). '"><i class="icon-angle-left"></i><span>'. __('Previous Project', NECTAR_THEME_NAME) .'</span></a></li>';
						  else
						    echo '<li id="prev-link" class="from-sing"><a href="' . get_permalink($previd). '"><i class="icon-salient-left-arrow-thin"></i></a></li>';
						}
						if ( !empty($nextid) ) {

							 if($single_nav_pos == 'after_project') 
						  	    echo '<li id="next-link" class="from-sing"><a href="' . get_permalink($nextid). '"><span>'. __('Next Project', NECTAR_THEME_NAME) .'</span><i class="icon-angle-right"></i></a></li>';
							else 
							    echo '<li id="next-link" class="from-sing"><a href="' . get_permalink($nextid). '"><i class="icon-salient-right-arrow-thin"></i></a></li>';
						} 

						
					} else { ?>
						<?php if($single_nav_pos == 'after_project') { ?>
							<li id="prev-link"><?php next_post_link('%link','<i class="icon-angle-left"></i><span>'.__('Previous Project', NECTAR_THEME_NAME).'</span>'); ?></li>
							<li id="next-link"><?php previous_post_link('%link', '<span>'. __('Next Project', NECTAR_THEME_NAME).'</span><i class="icon-angle-right"></i>'); ?></li> 
						<?php } else { ?> 
							<li id="prev-link"><?php next_post_link('%link','<i class="icon-salient-left-arrow-thin"></i>'); ?><?php if($single_nav_pos == 'after_project') echo __('Previous Project', NECTAR_THEME_NAME); ?></li>
							<li id="next-link"><?php if($single_nav_pos == 'after_project') echo __('Next Project', NECTAR_THEME_NAME); ?><?php previous_post_link('%link','<i class="icon-salient-right-arrow-thin"></i>'); ?></li> 
						<?php } ?>

					<?php } ?>                                   
				</ul>
			</div>
	 <?php } 
}



#-----------------------------------------------------------------#
# Shortcodes - have to load after taxonomy/post type declarations
#-----------------------------------------------------------------#

function nectar_shortcode_init() {
 	
	if(is_admin()){

		if(is_edit_page()){
			//load nectar shortcode button
			require_once ( 'nectar/tinymce/tinymce-class.php' );		
		}
	}
}

add_action('init', 'nectar_shortcode_init');


//Add button to page
add_action('media_buttons','nectar_buttons',100);

function nectar_buttons() {
     echo "<a data-effect='mfp-zoom-in' class='button nectar-shortcode-generator' href='#nectar-sc-generator'><img src='".get_template_directory_uri()."/nectar/assets/img/icons/n.png' /> ". __('Nectar Shortcodes', NECTAR_THEME_NAME)."</a>";
}


//Shortcode Processing
if (!function_exists('nectar_shortcode_processing')) {
	function nectar_shortcode_processing(){
		require_once ( 'nectar/tinymce/shortcode-processing.php' );
	}
}


add_action('init', 'nectar_shortcode_processing');




#-----------------------------------------------------------------#
# Portfolio Meta
#-----------------------------------------------------------------# 

include("nectar/meta/portfolio-meta.php");


#-----------------------------------------------------------------#
# New category walker for portfolio filter
#-----------------------------------------------------------------# 

class Walker_Portfolio_Filter extends Walker_Category {
	
   function start_el(&$output, $category, $depth = 0, $args = array(), $current_object_id = 0) {

      extract($args);
      $cat_slug = esc_attr( $category->slug );
      $cat_slug = apply_filters( 'list_cats', $cat_slug, $category );
	  
      $link = '<li><a href="#" data-filter=".'.strtolower(preg_replace('/\s+/', '-', $cat_slug)).'">';
	  
	  $cat_name = esc_attr( $category->name );
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
	  	
      $link .= $cat_name;
	  
      if(!empty($category->description)) {
         $link .= ' <span>'.$category->description.'</span>';
      }
	  
      $link .= '</a>';
     
      $output .= $link;
       
   }
}


#-----------------------------------------------------------------#
# Function to get the page link back to all portfolio items
#-----------------------------------------------------------------#

function get_portfolio_page_link($post_id) {
    global $wpdb;
	
	$post_id = sanitize_text_field($post_id);

    $results = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta
    WHERE meta_key='_wp_page_template' AND meta_value='template-portfolio.php'");
    
	//safety net
    $page_id = null;
	 
    foreach ($results as $result) 
    {
        $page_id = $result->post_id;
    }
	
    return get_page_link($page_id);
} 



#-----------------------------------------------------------------#
# Function to get verify that the page has the portfolio layout assigned 
#-----------------------------------------------------------------#

function verify_portfolio_page($post_id) {
    global $wpdb;

    $post_id = sanitize_text_field($post_id);
	
    $result = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta
    WHERE meta_key='_wp_page_template' AND meta_value='template-portfolio.php' AND post_id='$post_id' LIMIT 1");
	
	if(!empty($result)) {
		return get_page_link($result[0]->post_id);
	} else {
		return null;
	}
} 


#-----------------------------------------------------------------#
# Function to find page that contains string
#-----------------------------------------------------------------#

function get_page_by_title_search($string){
    global $wpdb;

    $string = sanitize_text_field($string);
    $title = esc_sql($string); 
    if(!$title) return;
    $page = $wpdb->get_results("
        SELECT * 
        FROM $wpdb->posts
        WHERE post_title LIKE '%$title%'
        AND post_type = 'page' 
        AND post_status = 'publish'
        LIMIT 1
    ");
    return $page;
}


#-----------------------------------------------------------------#
# Post meta
#-----------------------------------------------------------------#

function enqueue_media(){
	
	//enqueue the correct media scripts for the media library 

	if ( floatval(get_bloginfo('version')) < "3.5" ) {
	    wp_enqueue_script(
	        'redux-opts-field-upload-js', 
	        ReduxFramework::$_url . 'inc/fields/upload/field_upload_3_4.js', 
	        array('jquery', 'thickbox', 'media-upload'),
	        time(),
	        true
	    );
	    wp_enqueue_style('thickbox');// thanks to https://github.com/rzepak
	} else {
	   
	}
	
}

//post meta styling
function  nectar_metabox_styles() {
	wp_enqueue_style('nectar_meta_css', NECTAR_FRAMEWORK_DIRECTORY .'assets/css/nectar_meta.css','', '6.5');
}

//post meta scripts
function nectar_metabox_scripts() {
	wp_register_script('nectar-upload', NECTAR_FRAMEWORK_DIRECTORY .'assets/js/nectar-meta.js', array('jquery'), '3.0.5');
	wp_enqueue_script('nectar-upload');
	wp_localize_script('redux-opts-field-upload-js', 'redux_upload', array('url' => get_template_directory_uri() .'/nectar/redux-framework/ReduxCore/inc/fields/upload/blank.png'));
	
	if(floatval(get_bloginfo('version')) >= '3.5') {
	    wp_enqueue_style('wp-color-picker');
	     wp_enqueue_script(
	        'redux-opts-field-upload-js', 
	        get_template_directory_uri() .'/nectar/redux-framework/ReduxCore/inc/fields/upload/field_upload.js', 
	        array('jquery'),
	        time(),
	        true
	    ); 
	    wp_enqueue_script(
	        'redux-opts-field-color-js',
	        NECTAR_FRAMEWORK_DIRECTORY . 'options/fields/color/field_color.js',
	        array('wp-color-picker'),
	        time(),
	        true
	    );
	     wp_enqueue_media();
	} else {

	    wp_enqueue_script(
	        'redux-opts-field-color-js', 
	        NECTAR_FRAMEWORK_DIRECTORY . 'options/fields/color/field_color_farb.js', 
	        array('jquery', 'farbtastic'),
	        time(),
	        true
	    );
	   
	}
	
}

add_action('admin_enqueue_scripts', 'nectar_metabox_scripts');
add_action('admin_print_styles', 'nectar_metabox_styles');
add_action('admin_print_styles', 'enqueue_media');


//post meta core functions
include("nectar/meta/meta-config.php");
include("nectar/meta/post-meta.php");



function nectar_blog_social_sharing() {

	 global $options;
	 global $post;

	 ob_start(); 

	 $fullscreen_header = (!empty($options['blog_header_type']) && $options['blog_header_type'] == 'fullscreen' && is_singular('post')) ? true : false;
	 $fullscreen_class = ($fullscreen_header == true) ? 'hide-share-count': null;
     $blog_header_type = (!empty($options['blog_header_type'])) ? $options['blog_header_type'] : 'default';

	 if( !empty($options['blog_social']) && $options['blog_social'] == 1 || $fullscreen_header == true) { 
										   
		   echo '<div class="nectar-social '.$fullscreen_class.'">';

		  	 if($fullscreen_header == false) {
		  	 	
		  	 	echo '<span class="n-shortcode">'.nectar_love('return').'</span>';

				//facebook
				if(!empty($options['blog-facebook-sharing']) && $options['blog-facebook-sharing'] == 1) { 
					echo "<a class='facebook-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'>  <i class='icon-facebook'></i> <span class='social-text'>".__('Share',NECTAR_THEME_NAME)."</span> <span class='count'></span></a>";
				}
				//twitter
				if(!empty($options['blog-twitter-sharing']) && $options['blog-twitter-sharing'] == 1) {
					echo "<a class='twitter-share nectar-sharing' href='#' title='".__('Tweet this', NECTAR_THEME_NAME)."'> <i class='icon-twitter'></i> <span class='social-text'>".__('Tweet',NECTAR_THEME_NAME)."</span> <span class='count'></span></a>";
				}
				
				//google plus
				if(!empty($options['blog-google-plus-sharing']) && $options['blog-google-plus-sharing'] == 1) {
					echo "<a class='google-plus-share nectar-sharing-alt' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-google-plus'></i> <span class='social-text'>".__('Share',NECTAR_THEME_NAME)."</span> <span class='count'> ".GetGooglePlusShares(get_permalink($post->ID))." </span></a>";
				}
				
				//linkedIn
				if(!empty($options['blog-linkedin-sharing']) && $options['blog-linkedin-sharing'] == 1) {
					echo "<a class='linkedin-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-linkedin'></i> <span class='social-text'>".__('Share',NECTAR_THEME_NAME)."</span> <span class='count'> </span></a>";
				}
				
				//pinterest
				if(!empty($options['blog-pinterest-sharing']) && $options['blog-pinterest-sharing'] == 1) {
					echo "<a class='pinterest-share nectar-sharing' href='#' title='".__('Pin this', NECTAR_THEME_NAME)."'> <i class='icon-pinterest'></i> <span class='social-text'>".__('Pin',NECTAR_THEME_NAME)."</span> <span class='count'></span></a>";
				}
			} else {
				//facebook
				echo "<a class='facebook-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-facebook'></i> <span class='count'></span></a>";
				echo "<a class='twitter-share nectar-sharing' href='#' title='".__('Tweet this', NECTAR_THEME_NAME)."'> <i class='icon-twitter'></i> <span class='count'></span></a>";
				echo "<a class='google-plus-share nectar-sharing-alt' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-google-plus'></i> <span class='count'> ".GetGooglePlusShares(get_permalink($post->ID))." </span></a>";
				echo "<a class='linkedin-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-linkedin'></i> <span class='count'> </span></a>";
				echo "<a class='pinterest-share nectar-sharing' href='#' title='".__('Pin this', NECTAR_THEME_NAME)."'> <i class='icon-pinterest'></i> <span class='count'></span></a>";
				
			}
			
		  echo '</div>';

		}

		$sharing_output = ob_get_contents();
		ob_end_clean();

		echo $sharing_output;
}


function nectar_next_post_display() {

	 global $post;
	 global $options;

	 $post_header_style = (!empty($options['blog_header_type'])) ? $options['blog_header_type'] : 'default'; 

	 ob_start(); 
	 $next_post = get_previous_post();
	 if (!empty( $next_post ) && !empty($options['blog_next_post_link']) && $options['blog_next_post_link'] == '1') { ?>

			<div data-post-header-style="<?php echo $post_header_style; ?>" class="blog_next_prev_buttons wpb_row vc_row-fluid full-width-content standard_section" data-midnight="light">

				<?php 

					$bg = get_post_meta($next_post->ID, '_nectar_header_bg', true);
					$bg_color = get_post_meta($next_post->ID, '_nectar_header_bg_color', true);

					if(!empty($bg) || !empty($bg_color)){
						//page header
						if(!empty($bg)) echo '<img src="'.$bg.'" alt="'.get_the_title($next_post->ID).'" />';
						else echo '<span class="bg-color-only-indicator"></span>';
					} elseif(has_post_thumbnail($next_post->ID)) {
						//featured image
						$post_thumbnail_id = get_post_thumbnail_id($next_post->ID);
						$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
						echo '<img src="'.$post_thumbnail_url.'" alt="'.get_the_title($next_post->ID).'" />';
					} 
					
				?>
				
				<div class="col span_12 dark left">
					<div class="inner">
						<span><?php echo '<i>'. __('Next Post',NECTAR_THEME_NAME) .'</i>'; ?></span>
						<?php previous_post_link('%link','<h3>%title</h3>'); ?>
					</div>				
			 </div>
			 <span class="bg-overlay"></span>
			 <span class="full-link"><?php previous_post_link('%link'); ?></span>
		 </div>

	<?php }

	$next_post_link_output = ob_get_contents();
	ob_end_clean();

	echo $next_post_link_output;

} 



#-----------------------------------------------------------------#
# Post audio
#-----------------------------------------------------------------#

if ( !function_exists( 'nectar_audio' ) ) {
    function nectar_audio($postid) {
	
    	$mp3 = get_post_meta($postid, '_nectar_audio_mp3', TRUE);
    	$ogg = get_post_meta($postid, '_nectar_audio_ogg', TRUE);
    	
    ?>
		
    		<script type="text/javascript">
		
    			jQuery(document).ready(function($){
	
    				if( $().jPlayer ) {
    					$("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
    						ready: function () {
    							$(this).jPlayer("setMedia", {
    							    <?php if($mp3 != '') : ?>
    								mp3: "<?php echo $mp3; ?>",
    								<?php endif; ?>
    								<?php if($ogg != '') : ?>
    								oga: "<?php echo $ogg; ?>",
    								<?php endif; ?>
    								end: ""
    							});
    						},
    						<?php if( !empty($poster) ) { ?>
    						size: {
            				    width: "<?php echo $width; ?>px",
            				    height: "<?php echo $height . 'px'; ?>"
            				},
            				<?php } ?>
    						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
    						supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
    					});
					
    				}
    			});
    		</script>
		
    	    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-audio"></div>

            <div class="jp-audio-container">
                <div class="jp-audio">
                    <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                        <ul class="jp-controls">
                            <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                            <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                            <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                            <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                        </ul>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="jp-volume-bar-container">
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	<?php 
    }
}


#-----------------------------------------------------------------#
# Post video
#-----------------------------------------------------------------#

if ( !function_exists( 'nectar_video' ) ) {
    function nectar_video($postid) { 
	
    	$m4v = get_post_meta($postid, '_nectar_video_m4v', true);
    	$ogv = get_post_meta($postid, '_nectar_video_ogv', true);
    	$poster = get_post_meta($postid, '_nectar_video_poster', true);

    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function($){
		
    		if( $().jPlayer ) {
    			$("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
    				ready: function () {
    					$(this).jPlayer("setMedia", {
    						<?php if($m4v != '') : ?>
    						m4v: "<?php echo $m4v; ?>",
    						<?php endif; ?>
    						<?php if($ogv != '') : ?>
    						ogv: "<?php echo $ogv; ?>",
    						<?php endif; ?>
    						<?php if ($poster != '') : ?>
    						poster: "<?php echo $poster; ?>"
    						<?php else: ?>
    						poster: "<?php echo get_template_directory_uri().'/img/no-video-img.png'; ?>"
    						<?php endif; ?>
    					});
    				},
    				size: {
			          width: "100%",
			          height: "auto"
			        },
    				swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    				cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
    				supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
    			});
    		}
    	});
    </script>

    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-video"> <img src="<?php echo get_template_directory_uri().'/img/no-video-img.png'; ?>" alt="video" /> </div>

    <div class="jp-video-container">
        <div class="jp-video">
            <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                <ul class="jp-controls">
                	<li><div class="seperator-first"></div></li>
                    <li><div class="seperator-second"></div></li>
                    <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                    <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                    <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                    <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                </ul>
                <div class="jp-progress">
                    <div class="jp-seek-bar">
                        <div class="jp-play-bar"></div>
                    </div>
                </div>
                <div class="jp-volume-bar-container">
                    <div class="jp-volume-bar">
                        <div class="jp-volume-bar-value"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php }
}

//default video size
$content_width = 1080;

#-----------------------------------------------------------------#
# Post gallery
#-----------------------------------------------------------------#

if ( !function_exists( 'nectar_gallery' ) ) {
    function nectar_gallery($postid) {  
	        
	    if (class_exists('MultiPostThumbnails')) { ?>
		   
		  <div class="flex-gallery"> 
		  	  <ul class="slides">
			    <?php if ( has_post_thumbnail() ) { echo '<li>' . get_the_post_thumbnail($postid, 'full', array('title' => '')) . '</li>'; } ?>
			   
			    <?php 
				   if(MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'second-slide')) { echo '<li>' . MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'second-slide') . '</li>'; }
				   if(MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'third-slide')) { echo '<li>' . MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'third-slide') . '</li>'; }
				   if(MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'fourth-slide')) { echo '<li>' . MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'fourth-slide') . '</li>'; }
				   if(MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'fifth-slide')) { echo '<li>' . MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'fifth-slide') . '</li>'; }
				   if(MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'sixth-slide')) { echo '<li>' . MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'sixth-slide') . '</li>'; }
		   	    ?>
		   	   
		   	   </ul>
		   </div><!--/gallery-->
		<?php } 
    	
    }
    
}

/** Grab IDs from new WP 3.5 gallery **/
function grab_ids_from_gallery() {
	global $post;
	
	if($post != null) {
		
		$attachment_ids = array();  
		$pattern = '\[(\[?)(gallery)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';
		$ids = array();
		$portfolio_extra_content = get_post_meta($post->ID, '_nectar_portfolio_extra_content', true);
		
		if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) ) { 
		
			$count=count($matches[3]);      //in case there is more than one gallery in the post.
			for ($i = 0; $i < $count; $i++){
				$atts = shortcode_parse_atts( $matches[3][$i] );
				if ( isset( $atts['ids'] ) ){
					$attachment_ids = explode( ',', $atts['ids'] );
					$ids = array_merge($ids, $attachment_ids);
				}
			}
		}
	
		if (preg_match_all( '/'. $pattern .'/s', $portfolio_extra_content, $matches ) ) {   
			$count=count($matches[3]);     
			for ($i = 0; $i < $count; $i++){
				$atts = shortcode_parse_atts( $matches[3][$i] );
				if ( isset( $atts['ids'] ) ){
					$attachment_ids = explode( ',', $atts['ids'] );
					$ids = array_merge($ids, $attachment_ids);
				}
			}
		}
	return $ids;
  } else {
  	$ids = array();
  	return $ids;
  }


}

add_action( 'wp', 'grab_ids_from_gallery' );





/*Previous and Next Post in Same Taxonomy*/
/*Author: Bill Erickson*/

function be_get_previous_post($in_same_cat = false, $excluded_categories = '', $taxonomy = 'category') {
	return be_get_adjacent_post($in_same_cat, $excluded_categories, true, $taxonomy);
}

function be_get_next_post($in_same_cat = false, $excluded_categories = '', $taxonomy = 'category') {
	return be_get_adjacent_post($in_same_cat, $excluded_categories, false, $taxonomy);
}


function be_get_adjacent_post( $in_same_cat = false, $excluded_categories = '', $previous = true, $taxonomy = 'category' ) {
	global $post, $wpdb;

	if ( empty( $post ) )
		return null;

	$current_post_date = $post->post_date;

	$join = '';
	$posts_in_ex_cats_sql = '';
	if ( $in_same_cat || ! empty( $excluded_categories ) ) {
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

		if ( $in_same_cat ) {
			$cat_array = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
			$join .= " AND tt.taxonomy = '$taxonomy' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
		}

		$posts_in_ex_cats_sql = "AND tt.taxonomy = '$taxonomy'";
		if ( ! empty( $excluded_categories ) ) {
			if ( ! is_array( $excluded_categories ) ) {
				// back-compat, $excluded_categories used to be IDs separated by " and "
				if ( strpos( $excluded_categories, ' and ' ) !== false ) {
					_deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded categories.' ), "'and'" ) );
					$excluded_categories = explode( ' and ', $excluded_categories );
				} else {
					$excluded_categories = explode( ',', $excluded_categories );
				}
			}

			$excluded_categories = array_map( 'intval', $excluded_categories );
				
			if ( ! empty( $cat_array ) ) {
				$excluded_categories = array_diff($excluded_categories, $cat_array);
				$posts_in_ex_cats_sql = '';
			}

			if ( !empty($excluded_categories) ) {
				$posts_in_ex_cats_sql = " AND tt.taxonomy = '$taxonomy' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
			}
		}
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';

	$join = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_cat, $excluded_categories );
	$where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_cat, $excluded_categories );
	$sort = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

	$query = "SELECT p.* FROM $wpdb->posts AS p $join $where $sort";
	$query_key = 'adjacent_post_' . md5($query);
	$result = wp_cache_get($query_key, 'counts');
	if ( false !== $result )
		return $result;

	$result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $sort");
	if ( null === $result )
		$result = '';

	wp_cache_set($query_key, $result, 'counts');
	return $result;
}


function be_previous_post_link($format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories = '', $taxonomy = 'category') {
	be_adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, true, $taxonomy);
}


function be_next_post_link($format='%link &raquo;', $link='%title', $in_same_cat = false, $excluded_categories = '', $taxonomy = 'category') {
	be_adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, false, $taxonomy);
}


function be_adjacent_post_link($format, $link, $in_same_cat = false, $excluded_categories = '', $previous = true, $taxonomy = 'category') {
	if ( $previous && is_attachment() )
		$post = & get_post($GLOBALS['post']->post_parent);
	else
		$post = be_get_adjacent_post($in_same_cat, $excluded_categories, $previous, $taxonomy);

	if ( !$post )
		return;

	$title = $post->post_title;

	if ( empty($post->post_title) )
		$title = $previous ? __('Previous Post') : __('Next Post');

	$title = apply_filters('the_title', $title, $post->ID);
	$date = mysql2date(get_option('date_format'), $post->post_date);
	$rel = $previous ? 'prev' : 'next';

	$string = '<a href="'.get_permalink($post).'" rel="'.$rel.'">';
	$link = str_replace('%title', $title, $link);
	$link = str_replace('%date', $date, $link);
	$link = $string . $link . '</a>';

	$format = str_replace('%link', $link, $format);

	$adjacent = $previous ? 'previous' : 'next';
	echo apply_filters( "{$adjacent}_post_link", $format, $link );
}





#-----------------------------------------------------------------#
# Custom page header
#-----------------------------------------------------------------# 

if ( !function_exists( 'nectar_page_header' ) ) {
    function nectar_page_header($postid) {
		
		global $options;
		global $post;
		global $nectar_theme_skin;

		$fullscreen_rows = get_post_meta($postid, '_nectar_full_screen_rows', true);
		if($fullscreen_rows == 'on')
			return;
    	$bg = get_post_meta($postid, '_nectar_header_bg', true);
		$bg_color = get_post_meta($postid, '_nectar_header_bg_color', true);
		$font_color = get_post_meta($postid, '_nectar_header_font_color', true);
		$parallax_bg = get_post_meta($postid, '_nectar_header_parallax', true);
    	$title = get_post_meta($postid, '_nectar_header_title', true);
    	$subtitle = get_post_meta($postid, '_nectar_header_subtitle', true);
		$height = get_post_meta($postid, '_nectar_header_bg_height', true); 
		$page_template = get_post_meta($postid, '_wp_page_template', true); 
		$display_sortable = get_post_meta($postid, 'nectar-metabox-portfolio-display-sortable', true);
		$inline_filters = (!empty($options['portfolio_inline_filters']) && $options['portfolio_inline_filters'] == '1') ? '1' : '0';
		$filters_id = (!empty($options['portfolio_inline_filters']) && $options['portfolio_inline_filters'] == '1') ? 'portfolio-filters-inline' : 'portfolio-filters';
		$text_align = get_post_meta($postid, '_nectar_page_header_alignment', true); 
		$text_align_v = get_post_meta($postid, '_nectar_page_header_alignment_v', true); 
		$fullscreen_header = (!empty($options['blog_header_type']) && $options['blog_header_type'] == 'fullscreen' && is_singular('post')) ? true : false;
		$post_header_style = (!empty($options['blog_header_type'])) ? $options['blog_header_type'] : 'default'; 
		$bottom_shadow = get_post_meta($postid, '_nectar_header_bottom_shadow', true); 
		$bg_overlay = get_post_meta($postid, '_nectar_header_overlay', true); 
		$text_effect = get_post_meta($postid, '_nectar_page_header_text-effect', true); 
		$animate_in_effect = (!empty($options['header-animate-in-effect'])) ? $options['header-animate-in-effect'] : 'none';
		(!empty($display_sortable) && $display_sortable == 'on') ? $display_sortable = '1' : $display_sortable = '0';
		
		//incase no title is entered for portfolio, still show the filters
		if( $page_template == 'template-portfolio.php' && empty($title)) $title = get_the_title($post->ID);
		
		$bg_type = get_post_meta($postid, '_nectar_slider_bg_type', true); 
		if(empty($bg_type)) $bg_type = 'image_bg'; 

		if( (!empty($bg) || !empty($bg_color) || $bg_type == 'video_bg' || $bg_type == 'particle_bg') && !is_post_type_archive( 'post' ) ) {  
    	
    	$social_img_src = (empty($bg)) ? 'none' : $bg;
		$bg = (empty($bg)) ? 'none' : $bg;

		if($bg_type == 'image_bg' || $bg_type == 'particle_bg') {
    		(empty($bg_color)) ? $bg_color = '#000' : $bg_color = $bg_color;
    	} else {
    		$bg = 'none'; //remove stnd bg image for video BG type
    	}
    	$bg_color_string = (!empty($bg_color)) ? 'background-color: '.$bg_color.'; ' : null;

    	if($bg_type == 'particle_bg') {
	    	$rotate_timing = get_post_meta($postid, '_nectar_particle_rotation_timing', true); 
	    	$disable_explosion = get_post_meta($postid, '_nectar_particle_disable_explosion', true);
	    	$shapes = get_post_meta($postid, '_nectar_canvas_shapes', true); 
	    	if(empty($shapes)) $bg_type = 'image_bg';
	    }
	    if($bg_type == 'video_bg') {
			$video_webm = get_post_meta($postid, '_nectar_media_upload_webm', true); 
			$video_mp4 = get_post_meta($postid, '_nectar_media_upload_mp4', true); 
			$video_ogv = get_post_meta($postid, '_nectar_media_upload_ogv', true); 
			$video_image = get_post_meta($postid, '_nectar_slider_preview_image', true); 
		}
		$box_roll = get_post_meta($postid, '_nectar_header_box_roll', true); 
		if(!empty($options['boxed_layout']) && $options['boxed_layout'] == '1') $box_roll = 'off';
		$bg_position = get_post_meta($postid, '_nectar_page_header_bg_alignment', true); 
		if(empty($bg_position)) $bg_position = 'top'; 

		if( $post_header_style == 'default_minimal' && ($post->post_type == 'post' && is_single())) {
			$height = (!empty($height)) ? preg_replace('/\s+/', '', $height) : 550;
		} else {
			$height = (!empty($height)) ? preg_replace('/\s+/', '', $height) : 350;
		}

		$not_loaded_class = ($nectar_theme_skin != 'ascend') ? "not-loaded" : null;		
		$page_fullscreen_header = get_post_meta($postid, '_nectar_header_fullscreen', true); 
		$fullscreen_class = ($fullscreen_header == true || $page_fullscreen_header == 'on') ? "fullscreen-header" : null;
		$bottom_shadow_class = ($bottom_shadow == 'on') ? " bottom-shadow": null;
		$bg_overlay_class = ($bg_overlay == 'on') ? " bg-overlay": null;
		$ajax_page_loading = (!empty($options['ajax-page-loading']) && $options['ajax-page-loading'] == '1') ? true : false;

		if($animate_in_effect == 'slide-down') {
			$wrapper_height_style = null;
		} else {
			$wrapper_height_style = 'style="height: '.$height.'px;"';
		}
		if($fullscreen_header == true && ($post->post_type == 'post' && is_single()) || $page_fullscreen_header == 'on') $wrapper_height_style = null; //diable slide down for fullscreen headers
	
		$midnight_non_parallax = (!empty($parallax_bg) && $parallax_bg == 'on') ? null : 'data-midnight="light"';
    	if($box_roll != 'on') { echo '<div id="page-header-wrap" data-animate-in-effect="'. $animate_in_effect .'" data-midnight="light" class="'.$fullscreen_class.'" '.$wrapper_height_style.'>'; } 
    	if(!empty($box_roll) && $box_roll == 'on') { 
    		wp_enqueue_style('box-roll'); 
    		echo '<div class="nectar-box-roll">'; 
    	}
    	?>
	    <div class="<?php echo $not_loaded_class . ' ' . $fullscreen_class . $bottom_shadow_class . $bg_overlay_class; ?>" <?php if($post->post_type == 'post' && is_single()) echo 'data-post-hs="'.$post_header_style.'"'; ?> data-animate-in-effect="<?php echo $animate_in_effect; ?>" id="page-header-bg" <?php echo $midnight_non_parallax; ?> data-text-effect="<?php echo $text_effect; ?>" data-bg-pos="<?php echo $bg_position; ?>" data-alignment="<?php echo (!empty($text_align)) ? $text_align : 'left' ; ?>" data-alignment-v="<?php echo (!empty($text_align_v)) ? $text_align_v : 'middle' ; ?>" data-parallax="<?php echo (!empty($parallax_bg) && $parallax_bg == 'on') ? '1' : '0'; ?>" data-height="<?php echo (!empty($height)) ? $height : '350'; ?>" style="<?php echo $bg_color_string; ?> height: <?php echo (!empty($height)) ? $height : '350'; ?>px;">
			
			<?php 

			if(!empty($bg) && $bg != 'none') { ?><div class="page-header-bg-image" style="background-image: url(<?php echo $bg; ?>);"></div> <?php } ?>

			<?php if($bg_type != 'particle_bg') { echo '<div class="container">'; }
			
					
					if($post->ID != 0 && $post->post_type && $post->post_type == 'portfolio') { ?>
					
					<div class="row project-title">
					<div class="container">
					<div class="col span_6 section-title <?php if(empty($options['portfolio_social']) || $options['portfolio_social'] == 0 || empty($options['portfolio_date']) || $options['portfolio_date'] == 0 ) echo 'no-date'?>">
						
						<h1><?php the_title(); ?></h1>
						<?php if(!empty($subtitle)) { ?> <span class="subheader"><?php echo $subtitle; ?></span> <?php } ?>
						
						<?php 

						global $options;
						$single_nav_pos = (!empty($options['portfolio_single_nav'])) ? $options['portfolio_single_nav'] : 'in_header';

						if($single_nav_pos == 'in_header') project_single_controls(); ?>
						
					</div>
				</div> 
			
			</div><!--/row-->
						
						
						
						
						
						
						
					<?php } elseif($post->ID != 0 && $post->post_type == 'post' && is_single() ) { 
						
						// also set as an img for social sharing/
						if($social_img_src != 'none') echo '<img class="hidden-social-img" src="'.$social_img_src.'" alt="'.get_the_title().'" />';

						?>
						
						<div class="row">

							<div class="col span_6 section-title blog-title">
								<div class="inner-wrap">

									<?php if(($post->post_type == 'post' && is_single()) && $post_header_style == 'default_minimal') {

										    $categories = get_the_category();
											if ( ! empty( $categories ) ) {
												$output = null;
											    foreach( $categories as $category ) {
											        $output .= '<a class="'.$category->slug.'" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', NECTAR_THEME_NAME), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>';
											    }
											    echo trim( $output);
											}
									} ?>

									<h1 class="entry-title"><?php the_title(); ?></h1>

									 <?php if(($post->post_type == 'post' && is_single()) && $fullscreen_header == true ) { ?>
									 	<div class="author-section">
										 	<span class="meta-author">  
										 		<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), 100 ); }?>
										 	</span> 
										 	<div class="avatar-post-info vcard author">
											 	<span class="fn"><?php the_author_posts_link(); ?></span>
											 	<span class="meta-date date updated"><i><?php echo get_the_date(); ?></i></span>
											 </div>
										</div>
								<?php } ?>
							
							
								<?php if($fullscreen_header != true) { ?>	
									<div id="single-below-header">
										<span class="meta-author vcard author"><span class="fn"><?php echo __('By', NECTAR_THEME_NAME); ?> <?php the_author_posts_link(); ?></span></span><!--
										--><span class="meta-date date updated"><?php echo get_the_date(); ?></span><!--
										--><?php if($post_header_style != 'default_minimal') { ?> <span class="meta-category"><?php the_category(', '); ?></span> <?php } else { ?><!--
										--><span class="meta-comment-count"><a href="<?php comments_link(); ?>"> <?php comments_number( __('No Comments', NECTAR_THEME_NAME), __('One Comment ', NECTAR_THEME_NAME), __('% Comments', NECTAR_THEME_NAME) ); ?></a></span>
									<?php } ?>
									</div><!--/single-below-header-->
								<?php } ?>
								
								<?php if($fullscreen_header != true && $post_header_style != 'default_minimal') { ?>

								<div id="single-meta" data-sharing="<?php echo ( !empty($options['blog_social']) && $options['blog_social'] == 1 ) ? '1' : '0'; ?>">
									<ul>
		
	  	
									   
										<li class="meta-comment-count">
											<a href="<?php comments_link(); ?>"><i class="icon-default-style steadysets-icon-chat"></i> <?php comments_number( __('No Comments', NECTAR_THEME_NAME), __('One Comment ', NECTAR_THEME_NAME), __('% Comments', NECTAR_THEME_NAME) ); ?></a>
										</li>
											<li>
									   		<?php echo '<span class="n-shortcode">'.nectar_love('return').'</span>'; ?>
									   	</li>
										<?php if( !empty($options['blog_social']) && $options['blog_social'] == 1 ) { 
										   
										   echo '<li class="meta-share-count"><a href="#"><i class="icon-default-style steadysets-icon-share"></i><span class="share-count-total">0</span></a> <div class="nectar-social">';
										   
										
											//facebook
											if(!empty($options['blog-facebook-sharing']) && $options['blog-facebook-sharing'] == 1) { 
												echo "<a class='facebook-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-facebook'></i> <span class='count'></span></a>";
											}
											//twitter
											if(!empty($options['blog-twitter-sharing']) && $options['blog-twitter-sharing'] == 1) {
												echo "<a class='twitter-share nectar-sharing' href='#' title='".__('Tweet this', NECTAR_THEME_NAME)."'> <i class='icon-twitter'></i> <span class='count'></span></a>";
											}
											//google plus
											if(!empty($options['blog-google-plus-sharing']) && $options['blog-google-plus-sharing'] == 1) {
												echo "<a class='google-plus-share nectar-sharing-alt' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-google-plus'></i> <span class='count'> ".GetGooglePlusShares(get_permalink($post->ID))." </span></a>";
											}
											
											//linkedIn
											if(!empty($options['blog-linkedin-sharing']) && $options['blog-linkedin-sharing'] == 1) {
												echo "<a class='linkedin-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-linkedin'></i> <span class='count'> </span></a>";
											}
											//pinterest
											if(!empty($options['blog-pinterest-sharing']) && $options['blog-pinterest-sharing'] == 1) {
												echo "<a class='pinterest-share nectar-sharing' href='#' title='".__('Pin this', NECTAR_THEME_NAME)."'> <i class='icon-pinterest'></i> <span class='count'></span></a>";
											}
											
										  echo '</div></li>';
		
								 		}
									?>
									
									

									</ul>
									
								</div><!--/single-meta-->

							<?php } //end if theme skin default ?>
						    </div>
						</div><!--/section-title-->
					</div><!--/row-->
						
							
						
						
					
					<?php //default	
					} else if($bg_type != 'particle_bg') {

						if(!empty($box_roll) && $box_roll == 'on') { 
							$alignment = (!empty($text_align)) ? $text_align : 'left';
							$v_alignment = (!empty($text_align_v)) ? $text_align_v : 'middle';
							echo '<div class="overlaid-content" data-text-effect="'.$text_effect.'" data-alignment="'.$alignment.'" data-alignment-v="'.$v_alignment.'"><div class="container">';
						}  ?>

						 <div class="row">
							<div class="col span_6">
								<div class="inner-wrap">
									<h1><?php echo $title; ?></h1>
									<span class="subheader"><?php echo $subtitle; ?></span>
								</div>
								 
								<?php // portfolio filters
									if( $page_template == 'template-portfolio.php' && $display_sortable == '1' && $inline_filters == '0') { ?>
									<div class="<?php echo $filters_id;?>" instance="0">
											<a href="#" data-sortable-label="<?php echo (!empty($options['portfolio-sortable-text'])) ? $options['portfolio-sortable-text'] :'Sort Portfolio'; ?>" id="sort-portfolio"><span><?php echo (!empty($options['portfolio-sortable-text'])) ? $options['portfolio-sortable-text'] : __('Sort Portfolio',NECTAR_THEME_NAME); ?></span> <i class="icon-angle-down"></i></a> 
										<ul>
										   <li><a href="#" data-filter="*"><?php echo __('All', NECTAR_THEME_NAME); ?></a></li>
						               	   <?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'project-type', 'show_option_none'   => '', 'walker' => new Walker_Portfolio_Filter())); ?>
										</ul>
									</div>
								<?php } ?>
								</div>
						  </div>
					  
					  <?php if(!empty($box_roll) && $box_roll == 'on') echo '</div></div><!--/overlaid-content-->';

				 } ?>
					
					
				
			<?php if($bg_type != 'particle_bg') { echo '</div>'; } //closing container 


			 if(($post->ID != 0 && $post->post_type == 'post' && is_single()) && $fullscreen_header == true || $page_fullscreen_header == 'on') { 
			 	 $rotate_in_class = ( $text_effect == 'rotate_in') ? 'hidden' : null;
			 	 $button_styling = (!empty($options['button-styling'])) ? $options['button-styling'] : 'default'; 
			 	 if($button_styling == 'default'){
			 	 	echo '<div class="scroll-down-wrap"><a href="#" class="section-down-arrow '.$rotate_in_class.'"><i class="icon-salient-down-arrow icon-default-style"> </i></a></div>';
			 	 } else {
			 	 	echo '<div class="scroll-down-wrap '.$rotate_in_class.'"><a href="#" class="section-down-arrow"><i class="fa fa-angle-down top"></i><i class="fa fa-angle-down"></i></a></div>';
			 	 }

			  } 

		
		//video bg
		if($bg_type == 'video_bg') {
			
			if ( floatval(get_bloginfo('version')) >= "3.6" ) {
				wp_enqueue_script('wp-mediaelement');
				wp_enqueue_style('wp-mediaelement');
			} else {
				//register media element for WordPress 3.5
				wp_register_script('wp-mediaelement', get_template_directory_uri() . '/js/mediaelement-and-player.min.js', array('jquery'), '1.0', TRUE);
				wp_register_style('wp-mediaelement', get_template_directory_uri() . '/css/mediaelementplayer.min.css');
				
				wp_enqueue_script('wp-mediaelement');
				wp_enqueue_style('wp-mediaelement');
			}
			
			//parse video image
			if(strpos($video_image, "http://") !== false || strpos($video_image, "https://") !== false){
				$video_image_src = $video_image;
			} else {
				$video_image_src = wp_get_attachment_image_src($video_image, 'full');
				$video_image_src = $video_image_src[0];
			}
			
			//$poster_markup = (!empty($video_image)) ? 'poster="'.$video_image_src.'"' : null ;
			$poster_markup = null;
			$video_markup = null;
			
			$video_markup .=  '<div class="video-color-overlay" data-color="'.$bg_color.'"></div>';
			
				 
			$video_markup .= '
			
			<div class="mobile-video-image" style="background-image: url('.$video_image_src.')"></div>
			<div class="nectar-video-wrap" data-bg-alignment="'.$bg_position.'">
				
				
				<video class="nectar-video-bg" width="1800" height="700" '.$poster_markup.'  preload="auto" loop autoplay>';
				    if(!empty($video_webm)) { $video_markup .= '<source type="video/webm" src="'.$video_webm.'">'; }
				    if(!empty($video_mp4)) { $video_markup .= '<source type="video/mp4" src="'.$video_mp4.'">'; }
				    if(!empty($video_ogv)) { $video_markup .= '<source type="video/ogg" src="'. $video_ogv.'">'; }
				  
			   $video_markup .='</video>
		
			</div>';
			
			echo $video_markup;
		}

		//particle bg
		if($bg_type == 'particle_bg') {

			wp_enqueue_script('nectarParticles');

			echo '<div class=" nectar-particles" data-disable-explosion="'.$disable_explosion.'" data-rotation-timing="'.$rotate_timing.'"><div class="canvas-bg"><canvas id="canvas" data-active-index="0"></canvas></div>';

			$images = explode( ',', $shapes);
			$i = 0;

			if(!empty($shapes)) {

				if(!empty($box_roll) && $box_roll == 'on') { 
					$alignment = (!empty($text_align)) ? $text_align : 'left';
					$v_alignment = (!empty($text_align_v)) ? $text_align_v : 'middle';
					echo '<div class="overlaid-content" data-text-effect="'.$text_effect.'" data-alignment="'.$alignment.'" data-alignment-v="'.$v_alignment.'">';
				}

				echo '<div class="container"><div class="row"><div class="col span_6" >';

				foreach ( $images as $attach_id ) {
					$i++;

	    			$img = wp_get_attachment_image_src(  $attach_id, 'full' );

	    			$attachment = get_post( $attach_id );
					$shape_meta = array(
						'caption' => $attachment->post_excerpt,
						'title' => $attachment->post_title,
						'bg_color' => get_post_meta( $attachment->ID, 'nectar_particle_shape_bg_color', true ),
						'color' => get_post_meta( $attachment->ID, 'nectar_particle_shape_color', true ),
						'color_mapping' => get_post_meta( $attachment->ID, 'nectar_particle_shape_color_mapping', true ),
						'alpha' => get_post_meta( $attachment->ID, 'nectar_particle_shape_color_alpha', true ),
						'density' => get_post_meta( $attachment->ID, 'nectar_particle_shape_density', true ),
						'max_particle_size' => get_post_meta( $attachment->ID, 'nectar_particle_max_particle_size', true )
					);
					if(!empty($shape_meta['density'])) {
						switch($shape_meta['density']) {
							case 'very_low':
								$shape_meta['density'] = '19';
							break;
							case 'low':
								$shape_meta['density'] = '16';
							break;
							case 'medium':
								$shape_meta['density'] = '13';
							break;
							case 'high':
								$shape_meta['density'] = '10';
							break;
							case 'very_high':
								$shape_meta['density'] = '8';
							break;
						}
					}

					if(!empty($shape_meta['color']) && $shape_meta['color'] == '#fff' || !empty($shape_meta['color']) && $shape_meta['color'] == '#ffffff') $shape_meta['color'] = '#fefefe';

	    			//data for particle shape
	    			echo '<div class="shape" data-src="'.$img[0].'" data-max-size="'.$shape_meta['max_particle_size'].'" data-alpha="'.$shape_meta['alpha'].'" data-density="'.$shape_meta['density'].'" data-color-mapping="'.$shape_meta['color_mapping'].'" data-color="'.$shape_meta['color'].'" data-bg-color="'.$shape_meta['bg_color'].'"></div>';

	    			//overlaid content
	    			echo '<div class="inner-wrap shape-'.$i.'">';
	    			echo '<h1>'.$shape_meta["title"].'</h1> <span class="subheader">'.$shape_meta["caption"].'</span>';
	    			echo '</div>';

	    		} ?>

	    		</div></div></div>

	    		<div class="pagination-navigation">
					<div class="pagination-current"></div>
					<div class="pagination-dots">
						<?php foreach ( $images as $attach_id ) {
							echo '<button class="pagination-dot"></button>';
						} ?>
					</div>
				</div>
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="690">
				  <defs>
				    <filter id="goo">
				      <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
				      <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 69 -16" result="goo"></feColorMatrix>
				      <feComposite in="SourceGraphic" in2="goo" operator="atop"></feComposite>
				    </filter>
				  </defs>
				</svg>

				<?php if(!empty($box_roll) && $box_roll == 'on') echo '</div><!--/overlaid-content-->'; ?>

			</div> <!--/nectar particles-->

			<?php }
		} //particle bg ?>

		</div>

	   <?php 

	    echo '</div>';  

	    } else if( !empty($title) && !is_archive()) { ?>
	    	
		    <div class="row page-header-no-bg" data-alignment="<?php echo (!empty($text_align)) ? $text_align : 'left' ; ?>">
		    	<div class="container">	
					<div class="col span_12 section-title">
						<h1><?php echo $title; ?><?php if(!empty($subtitle)) echo '<span>' . $subtitle . '</span>'; ?></h1>
						
						<?php // portfolio filters
						if( $page_template == 'template-portfolio.php' && $display_sortable == '1' && $inline_filters == '0') { ?>
						<div class="<?php echo $filters_id;?>" instance="0">
							
							<a href="#" data-sortable-label="<?php echo (!empty($options['portfolio-sortable-text'])) ? $options['portfolio-sortable-text'] :'Sort Portfolio'; ?>" id="sort-portfolio"><span><?php echo (!empty($options['portfolio-sortable-text'])) ? $options['portfolio-sortable-text'] : __('Sort Portfolio',NECTAR_THEME_NAME); ?></span> <i class="icon-angle-down"></i></a> 
							
							<ul>
							   <li><a href="#" data-filter="*"><?php echo __('All', NECTAR_THEME_NAME); ?></a></li>
			               	   <?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'project-type', 'show_option_none'   => '', 'walker' => new Walker_Portfolio_Filter())); ?>
							</ul>
						</div>
					<?php } ?>
						
					</div>
				</div>

			</div> 
	 	   	
	    <?php } else if(is_category() || is_tag() || is_date() || is_author() ) {

	    	/*blog archives*/
	    	$archive_bg_img = (isset($options['blog_archive_bg_image'])) ? nectar_options_img($options['blog_archive_bg_image']) : null;
	    	$t_id =  get_cat_ID( single_cat_title( '', false ) ) ;
	    	$terms =  get_option( "taxonomy_$t_id" );

	    	$heading = null;
			$subtitle = null;

			if(is_author()){

				$heading =  get_the_author();
				$subtitle = __('All Posts By', NECTAR_THEME_NAME );

			} else if(is_category()) {

				$heading =  single_cat_title( '', false );
				$subtitle = __('Category', NECTAR_THEME_NAME );

			} else if(is_tag()) {

				$heading =  wp_title("",false);
				$subtitle = __('Tag', NECTAR_THEME_NAME );

			} else if(is_date()){

				if ( is_day() ) :

					$heading = get_the_date();
					$subtitle = __('Daily Archives', NECTAR_THEME_NAME );
				
				elseif ( is_month() ) :

					$heading = get_the_date( _x( 'F Y', 'monthly archives date format', NECTAR_THEME_NAME ) );
					$subtitle = __('Monthly Archives', NECTAR_THEME_NAME );

				elseif ( is_year() ) :

					$heading =  get_the_date( _x( 'Y', 'yearly archives date format', NECTAR_THEME_NAME ) );
					$subtitle = __('Yearly Archives', NECTAR_THEME_NAME );

				else :
					$heading = __( 'Archives', NECTAR_THEME_NAME );

				endif;
			} else {
					$heading = wp_title("",false);
			} ?>


			<?php 
			if(!empty($terms['category_image']) || !empty($archive_bg_img)) { 

				$bg_img = $archive_bg_img;
				if(!empty($terms['category_image'])) $bg_img = $terms['category_image'];

				if($animate_in_effect == 'slide-down') {
					$wrapper_height_style = null;
				} else {
					$wrapper_height_style = 'style="height: 350px;"';
				}
			?>

			<div id="page-header-wrap" data-midnight="light" <?php echo $wrapper_height_style; ?>>	 
				<div id="page-header-bg" data-animate-in-effect="<?php echo $animate_in_effect; ?>" id="page-header-bg" data-text-effect="" data-bg-pos="center" data-alignment="left" data-alignment-v="center" data-parallax="0" data-height="350" style="height: 350px;">
			
					<div class="page-header-bg-image" style="background-image: url(<?php echo $bg_img; ?>);"></div> 

					<div class="container">
					    <div class="row">
						    <div class="col span_6">
							     <div class="inner-wrap">
							     	<span class="subheader"><?php echo $subtitle; ?></span>
									<h1><?php echo $heading; ?></h1>
							    </div>
							 
					   	    </div>
				        </div>
							  
				   </div>
		        </div>

   			</div>
   			<?php } else { ?>


	   			 <div class="row page-header-no-bg" data-alignment="<?php echo (!empty($text_align)) ? $text_align : 'left' ; ?>">
			    	<div class="container">	
						<div class="col span_12 section-title">
							<span class="subheader"><?php echo $subtitle; ?></span>
							<h1><?php echo $heading; ?></h1>
						</div>
					</div>

				</div> 


   			<?php }
	    }
 
    }
}


function using_page_header($post_id){

	 global $post; 
	 global $woocommerce; 
	 global $options;

	 $force_effect = null;

	 if($woocommerce && is_shop() || $woocommerce && is_product_category() || $woocommerce && is_product_tag()) {
		$header_title = get_post_meta(woocommerce_get_page_id('shop'), '_nectar_header_title', true);
		$header_bg = get_post_meta(woocommerce_get_page_id('shop'), '_nectar_header_bg', true);
		$header_bg_color = get_post_meta(woocommerce_get_page_id('shop'), '_nectar_header_bg_color', true);
		$bg_type = get_post_meta(woocommerce_get_page_id('shop'), '_nectar_slider_bg_type', true); 
		if(empty($bg_type)) $bg_type = 'image_bg'; 
		$disable_effect = get_post_meta(woocommerce_get_page_id('shop'), '_disable_transparent_header', true);
		$force_effect = null;
	 } 
	 else if(is_home()){
	 	$header_title = get_post_meta(get_option('page_for_posts'), '_nectar_header_title', true);
		$header_bg = get_post_meta(get_option('page_for_posts'), '_nectar_header_bg', true); 
		$header_bg_color = get_post_meta(get_option('page_for_posts'), '_nectar_header_bg_color', true); 
		$bg_type = get_post_meta(get_option('page_for_posts'), '_nectar_slider_bg_type', true); 
		if(empty($bg_type)) $bg_type = 'image_bg'; 
		$disable_effect = get_post_meta(get_option('page_for_posts'), '_disable_transparent_header', true);
		$force_effect = null;
	 }  

	 else if(!is_category() && !is_tag() && !is_date() & !is_author()) {
		$header_title = get_post_meta($post->ID, '_nectar_header_title', true);
		$header_bg = get_post_meta($post->ID, '_nectar_header_bg', true); 
		$header_bg_color = get_post_meta($post->ID, '_nectar_header_bg_color', true); 
		$bg_type = get_post_meta($post->ID, '_nectar_slider_bg_type', true); 
		if(empty($bg_type)) $bg_type = 'image_bg'; 
		$disable_effect = get_post_meta($post->ID, '_disable_transparent_header', true);
		$force_effect = get_post_meta($post->ID, '_force_transparent_header', true);
	 }

	//blog archives
	if(is_category() || is_tag() || is_date() || is_author()){
		$bg_type = null;
		$disable_effect = null;
		$archive_bg_img = ( isset($options['blog_archive_bg_image']['id']) && !empty($options['blog_archive_bg_image']['id']) ) ? nectar_options_img($options['blog_archive_bg_image']) : null;
		$t_id =  get_cat_ID( single_cat_title( '', false ) ) ;
		$terms =  get_option( "taxonomy_$t_id" );
		if(!empty($archive_bg_img) || !empty($terms['category_image'])) {
		     $force_effect = 'on';
		     $bg_type = 'image_bg';
		 }
	}

	$pattern = get_shortcode_regex();
	
	$using_applicable_shortcode = 0;
	
    if ( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )  && array_key_exists( 0, $matches ))  {
    	
		if($matches[0][0]){
			if( strpos($matches[0][0],'nectar_slider') !== false && strpos($matches[0][0],'full_width="true"') !== false) {
				
				if(empty($header_title)) $using_applicable_shortcode = 1;
				
			} else {
				$using_applicable_shortcode = 0;
			}
		}
    	
    }
	
	//stop effect from WooCommerce single pages
	global $woocommerce; 
	if($woocommerce && is_product()) { $using_applicable_shortcode = 0; $header_bg = 0; $header_bg_color = 0; }

	//alternate header style
	global $options;
	if(!empty($options['blog_header_type']) && $options['blog_header_type'] == 'fullscreen' && is_singular('post'))  $using_applicable_shortcode = 1;

	//incase of search / tax / removing effect
	if(is_search() || is_tax() || $disable_effect == 'on') { $using_applicable_shortcode = 0; $header_bg = 0; $header_bg_color = 0; $bg_type = 'image_bg'; }

	$page_full_screen_rows = (isset($post->ID)) ? get_post_meta($post->ID, '_nectar_full_screen_rows', true) : '';
	//if forcing effect
	if($force_effect == 'on' && (!is_search() && !is_tax()) || $page_full_screen_rows == 'on' && (!is_search() && !is_tax()) ) { $using_applicable_shortcode = 1; }

	$the_verdict = (!empty($header_bg_color) || !empty($header_bg) || $bg_type == 'video_bg' || $bg_type == 'particle_bg' || $using_applicable_shortcode) ? true : false;

	return $the_verdict;

}


function using_nectar_slider(){
	
	global $post; 
	global $woocommerce;
	
	if($woocommerce && is_shop() || $woocommerce && is_product_category() || $woocommerce && is_product_tag()) {
		$header_title = get_post_meta(woocommerce_get_page_id('shop'), '_nectar_header_title', true);
		$header_bg = get_post_meta(woocommerce_get_page_id('shop'), '_nectar_header_bg', true);
		$header_bg_color = get_post_meta(woocommerce_get_page_id('shop'), '_nectar_header_bg_color', true);
	 } 
	 else if(is_home() || is_archive()){
	 	$header_title = get_post_meta(get_option('page_for_posts'), '_nectar_header_title', true);
		$header_bg = get_post_meta(get_option('page_for_posts'), '_nectar_header_bg', true); 
		$header_bg_color = get_post_meta(get_option('page_for_posts'), '_nectar_header_bg_color', true); 
	 }  else {
		$header_title = get_post_meta($post->ID, '_nectar_header_title', true);
		$header_bg = get_post_meta($post->ID, '_nectar_header_bg', true); 
		$header_bg_color = get_post_meta($post->ID, '_nectar_header_bg_color', true); 
	 }
	
	$pattern = get_shortcode_regex();
	$using_fullwidth_slider = 0;
	
	if ( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )  && array_key_exists( 0, $matches ))  {
    	
		if($matches[0][0]){
			
			if( strpos($matches[0][0],'nectar_slider') !== false && strpos($matches[0][0],'full_width="true"') !== false 
			|| strpos($matches[0][0],' type="full_width_content"') !== false && strpos($matches[0][0],'nectar_slider') !== false && strpos($matches[0][0],'[vc_column width="1/1"') !== false ) {
				
				$using_fullwidth_slider = 1;
				
			} else {
				
				$using_fullwidth_slider = 0;
				
			}
		}
    	
    }
	
	//incase of search
	if(is_search() || is_tax()) $using_fullwidth_slider = 0;

	//stop effect from WooCommerce single pages
	global $woocommerce; 
	if($woocommerce && is_product()) $using_fullwidth_slider = 0; 

	$the_verdict = (empty($header_title) && empty($header_bg) && empty($header_bg_color) && $using_fullwidth_slider) ? true : false;

	return $the_verdict;
}



#-----------------------------------------------------------------#
# Pagination
#-----------------------------------------------------------------#

if ( !function_exists( 'nectar_pagination' ) ) {
	
	function nectar_pagination() {
		
		global $options;
		//extra pagination
		if( !empty($options['extra_pagination']) && $options['extra_pagination'] == '1' ){
			
			    global $wp_query, $wp_rewrite; 
	      
			    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1; 
			    $total_pages = $wp_query->max_num_pages; 
			      
			    if ($total_pages > 1){  
			      
			      $permalink_structure = get_option('permalink_structure');
				  $query_type = (count($_GET)) ? '&' : '?';	
			      $format = empty( $permalink_structure ) ? $query_type.'paged=%#%' : 'page/%#%/';  
				
				  echo '<div id="pagination" data-is-text="'.__("All items loaded", NECTAR_THEME_NAME).'">';
				   
			      echo paginate_links(array(  
			          'base' => get_pagenum_link(1) . '%_%',  
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
				echo '<div id="pagination" data-is-text="'.__("All items loaded", NECTAR_THEME_NAME).'">
				      <div class="prev">'.get_previous_posts_link('&laquo; Previous Entries').'</div>
				      <div class="next">'.get_next_posts_link('Next Entries &raquo;','').'</div>
			          </div>';
			
	        }
		}
		
	
	}
}



#-----------------------------------------------------------------#
# Woocommerce
#-----------------------------------------------------------------#

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'salient_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'salient_theme_wrapper_end', 10);

function salient_theme_wrapper_start() {
    echo '<div class="container main-content">';
}

function salient_theme_wrapper_end() {
    echo '</div>';
}

add_theme_support( 'woocommerce' );

 

add_filter('add_to_cart_fragments', 'add_to_cart_fragment');


// update the cart with ajax
function add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	$fragments['a.cart-parent'] = ob_get_clean();
	return $fragments;
}

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );


//change summary html markup to fit responsive
add_action( 'woocommerce_before_single_product_summary', 'summary_div', 35);
add_action( 'woocommerce_after_single_product_summary',  'close_div', 4);
function summary_div() {
	echo "<div class='span_7 col col_last single-product-summary'>";
}
function close_div() {
	echo "</div>";
}

//change tab position to be inside summary
if(empty($options['product_tab_position']) || $options['product_tab_position'] == 'in_sidebar') {
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
	add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 1);	
}

//wrap single product image in an extra div
add_action( 'woocommerce_before_single_product_summary', 'images_div', 8);
add_action( 'woocommerce_before_single_product_summary',  'close_div', 29);
function images_div()
{
	echo "<div class='span_5 col single-product-main-image'>";
}


// display upsells and related products within dedicated div with different column and number of products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function woocommerce_output_related_products() {
	$output = null;

	ob_start();
	woocommerce_related_products(array('columns' => 4, 'posts_per_page' => 4)); 
	$content = ob_get_clean();
	if($content) { $output .= $content; }

	echo '<div class="clear"></div>' . $output;
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display',10);
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 21);

function woocommerce_output_upsells() {

	$output = null;

	ob_start();
	woocommerce_upsell_display(4,4); 
	$content = ob_get_clean(); 
	if($content) { $output .= $content; }

	echo $output;
}


add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start(); ?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><div class="cart-icon-wrap"><i class="icon-salient-cart"></i> <div class="cart-wrap"><span><?php echo $woocommerce->cart->cart_contents_count; ?> </span></div> </div></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}


//chnge how many products are displayed per page	
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

//change the position of add to cart
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

$product_style = (!empty($options['product_style'])) ? $options['product_style'] : 'classic';
if( $product_style == 'classic'){
	add_action('woocommerce_before_shop_loop_item_title', 'product_thumbnail_with_cart', 10 );
} else {
	add_action('woocommerce_before_shop_loop_item_title', 'product_thumbnail_with_cart_alt', 10 );

	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
}

function product_thumbnail_with_cart() { ?>
	
   <div class="product-wrap">

	    <a href="<?php the_permalink(); ?>">	<?php echo  woocommerce_get_product_thumbnail(); ?> </a>
	   	<?php woocommerce_template_loop_add_to_cart(); ?>
   	</div>
<?php 
}

function product_thumbnail_with_cart_alt() { ?>
	
   	

   <div class="product-wrap">
	   	<?php 
	   	global $product;
	   	echo  woocommerce_get_product_thumbnail(); ?>

	   	<div class="bg-overlay"></div>
	   	<a href="<?php the_permalink(); ?>" class="link-overlay"></a>
	   	<div class="text-on-hover-wrap">
			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			<?php echo '<div class="categories">' . $product->get_categories() .'</div>'; ?>
		</div> 



   	</div>
   	<a href="<?php the_permalink(); ?>"><?php do_action( 'woocommerce_shop_loop_item_title' ); ?></a>
   	<?php woocommerce_template_loop_add_to_cart();

}



//add link to item titles
/*add_action('woocommerce_before_shop_loop_item_title','product_item_title_link_open');
add_action('woocommerce_after_shop_loop_item_title','product_item_title_link_close');
function product_item_title_link_open(){
	echo '<a href="'.get_permalink().'">';
}
function product_item_title_link_close(){
	echo '</a>';
}*/


if(empty($options['product_tab_position']) || $options['product_tab_position'] == 'in_sidebar') {
	add_action( 'woocommerce_single_product_summary', 'review_quickview', 7 );
} else {
	add_action( 'woocommerce_single_product_summary', 'review_quickview', 100 );
	add_action( 'woocommerce_after_single_product_summary', 'nectar_woo_clearfix', 7 );
}

function nectar_woo_clearfix() {
	echo '<div class="after-product-summary-clear"></div>';
}

function review_quickview(){
	global $product, $options, $post;
	
	/*$rating_count = $product->get_rating_count();
	
	if(!empty($rating_count)) {
	
		echo '<div class="review_num">'.sprintf( _n('%s review %s', '%s reviews %s', $rating_count, 'woocommerce'), '<span itemprop="ratingCount" class="count">'. $rating_count .'</span>', '' ).'</div>';
		echo '<div class="quick_rating">';
		woocommerce_get_template( 'loop/rating.php' );
		echo '</div>';
		 
	} */ ?>
		
		<div id="single-meta" data-sharing="<?php echo ( !empty($options['woo_social']) && $options['woo_social'] == 1 ) ? '1' : '0'; ?>">

			<ul class="product-sharing"> 

				<?php
				// portfolio social sharting icons
				if( !empty($options['woo_social']) && $options['woo_social'] == 1 ) {
					
					echo '<li class="meta-share-count"><a href="#"><i class="icon-default-style steadysets-icon-share"></i><span class="share-count-total">0</span> <span class="plural">'. __('Shares',NECTAR_THEME_NAME) . '</span> <span class="singular">'. __('Share',NECTAR_THEME_NAME) .'</span></a> <div class="nectar-social">';

					echo '<div class="nectar-social woo">';
					
					//facebook
					if(!empty($options['woo-facebook-sharing']) && $options['woo-facebook-sharing'] == 1) {
						echo "<a class='facebook-share nectar-sharing' href='#' title='Share this'> <i class='icon-facebook'></i> <span class='count'></span></a>";
					}
					//twitter
					if(!empty($options['woo-twitter-sharing']) && $options['woo-twitter-sharing'] == 1) {
						echo "<a class='twitter-share nectar-sharing' href='#' title='Tweet this'> <i class='icon-twitter'></i> <span class='count'></span></a>";
					}

					//google plus
					if(!empty($options['woo-google-plus-sharing']) && $options['woo-google-plus-sharing'] == 1) {
						echo "<a class='google-plus-share nectar-sharing-alt' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-google-plus'></i> <span class='count'> ".GetGooglePlusShares(get_permalink($post->ID))." </span></a>";
					}
					
					//linkedIn
					if(!empty($options['woo-linkedin-sharing']) && $options['woo-linkedin-sharing'] == 1) {
						echo "<a class='linkedin-share nectar-sharing' href='#' title='".__('Share this', NECTAR_THEME_NAME)."'> <i class='icon-linkedin'></i> <span class='count'> </span></a>";
					}

					//pinterest
					if(!empty($options['woo-pinterest-sharing']) && $options['woo-pinterest-sharing'] == 1) {
						echo "<a class='pinterest-share nectar-sharing' href='#' title='Pin this'> <i class='icon-pinterest'></i> <span class='count'></span></a>";
					}


					
					echo '</div></div></li>';
				}
				
				?> 
			</ul>
		</div> 
<?php 
															
}

// Image sizes
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'nectar_woocommerce_image_dimensions', 1 );
 

// Define image sizes 
function nectar_woocommerce_image_dimensions() {
	$catalog = array(
		'width' => '375',	
		'height'	=> '400',	
		'crop'	=> 1 
	);
	 
	$single = array(
		'width' => '600',	
		'height'	=> '630',	
		'crop'	=> 1 
	);
	 
	$thumbnail = array(
		'width' => '130',	
		'height'	=> '130',	
		'crop'	=> 1 
	);
	 
	
	update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
	update_option( 'shop_single_image_size', $single ); // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
}





// Open Graph
if (!function_exists('add_opengraph')) {
	function add_opengraph() {
		global $post; // Ensures we can use post variables outside the loop

		// Start with some values that don't change.
		echo "<meta property='og:site_name' content='". get_bloginfo('name') ."'/>"; // Sets the site name to the one in your WordPress settings
		echo "<meta property='og:url' content='" . get_permalink() . "'/>"; // Gets the permalink to the post/page

		if (is_singular()) { // If we are on a blog post/page
	        echo "<meta property='og:title' content='" . get_the_title() . "'/>"; // Gets the page title
	        echo "<meta property='og:type' content='article'/>"; // Sets the content type to be article.
	    } elseif(is_front_page() or is_home()) { // If it is the front page or home page
	    	echo "<meta property='og:title' content='" . get_bloginfo("name") . "'/>"; // Get the site title
	    	echo "<meta property='og:type' content='website'/>"; // Sets the content type to be website.
	    }

		if(has_post_thumbnail( $post->ID )) { // If the post has a featured image.
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
			echo "<meta property='og:image' content='" . esc_attr( $thumbnail[0] ) . "'/>"; // If it has a featured image, then display this for Facebook
		} 

	}
}

$using_jetpack_publicize = ( class_exists( 'Jetpack' ) && in_array( 'publicize', Jetpack::get_active_modules()) ) ? true : false;

if ( !defined('WPSEO_VERSION') && !class_exists('NY_OG_Admin') && !class_exists('Wpsso') && $using_jetpack_publicize == false) {
	add_action( 'wp_head', 'add_opengraph', 5 );
}


?>