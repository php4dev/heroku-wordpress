<?php

/*
 * User Role Editor WordPress plugin
 * Author: Vladimir Garagulya
 * Email: support@role-editor.com
 * License: GPLv2 or later
 */


/**
 * Process AJAX request from User Role Editor
 *
 * @author vladimir
 */
class URE_Ajax_Processor {

    protected $lib = null;
    protected $action = null;    
    protected $debug = null;

    
    public function __construct( ) {
        
        $this->lib = URE_Lib::get_instance();
        $this->debug = ( defined('WP_PHP_UNIT_TEST') && WP_PHP_UNIT_TEST==true );
        
    }
    // end of __construct()
    
    
    protected function get_action() {
        $action = $this->lib->get_request_var( 'sub_action', 'post' );
        if (empty($action)) {
            $action = $this->lib->get_request_var( 'sub_action', 'get' );
        }
                
        return $action;
    }
    // end of get_action()
    
    
    protected function get_required_cap() {
        
        if ($this->action=='grant_roles' || $this->action=='get_user_roles') {
            $cap = 'promote_users';
        } else {
            $cap = URE_Own_Capabilities::get_key_capability();
        }
        
        return $cap;
    }
    // end of get_required_cap()
    
    
    protected function valid_nonce() {
        
        if ( !isset($_REQUEST['wp_nonce']) || !wp_verify_nonce( $_REQUEST['wp_nonce'], 'user-role-editor' ) ) {
            echo json_encode(array('result'=>'error', 'message'=>'URE: Wrong or expired request'));
            return false;
        } else {
            return true;
        }
        
    }
    // end of check_nonce()
    
    
    protected function user_can() {
        
        $capability = $this->get_required_cap();                
        if ( !current_user_can( $capability ) ) {
            echo json_encode( array('result'=>'error', 'message'=>'URE: Insufficient permissions') );
            return false;
        } else {
            return true;
        }
    }
    // end of check_user_cap()
            
    
    protected function add_role() {
        
        $editor = URE_Editor::get_instance();
        $response = $editor->add_new_role();
        
        $answer = array(
            'result'=>$response['result'], 
            'role_id'=>$response['role_id'],  
            'role_name'=>$response['role_name'],
            'message'=>$response['message']
                );
        
        return $answer;
    }
    // end of add_role()
    
    
    protected function add_capability() {
        
        $notification = URE_Capability::add( 'role' );
        $editor = URE_Editor::get_instance();
        $editor->init1();
        $message = $editor->init_current_role_name();
        if (empty( $message ) ) {
            $view = new URE_View();        
            $html = $view->_show_capabilities( true, true );
        } else {
            $html = '';
        }
        
        $answer = array('result'=>'success', 'html'=>$html, 'message'=>$notification);
        
        return $answer;
    }
    // end of add_capability()
    
    
    protected function delete_capability() {
        
        $result = URE_Capability::delete();
        if ( is_array( $result ) ) {
            $notification = $result['message'];
            $deleted_caps = $result['deleted_caps'];
        } else {
            $notification = $result;
            $deleted_caps = array();
        }
        
        $answer = array('result'=>'success', 'deleted_caps'=>$deleted_caps, 'message'=>$notification);
        
        return $answer;
    }
    // end of delete_cap()
    

    protected function delete_role() {
        
        $editor = URE_Editor::get_instance();
        $response = $editor->delete_role(); 
        $answer = array(
            'result'=>$response['result'], 
            'message'=>$response['message'], 
            'deleted_roles'=> $response['deleted_roles']
                );
        
        return $answer;
    }
    // end of delete_role()
    
    
    protected function rename_role() {
        
        $editor = URE_Editor::get_instance();
        $response = $editor->rename_role();
        $answer = array(
            'result'=>$response['result'], 
            'message'=>$response['message'], 
            'role_id'=> $response['role_id'],
            'role_name'=>$response['role_name']
                );
        
        return $answer;
    }
    // end of rename_role()

    
    protected function get_caps_to_remove() {
    
        $html = URE_Role_View::caps_to_remove_html();
        $answer = array('result'=>'success', 'html'=>$html, 'message'=>'success');
        
        return $answer;
    }
    // end of get_caps_to_remove()
    
                
    protected function get_users_without_role() {
        
        $new_role = $this->lib->get_request_var( 'new_role', 'post' );
        if (empty($new_role)) {
            $answer = array('result'=>'error', 'message'=>'Provide new role');
            return $answer;
        }
        
        $assign_role = $this->lib->get_assign_role();
        if ($new_role==='no_rights') {
            $assign_role->create_no_rights_role();
        }        
        
        $wp_roles = wp_roles();        
        if (!isset($wp_roles->roles[$new_role])) {
            $answer = array('result'=>'error', 'message'=>'Selected new role does not exist');
            return $answer;
        }
                
        $users = $assign_role->get_users_without_role();        
        $answer = array( 'result'=>'success', 'users'=>$users, 'new_role'=>$new_role, 'message'=>'success' );
        
        return $answer;
    }
    // end of get_users_without_role()
    
    
    protected function grant_roles() {
        
        $answer = URE_Grant_Roles::grant_roles();
        
        return $answer;
        
    }
    // end of grant_roles()
    
    
    protected function get_user_roles() {
        
        $answer = URE_Grant_Roles::get_user_roles();
        
        return $answer;
        
    }
    // end of get_user_roles()
    
    
    protected function get_role_caps() {
        
        $role = $this->lib->get_request_var('role', 'post' );
        if (empty($role)) {
            $answer = array('result'=>'error', 'message'=>'Provide role ID');
            return $answer;
        }
        
        $wp_roles = wp_roles();
        if (!isset($wp_roles->roles[$role])) {
            $answer = array('result'=>'error', 'message'=>'Requested role does not exist');
            return $answer;
        }
        
        $active_items = URE_Role_Additional_Options::get_active_items();
        if (isset($active_items[$role])) {
            $role_options = $active_items[$role];
        } else {
            $role_options = array();
        }
        
        $caps = array();
        foreach( $wp_roles->roles[$role]['capabilities'] as $cap_id=>$allowed ) {
            $cap = URE_Capability::escape( $cap_id );
            $caps[$cap] = $allowed;
        }
        
        $answer = array(
            'result'=>'success', 
            'message'=>'Role capabilities retrieved successfully', 
            'role_id'=>$role,
            'role_name'=>$wp_roles->roles[$role]['name'],
            'caps'=>$caps,
            'options'=>$role_options
            );
        
        return $answer;
    }
    // end of get_role_caps()


    protected function hide_pro_banner() {
        
        $this->lib->put_option('ure_hide_pro_banner', 1);	
        $this->lib->flush_options();
        
        $answer = array(
            'result'=>'success', 
            'message'=>'Pro banner was hidden'
            );
        
        return $answer;
    }
    // end of hide_pro_banner()
    
    
    protected function _dispatch() {
        
        switch ($this->action) {
            case 'add_role':
                $answer = $this->add_role();
                break;
            case 'add_capability':
                $answer = $this->add_capability();
                break;
            case 'delete_capability':
                $answer = $this->delete_capability();
                break;
            case 'delete_role':
                $answer = $this->delete_role();
                break;
            case 'get_caps_to_remove':
                $answer = $this->get_caps_to_remove();
                break;
            case 'get_users_without_role':
                $answer = $this->get_users_without_role();
                break;
            case 'grant_roles':
                $answer = $this->grant_roles();
                break;
            case 'get_user_roles':
                $answer = $this->get_user_roles();
                break;
            case 'get_role_caps': 
                $answer = $this->get_role_caps();
                break;            
            case 'rename_role':
                $answer = $this->rename_role();
                break;
            case 'hide_pro_banner':
                $answer = $this->hide_pro_banner();
                break;            
            default:
                $answer = array('result' => 'error', 'message' => 'Unknown action "' . $this->action . '"');
        }
        
        return $answer;
    }
    // end of _dispatch()
    
    
    /**
     * AJAX requests dispatcher
     */    
    public function dispatch() {
        
        $this->action = $this->get_action();
        if ( !$this->valid_nonce() || !$this->user_can() ) {
            die;
        }
        
        $answer = $this->_dispatch();
        
        $json_answer = json_encode($answer);
        echo $json_answer;
        die;

    }
    // end of dispatch()
    
}
// end of URE_Ajax_Processor
