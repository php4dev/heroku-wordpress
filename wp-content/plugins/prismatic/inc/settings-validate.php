<?php // Prismatic - Validate Settings

if (!defined('ABSPATH')) exit;

function prismatic_validate_general($input) {
	
	$library = prismatic_library();
	
	if (!isset($input['library'])) $input['library'] = null;
	if (!array_key_exists($input['library'], $library)) $input['library'] = null;
	
	if (!isset($input['disable_block_styles'])) $input['disable_block_styles'] = null;
	$input['disable_block_styles'] = ($input['disable_block_styles'] == 1 ? 1 : 0);
	
	return $input;
	
}

function prismatic_validate_prism($input) {
	
	
	$prism_theme = prismatic_prism_theme();
	
	if (!isset($input['prism_theme'])) $input['prism_theme'] = null;
	if (!array_key_exists($input['prism_theme'], $prism_theme)) $input['prism_theme'] = null;
	
	
	$location = prismatic_location();
	
	if (!isset($input['filter_content'])) $input['filter_content'] = null;
	if (!array_key_exists($input['filter_content'], $location)) $input['filter_content'] = null;
	
	if (!isset($input['filter_excerpts'])) $input['filter_excerpts'] = null;
	if (!array_key_exists($input['filter_excerpts'], $location)) $input['filter_excerpts'] = null;
	
	if (!isset($input['filter_comments'])) $input['filter_comments'] = null;
	if (!array_key_exists($input['filter_comments'], $location)) $input['filter_comments'] = null;
	
	
	if (!isset($input['line_highlight'])) $input['line_highlight'] = null;
	$input['line_highlight'] = ($input['line_highlight'] == 1 ? 1 : 0);
	
	if (!isset($input['line_numbers'])) $input['line_numbers'] = null;
	$input['line_numbers'] = ($input['line_numbers'] == 1 ? 1 : 0);
	
	if (!isset($input['show_language'])) $input['show_language'] = null;
	$input['show_language'] = ($input['show_language'] == 1 ? 1 : 0);
	
	if (!isset($input['singular_only'])) $input['singular_only'] = null;
	$input['singular_only'] = ($input['singular_only'] == 1 ? 1 : 0);
	
	
	return $input;
	
}

function prismatic_validate_highlight($input) {
	
	$highlight_theme = prismatic_highlight_theme();
	
	if (!isset($input['highlight_theme'])) $input['highlight_theme'] = null;
	if (!array_key_exists($input['highlight_theme'], $highlight_theme)) $input['highlight_theme'] = null;
	
	
	$location = prismatic_location();
	
	if (!isset($input['filter_content'])) $input['filter_content'] = null;
	if (!array_key_exists($input['filter_content'], $location)) $input['filter_content'] = null;
	
	if (!isset($input['filter_excerpts'])) $input['filter_excerpts'] = null;
	if (!array_key_exists($input['filter_excerpts'], $location)) $input['filter_excerpts'] = null;
	
	if (!isset($input['filter_comments'])) $input['filter_comments'] = null;
	if (!array_key_exists($input['filter_comments'], $location)) $input['filter_comments'] = null;
	
	
	if (isset($input['init_javascript'])) $input['init_javascript'] = $input['init_javascript'];
	
	if (!isset($input['singular_only'])) $input['singular_only'] = null;
	$input['singular_only'] = ($input['singular_only'] == 1 ? 1 : 0);
	
	
	return $input;
	
}

function prismatic_validate_plain($input) {

	$location = prismatic_location();
	
	if (!isset($input['filter_content'])) $input['filter_content'] = null;
	if (!array_key_exists($input['filter_content'], $location)) $input['filter_content'] = null;
	
	if (!isset($input['filter_excerpts'])) $input['filter_excerpts'] = null;
	if (!array_key_exists($input['filter_excerpts'], $location)) $input['filter_excerpts'] = null;
	
	if (!isset($input['filter_comments'])) $input['filter_comments'] = null;
	if (!array_key_exists($input['filter_comments'], $location)) $input['filter_comments'] = null;
	
	return $input;
	
}
