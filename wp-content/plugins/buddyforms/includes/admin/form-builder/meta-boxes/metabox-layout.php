<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }



function buddyforms_metabox_form_designer() {
	buddyforms_layout_screen();
}

function buddyforms_layout_defaults($form_type = '') {

	$json['labels_disable_css']    = '';
	$json['labels_layout']    = 'inline';
	$json['label_font_size']  = '';
	$json['label_font_color'] = array( 'color' => '', 'style' => 'auto' );
	$json['label_font_style'] = 'bold';

	$json['desc_disable_css']    = '';
	$json['desc_position']   = 'above_field';
	$json['desc_font_size']  = '';
	$json['desc_font_color'] = array( 'color' => '', 'style' => 'auto' );
	$json['desc_font_style'] = 'italic';

	$json['field_disable_css']    = '';
	$json['field_padding']                 = '15';
	$json['field_background_color']        = array( 'color' => '', 'style' => 'auto' );
	$json['field_border_color']            = array( 'color' => '', 'style' => 'auto' );
	$json['field_border_width']            = '';
	$json['field_border_radius']           = '';
	$json['field_font_size']               = '15';
	$json['field_font_color']              = array( 'color' => '', 'style' => 'auto' );
	$json['field_placeholder_font_color']  = array( 'color' => '', 'style' => 'auto' );
	$json['field_active_background_color'] = array( 'color' => '', 'style' => 'auto' );
	$json['field_active_border_color']     = array( 'color' => '', 'style' => 'auto' );
	$json['field_active_font_color']       = array( 'color' => '', 'style' => 'auto' );

	$json['button_disable_css'] = '';
	$json['submit_text']        = ( ! empty( $form_type ) && $form_type === 'post' ) ? __( 'Publish', 'buddyforms' ) : __( 'Submit', 'buddyforms' );
	if ( ! empty( $form_type ) && $form_type === 'post' ) {
		$json['draft_text'] = __( 'Save as draft', 'buddyforms' );
	}
	$json['button_width']            = 'blockmobile';
	$json['button_alignment']        = 'left';
	$json['button_size']             = 'large';
	$json['button_class']            = '';
	$json['button_border_radius']    = '';
	$json['button_border_width']     = '';
	$json['button_background_color'] = array( 'color' => '', 'style' => 'auto' );
	$json['button_font_color']       = array( 'color' => '', 'style' => 'auto' );
	$json['button_border_color']     = array( 'color' => '', 'style' => 'auto' );

	$json['button_background_color_hover'] = array( 'color' => '', 'style' => 'auto' );
	$json['button_font_color_hover']       = array( 'color' => '', 'style' => 'auto' );
	$json['button_border_color_hover']     = array( 'color' => '', 'style' => 'auto' );

	$json['other_elements_disable_css']    = '';
	$json['radio_button_alignment'] = 'inline';
	$json['checkbox_alignment']     = 'inline';

	$json['custom_css'] = '';

	$json['extras_disable_all_css']    = '';

	return $json;

}

function buddyforms_load_form_layout() {
	global $buddyforms;

	$form_slug = $_POST['form_slug'];
	$json      = array();


	if ( $form_slug == 'bf_global' ) {
		$options = get_option( 'buddyforms_layout_options' );
		echo json_encode( $options['layout'] );
		die();
	}

	if ( $form_slug == 'reset' ) {
		$json = buddyforms_layout_defaults();
		echo json_encode( $json );
		die();
	}

	if ( isset( $buddyforms[ $form_slug ]['layout'] ) ) {
		$json = $buddyforms[ $form_slug ]['layout'];
		echo json_encode( $json );
		die();
	}

	$json['error'] = __( 'Please enter a name', 'buddyforms' );
	die();
}

add_action( 'wp_ajax_buddyforms_load_form_layout', 'buddyforms_load_form_layout' );

function buddyforms_layout_screen( $option_name = "buddyforms_options" ) {
	global $buddyforms, $form_slug;

	$option_name = $option_name . '[layout]';

	if ( isset( $_GET['action'] ) ) {
		$options = get_post_meta( get_the_ID(), '_buddyforms_options', true );
	} else {
		$options = get_option( 'buddyforms_layout_options' );
	}


	$form_setup = array();

	$form_type = '';
	if ( isset( $buddyforms[ $form_slug ]['form_type'] ) ) {
		$form_type = $buddyforms[ $form_slug ]['form_type'];
	}

	$defaults = buddyforms_layout_defaults($form_type);


	// Labels
	$form_setup['Labels'][] = new Element_HTML( sprintf('<h4 style="margin-top: 30px; text-transform: uppercase;">%s</h4>', __( 'Labels', 'buddyforms' )) );

	$labels_disable_css          = isset( $options['layout']['labels_disable_css'] ) ? $options['layout']['labels_disable_css'] : $defaults['labels_disable_css'];
	$form_setup['Labels'][] = new Element_Checkbox( __( 'Disable CSS', 'buddyforms' ), $option_name . "[labels_disable_css]", array(
		'disable'  => __( 'Disable CSS for labels on this form?', 'buddyforms' ),
	), array(
		'value'     => $labels_disable_css,
		'shortDesc' => ''
	) );

	$labels_layout          = isset( $options['layout']['labels_layout'] ) ? $options['layout']['labels_layout'] : $defaults['labels_layout'];
	$form_setup['Labels'][] = new Element_Radio( '<b>' . __( 'Use labels as placeholders?', 'buddyforms' ) . '</b>', $option_name . "[labels_layout]", array(
		'label'  => __( 'Show labels', 'buddyforms' ),
		'inline' => __( 'Use as placeholder', 'buddyforms' ),
	), array(
		'value'     => $labels_layout,
		'shortDesc' => sprintf('<b>%s</b>: %s <br><b>%s</b>: %s ', __( 'Show labels', 'buddyforms' ), __( 'display the labels above the text fields.', 'buddyforms'), __('Use as placeholder', 'buddyforms'), __( 'hide labels and display as placeholder text inside text fields .', 'buddyforms' ))
	) );

	$label_font_size        = isset( $options['layout']['label_font_size'] ) ? $options['layout']['label_font_size'] : $defaults['label_font_size'];
	$form_setup['Labels'][] = new Element_Number( '<b>' . __( 'Label Font Size', 'buddyforms' ) . '</b>', $option_name . "[label_font_size]", array(
		'value'     => $label_font_size,
		'shortDesc' => __( 'Just enter a number. Leave empty = auto', 'buddyforms' )
	) );

	$label_font_color       = isset( $options['layout']['label_font_color'] ) ? $options['layout']['label_font_color'] : $defaults['label_font_color'];
	$form_setup['Labels'][] = new Element_Color( '<b>' . __( 'Label Font Color', 'buddyforms' ) . '</b>', $option_name . "[label_font_color]", array(
		'value'     => $label_font_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$label_font_style       = isset( $options['layout']['label_font_style'] ) ? $options['layout']['label_font_style'] : $defaults['label_font_style'];
	$form_setup['Labels'][] = new Element_Radio( '<b>' . __( 'Label Font Style', 'buddyforms' ) . '</b>', $option_name . "[label_font_style]", array(
		'normal'     => __( 'Normal', 'buddyforms' ),
		'italic'     => '<i>' . __( 'Italic', 'buddyforms' ) . '</i>',
		'bold'       => '<b>' . __( 'Bold', 'buddyforms' ) . '</b>',
		'bolditalic' => '<b><i>' . __( 'Bold Italic', 'buddyforms' ) . '</i></b>',
	), array(
		'value'     => $label_font_style,
		'shortDesc' => ''
	) );


	// Descriptions
	$form_setup['Descriptions'][] = new Element_HTML( sprintf('<h4 style="margin-top: 30px; text-transform: uppercase;">%s</h4>', __( 'Descriptions', 'buddyforms' )) );

	$desc_disable_css          = isset( $options['layout']['desc_disable_css'] ) ? $options['layout']['desc_disable_css'] : $defaults['desc_disable_css'];
	$form_setup['Descriptions'][] = new Element_Checkbox( 'Disable CSS', $option_name . "[desc_disable_css]", array(
		'disable'  => __( 'Disable CSS for descriptions on this form?', 'buddyforms' ),
	), array(
		'value'     => $desc_disable_css,
		'shortDesc' => ''
	) );

	$desc_position                = isset( $options['layout']['desc_position'] ) ? $options['layout']['desc_position'] : 'blockmobile';
	$form_setup['Descriptions'][] = new Element_Radio( '<b>' . __( 'Description Position', 'buddyforms' ) . '</b>', $option_name . "[desc_position]", array(
		'above_field' => __( 'Above form field', 'buddyforms' ),
		'below_field' => __( 'Below form field', 'buddyforms' ),
	), array(
		'value'     => $desc_position,
		'shortDesc' => ''
	) );

	$desc_font_size               = isset( $options['layout']['desc_font_size'] ) ? $options['layout']['desc_font_size'] : '';
	$form_setup['Descriptions'][] = new Element_Number( '<b>' . __( 'Description Font Size', 'buddyforms' ) . '</b>', $option_name . "[desc_font_size]", array(
		'value'     => $desc_font_size,
		'shortDesc' => __( 'in px, just enter a number. Leave empty = auto', 'buddyforms' )
	) );

	$desc_font_color              = isset( $options['layout']['desc_font_color'] ) ? $options['layout']['desc_font_color'] : '';
	$form_setup['Descriptions'][] = new Element_Color( '<b>' . __( 'Description Font Color', 'buddyforms' ) . '</b>', $option_name . "[desc_font_color]", array(
		'value'     => $desc_font_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$desc_font_style              = isset( $options['layout']['desc_font_style'] ) ? $options['layout']['desc_font_style'] : 'bold';
	$form_setup['Descriptions'][] = new Element_Radio( '<b>' . __( 'Description Font Style', 'buddyforms' ) . '</b>', $option_name . "[desc_font_style]", array(
		'normal' => __( 'Normal', 'buddyforms' ),
		'italic' => '<i>' . __( 'Italic', 'buddyforms' ) . '</i>',
	), array(
		'value'     => $desc_font_style,
		'shortDesc' => ''
	) );


	// Other Form Elements
	$form_setup['Form Elements'][] = new Element_HTML( sprintf('<h4 style="margin-top: 30px; text-transform: uppercase;">%s</h4>', __( 'Other Elements', 'buddyforms' )) );

	$other_elements_disable_css  = isset( $options['layout']['other_elements_disable_css'] ) ? $options['layout']['other_elements_disable_css'] : $defaults['other_elements_disable_css'];
	$form_setup['Form Elements'][] = new Element_Checkbox( 'Disable CSS', $option_name . "[other_elements_disable_css]", array(
		'disable'  => __( 'Disable CSS for these form elements, on this form?', 'buddyforms' ),
	), array(
		'value'     => $other_elements_disable_css,
		'shortDesc' => ''
	) );

	$radio_button_alignment        = isset( $options['layout']['radio_button_alignment'] ) ? $options['layout']['radio_button_alignment'] : $defaults['radio_button_alignment'];
	$form_setup['Form Elements'][] = new Element_Radio( '<b>' . __( 'Radio Button Alignment', 'buddyforms' ) . '</b>', $option_name . "[radio_button_alignment]", array(
		'inline-block' => __( 'Inline', 'buddyforms' ),
		'block'        => __( 'List', 'buddyforms' ),
	), array(
		'value'     => $radio_button_alignment,
		'shortDesc' => __( 'Want to display your radio buttons in a row (inline) or in a vertical list?', 'buddyforms' )
	) );

	$checkbox_alignment            = isset( $options['layout']['checkbox_alignment'] ) ? $options['layout']['checkbox_alignment'] : $defaults['checkbox_alignment'];
	$form_setup['Form Elements'][] = new Element_Radio( '<b>' . __( 'Checkbox Option Alignment', 'buddyforms' ) . '</b>', $option_name . "[checkbox_alignment]", array(
		'inline-block' => __( 'Inline', 'buddyforms' ),
		'block'        => __( 'List', 'buddyforms' ),
	), array(
		'value'     => $checkbox_alignment,
		'shortDesc' => __( 'Want to display your checkbox options in a row (inline) or in a vertical list?', 'buddyforms' )
	) );


	// Text Fields
	$form_setup['Text Fields'][] = new Element_HTML( sprintf('<h4 style="margin-top: 30px; text-transform: uppercase;">%s</h4>', __( 'Text Fields', 'buddyforms' )) );

	$field_disable_css 	         = isset( $options['layout']['field_disable_css'] ) ? $options['layout']['field_disable_css'] : $defaults['field_disable_css'];
	$form_setup['Text Fields'][] = new Element_Checkbox( 'Disable CSS', $option_name . "[field_disable_css]", array(
		'disable'  => __( 'Disable CSS for text fields on this form?', 'buddyforms' ),
	), array(
		'value'     => $field_disable_css,
		'shortDesc' => ''
	) );

	$field_padding               = isset( $options['layout']['field_padding'] ) ? $options['layout']['field_padding'] : $defaults['field_padding'];
	$form_setup['Text Fields'][] = new Element_Number( '<b>' . __( 'Field Padding', 'buddyforms' ) . '</b>', $option_name . "[field_padding]", array(
		'value'     => $field_padding,
		'shortDesc' => __( 'Just enter a number. Default is 15 (px)', 'buddyforms' )
	) );

	$field_background_color      = isset( $options['layout']['field_background_color'] ) ? $options['layout']['field_background_color'] : $defaults['field_background_color'];
	$form_setup['Text Fields'][] = new Element_Color( '<b>' . __( 'Field Background Color ', 'buddyforms' ) . '</b>', $option_name . "[field_background_color]", array(
		'value'     => $field_background_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$field_border_color          = isset( $options['layout']['field_border_color'] ) ? $options['layout']['field_border_color'] : $defaults['field_border_color'];
	$form_setup['Text Fields'][] = new Element_Color( '<b>' . __( 'Field Border Color', 'buddyforms' ) . '</b>', $option_name . "[field_border_color]", array(
		'value'     => $field_border_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$field_border_width          = isset( $options['layout']['field_border_width'] ) ? $options['layout']['field_border_width'] : $defaults['field_border_width'];
	$form_setup['Text Fields'][] = new Element_Number( '<b>' . __( 'Field Border Width', 'buddyforms' ) . '</b>', $option_name . "[field_border_width]", array(
		'value'     => $field_border_width,
		'shortDesc' => __( 'Just enter a number, in px. Leave empty = auto', 'buddyforms' )
	) );

	$field_border_radius         = isset( $options['layout']['field_border_radius'] ) ? $options['layout']['field_border_radius'] : $defaults['field_border_radius'];
	$form_setup['Text Fields'][] = new Element_Number( '<b>' . __( 'Field Corner Radius', 'buddyforms' ) . '</b>', $option_name . "[field_border_radius]", array(
		'value'     => $field_border_radius,
		'shortDesc' => __( 'Rounded corners. Just enter a number. Leave empty = auto', 'buddyforms' )
	) );

	$field_font_size             = isset( $options['layout']['field_font_size'] ) ? $options['layout']['field_font_size'] : $defaults['field_font_size'];
	$form_setup['Text Fields'][] = new Element_Number( '<b>' . __( 'Field Font Size', 'buddyforms' ) . '</b>', $option_name . "[field_font_size]", array(
		'value'     => $field_font_size,
		'shortDesc' => __( 'Just enter a number, in px. Leave empty = auto', 'buddyforms' )
	) );

	$field_font_color            = isset( $options['layout']['field_font_color'] ) ? $options['layout']['field_font_color'] : $defaults['field_font_color'];
	$form_setup['Text Fields'][] = new Element_Color( '<b>' . __( 'Field Font Color', 'buddyforms' ) . '</b>', $option_name . "[field_font_color]", array(
		'value'     => $field_font_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$field_placeholder_font_color = isset( $options['layout']['field_placeholder_font_color'] ) ? $options['layout']['field_placeholder_font_color'] : $defaults['field_placeholder_font_color'];
	$form_setup['Text Fields'][]  = new Element_Color( '<b>' . __( 'Field Placeholder Font Color', 'buddyforms' ) . '</b>', $option_name . "[field_placeholder_font_color]", array(
		'value'     => $field_placeholder_font_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$field_active_background_color = isset( $options['layout']['field_active_background_color'] ) ? $options['layout']['field_active_background_color'] : $defaults['field_active_background_color'];
	$form_setup['Text Fields'][]   = new Element_Color( '<b>' . __( 'Field Active Background Color', 'buddyforms' ) . '</b>', $option_name . "[field_active_background_color]", array(
		'value'     => $field_active_background_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$field_active_border_color   = isset( $options['layout']['field_active_border_color'] ) ? $options['layout']['field_active_border_color'] : $defaults['field_active_border_color'];
	$form_setup['Text Fields'][] = new Element_Color( '<b>' . __( 'Field Active Border Color', 'buddyforms' ) . '</b>', $option_name . "[field_active_border_color]", array(
		'value'     => $field_active_border_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$field_active_font_color     = isset( $options['layout']['field_active_font_color'] ) ? $options['layout']['field_active_font_color'] : $defaults['field_active_font_color'];
	$form_setup['Text Fields'][] = new Element_Color( '<b>' . __( 'Field Active Font Color', 'buddyforms' ) . '</b>', $option_name . "[field_active_font_color]", array(
		'value'     => $field_active_font_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );


	// Buttons
	$form_setup['Submit Button'][] = new Element_HTML( sprintf('<h4 style="margin-top: 30px; text-transform: uppercase;">%s</h4>', __( 'Submit Button', 'buddyforms' )) );

	$button_disable_css 	       = isset( $options['layout']['button_disable_css'] ) ? $options['layout']['button_disable_css'] : $defaults['button_disable_css'];
	$form_setup['Submit Button'][] = new Element_Checkbox( 'Disable CSS', $option_name . "[button_disable_css]", array(
		'disable'  => __( 'Disable CSS for buttons on this form?', 'buddyforms' ),
	), array(
		'value'     => $button_disable_css,
		'shortDesc' => ''
	) );

	$submit_text = isset( $options['layout']['submit_text'] ) ? $options['layout']['submit_text'] : $defaults['submit_text'];
	$form_setup['Submit Button'][] = new Element_Textbox( '<b>' . __( 'Button Submit Text', 'buddyforms' ) . '</b>', $option_name . "[submit_text]", array(
		'value'     => $submit_text,
		'shortDesc' => sprintf('%s <br> %s', __( 'Default text for the submit button . Default is "Submit" .', 'buddyforms' ), __( 'HTML is allowed, so you can embed icons .', 'buddyforms' ))
	) );

	$button_width                  = isset( $options['layout']['button_width'] ) ? $options['layout']['button_width'] : $defaults['button_width'];
	$form_setup['Submit Button'][] = new Element_Radio( '<b>' . __( 'Button Width', 'buddyforms' ) . '</b>', $option_name . "[button_width]", array(
		'blockmobile' => __( 'Full width button on mobile only', 'buddyforms' ),
		'block'       => __( 'Always full width button', 'buddyforms' ),
		'inline'      => __( 'Always normal width button', 'buddyforms' ),
	), array(
		'value'     => $button_width,
		'shortDesc' => __( 'We recommend full width buttons on mobile, looks neater.', 'buddyforms' )
	) );

	$button_alignment              = isset( $options['layout']['button_alignment'] ) ? $options['layout']['button_alignment'] : $defaults['button_alignment'];
	$form_setup['Submit Button'][] = new Element_Radio( '<b>' . __( 'Button Alignment', 'buddyforms' ) . '</b>', $option_name . "[button_alignment]", array(
		'left'   => __( 'Left', 'buddyforms' ),
		'center' => __( 'Center', 'buddyforms' ),
		'right'  => __( 'Right', 'buddyforms' ),
	), array(
		'value'     => $button_alignment,
		'shortDesc' => __( 'How to align your submit button?', 'buddyforms' )
	) );

	$button_size                   = isset( $options['layout']['button_size'] ) ? $options['layout']['button_size'] : $defaults['button_size'];
	$form_setup['Submit Button'][] = new Element_Radio( '<b>' . __( 'Button Size', 'buddyforms' ) . '</b>', $option_name . "[button_size]", array(
		'auto'   => __( 'Auto', 'buddyforms' ),
		'large'  => __( 'Large', 'buddyforms' ),
		'xlarge' => __( 'Extra Large', 'buddyforms' ),
	), array(
		'value'     => $button_size,
		'shortDesc' => ''
	) );

	$button_class                  = isset( $options['layout']['button_class'] ) ? $options['layout']['button_class'] : $defaults['button_class'];
	$form_setup['Submit Button'][] = new Element_Textbox( '<b>' . __( 'Add custom CSS classes to button', 'buddyforms' ) . '</b>', $option_name . "[button_class]", array(
		'value'     => $button_class,
		'shortDesc' => sprintf( '%s "btn btn-primary"', __( 'For example:', 'buddyforms' ))
	) );

	$button_border_radius          = isset( $options['layout']['button_border_radius'] ) ? $options['layout']['button_border_radius'] : $defaults['button_border_radius'];
	$form_setup['Submit Button'][] = new Element_Number( '<b>' . __( 'Button Corner Radius', 'buddyforms' ) . '</b>', $option_name . "[button_border_radius]", array(
		'value'     => $button_border_radius,
		'shortDesc' => __( 'Rounded corners. Just enter a number. Leave empty = auto', 'buddyforms' )
	) );

	$button_border_width           = isset( $options['layout']['button_border_width'] ) ? $options['layout']['button_border_width'] : '';
	$form_setup['Submit Button'][] = new Element_Number( '<b>' . __( 'Button Border Width', 'buddyforms' ) . '</b>', $option_name . "[button_border_width]", array(
		'value'     => $button_border_width,
		'shortDesc' => __( 'Border width in pixels. Just enter a number. Leave empty = auto', 'buddyforms' )
	) );

	$button_background_color       = isset( $options['layout']['button_background_color'] ) ? $options['layout']['button_background_color'] : $defaults['button_background_color'];
	$form_setup['Submit Button'][] = new Element_Color( '<b>' . __( 'Button Background Color', 'buddyforms' ) . '</b>', $option_name . "[button_background_color]", array(
		'value'     => $button_background_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$button_font_color             = isset( $options['layout']['button_font_color'] ) ? $options['layout']['button_font_color'] : $defaults['button_font_color'];
	$form_setup['Submit Button'][] = new Element_Color( '<b>' . __( 'Button Font Color', 'buddyforms' ) . '</b>', $option_name . "[button_font_color]", array(
		'value'     => $button_font_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$button_border_color           = isset( $options['layout']['button_border_color'] ) ? $options['layout']['button_border_color'] : $defaults['button_border_color'];
	$form_setup['Submit Button'][] = new Element_Color( '<b>' . __( 'Button Border Color', 'buddyforms' ) . '</b>', $option_name . "[button_border_color]", array(
		'value'     => $button_border_color,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$button_background_color_hover = isset( $options['layout']['button_background_color_hover'] ) ? $options['layout']['button_background_color_hover'] : $defaults['button_background_color_hover'];
	$form_setup['Submit Button'][] = new Element_Color( '<b>' . __( 'Button Background Color Hover', 'buddyforms' ) . '</b>', $option_name . "[button_background_color_hover]", array(
		'value'     => $button_background_color_hover,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$button_font_color_hover       = isset( $options['layout']['button_font_color_hover'] ) ? $options['layout']['button_font_color_hover'] : $defaults['button_font_color_hover'];
	$form_setup['Submit Button'][] = new Element_Color( '<b>' . __( 'Button Font Color Hover', 'buddyforms' ) . '</b>', $option_name . "[button_font_color_hover]", array(
		'value'     => $button_font_color_hover,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );

	$button_border_color_hover     = isset( $options['layout']['button_border_color_hover'] ) ? $options['layout']['button_border_color_hover'] : $defaults['button_border_color_hover'];
	$form_setup['Submit Button'][] = new Element_Color( '<b>' . __( 'Button Border Color Hover', 'buddyforms' ) . '</b>', $option_name . "[button_border_color_hover]", array(
		'value'     => $button_border_color_hover,
		'shortDesc' => __( 'Default is auto', 'buddyforms' )
	) );


	// Custom CSS
	$custom_css                 = isset( $options['layout']['custom_css'] ) ? $options['layout']['custom_css'] : $defaults['custom_css'];
	$form_setup['Custom CSS'][] = new Element_Textarea( '<b>' . __( 'Custom CSS', 'buddyforms' ) . '</b>', $option_name . "[custom_css]", array(
		'rows'      => 3,
		'style'     => "width:100%",
		'class'     => 'display_message display_form',
		'value'     => $custom_css,
		'id'        => 'custom_css',
		'shortDesc' => __( 'Add custom styles to the form', 'buddyforms' )
	) );

	// Extras
	$extras_disable_all_css = isset( $options['layout']['extras_disable_all_css'] ) ? $options['layout']['extras_disable_all_css'] : $defaults['extras_disable_all_css'];
	$form_setup['Extras'][] = new Element_Checkbox( 'Disable all CSS', $option_name . "[extras_disable_all_css]", array(
		'disable'  => __( 'Disable all BuddyForms CSS on this form', 'buddyforms' ),
	), array(
		'value'     => $extras_disable_all_css,
		'shortDesc' => ''
	) );

	if ( get_post_type() == 'buddyforms' ) {
		echo '<p>' . __( 'Copy layout settings from' ) . '</p>';

		echo '<p><select id="bf_form_layout_select" style="width: 50% !important; margin-right: 10px">';
		echo '<option value="bf_global">Global Settings</option>';
		if ( isset( $buddyforms ) ) {
			foreach ( $buddyforms as $form_slug => $form ) {
				echo '<option value="' . $form_slug . '">' . $form["name"] . '</option>';
			}
		}
		echo '</select>';
		echo '<a id="bf_load_layout_options" class="button" href="#"><span style="display: none;" class="layout-spinner spinner"></span> ' . __( 'Load Layout Settings', 'buddyforms' ) . '</a>';
		echo '<a id="bf_reset_layout_options" class="button" href="#"><span style="display: none;" class="layout-spinner-reset spinner"></span> '. __( 'Reset', 'buddyforms' ).'</a></p>';
	}
	?>

    <div class="tabbable buddyform-tabs-left">
        <ul class="nav buddyform-nav-tabs buddyform-nav-pills">
			<?php
			$i = 0;
			foreach ( $form_setup as $tab => $fields ) {
				$tab_slug = sanitize_title( $tab ); ?>
            <li class="<?php echo $i == 0 ? 'active' : '' ?><?php echo $tab_slug ?>_nav"><a
                        href="#<?php echo $tab_slug; ?>"
                        data-toggle="tab"><?php echo $tab; ?></a>
                </li><?php
				$i ++;
			}
			// Allow other plugins to add new sections
			do_action( 'buddyforms_form_designer_nav_li_last' );
			?>

        </ul>
        <div class="tab-content">
			<?php
			$i = 0;
			foreach ( $form_setup as $tab => $fields ) {
				$tab_slug = sanitize_title( $tab ); ?>
                <div class="tab-pane <?php echo $i == 0 ? 'active' : '' ?>"
                     id="<?php echo $tab_slug; ?>">
                    <div class="buddyforms_accordion_general">
						<?php
						// get all the html elements and add them above the settings
						foreach ( $fields as $field_key => $field ) {
							$type = $field->getAttribute( 'type' );
							if ( $type == 'html' ) {
								$field->render();
							}
						} ?>
                        <table class="wp-list-table widefat posts fixed">
                            <tbody>
							<?php foreach ( $fields as $field_key => $field ) {

								$type     = $field->getAttribute( 'type' );
								$class    = $field->getAttribute( 'class' );
								$disabled = $field->getAttribute( 'disabled' );
								$classes  = empty( $class ) ? '' : $class . ' ';
								$classes  .= empty( $disabled ) ? '' : 'bf-' . $disabled . ' ';

								// If the form element is not html create it as table row
								if ( $type != 'html' ) {
									?>
                                    <tr class="<?php echo $classes ?>">
                                        <th scope="row">
                                            <label for="form_title"><?php echo $field->getLabel() ?></label>
                                        </th>
                                        <td>
											<?php echo $field->render() ?>
                                            <p class="description"><?php echo $field->getShortDesc() ?></p>
                                        </td>
                                    </tr>
								<?php }
							} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
				<?php
				$i ++;
			}
			// Allow other plugins to hook there content for there nav into the tab content
			do_action( 'buddyforms_form_designer_tab_pane_last' );
			?>
        </div>  <!-- close .tab-content -->
    </div> <!--	close .tabs -->

	<?php
}
