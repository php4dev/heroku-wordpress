<?php // Prismatic - Display Settings

if (!defined('ABSPATH')) exit;

function prismatic_menu_pages() {
	
	// add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function )
	add_options_page('Prismatic', 'Prismatic', 'manage_options', 'prismatic', 'prismatic_display_settings');
	
}

function prismatic_get_tabs() {
	
	$tabs = array(
		'tab1' => esc_html__('General',      'prismatic'), 
		'tab2' => esc_html__('Prism.js',     'prismatic'), 
		'tab3' => esc_html__('Highlight.js', 'prismatic'), 
		'tab4' => esc_html__('Plain Flavor', 'prismatic'), 
	);
	
	return $tabs;
	
}

function prismatic_display_settings() { 
	
	$tab_active = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'tab1'; 
	
	$tab_href = admin_url('options-general.php?page=prismatic');
	
	$tab_names = prismatic_get_tabs();
	
	?>
	
	<div class="wrap wrap-<?php echo $tab_active; ?>">
		<h1><span class="fa fa-pad fa-code"></span> <?php echo PRISMATIC_NAME; ?> <span class="prismatic-version"><?php echo PRISMATIC_VERSION; ?></span></h1>
		<h2 class="nav-tab-wrapper">
			
			<?php 
				
				foreach ($tab_names as $key => $value) {
					
					$active = ($tab_active === $key) ? ' nav-tab-active' : '';
					
					echo '<a href="'. $tab_href .'&tab='. $key .'" class="nav-tab nav-'. $key . $active .'">'. $value .'</a>';
					
				}
				
			?>
			
		</h2>
		<form method="post" action="options.php">
			
			<?php
				
				if ($tab_active === 'tab1') {
					
					settings_fields('prismatic_options_general');
					do_settings_sections('prismatic_options_general');
				
				} elseif ($tab_active === 'tab2') {
					
					settings_fields('prismatic_options_prism');
					do_settings_sections('prismatic_options_prism');
					
				} elseif ($tab_active === 'tab3') {
					
					settings_fields('prismatic_options_highlight');
					do_settings_sections('prismatic_options_highlight');
					
				} elseif ($tab_active === 'tab4') {
					
					settings_fields('prismatic_options_plain');
					do_settings_sections('prismatic_options_plain');
					
				}
				
				submit_button();
				
			?>
			
		</form>
	</div>
	
<?php }
