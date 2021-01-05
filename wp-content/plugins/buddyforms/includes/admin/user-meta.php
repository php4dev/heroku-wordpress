<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


// Hooks near the bottom of profile page (if current user)
add_action( 'show_user_profile', 'buddyforms_user_profile_fields' );

// Hooks near the bottom of the profile page (if not current user)
add_action( 'edit_user_profile', 'buddyforms_user_profile_fields' );

// @param WP_User $user
function buddyforms_user_profile_fields( $user ) {

	global $buddyforms;

	if ( ! empty( $buddyforms ) && is_array( $buddyforms ) ) {
		foreach ( $buddyforms as $form_slug => $buddyform ) {
			if ( $buddyform['form_type'] == 'registration' && isset( $buddyform['form_fields'] ) ) {

				$form_setup = array();
				echo '<h2>' . $buddyform['name'] . '</h2>';
				foreach ( $buddyform['form_fields'] as $key => $user_meta ) {

					if ( substr( $user_meta['type'], 0, 5 ) != 'user_' ) {

						$name = $user_meta['name'];
						$slug = $user_meta['slug'];

						$element_attr = array(
							'value' => esc_attr( get_the_author_meta( $user_meta['slug'], $user->ID ) )
						);

						switch ( sanitize_title( $user_meta['type'] ) ) {

							case 'subject':
								$form_setup[] = new Element_Textbox( $name, $slug, $element_attr );
								break;

							case 'message':
								$form_setup[] = new Element_Textarea( $name, $slug, $element_attr );
								break;

							case 'number':
								$form_setup[] = new Element_Number( $name, $slug, $element_attr );
								break;

							case 'html':
								$form_setup[] = new Element_HTML( $user_meta['html'] );
								break;

							case 'date':
								$form_setup[] = new Element_Date( $name, $slug, $element_attr );
								break;

							case 'mail' :
								$form_setup[] = new Element_Email( $name, $slug, $element_attr );
								break;

							case 'radiobutton' :
								if ( isset( $user_meta['options'] ) && is_array( $user_meta['options'] ) ) {

									$options = Array();
									foreach ( $user_meta['options'] as $key => $option ) {
										$options[ $option['value'] ] = $option['label'];
									}
									$element = new Element_Radio( $name, $slug, $options, $element_attr );

									$form_setup[] = $element;

								}
								break;

							case 'checkbox' :

								if ( isset( $user_meta['options'] ) && is_array( $user_meta['options'] ) ) {

									$options = Array();
									foreach ( $user_meta['options'] as $key => $option ) {
										$options[ $option['value'] ] = $option['label'];
									}
									$element = new Element_Checkbox( $name, $slug, $options, $element_attr );

									$form_setup[] = $element;

								}
								break;

							case 'dropdown' :

								if ( isset( $user_meta['options'] ) && is_array( $user_meta['options'] ) ) {

									$options = Array();
									foreach ( $user_meta['options'] as $key => $option ) {
										$options[ $option['value'] ] = $option['label'];
									}

									if ( isset( $element_attr['class'] ) ) {
										$element_attr['class'] = $element_attr['class'] . ' bf-select2';
									} else {
										$element_attr['class'] = ' bf-select2';
									}
									$element = new Element_Select( $name, $slug, $options, $element_attr );

									if ( isset( $user_meta['multiple'] ) && is_array( $user_meta['multiple'] ) ) {
										$element->setAttribute( 'multiple', 'multiple' );
									}

									$form_setup[] = $element;
								}
								break;

							case 'textarea' :
								$form_setup[] = new Element_Textarea( $name, $slug, $element_attr );
								break;

							case 'text' :
								$form_setup[] = new Element_Textbox( $name, $slug, $element_attr );
								break;

							case 'link' :
								$form_setup[] = new Element_Url( $name, $slug, $element_attr );
								break;

						}

					}
				}
				buddyforms_display_field_group_table( $form_setup );
			}
		}
	}

}


// Hook is used to save custom fields that have been added to the WordPress profile page (if current user)
add_action( 'personal_options_update', 'update_extra_profile_fields' );

// Hook is used to save custom fields that have been added to the WordPress profile page (if not current user)
add_action( 'edit_user_profile_update', 'update_extra_profile_fields' );

function update_extra_profile_fields( $user_id ) {
	global $buddyforms;

	if ( current_user_can( 'edit_user', $user_id ) ) {
		if ( isset( $buddyforms ) ) {
			foreach ( $buddyforms as $form_slug => $buddyform ) {
				if ( $buddyform['form_type'] == 'registration' && isset( $buddyform['form_fields'] ) ) {
					foreach ( $buddyform['form_fields'] as $key => $user_meta ) {
						//TODO this need to be improved, because exist the possibility to write
						// the 2 field in different forms just becasue they have the same slug
						buddyforms_update_user_meta( $user_id, $user_meta['type'], $user_meta['slug'] );
					}
				}
			}
		}
	}
}

/**
 * Update user meta, this function not save the wp core user meta related data.
 * The field value is grab from the $_POST base on the field slug
 *
 * @param $user_id
 * @param $field_type
 * @param $field_slug
 * @param string $value
 *
 * @return bool|int
 */
function buddyforms_update_user_meta( $user_id, $field_type, $field_slug ) {
	$slug   = buddyforms_get_mapped_slug_from_user_meta( $field_slug );
	$value  = isset( $_POST[ $field_slug ] ) ? $_POST[ $field_slug ] : '';
	$result = update_user_meta( $user_id, $slug, buddyforms_sanitize( $field_type, $value ) );
	return $result;
}


/**
 * Get the slug to map to the wp core meta user
 *
 * @param string $slug
 *
 * @return string
 */
function buddyforms_get_mapped_slug_from_user_meta( $slug ) {
	switch ( $slug ) {
		case 'user_first':
			$slug = 'first_name';
			break;
		case 'user_last':
			$slug = 'last_name';
			break;
		case 'user_pass':
			$slug = 'user_pass';
			break;
		case 'website':
			$slug = 'user_url';
			break;
		case 'display_name':
			$slug = 'display_name';
			break;
		case 'user_bio':
			$slug = 'description';
			break;
	}

	return $slug;
}

/**
 * Get the value from user meta. This function map the existing user meta form wp core data
 *
 * @param $user_id
 * @param $slug
 *
 * @return string
 */
function buddyforms_get_value_from_user_meta( $user_id, $slug ) {
	if ( ! in_array( $slug, buddyforms_avoid_user_fields_in_forms() ) ) {
		return get_user_meta( $user_id, $slug, true );
	} else {
		$user  = get_userdata( $user_id );
		$slug  = buddyforms_get_mapped_slug_from_user_meta( $slug );
		$value = '';
		if ( isset( $user->$slug ) ) {
			$value = $user->$slug;
		}

		return $value;
	}
}

/**
 * Get the array of avoid fields from the user. This fields are stored in the same wp user meta
 *
 * @return array
 */
function buddyforms_avoid_user_fields_in_forms() {
	return apply_filters( 'buddyforms_avoid_user_fields', array(
		'captcha',
		'display_name',
		'user_login',
		'user_email',
		'user_first',
		'user_last',
		'user_pass',
		'website',
		'user_bio',
	) );
}
