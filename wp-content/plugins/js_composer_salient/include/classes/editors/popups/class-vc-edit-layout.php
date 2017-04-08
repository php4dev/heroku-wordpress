<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * WPBakery Visual Composer main class.
 *
 * @package WPBakeryVisualComposer
 * @since   4.3
 */

/**
 * Edit row layout
 *
 * @since   4.3
 */
class Vc_Edit_Layout implements Vc_Render {
	/**
	 * @deprecated 4.7
	 */
	public function render() {
		_deprecated_function( '\Vc_Edit_Layout::render', '4.7 (will be removed in 4.11)', '\Vc_Edit_Layout::renderUITemplate' );
		global $vc_row_layouts;
		vc_include_template( 'editors/popups/panel_edit_layout.tpl.php', array(
			'vc_row_layouts' => $vc_row_layouts,
		) );
	}
	public function renderUITemplate() {
		global $vc_row_layouts;
		vc_include_template( 'editors/popups/vc_ui-panel-row-layout.tpl.php', array(
			'vc_row_layouts' => $vc_row_layouts,
		) );
	}
}
