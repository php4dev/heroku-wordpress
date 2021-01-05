<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @package WordPress
 * @subpackage BuddyForms
 * @author ThemeKraft Dev Team
 * @copyright 2018
 * @link http://www.themekraft.com
 * @license http://www.apache.org/licenses/
 */
/**
 * Class BfAdminNotices
 *
 * Handle the notices inside the form builder
 */
class BfAdminNotices
{
    public function __construct()
    {
        add_action( 'post_submitbox_start', array( $this, 'buddyforms_notice' ) );
    }
    
    public function buddyforms_notice()
    {
        global  $post, $buddyform ;
        // Get the current screen
        $screen = get_current_screen();
        if ( !($screen->parent_base == 'edit' && isset( $_GET['action'] )) ) {
            return;
        }
        if ( $post->post_type != 'buddyforms' ) {
            return;
        }
        if ( !$buddyform ) {
            $buddyform = get_post_meta( get_the_ID(), '_buddyforms_options', true );
        }
        if ( !is_array( $buddyform ) ) {
            return;
        }
        switch ( $buddyform['form_type'] ) {
            case 'post':
                $this->validate_post_form( $buddyform );
                break;
            case 'registration':
                $this->validate_registration_form( $buddyform );
                break;
        }
    }
    
    public function validate_registration_form( $buddyform )
    {
        $users_can_register = false;
        
        if ( is_multisite() ) {
            $users_can_register = users_can_register_signup_filter();
        } else {
            $users_can_register = get_site_option( 'users_can_register' );
        }
        
        
        if ( empty($users_can_register) ) {
            $messages = array();
            $messages[] = __( 'Registration is disabled on your site. Please enable registration if you like to use this form for registration purpose. You can still use it to update existing Users. <a href="/wp-admin/options-general.php">Set</a> registration to Anyone can register.', 'buddyforms' );
            $this->show_form_notices( $messages );
        }
    
    }
    
    public function validate_post_form( $buddyform )
    {
        //
        // OK let us start with the form validation
        //
        $messages = array();
        if ( !isset( $buddyform['post_type'] ) || isset( $buddyform['post_type'] ) && $buddyform['post_type'] == 'bf_submissions' ) {
            $messages[] = __( 'No Post Type Selected. Please select a post type', 'buddyforms' );
        }
        
        if ( isset( $buddyform['post_type'] ) ) {
            $post_types = buddyforms_get_post_types();
            if ( !isset( $post_types[$buddyform['post_type']] ) ) {
                $messages['pro'] = __( 'BuddyForms Professional is required to use this Form. You need to upgrade to the Professional Plan. The Free and Starter Versions does not support Custom Post Types <a href="edit.php?post_type=buddyforms&page=buddyforms-pricing">Go Pro Now</a>', 'buddyforms' );
            }
        }
        
        if ( isset( $buddyform['form_fields'] ) ) {
            foreach ( $buddyform['form_fields'] as $field_key => $field ) {
                if ( $field['type'] == 'taxonomy' ) {
                    $messages['pro'] = __( 'BuddyForms Professional is required to use this Form. You need to upgrade to the Professional Plan. The Free and Starter Versions does not support the required Form Elements <a href="edit.php?post_type=buddyforms&page=buddyforms-pricing">Go Pro Now</a>', 'buddyforms' );
                }
            }
        }
        $messages = apply_filters( 'buddyforms_broken_form_error_messages', $messages );
        $this->show_form_notices( $messages );
    }
    
    public function show_form_notices( $messages )
    {
        if ( !empty($messages) ) {
            include 'view/admin-notices.php';
        }
    }

}
add_action( 'admin_notices', 'buddyforms_settings_missing_admin_notice' );
function buddyforms_settings_missing_admin_notice()
{
    $buddyforms_close_submissions_page = get_option( 'close_submission_default_page_notification' );
    $buddyforms_submissions_page = get_option( 'buddyforms_submissions_page' );
    // Check if the submissions management page is selected in the general settings or the notification was dismissed
    
    if ( (empty($buddyforms_submissions_page) || $buddyforms_submissions_page == 'none') && empty($buddyforms_close_submissions_page) ) {
        ?>
        <div id="buddyforms_submission_default_page" class="notice notice-error is-dismissible">
            <p><?php 
        _e( 'BuddyForms Submissions Page Missing!', 'buddyforms' );
        ?></p>
            <p><?php 
        _e( 'Please select a default page for your submissions in the BuddyForms general settings ', 'buddyforms' );
        ?><a href="<?php 
        menu_page_url( 'buddyforms_settings' );
        ?>"><?php 
        _e( 'Select the Page Now!', 'buddyforms' );
        ?></a></p>
        </div>
		<?php 
    }

}
