<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class Element_Upload
 */
class Element_Upload extends Element_Textbox {

	/**
	 * @var string
	 */
	protected $message = "Error: %element% is a required field.";

	/**
	 * @var array
	 */
	protected $_attributes = array(
		"type"           => "file",
		"file_limit"     => "",
		"accepted_files" => "",
		"multiple_files" => "",
		"delete_files"   => "",
		"description"    => "",
		"mandatory"      => ""
	);

	public function isValid( $value ) {
		if ( ! empty( $this->field_options ) && ! empty( $this->field_options['required'] ) && $this->field_options['required'][0] === 'required' ) {
			$validation = new Validation_Required( $this->message, $this->field_options );

			$result = $validation->isValid( $value, $this );

			if ( ! $result ) {
				$this->_errors[] = str_replace( "%element%", $this->getLabel(), $validation->getMessage() );
			}

			return apply_filters( 'buddyforms_element_content_validation', $result, $this );
		} else {
			return true;
		}
	}

	public function isRequired() {
		return ! empty( $this->getAttribute( 'mandatory' ) );
	}


	public static function save_post_meta( $customfield, $post_id ) {
		if ( $customfield['type'] == 'featured_image' ) {
			if ( ! empty( $_POST[ $customfield['slug'] ] ) ) {
				$attachment_id = $_POST[ $customfield['slug'] ];
				//Update attachment parent
				$attachment_args = array(
					'ID'          => $attachment_id,
					'post_parent' => $post_id,
				);
				wp_update_post( $attachment_args );
				//Update post thumb data
				set_post_thumbnail( $post_id, $attachment_id );
			}
		}
	}

	public static function submission_default_value( $bf_value, $item, $field_type, $field_slug ) {
		if ( $field_type === 'featured_image' ) {
			$featured_img_url = get_the_post_thumbnail_url( $item->ID );
			$result           = '<a target="blank" href="' . esc_url( $featured_img_url ) . '" rel="lightbox">' . get_the_post_thumbnail( $item->ID, array( 64, 64 ) ) . '</a>';

			return $result;
		}

		return $bf_value;
	}

	/**
	 * Return the localization string for this field
	 *
	 * @param $default
	 *
	 * @return array
	 * @since 2.4.0
	 *
	 */
	public static function localize_string( $default ) {
		return array_merge( $default, array(
			'upload' => self::strings()
		) );
	}

	public static function strings() {
		return array(
			'submitButton'                 => __( 'Upload in progress', 'buddyforms' ),
			'dictMaxFilesExceeded'         => __( 'You can not upload any more files.', 'buddyforms' ),
			'dictRemoveFile'               => __( 'Remove file', 'buddyforms' ),
			'dictCancelUploadConfirmation' => __( 'Are you sure you want to cancel this upload?', 'buddyforms' ),
			'dictCancelUpload'             => __( 'Cancel upload', 'buddyforms' ),
			'dictResponseError'            => __( 'Server responded with {{statusCode}} code.', 'buddyforms' ),
			'dictInvalidFileType'          => __( 'You can\'t upload files of this type.', 'buddyforms' ),
			'dictFileTooBig'               => __( 'File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.', 'buddyforms' ),
			'dictFallbackMessage'          => __( 'Your browser does not support drag\'n\'drop file uploads.', 'buddyforms' ),
			'dictDefaultMessage'           => __( 'Drop files here to upload', 'buddyforms' ),
		);
	}

	public static function upload_process_field_submission( $field_slug, $field_type, $field, $post_id, $form_slug, $args, $action ) {
		if ( $field_type !== 'upload' && $field_type !== 'featured_image' ) {
			return;
		}
		$media_attached_to_post = get_attached_media( '', $post_id );
		$key_value              = '';
		$attachment_ids         = array();
		if ( $field_type === 'upload' || $field_type === 'featured_image' ) {
			$key_value = isset( $_POST[ $field_slug ] ) ? $_POST[ $field_slug ] : "";
			if ( $field_type === 'upload' ) {
				if ( ! empty( $key_value ) ) {
					if ( empty( $attachment_ids ) ) {
						$attachment_ids = explode( ",", $key_value );
					} else {
						$attachment_ids = array_merge( $attachment_ids, explode( ",", $key_value ) );
					}
				}
			}
		}

		if ( $field_type === 'upload' ) {
			if ( ! empty( $attachment_ids ) && is_array( $attachment_ids ) ) {
				$absolute_path = wp_upload_dir()['path'];
				foreach ( $attachment_ids as $id_value ) {
					$file_already_uploaded = isset( $media_attached_to_post[ $id_value ] );
					//If the file was already uploaded don´t execute the attachment logic
					if ( ! $file_already_uploaded && ! empty( $id_value ) ) {
						$metadata    = wp_prepare_attachment_for_js( $id_value );
						$file_name   = $metadata['filename'];
						$wp_filetype = wp_check_filetype( $file_name, null );
						$attachment  = array(
							'post_mime_type' => $wp_filetype['type'],
							'post_title'     => preg_replace( '/\.[^.]+$/', '', $file_name ),
							'post_content'   => '',
							'post_status'    => 'inherit',
							'ID'             => $id_value,
							'post_parent'    => $post_id
						);

						// Create the attachment
						$attach_id = wp_insert_attachment( $attachment, $absolute_path . '/' . $file_name, $post_id );
						// Define attachment metadata

						// Include image.php if not was loaded
						if ( ! buddyforms_check_loaded_file( ABSPATH . 'wp-admin/includes/image.php' ) ) {
							require_once( ABSPATH . 'wp-admin/includes/image.php' );
						}

						$attach_data = wp_generate_attachment_metadata( $attach_id, $absolute_path . '/' . $file_name );

						// Assign metadata to attachment
						wp_update_attachment_metadata( $attach_id, $attach_data );
					}

				}
			}
		} else {
			$attach_id = $key_value;
			if ( ! empty( $attach_id ) ) {
				global $buddyforms;

				if ( buddyforms_is_multisite() && ! empty( $buddyforms[ $form_slug ]['blog_id'] ) ) {
					restore_current_blog();

					$image_url = wp_get_attachment_image_src( $attach_id, 'full' );
					$image_url = $image_url[0];

					switch_to_blog( $buddyforms[ $form_slug ]['blog_id'] );

					// Add Featured Image to Post
					$upload_dir = wp_upload_dir(); // Set upload folder
					$image_data = file_get_contents( $image_url ); // Get image data
					$filename   = basename( $image_url ); // Create image file name

					// Check folder permission and define file location
					if ( wp_mkdir_p( $upload_dir['path'] ) ) {
						$file = $upload_dir['path'] . '/' . $filename;
					} else {
						$file = $upload_dir['basedir'] . '/' . $filename;
					}

					// Create the image  file on the server
					file_put_contents( $file, $image_data );

					// Check image file type
					$wp_filetype = wp_check_filetype( $filename, null );

					// Set attachment data
					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name( $filename ),
						'post_content'   => '',
						'post_status'    => 'inherit'
					);

					// Create the attachment
					$attach_id = wp_insert_attachment( $attachment, $file, $post_id );

					// Include image.php if not was loaded
					if ( ! buddyforms_check_loaded_file( ABSPATH . 'wp-admin/includes/image.php' ) ) {
						require_once( ABSPATH . 'wp-admin/includes/image.php' );
					}

					// Define attachment metadata
					$attach_data = wp_generate_attachment_metadata( $attach_id, $file );

					// Assign metadata to attachment
					wp_update_attachment_metadata( $attach_id, $attach_data );
				}

				// And finally assign featured image to post
				wp_update_post(
					array(
						'ID'          => $attach_id,
						'post_parent' => $post_id
					)
				);

				// Ok let us save the Attachment as post thumbnail
				set_post_thumbnail( $post_id, $attach_id );
			} else {
				delete_post_thumbnail( $post_id );
			}
		}
	}

	public static function loadAssets() {
		wp_enqueue_script( 'buddyforms-dropzone', BUDDYFORMS_ASSETS . 'resources/dropzone/dropzone.js', array( 'jquery' ) );
		wp_enqueue_style( 'buddyforms-dropzone-basic', BUDDYFORMS_ASSETS . 'resources/dropzone/basic.css' );
		wp_enqueue_style( 'buddyforms-dropzone', BUDDYFORMS_ASSETS . 'resources/dropzone/dropzone.css' );
	}

	public function render() {
		self::loadAssets();
		//DropZone
		wp_enqueue_script( 'buddyforms_dropzone_initializer', BUDDYFORMS_ASSETS . 'resources/dropzone/initializer.js', array( 'jquery' ), BUDDYFORMS_VERSION, true );

		global $buddyforms, $post_id;

		$id     = $this->getAttribute( 'id' );
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		$entry  = isset( $_GET['entry'] ) ? $_GET['entry'] : "";
		$page   = isset( $_GET['page'] ) ? $_GET['page'] : "";

		//If Entry is empty we check if we are in a edit entry page
		if ( empty( $entry ) ) {
			$entry = isset( $_GET['post'] ) ? $_GET['post'] : "";
		}

		$column_val     = "";
		$result         = "";
		$result_value   = "";
		$entries        = array();
		$entries_result = "";
		if ( $post_id > 0 ) {
			$column_val = get_post_meta( $post_id, $id, true );

			$attachmet_id = explode( ",", $column_val );
			foreach ( $attachmet_id as $id_value ) {

				$metadata = wp_prepare_attachment_for_js( $id_value );
				if ( $metadata != null ) {
					$url                     = wp_get_attachment_thumb_url( $id_value );
					$result                  .= $id_value . ",";
					$mockFile                = new stdClass();
					$mockFile->name          = isset( $metadata['filename'] ) ? $metadata['filename'] : '';
					$mockFile->url           = esc_url( $url );
					$mockFile->attachment_id = $id_value;
					$mockFile->size          = isset( $metadata['filesizeInBytes'] ) ? $metadata['filesizeInBytes'] : '';
					$entries[ $id_value ]    = $mockFile;
				}

			}
		}
		if ( count( $entries ) > 0 ) {
			$entries_result = esc_attr( json_encode( $entries ) );
		}
		$localized_strings = self::strings();
		$message           = $localized_strings['dictDefaultMessage'];
		if ( ! empty( $result ) ) {
			$result_value = rtrim( trim( $result ), ',' );
		}
		$required                          = $this->getAttribute( 'mandatory' );
		$ensure_amount                     = $this->getAttribute( 'ensure_amount' );
		$validation_error_message          = $this->getAttribute( 'validation_error_message' );
		$description                       = $this->getAttribute( 'description' );
		$max_size                          = $this->getAttribute( 'file_limit' );
		$accepted_files                    = $this->getAttribute( 'accepted_files' );
		$multiple_files                    = $this->getAttribute( 'multiple_files' );
		$multiple_files_validation_message = $this->getAttribute( 'multiple_files_validation_message' );
		$upload_error_validation_message   = $this->getAttribute( 'upload_error_validation_message' );
		$mime_type                         = '';
		$mime_type_result                  = '';
		$allowed_types                     = get_allowed_mime_types();
		$allowed_types['mp3']              = 'audio/mp3';
		$form_slug                         = $this->getAttribute( 'form_slug' );
		$upload_from_url                   = $this->getAttribute( 'upload_from_url' );
		$custom_class                      = $this->getAttribute('custom_class');
		foreach ( $accepted_files as $key => $value ) {
			$mime_type .= $allowed_types[ $value ] . ',';
		}
		if ( ! empty( $mime_type ) ) {
			$mime_type_result = rtrim( trim( $mime_type ), ',' );
		}

		if ( ! empty( $required ) ) {
			$required = 'data-rule-upload-required=\'true\' ';
			if ( ! empty( $validation_error_message ) ) {
				$required .= ' data-msg-upload-required=\'' . $validation_error_message . '\'';
			}
		}

		if ( ! empty( $ensure_amount ) ) {
			$ensure_amount = "data-rule-upload-ensure-amount ='$multiple_files'";
		}

		$labels_layout = isset( $buddyforms[ $form_slug ]['layout']['labels_layout'] ) ? $buddyforms[ $form_slug ]['layout']['labels_layout'] : 'inline';

		$has_error = ( ! empty( $element_attr['error'] ) || ! empty( $customfield['error'] ) );

		$classes = 'dropzone upload_field dz-clickable';
		if ( $has_error ) {
			$classes .= ' error';
		}
		if ( $upload_from_url === 'upload_from_url' ) {

			$url          = empty( $column_val ) == false ? wp_get_attachment_url( $column_val ) : "";
			$box          = "";
			$attachmet_id = empty( $column_val ) == false ? $column_val : "";

			$label = $this->getAttribute( 'placeholder' );
			if ( $required ) {
				$label = $label . html_entity_decode( $this->renderRequired() );
			}
			$box .= sprintf( '<div class="bf-field-label-container"><label>%s</label></div>', $label );


			$box .= sprintf( '<input placeholder="Image Url" type="text" style="%s"id="%s"  %s field-id="%s" value="%s" /><button type="button"  id="%s_upload_button" field-id="%s" onclick="validateAndUploadImage(this)">upload</button>', 'width:75%; margin-right: 3px;', $id . "_upload_from_url", $required, $id, $url, $id, $id );
			$box .= sprintf( '<label  id="%s_label" class="error" ></label>', $id );
			$box .= sprintf( '<img  id="%s_image" src="%s" ></img>', $id, $url );
			$box .= sprintf( '<input type="text" style="visibility: hidden" class="form-control upload_field_input" name="%s" value="%s" id="field_%s" />', $id, $attachmet_id, $id );

			if ( ! empty( $description ) ) {
				$box .= sprintf( '<span class="help-inline">%s</span>', $description );
			}
		} else {
			$box = sprintf( '<div class="%s" id="%s" file_limit="%s" accepted_files="%s" multiple_files="%s" action="%s" data-entry="%s" page="%s" form-slug ="%s">', $classes, $id, $max_size, $mime_type_result, $multiple_files, $action, $entries_result, $page, $form_slug );
			if ( $labels_layout === 'inline' ) {
				$label = $this->getAttribute( 'placeholder' );
				if ( $required ) {
					$label = $label . html_entity_decode( $this->renderRequired() );
				}
				$box .= sprintf( '<div class="bf-field-label-container"><label>%s</label></div>', $label );
			}

			$box .= sprintf( '<div class="dz-default dz-message" data-dz-message=""><span>%s</span></div>', $message );
			$box .= sprintf( '<input type="text" style="visibility: hidden" class="form-control upload_field_input %s" name="%s" value="%s" id="field_%s" data-rule-upload-max-exceeded="[%s]" multiple_files_validation_message = "%s"  data-rule-upload-group="true" data-rule-upload-error="true" upload_error_validation_message="%s" %s %s />', $custom_class, $id, $result_value, $id, $multiple_files, $multiple_files_validation_message, $upload_error_validation_message, $required, $ensure_amount );
			$box .= '</div>';
			if ( ! empty( $description ) ) {
				$box .= sprintf( '<span class="help-inline">%s</span>', $description );
			}


		}
		echo $box;
		//$box = str_replace( "class=\"form-control\"", "class=\"dropzone\"", $box );

	}
}
