<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
function buddyforms_metabox_form_setup()
{
    global  $post ;
    if ( $post->post_type != 'buddyforms' ) {
        return;
    }
    // Get the BuddyForms Options
    $buddyform = get_post_meta( get_the_ID(), '_buddyforms_options', true );
    // Get all allowed post types
    $post_types = buddyforms_get_post_types();
    // Get all allowed pages
    $all_pages = buddyforms_get_all_pages( 'id' );
    // Get all values or set the default
    $slug = $post->post_name;
    $singular_name = ( isset( $buddyform['singular_name'] ) ? stripslashes( $buddyform['singular_name'] ) : '' );
    $after_submit = ( isset( $buddyform['after_submit'] ) ? $buddyform['after_submit'] : 'display_message' );
    $after_submission_page = ( isset( $buddyform['after_submission_page'] ) ? $buddyform['after_submission_page'] : 'false' );
    $after_submission_url = ( isset( $buddyform['after_submission_url'] ) ? $buddyform['after_submission_url'] : '' );
    $post_type = ( isset( $buddyform['post_type'] ) ? $buddyform['post_type'] : 'false' );
    $form_type = ( isset( $buddyform['form_type'] ) ? $buddyform['form_type'] : 'contact' );
    $message_text_default = ( $post_type == 'false' ? 'Form Submitted Successfully' : __( 'The [form_singular_name] [post_title] has been successfully Submitted!<br>1. [post_link]<br>2. [edit_link]', 'buddyforms' ) );
    $after_submit_message_text = ( isset( $buddyform['after_submit_message_text'] ) ? $buddyform['after_submit_message_text'] : $message_text_default );
    $after_update_submit_message_text = ( isset( $buddyform['after_update_submit_message_text'] ) ? $buddyform['after_update_submit_message_text'] : buddyforms_default_message_on_update() );
    $empty_submit_list_message_text = ( isset( $buddyform['empty_submit_list_message_text'] ) ? $buddyform['empty_submit_list_message_text'] : buddyforms_default_message_on_empty_submission_list() );
    $attached_page = ( isset( $buddyform['attached_page'] ) ? $buddyform['attached_page'] : 'false' );
    $status = ( isset( $buddyform['status'] ) ? $buddyform['status'] : 'false' );
    $comment_status = ( isset( $buddyform['comment_status'] ) ? $buddyform['comment_status'] : 'false' );
    $revision = ( isset( $buddyform['revision'] ) ? $buddyform['revision'] : 'false' );
    //	$draft_action      = isset( $buddyform['draft_action'] ) ? $buddyform['draft_action'] : 'false';
    $admin_bar = ( isset( $buddyform['admin_bar'] ) ? $buddyform['admin_bar'] : 'false' );
    $edit_link = ( isset( $buddyform['edit_link'] ) ? $buddyform['edit_link'] : 'all' );
    $bf_ajax = ( isset( $buddyform['bf_ajax'] ) ? $buddyform['bf_ajax'] : false );
    $user_data = ( isset( $buddyform['user_data'] ) ? $buddyform['user_data'] : array(
        'ipaddress',
        'referer',
        'browser',
        'version',
        'platform',
        'reports',
        'userAgent',
        'enable_all'
    ) );
    $list_posts_option = ( isset( $buddyform['list_posts_option'] ) ? $buddyform['list_posts_option'] : 'list_all_form' );
    $list_posts_style = ( isset( $buddyform['list_posts_style'] ) ? $buddyform['list_posts_style'] : 'list' );
    $local_storage = ( isset( $buddyform['local_storage'] ) ? $buddyform['local_storage'] : '' );
    $js_validation = ( isset( $buddyform['js_validation'] ) ? $buddyform['js_validation'] : '' );
    // Create The Form Array
    $form_setup = array();
    //
    // Submission
    //
    $element = new Element_Textbox( '<b>' . __( "From Slug", 'buddyforms' ) . '</b>', "buddyforms_options[slug]", array(
        'value'     => $slug,
        'shortDesc' => __( 'The Form Slug is used in shortcodes and other places, please take care changing this option.', 'buddyforms' ),
    ) );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Form Submission'][] = $element;
    $element = new Element_Select(
        '<b>' . __( "After Submission", 'buddyforms' ) . '</b>',
        "buddyforms_options[after_submit]",
        array(
        'display_message'    => __( 'Display Message', 'buddyforms' ),
        'display_form'       => __( 'Display the Form and Message' ),
        'display_page'       => __( 'Display Page Contents', 'buddyforms' ),
        'display_post'       => __( 'Display the Post' ),
        'display_posts_list' => __( 'Display the User\'s Post List' ),
        'redirect'           => __( 'Redirect to url', 'buddyforms' ),
    ),
        array(
        'value' => $after_submit,
        'class' => 'bf-after-submission-action',
        'id'    => 'bf-after-submission-action',
    )
    );
    $element->setAttribute( 'data-hidden', 'display_page display_form display_message redirect' );
    $form_setup['Form Submission'][] = $element;
    // After Submission Page
    $element = new Element_Select(
        '<b>' . __( "After Submission Page", 'buddyforms' ) . '</b>',
        "buddyforms_options[after_submission_page]",
        $all_pages,
        array(
        'value'     => $after_submission_page,
        'shortDesc' => __( 'Select the Page from where the content gets displayed. Will redirected to the page if ajax is disabled, otherwise display the content.', 'buddyforms' ),
        'class'     => 'display_page',
    )
    );
    $form_setup['Form Submission'][] = $element;
    $form_setup['Form Submission'][] = new Element_Url( '<b>' . __( "Redirect URL", 'buddyforms' ), "buddyforms_options[after_submission_url]", array(
        'value'     => $after_submission_url,
        'shortDesc' => __( 'Enter a valid URL', 'buddyforms' ),
        'class'     => 'redirect',
    ) );
    $form_setup['Form Submission'][] = new Element_Textarea( '<b>' . __( 'After Create Submission Message Text', 'buddyforms' ) . '</b>', "buddyforms_options[after_submit_message_text]", array(
        'rows'  => 3,
        'style' => "width:100%",
        'class' => 'display_message display_form',
        'value' => $after_submit_message_text,
        'id'    => 'after_submit_message_text',
    ) );
    $form_setup['Form Submission'][] = new Element_Textarea( '<b>' . __( 'After Update Submission Message Text', 'buddyforms' ) . '</b>', "buddyforms_options[after_update_submit_message_text]", array(
        'rows'  => 3,
        'style' => "width:100%",
        'class' => 'display_message display_form',
        'value' => $after_update_submit_message_text,
        'id'    => 'after_update_submit_message_text',
    ) );
    $form_setup['Form Submission'][] = new Element_Textarea( '<b>' . __( 'Empty Submission List Message Text', 'buddyforms' ) . '</b>', "buddyforms_options[empty_submit_list_message_text]", array(
        'rows'      => 3,
        'style'     => "width:100%",
        'value'     => $empty_submit_list_message_text,
        'id'        => 'empty_submit_list_message_text',
        'shortDesc' => __( 'This message is used when you have setup the option <b>Enable your site members to view their submissions</b>', 'buddyforms' ),
    ) );
    $element = new Element_Checkbox(
        '<b>' . __( 'AJAX', 'buddyforms' ) . '</b>',
        "buddyforms_options[bf_ajax]",
        array(
        'bf_ajax' => __( 'Disable ajax form submission', 'buddyforms' ),
    ),
        array(
        'shortDesc' => '',
        'value'     => $bf_ajax,
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Form Submission'][] = $element;
    $element = new Element_Checkbox(
        '<b>' . __( 'Local Storage', 'buddyforms' ) . '</b>',
        "buddyforms_options[local_storage]",
        array(
        'disable' => __( 'Disable Local Storage', 'buddyforms' ),
    ),
        array(
        'shortDesc' => __( 'The form elements content is stored in the browser so it not gets lost if the tab gets closed by accident', 'buddyforms' ),
        'value'     => $local_storage,
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Form Submission'][] = $element;
    $element = new Element_Checkbox(
        '<b>' . __( 'Javascript Validations', 'buddyforms' ) . '</b>',
        "buddyforms_options[js_validation]",
        array(
        'disabled' => __( 'Disable JavaScript Validation', 'buddyforms' ),
    ),
        array(
        'shortDesc' => __( 'By default the Javascript validations are enabled. Check to disable it.', 'buddyforms' ),
        'value'     => $js_validation,
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Form Submission'][] = $element;
    $public_submit_login = ( isset( $buddyform['public_submit_login'] ) ? $buddyform['public_submit_login'] : 'above' );
    $element = new Element_Select(
        '<b>' . __( 'Enable Login on the form', 'buddyforms' ) . '</b>',
        "buddyforms_options[public_submit_login]",
        array(
        'none'  => __( 'None', 'buddyforms' ),
        'above' => __( 'Above the Form', 'buddyforms' ),
        'under' => __( 'Under the Form', 'buddyforms' ),
    ),
        array(
        'value'     => $public_submit_login,
        'shortDesc' => __( 'Give your existing customers the choice to login. Just place a login form above or under the form. The Login Form is only visible for logged of user.', 'buddyforms' ),
        'class'     => 'public-submit-option',
    )
    );
    $form_setup['Form Submission'][] = $element;
    $element = new Element_Checkbox(
        '<b>' . __( 'User Data', 'buddyforms' ) . '</b>',
        "buddyforms_options[user_data]",
        array(
        'ipaddress'  => __( 'Disable IP Address', 'buddyforms' ),
        'referer'    => __( 'Disable Referer', 'buddyforms' ),
        'browser'    => __( 'Disable Browser', 'buddyforms' ),
        'version'    => __( 'Disable Browser Version', 'buddyforms' ),
        'platform'   => __( 'Disable Platform', 'buddyforms' ),
        'reports'    => __( 'Disable Reports', 'buddyforms' ),
        'userAgent'  => __( 'Disable User Agent', 'buddyforms' ),
        'enable_all' => '',
    ),
        array(
        'shortDesc' => __( 'By default all above user data will not be stored. In some country\'s for example in the EU you are not allowed to save the ip. Please make sure you not against the low in your country and adjust if needed', 'buddyforms' ),
        'value'     => $user_data,
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Form Submission'][] = $element;
    $shortDesc_post_type = sprintf(
        '<b>%s</b> <br><br><a target="_blank" href="#">%s</a>',
        __( 'Use any POST TYPE with the PRO Version!', 'buddyforms' ),
        __( 'Select a post type if you want to create posts from form submissions. ', 'buddyforms' ),
        __( 'Read the Documentation', 'buddyforms' )
    );
    $hide_registration_for_logged_in = ( isset( $buddyform['hide_for_logged_in_users'] ) ? $buddyform['hide_for_logged_in_users'] : 'no' );
    $element = new Element_Select(
        '<b>' . __( "Hide for logged-in users", 'buddyforms' ) . '</b>',
        "buddyforms_options[hide_for_logged_in_users]",
        array(
        'no'  => __( 'No', 'buddyforms' ),
        'yes' => __( 'Yes', 'buddyforms' ),
    ),
        array(
        'value' => $hide_registration_for_logged_in,
        'class' => 'bf_show_if_f_type_registration',
    )
    );
    $form_setup['Form Submission'][] = $element;
    //
    // Create Content
    //
    $element = new Element_Select(
        '<b>' . __( "Post Type", 'buddyforms' ) . '</b>',
        "buddyforms_options[post_type]",
        $post_types,
        array(
        'value'     => $post_type,
        'shortDesc' => $shortDesc_post_type,
        'id'        => 'form_post_type',
    )
    );
    $form_setup['Create Content'][] = $element;
    $element = new Element_Select(
        '<b>' . __( "Status", 'buddyforms' ) . '</b>',
        "buddyforms_options[status]",
        array( 'publish', 'pending', 'draft' ),
        array(
        'value' => $status,
        'class' => 'bf_hide_if_post_type_none',
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Create Content'][] = $element;
    $element = new Element_Select(
        '<b>' . __( "Comment Status", 'buddyforms' ) . '</b>',
        "buddyforms_options[comment_status]",
        array( 'open', 'closed' ),
        array(
        'value' => $comment_status,
        'class' => 'bf_hide_if_post_type_none',
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Create Content'][] = $element;
    $element = new Element_Checkbox(
        '<b>' . __( 'Revision', 'buddyforms' ) . '</b>',
        "buddyforms_options[revision]",
        array(
        'Revision' => __( 'Enable frontend revision control', 'buddyforms' ),
    ),
        array(
        'value' => $revision,
        'class' => 'bf_hide_if_post_type_none',
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Create Content'][] = $element;
    $element = new Element_Textbox( '<b>' . __( "Singular Name", 'buddyforms' ), "buddyforms_options[singular_name]", array(
        'value'     => $singular_name,
        'shortDesc' => __( 'The Single Name is used by other plugins and Navigation ( Display Books, Add Book )', 'buddyforms' ),
        'class'     => 'bf_hide_if_post_type_none',
    ) );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Create Content'][] = $element;
    //	$element = new Element_Checkbox( '<b>' . __( 'Enable Draft', 'buddyforms' ) . '</b>', "buddyforms_options[draft_action]", array( 'Enable Draft' => __( 'Enable Draft Form Action', 'buddyforms' ) ),
    //		array(
    //			'value' => $draft_action,
    //			'class' => 'bf_hide_if_post_type_none'
    //		) );
    //	if ( buddyforms_core_fs()->is_not_paying() && ! buddyforms_core_fs()->is_trial() ) {
    //		$element->setAttribute( 'disabled', 'disabled' );
    //	}
    //  $form_setup['Create Content'][] = $element;
    //
    // Edit Submissions
    //
    // Make sure to use the default submissions management page if non exist!
    
    if ( !$attached_page || $attached_page == 'none' || $attached_page == 'false' ) {
        $buddyforms_submissions_page = get_option( 'buddyforms_submissions_page' );
        if ( $buddyforms_submissions_page ) {
            $attached_page = $buddyforms_submissions_page;
        }
    }
    
    $siteurl = get_bloginfo( 'wpurl' );
    $attached_page_url = get_permalink( $attached_page );
    
    if ( !empty($attached_page_url) ) {
        $siteurl_page_html = "<a style='color:#7ad03a;' id='siteurl_page' class='' href='" . $attached_page_url . "' target='_blank' >" . $attached_page_url . "</a>";
        $siteurl_create_html = "<a style='color:#7ad03a;' id='siteurl_create' class='' href='" . $attached_page_url . "create/" . $slug . "' target='_blank' >" . $attached_page_url . "create/" . $slug . "</a>";
        $siteurl_edit_html = "<a style='color:#7ad03a;' id='siteurl_edit' class='' href='" . $attached_page_url . "view/" . $slug . "' target='_blank' >" . $attached_page_url . "view/" . $slug . "</a>";
    } else {
        $siteurl_page_html = $siteurl . '/' . $attached_page;
        $siteurl_create_html = $siteurl . '/' . $attached_page . '/create/' . $slug;
        $siteurl_edit_html = $siteurl . '/' . $attached_page . '/view/' . $slug;
    }
    
    $admin_email = get_option( 'admin_email' );
    // Attached Page
    $form_setup['Edit Submissions'][] = new Element_HTML( sprintf( '<h4>%s</h4>', __( 'Enable your site members to view their submissions', 'buddyforms' ) ) . sprintf( '<p>%s</p>', __( 'Select a page or create a new on if you like to turn on submission management for your logged in users.', 'buddyforms' ) ) . '<div class="bf_hide_if_post_type_none">' . sprintf( '<p class="description">%s<br> %s', __( 'Important!', 'buddyforms' ), __( 'The original page content does not get changed. You are free to use any kind of content on the page itself. View a form or list the users submissions with Shortcodes. For the submissions management new endpoints get create for you. You can combine forms under the same page. Its a powerful option.', 'buddyforms' ) ) . sprintf( '<a target="_blank" href="http://docs.buddyforms.com/article/139-select-page-in-the-formbuilder">%s</a></p>', __( 'Read the Documentation', 'buddyforms' ) ) . sprintf( '<h6>%s<br><small class="siteurl_create_html">' . $siteurl_create_html . '</small></h6>', __( 'Form URL', 'buddyforms' ) ) . sprintf( '<h6>%s<br><small class="siteurl_edit_html">' . $siteurl_edit_html . '</small></h6>', __( 'User Submissions URL', 'buddyforms' ) ) . '</div>' );
    $form_setup['Edit Submissions'][] = new Element_Select(
        '<b>' . __( "Enable site members to manage their submissions", 'buddyforms' ) . '</b>',
        "buddyforms_options[attached_page]",
        $all_pages,
        array(
        'value'     => $attached_page,
        'shortDesc' => sprintf( '<b><a href="javascript:void(0);" onclick="createNewPageOpenModal()" id="bf_create_page_modal">%s </a></b> %s', __( 'Create a new Page', 'buddyforms' ), __( 'The page is used to create the endpoints for the create - list and edit submissions views. ', 'buddyforms' ) ),
        'id'        => 'attached_page',
        'data-slug' => $slug,
    )
    );
    $element = new Element_Checkbox(
        '<b>' . __( 'Admin Bar', 'buddyforms' ) . '</b>',
        "buddyforms_options[admin_bar]",
        array(
        'Admin Bar' => __( 'Add to Admin Bar', 'buddyforms' ),
    ),
        array(
        'value' => $admin_bar,
        'class' => 'bf_hide_if_attached_page_none',
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Edit Submissions'][] = $element;
    $element = new Element_Radio(
        '<b>' . __( "Overwrite Frontend 'Edit Post' Link", 'buddyforms' ) . '</b>',
        "buddyforms_options[edit_link]",
        array(
        'none'          => 'None',
        'all'           => __( "All Edit Links", 'buddyforms' ),
        'my-posts-list' => __( "Only in My Posts List", 'buddyforms' ),
    ),
        array(
        'view'      => 'vertical',
        'value'     => $edit_link,
        'shortDesc' => __( 'The link to the backend will be changed to use the frontend editing.', 'buddyforms' ),
        'class'     => 'bf_hide_if_attached_page_none',
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Edit Submissions'][] = $element;
    $element = new Element_Radio(
        '<b>' . __( "List Posts Options", 'buddyforms' ) . '</b>',
        "buddyforms_options[list_posts_option]",
        array(
        'list_all_form' => __( 'List all Author Posts created with this Form', 'buddyforms' ),
        'list_all'      => __( 'List all Author Posts of the PostType', 'buddyforms' ),
    ),
        array(
        'value'     => $list_posts_option,
        'shortDesc' => '',
        'class'     => 'bf_hide_if_attached_page_none',
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Edit Submissions'][] = $element;
    $element = new Element_Radio(
        '<b>' . __( "List Style", 'buddyforms' ) . '</b>',
        "buddyforms_options[list_posts_style]",
        apply_filters( 'buddyforms_loop_template_name', array(
        'list'  => 'List',
        'table' => 'Table',
    ) ),
        array(
        'value'     => $list_posts_style,
        'shortDesc' => __( 'Do you want to list post in a ul li list or as table.', 'buddyforms' ),
        'class'     => 'bf_hide_if_attached_page_none',
    )
    );
    if ( buddyforms_core_fs()->is_not_paying() && !buddyforms_core_fs()->is_trial() ) {
        $element->setAttribute( 'disabled', 'disabled' );
    }
    $form_setup['Edit Submissions'][] = $element;
    //
    // Display multisite options if network is enabled
    //
    
    if ( buddyforms_is_multisite() ) {
        $sites_select = array();
        $sites = get_sites();
        foreach ( $sites as $site_id => $site ) {
            $blog_details = get_blog_details( $site->blog_id, array( 'blog_id', 'blogname' ) );
            $sites_select[$blog_details->blog_id] = $blog_details->blogname;
        }
        $blog_id = ( isset( $buddyform['blog_id'] ) ? $buddyform['blog_id'] : '' );
        $element = new Element_Select(
            '<b>' . __( "Select a Blog", 'buddyforms' ) . '</b>',
            "buddyforms_options[blog_id]",
            $sites_select,
            array(
            'value'     => $blog_id,
            'shortDesc' => __( 'You can post with BuddyForms from one Blog to the other. If you use BuddyPress you can have a centralised Profile on the main Blog and let the user submit to the multisite network from a centralised place.', 'buddyforms' ),
            'id'        => 'blog_id',
        )
        );
        $form_setup['Network'][] = $element;
    }
    
    // Check if form elements exist and sort the form elements
    if ( is_array( $form_setup ) ) {
        $form_setup = buddyforms_sort_array_by_Array( $form_setup, array( __( 'Form Submission', 'buddyforms' ), __( 'Create Content', 'buddyforms' ), __( 'Edit Submissions', 'buddyforms' ) ) );
    }
    // Display all Form Elements in a nice Tab UI and List them in a Table
    ?>
	<p>
		<select id="bf-form-type-select" style="margin-left: 0 !important;" name="buddyforms_options[form_type]">
			<optgroup label="Form Type">
				<option <?php 
    selected( $form_type, 'contact' );
    ?> value="contact"><?php 
    _e( 'Contact Form', 'buddyforms' );
    ?></option>
				<option <?php 
    selected( $form_type, 'registration' );
    ?> value="registration"><?php 
    _e( 'Registration Form', 'buddyforms' );
    ?></option>
				<option <?php 
    selected( $form_type, 'post' );
    ?> value="post"><?php 
    _e( 'Post Form', 'buddyforms' );
    ?></option>
			</optgroup>
		</select>
	</p>
	<div class="tabbable buddyform-tabs-left">
		<ul class="nav buddyform-nav-tabs buddyform-nav-pills">
			<?php 
    $i = 0;
    foreach ( $form_setup as $tab => $fields ) {
        $tab_slug = sanitize_title( $tab );
        ?>
			<li class="<?php 
        echo  ( $i == 0 ? 'active' : '' ) ;
        echo  $tab_slug ;
        ?>_nav">
				<a href="#<?php 
        echo  $tab_slug ;
        ?>" data-toggle="tab"><?php 
        echo  $tab ;
        ?></a>
				</li><?php 
        $i++;
    }
    // Allow other plugins to add new sections
    do_action( 'buddyforms_form_setup_nav_li_last' );
    ?>

		</ul>
		<div class="tab-content">
			<?php 
    $i = 0;
    foreach ( $form_setup as $tab => $fields ) {
        $tab_slug = sanitize_title( $tab );
        ?>
				<div class="tab-pane <?php 
        echo  ( $i == 0 ? 'active' : '' ) ;
        ?>"
				     id="<?php 
        echo  $tab_slug ;
        ?>">
					<div class="buddyforms_accordion_general">
						<?php 
        // get all the html elements and add them above the settings
        foreach ( $fields as $field_key => $field ) {
            $type = $field->getAttribute( 'type' );
            if ( $type == 'html' ) {
                $field->render();
            }
        }
        ?>
						<table class="wp-list-table widefat posts fixed">
							<tbody>
							<?php 
        foreach ( $fields as $field_key => $field ) {
            $type = $field->getAttribute( 'type' );
            $class = $field->getAttribute( 'class' );
            $disabled = $field->getAttribute( 'disabled' );
            $classes = ( empty($class) ? '' : $class . ' ' );
            $classes .= ( empty($disabled) ? '' : 'bf-' . $disabled . ' ' );
            // If the form element is not html create it as table row
            
            if ( $type != 'html' ) {
                ?>
									<tr class="<?php 
                echo  $classes ;
                ?>">
										<th scope="row">
											<label for="form_title"><?php 
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
        ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php 
        $i++;
    }
    // Allow other plugins to hook there content for there nav into the tab content
    do_action( 'buddyforms_form_setup_tab_pane_last' );
    ?>
		</div>  <!-- close .tab-content -->
	</div> <!--	close .tabs -->
	<?php 
}
