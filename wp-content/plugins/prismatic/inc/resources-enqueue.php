<?php // Prismatic - Enqueue Resources

if (!defined('ABSPATH')) exit;

function prismatic_enqueue() {
	
	global $prismatic_options_general;
	
	$library = (isset($prismatic_options_general['library'])) ? $prismatic_options_general['library'] : 'none';
	
	if (is_admin()) {
		
		$screen = get_current_screen();
		
		if (!property_exists($screen, 'id')) return;
		
		if ($screen->id === 'post' || $screen->id === 'page') {
			
			if ($library === 'prism') {
				
				prismatic_prism_enqueue();
				
			} elseif ($library === 'highlight') {
				
				prismatic_highlight_enqueue();
				
			}
			
		}
		
	} else {
		
		if ($library === 'prism') {
			
			prismatic_prism_enqueue();
			
		} elseif ($library === 'highlight') {
			
			prismatic_highlight_enqueue();
			
		}
		
	}
	
}

function prismatic_enqueue_settings() {
	
	$screen = get_current_screen();
	
	if (!property_exists($screen, 'id')) return;
	
	if ($screen->id === 'settings_page_prismatic') {
		
		wp_enqueue_style('prismatic-font-icons', PRISMATIC_URL .'css/styles-font-icons.css', array(), PRISMATIC_VERSION);
		
		wp_enqueue_style('prismatic-settings', PRISMATIC_URL .'css/styles-settings.css', array(), PRISMATIC_VERSION);
		
		wp_enqueue_style('wp-jquery-ui-dialog');
		
		$js_deps = array('jquery', 'jquery-ui-core', 'jquery-ui-dialog');
		
		wp_enqueue_script('prismatic-settings', PRISMATIC_URL .'js/scripts-settings.js', $js_deps, PRISMATIC_VERSION);
		
		$data = prismatic_get_vars_admin();
		
		wp_localize_script('prismatic-settings', 'prismatic_settings', $data);
		
	}
	
}

function prismatic_enqueue_buttons() {
	
	$screen = get_current_screen();
	
	if (!property_exists($screen, 'id')) return;
	
	if ($screen->id === 'post' || $screen->id === 'page') {
		
		wp_enqueue_style('prismatic-buttons', PRISMATIC_URL .'css/styles-buttons.css', array(), PRISMATIC_VERSION);
		
	}
	
}

function prismatic_get_vars_admin() {
	
	$data = array(
		
		'reset_title'   => __('Confirm Reset',            'prismatic'),
		'reset_message' => __('Restore default options?', 'prismatic'),
		'reset_true'    => __('Yes, make it so.',         'prismatic'),
		'reset_false'   => __('No, abort mission.',       'prismatic'),
		
	);
	
	return $data;
	
}

function prismatic_prism_enqueue() {
	
	global $prismatic_options_prism;
	
	if (isset($prismatic_options_prism['singular_only']) && $prismatic_options_prism['singular_only'] && !is_singular() && !is_admin()) return;
	
	$languages = prismatic_active_languages('prism');
	
	$languages = array_filter($languages);
	
	if (!empty($languages)) {
		
		$theme = (isset($prismatic_options_prism['prism_theme'])) ? $prismatic_options_prism['prism_theme'] : 'default';
		
		wp_enqueue_style('prismatic-prism', PRISMATIC_URL .'lib/prism/css/theme-'. $theme .'.css', array(), PRISMATIC_VERSION, 'all');
		
		wp_enqueue_script('prismatic-prism', PRISMATIC_URL .'lib/prism/js/prism-core.js', array(), PRISMATIC_VERSION, true);
		
		if (
			(isset($prismatic_options_prism['show_language'])  && $prismatic_options_prism['show_language']) || 
			(isset($prismatic_options_prism['copy_clipboard']) && $prismatic_options_prism['copy_clipboard'])
		) {
			
			wp_enqueue_style('prismatic-plugin-styles', PRISMATIC_URL .'lib/prism/css/plugin-styles.css', array(), PRISMATIC_VERSION, 'all');
			
			wp_enqueue_script('prismatic-prism-toolbar', PRISMATIC_URL .'lib/prism/js/plugin-toolbar.js', array('prismatic-prism'),  PRISMATIC_VERSION, true);
			
		}
		
		if (isset($prismatic_options_prism['line_highlight']) && $prismatic_options_prism['line_highlight']) {
			
			wp_enqueue_script('prismatic-prism-line-highlight', PRISMATIC_URL .'lib/prism/js/plugin-line-highlight.js', array('prismatic-prism'),  PRISMATIC_VERSION, true);
			
		}
		
		if (isset($prismatic_options_prism['line_numbers']) && $prismatic_options_prism['line_numbers']) {
			
			wp_enqueue_script('prismatic-prism-line-numbers', PRISMATIC_URL .'lib/prism/js/plugin-line-numbers.js', array('prismatic-prism'),  PRISMATIC_VERSION, true);
			
		}
		
		if (isset($prismatic_options_prism['show_language']) && $prismatic_options_prism['show_language']) {
			
			wp_enqueue_script('prismatic-prism-show-language', PRISMATIC_URL .'lib/prism/js/plugin-show-language.js', array('prismatic-prism'),  PRISMATIC_VERSION, true);
			
		}
		
		if (isset($prismatic_options_prism['copy_clipboard']) && $prismatic_options_prism['copy_clipboard']) {
			
			wp_enqueue_script('prismatic-copy-clipboard', PRISMATIC_URL .'lib/prism/js/plugin-copy-clipboard.js', array('prismatic-prism'),  PRISMATIC_VERSION, true);
			
		}
		
		$prefix = array('lang-', 'language-');
		
		foreach ($languages as $language) {
			
			$language = str_replace($prefix, '', $language);
			
			$file = PRISMATIC_DIR . 'lib/prism/js/lang-'. $language .'.js';
			
			if (file_exists($file)) {
				
				wp_enqueue_script('prismatic-prism-'. $language, PRISMATIC_URL .'lib/prism/js/lang-'. $language .'.js', array('prismatic-prism'),  PRISMATIC_VERSION, true);
				
			}
			
		}
		
		if (is_admin()) {
			
			// todo: once gutenberg is further developed, find a better way to add editor support
			
			function prismatic_prism_inline_js() {
				
				?>
				
				<script type="text/javascript">
					document.onreadystatechange = function () {
					    if (document.readyState == 'complete') {
					        Prism.highlightAll();
					    }
					}
				</script>
				
				<?php
				
			}
			add_action('admin_print_footer_scripts', 'prismatic_prism_inline_js');
				
		}
		
	}
	
}

function prismatic_highlight_enqueue() {
	
	global $prismatic_options_highlight;
	
	if (isset($prismatic_options_highlight['singular_only']) && $prismatic_options_highlight['singular_only'] && !is_singular() && !is_admin()) return;
	
	$always_load = (isset($prismatic_options_highlight['noprefix_classes']) && $prismatic_options_highlight['noprefix_classes']) ? true : false;
	
	$languages = prismatic_active_languages('highlight');
	
	$languages = array_filter($languages);
	
	if (!empty($languages) || $always_load) {
		
		$theme = (isset($prismatic_options_highlight['highlight_theme'])) ? $prismatic_options_highlight['highlight_theme'] : 'default';
		
		wp_enqueue_style('prismatic-highlight', PRISMATIC_URL .'lib/highlight/css/'. $theme .'.css', array(), PRISMATIC_VERSION, 'all');
		
		wp_enqueue_script('prismatic-highlight', PRISMATIC_URL .'lib/highlight/js/highlight-core.js', array(), PRISMATIC_VERSION, true);
		
		$init = (isset($prismatic_options_highlight['init_javascript'])) ? $prismatic_options_highlight['init_javascript'] : '';
		
		if ($init) {
			
			wp_add_inline_script('prismatic-highlight', $init, 'after');
			
		}
		
		if (is_admin()) {
			
			// todo: once gutenberg is further developed, find a better way to add editor support
			
			function prismatic_highlight_inline_js() {
				
				?>
				
				<script type="text/javascript">
					document.onreadystatechange = function () {
					    if (document.readyState == 'complete') {
					        jQuery('pre > code').each(function() {
								hljs.highlightBlock(this);
							});
					    }
					}
				</script>
				
				<?php
				
			}
			add_action('admin_print_footer_scripts', 'prismatic_highlight_inline_js');
				
		}
		
	}
	
}

function prismatic_active_languages($library) {
	
	global $posts, $post;
	
	$languages = array();
	
	if (is_admin()) {
		
		$content = $post->post_content;
		
		$languages = prismatic_active_languages_loop($library, '', $content, array(), null);
		
	} else {
		
		if (is_singular()) {
			
			$excerpt = $post->post_excerpt;
			
			$content = $post->post_content;
			
			$comments = ($post->comment_count) ? get_comments(array('post_id' => $post->ID, 'status' => 'approve')) : array();
			
			$fields = function_exists('get_fields') ? get_fields($post->ID) : null; // ACF
			
			$languages = prismatic_active_languages_loop($library, $excerpt, $content, $comments, $fields);
			
		} else {
			
			foreach ($posts as $post) {
				
				$excerpt = $post->post_excerpt;
				
				$content = $post->post_content;
				
				$comments = array();
				
				$langs_array[] = prismatic_active_languages_loop($library, $excerpt, $content, $comments, null);
				
			}
			
			if (!empty($langs_array) && is_array($langs_array)) {
				
				foreach($langs_array as $key => $value) {
					
					foreach ($value as $k => $v) {
						
						$languages[] = $v;
						
					}
					
				}
				
			}
			
		}
		
	}
	
	return $languages;
	
}

function prismatic_active_languages_loop($library, $excerpt, $content, $comments, $fields) {
	
	$languages = array();
	
	$classes = ($library === 'prism') ? prismatic_prism_classes() : prismatic_highlight_classes();
	
	foreach ($classes as $class) {
		
		foreach($class as $cls) {
			
			if (strpos($excerpt, $cls) !== false) {
				
				$languages[] = $cls;
				
			}
			
			if (strpos($content, $cls) !== false) {
				
				$languages[] = $cls;
				
			}
			
			foreach ($comments as $comment) {
				
				if (strpos($comment->comment_content, $cls) !== false) {
					
					$languages[] = $cls;
					
				}
				
			}
			
			if ($fields) {
				
				foreach ($fields as $key => $value) {
					
					if (is_string($value) && strpos($value, $cls) !== false) {
						
						$languages[] = $cls;
						
					}
					
				}
				
			}
			
		}
		
	}
	
	$languages = array_unique($languages);
	
	return $languages;
	
}

function prismatic_prism_classes() {
	
	$classes = array(
		
		array(
			'language-apacheconf', 
			'language-applescript', 
			'language-arduino',
			'language-atom',
			'language-bash', 
			'language-batch', 
			'language-c', 
			'language-csharp', 
			'language-cpp', 
			'language-clike', 
			'language-coffeescript', 
			'language-css', 
			'language-d',
			'language-dart',
			'language-diff', 
			'language-elixir', 
			'language-gcode', 
			'language-git', 
			'language-go', 
			'language-graphql', 
			'language-groovy',
			'language-hcl', 
			'language-html',
			'language-http', 
			'language-ini', 
			'language-java', 
			'language-javascript', 
			'language-json', 
			'language-jsx',
			'language-kotlin', 
			'language-latex', 
			'language-liquid', 
			'language-lua', 
			'language-makefile', 
			'language-markdown', 
			'language-markup', 
			'language-mathml',
			'language-nginx', 
			'language-objectivec', 
			'language-pascal',
			'language-perl', 
			'language-php', 
			'language-powershell', 
			'language-python', 
			'language-r', 
			'language-rss',
			'language-ruby', 
			'language-rust', 
			'language-sass', 
			'language-scala',
			'language-scss', 
			'language-shell-session', 
			'language-solidity', 
			'language-sql', 
			'language-ssml',
			'language-svg',
			'language-swift', 
			'language-tsx', 
			'language-twig',
			'language-typescript',
			'language-visual-basic',
			'language-xml',
			'language-yaml',
			'language-none',
		),
		
		array(
			'lang-apacheconf', 
			'lang-applescript', 
			'lang-arduino',
			'lang-atom', 
			'lang-bash', 
			'lang-batch', 
			'lang-c', 
			'lang-csharp', 
			'lang-cpp', 
			'lang-clike', 
			'lang-coffeescript', 
			'lang-css', 
			'lang-d',
			'lang-dart',
			'lang-diff', 
			'lang-elixir', 
			'lang-gcode', 
			'lang-git', 
			'lang-go', 
			'lang-graphql',
			'lang-groovy',
			'lang-hcl', 
			'lang-html', 
			'lang-http', 
			'lang-ini', 
			'lang-java', 
			'lang-javascript', 
			'lang-json', 
			'lang-jsx',
			'lang-kotlin', 
			'lang-latex', 
			'lang-liquid', 
			'lang-lua', 
			'lang-makefile', 
			'lang-markdown', 
			'lang-markup', 
			'lang-mathml', 
			'lang-nginx', 
			'lang-objectivec',
			'lang-pascal', 
			'lang-perl', 
			'lang-php', 
			'lang-powershell',
			'lang-python', 
			'lang-r', 
			'lang-rss', 
			'lang-ruby', 
			'lang-rust', 
			'lang-sass', 
			'lang-scala',
			'lang-scss', 
			'lang-shell-session', 
			'lang-solidity', 
			'lang-sql', 
			'lang-ssml', 
			'lang-svg', 
			'lang-swift',
			'lang-tsx',
			'lang-twig',
			'lang-typescript',
			'lang-visual-basic',
			'lang-xml', 
			'lang-yaml',
			'lang-none',
		)
		
	);
	
	return $classes;
	
}

function prismatic_highlight_classes() {
	
	$classes = array(
			
		array(
			'language-'
		),
		
		array(
			'lang-', 
		)
		
	);
	
	return $classes;
	
}
