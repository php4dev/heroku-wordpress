<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

/** @var string $field_id */
/** @var string $default_option */
/** @var string $field_type */
/** @var integer $count */
/** @var array $field_options */
?>
<div class="element_field">
    <table id="field_<?php echo $field_id ?>" class="wp-list-table widefat posts element_field_table_sortable">
        <thead>
        <tr>
            <th colspan="2"><span style="padding-left: 10px;"><?php _e( 'Agreement', 'buddyforms' ) ?></span></th>
            <th><span style="padding-left: 10px;"><?php _e( 'Options', 'buddyforms' ) ?></span></th>
            <th class="manage-column column-author"><span style="padding-left: 10px;"><?php _e( 'Action', 'buddyforms' ) ?></span>
            </th>
        </tr>
        </thead>
        <tbody>
		<?php if ( ! empty( $field_options ) ): ?>
			<?php foreach ( $field_options as $key => $option ): ?>
                <tr class="field_item field_item_<?php echo $field_id ?>_<?php echo $count ?>">
                    <td><div class="dashicons dashicons-image-flip-vertical"></div></td>
                    <td><p><b><?php _e( 'Agreement Text', 'buddyforms' ) ?></b></p><?php
						$form_element = new Element_Textarea( '', "buddyforms_options[form_fields][" . $field_id . "][options][" . $key . "][label]", array( 'value' => $option['label'], 'cols' => '50', 'rows' => '3' ) );
						$form_element->render();
						?><p><b><?php _e( 'Error Message', 'buddyforms' ) ?></b></p><?php
						$error_message = empty( $option['error_message'] ) ? __( 'This field is Required', 'buddyforms' ) : $option['error_message'];
						$form_element  = new Element_Textarea( '', "buddyforms_options[form_fields][" . $field_id . "][options][" . $key . "][error_message]", array( 'value' => $error_message, 'cols' => '50', 'rows' => '3' ) );
						$form_element->render();
						?></td>
                    <td class="manage-column"><?php
						$value        = isset( $option['checked'] ) ? $option['checked'] : '';
						$form_element = new Element_Checkbox( '', "buddyforms_options[form_fields][" . $field_id . "][options][" . $key . "][checked]", array( 'checked' => 'Checked' ), array( 'value' => $value ) );
						$form_element->render();

						$value        = isset( $option['required'] ) ? $option['required'] : '';
						$form_element = new Element_Checkbox( '', "buddyforms_options[form_fields][" . $field_id . "][options][" . $key . "][required]", array( 'required' => 'Required' ), array( 'value' => $value ) );
						$form_element->render();
						?></td>
                    <td class="manage-column column-author">
                        <a href="#" id="<?php echo $field_id ?>_<?php echo $count ?>" class="bf_delete_input" title="<?php _e( 'Delete', 'buddyforms' ) ?>"><?php _e( 'Delete', 'buddyforms' ) ?></a>
                    </td>
                </tr>
				<?php $count ++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
        </tbody>
    </table>

    <table class="wp-list-table widefat posts ">
        <tbody>
        <tr>
            <td>
                <select id="gdpr_option_type">
                    <option value="none"><?php _e( 'Select a template', 'buddyforms' ) ?></option>
                    <option value="registration"><?php _e( 'Registration', 'buddyforms' ) ?></option>
                    <option value="contact"><?php _e( 'Contact Form', 'buddyforms' ) ?></option>
                    <option value="post"><?php _e( 'Post Submission', 'buddyforms' ) ?></option>
                    <option value="other"><?php _e( 'Other', 'buddyforms' ) ?></option>
                </select>
            </td>
            <td class="manage-column">
                <a href="#" data-gdpr-type="<?php echo $field_id ?>" class="button bf_add_gdpr">+</a>
            </td>
        </tr>
        </li></tbody>
    </table>

</div>

