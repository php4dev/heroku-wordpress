<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Ninja Forms vendor
 * @since 4.4
 */
class Vc_Vendor_NinjaForms implements Vc_Vendor_Interface {

	/**
	 * Implement interface, map ninja forms shortcode
	 * @since 4.4
	 */
	public function load() {
		vc_lean_map( 'ninja_forms_display_form', array(
			$this,
			'addShortcodeSettings',
		) );

	}

	/**
	 * Add Shortcode To Visual Composer
	 *
	 * @param array $ninja_forms - list of ninja forms (ID->NAME)
	 *
	 * @since 4.4
	 *
	 * @deprecated 4.9
	 */
	public function mapNinjaForms( $ninja_forms = array() ) {
		// We map only ninja_forms_display_form shortcode same as contact-form-7
		vc_map( array(
				'base' => 'ninja_forms_display_form',
				'name' => __( 'Ninja Forms', 'js_composer' ),
				'icon' => 'icon-wpb-ninjaforms',
				'category' => __( 'Content', 'js_composer' ),
				'description' => __( 'Place Ninja Form', 'js_composer' ),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => __( 'Select ninja form', 'js_composer' ),
						'param_name' => 'id',
						'value' => $ninja_forms,
						'save_always' => true,
						'description' => __( 'Choose previously created ninja form from the drop down list.', 'js_composer' ),
					),
				),
			) );
	}

	/**
	 * Mapping settings for lean method.
	 *
	 * @since 4.9
	 *
	 * @param $tag
	 *
	 * @return array
	 */
	public function addShortcodeSettings( $tag ) {
		if ( ! function_exists( 'ninja_forms_get_all_forms' ) ) {
			// experimental, maybe not needed
			require_once( NINJA_FORMS_DIR . '/includes/database.php' );
		}
		$ninja_forms_data = ninja_forms_get_all_forms();
		$ninja_forms = array();
		if ( ! empty( $ninja_forms_data ) ) {
			// Fill array with Name=>Value(ID)
			foreach ( $ninja_forms_data as $key => $value ) {
				if ( is_array( $value ) ) {
					$ninja_forms[ $value['name'] ] = $value['id'];
				}
			}
		}

		return array(
			'base' => $tag,
			'name' => __( 'Ninja Forms', 'js_composer' ),
			'icon' => 'icon-wpb-ninjaforms',
			'category' => __( 'Content', 'js_composer' ),
			'description' => __( 'Place Ninja Form', 'js_composer' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Select ninja form', 'js_composer' ),
					'param_name' => 'id',
					'value' => $ninja_forms,
					'save_always' => true,
					'description' => __( 'Choose previously created ninja form from the drop down list.', 'js_composer' ),
				),
			),
		);
	}
}
