<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * @param $args
 *
 * @return mixed|string
 */
function buddyforms_form_html( $args ) {
	global $buddyforms, $bf_form_error, $post_id, $form_slug, $wp_query;

	/** @var WP_User $current_user */
	$current_user = '';
	$post_type    = $post_status = $the_post = $customfields = $revision_id = $post_parent = $redirect_to = $form_slug = $form_type = $form_notice = '';

	// Extract the form args
	extract( shortcode_atts( array(
		'post_type'    => '',
		'the_post'     => 0,
		'customfields' => false,
		'post_id'      => false,
		'revision_id'  => false,
		'post_parent'  => 0,
		'redirect_to'  => esc_url_raw( $_SERVER['REQUEST_URI'] ),
		'form_slug'    => '',
		'post_status'  => '',
		'form_notice'  => '',
		'current_user' => false,
	), $args ) );

	$is_registration_form   = ! empty( $buddyforms[ $form_slug ]['form_type'] ) && 'registration' === $buddyforms[ $form_slug ]['form_type'];
	$need_registration_form = ! empty( $buddyforms[ $form_slug ]['public_submit'] ) && 'registration_form' === $buddyforms[ $form_slug ]['public_submit'];

	if ( is_user_logged_in() ) {
		if ( ! empty( $buddyforms[ $form_slug ]['hide_for_logged_in_users'] ) && $buddyforms[ $form_slug ]['hide_for_logged_in_users'] == 'yes' ) {
			return '';
		}
	}

	if ( ! is_user_logged_in() && ! $is_registration_form && $need_registration_form ) {
		return buddyforms_get_wp_login_form( $form_slug, '', array( 'redirect_url' => $redirect_to ) );
	}

	if ( empty( $post_id ) && ! empty( $the_post ) ) {
		$post_id = $the_post->ID;
	}

	$form_action = ( ! empty( $args['action'] ) ) ? $args['action'] : 'save';

	$user_can_edit = false;
	if ( $form_action !== 'update' && bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_create', array(), $form_slug ) ) {
		$user_can_edit = true;
	}
	if ( $form_action === 'update' && bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_edit', array(), $form_slug ) || bf_user_can( $current_user->ID, 'buddyforms_' . $form_slug . '_all', array(), $form_slug ) ) {
		$user_can_edit = true;
	}

	$users_can_register = false;
	if ( is_multisite() ) {
		$users_can_register = users_can_register_signup_filter();
	} else {
		$users_can_register = get_site_option( 'users_can_register' );
	}

	if ( ! empty( $buddyforms[ $form_slug ]['form_type'] ) && $buddyforms[ $form_slug ]['form_type'] == 'registration' && empty( $users_can_register ) ) {
		$error_message = apply_filters( 'buddyforms_disable_registration_error_message', __( 'Sorry, but registration is disabled on this site at the moment.', 'buddyforms' ) );

		return '<div class="bf-alert error">' . $error_message . '</div>';
	}

	if ( ! empty( $buddyforms[ $form_slug ]['form_type'] ) && $buddyforms[ $form_slug ]['form_type'] == 'registration'
	     || isset( $buddyforms[ $form_slug ]['public_submit'] ) && $buddyforms[ $form_slug ]['public_submit'] == 'public_submit' && ! is_user_logged_in()
	) {
		$user_can_edit = true;
	}

	$user_can_edit = apply_filters( 'buddyforms_user_can_edit', $user_can_edit, $form_slug, $post_id );

	if ( $user_can_edit == false ) {

		$error_message = apply_filters( 'buddyforms_user_can_edit_error_message', __( 'You do not have the required user role to use this form', 'buddyforms' ) );

		return '<div class="bf-alert error">' . $error_message . '</div>';
	}

	// Form HTML Start. The Form is rendered as last step.
	$form_html = '';

	if ( ! empty( $form_slug ) && ! empty( $buddyforms ) && isset( $buddyforms[ $form_slug ] ) ) {
		$options                          = buddyforms_filter_frontend_js_form_options( $buddyforms[ $form_slug ], $form_slug, $post_id );
		$front_js_arguments[ $form_slug ] = $options;
		BuddyForms::buddyforms_js_global_set_parameters( $front_js_arguments );
	}

	$buddyforms_global_js_data = apply_filters( 'buddyforms_global_localize_scripts', BuddyForms::buddyforms_js_global_get_parameters( $form_slug ), $form_slug );
	if ( is_array( $buddyforms_global_js_data ) ) {
		$output = 'var buddyformsGlobal = ' . wp_json_encode( $buddyforms_global_js_data );
		ob_start();
		echo "<script type='text/javascript'>\n"; // CDATA and type='text/javascript' is not needed for HTML 5.
		echo "/* <![CDATA[ */\n";
		echo "$output\n";
		echo "/* ]]> */\n";
		echo "</script>\n";
		$global_js = ob_get_clean();
		if ( ! empty( $global_js ) ) {
			$form_html .= $global_js;
		}
	}
	// Form start point
	$form_html .= '<div id="buddyforms_form_hero_' . $form_slug . '" class="the_buddyforms_form ' . apply_filters( 'buddyforms_form_hero_classes', '' ) . '" >';

	// Hook above the form inside the BuddyForms form div
	$form_html = apply_filters( 'buddyforms_form_hero_top', $form_html, $form_slug );
	$form_html .= ! is_user_logged_in() && isset( $buddyforms[ $form_slug ]['public_submit_login'] ) && $buddyforms[ $form_slug ]['public_submit_login'] == 'above' ? buddyforms_get_login_form_template( $form_slug ) : '';


	//decide if the update of create message will show.
	$form_type      = ( ! empty( $form_type ) ) ? $form_type : 'submission';
	$message_source = 'after_submit_message_text';
	if ( 'registration' === $form_type ) {
		if ( is_user_logged_in() ) {
			$message_source = 'after_submit_message_text';
		}
	} else {
		if ( 'update' === $form_action ) {
			$message_source = 'after_update_submit_message_text';
		}
	}
	$form_notice  = buddyforms_form_display_message( $form_slug, $post_id, $message_source );
	$notice_class = '';
	if ( isset( $_POST['bf_submitted'] ) ) {
		$notice_class = apply_filters( 'buddyforms_form_notice_class', ! empty( $form_notice ) ? 'bf-alert success' : '', $form_slug );
	}
	$form_html    .= '<div class="' . $notice_class . '" id="form_message_' . $form_slug . '">';
	$global_error = ErrorHandler::get_instance();
	if ( ! empty( $global_error ) ) {
		$global_bf_error = $global_error->get_global_error();
		if ( ! empty( $global_bf_error ) && ! $global_bf_error->has_errors() && isset( $_POST['bf_submitted'] ) ) {
			$form_html .= $form_notice;
			if ( isset( $_POST['bf_submitted'] ) && $buddyforms[ $form_slug ]['after_submit'] == 'display_message' ) {
				return $form_html . '</div></div>';
			}
		}
	}

	$form_html .= '</div>';
	$form_html .= '<div class="form_wrapper clearfix">';

	$bfdesign = isset( $buddyforms[ $form_slug ]['layout'] ) ? $buddyforms[ $form_slug ]['layout'] : array();


	// Alright, let's set some defaults

	// Labels
	$bfdesign['labels_disable_css']        = isset( $bfdesign['labels_disable_css'] ) ? $bfdesign['labels_disable_css'] : '';
	$bfdesign['labels_layout']             = isset( $bfdesign['labels_layout'] ) ? $bfdesign['labels_layout'] : 'inline';
	$bfdesign['label_font_size']           = isset( $bfdesign['label_font_size'] ) ? $bfdesign['label_font_size'] : '';
	$bfdesign['label_font_color']['style'] = isset( $bfdesign['label_font_color']['style'] ) ? $bfdesign['label_font_color']['style'] : 'auto';
	$bfdesign['label_font_style']          = isset( $bfdesign['label_font_style'] ) ? $bfdesign['label_font_style'] : 'bold';

	// Form Elements
	$bfdesign['other_elements_disable_css'] = isset( $bfdesign['other_elements_disable_css'] ) ? $bfdesign['other_elements_disable_css'] : '';
	$bfdesign['radio_button_alignment']     = isset( $bfdesign['radio_button_alignment'] ) ? $bfdesign['radio_button_alignment'] : 'inline';
	$bfdesign['checkbox_alignment']         = isset( $bfdesign['checkbox_alignment'] ) ? $bfdesign['checkbox_alignment'] : 'inline';

	// Text Fields
	$bfdesign['field_padding']                   = isset( $bfdesign['field_padding'] ) ? $bfdesign['field_padding'] : '15';
	$bfdesign['field_background_color']['style'] = isset( $bfdesign['field_background_color']['style'] ) ? $bfdesign['field_background_color']['style'] : 'auto';
	$bfdesign['field_border_color']['style']     = isset( $bfdesign['field_border_color']['style'] ) ? $bfdesign['field_border_color']['style'] : 'auto';
	$bfdesign['field_border_width']              = isset( $bfdesign['field_border_width'] ) ? $bfdesign['field_border_width'] : '';
	$bfdesign['field_border_radius']             = isset( $bfdesign['field_border_radius'] ) ? $bfdesign['field_border_radius'] : '';
	$bfdesign['field_font_size']                 = isset( $bfdesign['field_font_size'] ) ? $bfdesign['field_font_size'] : '15';
	$bfdesign['field_font_color']['style']       = isset( $bfdesign['field_font_color']['style'] ) ? $bfdesign['field_font_color']['style'] : 'auto';

	// Text Fields :Active
	$bfdesign['field_active_background_color']['style'] = isset( $bfdesign['field_active_background_color']['style'] ) ? $bfdesign['field_active_background_color']['style'] : 'auto';
	$bfdesign['field_active_border_color']['style']     = isset( $bfdesign['field_active_border_color']['style'] ) ? $bfdesign['field_active_border_color']['style'] : 'auto';
	$bfdesign['field_active_font_color']['style']       = isset( $bfdesign['field_active_font_color']['style'] ) ? $bfdesign['field_active_font_color']['style'] : 'auto';
	$bfdesign['field_placeholder_font_color']['style']  = isset( $bfdesign['field_placeholder_font_color']['style'] ) ? $bfdesign['field_placeholder_font_color']['style'] : 'auto';

	// Descriptions
	$bfdesign['desc_font_size']           = isset( $bfdesign['desc_font_size'] ) ? $bfdesign['desc_font_size'] : '';
	$bfdesign['desc_font_color']['style'] = isset( $bfdesign['desc_font_color']['style'] ) ? $bfdesign['desc_font_color']['style'] : 'auto';
	$bfdesign['desc_font_style']          = isset( $bfdesign['desc_font_style'] ) ? $bfdesign['desc_font_style'] : 'italic';

	// Submit Button
	$bfdesign['button_width']                     = isset( $bfdesign['button_width'] ) ? $bfdesign['button_width'] : 'blockmobile';
	$bfdesign['button_size']                      = isset( $bfdesign['button_size'] ) ? $bfdesign['button_size'] : 'large';
	$bfdesign['button_background_color']['style'] = isset( $bfdesign['button_background_color']['style'] ) ? $bfdesign['button_background_color']['style'] : 'auto';
	$bfdesign['button_font_color']['style']       = isset( $bfdesign['button_font_color']['style'] ) ? $bfdesign['button_font_color']['style'] : 'auto';
	$bfdesign['button_border_radius']             = isset( $bfdesign['button_border_radius'] ) ? $bfdesign['button_border_radius'] : '';
	$bfdesign['button_border_width']              = isset( $bfdesign['button_border_width'] ) ? $bfdesign['button_border_width'] : '';
	$bfdesign['button_border_color']['style']     = isset( $bfdesign['button_border_color']['style'] ) ? $bfdesign['button_border_color']['style'] : 'auto';
	$bfdesign['button_alignment']                 = isset( $bfdesign['button_alignment'] ) ? $bfdesign['button_alignment'] : 'left';

	// Submit Button :Active
	$bfdesign['button_background_color_hover']['style'] = isset( $bfdesign['button_background_color_hover']['style'] ) ? $bfdesign['button_background_color_hover']['style'] : 'auto';
	$bfdesign['button_border_color_hover']['style']     = isset( $bfdesign['button_border_color_hover']['style'] ) ? $bfdesign['button_border_color_hover']['style'] : 'auto';
	$bfdesign['button_font_color_hover']['style']       = isset( $bfdesign['button_font_color_hover']['style'] ) ? $bfdesign['button_font_color_hover']['style'] : 'auto';

	// Custom CSS
	$bfdesign['custom_css'] = isset( $bfdesign['custom_css'] ) ? $bfdesign['custom_css'] : '';

	// Extras
	$bfdesign['extras_disable_all_css'] = isset( $bfdesign['extras_disable_all_css'] ) ? $bfdesign['extras_disable_all_css'] : '';


	// only output the whole CSS if the option to disable CSS is unchecked
	if ( $bfdesign['extras_disable_all_css'] == '' ) {
		ob_start();
		require( BUDDYFORMS_INCLUDES_PATH . '/resources/pfbc/Style/FormStyle.php' );
		$layout = ob_get_clean();
		if ( ! empty( $layout ) ) {
			$layout    = buddyforms_minify_css( $layout );
			$form_html .= $layout;
		}
	}


	// Create the form object
	$form = new Form( "buddyforms_form_" . $form_slug );

	$buddyforms_frontend_form_template_name = apply_filters( 'buddyforms_frontend_form_template', 'View_Frontend' );

	$form_class = 'standard-form buddyforms-active-form buddyforms-' . $form_slug . ' bf-clearfix ';

	if ( ! isset( $buddyforms[ $form_slug ]['local_storage'] ) ) {
		$form_class .= ' bf-garlic';
	}

	// Set the form attribute
	$form->configure( array(
		"prevent" => array( "bootstrap", "jQuery", "focus" ),
		"action"  => $redirect_to,
		"view"    => new $buddyforms_frontend_form_template_name(),
		'class'   => apply_filters( 'buddyforms_form_class', $form_class ),
		'ajax'    => ! isset( $buddyforms[ $form_slug ]['bf_ajax'] ) ? 'buddyforms_ajax_process_edit_post' : false,
		'method'  => 'post'
	) );

	ob_start();
	do_action( 'template_notices' );
	$template_notices = ob_get_contents();
	$form->addElement( new Element_HTML( $template_notices ) );
	$form->addElement( new Element_HTML( wp_nonce_field( 'buddyforms_form_nonce', '_wpnonce', true, false ) ) );
	//Honey Pot
	$honey_pot = new Element_HTML( '<input type="text" value="" id="bf_hweb" name="bf_hweb" />' );
	$form->addElement( $honey_pot );

	$form->addElement( new Element_Hidden( "redirect_to", $redirect_to ) );
	$form->addElement( new Element_Hidden( "post_id", $post_id ) );
	if ( is_user_logged_in() ) {
		$form->addElement( new Element_Hidden( "post_author", ! empty( $current_user ) ? $current_user->ID : 0 ) );
	}
	$form->addElement( new Element_Hidden( "revision_id", $revision_id ) );
	$form->addElement( new Element_Hidden( "post_parent", $post_parent ) );
	$form->addElement( new Element_Hidden( "form_slug", $form_slug ) );
	$form->addElement( new Element_Hidden( "bf_post_type", $post_type ) );
	$form->addElement( new Element_Hidden( "form_type", isset( $buddyforms[ $form_slug ]['form_type'] ) ? $buddyforms[ $form_slug ]['form_type'] : '' ) );

	if ( isset( $buddyforms[ $form_slug ]['bf_ajax'] ) ) {
		$form->addElement( new Element_Hidden( "ajax", 'off' ) );
	}

	// if the form has custom field to save as post meta data they get displayed here
	buddyforms_form_elements( $form, $args );

	$form->addElement( new Element_Hidden( "bf_submitted", 'true', array( 'value' => 'true', 'id' => "submitted" ) ) );

	$exist_field_status = buddyforms_exist_field_type_in_form( $form_slug, 'status' );
	if ( ! $exist_field_status ) {
		$setup_form_status = ! empty( $buddyforms[ $form_slug ]['status'] ) ? $buddyforms[ $form_slug ]['status'] : 'publish';
		$post_status       = ( ! empty( $post_status ) ) ? $post_status : $setup_form_status;
		$form->addElement( new Element_Hidden( "status", $post_status, array( 'id' => "status" ) ) );
	}

	$exist_field_form_actions = buddyforms_exist_field_type_in_form( $form_slug, 'form_actions' );
	if ( ! $exist_field_form_actions ) {
		$form = buddyforms_form_action_buttons( $form, $form_slug, $post_id, array() );
	}

	$form = apply_filters( 'buddyforms_form_before_render', $form, $args );

	// That's it! render the form!
	$form->render();
	$output = ob_get_clean();
	if ( ! empty( $output ) ) {
		$form_html .= $output;
	}

	$form_html .= '<div class="bf_modal"></div></div>';

	// If Form Revision is enabled Display the revision posts under the form
	if ( isset( $buddyforms[ $form_slug ]['revision'] ) && $post_id != 0 ) {
		ob_start();
		buddyforms_wp_list_post_revisions( $post_id );
		$output = ob_get_clean();
		if ( ! empty( $output ) ) {
			$form_html .= $output;
		}
	}

	// Hook under the form inside the BuddyForms form div
	$form_html = apply_filters( 'buddyforms_form_hero_last', $form_html, $form_slug );
	$form_html .= ! is_user_logged_in() && isset( $buddyforms[ $form_slug ]['public_submit_login'] ) && $buddyforms[ $form_slug ]['public_submit_login'] == 'under' ? buddyforms_get_login_form_template( $form_slug ) : '';

	if ( buddyforms_core_fs()->is_not_paying() && ! buddyforms_core_fs()->is_trial() ) {
		$form_html .= '<div style="text-align: right; opacity: 0.4; font-size: 12px; margin: 30px 0 0;" clss="branding">' . __( 'Proudly brought to you by', 'buddyforms' ) . ' <a href="https://themekraft.com/buddyforms/" target="_blank" rel="nofollow">BuddyForms</a></div>';
	}

	$form_html .= '</div>'; // the_buddyforms_form end

	return $form_html;
}

/**
 * @param string $form_slug
 *
 * @return string
 */
function buddyforms_get_login_form_template( $form_slug = '' ) {

	ob_start();
	buddyforms_locate_template( 'login-form', $form_slug );
	$login_form = ob_get_clean();

	return $login_form;
}

/**
 * @param $css
 *
 * @return mixed|string|string[]|null
 */
function buddyforms_minify_css( $css ) {
	// from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
	// all credits to Christian Schaefer: http://twitter.com/derSchepp
	// remove comments
	$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
	// backup values within single or double quotes
	preg_match_all( '/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER );
	for ( $i = 0; $i < count( $hit[1] ); $i ++ ) {
		$css = str_replace( $hit[1][ $i ], '##########' . $i . '##########', $css );
	}
	// remove traling semicolon of selector's last property
	$css = preg_replace( '/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css );
	// remove any whitespace between semicolon and property-name
	$css = preg_replace( '/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css );
	// remove any whitespace surrounding property-colon
	$css = preg_replace( '/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css );
	// remove any whitespace surrounding selector-comma
	$css = preg_replace( '/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css );
	// remove any whitespace surrounding opening parenthesis
	$css = preg_replace( '/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css );
	// remove any whitespace between numbers and units
	$css = preg_replace( '/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css );
	// shorten zero-values
	$css = preg_replace( '/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css );
	// constrain multiple whitespaces
	$css = preg_replace( '/\p{Zs}+/ims', ' ', $css );
	// remove newlines
	$css = str_replace( array( "\r\n", "\r", "\n" ), '', $css );
	// Restore backupped values within single or double quotes
	for ( $i = 0; $i < count( $hit[1] ); $i ++ ) {
		$css = str_replace( '##########' . $i . '##########', $hit[1][ $i ], $css );
	}

	return $css;
}
