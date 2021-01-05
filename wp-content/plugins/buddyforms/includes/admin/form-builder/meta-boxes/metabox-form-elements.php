<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * @param $post
 * @param bool $buddyform
 */
function buddyforms_metabox_form_elements( $post, $buddyform = false ) {
	global $post, $buddyform;

	if ( $post->post_type != 'buddyforms' ) {
		return;
	}

	if ( ! $buddyform ) {
		$buddyform = get_post_meta( get_the_ID(), '_buddyforms_options', true );
	}

	// Generate the form slug from the post name
	$form_slug = ( isset( $post->post_name ) ) ? $post->post_name : '';

	// Create the form elements array
	$form_setup = array();

	// Start the form builder #buddyforms_forms_builder
	$form_setup[] = new Element_HTML( '<div id="buddyforms_forms_builder" class="buddyforms_forms_builder">' );

	// check if form elements exist for this form
	if ( isset( $buddyform['form_fields'] ) ) {

		// Create the table head to display the form elements
		$form_setup[] = new Element_HTML( '
	        <div class="fields_header">
	            <table class="wp-list-table widefat fixed posts">
	                <thead>
	                    <tr>
	                        <th class="field_order">' . __( 'Order', 'buddyforms' ) . '</th>
	                        <th class="field_label">' . __( 'Label', 'buddyforms' ) . '</th>
	                        <th class="field_name">' . __( 'Slug', 'buddyforms' ) . '</th>
	                        <th class="field_type">' . __( 'Type', 'buddyforms' ) . '</th>
	                        <th class="field_layout">' . __( 'Layout', 'buddyforms' ) . '</th>
	                    </tr>
	                </thead>
	            </table>
	        </div>
	    ' );
	}
	// Start the form element sortable list
	$form_setup[] = new Element_HTML( '<ul id="sortable_buddyforms_elements" class="sortable sortable_' . $form_slug . '">' );

	if ( ! empty( $buddyform['form_fields'] ) && is_array( $buddyform['form_fields'] ) ) {

		// Loop all form elements
		foreach ( $buddyform['form_fields'] as $field_id => $customfield ) {

			// Sanitize the field slug
			if ( isset( $customfield['slug'] ) ) {
				$field_slug = buddyforms_sanitize_slug( $customfield['slug'] );
			}

			// If the field slug is empty generate one from the name
			if ( empty( $field_slug ) ) {
				$field_slug = buddyforms_sanitize_slug( $customfield['name'] );
			}

			// Make sure we have a field slug and name
			if ( $field_slug != '' && isset( $customfield['name'] ) ) {

				// Create the field arguments array
				$args = Array(
					'field_id'   => $field_id,
					'field_type' => sanitize_title( $customfield['type'] ),
					'form_slug'  => $form_slug,
					'post_type'  => $buddyform['post_type'],
				);

				// Get the form element html and add it to the form elements array
				$form_setup[] = new Element_HTML( buddyforms_display_form_element( $args ) );
			}
		}
	} else {
		$form_setup[] = new Element_HTML( buddyforms_form_builder_templates() );
	}

	// End the sortable form elements list
	$form_setup[] = new Element_HTML( '</ul>' );

	$select_a_template_button = '<input type="button" name="formbuilder-show-templates" id="formbuilder-show-templates" class="button button-primary button-large" value="' . __( 'Select a Template', 'buddyforms' ) . '">';
	// Metabox footer for the form elements select
	$form_setup[] = new Element_HTML( '
		<div id="formbuilder-actions-wrap">
			<div class="formbuilder-actions-select-wrap">
				<div id="formbuilder-action-templates">
					' . $select_a_template_button . '
				</div>
				<div id="formbuilder-action-add">
					<span class="formbuilder-spinner spinner"></span>
					<input type="button" name="formbuilder-add-element" id="formbuilder-add-element" class="button button-primary button-large" value="' . __( '+ Add Field', 'buddyforms' ) . '">
				</div>
				<div id="formbuilder-action-select">
					<select id="bf_add_new_form_element">' . buddyforms_form_builder_form_elements_select() . '</select>
				</div>
			</div>
		</div>
		<div id="formbuilder-action-select-modal" class="hidden">
				<select id="bf_add_new_form_element_modal">' . buddyforms_form_builder_form_elements_select() . '</select>
		</div>
	' );

	// End #buddyforms_forms_builder wrapper
	$form_setup[] = new Element_HTML( '</div>' );

	foreach ( $form_setup as $key => $field ) {
		echo $field->getLabel();
		echo $field->getShortDesc();
		echo $field->render();
	}
}

//
// generate the form builder form elements select options
//
/**
 * @return string
 */
function buddyforms_form_builder_form_elements_select() {
	$elements_select_options = buddyforms_form_elements_select_options();

	// Add a default value
	$el_sel_options = '<option value="none">' . __( 'Select Field Type', 'buddyforms' ) . '</option>';

	// Loop The form elements array and add the options to the select box
	if ( is_array( $elements_select_options ) ) {
		foreach ( $elements_select_options as $optgroup_label => $optgroup ) {
			$class          = isset( $optgroup['class'] ) ? $optgroup['class'] : '';
			$el_sel_options .= '<optgroup style="display:none;" class="' . $class . '" label="' . $optgroup['label'] . '">';
			foreach ( $optgroup['fields'] as $es_val => $es_label ) {
				if ( is_array( $es_label ) ) {
					$pro_text       = ( ! empty( $es_label['is_pro'] ) && buddyforms_core_fs()->is_free_plan() ) ? ' - PRO' : '';
					$pro_disabled   = ( ! empty( $es_label['is_pro'] ) && buddyforms_core_fs()->is_free_plan() ) ? 'disabled' : '';
					$el_sel_options .= sprintf( "<option %s data-unique=\"%s\" value=\"%s\">%s %s</option>", $pro_disabled, isset( $es_label['unique'] ) ? $es_label['unique'] : '', $es_val, $es_label['label'], $pro_text );
				} else {
					$el_sel_options .= '<option value="' . $es_val . '">' . $es_label . '</option>';
				}
			}
			$el_sel_options .= '</optgroup>';
		}
	}

	// Return the options
	return $el_sel_options;
}

/**
 * @return array
 */
function buddyforms_form_elements_select_options() {
	global $elements_select_options;
	// Create the form elements array
	$elements_select_options = array(
		'contact' => array(
			'label'  => __( 'Contact Fields', 'buddyforms' ),
			'class'  => 'bf_show_if_f_type_all',
			'fields' => array(
				'subject' => array(
					'label'  => __( 'Subject', 'buddyforms' ),
					'unique' => 'unique'
				),
				'message' => array(
					'label'  => __( 'Message', 'buddyforms' ),
					'unique' => 'unique'
				),
			),
		),
		'user'    => array(
			'label'  => __( 'User Fields', 'buddyforms' ),
			'class'  => 'bf_show_if_f_type_all',
			'fields' => array(
				'user_login'   => array(
					'label'  => __( 'Username', 'buddyforms' ),
					'unique' => 'unique'
				),
				'user_email'   => array(
					'label'  => __( 'User eEmail', 'buddyforms' ),
					'unique' => 'unique'
				),
				'user_first'   => array(
					'label'  => __( 'User First Name', 'buddyforms' ),
					'unique' => 'unique'
				),
				'user_last'    => array(
					'label'  => __( 'User Last Name', 'buddyforms' ),
					'unique' => 'unique'
				),
				'user_pass'    => array(
					'label'  => __( 'Password', 'buddyforms' ),
					'unique' => 'unique'
				),
				'user_website' => array(
					'label'  => __( 'Website', 'buddyforms' ),
					'unique' => 'unique'
				),
				'display_name' => array(
					'label'  => __( 'Display Name', 'buddyforms' ),
					'unique' => 'unique'
				),
				'user_bio'     => array(
					'label'  => __( 'About / Bio', 'buddyforms' ),
					'unique' => 'unique'
				),
			),
		),
		'post'    => array(
			'label'  => __( 'Post Fields', 'buddyforms' ),
			'class'  => 'bf_show_if_f_type_post',
			'fields' => array(
				'title'        => array(
					'label'  => __( 'Title', 'buddyforms' ),
					'unique' => 'unique'
				),
				'content'      => array(
					'label'  => __( 'Content', 'buddyforms' ),
					'unique' => 'unique'
				),
				'post_excerpt' => array(
					'label'  => __( 'Excerpt', 'buddyforms' ),
					'unique' => 'unique'
				),
			),
		),
		'basic'   => array(
			'label'      => __( 'Basic Fields', 'buddyforms' ),
			'class'      => 'bf_show_if_f_type_all',
			'post_type ' => 'all',
			'fields'     => array(
				'text'        => array(
					'label' => __( 'Text', 'buddyforms' ),
				),
				'email'       => array(
					'label' => __( 'eMail', 'buddyforms' ),
				),
				'textarea'    => array(
					'label' => __( 'Textarea', 'buddyforms' ),
				),
				'phone'       => array(
					'label' => __( 'Phone', 'buddyforms' ),
				),
				'number'      => array(
					'label' => __( 'Number', 'buddyforms' ),
				),
				'dropdown'    => array(
					'label' => __( 'Dropdown', 'buddyforms' ),
				),
				'radiobutton' => array(
					'label' => __( 'Radiobutton', 'buddyforms' ),
				),
				'checkbox'    => array(
					'label' => __( 'Checkbox', 'buddyforms' ),
				),
				'link'        => array(
					'label' => __( 'Url', 'buddyforms' ),
				),
				'gdpr'        => array(
					'label'  => __( 'GDPR Agreement', 'buddyforms' ),
					'unique' => 'unique'
				),
				'captcha'     => array(
					'label'  => __( 'Captcha', 'buddyforms' ),
					'unique' => 'unique'
				),
				'date'        => array(
					'label' => __( 'Date', 'buddyforms' ),
				),
				'time'        => array(
					'label' => __( 'Time', 'buddyforms' ),
				),
			),
		),
	);

	// Post Fields
	$elements_select_options['post']['fields']['category']       = array(
		'label'  => __( 'Category', 'buddyforms' ),
		'unique' => 'unique'
	);
	$elements_select_options['post']['fields']['tags']           = array(
		'label'  => __( 'Tags', 'buddyforms' ),
		'unique' => 'unique'
	);
	$elements_select_options['post']['fields']['post_formats']   = array(
		'label'  => __( 'Post Formats', 'buddyforms' ),
		'unique' => 'unique'
	);
	$elements_select_options['post']['fields']['comments']       = array(
		'label'  => __( 'Comments', 'buddyforms' ),
		'unique' => 'unique'
	);
	$elements_select_options['post']['fields']['status']         = array(
		'label'  => __( 'Post Status', 'buddyforms' ),
		'unique' => 'unique'
	);
	$elements_select_options['post']['fields']['featured_image'] = array(
		'label'  => __( 'Featured Image', 'buddyforms' ),
		'unique' => 'unique'
	);


	$elements_select_options['post']['fields']['taxonomy']      = array(
		'label'  => __( 'Taxonomy', 'buddyforms' ),
		'is_pro' => true,
	);
	$elements_select_options['basic']['fields']['form_actions'] = array(
		'label'  => __( 'Form Actions', 'buddyforms' ),
		'is_pro' => true,
	);

	$elements_select_options['extra']['label']             = __( 'Extra Fields', 'buddyforms' );
	$elements_select_options['extra']['class']             = 'bf_show_if_f_type_post bf_show_if_f_type_contact';
	$elements_select_options['extra']['fields']['file']    = array(
		'label'  => __( 'File', 'buddyforms' ),
		'is_pro' => true,
	);
	$elements_select_options['extra']['fields']['upload']  = array(
		'label'  => __( 'Upload', 'buddyforms' ),
		'is_pro' => true,
	);
	$elements_select_options['extra']['fields']['country'] = array(
		'label' => __( 'Country', 'buddyforms' ),
	);
	$elements_select_options['extra']['fields']['state']   = array(
		'label'  => __( 'State', 'buddyforms' ),
		'is_pro' => true,
	);
	$elements_select_options['basic']['fields']['hidden']  = array(
		'label'  => __( 'Hidden', 'buddyforms' ),
		'is_pro' => true,
	);
	$elements_select_options['basic']['fields']['html']    = array(
		'label'  => __( 'HTML', 'buddyforms' ),
		'is_pro' => true,
	);
	$elements_select_options['extra']['fields']['range']   = array(
		'label'  => __( 'Range', 'buddyforms' ),
		'is_pro' => true,
	);
	$elements_select_options['extra']['fields']['price']   = array(
		'label'  => __( 'Price', 'buddyforms' ),
		'is_pro' => true,
	);


	// Allow others to filter the array
	$elements_select_options = apply_filters( 'buddyforms_add_form_element_select_option', $elements_select_options );

	return $elements_select_options;
}
