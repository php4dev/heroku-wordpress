<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * @param Form $form
 * @param $args
 * @param bool $recovering
 */
function buddyforms_form_elements( &$form, $args, $recovering = false ) {
	global $buddyforms, $field_id;

	$post_id      = 0;
	$form_slug    = '';
	$action       = 'new';
	$customfields = array();
	$post         = false;

	if ( empty( $args ) ) {
		return;
	}

	$global_error = ErrorHandler::get_instance();

	extract( $args );

	if ( empty( $form_slug ) ) {
		return;
	}

	$form_type = $buddyforms[ $form_slug ]['form_type'];

	if ( empty( $form_type ) ) {
		return;
	}

	if ( empty( $customfields ) ) {
		return;
	}

	if ( ! empty( $post_id ) ) {
		$post   = get_post( $post_id );
		$action = ! empty( $post ) && $post->post_status !== 'auto-draft' ? 'edit' : 'new';
	}

	$current_user    = false;
	$current_user_id = get_current_user_id();
	if ( $form_type === 'registration' && ! empty( $post_id ) ) {
		$bf_registration_user_id = get_post_meta( $post_id, '_bf_registration_user_id', true );
		$current_user            = get_userdata( $bf_registration_user_id );
		if ( ! empty( $current_user ) && ! is_wp_error( $current_user ) ) {
			$current_user_id = $current_user->ID;
		}
	}

	$all_errors      = array();
	$global_bf_error = $global_error->get_global_error();
	if ( ! empty( $global_bf_error ) ) {
		if ( $global_bf_error->has_errors() ) {
			$all_errors_groups = $global_error->get_global_error()->errors;
			$target_form_slug  = 'buddyforms_form_' . $form_slug;
			foreach ( $all_errors_groups as $error_form_slug => $errors ) {
				if ( $target_form_slug === $error_form_slug ) {
					if ( is_array( $errors ) ) {
						foreach ( $errors as $target_field_slug => $error_message ) {
							if ( $target_field_slug === 'buddyforms_user_pass' ) {
								$target_field_slug = 'user_pass';
							}
							$all_errors[ $target_field_slug ] = $error_message[0];
						}
					}
				}
			}
		}
	}

	$current_user_id = apply_filters( 'buddyforms_current_user_id', $current_user_id, $form_type, $form_slug, $post_id );

	foreach ( $customfields as $field_id => $customfield ) {

		if ( isset( $customfield['slug'] ) ) {
			$slug = buddyforms_sanitize_slug( $customfield['slug'] );
		}

		if ( empty( $slug ) ) {
			$slug = buddyforms_sanitize_slug( $customfield['name'] );
		}

		if ( $slug != '' ) {

			$customfield_val = '';
			//Get form field value when the form is editing
			if ( $action === 'edit' ) {
				$customfield_val = get_post_meta( $post_id, $slug, true );
			}
			if ( in_array( $slug, buddyforms_avoid_user_fields_in_forms() ) && is_user_logged_in() ) {
				$customfield_val = buddyforms_get_value_from_user_meta( $current_user_id, $slug );
			}

			if ( isset( $_POST[ $slug ] ) && empty( $customfield_val ) ) {
				$customfield_val = $_POST[ $slug ];
			}

			if ( isset( $customfield['type'] ) ) {
				$field_type = sanitize_title( $customfield['type'] );
				if ( empty( $customfield_val ) ) {
					$default_value = isset( $customfield['default'] ) ? $customfield['default'] : '';
					if ( ! empty( $_GET[ $slug ] ) && ! in_array( $field_type, array( 'user_login', 'user_pass' ) ) ) {
						$default_value = sanitize_text_field( $_GET[ $slug ] );
					}
					$customfield_val = $default_value;
				}

				$name = '';
				if ( isset( $customfield['name'] ) ) {
					$name = stripcslashes( $customfield['name'] );
				}

				//Fix to avoid element with no name, because they submit will not include it
				if ( empty( $name ) && ! empty( $slug ) ) {
					$name = $slug;
				}

				$name = apply_filters( 'buddyforms_form_field_name', $name, $post_id );

				$description = '';
				if ( isset( $customfield['description'] ) ) {
					$description = stripcslashes( $customfield['description'] );
				}

				$description = apply_filters( 'buddyforms_form_field_description', $description, $post_id );

				$element_attr = array(
					'id'        => str_replace( "-", "", $slug ),
					'value'     => $customfield_val,
					'class'     => 'settings-input form-control',
					'shortDesc' => $description,
					'field_id'  => $field_id,
					'data-form' => $form_slug
				);

				if ( ! empty( $all_errors ) && isset( $all_errors[ $customfield['name'] ] ) ) {
					$customfield['error']  = $all_errors[ $customfield['name'] ];
					$element_attr['error'] = $all_errors[ $customfield['name'] ];
				}

				$has_error = ( ! empty( $element_attr['error'] ) || ! empty( $customfield['error'] ) );

				$customfield['field_id'] = $field_id;

				if ( isset( $customfield['required'] ) ) {
					$element_attr = array_merge( $element_attr, array( 'required' => true ) );
				}

				if ( isset( $customfield['custom_class'] ) ) {
					$element_attr['class'] = $element_attr['class'] . ' ' . $customfield['custom_class'];
				}


				switch ( $field_type ) {

					case 'subject':

						$subject_minlength = isset( $customfield['validation_minlength'] ) ? $customfield['validation_minlength'] : 0;
						$subject_maxlength = isset( $customfield['validation_maxlength'] ) ? $customfield['validation_maxlength'] : 0;


						$element_attr['data-rule-minlength'] = '[' . $subject_minlength . ']';
						$element_attr['data-rule-maxlength'] = '[' . $subject_maxlength . ']';
						$form->addElement( new Element_Textbox( $name, $slug, $element_attr, $customfield ) );
						break;

					case 'country':
						$form->addElement( new Element_Country( $name, $slug, $element_attr, $customfield ) );
						break;

					case 'state':
						$form->addElement( new Element_State( $name, $slug, $element_attr, $customfield ) );
						break;

					case 'message':

						$message_minlength = isset( $customfield['validation_minlength'] ) ? $customfield['validation_minlength'] : 0;
						$message_maxlength = isset( $customfield['validation_maxlength'] ) ? $customfield['validation_maxlength'] : 0;


						$element_attr['data-rule-minlength'] = '[' . $message_minlength . ']';
						$element_attr['data-rule-maxlength'] = '[' . $message_maxlength . ']';
						$form->addElement( new Element_Textarea( $name, $slug, $element_attr, $customfield ) );
						break;

					case 'user_login':
						if ( ! is_admin() || $recovering ) {
							if ( is_user_logged_in() ) {
								$element_attr = array_merge( $element_attr, array( 'disabled' => 'disabled' ) );
								if ( ! isset( $customfield['hide_if_logged_in'] ) ) {
									if ( isset( $customfield['required'] ) ) {
										unset( $customfield['required'] );
									}
									if ( isset( $element_attr['required'] ) ) {
										unset( $element_attr['required'] );
									}
									$form->addElement( new Element_Textbox( $name, $slug, $element_attr, $customfield ) );
								}
							} else {
								$form->addElement( new Element_Textbox( $name, $slug, $element_attr, $customfield ) );
							}
						} else {
							$form->addElement( new Element_Hidden( $slug, $customfield_val, array() ) );
						}
						break;

					case 'user_email':
						if ( ! ( is_user_logged_in() && isset( $customfield['hide_if_logged_in'] ) ) && ( $action === 'new' || $action === 'edit' ) ) {
							$form->addElement( new Element_Email( $name, $slug, $element_attr, $customfield ) );
						} else {
							$form->addElement( new Element_Hidden( $slug, $customfield_val, array() ) );
						}
						break;

					case 'user_first':
						if ( ! ( is_user_logged_in() && isset( $customfield['hide_if_logged_in'] ) ) && ( $action === 'new' || $action === 'edit' ) ) {
							$form->addElement( new Element_Textbox( $name, $slug, $element_attr, $customfield ) );
						} else {
							$form->addElement( new Element_Hidden( $slug, $customfield_val, array() ) );
						}
						break;

					case 'user_last':
						if ( ! ( is_user_logged_in() && isset( $customfield['hide_if_logged_in'] ) ) && ( $action === 'new' || $action === 'edit' ) ) {
							$form->addElement( new Element_Textbox( $name, $slug, $element_attr, $customfield ) );
						} else {
							$form->addElement( new Element_Hidden( $slug, $customfield_val, array() ) );
						}
						break;

					case 'display_name':
						if ( ! ( is_user_logged_in() && isset( $customfield['hide_if_logged_in'] ) ) && ! is_admin() && ( $action === 'new' || $action === 'edit' ) ) {
							$form->addElement( new Element_Textbox( $name, $slug, $element_attr, $customfield ) );
						}
						break;

					case 'user_pass':
						if ( ! ( is_user_logged_in() && isset( $customfield['hide_if_logged_in'] ) ) && ( $action === 'new' || $action === 'edit' ) ) {
							$form->addElement( new Element_Password( $name, 'buddyforms_user_pass', $element_attr, $customfield ) );
						}
						break;

					case 'user_website':
						if ( ! ( is_user_logged_in() && isset( $customfield['hide_if_logged_in'] ) ) && ( $action === 'new' || $action === 'edit' ) ) {
							$form->addElement( new Element_Url( $name, $slug, $element_attr, $customfield ) );
						} else {
							$form->addElement( new Element_Hidden( $slug, $customfield_val, array() ) );
						}
						break;

					case 'user_bio':
						if ( ! ( is_user_logged_in() && isset( $customfield['hide_if_logged_in'] ) ) && ( $action === 'new' || $action === 'edit' ) ) {
							$form->addElement( new Element_Textarea( $name, $slug, $element_attr, $customfield ) );
						} else {
							$form->addElement( new Element_Hidden( $slug, $customfield_val, array() ) );
						}
						break;

					case 'number':
						$number_min_value                    = isset( $customfield['validation_min'] ) ? $customfield['validation_min'] : 0;
						$number_max_value                    = isset( $customfield['validation_max'] ) ? $customfield['validation_max'] : 0;
						$element_attr['data-rule-min-value'] = '[' . $number_min_value . ']';
						$element_attr['data-rule-max-value'] = '[' . $number_max_value . ']';
						$form->addElement( new Element_Number( $name, $slug, $element_attr, $customfield ) );
						break;

					case 'html':
						$form->addElement( new Element_HTML( $customfield['html'] ) );
						break;

					case 'date':
						$form->addElement( new Element_Date( $name, $slug, $customfield, $element_attr ) );
						break;
					case 'time':
						$form->addElement( new Element_Time( $name, $slug, $customfield, $element_attr ) );
						break;
					case 'title':
						$post_title = '';
						if ( isset( $_POST['buddyforms_form_title'] ) ) {
							$post_title = stripslashes( $_POST['buddyforms_form_title'] );
						} elseif ( isset( $the_post->post_title ) && $action !== 'new' ) {
							$post_title = $the_post->post_title;
						}
						if ( isset( $customfield['hidden_field'] ) ) {
							$form->addElement( new Element_Hidden( 'buddyforms_form_title', $post_title, array() ) );
						} else {

							$element_attr['id'] = 'buddyforms_form_title';
							if ( ! empty( $post_title ) ) {
								$element_attr['value'] = $post_title;
							}
							$element_attr['shortDesc'] = $description;
							$title_minlength           = isset( $customfield['validation_minlength'] ) ? $customfield['validation_minlength'] : 0;
							$title_maxlength           = isset( $customfield['validation_maxlength'] ) ? $customfield['validation_maxlength'] : 0;

							$element_attr['data-rule-minlength'] = '[' . $title_minlength . ']';
							$element_attr['data-rule-maxlength'] = '[' . $title_maxlength . ']';


							if ( isset( $customfield['required'] ) ) {
								$element_attr = array_merge( $element_attr, array( 'required' => true ) );
							}

							$form->addElement( new Element_Textbox( $name, "buddyforms_form_title", $element_attr, $customfield ) );
						}
						break;

					case 'content':
						$buddyforms_form_content_val = '';
						remove_filter( 'the_content', 'do_shortcode', 11 );
						add_filter( 'tiny_mce_before_init', 'buddyforms_tinymce_setup_function' );
						if ( isset( $_POST['buddyforms_form_content'] ) ) {
							$buddyforms_form_content_val = stripslashes( $_POST['buddyforms_form_content'] );
						} else {
							if ( ! empty( $the_post->post_content ) && ( $action !== 'new' ) ) {
								$buddyforms_form_content_val = $the_post->post_content;
							} elseif ( empty( $buddyforms_form_content_val ) && ! empty( $element_attr['value'] ) ) {
								$buddyforms_form_content_val = $element_attr['value'];
							}
						}

						if ( isset( $customfield['hidden_field'] ) ) {
							$form->addElement( new Element_Hidden( 'buddyforms_form_content', $buddyforms_form_content_val, array() ) );
						} else {
							$textarea_rows = isset( $customfield['textarea_rows'] ) ? $customfield['textarea_rows'] : apply_filters( 'buddyforms_post_content_default_rows', 18 );
							ob_start();
							$classes = 'textInMce form-control';
							if ( $has_error ) {
								$classes .= ' error';
							}
							$settings = array(
								'wpautop'       => true,
								'media_buttons' => isset( $customfield['post_content_options'] ) && in_array( 'media_buttons', $customfield['post_content_options'] ) ? false : true,
								'tinymce'       => isset( $customfield['post_content_options'] ) && in_array( 'tinymce', $customfield['post_content_options'] ) ? false : true,
								'quicktags'     => isset( $customfield['post_content_options'] ) && in_array( 'quicktags', $customfield['post_content_options'] ) ? false : true,
								'textarea_rows' => $textarea_rows,
								'textarea_name' => 'buddyforms_form_content',
								'editor_class'  => $classes,
							);

							if ( isset( $post_id ) ) {
								wp_editor( $buddyforms_form_content_val, 'buddyforms_form_content', $settings );
							} else {
								$content = false;
								$post    = 0; // todo: Not sure $post = 0 is needed.
								wp_editor( $content, 'buddyforms_form_content', $settings );
							}
							$wp_editor = ob_get_clean();

							$required = '';
							if ( isset( $customfield['required'] ) ) {
								$wp_editor = str_replace( '<textarea', '<textarea required="required"', $wp_editor );
								$required  = $form->renderRequired();
							}

							if ( $textarea_rows ) {
								$wp_editor = preg_replace( '/<textarea/', "<textarea rows=\"" . $textarea_rows . "\"", $wp_editor );
							}

							$content_minlength = isset( $customfield['validation_minlength'] ) ? $customfield['validation_minlength'] : 0;
							$content_maxlength = isset( $customfield['validation_maxlength'] ) ? $customfield['validation_maxlength'] : 0;
							$wp_editor         = preg_replace( '/<textarea/', sprintf( "<textarea data-rule-minlength=\"[%d]\"", $content_minlength ), $wp_editor );
							$wp_editor         = preg_replace( '/<textarea/', sprintf( "<textarea data-rule-maxlength=\"[%d]\"", $content_maxlength ), $wp_editor );
							$wp_editor         = preg_replace( '/<textarea/', sprintf( "<textarea data-form='%s'", $form_slug ), $wp_editor );


							$labels_layout = isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) ? $buddyforms[ $form_slug ]['layout']['labels_layout'] : 'inline';

							$wp_editor_label = '';
							if ( $labels_layout == 'inline' ) {
								if ( isset( $customfield['required'] ) ) {
									$required = $form->getRequiredSignal();
								}
								$wp_editor = preg_replace( '/<textarea/', "<textarea placeholder=\"" . $name . $required . "\"", $wp_editor );
							} else {
								$wp_editor_label = '<label for="buddyforms_form_content">' . $name . $required . '</label>';
							}

							//						echo '<div id="buddyforms_form_content_val" style="display: none">' . $buddyforms_form_content_val . '</div>';


							if ( isset( $buddyforms[ $form_slug ]['layout']['desc_position'] ) && $buddyforms[ $form_slug ]['layout']['desc_position'] == 'above_field' ) {
								$wp_editor = '<div class="bf_field_group bf_form_content">' . $wp_editor_label . '<span class="help-inline">' . $description . '</span><div class="bf_inputs bf-input">' . $wp_editor . '</div></div>';
							} else {
								$wp_editor = '<div class="bf_field_group bf_form_content">' . $wp_editor_label . '<div class="bf_inputs bf-input">' . $wp_editor . '</div><span class="help-inline">' . $description . '</span></div>';
							}

							$wp_editor = apply_filters( 'buddyforms_wp_editor', $wp_editor, $post_id );

							add_filter( 'the_content', 'do_shortcode', 11 );
							$form->addElement( new Element_Content( $name, $slug, $wp_editor, $customfield ) );
						}
						break;

					case 'email' :
						$form->addElement( new Element_Email( $name, $slug, $element_attr, $customfield ) );
						break;

					case 'phone' :
						$form->addElement( new Element_Phone( $name, $slug, $element_attr, $customfield ) );
						break;

					case 'radiobutton' :
						if ( isset( $customfield['options'] ) && is_array( $customfield['options'] ) ) {

							$options = Array();
							foreach ( $customfield['options'] as $key => $option ) {
								$options[ $option['value'] ] = $option['label'];
							}
							$element = new Element_Radio( $name, $slug, $options, $element_attr, $customfield );
							$element->setAttribute( 'frontend_reset', ! empty( $customfield['frontend_reset'][0] ) );
							$form->addElement( $element );

						}
						break;

					case 'checkbox' :

						if ( isset( $customfield['options'] ) && is_array( $customfield['options'] ) ) {

							$options = Array();
							foreach ( $customfield['options'] as $key => $option ) {
								$options[ $option['value'] ] = $option['label'];
							}
							$element = new Element_Checkbox( $name, $slug, $options, $element_attr, $customfield );
							$element->setAttribute( 'frontend_reset', ! empty( $customfield['frontend_reset'][0] ) );
							$form->addElement( $element );

						}
						break;

					case 'dropdown' :

						if ( isset( $customfield['options'] ) && is_array( $customfield['options'] ) ) {

							$options = Array();
							foreach ( $customfield['options'] as $key => $option ) {
								$options[ $option['value'] ] = $option['label'];
							}

							if ( ! empty( $customfield['frontend_reset'][0] ) ) {
								$element_attr['data-reset'] = 'true';
							}
                            $select2_class = ' bf-select2';
                            if ( ! empty( $customfield['disable_select2'][0] ) ) {
                                $select2_class = ' ';
                            }



							$element_attr['class'] = $element_attr['class'] . ' '.$select2_class;

							$element = new Element_Select( $name, $slug, $options, $element_attr, $customfield );

							if ( isset( $customfield['multiple'] ) && is_array( $customfield['multiple'] ) ) {
								$element->setAttribute( 'multiple', 'multiple' );
							}

							$element->unsetAttribute( 'data-tags' );

							BuddyFormsAssets::load_select2_assets();

							$form->addElement( $element );
						}
						break;

					case 'comments' :
						if ( ! empty( $the_post ) && ! empty( $the_post->comment_status ) ) {
							$element_attr['value'] = $the_post->comment_status;
						}

						$form->addElement( new Element_Select( $name, 'comment_status', array(
							'open',
							'closed'
						), $element_attr, $customfield ) );
						break;

					case 'status' :

						if ( isset( $customfield['post_status'] ) && is_array( $customfield['post_status'] ) && count( $customfield['post_status'] ) > 0 ) {
							$post_status = array();
							if ( in_array( 'pending', $customfield['post_status'] ) ) {
								$post_status['pending'] = __( 'Pending Review', 'buddyforms' );
							}

							if ( in_array( 'publish', $customfield['post_status'] ) ) {
								$post_status['publish'] = __( 'Published', 'buddyforms' );
							}

							if ( in_array( 'draft', $customfield['post_status'] ) ) {
								$post_status['draft'] = __( 'Draft', 'buddyforms' );
							}

							if ( in_array( 'future', $customfield['post_status'] ) && empty( $customfield_val ) || in_array( 'future', $customfield['post_status'] ) && get_post_status( $post_id ) == 'future' ) {
								$post_status['future'] = __( 'Scheduled', 'buddyforms' );
							}

							if ( in_array( 'private', $customfield['post_status'] ) ) {
								$post_status['private'] = __( 'Privately Published', 'buddyforms' );
							}

							if ( in_array( 'trash', $customfield['post_status'] ) ) {
								$post_status['trash'] = __( 'Trash', 'buddyforms' );
							}

							$customfield_val = isset( $the_post ) && isset( $the_post->post_status ) ? $the_post->post_status : '';

							if ( ! empty( $customfield_val ) && $customfield_val === 'auto-draft' ) {
								$customfield_val = 'draft';
							}

							if ( isset( $_POST['status'] ) ) {
								$customfield_val = $_POST['status'];
							}

							$form->addElement( new Element_Select( $name, 'status', $post_status, $element_attr, $customfield ) );

							Element_Date::include_assets();
							$element_attr['class']       = $element_attr['class'] . ' bf_datetime bf_datetime_wrap bf_datetimepicker';
							$element_attr['id']          = $element_attr['id'] . '_bf_datetime';
							$element_attr['placeholder'] = __( 'Schedule Time', 'buddyforms' );
							$form->addElement( new Element_Textbox( '', 'schedule', $element_attr, $customfield ) );

						}
						break;
					case 'textarea' :
						add_filter( 'tiny_mce_before_init', 'buddyforms_tinymce_setup_function' );
						$textarea_rows = isset( $customfield['textarea_rows'] ) ? $customfield['textarea_rows'] : apply_filters( 'buddyforms_textarea_default_rows', 3 );
						ob_start();
						$classes = 'textInMce form-control';
						if ( $has_error ) {
							$classes .= ' error';
						}
						$settings = array(
							'wpautop'       => false,
							'media_buttons' => isset( $customfield['post_textarea_options'] ) && in_array( 'media_buttons', $customfield['post_textarea_options'] ) ? true : false,
							'tinymce'       => isset( $customfield['post_textarea_options'] ) && in_array( 'tinymce', $customfield['post_textarea_options'] ) ? true : false,
							'quicktags'     => isset( $customfield['post_textarea_options'] ) && in_array( 'quicktags', $customfield['post_textarea_options'] ) ? true : false,
							'textarea_rows' => $textarea_rows,
							'textarea_name' => $slug,
							'editor_class'  => $classes,
						);

						wp_editor( stripslashes( $customfield_val ), $slug, $settings );
						$wp_editor = ob_get_clean();

						$wp_editor = str_replace( '<textarea', '<textarea name="' . $slug . '"', $wp_editor );

						$required = '';
						if ( isset( $customfield['required'] ) ) {
							$wp_editor = str_replace( '<textarea', '<textarea required="required"', $wp_editor );
							$required  = $form->renderRequired();
						}

						$labels_layout = isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) ? $buddyforms[ $form_slug ]['layout']['labels_layout'] : 'inline';

						$wp_editor_label = '';
						if ( $labels_layout == 'inline' ) {
							if ( isset( $customfield['required'] ) ) {
								$required = $form->getRequiredSignal();
							}
							$wp_editor = preg_replace( '/<textarea/', "<textarea placeholder=\"" . $name . $required . "\"", $wp_editor );
						} else {
							$wp_editor_label = '<label aa for="' . $slug . '">' . $name . $required . '</label>';
						}

						if ( $textarea_rows ) {
							$wp_editor = preg_replace( '/<textarea/', "<textarea rows=\"" . $textarea_rows . "\"", $wp_editor );
						}

						$minlength = isset( $customfield['validation_minlength'] ) ? $customfield['validation_minlength'] : 0;
						$maxlength = isset( $customfield['validation_maxlength'] ) ? $customfield['validation_maxlength'] : 100;
						$wp_editor = preg_replace( '/<textarea/', sprintf( "<textarea data-rule-minlength=\"[%d]\"", $minlength ), $wp_editor );
						$wp_editor = preg_replace( '/<textarea/', sprintf( "<textarea data-rule-maxlength=\"[%d]\"", $maxlength ), $wp_editor );
						$wp_editor = preg_replace( '/<textarea/', sprintf( "<textarea data-form='%s'", $form_slug ), $wp_editor );

						if ( isset( $customfield['hidden_field'] ) ) {
							$form->addElement( new Element_Hidden( $name, $customfield_val, array() ) );
						} else {
							if ( isset( $buddyforms[ $form_slug ]['layout']['desc_position'] ) && $buddyforms[ $form_slug ]['layout']['desc_position'] == 'above_field' ) {
								$wp_editor = '<div class="bf_field_group ' . $slug . '">' . $wp_editor_label . '<span class="help-inline">' . $description . '</span><div class="bf_inputs bf-input">' . $wp_editor . '</div></div>';
							} else {
								$wp_editor = '<div class="bf_field_group ' . $slug . '">' . $wp_editor_label . '<div class="bf_inputs bf-input">' . $wp_editor . '</div><span class="help-inline">' . $description . '</span></div>';
							}

							$element = new Element_HTML( $wp_editor, $name, $name, $customfield );
							if ( ! empty( $customfield['required'] ) && $customfield['required'][0] === 'required' ) {
								$element->setValidation( new Validation_Required( $customfield['validation_error_message'], $customfield ) );
							}

							$form->addElement( new Element_Textarea( $name, $slug, $wp_editor, $customfield ) );
						}
						break;
					case 'post_excerpt':
						add_filter( 'tiny_mce_before_init', 'buddyforms_tinymce_setup_function' );
						$textarea_rows = isset( $customfield['textarea_rows'] ) ? $customfield['textarea_rows'] : apply_filters( 'buddyforms_post_excerpt_default_rows', 3 );

						ob_start();
						$classes = 'textInMce form-control';
						if ( $has_error ) {
							$classes .= ' error';
						}
						$settings = array(
							'wpautop'       => false,
							'media_buttons' => isset( $customfield['post_excerpt_options'] ) && in_array( 'media_buttons', $customfield['post_excerpt_options'] ) ? true : false,
							'tinymce'       => isset( $customfield['post_excerpt_options'] ) && in_array( 'tinymce', $customfield['post_excerpt_options'] ) ? true : false,
							'quicktags'     => isset( $customfield['post_excerpt_options'] ) && in_array( 'quicktags', $customfield['post_excerpt_options'] ) ? true : false,
							'textarea_rows' => $textarea_rows,
							'textarea_name' => $slug,
							'editor_class'  => $classes,
						);

						//check if post has manual excerpt
						if ( has_excerpt( $post_id ) ) {
							$customfield_val = buddyforms_get_the_excerpt( $post_id );
						}

						wp_editor( stripslashes( $customfield_val ), $slug, $settings );
						$wp_editor = ob_get_clean();

						$wp_editor = str_replace( '<textarea', '<textarea name="' . $slug . '"', $wp_editor );

						$required = '';
						if ( isset( $customfield['required'] ) ) {
							$wp_editor = str_replace( '<textarea', '<textarea required="required"', $wp_editor );
							$required  = $form->renderRequired();
						}

						if ( $textarea_rows ) {
							$wp_editor = preg_replace( '/<textarea/', "<textarea rows=\"" . $textarea_rows . "\"", $wp_editor );
						}

						$excerpt_minlength = isset( $customfield['validation_minlength'] ) ? $customfield['validation_minlength'] : 0;
						$excerpt_maxlength = isset( $customfield['validation_maxlength'] ) ? $customfield['validation_maxlength'] : 0;
						$wp_editor         = preg_replace( '/<textarea/', sprintf( "<textarea data-rule-minlength=\"[%d]\"", $excerpt_minlength ), $wp_editor );
						$wp_editor         = preg_replace( '/<textarea/', sprintf( "<textarea data-rule-maxlength=\"[%d]\"", $excerpt_maxlength ), $wp_editor );
						$wp_editor         = preg_replace( '/<textarea/', sprintf( "<textarea data-form='%s'", $form_slug ), $wp_editor );

						$labels_layout = isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) ? $buddyforms[ $form_slug ]['layout']['labels_layout'] : 'inline';

						$wp_editor_label = '';
						if ( $labels_layout == 'inline' ) {
							if ( isset( $customfield['required'] ) ) {
								$required = $form->getRequiredSignal();
							}
							$wp_editor = preg_replace( '/<textarea/', "<textarea placeholder=\"" . $name . $required . "\"", $wp_editor );
						} else {
							$wp_editor_label = '<label for="'. $slug . '" >' . $name . $required . '</label>';
						}

						if ( isset( $customfield['hidden_field'] ) ) {
							$form->addElement( new Element_Hidden( $slug, $customfield_val, array() ) );
						} else {
							if ( isset( $buddyforms[ $form_slug ]['layout']['desc_position'] ) && $buddyforms[ $form_slug ]['layout']['desc_position'] == 'above_field' ) {
								$wp_editor = '<div class="bf_field_group bf_form_content">' . $wp_editor_label . '<span class="help-inline">' . $description . '</span><div class="bf_inputs bf-input">' . $wp_editor . '</div></div>';
							} else {
								$wp_editor = '<div class="bf_field_group bf_form_content">' . $wp_editor_label . '<div class="bf_inputs bf-input">' . $wp_editor . '</div><span class="help-inline">' . $description . '</span></div>';
							}

							add_filter( 'the_content', 'do_shortcode', 11 );
							$form->addElement( new Element_PostExcerpt( $name, $slug, $wp_editor, $customfield ) );
						}
						break;
					case 'hidden' :
						$form->addElement( new Element_Hidden( $name, $customfield['value'], $customfield ) );
						break;

					case 'text' :
						$text_minlength                      = isset( $customfield['validation_minlength'] ) ? $customfield['validation_minlength'] : 0;
						$text_maxlength                      = isset( $customfield['validation_maxlength'] ) ? $customfield['validation_maxlength'] : 0;
						$element_attr['data-rule-minlength'] = '[' . $text_minlength . ']';
						$element_attr['data-rule-maxlength'] = '[' . $text_maxlength . ']';

						$form->addElement( new Element_Textbox( $name, $slug, $element_attr, $customfield ) );
						break;

					case 'range' :
						$form->addElement( new Element_Range( $name, $slug, $element_attr, $customfield ) );
						break;

					case 'captcha' :
						if ( ! is_user_logged_in() && ( $action === 'new' || $action === 'edit' ) ) {
							$element = new Element_Captcha( $name, $element_attr, $customfield );
							$element->setAttribute( 'site_key', ( ! empty( $customfield['captcha_site_key'] ) ) ? $customfield['captcha_site_key'] : '' );
							$element->setAttribute( 'private_key', ! empty( $customfield['captcha_private_key'] ) ? $customfield['captcha_private_key'] : '' );
							$element->setAttribute( 'data_theme', ! empty( $customfield['captcha_data_theme'] ) ? $customfield['captcha_data_theme'] : 'dark' );
							$element->setAttribute( 'data_type', ! empty( $customfield['captcha_data_type'] ) ? $customfield['captcha_data_type'] : 'image' );
							$element->setAttribute( 'data_size', ! empty( $customfield['captcha_data_size'] ) ? $customfield['captcha_data_size'] : 'normal' );
							$form->addElement( $element );
						}
						break;

					case 'link' :
						$form->addElement( new Element_Url( $name, $slug, $element_attr, $customfield ) );
						break;

					case 'featured_image':
						Element_Upload::loadAssets();
						//Featured image
						wp_enqueue_script( 'buddyforms_featured_image_initializer', BUDDYFORMS_ASSETS . 'resources/featured-image/featured-image-initializer.js', array( 'jquery' ), BUDDYFORMS_VERSION, true );

						$upload_error_validation_message = isset( $customfield['upload_error_validation_message'] ) ? $customfield['upload_error_validation_message'] : "";
						$max_file_size                   = isset( $customfield['max_file_size'] ) ? $customfield['max_file_size'] : 1;
						$validation_error_message        = isset( $customfield['validation_error_message'] ) ? $customfield['validation_error_message'] : '';
						$required                        = isset( $customfield['required'] ) ? "data-rule-featured-image-required ='true' validation_error_message='$validation_error_message'" : '';
						$id                              = $slug;
						$feature_action                  = isset( $_GET['action'] ) ? $_GET['action'] : "";
						$page                            = isset( $_GET['page'] ) ? $_GET['page'] : "";
						$result                          = "";
						$result_value                    = "";
						$entries                         = array();
						$entries_result                  = "";
						if ( $post_id > 0 ) {
							//Load the current feature image
							$post_feature_image_id = get_post_thumbnail_id( $post_id );
							$metadata              = wp_prepare_attachment_for_js( $post_feature_image_id );
							if ( $metadata != null ) {
								$url                               = wp_get_attachment_thumb_url( $post_feature_image_id );
								$result                            .= $post_feature_image_id . ",";
								$mockFile                          = new stdClass();
								$mockFile->name                    = $metadata['filename'];
								$mockFile->url                     = $url;
								$mockFile->attachment_id           = $post_feature_image_id;
								$mockFile->size                    = $metadata['filesizeInBytes'];
								$entries[ $post_feature_image_id ] = $mockFile;
							}
						}
						if ( count( $entries ) > 0 ) {
							$entries_result = json_encode( $entries );
						}
						if ( ! empty( $result ) ) {
							$result_value = rtrim( trim( $result ), ',' );
						}
						$labels_layout = isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) ? $buddyforms[ $form_slug ]['layout']['labels_layout'] : 'inline';

						$label_name = $customfield['name'];
						if ( $required ) {
							$label_name = $label_name . html_entity_decode( $form->renderRequired() );
						}

						$localized_strings = Element_Upload::strings();
						$message           = $localized_strings['dictDefaultMessage'];
						$box               = "<div class='bf_field_group elem-$slug'>";
						if ( $labels_layout !== 'inline' ) {
							$box .= sprintf( '<label for="%s">%s</label>', $customfield['name'], $label_name );
						}
						$classes = 'dropzone featured-image-uploader dz-clickable';
						if ( $has_error ) {
							$classes .= ' error';
						}
						$box .= "<div class='bf-input'><div class=\"$classes\" id=\"$id\"  action='$feature_action' data-entry='$entries_result' page='$page' max_file_size='$max_file_size'>";
						if ( $labels_layout === 'inline' ) {
							$box .= sprintf( '<div class="bf-field-label-container"><label>%s</label></div>', $label_name );
						}
						$box .= "<div class=\"dz-default dz-message\" data-dz-message=\"\"><span>$message</span></div><input type='text' class='form-control' style='visibility: hidden' name='$id' value='$result_value' id='field_$id' data-rule-featured-image-error='true' upload_error_validation_message='$upload_error_validation_message' $required  /></div></div></div><span class='help-inline'>$description</span>";

						$form->addElement( new Element_HTML( $box ) );


						// always add slug
						$featured_image_params = array( 'id' => $slug );

						// add "required" if needed
						if ( isset( $customfield['required'] ) ) {
							$featured_image_params['required'] = 'required';
						}
						break;
					case 'upload':
						$max_size                          = '2';
						$accepted_files                    = 'image/*';
						$multiple_files                    = "1";
						$delete_files                      = false;
						$description                       = "";
						$required                          = "";
						$ensure_amount                     = "";
						$validation_error_message          = "";
						$upload_error_validation_message   = "";
						$label_name                        = "";
						$multiple_files_validation_message = "";
						$custom_class                      = "";
						$field_id                          = "";
						$upload_from_url                   = isset( $customfield['upload_from_url'] ) ? $customfield['upload_from_url'][0] : '';
						if ( isset( $customfield['name'] ) ) {
							$label_name = $customfield['name'];
						}
						if ( isset( $customfield['required'] ) ) {
							$required = $customfield['required'][0];
						}
						if ( isset( $customfield['ensure_amount'] ) ) {
							$ensure_amount = $customfield['ensure_amount'][0];
						}
						if ( isset( $customfield['validation_error_message'] ) ) {
							$validation_error_message = $customfield['validation_error_message'];
						}
						if ( isset( $customfield['description'] ) ) {
							$description = $customfield['description'];
						}
						if ( isset( $customfield['file_limit'] ) ) {
							$max_size = $customfield['file_limit'];
						}
						if ( isset( $customfield['accepted_files'] ) ) {
							$accepted_files = $customfield['accepted_files'];
						}
						if ( isset( $customfield['multiple_files'] ) ) {
							$multiple_files = $customfield['multiple_files'];

						}
						if ( isset( $customfield['multiple_files_validation_message'] ) ) {
							$multiple_files_validation_message = $customfield['multiple_files_validation_message'];

						}
						if ( isset( $customfield['upload_error_validation_message'] ) ) {
							$upload_error_validation_message = $customfield['upload_error_validation_message'];

						}

						if ( isset( $customfield['delete_files'] ) ) {
							$param_value  = $customfield['delete_files'][0];
							$delete_files = $param_value == 'delete' ? true : false;
						}

						if ( isset( $customfield['custom_class'] ) ) {
							$custom_class = $customfield['custom_class'];
						}

						if ( isset( $customfield['field_id'] ) ) {
							$field_id = $customfield['field_id'];
						}

						$upload_element = new Element_Upload( $label_name, $customfield_val, array(
							'id'                                => $slug,
							"file_limit"                        => $max_size,
							'accepted_files'                    => $accepted_files,
							'multiple_files'                    => $multiple_files,
							'delete_files'                      => $delete_files,
							'mandatory'                         => $required,
							'ensure_amount'                     => $ensure_amount,
							'validation_error_message'          => $validation_error_message,
							"multiple_files_validation_message" => $multiple_files_validation_message,
							"upload_error_validation_message"   => $upload_error_validation_message,
							"shortDesc"                         => $description,
							"form_slug"                         => $form_slug,
							"upload_from_url"                   => $upload_from_url,
							"custom_class"                      => $custom_class,
							"field_id"                          => $field_id
						), $customfield );
						$form->addElement( $upload_element );
						break;
					case 'file':

						wp_enqueue_script( 'media-uploader-js', BUDDYFORMS_ASSETS . 'js/media-uploader.js', array( 'jquery' ) );

						$attachment_ids = $customfield_val;

						$str = '<div id="bf_files_container_' . $slug . '" class="bf_files_container bf_field_group"><ul class="bf_files">';

						$attachments = array_filter( explode( ',', $attachment_ids ) );

						if ( $attachments ) {
							foreach ( $attachments as $attachment_id ) {

								$attachment_metadat = get_post( $attachment_id );

								$str .= '<li class="image bf_image" data-attachment_id="' . esc_attr( $attachment_id ) . '">

                                    <div class="bf_attachment_li">
                                    <div class="bf_attachment_img">
                                    ' . wp_get_attachment_image( $attachment_id, array( 64, 64 ), true ) . '
                                    </div><div class="bf_attachment_meta">
                                    <p><b>' . __( 'Name: ', 'buddyforms' ) . '</b>' . $attachment_metadat->post_title . '<p>
                                    <p><b>' . __( 'Type: ', 'buddyforms' ) . '</b>' . $attachment_metadat->post_mime_type . '<p>

                                    <p>
                                    <a href="#" class="delete tips" data-slug="' . $slug . '" data-tip="' . __( 'Delete image', 'buddyforms' ) . '">' . __( 'Delete', 'buddyforms' ) . '</a>
                                    <a href="' . wp_get_attachment_url( $attachment_id ) . '" target="_blank" class="view" data-tip="' . __( 'View', 'buddyforms' ) . '">' . __( 'View', 'buddyforms' ) . '</a>
                                    </p>
                                    </div></div>

                                </li>';
							}
						}

						$str .= '</ul>';

						$str .= '<span class="bf_add_files hide-if-no-js">';


						$library_types = $allowed_types = '';
						if ( isset( $customfield['data_types'] ) ) {

							$data_types_array   = Array();
							$allowed_mime_types = get_allowed_mime_types();

							foreach ( $customfield['data_types'] as $key => $value ) {
								$data_types_array[ $value ] = $allowed_mime_types[ $value ];
							}

							$library_types = implode( ",", $data_types_array );
							$library_types = 'data-library_type="' . $library_types . '"';

							$allowed_types = implode( ",", $customfield['data_types'] );
							$allowed_types = 'data-allowed_type="' . $allowed_types . '"';

						}

						$data_multiple = 'data-multiple="false"';
						if ( isset( $customfield['validation_multiple'] ) ) {
							$data_multiple = 'data-multiple="true"';
						}

						$labels_layout = isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) ? $buddyforms[ $form_slug ]['layout']['labels_layout'] : 'inline';

						$name_inline = __( 'Attache File', 'buddyforms' );
						if ( isset( $customfield['required'] ) && $labels_layout == 'inline' ) {
							$name_inline = $name . $form->getRequiredSignal();
						}

						$classes = 'form-control btn btn-primary';
						if ( $has_error ) {
							$classes .= ' error';
						}
						$str .= '<button class="' . $classes . '" field_id="' . $field_id . '" data-form="' . $form_slug . '" data-slug="' . $slug . '" ' . $data_multiple . ' ' . $allowed_types . ' ' . $library_types . 'data-choose="' . __( 'Add into', 'buddyforms' ) . '" data-update="' . __( 'Add ', 'buddyforms' ) . $name . '" data-delete="' . __( 'Delete ', 'buddyforms' ) . '" data-text="' . __( 'Delete', 'buddyforms' ) . '">' . $name_inline . '</button>';
						$str .= '</span>';

						$str .= '</div>';

						if ( ! empty( $description ) ) {
							$str .= '<span class="help-inline">';
							$str .= $description;
							$str .= '</span>';
						}

						$file_element = '<div class="bf_field_group">';
						if ( $labels_layout != 'inline' ) {
							$file_element .= '<label for="_' . $slug . '">' . $name;

							if ( isset( $customfield['required'] ) ) {
								$file_element .= $form->renderRequired();
							}

							$file_element .= '</label>';
						}

						$hidden_file_element = new Element_Hidden( $slug, $customfield_val, $element_attr );
						$str                 .= $hidden_file_element->html();

						$file_element .= '<div class="bf_inputs bf-input">
                            ' . $str . '
                            </div></div>
                        ';
						$form->addElement( new Element_HTML( $file_element ) );

						break;
					case 'post_formats' :
						$post_formats  = array();
						$theme_format  = get_theme_support( 'post-formats' );
						$theme_format  = isset( $theme_format[0] ) ? $theme_format[0] : array();
						$default_value = __( 'Select a Post Format', 'buddyforms' );
						$labels_layout = isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) ? $buddyforms[ $form_slug ]['layout']['labels_layout'] : 'inline';
						$i             = 0;
						foreach ( $theme_format as $format ) {
							if ( $i === 0 ) {
								if ( isset( $customfield['required'] ) && is_array( $customfield['required'] ) && $labels_layout === 'inline' ) {
									$default_value = $name . ' ' . $form->getRequiredPlainSignal();
								}
								$post_formats[''] = $default_value;
							} else {
								$post_formats[ $format ] = $format;
							}
							$i ++;
						}
						if ( empty( $element_attr['value'] ) ) {
							$element_attr['value'] = $customfield['post_formats_default'];
						}
						if ( isset( $customfield['hidden_field'] ) ) {
							$form->addElement( new Element_Hidden( $slug, $customfield['post_formats_default'], array() ) );
						} else {
							$form->addElement( new Element_PostFormats( $name, $slug, $post_formats, $element_attr, $customfield ) );
						}

						break;
					case 'taxonomy' :
					case 'category' :
					case 'tags' :
						BuddyFormsAssets::load_select2_assets();
						if ( ! isset( $customfield['taxonomy'] ) ) {
							break;
						}
						if ( $customfield['taxonomy'] == 'none' ) {

							if ( $field_type == 'tags' ) {
								$customfield['taxonomy'] = 'post_tag';
							} elseif ( $field_type == 'category' ) {
								$customfield['taxonomy'] = 'category';
							} else {
								break;
							}

						}

						$taxonomy = isset( $customfield['taxonomy'] ) && $customfield['taxonomy'] != 'none' ? $customfield['taxonomy'] : '';
						$order    = $customfield['taxonomy_order'];
						$exclude  = isset( $customfield['taxonomy_exclude'] ) ? implode( ',', $customfield['taxonomy_exclude'] ) : '';
						$include  = isset( $customfield['taxonomy_include'] ) ? implode( ',', $customfield['taxonomy_include'] ) : '';

						$args = array(
							'hide_empty'    => 0,
							'id'            => $field_id,
							'child_of'      => 0,
							'echo'          => false,
							'selected'      => false,
							'hierarchical'  => 1,
							'name'          => $slug . '[]',
							'class'         => 'postform bf-select2-' . $field_id,
							'depth'         => 0,
							'tab_index'     => 0,
							'hide_if_empty' => false,
							'orderby'       => 'SLUG',
							'taxonomy'      => $taxonomy,
							'order'         => $order,
							'exclude'       => $exclude,
							'include'       => $include,
							'allowClear'    => true,
						);

						$is_required   = isset( $customfield['required'] ) && is_array( $customfield['required'] ) ? true : false;
						$labels_layout = isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) ? $buddyforms[ $form_slug ]['layout']['labels_layout'] : 'inline';
						$placeholder   = ! empty( $customfield['taxonomy_placeholder'] ) ? $customfield['taxonomy_placeholder'] : 'Select an option';
						if ( $is_required && $labels_layout === 'inline' ) {
							$placeholder .= ' * ';
						}
						if ( ! isset( $customfield['multiple'] ) || empty( $customfield['taxonomy_default'] ) ) {
							$args = array_merge( $args, Array( 'placeholder' => $placeholder, 'show_option_none' => $placeholder, 'option_none_value' => '' ) );
						}

						if ( isset( $customfield['multiple'] ) ) {
							$args = array_merge( $args, Array( 'multiple' => $customfield['multiple'], 'placeholder' => $placeholder, 'show_option_none' => '', 'option_none_value' => '' ) );
						}

						$args = apply_filters( 'buddyforms_wp_dropdown_categories_args', $args, $post_id );

						$dropdown = wp_dropdown_categories( $args );

						if ( isset( $customfield['multiple'] ) && is_array( $customfield['multiple'] ) ) {
							$dropdown = str_replace( 'id=', 'multiple="multiple" id=', $dropdown );
						}

						if ( isset( $customfield['required'] ) && is_array( $customfield['required'] ) ) {
							$dropdown = str_replace( 'id=', 'required id=', $dropdown );
						}

						$dropdown = str_replace( 'id=', 'data-form="' . $form_slug . '" id=', $dropdown );
						$dropdown = str_replace( 'id=', 'data-placeholder="' . $placeholder . '" id=', $dropdown );
						$dropdown = str_replace( 'id=', 'style="width:100%;" id=', $dropdown );

						if ( isset( $customfield['taxonomy'] ) ) {
							$the_post_terms = get_the_terms( $post_id, $customfield['taxonomy'] );
						}

						if ( isset( $the_post_terms ) && is_array( $the_post_terms ) ) {
							foreach ( $the_post_terms as $key => $post_term ) {
								$dropdown = str_replace( ' value="' . $post_term->term_id . '"', ' value="' . $post_term->term_id . '" selected="selected"', $dropdown );
							}
						} else {
							if ( isset( $customfield['taxonomy_default'] ) ) {
								foreach ( $customfield['taxonomy_default'] as $key => $tax ) {
									$dropdown = str_replace( ' value="' . $customfield['taxonomy_default'][ $key ] . '"', ' value="' . $tax . '" selected="selected"', $dropdown );
								}
							}
						}

						if ( isset( $customfield['hidden_field'] ) ) {
							if ( isset( $customfield['taxonomy_default'] ) ) {
								foreach ( $customfield['taxonomy_default'] as $key => $tax ) {
									unset($customfield['type']);
									unset($customfield['name']);
									$form->addElement( new Element_Hidden( $slug . '[' . $key . ']', $tax, $customfield ) );
								}
							}
						} else {
							$required = '';
							if ( isset( $customfield['required'] ) && is_array( $customfield['required'] ) ) {
								$required = $form->renderRequired();
							}

							$minimumResultsForSearch = empty( $customfield['taxonomy_default'] ) ? 'minimumResultsForSearch: -1, ' : '';
							$tags                    = isset( $customfield['create_new_tax'] ) ? 'tags: true, ' : 'tags: false, ';
							$maximumSelectionLength  = '';
							if ( isset( $customfield['multiple'] ) && isset( $customfield['maximumSelectionLength'] ) ) {
								$maximumSelectionLength = sprintf( "maximumSelectionLength: %s, ", $customfield['maximumSelectionLength'] );
							}
							$ajax_options = '';
							$is_ajax      = isset( $customfield['ajax'] );
							if ( $is_ajax ) {
								if ( isset( $customfield['minimumInputLength'] ) ) {
									$ajax_options .= sprintf( "minimumInputLength: %s, ", $customfield['minimumInputLength'] );
								}
								$ajax_options .= sprintf(
									"ajax:{ url: \"%s\", delay: 250, dataType: \"json\", cache: true, method : \"POST\", data: function (params) { var query = { search: params.term, type: \"public\", action: \"bf_load_taxonomy\", nonce: \"%s\", form_slug: \"%s\", taxonomy: \"%s\", order: \"%s\", exclude: \"%s\", include: \"%s\" }; return query;  } }, ",
									admin_url( 'admin-ajax.php' ),
									wp_create_nonce( 'bf_tax_loading' ),
									$form_slug,
									$taxonomy,
									$order,
									$exclude,
									$include
								);
							}
							$label_name = $labels_layout === 'label' ? $name . $required : '';
							$dropdown   = <<<MARKDOWN
							<script>
								jQuery(document).ready(function () {
									const select2Elm = jQuery(".bf-select2-{$field_id}");
									
									// Prevent Firefox from maintaining previously selected items.
									select2Elm.find('[selected="selected"]').each(function() {
										jQuery(this).prop("selected", true);
									});

								    select2Elm.select2({
								    	placeholder: function(){
									        jQuery(this).data("placeholder");
									    },
									    allowClear: true,
									    tokenSeparators: [','],
								       	{$minimumResultsForSearch}
								       	{$maximumSelectionLength}
								       	{$ajax_options}
									    {$tags}
								    });
								    jQuery(".bf-select2-{$field_id}").on("change", function () {
					                     var formSlug = jQuery(this).data("form");
					                     if(formSlug && buddyformsGlobal && buddyformsGlobal[formSlug]){
				                            if (formSlug && buddyformsGlobal[formSlug] && typeof buddyformsGlobal[formSlug].js_validation == "undefined") {
					                            jQuery('form[id="buddyforms_form_'+formSlug+'"]').valid();
					                        }
					                     }
					                });
							    });
							</script>
	                        <div class="bf_inputs bf-input">{$dropdown}</div>
MARKDOWN;
							//Load select2
							$element = new Element_Select2( $dropdown, $name, $slug, $customfield );
							$form->addElement( $element );
						}

						break;

					case 'gdpr' :

						if ( isset( $customfield['options'] ) && is_array( $customfield['options'] ) ) {
							//Add the script for gdpr
							wp_enqueue_script( 'buddyforms-gdpr-js', BUDDYFORMS_ASSETS . 'js/gdpr.js', array( 'jquery' ), BUDDYFORMS_VERSION, false );

							$label = $name;

							$shortdesc = $element_attr['shortDesc'];
							foreach ( $customfield['options'] as $key => $option ) {

								if ( isset( $option['checked'] ) ) {
									$element_attr['value'] = 'checked';
								} else {

									unset( $element_attr['value'] );
								}


								if ( isset( $buddyforms[ $form_slug ]['layout']['desc_position'] ) && $buddyforms[ $form_slug ]['layout']['desc_position'] == 'above_field' ) {
									if ( $key == 1 ) {
										$shortDesc = $customfield['description'];
									} else {
										$shortDesc = '';
									}
								} else {
									if ( count( $customfield['options'] ) == $key ) {
										$shortDesc = $customfield['description'];
									} else {
										$shortDesc = '';
									}
								}


								if ( isset( $option['required'] ) ) {
									$element_attr['required'] = true;
									$customfield['default']   = true;
									if ( strpos( $element_attr['class'], 'gdpragreement-required' ) == false ) {
										$element_attr['class'] = $element_attr['class'] . ' gdpragreement-required';
									}

								} else {
									unset( $element_attr['required'] );
									$new_class             = str_replace( 'gdpragreement-required', '', $element_attr['class'] );
									$element_attr['class'] = $new_class;
								}
								$element_attr['data-element-slug']        = $slug;
								$element_attr['id']                       = 'gdpragreement-' . $key;
								$element_attr['validation_error_message'] = $customfield['options'][ $key ]['error_message'];


								$element = new Element_Checkbox( $label, $slug . '_' . $key, array( 'checked' => $option['label'] ), $element_attr, $customfield );

								$element->setAttribute( 'data-storage', 'false' );


								$form->addElement( $element );


								$label = '';

							}

						}
						break;
					case 'form_actions':
						$form = buddyforms_form_action_buttons( $form, $form_slug, $post_id, $customfield );
						break;
					case 'price':
						$form->addElement( new Element_Price( $name, $slug, $element_attr, $customfield ) );
						break;

					default:

						$form_args = Array(
							'field_id'        => $field_id,
							'post_id'         => $post_id,
							'post_parent'     => "",//$post_parent,
							'form_slug'       => $form_slug,
							'customfield'     => $customfield,
							'customfield_val' => $customfield_val,
							'element_attr'    => $element_attr,
							'slug'            => $slug,
							'name'            => $name,
							'field_type'      => $field_type,
							'action'          => $action,
						);

						// hook to add your form element
						$form = apply_filters( 'buddyforms_create_edit_form_display_element', $form, $form_args );

						break;

				}
			}

		}
	}
}
