<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Class to handle the registration metaBox form options.
 */
class BuddyFormsMetaBoxRegistration {

	public function __construct() {
		add_action( 'buddyforms_form_setup_nav_li_last', array( $this, 'buddyforms_form_setup_nav_li_registration' ), 50 );
		add_action( 'buddyforms_form_setup_tab_pane_last', array( $this, 'buddyforms_form_setup_tab_pane_registration' ) );
	}

	/**
	 * Return an li item to add to the metaBox panel
	 *
	 * @param $id
	 * @param $name
	 *
	 * @return string
	 */
	private function tab_panel_nav_li( $id, $name ) {
		return sprintf( '<li class="registrations_nav"><a href="#%s" data-toggle="tab">%s</a></li>', $id, $name );
	}

	/**
	 * Add the html to the form setting metabox
	 */
	public function buddyforms_form_setup_nav_li_registration() {
		$registration_li = $this->tab_panel_nav_li( 'registration', __( 'User Register', 'buddyforms' ) );
		$user_update_li  = $this->tab_panel_nav_li( 'user_update', __( 'User Update', 'buddyforms' ) );
		echo $registration_li . $user_update_li;
	}

	/**
	 * Get an array with string necessary to build the container to show the options
	 *
	 * @param $id
	 * @param $class
	 *
	 * @return array['start', 'end']
	 */
	private function tab_panel_html_array( $id, $class ) {
		return array(
			'start' => sprintf( '<div class="tab-pane" id="%s"><div class="%s">', $id, $class ),
			'end'   => '</div></div>',
		);
	}

	/**
	 * Add the container of the options
	 */
	public function buddyforms_form_setup_tab_pane_registration() {
		$registration_tab_array_html = $this->tab_panel_html_array( 'registration', 'buddyforms_accordion_registration' );
		$user_update_tab_array_html  = $this->tab_panel_html_array( 'user_update', 'buddyforms_accordion_user_update' );

		echo $registration_tab_array_html['start'];
		$this->buddyforms_registration_screen();
		echo $registration_tab_array_html['end'];

		echo $user_update_tab_array_html['start'];
		$this->buddyforms_user_update_screen();
		echo $user_update_tab_array_html['end'];
	}

	public function buddyforms_registration_screen() {
		global $post, $buddyform;

		$form_setup = array();

		if ( ! $buddyform ) {
			$buddyform = get_post_meta( get_the_ID(), '_buddyforms_options', true );
		}

		echo '<h4>' . __( 'On User Registration Options', 'buddyforms' ) . '</h4>';

		$generate_password = isset( $buddyform['registration']['generate_password'] ) ? $buddyform['registration']['generate_password'] : '';
		$element           = new Element_Checkbox( '<b>' . __( 'Generate Password', 'buddyforms' ) . '</b>', "buddyforms_options[registration][generate_password]", array( 'yes' => __( 'Auto generate the password.', 'buddyforms' ) ), array(
			'value'     => $generate_password,
			'shortDesc' => __('If generate password is enabled the password field is not required and can be removed from the form. How ever if the password field exist and a passowrd was entered the password from the password field is used instad of the auto generated password.', 'buddyforms')
		) );
		if ( buddyforms_core_fs()->is_not_paying() && ! buddyforms_core_fs()->is_trial() ) {
			$element->setAttribute( 'disabled', 'disabled' );
		}
		$form_setup[] = $element;

		// Generate Username ?
		$public_submit_username_from_email = ! isset( $buddyform['public_submit_username_from_email'] ) ? '' : 'public_submit_username_from_email';
		$element                           = new Element_Checkbox( '<b>' . __( 'Automatically generate username from eMail', 'buddyforms' ) . '</b>', "buddyforms_options[public_submit_username_from_email]", array( 'public_submit_username_from_email' => __( 'Generate Username from eMail', 'buddyforms' ) ), array(
			'value'     => $public_submit_username_from_email,
			'shortDesc' => __('This option only works with the eMail Form Element added to the Form. Please make sure you have the User eMail form element added to the form.', 'buddyforms')
		) );
		if ( buddyforms_core_fs()->is_not_paying() && ! buddyforms_core_fs()->is_trial() ) {
			$element->setAttribute( 'disabled', 'disabled' );
		}
		$form_setup[] = $element;

		//Get all Pages
		$all_pages = $this->get_activation_page_list();

		$activation_page = isset( $buddyform['registration']['activation_page'] ) ? $buddyform['registration']['activation_page'] : 'none';

		// Activation Page
		$form_setup[] = new Element_Select( '<b>' . __( "After Activation Page", 'buddyforms' ) . '</b>', "buddyforms_options[registration][activation_page]", $all_pages, array(
			'value'     => $activation_page,
			'shortDesc' => __( 'Select the page where the user should land on if he clicks the activation link from the activation email and all well correct.', 'buddyforms' ),
			'class'     => '',
		) );

		// activation_message_from_subject
		$activation_message_from_subject = isset( $buddyform['registration']['activation_message_from_subject'] ) ? $buddyform['registration']['activation_message_from_subject'] : 'User Account Activation Mail';
		$form_setup[]                    = new Element_Textbox( '<b>' . __( "Activation Message Subject", 'buddyforms' ) . '</b>', "buddyforms_options[registration][activation_message_from_subject]", array(
			'value'     => $activation_message_from_subject,
			'shortDesc' => '',
			'class'     => '',
		) );
		// activation_message_text
		$activation_message_text = isset( $buddyform['registration']['activation_message_text'] )
			? $buddyform['registration']['activation_message_text']
			: __('Hi [user_login], Great to see you come on board! Just one small step left to make your registration complete.<br><b>Click the link below to activate your account.</b><br>[activation_link]<br><br>[blog_title]', 'buddyforms');
		$form_setup[]            = new Element_Textarea( '<b>' . __( "Activation Message Text", 'buddyforms' ) . '</b>', "buddyforms_options[registration][activation_message_text]", array(
			'value'     => $activation_message_text,
			'shortDesc' => '',
			'class'     => '',
			'style'     => 'width: 100%; display: inline-block;'
		) );
		// activation_message_from_name
		$activation_message_from_name = isset( $buddyform['registration']['activation_message_from_name'] ) ? $buddyform['registration']['activation_message_from_name'] : '[blog_title]';
		$form_setup[]                 = new Element_Textbox( '<b>' . __( "Activation From Name", 'buddyforms' ) . '</b>', "buddyforms_options[registration][activation_message_from_name]", array(
			'value'     => $activation_message_from_name,
			'shortDesc' => '',
			'class'     => '',
		) );
		// activation_message_from_email
		$activation_message_from_email = isset( $buddyform['registration']['activation_message_from_email'] ) ? $buddyform['registration']['activation_message_from_email'] : '[admin_email]';
		$form_setup[]                  = new Element_Textbox( '<b>' . __( "Activation From eMail", 'buddyforms' ) . '</b>', "buddyforms_options[registration][activation_message_from_email]", array(
			'value'     => $activation_message_from_email,
			'shortDesc' => __( 'You can set the "From Email Address" to [admin_email] to use the admin Email from the general WordPress settings', 'buddyforms' ),
			'class'     => '',
		) );

		$new_user_role = isset( $buddyform['registration']['new_user_role'] ) ? $buddyform['registration']['new_user_role'] : 'subscriber';

		// User Role
		$form_setup[] = new Element_Select( '<b>' . __( "New User Role", 'buddyforms' ) . '</b>', "buddyforms_options[registration][new_user_role]", $this->get_roles_array(), array(
			'value'     => $new_user_role,
			'shortDesc' => __( 'Select the User Role the user should have after successful registration', 'buddyforms' ),
			'class'     => ''
		) );

		buddyforms_display_field_group_table( $form_setup );
	}

	/**
	 * Get the list of pages to show in the list of the Activation Page
	 * @return array
	 */
	public function get_activation_page_list() {
		$home_page_id = get_option( 'page_on_front' );
		// Get all Pages
		$pages = get_pages( array(
			'sort_order'  => 'asc',
			'sort_column' => 'post_title',
			'parent'      => 0,
			'exclude'     => array( $home_page_id ),
			'post_type'   => 'page',
			'post_status' => 'publish'
		) );

		// Generate the pages Array
		$all_pages             = array();
		$all_pages['referrer'] = __( 'Select a Page', 'buddyforms' );
		$all_pages['home']     = __( 'Homepage', 'buddyforms' );
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}

		return $all_pages;
	}

	/**
	 * Get the array of roles.
	 *
	 * @param bool $include_keep_item Include a keep item used in the update user process
	 *
	 * @return array
	 */
	private function get_roles_array( $include_keep_item = false ) {
		$result = array();

		if ( $include_keep_item ) {
			$result['keep'] = __( 'Keep the current Role', 'buddyforms' );
		}

		foreach ( get_editable_roles() as $role_name => $role_info ) {
			$result[ $role_name ] = $role_info['name'];
		}

		return $result;
	}

	public function buddyforms_user_update_screen() {
		global $post, $buddyform;

		$form_setup = array();

		if ( ! $buddyform ) {
			$buddyform = get_post_meta( get_the_ID(), '_buddyforms_options', true );
		}

		echo '<h4>' . __( 'On User Update Options', 'buddyforms' ) . '</h4>';

		//Put the user on activation flow when the rol is changed.
		$is_active_moderate_user_change = ! isset( $buddyform['on_user_update']['moderate_user_change'] ) ? '' : 'moderate_user_change';
		$rows_are_visible               = ( empty( $is_active_moderate_user_change ) ) ? 'bf-hidden' : '';

		$new_user_role = isset( $buddyform['on_user_update']['new_user_role'] ) ? $buddyform['on_user_update']['new_user_role'] : 'keep';

		// User Role
		$form_setup[] = new Element_Select( '<b>' . __( "New User Role", 'buddyforms' ) . '</b>', "buddyforms_options[on_user_update][new_user_role]", $this->get_roles_array( true ), array(
			'value'     => $new_user_role,
			'shortDesc' => __( 'Select the User Role the user should have after successful Update the Form.', 'buddyforms' ),
		) );

		$element = new Element_Checkbox( '<b>' . __( 'Moderate User Update', 'buddyforms' ) . '</b>', "buddyforms_options[on_user_update][moderate_user_change]", array( 'moderate_user_change' => __( 'Moderate User on Update.', 'buddyforms' ) ), array(
			'value'     => $is_active_moderate_user_change,
			'shortDesc' => __( 'To moderate when the user is Updated check this option. When the User change, it will be Deactivate and Activation Email will be Send. Note the User WILL BE INACTIVE until the Email Activation is clicked or the Admin Activate the user on the WP list of Users.', 'buddyforms' )
		) );
		if ( buddyforms_core_fs()->is_not_paying() && ! buddyforms_core_fs()->is_trial() ) {
			$element->setAttribute( 'disabled', 'disabled' );
		}
		$form_setup[] = $element;

		//Explain the redirection on update
		echo sprintf( '<p>%s</p><br>', __( 'To select the page where the user should land on Update the User Profile use te Form Submission options ', 'buddyforms' ) );

		//Get all Pages
		$all_pages = $this->get_activation_page_list();

		$activation_page = isset( $buddyform['registration']['activation_page'] ) ? $buddyform['registration']['activation_page'] : 'none';

		// Activation Page
		$form_setup[] = new Element_Select( '<b>' . __( "Activation Page", 'buddyforms' ) . '</b>', "buddyforms_options[on_user_update][activation_page]", $all_pages, array(
			'value'     => $activation_page,
			'shortDesc' => __( 'Select the page the user should land on if he clicks the activation link in the activation email.', 'buddyforms' ),
			'class'     => $rows_are_visible,
		) );

		// activation_message_from_subject
		$activation_message_from_subject = isset( $buddyform['on_user_update']['activation_message_from_subject'] ) ? $buddyform['on_user_update']['activation_message_from_subject'] : 'User Account Activation Mail';
		$form_setup[]                    = new Element_Textbox( '<b>' . __( "Activation Message Subject", 'buddyforms' ) . '</b>', "buddyforms_options[on_user_update][activation_message_from_subject]", array(
			'value'     => $activation_message_from_subject,
			'shortDesc' => '',
			'class'     => $rows_are_visible,
		) );
		// activation_message_text
		$activation_message_text = isset( $buddyform['on_user_update']['activation_message_text'] )
			? $buddyform['on_user_update']['activation_message_text']
			: __("Hi [user_login], Great to see you come on board! Just one small step left to make your registration complete.<br><b>Click the link below to activate your account.</b><br>[activation_link]<br><br>[blog_title]", 'buddyforms');
		$form_setup[]            = new Element_Textarea( '<b>' . __( "Activation Message Text", 'buddyforms' ) . '</b>', "buddyforms_options[on_user_update][activation_message_text]", array(
			'value'     => $activation_message_text,
			'shortDesc' => '',
			'class'     => $rows_are_visible,
			'style'     => 'width: 100%; display: inline-block; ',
		) );
		// activation_message_from_name
		$activation_message_from_name = isset( $buddyform['on_user_update']['activation_message_from_name'] ) ? $buddyform['on_user_update']['activation_message_from_name'] : '[blog_title]';
		$form_setup[]                 = new Element_Textbox( '<b>' . __( "Activation From Name", 'buddyforms' ) . '</b>', "buddyforms_options[on_user_update][activation_message_from_name]", array(
			'value'     => $activation_message_from_name,
			'shortDesc' => '',
			'class'     => $rows_are_visible,
		) );
		// activation_message_from_email
		$activation_message_from_email = isset( $buddyform['on_user_update']['activation_message_from_email'] ) ? $buddyform['on_user_update']['activation_message_from_email'] : '[admin_email]';
		$form_setup[]                  = new Element_Textbox( '<b>' . __( "Activation From eMail", 'buddyforms' ) . '</b>', "buddyforms_options[on_user_update][activation_message_from_email]", array(
			'value'     => $activation_message_from_email,
			'shortDesc' => __( 'You can set the "From Email Address" to [admin_email] to use the admin Email from the general WordPress settings', 'buddyforms' ),
			'class'     => $rows_are_visible,
		) );

		buddyforms_display_field_group_table( $form_setup );
	}
}

new BuddyFormsMetaBoxRegistration();
