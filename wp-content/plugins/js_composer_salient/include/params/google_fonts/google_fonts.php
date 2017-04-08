<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Class Vc_Google_Fonts
 * @since 4.3
 * vc_map examples:
 *      'params' => array(
 *          array(
 *                'type' => 'google_fonts',
 *                'param_name' => 'google_fonts',
 *                'value' => '',// Not recommended, this will override 'settings'. Example:
 *     'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900
 *     bold italic:900:italic'),
 *                'settings' => array(
 *                    'fields'=>array(
 *                        'font_family'=>'Abril Fatface:regular',//
 *     'Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',
 *     Default font family and all available styles to fetch
 *                        'font_style'=>'400 regular:400:normal', // Default font style. Name:weight:style, example:
 *     "800 bold regular:800:normal"
 *                        'font_family_description' => __('Select font family.','js_composer'),
 *                        'font_style_description' => __('Select font styling.','js_composer')
 *                  )
 *                ),
 *                'description' => __( 'Description for this group', 'js_composer' ), // Description for field group
 *            ),
 *      )
 */
class Vc_Google_Fonts {
	public $fonts_list = '[{"font_family":"Abril Fatface","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Arimo","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Arvo","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Bitter","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Cabin","font_styles":"regular,italic,500,500italic,600,600italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Cinzel","font_styles":"regular,700,900","font_types":"400 regular:400:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Coda","font_styles":"regular,800","font_types":"400 regular:400:normal,800 bold regular:800:normal"},{"font_family":"Condiment","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Delius","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Dosis","font_styles":"200,300,regular,500,600,700,800","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,800 bold regular:800:normal"},{"font_family":"Droid Sans","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Droid Serif","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Exo","font_styles":"100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,200 light regular:200:normal,200 light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Hind","font_styles":"300,regular,500,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Istok Web","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Josefin Sans","font_styles":"100,100italic,300,300italic,regular,italic,600,600italic,700,700italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Josefin Slab","font_styles":"100,100italic,300,300italic,regular,italic,600,600italic,700,700italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Lato","font_styles":"100,100italic,300,300italic,regular,italic,700,700italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Libre Baskerville","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Lobster","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Lora","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Merienda","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Merriweather","font_styles":"300,300italic,regular,italic,700,700italic,900,900italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Merriweather Sans","font_styles":"300,300italic,regular,italic,700,700italic,800,800italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic"},{"font_family":"Montserrat","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Muli","font_styles":"300,300italic,regular,italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic"},{"font_family":"Neuton","font_styles":"200,300,regular,italic,700,800","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,800 bold regular:800:normal"},{"font_family":"Nothing You Could Do","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Noto Sans","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Noto Serif","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Old Standard TT","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Oleo Script","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Open Sans","font_styles":"300,300italic,regular,italic,600,600italic,700,700italic,800,800italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic"},{"font_family":"Open Sans Condensed","font_styles":"300,300italic,700","font_types":"300 light regular:300:normal,300 light italic:300:italic,700 bold regular:700:normal"},{"font_family":"Orbitron","font_styles":"regular,500,700,900","font_types":"400 regular:400:normal,500 bold regular:500:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Oswald","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Oxygen","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"PT Sans","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"PT Serif","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Pacifico","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Permanent Marker","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Philosopher","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Playfair Display","font_styles":"regular,italic,700,700italic,900,900italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Radley","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Raleway","font_styles":"100,200,300,regular,500,600,700,800,900","font_types":"100 light regular:100:normal,200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,800 bold regular:800:normal,900 bold regular:900:normal"},{"font_family":"Roboto","font_styles":"100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Roboto Condensed","font_styles":"300,300italic,regular,italic,700,700italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Roboto Slab","font_styles":"100,300,regular,700","font_types":"100 light regular:100:normal,300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Satisfy","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Signika","font_styles":"300,regular,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Source Code Pro","font_styles":"200,300,regular,500,600,700,900","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Ubuntu","font_styles":"300,300italic,regular,italic,500,500italic,700,700italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Ubuntu Mono","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Vollkorn","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Yeseva One","font_styles":"regular","font_types":"400 regular:400:normal"}]';

	/**
	 * @param $settings
	 * @param $value
	 *
	 * @since 4.3
	 * @return string
	 */
	public function render( $settings, $value ) {
		$fields = array();
		$values = array();
		$set = isset( $settings['settings'], $settings['settings']['fields'] ) ? $settings['settings']['fields'] : array();
		extract( $this->_vc_google_fonts_parse_attributes( $set, $value ) );
		ob_start();
		include vc_path_dir( 'TEMPLATES_DIR', 'params/google_fonts/template.php' );

		return ob_get_clean();
	}

	/**
	 *
	 * Load google fonts list for param
	 * To change this list use add_filters('vc_google_fonts_get_fonts_filter','your_custom_function'); and change array
	 * vc_filter: vc_google_fonts_get_fonts_filter
	 * @since 4.3
	 * @return array List of available fonts as array of objects. {"font_family":"Abril
	 *     Fatface","font_styles":"regular","font_types":"400 regular:400:normal"}
	 *
	 * @return array
	 */
	public function _vc_google_fonts_get_fonts() {
		return apply_filters( 'vc_google_fonts_get_fonts_filter', json_decode( $this->fonts_list ) );
	}

	/**
	 * @param $attr
	 * @param $value
	 *
	 * @since 4.3
	 * @return array
	 */
	public function _vc_google_fonts_parse_attributes( $attr, $value ) {
		$fields = array();
		if ( is_array( $attr ) && ! empty( $attr ) ) {
			foreach ( $attr as $key => $val ) {
				if ( is_numeric( $key ) ) {
					$fields[ $val ] = '';
				} else {
					$fields[ $key ] = $val;
				}
			}
		}

		$values = vc_parse_multi_attribute( $value, array(
			'font_family' => isset( $fields['font_family'] ) ? $fields['font_family'] : '',
			'font_style' => isset( $fields['font_style'] ) ? $fields['font_style'] : '',
			'font_family_description' => isset( $fields['font_family_description'] ) ? $fields['font_family_description'] : '',
			'font_style_description' => isset( $fields['font_style_description'] ) ? $fields['font_style_description'] : '',
		) );

		return array( 'fields' => $fields, 'values' => $values );
	}
}

/**
 * Function for rendering param in edit form (add element)
 * Parse settings from vc_map and entered values.
 *
 * @param $settings
 * @param $value
 *
 * @since 4.3
 * vc_filter: vc_google_fonts_render_filter
 * @return mixed|void rendered template for params in edit form
 *
 */
function vc_google_fonts_form_field( $settings, $value ) {
	$google_fonts = new Vc_Google_Fonts();

	return apply_filters( 'vc_google_fonts_render_filter', $google_fonts->render( $settings, $value ) );
}
