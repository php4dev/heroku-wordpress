<?php
/**
 * Project: User Role Editor plugin
 * Author: Vladimir Garagulya
 * Author email: support@role-editor.com
 * Author URI: https://www.role-editor.com
 * License: GPL v2+
 * 
 * Assign multiple roles to the list of selected users directly from the "Users" page
 * Grant/Revoke single role to/from selected users 
 */

class URE_Grant_Roles {

    const NO_ROLE_FOR_THIS_SITE = 'no-role-for-this-site';
    
    private $lib = null;
    private static $counter = 0;
    
    
    public function __construct() {
        
        $this->lib = URE_Lib::get_instance();        
        
        add_action( 'load-users.php', array( $this, 'load' ) );                
                
    }
    // end of __construct()
    
    
    public function load() {
        
        add_action('restrict_manage_users', array($this, 'show_roles_manage_html') );
        add_action('admin_head', array(User_Role_Editor::get_instance(), 'add_css_to_users_page') );
        add_action('admin_enqueue_scripts', array($this, 'load_js') );
        
        $this->update_roles();  
        
    }
    // end of load()
            
    
    private static function validate_users($users) {
        
        if (!is_array($users)) {
            return false;
        }
        
        foreach ($users as $user_id) {
            if (!is_numeric($user_id)) {
                return false;
            }
            if ( !current_user_can( 'promote_user', $user_id ) ) {
                return false;
            }

            if ( is_multisite() && !is_user_member_of_blog( $user_id ) ) {
                return false;
            }

        }
        
        return true;
    }
    // end of validate_users()            
    
    
    private function add_role( $users ) {
        
        if ( !empty( $_REQUEST['ure_add_role'] ) ) {
            $role = $_REQUEST['ure_add_role'];
        } else {
            $role = $_REQUEST['ure_add_role_2'];
        }

        if ( !self::validate_roles( array($role=>$role) ) ) {
            return;
        }
        
        $done = false;
        foreach( $users as $user_id ) {
            $user = get_user_by( 'id', $user_id );
            if (empty( $user ) ) {
                continue;
            }
            if ( empty($user->roles) || !in_array( $role, $user->roles ) ) {
                $user->add_role( $role );
                $done = true;
            }
        }
        
        if ( $done ) {
            // Redirect to the users screen.
            if ( wp_redirect( add_query_arg( 'update', 'promote', 'users.php' ) ) ) {
                 exit;
            }
        }
    }
    // end of add_role()
    
    
    private function is_try_remove_admin_from_himself( $user_id, $role) {

        $result = false;
        
        $current_user = wp_get_current_user();
        $wp_roles = wp_roles();
        $role_caps = array_keys( $wp_roles->roles[$role]['capabilities'] );
      	$is_current_user = ( $user_id == $current_user->ID );
        $role_can_promote = in_array('promote_users', $role_caps);
        $can_manage_network = is_multisite() && current_user_can( 'manage_network_users' );

        // If the removed role has the `promote_users` cap and user is removing it from himself
        if ( $is_current_user && $role_can_promote && !$can_manage_network ) {
            $result = true;

            // Loop through the current user's roles.
            foreach ($current_user->roles as $_role) {
                $_role_caps = array_keys( $wp_roles->roles[$_role]['capabilities'] );
                // If the current user has another role that can promote users, it's safe to remove the role.  Else, the current user should to keep this role.                
                if ( ($role!==$_role) && in_array( 'promote_users', $_role_caps ) ) {
                    $result = false;
                    break;
                }
            }

        }
        
        return $result;
    }
    
    
    private function revoke_role( $users ) {
        
        if ( !empty( $_REQUEST['ure_revoke_role'] ) ) {
            $role = $_REQUEST['ure_revoke_role'];
        } else {
            $role = $_REQUEST['ure_revoke_role_2'];
        }

        if ( !self::validate_roles( array($role=>$role) ) ) {
            return;
        }
         
        $done = false;
        foreach( $users as $user_id ) {
            $user = get_user_by( 'id', $user_id );
            if (empty( $user ) ) {
                continue;
            }
            if ($this->is_try_remove_admin_from_himself( $user_id, $role ) ) {
                continue;
            }
            if ( is_array($user->roles) && in_array( $role, $user->roles ) ) {
                $user->remove_role( $role );
                $done = true;
            }
        }
        if ( $done ) {
            if ( wp_redirect( add_query_arg( 'update', 'promote', 'users.php' ) ) ) {
                exit;
            }
        }
    }
    // end of revoke_role()


    private function update_roles() {        
                
        if ( empty( $_REQUEST['users'] ) ) {
            return;
        }
        
        if ( !current_user_can('promote_users') ) {            
            return;
        }
        $users = (array) $_REQUEST['users'];
        if ( !self::validate_users( $users ) ) {
            return;
        }
        
        if ( ( !empty( $_REQUEST['ure_add_role'] ) && !empty( $_REQUEST['ure_add_role_submit']) ) || 
             ( !empty( $_REQUEST['ure_add_role_2'] ) && !empty( $_REQUEST['ure_add_role_submit_2'] ) ) ) {
            $this->add_role( $users );
        } else if ( ( !empty( $_REQUEST['ure_revoke_role'] ) && !empty( $_REQUEST['ure_revoke_role_submit'] ) ) || 
                    ( !empty( $_REQUEST['ure_revoke_role_2'] ) && !empty( $_REQUEST['ure_revoke_role_submit_2'] ) ) ) {
            $this->revoke_role( $users );
        }
    }
    // end of update_roles()
    
    
    private static function validate_roles($roles) {

        if (!is_array($roles)) {
            return false;
        }
        
        $lib = URE_Lib::get_instance();
        $editable_roles = $lib->get_all_editable_roles();
        $valid_roles = array_keys($editable_roles);
        foreach($roles as $role) {
            if (!in_array($role, $valid_roles)) {
                return false;
            }
        }
        
        return true;        
    }
    // end of validate_roles()
        
    
    private static function grant_primary_role_to_user($user_id, $role) {
                        
        $user = get_user_by('id', $user_id);
        if (empty($user)) {
            return;
        }
                     
        if ($role===self::NO_ROLE_FOR_THIS_SITE) {
            $role = '';
        }
        $old_roles = $user->roles;  // Save currently granted roles to restore from them the bbPress roles later if there are any...
        $user->set_role($role); 
        
        $lib = URE_Lib::get_instance();
        $bbpress = $lib->get('bbpress');
        if (empty($bbpress)) {
            return;
        }
        
        $bbp_roles = $bbpress->extract_bbp_roles($old_roles);
        if (count($bbp_roles)>0) {  //  restore bbPress roles
            foreach($bbp_roles as $role) {
                $user->add_role($role);
            }        
        }        
        
    }
    // end of grant_primary_role_to_user()
            
    
    private static function grant_other_roles_to_user($user_id, $roles) {
                        
        $user = get_user_by('id', $user_id);
        if (empty($user)) {
            return;
        }
        
        $roles_list = array_values( $user->roles );
        $primary_role = array_shift( $roles_list );    // Get the 1st element from the roles array
        $lib = URE_Lib::get_instance();
        $bbpress = $lib->get( 'bbpress' );
        if ( empty( $bbpress ) ) {
            $bbp_roles = array();
        } else {
            $bbp_roles = $bbpress->extract_bbp_roles( $user->roles );
        }
        $user->remove_all_caps();
        $roles = array_merge(array( $primary_role ), $bbp_roles, $roles );
        foreach( $roles as $role ) {
            $user->add_role( $role );
        }
        
    }
    // end of grant_other_roles_to_user()
    
    
    /**
     * Decide if primary role should be granted or left as it is
     * 
     * @param string $primary_role
     * @return boolean
     */
    private static function is_select_primary_role($primary_role) {
        
        if (empty($primary_role)) {
            return false;   // Primary role was not selected by user, leave an older one
        }
        
        $lib = URE_Lib::get_instance();
        if ($lib->is_super_admin()) {
            $select_primary_role = true;
        } else {
            $select_primary_role = apply_filters('ure_users_select_primary_role', true);
        }
        
        return $select_primary_role;
    }
    // end of is_select_primary_role()
    
    
    public static function grant_roles() {

        if ( !current_user_can('promote_users') ) {
            $answer = array('result'=>'error', 'message'=>esc_html__('Not enough permissions', 'user-role-editor'));
            return $answer;
        }
                
        $users = $_POST['users'];        
        if (!self::validate_users($users)) {
            $answer = array('result'=>'error', 'message'=>esc_html__('Can not edit user or invalid data at the users list', 'user-role-editor'));
            return $answer;
        }

// Primary role       
        $primary_role = $_POST['primary_role'];        
        if (!empty($primary_role) && ($primary_role!==self::NO_ROLE_FOR_THIS_SITE) && 
            !self::validate_roles(array($primary_role=>$primary_role))) {
            $answer = array('result'=>'error', 'message'=>esc_html__('Invalid primary role', 'user-role-editor'));
            return $answer;
        }
                
        if (self::is_select_primary_role($primary_role)) {            
            foreach ($users as $user_id) {                
                self::grant_primary_role_to_user($user_id, $primary_role);
            }            
        }
        
// Other roles        
        $other_roles = isset($_POST['other_roles']) ? $_POST['other_roles'] : null;
        if (!empty($other_roles) && !self::validate_roles($other_roles)) {
            $answer = array('result'=>'error', 'message'=>esc_html__('Invalid data at the other roles list', 'user-role-editor'));
            return $answer;
        }
        
        if (!empty($other_roles)) {
            foreach($users as $user_id) {
                self::grant_other_roles_to_user($user_id, $other_roles); 
            }                
        }
        $answer = array('result'=>'success', 'message'=>esc_html__('Roles were granted to users successfully', 'user-role-editor'));
        
        return $answer;
    }
    // end of grant_roles()
    
    
    public static function get_user_roles() {

        if ( !current_user_can( 'promote_users' ) ) {
            $answer = array('result'=>'error', 'message'=>esc_html__('Not enough permissions', 'user-role-editor'));
            return $answer;
        }
        
        $lib = URE_Lib::get_instance();
        $user_id = (int) $lib->get_request_var('user_id', 'post', 'int');
        if (empty($user_id)) {
            $answer = array('result'=>'error', 'message'=>esc_html__('Wrong request, valid user ID was missed', 'user-role-editor'));
            return $answer;
        }
    
        $user = get_user_by('id', $user_id);
        if (empty($user)) {
            $answer = array('result'=>'error', 'message'=>esc_html__('Requested user does not exist', 'user-role-editor'));
            return $answer;
        }
        
        $other_roles = array_values($user->roles);
        $primary_role = array_shift($other_roles);
        
        $answer = array('result'=>'success', 'primary_role'=>$primary_role, 'other_roles'=>$other_roles);
        
        return $answer;
    }
    // end of get_user_roles()
    
    
    
    private function select_primary_role_html() {
        
        $select_primary_role = apply_filters('ure_users_select_primary_role', true);
        if (!$select_primary_role && !$this->lib->is_super_admin()) {
            return;
        }
?>        
        <span style="font-weight: bold;">
            <?php esc_html_e('Primary Role: ', 'role-editor');?> 
        </span>
        <select name="primary_role" id="primary_role">
<?php            
        // print the full list of roles with the primary one selected.
        wp_dropdown_roles('');
        echo '<option value="'. self::NO_ROLE_FOR_THIS_SITE .'">' . esc_html__('&mdash; No role for this site &mdash;') . '</option>'. PHP_EOL;
?>        
        </select>
        <hr/>
<?php        
    }
    // end of select_primary_role_html()
            
    
    private function select_other_roles_html() {
?>        
        <div id="other_roles_container">
            <span style="font-weight: bold;">
<?php          
        esc_html_e('Other Roles: ', 'role-editor');
?>        
        </span><br>
<?php        
        $show_admin_role = $this->lib->show_admin_role_allowed();        
        $roles = $this->lib->get_all_editable_roles(); 
        ksort( $roles );
        foreach ($roles as $role_id => $role) {
            if (!$show_admin_role && $role_id=='administrator') {
                continue;
            }
            echo '<label for="wp_role_' . $role_id . '"><input type="checkbox"	id="wp_role_' . $role_id .
                 '" name="ure_roles[]" value="' . $role_id . '" />&nbsp;' .
            esc_html__($role['name'], 'user-role-editor') .' ('. $role_id .')</label><br />'. PHP_EOL;            
        }
?>
        </div>
<?php        
    }
    // end of select_other_roles_html()
    
    
    private function get_roles_options_list() {
        
        ob_start();
        wp_dropdown_roles();
        $output = ob_get_clean();
        
        return $output;
    }
    // end of get_roles_options_list()
    
    
    public function show_roles_manage_html() {
                      
        if ( !current_user_can( 'promote_users' ) ) {
            return;
        }
        $button_number =  (self::$counter>0) ? '_2': '';
        $roles_options_list = self::get_roles_options_list();
?>        
        &nbsp;&nbsp;
        <input type="button" name="ure_grant_roles<?php echo $button_number;?>" id="ure_grant_roles<?php echo $button_number;?>" class="button"                               
             value="<?php esc_html_e('Grant Roles', 'user-role-editor');?>">
        &nbsp;&nbsp;        
        <label class="screen-reader-text" for="ure_add_role<?php echo $button_number;?>"><?php esc_html_e( 'Add role&hellip;', 'user-role-editor' ); ?></label>
        <select name="ure_add_role<?php echo $button_number;?>" id="ure_add_role<?php echo $button_number;?>" style="display: inline-block; float: none;">
            <option value=""><?php esc_html_e( 'Add role&hellip;', 'user-role-editor' ); ?></option>
            <?php echo $roles_options_list; ?>
        </select>
	<?php submit_button( esc_html__( 'Add', 'user-role-editor' ), 'secondary', 'ure_add_role_submit'.$button_number, false ); ?>
        &nbsp;&nbsp;
        <label class="screen-reader-text" for="ure_revoke_role<?php echo $button_number;?>"><?php esc_html_e( 'Revoke role&hellip;', 'user-role-editor' ); ?></label>
        <select name="ure_revoke_role<?php echo $button_number;?>" id="ure_revoke_role<?php echo $button_number;?>" style="display: inline-block; float: none;">
            <option value=""><?php esc_html_e( 'Revoke role&hellip;', 'user-role-editor' ); ?></option>
            <?php echo $roles_options_list; ?>
        </select>
	<?php submit_button( esc_html__( 'Revoke', 'user-role-editor' ), 'secondary', 'ure_revoke_role_submit'.$button_number, false ); ?>

        
<?php
    if (self::$counter==0) {
?>
            <div id="ure_grant_roles_dialog" class="ure-dialog">
                <div id="ure_grant_roles_content">
<?php                
                $this->select_primary_role_html();
                $this->select_other_roles_html();
?>                
                </div>
            </div>
<?php
        URE_View::output_task_status_div();
        self::$counter++;
    }
        
    }
    // end of show_grant_roles_html()
    
    
    public function load_js() {

        $show_wp_change_role = apply_filters('ure_users_show_wp_change_role', true);
        
        wp_enqueue_script('jquery-ui-dialog', '', array('jquery-ui-core','jquery-ui-button', 'jquery') );
        wp_register_script('ure-users-grant-roles', plugins_url('/js/users-grant-roles.js', URE_PLUGIN_FULL_PATH));
        wp_enqueue_script('ure-users-grant-roles', '', array(), false, true);
        wp_localize_script('ure-users-grant-roles', 'ure_users_grant_roles_data', array(
            'wp_nonce' => wp_create_nonce('user-role-editor'),
            'dialog_title'=> esc_html__('Grant roles to selected users', 'user-role-editor'),
            'select_users_first' => esc_html__('Select users to which you wish to grant roles!', 'user-role-editor'),
            'select_roles_first' => esc_html__('Select role(s) which you wish to grant!', 'user-role-editor'),
            'show_wp_change_role' => $show_wp_change_role ? 1: 0
        ));
    }
    // end of load_js()
    
}
// end of URE_Grant_Roles class
