<?php

class URE_Uninstall {
    
    protected $lib = null;
    protected $options = null;
    protected $own_caps = null;
    
    public function __construct() {
    
        $this->lib = URE_Lib::get_instance();
        $this->init_options_list();
        $this->own_caps = array_keys( URE_Own_Capabilities::get_caps() );
        
    }
    // end of __construct()
    
    
    protected function init_options_list() {
        
        $this->options = array();
        $this->options[] = 'ure_caps_readable';
        $this->options[] = 'ure_show_deprecated_caps';
        $this->options[] = 'ure_hide_pro_banner';
        $this->options[] = 'ure_role_additional_options_values';
        $this->options[] = 'ure_task_queue';
        $this->options[] = 'user_role_editor';
        
    }
    // end fo init_options_list()
    
    
    private function delete_options() {
        global $wpdb;

        $backup_option_name = $wpdb->prefix . 'backup_user_roles';
        delete_option( $backup_option_name );
        foreach ( $this->options as $option_name ) {
            delete_option( $option_name );
        }
        
    }
    // end of delete_options()

                
    private function delete_caps() {
        
                
        $wp_roles = wp_roles();
        if ( $wp_roles->use_db ) {
            $wp_roles->use_db = false;  // minimize database update requests
            $use_db = true;
        } else {
            $use_db = false;
        }
        
        foreach( $wp_roles->roles as $role_id=>$role ) {
            foreach( $this->own_caps as $cap ) {
                if ( isset( $role['capabilities'][ $cap ]) ) {
                    $wp_roles->remove_cap( $role_id, $cap );
                }
            }
        }
                
        if ( $use_db ) {    // save changes to the database
            $wp_roles->add_cap( 'subscriber', 'dummy_cap' );
            $wp_roles->use_db = true;   // restore original value
            $wp_roles->remove_cap( 'subscriber', 'dummy_cap' );
        }
        
    }
    // end of delete_caps()
    
    
    public function act() {
        global $wpdb;
        
        if ( !is_multisite() ) {
            $this->delete_options();
            $this->delete_caps();
        } else {
            $old_blog = $wpdb->blogid;
            $blog_ids = $this->lib->get_blog_ids();
            foreach ( $blog_ids as $blog_id ) {
                switch_to_blog( $blog_id );
                $this->delete_options();
                $this->delete_caps();
            }
            $this->lib->restore_after_blog_switching( $old_blog );
        }
    }
    // end of act()
    
}
// end of class URE_Uninstall
