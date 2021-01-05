<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

//Leaven empty tag to let automation add the path disclosure line

$layout = isset( $buddyform['layout']['cords'][ $field_id ] ) ? $buddyform['layout']['cords'][ $field_id ] : '1';
?>
<li id="field_<?php echo $field_id ?>" class="bf_list_item <?php echo $field_id ?> bf_<?php echo sanitize_title( $field_type ) ?>" data-field_id="<?php echo $field_id ?> ">

	<input id="this_field_id_<?php echo esc_attr( $field_id ) ?>" type="hidden" value="<?php echo esc_attr( $field_id ) ?>">

	<div style="display:none;" class="hidden">
		<?php if ( isset( $form_fields['hidden'] ) ) {
			foreach ( $form_fields['hidden'] as $key => $form_field ) {
				$form_field->render();
			}
		} ?>
	</div>

	<div class="accordion_fields">
		<div class="accordion-group">
			<div class="accordion-heading-options">
				<table class="wp-list-table widefat fixed posts tk-editor-field-item-container">
					<tbody>
					<tr>
						<td class="field_order ui-sortable-handle tk-editor-field-item-order">
							<span class="circle">0</span>
						</td>
						<td class="field_label tk-editor-field-item-label">
							<strong>
								<a class="bf_edit_field row-title accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_text" href="#accordion_<?php echo $field_type . '_' . $field_id; ?>" title="Edit this Field" href="javascript:;">
									<?php
									echo $name;
									if ( ! empty( $customfield ) && ! empty( $customfield['required'] ) && $customfield['required'][0] === 'required' ) {
										if ( is_subclass_of( $form_field, 'Base' ) ) {
											$form_field->renderRequired( true );
										}
									} ?></a>
							</strong>
							<div class="field_delete tk-editor-field-item-actions">
								<span>
									<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_text" href="#accordion_<?php echo $field_type . '_' . $field_id; ?>" title="<?php _e( 'Edit this Field', 'buddyforms' ) ?>" href="javascript:;">
										<?php _e( 'Edit', 'buddyforms' ) ?>
									</a>
								</span>
								<span class="tk-editor-field-item-actions-separator"> | </span>
								<span>
									<a style="color: red;" class="bf_delete_field" id="<?php echo $field_id ?>" title="<?php _e( 'Delete this Field', 'buddyforms' ) ?>" href="#">
										<?php _e( 'Delete', 'buddyforms' ) ?>
									</a>
								</span>
							</div>
						</td>
						<td class="field_name tk-editor-field-item-name">
							<div class="tooltip">
								<span class="field_name_text bf-ready-to-copy"><?php echo $field_slug ?></span>
								<span class="tooltip-container"><?php _e( 'Copy to clipboard', 'buddyforms' ) ?></span>
							</div>
						</td>
						<td class="field_type tk-editor-field-item-type"><?php echo $field_type ?></td>
						<td class="field_layout tk-editor-field-item-layout">
							<select class="" name="buddyforms_options[layout][cords][<?php echo $field_id ?>]">
								<option <?php selected( $layout, '1' ); ?> value="1"><?php _e( 'Full Width', 'buddyforms' ) ?></option>
								<option <?php selected( $layout, '2' ); ?> value="2">1/2</option>
								<option <?php selected( $layout, '3' ); ?> value="3">1/3</option>
								<option <?php selected( $layout, '4' ); ?> value="4">1/4</option>
								<option <?php selected( $layout, '5' ); ?> value="5">2/3</option>
								<option <?php selected( $layout, '6' ); ?> value="6">3/4</option>
							</select>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div id="accordion_<?php echo $field_type . '_' . $field_id; ?>" class="accordion-body collapse">
				<div class="accordion-inner">
					<div class="tabs-<?php echo $field_type . '-' . $field_id ?> tabbable buddyform-tabs-left ">
						<ul id="bf_field_group<?php echo $field_type . '-' . $field_id ?>"
						    class="nav buddyform-nav-tabs buddyform-nav-pills">
							<?php
							$i = 0;
							foreach ( $form_fields as $key => $form_field ) {

								if ( $key == 'hidden' ) {
									continue;
								}

								$class_active = '';
								if ( $i == 0 ) {
									$class_active = 'active';
								}

								?>
								<li class="<?php echo $class_active ?>">
									<a href="#<?php echo $key . '-' . $field_type . '-' . $field_id ?>" data-toggle="tab">
										<?php echo str_replace( '-', ' ', ucfirst( $key ) ) ?>
									</a>
								</li>
								<?php
								$i ++;
							}
							?>
						</ul>
						<div id="bf_field_group_content<?php echo $field_type . '-' . $field_id ?>"
						     class="tab-content">
							<?php
							$i = 0;
							foreach ( $form_fields as $key => $form_field ) {

								if ( $key == 'hidden' ) {
									continue;
								}

								$class_active = '';
								if ( $i == 0 ) {
									$class_active = 'active';
								}
								?>
								<div class="tab-pane <?php echo $class_active ?>"
								     id="<?php echo $key . '-' . $field_type . '-' . $field_id ?>">
									<div class="buddyforms_accordion_general">
										<?php buddyforms_display_field_group_table( $form_field, $field_id ) ?>
									</div>
								</div>
								<?php
								$i ++;
							}
							if ( ! is_array( $form_field ) ) {
								_e( 'Please Save the form once for the form element to work.', 'buddyforms' );
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</li>
