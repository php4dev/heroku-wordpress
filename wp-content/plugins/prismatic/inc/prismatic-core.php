<?php // Prismatic - Core Functions

if (!defined('ABSPATH')) exit;

function prismatic_load_library() {
	
	global $prismatic_options_general;
	
	if (isset($prismatic_options_general['library']) && $prismatic_options_general['library'] === 'prism') {
		
		require_once PRISMATIC_DIR .'lib/prism/prism.php';
		
	} elseif (isset($prismatic_options_general['library']) && $prismatic_options_general['library'] === 'highlight') {
		
		require_once PRISMATIC_DIR .'lib/highlight/highlight.php';
		
	} elseif (isset($prismatic_options_general['library']) && $prismatic_options_general['library'] === 'plain') {
		
		require_once PRISMATIC_DIR .'lib/plain/plain.php';
		
	}
	
}

function prismatic_encode($text) {
	
	if (!is_string($text)) return $text;
	
	$output = '';
	$split  = preg_split("/(<code[^>]*>.*<\/code>)/Us", $text, -1, PREG_SPLIT_DELIM_CAPTURE);
	$count  = count($split);
	
	for ($i = 0; $i < $count; $i++) {
		
		$content = $split[$i];
		
		if (preg_match("/^<code([^>]*)>(.*)<\/code>/Us", $content, $code)) {
			
			$atts = str_replace(array("'", "\""), "%%", $code[1]);
			
			$content = '[prismatic_encoded'. $atts .']'. base64_encode($code[2]) .'[/prismatic_encoded]';
			
		}
		
		$output .= $content;
		
	}
	
	return $output;
	
}

function prismatic_decode($text, $replace = false) {
	
	if (!is_string($text)) return $text;
	
	$output = '';
	$split  = preg_split("/(\[prismatic_encoded.*\].*\[\/prismatic_encoded\])/Us", $text, -1, PREG_SPLIT_DELIM_CAPTURE);
	$count  = count($split);
	
	for ($i = 0; $i < $count; $i++) {
		
		$content = $split[$i];
		
		if (preg_match("/^\[prismatic_encoded(.*)\](.*)\[\/prismatic_encoded\]/Us", $content, $code)) {
			
			$content = base64_decode($code[2]);
			
			if ($replace) {
				
				$content = preg_replace("/\r/",      "",      $content);
				$content = preg_replace("/^\s*?\n/", "\n",    $content);
				$content = preg_replace("/&/",       "&amp;", $content);
				$content = preg_replace("/</",       "&lt;",  $content);
				$content = preg_replace("/>/",       "&gt;",  $content);
				
			}
			
			$atts = str_replace("%%", "\"", $code[1]);
			
			$content = '<code'. $atts .'>'. $content .'</code>';
			
		}
		
		$output .= $content;
		
	}
	
	return $output;
	
}

function prismatic_decode_replace($text) {
	
	return prismatic_decode($text, true);
	
}

function prismatic_check_admin($library, $filter) {
	
	$settings = 'prismatic_options_'. $library;
	
	$setting = 'filter_'. $filter;
	
	$options = prismatic_get_default_options($library);
	
	$option = isset($options[$setting]) ? $options[$setting] : false;
	
	if ($option === 'admin' || $option === 'both') return true;
	
	return false;
	
}

function prismatic_check_front($library, $filter) {
	
	$settings = 'prismatic_options_'. $library;
	
	$setting = 'filter_'. $filter;
	
	$options = prismatic_get_default_options($library);
	
	$option = isset($options[$setting]) ? $options[$setting] : false;
	
	if ($option === 'front' || $option === 'both') return true;
	
	return false;
	
}

function prismatic_add_filters() {
	
	global $prismatic_options_general;
	
	$library = (isset($prismatic_options_general['library'])) ? $prismatic_options_general['library'] : 'none';
	
	if (prismatic_check_admin($library, 'content')) {
		
		add_filter('content_save_pre', 'prismatic_encode', 33);
		add_filter('content_save_pre', 'prismatic_decode', 77);
		
	}
	
	if (prismatic_check_front($library, 'content')) {
		
		add_filter('the_content', 'prismatic_encode', 1);
		add_filter('the_content', 'prismatic_decode_replace', 3);
		
		if (function_exists('get_fields')) { // ACF
			
			add_filter('acf/load_value', 'prismatic_encode', 1);
			add_filter('acf/load_value', 'prismatic_decode_replace', 3);
			
		}
		
	}
	
	if (prismatic_check_admin($library, 'excerpts')) {
		
		add_filter('excerpt_save_pre', 'prismatic_encode', 33);
		add_filter('excerpt_save_pre', 'prismatic_decode', 77);
		
	}
	
	if (prismatic_check_front($library, 'excerpts')) {
		
		add_filter('the_excerpt', 'prismatic_encode', 1);
		add_filter('the_excerpt', 'prismatic_decode_replace', 99);
		
	}
	
	if (prismatic_check_admin($library, 'comments')) {
		
		add_filter('pre_comment_content', 'prismatic_encode', 3);
		add_filter('pre_comment_content', 'prismatic_decode', 33);
		
		add_filter('comment_save_pre', 'prismatic_encode', 33);
		add_filter('comment_save_pre', 'prismatic_decode', 77);
		
	}
	
	if (prismatic_check_front($library, 'comments')) {
		
		add_filter('comment_text', 'prismatic_encode', 1);
		add_filter('comment_text', 'prismatic_decode_replace', 99);
		
	}
	
}

function prismatic_get_default_options($section) {
	
	$options = '';
	
	if ($section === 'general') {
		
		global $prismatic_options_general;
		
		$options = $prismatic_options_general;
		
	} elseif ($section === 'prism') {
		
		global $prismatic_options_prism;
		
		$options = $prismatic_options_prism;
		
	} elseif ($section === 'highlight') {
		
		global $prismatic_options_highlight;
		
		$options = $prismatic_options_highlight;
		
	} elseif ($section === 'plain') {
		
		global $prismatic_options_plain;
		
		$options = $prismatic_options_plain;
		
	}
	
	return $options;
	
}

function prismatic_block_styles() {
	
	global $prismatic_options_general;
	
	$disable = isset($prismatic_options_general['disable_block_styles']) ? $prismatic_options_general['disable_block_styles'] : false;
	
	if ($disable) wp_deregister_style('prismatic-blocks');
	
}

function prismatic_code_shortcode($attr, $content = null) {
	
	extract(shortcode_atts(array(
		
		'class' => '',
		
	), $attr));
	
	$class = $class ? ' class="'. $class .'"' : '';
	
	$encode = prismatic_encode($content);
	$decode = prismatic_decode($encode);
	
	return '<code'. $class .'>'. $decode .'</code>';
	
}
