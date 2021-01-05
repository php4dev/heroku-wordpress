<?php // Prismatic - TimyMCE Quicktag Buttons

function prismatic_buttons() {
	
	if (current_user_can('edit_posts')) {
		
		add_filter('mce_buttons',          'prismatic_register_buttons');
		add_filter('mce_external_plugins', 'prismatic_add_buttons');
		
	}
	
}

function prismatic_register_buttons($buttons) {
	
	array_push($buttons, 'button_prism', 'button_highlight');
	
	return $buttons;
	
}

function prismatic_add_buttons($plugin_array) {
	
	global $prismatic_options_general;
	
	if (isset($prismatic_options_general['library'])) {
		
		if ($prismatic_options_general['library'] === 'prism') {
		
			$plugin_array['prismatic_buttons'] = plugins_url('/js/buttons-prism.js', dirname(__FILE__));
			
		} elseif ($prismatic_options_general['library'] === 'highlight') {
			
			$plugin_array['prismatic_buttons'] = plugins_url('/js/buttons-highlight.js', dirname(__FILE__));
			
		} elseif ($prismatic_options_general['library'] === 'plain') {
			
			$plugin_array['prismatic_buttons'] = plugins_url('/js/buttons-plain.js', dirname(__FILE__));
			
		}
		
	}
	
	return $plugin_array;
	
}

function prismatic_add_quicktags() {
	
	if (wp_script_is('quicktags')) : 
	
	// QTags.addButton( id, display, arg1, arg2, access_key, title, priority, instance );
	
	?>
	
	<script type="text/javascript">
		QTags.addButton('prismatic_pre', 'pre', '<pre><code class="language-">', '</code></pre>', 'z', 'Preformatted Code');
	</script>
	
<?php endif;

}
