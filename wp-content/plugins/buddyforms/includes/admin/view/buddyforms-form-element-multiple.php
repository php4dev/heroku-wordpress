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
            <th colspan="2"><span style="padding-left: 10px;"><?php _e( 'Label', 'buddyforms' ) ?></span></th>
            <th><span style="padding-left: 10px;"><?php _e( 'Value', 'buddyforms' ) ?></span></th>
            <th><span style="padding-left: 10px;"><?php _e( 'Default', 'buddyforms' ) ?></span></th>
            <th class="manage-column column-author"><span style="padding-left: 10px;"><?php _e( 'Action', 'buddyforms' ) ?></span>
            </th>
        </tr>
        </thead>
        <tbody>
		<?php if ( ! empty( $field_options ) ): ?>
			<?php foreach ( $field_options as $key => $option ): ?>
                <tr class="field_item field_item_<?php echo $field_id ?>_<?php echo $count ?>">
                    <td>
                        <div class="dashicons dashicons-image-flip-vertical"></div>
                    </td>
                    <td><?php
						$form_element = new Element_Textbox( '', "buddyforms_options[form_fields][" . $field_id . "][options][" . $key . "][label]", array( 'value' => $option['label'] ) );
						$form_element->render();
						?></td>
                    <td><?php $form_element = new Element_Textbox( '', "buddyforms_options[form_fields][" . $field_id . "][options][" . $key . "][value]", array( 'value' => $option['value'] ) );
						$form_element->render();
						?></td>
                    <td class="manage-column column-author"><?php $form_element = new Element_Radio( '', "buddyforms_options[form_fields][" . $field_id . "][default]", array( $option['value'] ), array( 'value' => $default_option ) );
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

</div>
<a href="<?php echo $field_id ?>" class="button bf_add_input">+</a>

<?php if ( in_array( $field_type, array( 'dropdown', 'radiobutton', 'checkbox' ), true ) ): ?>
    <a href="#" data-group-name="<?php echo esc_attr( $default_option ) ?>" data-field-id="<?php echo esc_attr( $field_id ) ?>" class="button bf_reset_multi_input"><?php _e( 'Reset', 'buddyforms' ) ?></a>
<?php endif; ?>
