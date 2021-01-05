<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//
// Create a array of all available form builder templates
//
function buddyforms_form_builder_register_templates()
{
    // Get the templates form demo.buddyforms.com as json string
    $response = wp_remote_get( 'http://demo.buddyforms.com/templates/wp-json/buddyforms/v1/all/' );
    
    if ( is_wp_error( $response ) || $response['response']['code'] != 200 ) {
        $response = array();
        $response['body'] = buddyforms_default_form_templates_json();
    }
    
    // Decode the json
    $buddyforms = json_decode( $response['body'] );
    if ( !is_object( $buddyforms ) ) {
        return array();
    }
    $sort = array();
    foreach ( $buddyforms as $form_s => $form ) {
        $sort[$form->form_type][$form_s] = $form;
    }
    // Loop all forms from the demo and create the form templates
    foreach ( $sort as $sort_key => $sort_item ) {
        foreach ( $sort_item as $form_slug => $buddyform ) {
            $desc = '';
            foreach ( $buddyform->form_fields as $form_field ) {
                
                if ( empty($desc) ) {
                    $desc .= $form_field->name;
                } else {
                    $desc .= ', ' . $form_field->name;
                }
            
            }
            $buddyforms_templates[$sort_key][$form_slug]['title'] = $buddyform->name;
            $buddyforms_templates[$sort_key][$form_slug]['url'] = 'http://demo.buddyforms.com/' . $form_slug;
            $buddyforms_templates[$sort_key][$form_slug]['desc'] = $desc;
            $buddyforms_templates[$sort_key][$form_slug]['json'] = json_encode( $buddyform );
        }
    }
    $templates = array();
    $templates['post'] = $buddyforms_templates['post'];
    $templates['contact'] = $buddyforms_templates['contact'];
    $templates['registration'] = $buddyforms_templates['registration'];
    return apply_filters( 'buddyforms_form_builder_templates', $templates );
}

function buddyforms_form_builder_template_get_dependencies( $template )
{
    $buddyform = json_decode( $template['json'] );
    $internal_plugin_search_string = 'plugin-install.php?s=%s&tab=search&type=term';
    $dependencies = __( 'None', 'buddyforms' );
    $deps = array();
    if ( !($buddyform->post_type == 'post' || $buddyform->post_type == 'page' || $buddyform->post_type == 'bf_submissions') ) {
        $deps[] = array(
            'name' => __( 'BuddyForms Professional', 'buddyforms' ),
            'url'  => 'https://themekraft.com/buddyforms/',
        );
    }
    if ( isset( $buddyform->form_fields ) ) {
        foreach ( $buddyform->form_fields as $field_key => $field ) {
            if ( $field->slug == 'taxonomy' ) {
                $deps[] = array(
                    'name' => __( 'BuddyForms Professional', 'buddyforms' ),
                    'url'  => 'https://themekraft.com/buddyforms/',
                );
            }
        }
    }
    if ( $buddyform->post_type == 'product' && !post_type_exists( 'product' ) ) {
        $deps[] = array(
            'name' => 'WooCommerce',
            'url'  => admin_url( sprintf( $internal_plugin_search_string, 'WooCommerce' ) ),
        );
    }
    if ( isset( $buddyform->form_fields ) ) {
        foreach ( $buddyform->form_fields as $field_key => $field ) {
            if ( $field->type === 'geo_my_wp_address' ) {
                
                if ( !class_exists( 'buddyforms_geo_my_wp' ) ) {
                    $deps[] = array(
                        'name' => 'GEO my WP',
                        'url'  => admin_url( sprintf( $internal_plugin_search_string, 'GEO my WP' ) ),
                    );
                    $deps[] = array(
                        'name' => 'BuddyForms Geo My WP',
                        'url'  => 'https://themekraft.com/products/buddyforms-geo-my-wp/',
                    );
                }
            
            }
            
            if ( $field->slug == '_woocommerce' ) {
                if ( !class_exists( 'bf_woo_elem' ) ) {
                    $deps[] = array(
                        'name' => 'BuddyForms WooElements',
                        'url'  => 'https://themekraft.com/products/buddyforms-woocommerce-form-elements/',
                    );
                }
                
                if ( $field->product_type_default == 'auction' && !class_exists( 'bf_woo_simple_auction' ) ) {
                    if ( !class_exists( 'WooCommerce_simple_auction' ) ) {
                        $deps[] = array(
                            'name' => 'WC Simple Auctions',
                            'url'  => admin_url( sprintf( $internal_plugin_search_string, 'WC Simple Auctions' ) ),
                        );
                    }
                    if ( !class_exists( 'bf_woo_simple_auction' ) ) {
                        $deps[] = array(
                            'name' => 'BuddyForms Simple Auction',
                            'url'  => 'https://themekraft.com/products/buddyforms-woocommerce-simple-auction/',
                        );
                    }
                }
            
            }
        
        }
    }
    
    if ( !empty($deps) ) {
        $internal_deps = array();
        foreach ( $deps as $dep ) {
            
            if ( !empty($dep['url']) ) {
                $internal_deps[] = sprintf( '<span><a target="_blank" href="%s">%s</a></span>', $dep['url'], $dep['name'] );
            } else {
                $internal_deps[] = sprintf( '<span>%s</span>', $dep['name'] );
            }
        
        }
        if ( !empty($internal_deps) ) {
            $dependencies = join( ', ', $internal_deps );
        }
    }
    
    return $dependencies;
}

/**
 * Template HTML Loop the array of all available form builder templates
 *
 * @param bool $is_wizard
 *
 * @return false|string
 * @since 2.5.0
 *
 */
function buddyforms_form_builder_templates( $is_wizard = false )
{
    $buddyforms_templates = buddyforms_form_builder_register_templates();
    $none_dependency_string = __( 'None', 'buddyforms' );
    ob_start();
    if ( empty($is_wizard) && isset( $_REQUEST['bf_template'] ) ) {
        $is_wizard = true;
    }
    ?>
	<div class="buddyforms_template buddyforms_template_container buddyforms_wizard_types">
		<div id="buddyforms_template_header_container">
			<div id="buddyforms_template_header_container_h3">
				<h3><?php 
    _e( 'Start adding Fields to your Form.', 'buddyforms' );
    ?></h3>
			</div>
			<div id="buddyforms_template_arrow_container">
				<img class="buddyforms_template_arrow" src="<?php 
    echo  BUDDYFORMS_ASSETS . 'images/arrow.png' ;
    ?>">
			</div>
		</div>

		<?php 
    add_thickbox();
    ?>

		<div id="buddyforms_template_list_container">
			<h5><?php 
    _e( 'Choose a Form Template or build a custom Form. If you don\' find the template you need, drop us one <a href="mailto:support@themekraft.com">email to support@themekraft.com</a>.', 'buddyforms' );
    ?></h5>

			<div class="bf-3-tile bf-tile">
				<h4 class="bf-tile-title"><?php 
    _e( 'CUSTOM FORM', 'buddyforms' );
    ?></h4>
				<div class="xbf-col-50 bf-tile-desc-wrap">
					<p class="bf-tile-desc"><?php 
    _e( 'Select the field you want to use to build your form.', 'buddyforms' );
    ?></p>
				</div>
				<div class="bf-tile-preview-wrap"></div>
				<div id="template-custom">
					<div class="bf-tile-desc-wrap"></div>
					<button id="btn-compile-custom" data-type="" class="bf_form_template_custom button button-primary" onclick="">
						<?php 
    _e( 'Start Custom', 'buddyforms' );
    ?>
					</button>
				</div>
			</div>

			<?php 
    foreach ( $buddyforms_templates as $sort_key => $sort_item ) {
        ?>

				<h2><?php 
        echo  strtoupper( $sort_key ) ;
        ?>&nbsp;<?php 
        _e( 'FORMS', 'buddyforms' );
        ?></h2>

				<?php 
        foreach ( $sort_item as $key => $template ) {
            $dependencies = buddyforms_form_builder_template_get_dependencies( $template );
            $disabled = ( $dependencies != $none_dependency_string ? 'disabled' : '' );
            ?>
					<div class="bf-3-tile bf-tile <?php 
            if ( $dependencies != $none_dependency_string ) {
                echo  'disabled ' ;
            }
            ?>">
						<h4 class="bf-tile-title"><?php 
            echo  $template['title'] ;
            ?></h4>
						<div class="xbf-col-50 bf-tile-desc-wrap">
							<p class="bf-tile-desc"><?php 
            echo  wp_trim_words( $template['desc'], 15 ) ;
            ?></p>
						</div>
						<div class="bf-tile-preview-wrap"></div>
						<?php 
            
            if ( $dependencies != $none_dependency_string ) {
                ?>
							<p class="bf-tile-dependencies"><?php 
                _e( 'Dependencies: ', 'buddyforms' );
                echo  $dependencies ;
                ?></p>
						<?php 
            } else {
                ?>
							<button <?php 
                echo  $disabled ;
                ?> id="btn-compile-<?php 
                echo  $key ;
                ?>"
							                                data-type="<?php 
                echo  $sort_key ;
                ?>"
							                                data-template="<?php 
                echo  $key ;
                ?>"
							                                class="bf_wizard_types bf_form_template btn btn-primary btn-50"
							                                onclick="">
								<?php 
                _e( 'Use This Template', 'buddyforms' );
                ?>
							</button>
						<?php 
            }
            
            ?>
						<div id="template-<?php 
            echo  $key ;
            ?>" style="display:none;">
							<div class="bf-tile-desc-wrap">
								<p class="bf-tile-desc"><?php 
            echo  $template['desc'] ;
            ?></p>
								<button <?php 
            echo  $disabled ;
            ?> id="btn-compile-<?php 
            echo  $key ;
            ?>"
								                                data-type="<?php 
            echo  $sort_key ;
            ?>"
								                                data-template="<?php 
            echo  $key ;
            ?>"
								                                class="bf_wizard_types bf_form_template button button-primary"
								                                onclick="">
									<!-- <span class="dashicons dashicons-plus"></span>  -->
									<?php 
            _e( 'Use This Template', 'buddyforms' );
            ?>
								</button>
							</div>
							<iframe id="iframe-<?php 
            echo  $key ;
            ?>" width="100%" height="800px" scrolling="yes"
							        frameborder="0" class="bf-frame"
							        style="background: transparent; height: 639px; height: 75vh; margin: 0 auto; padding: 0 5px; width: calc( 100% - 10px );"></iframe>
						</div>

					</div>
				<?php 
        }
    }
    ?>
		</div>
	</div>

	<?php 
    $tmp = ob_get_clean();
    return $tmp;
}

//
// json string of the form export to generate the Form from template
//
add_action( 'wp_ajax_buddyforms_form_template', 'buddyforms_form_template' );
function buddyforms_form_template()
{
    global  $post, $buddyform ;
    if ( empty($post) ) {
        $post = new stdClass();
    }
    $post->post_type = 'buddyforms';
    $buddyforms_templates = buddyforms_form_builder_register_templates();
    $forms = array();
    foreach ( $buddyforms_templates as $type => $form_temps ) {
        foreach ( $form_temps as $forms_slug => $form ) {
            $forms[$forms_slug] = $form;
        }
    }
    $buddyforms_templates = $forms;
    $target_template = sanitize_text_field( $_POST['template'] );
    $buddyform = $buddyforms_templates[$target_template];
    $buddyform = json_decode( $buddyform['json'], true );
    
    if ( !empty($_POST['title']) ) {
        $post->post_name = sanitize_title( $_POST['title'] );
        $buddyform['slug'] = $post->post_name;
    }
    
    buddyforms_track( 'selected-form-template', array(
        'template' => $target_template,
        'type'     => $buddyform['form_type'],
    ) );
    ob_start();
    buddyforms_metabox_form_elements( $post, $buddyform );
    $formbuilder = ob_get_clean();
    // Add the form elements to the form builder
    $json['formbuilder'] = $formbuilder;
    ob_start();
    ?>
	<div class="hidden bf-hidden"><?php 
    wp_editor( 'dummy', 'dummy' );
    ?></div>

	<?php 
    buddyforms_mail_notification_screen();
    ?>

	<div class="bf_show_if_f_type_post bf_hide_if_post_type_none">
		<?php 
    buddyforms_post_status_mail_notification_screen();
    ?>
	</div>
	<?php 
    $mail_notification = ob_get_clean();
    $json['mail_notification'] = $mail_notification;
    // Unset the form fields
    unset( $buddyform['form_fields'] );
    unset( $buddyform['mail_submissions'] );
    // Add the form setup to the json
    $json['form_setup'] = $buddyform;
    echo  json_encode( $json ) ;
    die;
}

function buddyforms_default_form_templates_json()
{
    return '{"become-a-vendor":{"form_fields":{"a40912e1a5":{"type":"user_login","slug":"user_login","name":"Username","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"82abe39ed2":{"type":"user_email","slug":"user_email","name":"eMail","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"611dc33cb2":{"type":"user_pass","slug":"user_pass","name":"Password","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"636c12a746":{"type":"text","name":"Shop Name","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","slug":"pv_shop_name","custom_class":"","display":"no","hook":""},"dfc114e960":{"type":"text","name":"PayPal E-mail (required)","description":"","required":["required"],"validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","slug":"pv_paypal","custom_class":"","display":"no","hook":""},"df44e14ace":{"type":"textarea","name":"Seller Info","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","slug":"pv_seller_info","custom_class":"","generate_textarea":"","display":"no","hook":""},"fce05b6cd3":{"type":"textarea","name":"Shop description","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","slug":"pv_shop_description","custom_class":"","generate_textarea":"","display":"no","hook":""}},"layout":{"cords":{"a40912e1a5":"1","82abe39ed2":"1","611dc33cb2":"1","636c12a746":"1","dfc114e960":"1","df44e14ace":"1","fce05b6cd3":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"15","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"15","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"Submit","button_width":"blockmobile","button_alignment":"left","button_size":"large","button_class":"","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"registration","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"User Registration Successful! Please check your eMail Inbox and click the activation link to activate your account.","post_type":"bf_submissions","status":"publish","comment_status":"open","singular_name":"","attached_page":"none","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","public_submit":["public_submit"],"public_submit_login":"above","registration":{"activation_page":"home","activation_message_from_subject":"Vendor Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\r\\nGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n<br>\\r\\n<b>Click the link below to activate your account.<\\/b>\\r\\n<br>\\r\\n[activation_link]\\r\\n<br><br>\\r\\n[blog_title]","activation_message_from_name":"Sven Lehnert","activation_message_from_email":"[admin_email]","new_user_role":"vendor"},"hierarchical":{"hierarchical_name":"Children","hierarchical_singular_name":"Child","display_child_posts_on_parent_single":"none"},"profile_visibility":"any","moderation_logic":"default","moderation":{"label_submit":"Submit","label_save":"Save","label_review":"Submit for moderation","label_new_draft":"Create new Draft","label_no_edit":"This Post is waiting for approval and can not be changed until it gets approved"},"name":"Become a Vendor","slug":"become-a-vendor"},"contact-full-name":{"form_fields":{"92f6e0cb6b":{"type":"user_first","slug":"user_first","name":"First Name","description":"","validation_error_message":"This field is required.","custom_class":""},"8ead289ca0":{"type":"user_last","slug":"user_last","name":"Last Name","description":"","validation_error_message":"This field is required.","custom_class":""},"87e0afb2d7":{"type":"user_email","slug":"user_email","name":"Email","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"210ef7d8a8":{"type":"subject","slug":"subject","name":"Subject","description":"","required":["required"],"validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":""},"0a256db3cb":{"type":"message","slug":"message","name":"Message","description":"","required":["required"],"validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":""}},"layout":{"cords":{"92f6e0cb6b":"2","8ead289ca0":"2","87e0afb2d7":"1","210ef7d8a8":"1","0a256db3cb":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":"#81d742"},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"SEND","button_width":"blockmobile","button_alignment":"left","button_size":"xlarge","button_class":"button btn btn-primary","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"contact","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"Your message has been submitted successfully.","post_type":"bf_submissions","status":"publish","comment_status":"open","singular_name":"","attached_page":"none","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","mail_submissions":{"830e6d7716":{"mail_trigger_id":"830e6d7716","mail_from_name":"user_first_last","mail_from_name_custom":"","mail_from":"submitter","mail_from_custom":"","mail_to_address":"","mail_to":["admin"],"mail_to_cc_address":"","mail_to_bcc_address":"","mail_subject":"You Got Mail From Your Contact Form","mail_body":""}},"public_submit":"public_submit","public_submit_login":"none","logged_in_only_reg_form":"none","registration":{"activation_page":"referrer","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\t\\t\\tGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t<b>Click the link below to activate your account.<\\/b>\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t[activation_link]\\r\\n\\t\\t\\t<br><br>\\r\\n\\t\\t\\t[blog_title]\\r\\n\\t\\t","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"hierarchical":{"hierarchical_name":"Children","hierarchical_singular_name":"Child","display_child_posts_on_parent_single":"none"},"profile_visibility":"any","moderation_logic":"default","moderation":{"label_submit":"Submit","label_save":"Save","label_review":"Submit for moderation","label_new_draft":"Create new Draft","label_no_edit":"This Post is waiting for approval and can not be changed until it gets approved"},"remote":["remote"],"name":"Contact Full Name","slug":"contact-full-name"},"simple-contact-form":{"form_fields":{"92f6e0cb6b":{"type":"user_first","slug":"user_first","name":"Your Name","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"87e0afb2d7":{"type":"user_email","slug":"user_email","name":"Your Email","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"0a256db3cb":{"type":"message","slug":"message","name":"Your Message","description":"","required":["required"],"validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"110","custom_class":""}},"layout":{"cords":{"92f6e0cb6b":"1","87e0afb2d7":"1","0a256db3cb":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"SEND","button_width":"blockmobile","button_alignment":"left","button_size":"xlarge","button_class":"button btn btn-primary","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"contact","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"Thanks! Your message is on the way! ","post_type":"bf_submissions","status":"publish","comment_status":"open","singular_name":"","attached_page":"153","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","mail_submissions":{"e8818ef3a1":{"mail_trigger_id":"e8818ef3a1","mail_from_name":"user_first","mail_from_name_custom":"","mail_from":"submitter","mail_from_custom":"","mail_to_address":"","mail_to":["submitter","admin"],"mail_to_cc_address":"","mail_to_bcc_address":"","mail_subject":"Contact Form Submission","mail_body":""}},"public_submit":"public_submit","public_submit_login":"none","logged_in_only_reg_form":"none","registration":{"activation_page":"referrer","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\t\\t\\tGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t<b>Click the link below to activate your account.<\\/b>\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t[activation_link]\\r\\n\\t\\t\\t<br><br>\\r\\n\\t\\t\\t[blog_title]\\r\\n\\t\\t","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"hierarchical":{"hierarchical_name":"Children","hierarchical_singular_name":"Child","display_child_posts_on_parent_single":"none"},"profile_visibility":"any","moderation_logic":"default","moderation":{"label_submit":"Submit","label_save":"Save","label_review":"Submit for moderation","label_new_draft":"Create new Draft","label_no_edit":"This Post is waiting for approval and can not be changed until it gets approved"},"remote":["remote"],"name":"Contact Simple","slug":"simple-contact-form"},"post-form-all-fields":{"form_fields":{"6930e161aa":{"type":"title","slug":"buddyforms_form_title","name":"Title","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"","custom_class":"","generate_title":""},"24da67e1d1":{"type":"content","slug":"buddyforms_form_content","name":"Content","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":"","generate_content":""},"1360c37280":{"type":"category","name":"Categories","description":"","taxonomy":"category","taxonomy_placeholder":"Select an Option","taxonomy_order":"ASC","create_new_tax":["user_can_create_new"],"validation_error_message":"This field is required.","slug":"categories","custom_class":""},"3567df4099":{"type":"tags","name":"Tags","description":"","taxonomy":"post_tag","taxonomy_placeholder":"Select an Option","taxonomy_order":"ASC","create_new_tax":["user_can_create_new"],"validation_error_message":"This field is required.","slug":"tags","custom_class":""},"f6a731c6f7":{"slug":"featured_image","type":"featured_image","name":"Featured Image","button_label":"Add Image","description":""}},"layout":{"cords":{"6930e161aa":"1","24da67e1d1":"1","1360c37280":"1","3567df4099":"1","f6a731c6f7":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"15","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"15","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"Submit","button_width":"blockmobile","button_alignment":"left","button_size":"large","button_class":"","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"post","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"Form Submitted Successfully","post_type":"post","status":"publish","comment_status":"open","singular_name":"","attached_page":"153","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","public_submit":"public_submit","public_submit_login":"above","logged_in_only_reg_form":"none","registration":{"activation_page":"referrer","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\t\\t\\tGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t<b>Click the link below to activate your account.<\\/b>\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t[activation_link]\\r\\n\\t\\t\\t<br><br>\\r\\n\\t\\t\\t[blog_title]\\r\\n\\t\\t","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"hierarchical":{"hierarchical_name":"Children","hierarchical_singular_name":"Child","display_child_posts_on_parent_single":"none"},"profile_visibility":"any","moderation_logic":"default","moderation":{"label_submit":"Submit","label_save":"Save","label_review":"Submit for moderation","label_new_draft":"Create new Draft","label_no_edit":"This Post is waiting for approval and can not be changed until it gets approved"},"remote":["remote"],"name":"Post Form All Fields","slug":"post-form-all-fields"},"simple-post-form":{"form_fields":{"6930e161aa":{"type":"title","slug":"buddyforms_form_title","name":"Title","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"","custom_class":"","generate_title":""},"24da67e1d1":{"type":"content","slug":"buddyforms_form_content","name":"Content","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":"","generate_content":""}},"layout":{"cords":{"6930e161aa":"1","24da67e1d1":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"15","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"15","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"Submit","button_width":"blockmobile","button_alignment":"left","button_size":"large","button_class":"","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"post","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"Form Submitted Successfully","post_type":"post","status":"publish","comment_status":"open","singular_name":"","attached_page":"89","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","public_submit":"public_submit","public_submit_login":"above","public_submit_create_account":[""],"logged_in_only_reg_form":"none","registration":{"generate_password":["yes"],"activation_page":"referrer","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\t\\t\\tGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t<b>Click the link below to activate your account.<\\/b>\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t[activation_link]\\r\\n\\t\\t\\t<br><br>\\r\\n\\t\\t\\t[blog_title]\\r\\n\\t\\t","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"public_submit_username_from_email":["public_submit_username_from_email"],"hierarchical":{"hierarchical_name":"Children","hierarchical_singular_name":"Child","display_child_posts_on_parent_single":"none"},"profile_visibility":"any","moderation_logic":"default","moderation":{"label_submit":"Submit","label_save":"Save","label_review":"Submit for moderation","label_new_draft":"Create new Draft","label_no_edit":"This Post is waiting for approval and can not be changed until it gets approved"},"name":"Post Simple","slug":"simple-post-form"},"registration-full-name":{"form_fields":{"a40912e1a5":{"type":"user_login","slug":"user_login","name":"Username","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"a143e8f885":{"type":"user_first","slug":"user_first","name":"First Name","description":"","validation_error_message":"This field is required.","custom_class":""},"15821e9ed8":{"type":"user_last","slug":"user_last","name":"Last Name","description":"","validation_error_message":"This field is required.","custom_class":""},"82abe39ed2":{"type":"user_email","slug":"user_email","name":"eMail","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"611dc33cb2":{"type":"user_pass","slug":"user_pass","name":"Password","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""}},"layout":{"cords":{"a40912e1a5":"1","a143e8f885":"3","15821e9ed8":"3","82abe39ed2":"3","611dc33cb2":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"15","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"15","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"Submit","button_width":"blockmobile","button_alignment":"left","button_size":"large","button_class":"","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"registration","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"User Registration Successful! Please check your eMail Inbox and click the activation link to activate your account.","post_type":"bf_submissions","status":"publish","comment_status":"open","singular_name":"","attached_page":"none","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","public_submit":["public_submit"],"public_submit_login":"above","registration":{"activation_page":"none","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\r\\nGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n<br>\\r\\n<b>Click the link below to activate your account.<\\/b>\\r\\n<br>\\r\\n[activation_link]\\r\\n<br><br>\\r\\n[blog_title]","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"hierarchical":{"hierarchical_name":"Children","hierarchical_singular_name":"Child","display_child_posts_on_parent_single":"none"},"profile_visibility":"any","moderation_logic":"default","moderation":{"label_submit":"Submit","label_save":"Save","label_review":"Submit for moderation","label_new_draft":"Create new Draft","label_no_edit":"This Post is waiting for approval and can not be changed until it gets approved"},"name":"Registration Full Name","slug":"registration-full-name"},"registration-profile":{"form_fields":{"a40912e1a5":{"type":"user_login","slug":"user_login","name":"Username","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"9674ece814":{"type":"user_first","slug":"user_first","name":"First Name","description":"","validation_error_message":"This field is required.","custom_class":""},"ba773278a2":{"type":"user_last","slug":"user_last","name":"Last Name","description":"","validation_error_message":"This field is required.","custom_class":""},"f2aa3973d5":{"type":"user_bio","slug":"user_bio","name":"Bio","description":"","validation_error_message":"This field is required.","custom_class":""},"fe289c9548":{"type":"user_website","slug":"website","name":"Website","description":"","validation_error_message":"This field is required.","custom_class":"","display":"no","hook":""},"82abe39ed2":{"type":"user_email","slug":"user_email","name":"eMail","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"611dc33cb2":{"type":"user_pass","slug":"user_pass","name":"Password","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""}},"layout":{"cords":{"a40912e1a5":"1","9674ece814":"1","ba773278a2":"1","f2aa3973d5":"1","fe289c9548":"1","82abe39ed2":"1","611dc33cb2":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"15","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"15","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"Submit","button_width":"blockmobile","button_alignment":"left","button_size":"large","button_class":"","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"registration","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"User Registration Successful! Please check your eMail Inbox and click the activation link to activate your account.","post_type":"bf_submissions","status":"publish","comment_status":"open","singular_name":"","attached_page":"none","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","public_submit":["public_submit"],"public_submit_login":"above","registration":{"activation_page":"home","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\r\\nGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n<br>\\r\\n<b>Click the link below to activate your account.<\\/b>\\r\\n<br>\\r\\n[activation_link]\\r\\n<br><br>\\r\\n[blog_title]","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"hierarchical":{"hierarchical_name":"Children","hierarchical_singular_name":"Child","display_child_posts_on_parent_single":"none"},"profile_visibility":"any","moderation_logic":"default","moderation":{"label_submit":"Submit","label_save":"Save","label_review":"Submit for moderation","label_new_draft":"Create new Draft","label_no_edit":"This Post is waiting for approval and can not be changed until it gets approved"},"name":"Registration Profile","slug":"registration-profile"},"simple-registration-form":{"form_fields":{"a40912e1a5":{"type":"user_login","slug":"user_login","name":"Username","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"82abe39ed2":{"type":"user_email","slug":"user_email","name":"eMail","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"611dc33cb2":{"type":"user_pass","slug":"user_pass","name":"Password","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""}},"layout":{"cords":{"a40912e1a5":"1","82abe39ed2":"1","611dc33cb2":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"15","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"15","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"Submit","button_width":"blockmobile","button_alignment":"left","button_size":"large","button_class":"","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"registration","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"User Registration Successful! Please check your eMail Inbox and click the activation link to activate your account.","post_type":"bf_submissions","status":"publish","comment_status":"open","singular_name":"","attached_page":"none","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","public_submit":["public_submit"],"public_submit_login":"above","registration":{"activation_page":"home","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\r\\nGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n<br>\\r\\n<b>Click the link below to activate your account.<\\/b>\\r\\n<br>\\r\\n[activation_link]\\r\\n<br><br>\\r\\n[blog_title]","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"hierarchical":{"hierarchical_name":"Children","hierarchical_singular_name":"Child","display_child_posts_on_parent_single":"none"},"profile_visibility":"any","moderation_logic":"default","moderation":{"label_submit":"Submit","label_save":"Save","label_review":"Submit for moderation","label_new_draft":"Create new Draft","label_no_edit":"This Post is waiting for approval and can not be changed until it gets approved"},"name":"Registration Simple","slug":"simple-registration-form"},"seminar-form":{"form_fields":{"92f6e0cb6b":{"type":"user_first","slug":"user_first","name":"First Name","description":"","validation_error_message":"This field is required.","custom_class":""},"8ead289ca0":{"type":"user_last","slug":"user_last","name":"Last Name","description":"","validation_error_message":"This field is required.","custom_class":""},"87e0afb2d7":{"type":"user_email","slug":"user_email","name":"Email","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"f324cffad1":{"type":"phone","slug":"phone","name":"Telephone Number","description":"Please add your phone number so we can contact you.","validation_error_message":"This field is required.","custom_class":""},"2c9388bb43":{"type":"user_website","slug":"website","name":"Website","description":"","validation_error_message":"This field is required.","custom_class":"","display":"no","hook":""},"210ef7d8a8":{"type":"subject","slug":"subject","name":"Subject","description":"","required":["required"],"validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":""},"0a256db3cb":{"type":"message","slug":"message","name":"Message","description":"","required":["required"],"validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":""}},"layout":{"cords":{"92f6e0cb6b":"2","8ead289ca0":"2","87e0afb2d7":"1","f324cffad1":"1","2c9388bb43":"1","210ef7d8a8":"1","0a256db3cb":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"color","color":"#000000"},"label_font_style":"normal","desc_position":"below_field","desc_font_size":"","desc_font_color":{"style":"color","color":"#adadad"},"desc_font_style":"italic","field_padding":"3","field_background_color":{"style":"color","color":"#abd4d8"},"field_border_color":{"style":"color","color":"#0f6dbf"},"field_border_width":"1","field_border_radius":"3","field_font_size":"","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"color","color":"#0c0c0c"},"field_active_background_color":{"style":"color","color":"#f2f2f2"},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"SUBMIT ","button_width":"blockmobile","button_alignment":"center","button_size":"xlarge","button_class":"button btn btn-primary","button_border_radius":"3","button_border_width":"1","button_background_color":{"style":"color","color":"#ef9c1f"},"button_font_color":{"style":"color","color":""},"button_border_color":{"style":"color","color":"#f45100"},"button_background_color_hover":{"style":"color","color":"#e8b55f"},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"contact","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"Your message has been submitted successfully.","post_type":"bf_submissions","status":"publish","comment_status":"open","singular_name":"","attached_page":"none","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","mail_submissions":{"830e6d7716":{"mail_trigger_id":"830e6d7716","mail_from_name":"user_first_last","mail_from_name_custom":"","mail_from":"submitter","mail_from_custom":"","mail_to_address":"","mail_to":["admin"],"mail_to_cc_address":"","mail_to_bcc_address":"","mail_subject":"You Got Mail From Your Contact Form","mail_body":""}},"public_submit":"public_submit","public_submit_login":"none","logged_in_only_reg_form":"none","registration":{"activation_page":"referrer","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\t\\t\\tGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t<b>Click the link below to activate your account.<\\/b>\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t[activation_link]\\r\\n\\t\\t\\t<br><br>\\r\\n\\t\\t\\t[blog_title]\\r\\n\\t\\t","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"hierarchical":{"hierarchical_name":"Children","hierarchical_singular_name":"Child","display_child_posts_on_parent_single":"none"},"profile_visibility":"any","moderation_logic":"default","moderation":{"label_submit":"Submit","label_save":"Save","label_review":"Submit for moderation","label_new_draft":"Create new Draft","label_no_edit":"This Post is waiting for approval and can not be changed until it gets approved"},"remote":["remote"],"name":"Seminar Form","slug":"seminar-form"},"user-support":{"form_fields":{"92f6e0cb6b":{"type":"user_first","slug":"user_first","name":"First Name","description":"","validation_error_message":"This field is required.","custom_class":""},"8ead289ca0":{"type":"user_last","slug":"user_last","name":"Last Name","description":"","validation_error_message":"This field is required.","custom_class":""},"2910663d7e":{"type":"dropdown","name":"Support Type","description":"Please Select the Kind of Support you are looking for","options":{"1":{"label":"Help Me","value":"Help"},"2":{"label":"Presell Question","value":"Presell Question"},"3":{"label":"Refund Request","value":"Refund Request"}},"validation_error_message":"This field is required.","slug":"support-type","custom_class":"","display":"no","hook":""},"210ef7d8a8":{"type":"subject","slug":"subject","name":"Subject","description":"","required":["required"],"validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":""},"87e0afb2d7":{"type":"user_email","slug":"user_email","name":"Email","description":"","required":["required"],"validation_error_message":"This field is required.","custom_class":""},"0a256db3cb":{"type":"message","slug":"message","name":"Message","description":"","required":["required"],"validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":""}},"layout":{"cords":{"92f6e0cb6b":"2","8ead289ca0":"2","2910663d7e":"1","210ef7d8a8":"1","87e0afb2d7":"1","0a256db3cb":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"SEND","button_width":"blockmobile","button_alignment":"left","button_size":"xlarge","button_class":"button btn btn-primary","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"contact","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"Your message has been submitted successfully.","post_type":"bf_submissions","status":"publish","comment_status":"open","singular_name":"","attached_page":"none","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","mail_submissions":{"830e6d7716":{"mail_trigger_id":"830e6d7716","mail_from_name":"user_first_last","mail_from_name_custom":"","mail_from":"submitter","mail_from_custom":"","mail_to_address":"","mail_to":["admin"],"mail_to_cc_address":"","mail_to_bcc_address":"","mail_subject":"You Got Mail From Your Contact Form","mail_body":""}},"public_submit":"public_submit","public_submit_login":"above","logged_in_only_reg_form":"none","registration":{"activation_page":"referrer","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\t\\t\\tGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t<b>Click the link below to activate your account.<\\/b>\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t[activation_link]\\r\\n\\t\\t\\t<br><br>\\r\\n\\t\\t\\t[blog_title]\\r\\n\\t\\t","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"hierarchical":{"hierarchical_name":"Children","hierarchical_singular_name":"Child","display_child_posts_on_parent_single":"none"},"profile_visibility":"any","moderation_logic":"default","moderation":{"label_submit":"Submit","label_save":"Save","label_review":"Submit for moderation","label_new_draft":"Create new Draft","label_no_edit":"This Post is waiting for approval and can not be changed until it gets approved"},"name":"User Support","slug":"user-support"},"wc-grouped-product":{"form_fields":{"8f01be94a6":{"type":"title","slug":"buddyforms_form_title","name":"Title","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"","custom_class":"","generate_title":""},"56e497c021":{"type":"content","slug":"buddyforms_form_content","name":"Content","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":"","generate_content":""},"3b8bd90f1d":{"name":"WooCommerce","slug":"_woocommerce","type":"woocommerce","product_type_hidden":["hidden"],"product_type_default":"grouped","product_sales_price":"hidden","product_sales_price_dates":"hidden","product_sku":"none","product_manage_stock_qty":"","product_allow_backorders":"no","product_stock_status":"instock","product_sold_individually":"yes","product_shipping_hidden_weight":"","product_shipping_hidden_dimension_length":"","product_shipping_hidden_dimension_width":"","product_shipping_hidden_dimension_height":"","product_shipping_hidden_shipping_class":"-1","purchase_notes":"","menu_order":"0","enable_review_orders":"yes","_auction_item_condition":"display","_auction_type":"display","_auction_proxy":"display","_auction_start_price":"none","_auction_bid_increment":"none","_auction_reserved_price":"none","_regular_price":"none","auction_dates_from":["required"],"auction_dates_to":["required"]},"25f5c2fa53":{"type":"product-gallery","name":"Product Gallery","description":"","validation_error_message":"This field is required.","slug":"product-gallery","custom_class":""},"9c89c15480":{"slug":"featured_image","type":"featured_image","name":"FeaturedImage","description":""}},"layout":{"cords":{"8f01be94a6":"1","56e497c021":"1","3b8bd90f1d":"1","25f5c2fa53":"1","9c89c15480":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"15","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"15","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"Submit","button_width":"blockmobile","button_alignment":"left","button_size":"large","button_class":"","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"post","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"Form Submitted Successfully","post_type":"product","status":"publish","comment_status":"open","singular_name":"","attached_page":"127","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","public_submit_login":"above","registration":{"activation_page":"none","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\t\\t\\tGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t<b>Click the link below to activate your account.<\\/b>\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t[activation_link]\\r\\n\\t\\t\\t<br><br>\\r\\n\\t\\t\\t[blog_title]\\r\\n\\t\\t","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"name":"WC Grouped Product","slug":"wc-grouped-product"},"wc-product-all-fields":{"form_type":"post","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"Form Submitted Successfully","post_type":"product","status":"publish","comment_status":"open","singular_name":"","attached_page":"127","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","public_submit_login":"above","registration":{"activation_page":"none","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\t\\t\\tGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t<b>Click the link below to activate your account.<\\/b>\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t[activation_link]\\r\\n\\t\\t\\t<br><br>\\r\\n\\t\\t\\t[blog_title]\\r\\n\\t\\t","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"layout":{"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"15","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"15","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"Submit","button_width":"blockmobile","button_alignment":"left","button_size":"large","button_class":"","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":"","cords":{"8f01be94a6":"1","56e497c021":"1","3b8bd90f1d":"1","25f5c2fa53":"1","9c89c15480":"1"}},"form_fields":{"8f01be94a6":{"type":"title","slug":"buddyforms_form_title","name":"Title","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"","custom_class":"","generate_title":""},"56e497c021":{"type":"content","slug":"buddyforms_form_content","name":"Content","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":"","generate_content":""},"3b8bd90f1d":{"name":"WooCommerce","slug":"_woocommerce","type":"woocommerce","product_type_default":"simple","product_sales_price":"hidden","product_sales_price_dates":"hidden","product_sku":"none","product_manage_stock_qty":"","product_allow_backorders":"no","product_stock_status":"instock","product_sold_individually":"yes","product_shipping_hidden_weight":"","product_shipping_hidden_dimension_length":"","product_shipping_hidden_dimension_width":"","product_shipping_hidden_dimension_height":"","product_shipping_hidden_shipping_class":"-1","purchase_notes":"","menu_order":"0","enable_review_orders":"yes","_auction_item_condition":"display","_auction_type":"display","_auction_proxy":"display","_auction_start_price":"none","_auction_bid_increment":"none","_auction_reserved_price":"none","_regular_price":"none","auction_dates_from":["required"],"auction_dates_to":["required"]},"25f5c2fa53":{"type":"product-gallery","name":"Product Gallery","description":"","validation_error_message":"This field is required.","slug":"product-gallery","custom_class":""},"9c89c15480":{"slug":"featured_image","type":"featured_image","name":"FeaturedImage","description":""}},"name":"WC Product All Fields","slug":"wc-product-all-fields"},"simple-auction":{"form_fields":{"891c6e1fbd":{"type":"title","slug":"buddyforms_form_title","name":"Title","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"","custom_class":"","generate_title":""},"7c202f5ad3":{"type":"content","slug":"buddyforms_form_content","name":"Content","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":"","generate_content":""},"9716540c31":{"name":"WooCommerce","slug":"_woocommerce","type":"woocommerce","product_type_hidden":["hidden"],"product_type_default":"auction","product_sales_price":"hidden","product_sales_price_dates":"hidden","product_sku":"none","product_manage_stock_qty":"","product_allow_backorders":"no","product_stock_status":"instock","product_sold_individually":"yes","product_shipping_hidden_weight":"","product_shipping_hidden_dimension_length":"","product_shipping_hidden_dimension_width":"","product_shipping_hidden_dimension_height":"","product_shipping_hidden_shipping_class":"-1","product_up_sales":["hidden"],"product_cross_sales":["hidden"],"product_grouping":["hidden"],"attributes_hide_tab":["hidden"],"variations_hide_tab":["hidden"],"hide_purchase_notes":["hidden"],"purchase_notes":" ","hide_menu_order":["hidden"],"menu_order":"0","hide_enable_review_orders":["hidden"],"enable_review_orders":"yes","_auction_item_condition":"display","_auction_type":"display","_auction_proxy":"display","_auction_start_price":"none","_auction_bid_increment":"none","_auction_reserved_price":"none","_regular_price":"none","auction_dates_from":["required"],"auction_dates_to":["required"]},"bdfb5fefe2":{"type":"product-gallery","name":"Product Gallery","description":"","validation_error_message":"This field is required.","slug":"product-gallery","custom_class":""},"f98885a27a":{"slug":"featured_image","type":"featured_image","name":"FeaturedImage","description":""}},"layout":{"cords":{"891c6e1fbd":"1","7c202f5ad3":"1","9716540c31":"1","bdfb5fefe2":"1","f98885a27a":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"15","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"15","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"Submit","button_width":"blockmobile","button_alignment":"left","button_size":"large","button_class":"","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"post","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"Form Submitted Successfully","post_type":"product","status":"publish","comment_status":"open","singular_name":"","attached_page":"127","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","public_submit_login":"above","registration":{"activation_page":"none","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\t\\t\\tGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t<b>Click the link below to activate your account.<\\/b>\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t[activation_link]\\r\\n\\t\\t\\t<br><br>\\r\\n\\t\\t\\t[blog_title]\\r\\n\\t\\t","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"name":"WC Simple Auction","slug":"simple-auction"},"wc-simple-product":{"form_fields":{"8f01be94a6":{"type":"title","slug":"buddyforms_form_title","name":"Title","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"","custom_class":"","generate_title":""},"56e497c021":{"type":"content","slug":"buddyforms_form_content","name":"Content","description":"","validation_error_message":"This field is required.","validation_minlength":"0","validation_maxlength":"0","custom_class":"","generate_content":""},"3b8bd90f1d":{"name":"WooCommerce","slug":"_woocommerce","type":"woocommerce","product_type_hidden":["hidden"],"product_type_default":"simple","product_sales_price":"hidden","product_sales_price_dates":"hidden","product_sku":"none","product_manage_stock_qty":"","product_allow_backorders":"no","product_stock_status":"instock","product_sold_individually":"yes","product_shipping_hidden_weight":"","product_shipping_hidden_dimension_length":"","product_shipping_hidden_dimension_width":"","product_shipping_hidden_dimension_height":"","product_shipping_hidden_shipping_class":"-1","purchase_notes":"","menu_order":"0","enable_review_orders":"yes","_auction_item_condition":"display","_auction_type":"display","_auction_proxy":"display","_auction_start_price":"none","_auction_bid_increment":"none","_auction_reserved_price":"none","_regular_price":"none","auction_dates_from":["required"],"auction_dates_to":["required"]},"25f5c2fa53":{"type":"product-gallery","name":"Product Gallery","description":"","validation_error_message":"This field is required.","slug":"product-gallery","custom_class":""},"9c89c15480":{"slug":"featured_image","type":"featured_image","name":"FeaturedImage","description":""}},"layout":{"cords":{"8f01be94a6":"1","56e497c021":"1","3b8bd90f1d":"1","25f5c2fa53":"1","9c89c15480":"1"},"labels_layout":"inline","label_font_size":"","label_font_color":{"style":"auto","color":""},"label_font_style":"bold","desc_font_size":"","desc_font_color":{"color":""},"field_padding":"15","field_background_color":{"style":"auto","color":""},"field_border_color":{"style":"auto","color":""},"field_border_width":"","field_border_radius":"","field_font_size":"15","field_font_color":{"style":"auto","color":""},"field_placeholder_font_color":{"style":"auto","color":""},"field_active_background_color":{"style":"auto","color":""},"field_active_border_color":{"style":"auto","color":""},"field_active_font_color":{"style":"auto","color":""},"submit_text":"Submit","button_width":"blockmobile","button_alignment":"left","button_size":"large","button_class":"","button_border_radius":"","button_border_width":"","button_background_color":{"style":"auto","color":""},"button_font_color":{"style":"auto","color":""},"button_border_color":{"style":"auto","color":""},"button_background_color_hover":{"style":"auto","color":""},"button_font_color_hover":{"style":"auto","color":""},"button_border_color_hover":{"style":"auto","color":""},"custom_css":""},"form_type":"post","after_submit":"display_message","after_submission_page":"none","after_submission_url":"","after_submit_message_text":"Form Submitted Successfully","post_type":"product","status":"publish","comment_status":"open","singular_name":"","attached_page":"127","edit_link":"all","list_posts_option":"list_all_form","list_posts_style":"list","public_submit_login":"above","registration":{"activation_page":"none","activation_message_from_subject":"User Account Activation Mail","activation_message_text":"Hi [user_login],\\r\\n\\t\\t\\tGreat to see you come on board! Just one small step left to make your registration complete.\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t<b>Click the link below to activate your account.<\\/b>\\r\\n\\t\\t\\t<br>\\r\\n\\t\\t\\t[activation_link]\\r\\n\\t\\t\\t<br><br>\\r\\n\\t\\t\\t[blog_title]\\r\\n\\t\\t","activation_message_from_name":"[blog_title]","activation_message_from_email":"[admin_email]","new_user_role":"subscriber"},"name":"WC Simple Product","slug":"wc-simple-product"}}';
}
