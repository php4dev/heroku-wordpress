<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
function buddyforms_permissions_unregistered_screen()
{
    global  $buddyform, $buddyforms ;
    $form_setup = array();
    if ( !$buddyform ) {
        $buddyform = get_post_meta( get_the_ID(), '_buddyforms_options', true );
    }
    echo  '<h4>' . __( 'Unregistered User', 'buddyforms' ) . '</h4><br>' ;
    $public_submit = ( isset( $buddyform['public_submit'] ) ? $buddyform['public_submit'] : 'public_submit' );
    $form_setup[] = new Element_Radio(
        '<b>' . __( 'Public Submittable', 'buddyforms' ) . '</b>',
        "buddyforms_options[public_submit]",
        array(
        'public_submit'     => __( 'Access for unregistered users.', 'buddyforms' ) . '<br>',
        'registration_form' => sprintf( '%s <br><small>%s</small>', __( 'Logged in users only .', 'buddyforms' ), __( 'Display Login Form For Unregistered Users with optional Link to a Registration Form', 'buddyforms' ) ),
    ),
        array(
        'value' => $public_submit,
        'class' => 'public_submit_select',
    )
    );
    $public_submit_create_account = ( isset( $buddyform['public_submit_create_account'] ) ? $buddyform['public_submit_create_account'] : 'false' );
    $element = new Element_Checkbox(
        '<b>' . __( 'Create an account?', 'buddyforms' ) . '</b>',
        "buddyforms_options[public_submit_create_account]",
        array(
        'public_submit_create_account' => __( 'Create account during submission', 'buddyforms' ),
    ),
        array(
        'value'     => $public_submit_create_account,
        'shortDesc' => __( 'Create a new user during form submission', 'buddyforms' ),
    )
    );
    $element->setAttribute( 'id', 'public_submit_create_account' );
    $element->setAttribute( 'class', 'public-submit-option public_submit_create_account' );
    $form_setup[] = $element;
    //	$all_pages      = buddyforms_get_all_pages('id');
    $all_forms['none'] = __( 'No Registration', 'buddyforms' );
    if ( isset( $buddyforms ) && is_array( $buddyforms ) ) {
        foreach ( $buddyforms as $form_slug => $form ) {
            if ( $form['form_type'] == 'registration' ) {
                $all_forms[$form['slug']] = $form['name'];
            }
        }
    }
    $logged_in_only_reg_form = ( isset( $buddyform['logged_in_only_reg_form'] ) ? $buddyform['logged_in_only_reg_form'] : 'none' );
    $form_setup[] = new Element_Select(
        '<b>' . __( 'Enable Registration on the login form', 'buddyforms' ) . '</b>',
        "buddyforms_options[logged_in_only_reg_form]",
        $all_forms,
        array(
        'value'     => $logged_in_only_reg_form,
        'shortDesc' => __( 'Give your existing customers the choice to login. Just place a login form above or under the form. The Login Form is only visible for logged of user.', 'buddyforms' ),
        'class'     => 'registration-form-option',
    )
    );
    buddyforms_display_field_group_table( $form_setup );
}

function buddyforms_permissions_screen()
{
    global  $post, $buddyform ;
    $form_slug = $post->post_name;
    $form_setup = array();
    if ( !$buddyform ) {
        $buddyform = get_post_meta( get_the_ID(), '_buddyforms_options', true );
    }
    $shortDesc_permission = '<br><br>
		<div class="bf-roles-main-desc">
			<h4>' . __( 'Logged in User', 'buddyforms' ) . '</h4><br>
			<p><b>' . __( 'Get full control with the pro version', 'buddyforms' ) . '</b></p>
			<p>' . __( 'Control who can create, edit and delete content that is created from this form for each user role with the pro version.', 'buddyforms' ) . '</p>
			<p>' . __( 'In the free version all roles can create and edit / delete there own posts', 'buddyforms' ) . '</p>
		</div>';
    $form_action = ( !empty($_REQUEST['action']) ? sanitize_text_field( $_REQUEST['action'] ) : 'create' );
    // User Roles Description
    echo  $shortDesc_permission ;
    $checkbox_style_group_1 = 'margin-left: 5%; float: left;';
    $checkbox_style_group_2 = 'margin-left: 3%; float: left;';
    // Display all user roles
    foreach ( get_editable_roles() as $role_name => $role_info ) {
        $default_roles['create'] = '';
        $default_roles['edit'] = '';
        $default_roles['delete'] = '';
        $default_roles['draft'] = '';
        $default_roles['all'] = '';
        $default_roles['admin-submission'] = '';
        $user_role = get_role( $role_name );
        $form_user_role = array();
        //is free
        
        if ( !buddyforms_core_fs()->is_paying_or_trial() ) {
            foreach ( $default_roles as $role_n_a => $role_a ) {
                if ( $role_n_a !== 'all' || $role_n_a !== 'admin-submission' || $role_n_a !== 'draft' ) {
                    $form_user_role[$role_n_a] = $role_n_a;
                }
            }
        } else {
            //is paying or trial
            
            if ( $form_action === 'create' ) {
                foreach ( $default_roles as $role_n_a => $role_a ) {
                    if ( ('administrator' === $role_name || 'editor' === $role_name) && $role_n_a !== 'all' && $role_n_a !== 'admin-submission' && $role_n_a !== 'draft' ) {
                        $form_user_role[$role_n_a] = $role_n_a;
                    }
                }
            } else {
                //Check existing capabilities
                foreach ( $role_info['capabilities'] as $capability => $_ ) {
                    $capability_array = explode( '_', $capability );
                    if ( $capability_array[0] == 'buddyforms' ) {
                        if ( $capability_array[1] == $form_slug ) {
                            if ( $user_role->has_cap( $capability ) ) {
                                $form_user_role[$capability_array[2]] = $capability_array[2];
                            }
                        }
                    }
                }
            }
        
        }
        
        
        if ( !buddyforms_core_fs()->is_paying_or_trial() ) {
            if ( isset( $form_user_role['all'] ) ) {
                unset( $form_user_role['all'] );
            }
            if ( isset( $form_user_role['admin-submission'] ) ) {
                unset( $form_user_role['admin-submission'] );
            }
            if ( isset( $form_user_role['draft'] ) ) {
                unset( $form_user_role['draft'] );
            }
        }
        
        
        if ( !empty($buddyform) && isset( $buddyform['form_type'] ) && $buddyform['form_type'] === 'contact' ) {
            unset( $form_user_role['edit'] );
            unset( $form_user_role['delete'] );
            unset( $form_user_role['draft'] );
            unset( $form_user_role['admin-submission'] );
        }
        
        $disabled_class = '';
        if ( !buddyforms_core_fs()->is_paying_or_trial() ) {
            $disabled_class = 'disabled';
        }
        $element = new Element_Checkbox(
            '<b>' . $role_name . '</b>',
            'buddyforms_roles[' . $role_name . ']',
            $default_roles,
            array(
            'value'  => $form_user_role,
            'inline' => true,
            'class'  => $role_name . ' ' . $disabled_class,
            'id'     => 'permission_for_' . $role_name,
        )
        );
        if ( $role_name == 'administrator' ) {
            $element->setAttribute( 'shortDesc', __( 'Admin rights can not get changed', 'buddyforms' ) );
        }
        if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
            $element->setAttribute( 'disabled', 'disabled' );
        }
        $form_setup[] = $element;
    }
    ?>
	<div class="fields_header">
		<table class="wp-list-table widefat posts striped bf_permissions">
			<thead>
			<tr>
				<th class="field_label"><?php 
    _e( 'Role', 'buddyforms' );
    ?></th>
				<th class="field_name">
					<?php 
    echo  sprintf( '<span style="%s">%s</span>', $checkbox_style_group_1, __( 'Create', 'buddyforms' ) ) ;
    ?>
					<?php 
    echo  sprintf( '<span style="%s">%s</span>', $checkbox_style_group_2, __( 'Edit', 'buddyforms' ) ) ;
    ?>
					<?php 
    echo  sprintf( '<span style="%s">%s</span>', $checkbox_style_group_2, __( 'Delete', 'buddyforms' ) ) ;
    ?>
					<?php 
    echo  sprintf( '<span style="%s">%s</span>', $checkbox_style_group_2, __( 'Draft', 'buddyforms' ) ) ;
    ?>
					<?php 
    echo  sprintf( '<span style="%s">%s</span>', $checkbox_style_group_2, __( 'All Submissions', 'buddyforms' ) ) ;
    ?>
					<?php 
    echo  sprintf( '<span style="%s">%s</span>', $checkbox_style_group_2, __( 'Admin Submission', 'buddyforms' ) ) ;
    ?>
					<?php 
    
    if ( buddyforms_core_fs()->is_paying_or_trial() ) {
        ?>
						<a style="float: right;" href="#" class="bf_check_all"><?php 
        _e( 'Check all', 'buddyforms' );
        ?></a>
					<?php 
    }
    
    ?>
				</th>
			</tr>
			</thead>
			<tbody id="the-list">
			<?php 
    if ( isset( $form_setup ) ) {
        /**
         * @var int $key
         * @var Element_Checkbox $field
         */
        foreach ( $form_setup as $key => $field ) {
            $type = $field->getAttribute( 'type' );
            $class = $field->getAttribute( 'class' );
            $disabled = $field->getAttribute( 'disabled' );
            $classes = ( empty($class) ? '' : $class . ' ' );
            $classes .= ( empty($disabled) ? '' : 'bf-' . $disabled . ' ' );
            
            if ( $type == 'html' ) {
                echo  '<tr id="table_row_' . $field->getAttribute( 'id' ) . '_' . $key . '" data-target-role="' . $class . '" class="' . $class . '"><td colspan="2">' ;
                $field->render();
                echo  '</td></tr>' ;
            } else {
                ?>
						<tr data-target-role="<?php 
                echo  $class ;
                ?>" id="table_row_<?php 
                echo  $field->getAttribute( 'id' ) ;
                ?>_<?php 
                echo  $key ;
                ?>" class=" <?php 
                echo  $classes ;
                ?>">
							<th scope="row">
								<label for="role_role"><?php 
                echo  $field->getLabel() ;
                ?></label>
							</th>
							<td>
								<?php 
                echo  $field->render() ;
                ?>
								<p class="description"><?php 
                echo  $field->getShortDesc() ;
                ?></p>
							</td>
						</tr>
					<?php 
            }
        
        }
    }
    ?>
			</tbody>
		</table>
	</div>
	<?php 
}

function buddyforms_form_setup_nav_li_permission()
{
    ?>
	<li class="permission_nav"><a class="permission" href="#permission" data-toggle="tab"><?php 
    _e( 'Permission', 'buddyforms' );
    ?></a></li><?php 
}

add_action( 'buddyforms_form_setup_nav_li_last', 'buddyforms_form_setup_nav_li_permission' );
function buddyforms_form_setup_tab_pane_permission()
{
    ?>
	<div class="tab-pane " id="permission">
	<div class="buddyforms_accordion_permission">
		<?php 
    buddyforms_permissions_unregistered_screen();
    ?>
		<?php 
    buddyforms_permissions_screen();
    ?>
	</div>
	</div><?php 
}

add_action( 'buddyforms_form_setup_tab_pane_last', 'buddyforms_form_setup_tab_pane_permission' );