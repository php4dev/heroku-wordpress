<?php // Prismatic - Reset Settings

if (!defined('ABSPATH')) exit;

function prismatic_admin_notice() {
	
	$screen = get_current_screen();
	
	if ($screen->id === 'settings_page_prismatic') {
		
		if (isset($_GET['reset-options'])) {
			
			if ($_GET['reset-options'] === 'true') : ?>
				
				<div class="notice notice-success is-dismissible"><p><strong><?php esc_html_e('Default options restored.', 'prismatic'); ?></strong></p></div>
				
			<?php else : ?>
				
				<div class="notice notice-info is-dismissible"><p><strong><?php esc_html_e('No changes made to options.', 'prismatic'); ?></strong></p></div>
				
			<?php endif;
			
		}
		
	}
	
}

function prismatic_reset_options() {
	
	if (isset($_GET['reset-options-verify']) && wp_verify_nonce($_GET['reset-options-verify'], 'prismatic_reset_options')) {
		
		if (!current_user_can('manage_options')) exit;
		
		$update_general   = update_option('prismatic_options_general',   Prismatic::options_general());
		$update_prism     = update_option('prismatic_options_prism',     Prismatic::options_prism());
		$update_highlight = update_option('prismatic_options_highlight', Prismatic::options_highlight());
		$update_plain     = update_option('prismatic_options_plain',     Prismatic::options_plain());
		
		$result = 'false';
		
		if (
			$update_general   || 
			$update_prism     || 
			$update_highlight || 
			$update_plain 
			
		) $result = 'true';
		
		$location = admin_url('options-general.php?page=prismatic&reset-options='. $result);
		
		wp_redirect($location);
		
		exit;
		
	}
	
}
