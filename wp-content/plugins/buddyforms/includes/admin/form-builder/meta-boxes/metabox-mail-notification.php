<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

function buddyforms_mail_notification_screen() {
	global $post, $buddyform;

	if ( ! $buddyform ) {
		$buddyform = get_post_meta( $post->ID, '_buddyforms_options', true );
	}
	$form_setup = array();

	//$form_setup[] = new Element_HTML( '<a class="button-primary btn btn-primary" href="#" id="mail_notification_add_new">' . __( 'Create New Mail Notification', 'buddyforms' ) . '</a>' );
	$form_slug    = ! empty( $buddyform ) && ! empty( $buddyform['slug'] ) ? $buddyform['slug'] : '';
	$form_setup[] = new Element_HTML( '<h4>' . __( 'Mail Notifications', 'buddyforms' ) . '</h4>
		<p>' . __( 'By default no notification is sent out. Any submission get stored under Submissions. This makes sure you never lose any submission. Of course you can create individual mail notification for the submitter, inform your moderators or sent out a notification to any email address.', 'buddyforms' ) . '</p>
		<a class="button-primary btn btn-primary" href="#" id="mail_notification_add_new" data-form-slug="' . $form_slug . '">' . __( 'Create New Mail Notification', 'buddyforms' ) . '</a><br><br><br>' );

	buddyforms_display_field_group_table( $form_setup );

	echo '<ul>';
	if ( isset( $buddyform['mail_submissions'] ) && ! empty( $buddyform ) && ! empty( $buddyform['slug'] ) ) {
		foreach ( $buddyform['mail_submissions'] as $key => $mail_submission ) {
			buddyforms_mail_notification_form( $key, $buddyform['slug'] );
		}
	} else {
		echo '<div id="no-trigger-mailcontainer">' . __( 'No Mail Notification Trigger so far.' ) . '</div>';
	}
	echo '<div id="mailcontainer"></div>';
	echo '</ul>';
	echo '<hr>';
}

function buddyforms_post_status_mail_notification_screen() {
	global $post, $buddyform;

	if ( ! $buddyform ) {
		$buddyform = get_post_meta( $post->ID, '_buddyforms_options', true );
	}

	$form_setup = array();
	$form_slug  = ! empty( $buddyform ) && ! empty( $buddyform['slug'] ) ? $buddyform['slug'] : '';
	$shortDesc  = '<a class="button-primary btn btn-primary" href="#" id="post_status_mail_notification_add_new" style="font-style: normal" data-form-slug="' . $form_slug . '">' . __( 'Create New Mail Notification', 'buddyforms' ) . '</a>';
	if ( buddyforms_core_fs()->is_not_paying() && ! buddyforms_core_fs()->is_trial() ) {
		$shortDesc = '<b>' . __( 'Get the Pro version to add Post Status Change Mail Notification', 'buddyforms' ) . '</b>';
	}

	$element = new Element_Select( '<h4>' . __( "Post Status Change Mail Notifications", 'buddyforms' ) . '</h4><p>' . __( 'Forms can send different email notifications triggered by post status changes. For example, automatically notify post authors when their post is published! ', 'buddyforms' ) . '</p>', "buddyforms_notification_trigger", buddyforms_get_post_status_array(), array(
		'class'     => 'post_status_mail_notification_trigger',
		'shortDesc' => $shortDesc,
	) );
	if ( buddyforms_core_fs()->is_not_paying() && ! buddyforms_core_fs()->is_trial() ) {
		$element->setAttribute( 'disabled', 'disabled' );
	}
	$form_setup[] = $element;
	buddyforms_display_field_group_table( $form_setup );
	echo '<ul>';
	if ( isset( $buddyform['mail_notification'] ) && ! empty( $buddyform ) && ! empty( $buddyform['slug'] ) ) {
		foreach ( $buddyform['mail_notification'] as $key => $value ) {
			buddyforms_new_post_status_mail_notification_form( $buddyform['mail_notification'][ $key ]['mail_trigger'], $buddyform['slug'] );
		}
	} else {
		echo '<div id="no-trigger-post-status-mail-container">' . __( 'No Post Status Mail Notification Trigger so far.' ) . '</div>';
	}
	echo '<div id="post-status-mail-container"></div>';
	echo '</ul>';
	echo '<hr>';

}

/**
 * @param bool $trigger
 *
 * @param $form_slug
 *
 * @return string
 */
function buddyforms_mail_notification_form( $trigger = false, $form_slug = '' ) {
	global $buddyform;

	if ( $trigger == false ) {
		$trigger = substr( md5( time() * rand() ), 0, 10 );
	}

	$is_edit_action = ( ! empty( $_REQUEST['action'] ) && $_REQUEST['action'] === 'edit' );

	$all_shortcodes       = array();
	$element_name         = 'buddyforms_options[mail_submissions][' . $trigger . '][mail_body]';
	$available_shortcodes = buddyforms_available_shortcodes( $buddyform['slug'], $element_name );
	if ( ! empty( $buddyform['form_fields'] ) ) {
		foreach ( $buddyform['form_fields'] as $form_field ) {
			if ( ! in_array( $form_field['type'], buddyforms_unauthorized_shortcodes_field_type( $buddyform['slug'], $element_name ) ) ) {
				$all_shortcodes[] = '[' . $form_field['slug'] . ']';
			}
		}
	}

	$all_shortcodes  = array_merge( $all_shortcodes, $available_shortcodes );
	$shortcodes_html = buddyforms_get_shortcode_string( $all_shortcodes, $element_name );

	$shortDesc = sprintf( "<br><p class='description'><strong>%s</strong></p>%s", __( 'Click on one of the available shortcodes to insert on the above element at caret position:', 'buddyforms' ), $shortcodes_html );

	$form_setup[] = new Element_Hidden( "buddyforms_options[mail_submissions][" . $trigger . "][mail_trigger_id]", $trigger, array( 'class' => 'trigger' . $trigger ) );

	$test_button  = sprintf( '<button class="button-primary btn btn-primary bf_test_trigger" id="%s" title="%s" data-form-slug="%s">%s</button><p class="description">%s</p>',
		$trigger, __( 'Test this Notification', 'buddyforms' ), $form_slug, __( 'Test', 'buddyforms' ),
		__( 'This test Email will be sent using the Site Admin Email and the exiting Subject and Body.', 'buddyforms' ) );
	$form_setup[] = new Element_HTML( $test_button );

	// From Name
	$element      = new Element_Radio( '<b>' . __( 'From Name', 'buddyforms' ) . '</b>', "buddyforms_options[mail_submissions][" . $trigger . "][mail_from_name]", array(
		'user_login'      => __( 'Username', 'buddyforms' ),
		'user_first'      => __( 'First Name', 'buddyforms' ),
		'user_last'       => __( 'Last Name', 'buddyforms' ),
		'user_first_last' => __( 'First and Last Name', 'buddyforms' ),
		'blog_title'      => __( 'Blog Title', 'buddyforms' ),
		'custom'          => __( 'Custom', 'buddyforms' )
	), array(
		'value' => isset( $buddyform['mail_submissions'][ $trigger ]['mail_from_name'] ) ? $buddyform['mail_submissions'][ $trigger ]['mail_from_name'] : 'blog_title',
		'class' => 'mail_from_checkbox bf_mail_from_name_multi_checkbox',
	) );
	$form_setup[] = $element;

	$mail_to_cc   = isset( $buddyform['mail_submissions'][ $trigger ]['mail_from_name'] ) && $buddyform['mail_submissions'][ $trigger ]['mail_from_name'] == 'custom' ? '' : 'hidden';
	$form_setup[] = new Element_Textbox( '<b>' . __( "Custom Mail From Name", 'buddyforms' ) . '</b>', "buddyforms_options[mail_submissions][" . $trigger . "][mail_from_name_custom]", array(
		"class"     => 'mail_from_name_custom ' . $mail_to_cc,
		'value'     => isset( $buddyform['mail_submissions'][ $trigger ]['mail_from_name_custom'] ) ? BuddyFormsEncoding::toUTF8( $buddyform['mail_submissions'][ $trigger ]['mail_from_name_custom'] ) : '',
		'shortDesc' => __( 'The senders name e.g. John Doe or use any form element slug as shortcode [field_slug]', 'buddyforms' )
	) );


	// From email
	$element      = new Element_Radio( '<b>' . __( 'From email', 'buddyforms' ) . '</b>', "buddyforms_options[mail_submissions][" . $trigger . "][mail_from]", array(
		'submitter' => __( 'Submitter - User email Field', 'buddyforms' ),
		'admin'     => __( 'Admin - email from WP General Settings', 'buddyforms' ),
		'custom'    => __( 'Custom', 'buddyforms' )
	), array(
		'value' => isset( $buddyform['mail_submissions'][ $trigger ]['mail_from'] ) ? $buddyform['mail_submissions'][ $trigger ]['mail_from'] : 'submitter',
		'class' => 'mail_from_checkbox bf_mail_from_multi_checkbox'
	) );
	$form_setup[] = $element;

	$mail_to_cc   = isset( $buddyform['mail_submissions'][ $trigger ]['mail_from'] ) && $buddyform['mail_submissions'][ $trigger ]['mail_from'] == 'custom' ? '' : 'hidden';
	$form_setup[] = new Element_Textbox( '<b>' . __( "Custom Mail From Address", 'buddyforms' ) . '</b>', "buddyforms_options[mail_submissions][" . $trigger . "][mail_from_custom]", array(
		"class"     => 'mail_from_custom ' . $mail_to_cc,
		'value'     => isset( $buddyform['mail_submissions'][ $trigger ]['mail_from_custom'] ) ? BuddyFormsEncoding::toUTF8( $buddyform['mail_submissions'][ $trigger ]['mail_from_custom'] ) : '',
		'shortDesc' => __( 'You can use any form element slug as shortcode [field_slug]', 'buddyforms' )
	) );

	$default_mail_to   = $is_edit_action ? '' : 'admin';
	$mail_to           = isset( $buddyform['mail_submissions'][ $trigger ]['mail_to'] ) ? $buddyform['mail_submissions'][ $trigger ]['mail_to'] : $default_mail_to;
	$send_mail_to_opts = array(
		'submitter' => __( 'Submitter - User email Field', 'buddyforms' ),
		'admin'     => __( 'Admin - email from WP General Settings', 'buddyforms' ),
		'cc'        => __( 'CC', 'buddyforms' ),
		'bcc'       => __( 'BCC', 'buddyforms' ),
	);

	$send_mail_to_opts = apply_filters( 'buddyforms_notifications_send_mail_to_options', $send_mail_to_opts, $trigger, $form_slug );
	$element           = new Element_Checkbox( '<b>' . __( 'Send mail to', 'buddyforms' ) . '</b>', "buddyforms_options[mail_submissions][" . $trigger . "][mail_to]", $send_mail_to_opts, array(
		'value' => $mail_to,
		'id'    => 'mail_submissions' . $trigger,
		'class' => 'mail_to_checkbox bf_sent_mail_to_multi_checkbox'
	) );
	$form_setup[]    = $element;

	$mail_to_cc = isset( $buddyform['mail_submissions'][ $trigger ]['mail_to'] ) && in_array( 'cc', $buddyform['mail_submissions'][ $trigger ]['mail_to'] ) ? '' : 'hidden';
	$attrs      = array(
		"class"     => 'mail_to_cc_address ' . $mail_to_cc,
		'value'     => isset( $buddyform['mail_submissions'][ $trigger ]['mail_to_cc_address'] ) ? BuddyFormsEncoding::toUTF8( $buddyform['mail_submissions'][ $trigger ]['mail_to_cc_address'] ) : '',
		'shortDesc' => __( 'Separate addresses by "," and/or use any form element slug as shortcode [field_slug]', 'buddyforms' )
	);
	if ( empty( $mail_to_cc ) ) {
		$attrs['required'] = 1;
	}
	$form_setup[] = new Element_Textbox( '<b>' . __( "CC", 'buddyforms' ) . '</b>', "buddyforms_options[mail_submissions][" . $trigger . "][mail_to_cc_address]", $attrs );

	$mail_to_bcc = isset( $buddyform['mail_submissions'][ $trigger ]['mail_to'] ) && in_array( 'bcc', $buddyform['mail_submissions'][ $trigger ]['mail_to'] ) ? '' : 'hidden';
	$attrs       = array(
		"class"     => 'mail_to_bcc_address ' . $mail_to_bcc,
		'value'     => isset( $buddyform['mail_submissions'][ $trigger ]['mail_to_bcc_address'] ) ? BuddyFormsEncoding::toUTF8( $buddyform['mail_submissions'][ $trigger ]['mail_to_bcc_address'] ) : '',
		'shortDesc' => __( 'Separate addresses by "," and/or use any form element slug as shortcode [field_slug]', 'buddyforms' )
	);
	if ( empty( $mail_to_bcc ) ) {
		$attrs['required'] = 1;
	}
	$form_setup[] = new Element_Textbox( '<b>' . __( "BCC", 'buddyforms' ) . '</b>', "buddyforms_options[mail_submissions][" . $trigger . "][mail_to_bcc_address]", $attrs );

	// to email
	$form_setup[] = new Element_Textbox( '<b>' . __( "Custom sent mail to", 'buddyforms' ) . '</b>', "buddyforms_options[mail_submissions][" . $trigger . "][mail_to_address]", array(
		"class"     => "bf-mail-field",
		'value'     => isset( $buddyform['mail_submissions'][ $trigger ]['mail_to_address'] ) ? BuddyFormsEncoding::toUTF8( $buddyform['mail_submissions'][ $trigger ]['mail_to_address'] ) : '',
		'shortDesc' => __( 'Separate addresses by "," and/or use any form element slug as shortcode [field_slug]', 'buddyforms' )
	) );

	// Subject
	$email_subject = isset( $buddyform['mail_submissions'][ $trigger ]['mail_subject'] ) ? $buddyform['mail_submissions'][ $trigger ]['mail_subject'] : __( 'Form Submission Notification', 'buddyforms' );
	$form_setup[]  = new Element_Textbox( '<b>' . __( "Subject", 'buddyforms' ) . '</b>', "buddyforms_options[mail_submissions][" . $trigger . "][mail_subject]", array(
		"class"     => "bf-mail-field",
		'value'     => BuddyFormsEncoding::toUTF8( $email_subject ),
		'required'  => 1,
		'shortDesc' => __( 'Add a default Subject. If you use the "subject" form element the element value will be used, or use a [field_slug]', 'buddyforms' )
	) );

	ob_start();
	$settings     = array(
		'textarea_name' => 'buddyforms_options[mail_submissions][' . $trigger . '][mail_body]',
		'wpautop'       => true,
		'media_buttons' => false,
		'tinymce'       => true,
		'quicktags'     => true,
		'textarea_rows' => 18
	);
	$mail_content = isset( $buddyform['mail_submissions'][ $trigger ]['mail_body'] ) ? $buddyform['mail_submissions'][ $trigger ]['mail_body'] : '';
	wp_editor( BuddyFormsEncoding::toUTF8( $mail_content ), "bf_mail_body" . $trigger, $settings );
	$wp_editor    = ob_get_clean();
	$wp_editor    = '<div class="bf_field_group bf_form_content">
	<label for="form_title"><b>' . __( 'Email Message Content', 'buddyforms' ) . '</b><br>

		<p><strong>' . __( 'Important: ', 'buddyforms' ) . '</strong>' . __( 'If you use the "Message" form element you can leave this field empty and the "Message" form element value will be used . If you enter content in here, this content will overwrite the "Message" form element .', 'buddyforms' ) . '</p>
		<p>' . __( 'You can add any form element with tags [] e . g . [ message ] will be replaced with the form element "Message" [ form_elements_table ] will add a table of all form elements .', 'buddyforms' ) . '</p>
		<p>' . __( 'If no "Message" form element is uses and "no content" is added a table with all form elements will get auto generated .', 'buddyforms' ) . '</p>
	</label>
	<div class="bf_inputs bf-texteditor">' . $wp_editor . '</div></div>';
	$form_setup[] = new Element_HTML( $wp_editor . $shortDesc );
	?>
	<li id="trigger<?php echo $trigger ?>" class="bf_trigger_list_item <?php echo $trigger ?>">
		<div class="accordion_fields">
			<div class="accordion-group">
				<div class="accordion-heading-options">
					<table class="wp-list-table widefat fixed posts notification-container">
						<tbody>
						<tr>
							<td class="field_order ui-sortable-handle">
								<span class="circle">1</span>
							</td>
							<td class="field_label">
								<strong>
									<a class="bf_edit_field row-title accordion-toggle collapsed" data-toggle="collapse"
									   data-parent="#accordion_text" href="#accordion_<?php echo $trigger ?>"
									   title="Edit this Notification"
									   href="#"><?php echo isset( $buddyform['mail_submissions'][ $trigger ]['mail_subject'] ) ? $buddyform['mail_submissions'][ $trigger ]['mail_subject'] : ''; ?></a>
								</strong>

							</td>
							<td class="field_delete">
                                <span><a class="accordion-toggle collapsed" data-toggle="collapse"
                                         data-parent="#accordion_text" href="#accordion_<?php echo $trigger ?>"
                                         title="<?php _e( 'Edit this Notification', 'buddyforms' ) ?>" href="javascript:;"><?php _e( 'Edit', 'buddyforms' ) ?></a> | </span>
								<span><a class="bf_delete_trigger" id="<?php echo $trigger ?>" title="<?php _e( 'Delete this Notification', 'buddyforms' ) ?>"
								         href="javascript:;"><?php _e( 'Delete', 'buddyforms' ) ?></a></span>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div id="accordion_<?php echo $trigger ?>"
				     class="accordion-body <?php if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
					     echo 'in';
				     } ?> collapse">
					<div class="accordion-inner">
						<?php buddyforms_display_field_group_table( $form_setup, $trigger ) ?>
					</div>
				</div>
			</div>
		</div>
	</li>

	<?php
	return $trigger;
}

/**
 * @param $trigger
 * @param string $form_slug
 */
function buddyforms_new_post_status_mail_notification_form( $trigger, $form_slug = '' ) {
	global $post;

	if ( isset( $post->ID ) ) {
		$buddyform = get_post_meta( $post->ID, '_buddyforms_options', true );
	}

	$shortDesc = "
    <br>
    <h4>" . __( 'User Shortcodes', 'buddyforms' ) . "</h4>
    <ul>
        <li><p><b>[user_login] </b>Username</p></li>
        <li><p><b>[user_nicename] </b>" . __( 'user_nicename is a url - sanitized version of user_login . For example, if a user’s login is user@example . com, their user_nicename will be userexample - com .', 'buddyforms' ) . "</p></li>
        <li><p><b>[user_email]</b> " . __( 'user email', 'buddyforms' ) . "</p></li>
        <li><p><b>[first_name]</b> " . __( 'user first name', 'buddyforms' ) . "</p></li>
        <li><p><b>[last_name] </b> " . __( 'user last name', 'buddyforms' ) . "</p></li>
    </ul>
    <h4>" . __( 'Published Post Shortcodes', 'buddyforms' ) . "</h4>
    <ul>
        <li><p><b>[published_post_link_html]</b> " . __( 'the published post link in html', 'buddyforms' ) . "</p></li>
        <li><p><b>[published_post_link_plain]</b> " . __( 'the published post link in plain', 'buddyforms' ) . "</p></li>
        <li><p><b>[published_post_title]</b> " . __( 'the published post title', 'buddyforms' ) . "</p></li>
    </ul>
    <h4>" . __( 'Site Shortcodes', 'buddyforms' ) . "</h4>
    <ul>
        <li><p><b>[site_name]</b> " . __( 'the site name', 'buddyforms' ) . " </p></li>
        <li><p><b>[site_url]</b> " . __( 'the site url', 'buddyforms' ) . "</p></li>
        <li><p><b>[site_url_html]</b> " . __( 'the site url in html', 'buddyforms' ) . "</p></li>
    </ul>
        ";

	$form_setup[] = new Element_Hidden( "buddyforms_options[mail_notification][" . $trigger . "][mail_trigger]", $trigger, array( 'class' => 'trigger' . $trigger ) );

	$test_button  = sprintf( '<button class="button-primary btn btn-primary bf_test_trigger" id="%s" title="%s" data-form-slug="%s">%s</button><p class="description">%s</p>',
		$trigger, __( 'Test this Notification', 'buddyforms' ), $form_slug, __( 'Test', 'buddyforms' ),
		__( 'This test Email will be sent using the Site Admin Email and the exiting Subject and Body.', 'buddyforms' ) );
	$form_setup[] = new Element_HTML( $test_button );

	$form_setup[] = new Element_Textbox( '<b>' . __( "Name", 'buddyforms' ) . '</b>', "buddyforms_options[mail_notification][" . $trigger . "][mail_from_name]", array(
		'value'     => isset( $buddyform['mail_notification'][ $trigger ]['mail_from_name'] ) ? BuddyFormsEncoding::toUTF8( $buddyform['mail_notification'][ $trigger ]['mail_from_name'] ) : '',
		'required'  => 1,
		'shortDesc' => __( 'The senders name e.g. John Doe or use any form element slug as shortcode [field_slug]', 'buddyforms' )
	) );
	$form_setup[] = new Element_Textbox( '<b>' . __( "Email", 'buddyforms' ) . '</b>', "buddyforms_options[mail_notification][" . $trigger . "][mail_from]", array(
		'value'     => isset( $buddyform['mail_notification'][ $trigger ]['mail_from'] ) ? BuddyFormsEncoding::toUTF8( $buddyform['mail_notification'][ $trigger ]['mail_from'] ) : '',
		'required'  => 1,
		'shortDesc' => __( 'The senders email e.g. user@domain.com or use any form element slug as shortcode [field_slug]', 'buddyforms' )
	) );

	$form_setup[] = new Element_Checkbox( '<b>' . __( 'Send mail to', 'buddyforms' ) . '</b>', "buddyforms_options[mail_notification][" . $trigger . "][mail_to]", array(
		'author' => __( 'The Post Author', 'buddyforms' ),
		'admin'  => __( 'Admin E-mail Address from Settings/General', 'buddyforms' )
	), array(
		'value'  => isset( $buddyform['mail_notification'][ $trigger ]['mail_to'] ) ? $buddyform['mail_notification'][ $trigger ]['mail_to'] : '',
		'inline' => 0
	) );
	$form_setup[] = new Element_Textbox( '<b>' . __( "Send Mail To", 'buddyforms' ) . '</b>', "buddyforms_options[mail_notification][" . $trigger . "][mail_to_address]", array(
		"class"     => "bf-mail-field",
		'value'     => isset( $buddyform['mail_notification'][ $trigger ]['mail_to_address'] ) ? BuddyFormsEncoding::toUTF8( $buddyform['mail_notification'][ $trigger ]['mail_to_address'] ) : '',
		'shortDesc' => __( 'Separate addresses by "," and/or use any form element slug as shortcode [field_slug]', 'buddyforms' )
	) );

	$form_setup[] = new Element_Textbox( '<b>' . __( 'Subject', 'buddyforms' ) . '</b>', "buddyforms_options[mail_notification][" . $trigger . "][mail_subject]", array(
		"class"     => "bf-mail-field",
		'value'     => isset( $buddyform['mail_notification'][ $trigger ]['mail_subject'] ) ? BuddyFormsEncoding::toUTF8( $buddyform['mail_notification'][ $trigger ]['mail_subject'] ) : '',
		'shortDesc' => __( 'Add a default Subject. If you use the "subject" form element the element value will be used, or use a [field_slug]', 'buddyforms' ),
		'required'  => 1
	) );

	ob_start();
	$settings = array(
		'textarea_name' => 'buddyforms_options[mail_notification][' . $trigger . '][mail_body]',
		'wpautop'       => true,
		'media_buttons' => false,
		'tinymce'       => true,
		'quicktags'     => true,
		'textarea_rows' => 18
	);
	wp_editor( isset( $buddyform['mail_notification'][ $trigger ]['mail_body'] ) ? BuddyFormsEncoding::toUTF8( $buddyform['mail_notification'][ $trigger ]['mail_body'] ) : '', "bf_mail_body" . $trigger, $settings );
	$wp_editor    = ob_get_clean();
	$wp_editor    = '<div class="bf_field_group bf_form_content"><label><h2>' . __( 'Content', 'buddyforms' ) . '</h2></label><div class="bf_inputs">' . $wp_editor . '</div></div>';
	$form_setup[] = new Element_HTML( $wp_editor . $shortDesc );
	?>

	<li id="trigger<?php echo $trigger ?>" class="bf_trigger_list_item <?php echo $trigger ?>">
		<div class="accordion_fields">
			<div class="accordion-group">
				<div class="accordion-heading-options">
					<table class="wp-list-table widefat fixed posts notification-container">
						<tbody>
						<tr>
							<td class="field_order ui-sortable-handle">
								<span class="circle">1</span>
							</td>
							<td class="field_label">
								<strong>
									<a class="bf_edit_field row-title accordion-toggle collapsed" data-toggle="collapse"
									   data-parent="#accordion_text" href="#accordion_<?php echo $trigger ?>"
									   title="Edit this Notification" href="#"><?php echo $trigger ?></a>
								</strong>

							</td>
							<td class="field_delete">
                                <span><a class="accordion-toggle collapsed" data-toggle="collapse"
                                         data-parent="#accordion_text" href="#accordion_<?php echo $trigger ?>"
                                         title="<?php _e( 'Edit this Notification', 'buddyforms' ) ?>" href="javascript:;"><?php _e( 'Edit', 'buddyforms' ) ?></a> | </span>
								<span><a class="bf_delete_trigger" id="<?php echo $trigger ?>" title="<?php _e( 'Delete this Notification', 'buddyforms' ) ?>"
								         href="javascript:;"><?php _e( 'Delete', 'buddyforms' ) ?></a></span>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div id="accordion_<?php echo $trigger ?>" class="accordion-body collapse">
					<div class="accordion-inner">
						<?php buddyforms_display_field_group_table( $form_setup, $trigger ) ?>
					</div>
				</div>
			</div>
		</div>
	</li>

	<?php
}

function buddyforms_new_mail_notification() {
	try {
		if ( ! ( is_array( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			die();
		}
		if ( ! isset( $_POST['action'] ) || ! isset( $_POST['nonce'] ) || empty( $_POST['form_slug'] ) ) {
			die();
		}
		if ( ! wp_verify_nonce( $_POST['nonce'], 'fac_drop' ) ) {
			die();
		}

		$form_slug = buddyforms_sanitize_slug( $_POST['form_slug'] );
		ob_start();
		$trigger_id   = buddyforms_mail_notification_form( false, $form_slug );
		$trigger_html = ob_get_clean();

		$json['trigger_id'] = $trigger_id;
		$json['html']       = $trigger_html;

		echo json_encode( $json );
	} catch ( Exception $ex ) {
		error_log( 'BuddyForms::' . $ex->getMessage() );
	}
	die();
}

add_action( 'wp_ajax_buddyforms_new_mail_notification', 'buddyforms_new_mail_notification' );

/**
 * Function to test the email send
 *
 * @since 2.5.12
 */
function buddyforms_test_email() {
	try {
		if ( ! ( is_array( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			die();
		}
		if ( ! isset( $_POST['action'] ) || ! isset( $_POST['nonce'] ) || empty( $_POST['form_slug'] ) || empty( $_POST['notification_id'] ) ) {
			die();
		}
		if ( ! wp_verify_nonce( $_POST['nonce'], 'fac_drop' ) ) {
			die();
		}

		$form_slug       = buddyforms_sanitize_slug( $_POST['form_slug'] );
		$notification_id = sanitize_text_field( $_POST['notification_id'] );

		global $buddyforms;
		$result = false;
		if ( ! empty( $buddyforms ) && ! empty( $buddyforms[ $form_slug ] ) && ! empty( $buddyforms[ $form_slug ]['mail_submissions'] ) ) {
			$notification = ! empty( $buddyforms[ $form_slug ]['mail_submissions'][ $notification_id ] ) ? $buddyforms[ $form_slug ]['mail_submissions'][ $notification_id ] : false;
			if ( empty( $notification ) ) {
				$notification = ! empty( $buddyforms[ $form_slug ]['mail_notification'][ $notification_id ] ) ? $buddyforms[ $form_slug ]['mail_notification'][ $notification_id ] : false;
			}
			$subject = __( 'BuddyForms Test Email', 'buddyforms' );
			$body    = __( 'You body was empty, please try when you have something in place.', 'buddyforms' );
			if ( ! empty( $notification ) ) {
				if ( ! empty( $notification['mail_body'] ) ) {
					$body = $notification['mail_body'];
				}
				if ( ! empty( $notification['mail_subject'] ) ) {
					$subject = $notification['mail_subject'];
				}
			}

			$blog_title  = get_bloginfo( 'name' );
			$admin_email = apply_filters( 'buddyforms_test_email', get_option( 'admin_email' ) );
			$result      = buddyforms_email( $admin_email, $subject, $blog_title, $admin_email, $body, array(), array(), $form_slug, '', true );
		}
		if ( ! $result ) {
			wp_send_json( 'Something went wrong, please check your logs.', 400 );
		} else {
			wp_send_json( 'Please review you Site admin email.', 200 );
		}
	} catch ( Exception $ex ) {
		error_log( 'BuddyForms::' . $ex->getMessage() );
	}
	die();
}

add_action( 'wp_ajax_buddyforms_test_email', 'buddyforms_test_email' );

/**
 * Record the email test result to the system log
 *
 * @param WP_Error $error
 *
 * @author gfirem
 * @since 2.5.12
 */
function buddyforms_wp_mail_failed( $error ) {
	$message = $error->get_error_message( 'wp_mail_failed' );
	$data    = $error->get_error_data( 'wp_mail_failed' );
	if ( ! empty( $message ) && ! empty( $data['headers']['X-Mailer-Type'] ) && $data['headers']['X-Mailer-Type'] === 'WPMailSMTP/Admin/Test' ) {
		error_log( 'BuddyForms::' . $message );
	}
}

add_action( 'wp_mail_failed', 'buddyforms_wp_mail_failed' );

function buddyforms_new_post_status_mail_notification() {

	try {
		if ( ! ( is_array( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			die();
		}
		if ( ! isset( $_POST['action'] ) || ! isset( $_POST['nonce'] ) || empty( $_POST['form_slug'] ) ) {
			die();
		}
		if ( ! wp_verify_nonce( $_POST['nonce'], 'fac_drop' ) ) {
			die();
		}

		$trigger   = $_POST['trigger'];
		$form_slug = buddyforms_sanitize_slug( $_POST['form_slug'] );
		if ( isset( $trigger, $buddyform['mail_notification'][ $trigger ] ) ) {
			return false;
		}

		buddyforms_new_post_status_mail_notification_form( $trigger, $form_slug );
	} catch ( Exception $ex ) {
		error_log( 'BuddyForms::' . $ex->getMessage() );
	}
	die();
}

add_action( 'wp_ajax_buddyforms_new_post_status_mail_notification', 'buddyforms_new_post_status_mail_notification' );


function buddyforms_form_setup_nav_li_notification() { ?>
	<li class="notifications_nav"><a
		href="#notification"
		data-toggle="tab"><?php _e( 'Notifications', 'buddyforms' ); ?></a>
	</li><?php
}

add_action( 'buddyforms_form_setup_nav_li_last', 'buddyforms_form_setup_nav_li_notification' );

function buddyforms_form_setup_tab_pane_notification() { ?>
	<div class="tab-pane " id="notification">
	<div class="buddyforms_accordion_notification">
		<div class="hidden bf-hidden"><?php wp_editor( 'dummy', 'dummy' ); ?></div>

		<?php buddyforms_mail_notification_screen() ?>

		<div class="bf_show_if_f_type_post bf_hide_if_post_type_none">
			<?php buddyforms_post_status_mail_notification_screen() ?>
		</div>


	</div>
	</div><?php
}

add_action( 'buddyforms_form_setup_tab_pane_last', 'buddyforms_form_setup_tab_pane_notification' );
