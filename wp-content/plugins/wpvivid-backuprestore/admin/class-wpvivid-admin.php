<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wpvivid.com
 * @since      0.9.1
 *
 * @package    WPvivid
 * @subpackage WPvivid/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WPvivid
 * @subpackage WPvivid/admin
 * @author     wpvivid team
 */
if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
class WPvivid_Admin {

    /**
     * The ID of this plugin.
     *
     * 
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * 
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    private $screen_ids;

    private $toolbar_menus;

    private $submenus;
    /**
     * Initialize the class and set its properties.
     *
     * 
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        add_filter('wpvivid_get_screen_ids',array($this,'get_screen_ids'),10);
        add_filter('wpvivid_get_toolbar_menus',array($this,'get_toolbar_menus'),10);
        add_filter('wpvivid_get_admin_menus',array($this,'get_admin_menus'),10);
        add_filter('wpvivid_add_side_bar', array($this, 'wpvivid_add_side_bar'), 10, 2);

        add_action('wpvivid_before_setup_page',array($this,'migrate_notice'));
        add_action('wpvivid_before_setup_page',array($this,'show_add_my_review'));
        add_action('wpvivid_before_setup_page',array($this,'check_extensions'));
        add_action('wpvivid_before_setup_page',array($this,'check_amazons3'));
        add_action('wpvivid_before_setup_page',array($this,'init_js_var'));

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function get_screen_ids($screen_ids)
    {
        $screen_ids[]='toplevel_page_'.$this->plugin_name;
        $screen_ids[]='wpvivid-backup_page_wpvivid-transfer';
        $screen_ids[]='wpvivid-backup_page_wpvivid-setting';
        $screen_ids[]='wpvivid-backup_page_wpvivid-schedule';
        $screen_ids[]='wpvivid-backup_page_wpvivid-remote';
        $screen_ids[]='wpvivid-backup_page_wpvivid-website';
        $screen_ids[]='wpvivid-backup_page_wpvivid-log';
        $screen_ids[]='wpvivid-backup_page_wpvivid-key';
        $screen_ids[]='wpvivid-backup_page_wpvivid-mainwp';
        return $screen_ids;
    }

    public function get_toolbar_menus($toolbar_menus)
    {
        $menu['id']='wpvivid_admin_menu';
        $menu['title']='WPvivid Backup';
        $toolbar_menus[$menu['id']]=$menu;

        $admin_url = admin_url();

        $menu['id']='wpvivid_admin_menu_backup';
        $menu['parent']='wpvivid_admin_menu';
        $menu['title']='Backup & Restore';
        $menu['tab']='admin.php?page=WPvivid&tab-backup';
        $menu['href']=$admin_url . 'admin.php?page=WPvivid&tab-backup';
        $menu['capability']='administrator';
        $menu['index']=1;
        $toolbar_menus[$menu['parent']]['child'][$menu['id']]=$menu;

        return $toolbar_menus;
    }

    public function get_admin_menus($submenus)
    {
        $submenu['parent_slug']=$this->plugin_name;
        $submenu['page_title']=__('WPvivid Backup');
        $submenu['menu_title']=__('Backup & Restore', 'wpvivid');
        $submenu['capability']='administrator';
        $submenu['menu_slug']=$this->plugin_name;
        $submenu['function']=array($this, 'display_plugin_setup_page');
        $submenu['index']=1;
        $submenus[$submenu['menu_slug']]=$submenu;

        $submenu['parent_slug']=$this->plugin_name;
        $submenu['page_title']=__('WPvivid Backup');
        $submenu['menu_title']=__('Settings', 'wpvivid');
        $submenu['capability']='administrator';
        $submenu['menu_slug']='wpvivid-setting';
        $submenu['function']=array($this, 'display_plugin_setup_page');
        $submenu['index']=5;
        $submenus[$submenu['menu_slug']]=$submenu;

        return $submenus;
    }

    public function wpvivid_add_side_bar($html, $show_schedule = false){
        $wpvivid_version = WPVIVID_PLUGIN_VERSION;
        $wpvivid_version = apply_filters('wpvivid_display_pro_version', $wpvivid_version);
        $join_pro_testing = '<div class="postbox">
                            <h2><a href="https://wpvivid.com/pro-version-beta-testing?utm_source=client_beta_testing&utm_medium=inner_link&utm_campaign=access" style="text-decoration: none;">WPvivid Backup Pro Beta Testing</a></h2>
                         </div>';
        $join_pro_testing = apply_filters('wpvivid_join_pro_testing', $join_pro_testing);

        $schedule_html = '';
        if($show_schedule){
            $schedule_html = apply_filters('wpvivid_schedule_module', $schedule_html);
        }

        $html = '<div class="postbox">
                <h2>
                    <div style="float: left; margin-right: 5px;"><span style="margin: 0; padding: 0">Current Version: '.$wpvivid_version.'</span></div>
                    <div style="float: left; margin-right: 5px;"><span style="margin: 0; padding: 0">|</span></div>
                    <div style="float: left; margin-left: 0;">
                        <span style="margin: 0; padding: 0"><a href="https://wordpress.org/plugins/wpvivid-backuprestore/#developers" target="_blank" style="text-decoration: none;">ChangeLog</a></span>
                    </div>
                    <div style="clear: both;"></div>
                </h2>
             </div>
             <div id="wpvivid_backup_schedule_part"></div>
             '.$join_pro_testing.$schedule_html.'
             <div class="postbox">
                <h2><span>Troubleshooting</span></h2>
                <div class="inside">
                    <table class="widefat" cellpadding="0">
                        <tbody>
                        <tr class="alternate">
                            <td class="row-title">Read <a href="https://wpvivid.com/troubleshooting-issues-wpvivid-backup-plugin" target="_blank">Troubleshooting page</a> for faster solutions.</td>
                        </tr>
                        <tr>
                            <td class="row-title">Adjust <a href="https://wpvivid.com/wpvivid-backup-plugin-advanced-settings.html" target="_blank">Advanced Settings</a> for higher task success rate.</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
             </div>
             <div class="postbox">
                <h2><span>How-to</span></h2>
                <div class="inside">
                    <table class="widefat" cellpadding="0">
                        <tbody>
                            <tr class="alternate"><td class="row-title"><a href="https://wpvivid.com/get-started-settings.html" target="_blank">WPvivid Backup Settings</a></td></tr>
                            <tr><td class="row-title"><a href="https://wpvivid.com/get-started-create-a-manual-backup.html" target="_blank">Create a Manual Backup</a></td></tr>
                            <tr class="alternate"><td class="row-title"><a href="https://wpvivid.com/get-started-restore-site.html" target="_blank">Restore Your Site from a Backup</a></td></tr>
                            <tr><td class="row-title"><a href="https://wpvivid.com/get-started-transfer-site.html" target="_blank">Migrate WordPress</a></td></tr>
                        </tbody>
                    </table>
                </div>
             </div>';
        return $html;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * 
     */
    public function enqueue_styles()
    {
        $this->screen_ids=apply_filters('wpvivid_get_screen_ids',$this->screen_ids);

        if(in_array(get_current_screen()->id,$this->screen_ids))
        {
            wp_enqueue_style($this->plugin_name, WPVIVID_PLUGIN_DIR_URL . 'css/wpvivid-admin.css', array(), $this->version, 'all');
            do_action('wpvivid_do_enqueue_styles');
        }
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * 
     */
    public function enqueue_scripts()
    {
        $this->screen_ids=apply_filters('wpvivid_get_screen_ids',$this->screen_ids);

        if(in_array(get_current_screen()->id,$this->screen_ids))
        {
            wp_enqueue_script($this->plugin_name, WPVIVID_PLUGIN_DIR_URL . 'js/wpvivid-admin.js', array('jquery'), $this->version, false);
            wp_localize_script($this->plugin_name, 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

            wp_enqueue_script('plupload-all');
            do_action('wpvivid_do_enqueue_scripts');
        }
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * 
     */
    public function add_plugin_admin_menu()
    {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
        $menu['page_title']=__('WPvivid Backup');
        $menu['menu_title']=__('WPvivid Backup');
        $menu['capability']='administrator';
        $menu['menu_slug']= $this->plugin_name;
        $menu['function']=array($this, 'display_plugin_setup_page');
        $menu['icon_url']='dashicons-cloud';
        $menu['position']=100;
        $menu = apply_filters('wpvivid_get_main_admin_menus', $menu);

        add_menu_page( $menu['page_title'],$menu['menu_title'], $menu['capability'], $menu['menu_slug'], $menu['function'], $menu['icon_url'], $menu['position']);
        $this->submenus = apply_filters('wpvivid_get_admin_menus', $this->submenus);

        usort($this->submenus, function ($a, $b) {
            if ($a['index'] == $b['index'])
                return 0;

            if ($a['index'] > $b['index'])
                return 1;
            else
                return -1;
        });

        foreach ($this->submenus as $submenu) {
            add_submenu_page(
                $submenu['parent_slug'],
                $submenu['page_title'],
                $submenu['menu_title'],
                $submenu['capability'],
                $submenu['menu_slug'],
                $submenu['function']);
        }
    }

    function add_toolbar_items($wp_admin_bar)
    {
        global $wpvivid_plugin;
        if(is_admin())
        {
            $show_admin_bar = $wpvivid_plugin->get_admin_bar_setting();
            if ($show_admin_bar === true)
            {
                $this->toolbar_menus = apply_filters('wpvivid_get_toolbar_menus', $this->toolbar_menus);
                foreach ($this->toolbar_menus as $menu)
                {
                    $wp_admin_bar->add_menu(array(
                        'id' => $menu['id'],
                        'title' => $menu['title']
                    ));
                    if (isset($menu['child']))
                    {
                        usort($menu['child'], function ($a, $b)
                        {
                            if($a['index']==$b['index'])
                                return 0;

                            if($a['index']>$b['index'])
                                return 1;
                            else
                                return -1;
                        });
                        foreach ($menu['child'] as $child_menu) {
                            if(isset($child_menu['capability']) && current_user_can($child_menu['capability'])) {
                                $wp_admin_bar->add_menu(array(
                                    'id' => $child_menu['id'],
                                    'parent' => $menu['id'],
                                    'title' => $child_menu['title'],
                                    'href' => $child_menu['href']
                                ));
                            }
                        }
                    }
                }
            }
        }
    }

    public function add_action_links( $links )
    {
        $settings_link = array(
            '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge(  $settings_link, $links );
    }

    public static function wpvivid_get_siteurl(){
        $wpvivid_siteurl = array();
        $wpvivid_siteurl['home_url'] = home_url();
        $wpvivid_siteurl['plug_url'] = plugins_url();
        return $wpvivid_siteurl;
    }

    /**
     * Render the settings page for this plugin.
     *
     * 
     */
    public function display_plugin_setup_page()
    {
        do_action('wpvivid_before_setup_page');

        add_action('wpvivid_display_page',array($this,'display'));

        do_action('wpvivid_display_page');
    }

    public function migrate_notice()
    {
        $migrate_notice=false;
        $migrate_status=WPvivid_Setting::get_option('wpvivid_migrate_status');
        if(!empty($migrate_status) && $migrate_status == 'completed')
        {
            $migrate_notice=true;
            _e('<div class="notice notice-warning is-dismissible"><p>Migration is complete and htaccess file is replaced. In order to successfully complete the migration, you\'d better reinstall 301 redirect plugin, firewall and security plugin, and caching plugin if they exist.</p></div>');
            WPvivid_Setting::delete_option('wpvivid_migrate_status');
        }
        $restore = new WPvivid_restore_data();
        if ($restore->has_restore())
        {
            $restore_status = $restore->get_restore_status();
            if ($restore_status === WPVIVID_RESTORE_COMPLETED)
            {
                $restore->clean_restore_data();
                $need_review=WPvivid_Setting::get_option('wpvivid_need_review');
                if($need_review=='not')
                {
                    WPvivid_Setting::update_option('wpvivid_need_review','show');
                    $msg = 'Cheers! WPvivid Backup plugin has restored successfully your website. If you found WPvivid Backup plugin helpful, a 5-star rating would be highly appreciated, which motivates us to keep providing new features.';
                    WPvivid_Setting::update_option('wpvivid_review_msg',$msg);
                }
                else{
                    if(!$migrate_notice)
                    {
                        _e('<div class="notice notice-success is-dismissible"><p>Restore completed successfully.</p></div>');
                    }
                }
            }
        }
    }

    public function display()
    {
        include_once('partials/wpvivid-admin-display.php');
    }

    public static function wpvivid_get_page_request()
    {
        $request_page='wpvivid_tab_general';

        if(isset($_REQUEST['tab-backup']))
        {
            $request_page='wpvivid_tab_general';
        }
        else if(isset($_REQUEST['tab-schedule']))
        {
            $request_page='wpvivid_tab_schedule';
        }
        else if(isset($_REQUEST['tab-transfer']))
        {
            $request_page='wpvivid_tab_migrate';
        }
        else if(isset($_REQUEST['tab-remote-storage']))
        {
            $request_page='wpvivid_tab_remote_storage';
        }
        else if(isset($_REQUEST['tab-settings']))
        {
            $request_page='wpvivid_tab_setting';
        }
        else if(isset($_REQUEST['tab-website-info']))
        {
            $request_page='wpvivid_tab_debug';
        }
        else if(isset($_REQUEST['tab-logs']))
        {
            $request_page='wpvivid_tab_log';
        }
        else if(isset($_REQUEST['tab-key']))
        {
            $request_page='wpvivid_tab_key';
        }
        else if(isset($_REQUEST['tab-mainwp']))
        {
            $request_page='wpvivid_tab_mainwp';
        }
        else if(isset($_REQUEST['page'])&&$_REQUEST['page']=='wpvivid-pro')
        {
            $request_page='wpvivid_tab_pro';
        }
        else if(isset($_REQUEST['page'])&&$_REQUEST['page']=='wpvivid-setting')
        {
            $request_page='wpvivid_tab_setting';
        }

        $request_page=apply_filters('wpvivid_set_page_request',$request_page);

        return $request_page;
    }

    public static function show_add_my_review()
    {
        $review = WPvivid_Setting::get_option('wpvivid_need_review');
        $review_msg = WPvivid_Setting::get_option('wpvivid_review_msg');
        if (empty($review))
        {
            WPvivid_Setting::update_option('wpvivid_need_review', 'not');
        } else {
            if ($review == 'not')
            {
            }
            else if ($review == 'show')
            {
                if(!empty($review_msg))
                {
                    _e('<div class="notice notice-info is-dismissible" id="wpvivid_notice_rate">
                    <p>' . $review_msg . '</p>
                    <div style="padding-bottom: 10px;">
                    <span><input type="button" class="button-primary" option="review" name="rate-now" value="Rate Us" /></span>
                    <span><input type="button" class="button-secondary" option="review" name="ask-later" value="Maybe Later" /></span>
                    <span><input type="button" class="button-secondary" option="review" name="never-ask" value="Never" /></span>
                    </div>
                    </div>');
                }
            } else if ($review == 'do_not_ask')
            {
            } else
                {
                if (time() > $review)
                {
                    if(!empty($review_msg))
                    {
                        _e('<div class="notice notice-info is-dismissible" id="wpvivid_notice_rate">
                        <p>' . $review_msg . '</p>
                        <div style="padding-bottom: 10px;">
                        <span><input type="button" class="button-primary" option="review" name="rate-now" value="Rate Us" /></span>    
                        <span><input type="button" class="button-secondary" option="review" name="ask-later" value="Maybe Later" /></span>
                        <span><input type="button" class="button-secondary" option="review" name="never-ask" value="Never" /></span>
                        </div>
                        </div>');
                    }
                }
            }
        }
    }

    public function check_amazons3()
    {
        $remoteslist=WPvivid_Setting::get_all_remote_options();
        $need_amazons3_notice = false;
        if(isset($remoteslist) && !empty($remoteslist))
        {
            foreach ($remoteslist as $remote_id => $value)
            {
                if($remote_id === 'remote_selected')
                {
                    continue;
                }
                if($value['type'] == 'amazons3' && isset($value['s3Path']))
                {
                    $need_amazons3_notice = true;
                }
                if($value['type'] == 's3compat' && isset($value['s3directory']))
                {
                    $need_amazons3_notice = true;
                }
            }
        }
        if($need_amazons3_notice)
        {
            $amazons3_notice = WPvivid_Setting::get_option('wpvivid_amazons3_notice', 'not init');
            if($amazons3_notice === 'not init')
            {
                $notice_message = 'As Amazon S3 and DigitalOcean Space have upgraded their connection methods, please delete the previous connections and re-add your Amazon S3/DigitalOcean Space accounts to make sure the connections work.';
                _e('<div class="notice notice-warning" id="wpvivid_amazons3_notice">
                        <p>' . $notice_message . '</p>
                        <div style="padding-bottom: 10px;">
                        <span><input type="button" class="button-secondary" value="I Understand" onclick="wpvivid_click_amazons3_notice();" /></span>
                        </div>
                        </div>');
            }
        }
    }

    public function check_extensions()
    {
        $common_setting = WPvivid_Setting::get_setting(false, 'wpvivid_common_setting');
        $db_connect_method = isset($common_setting['options']['wpvivid_common_setting']['db_connect_method']) ? $common_setting['options']['wpvivid_common_setting']['db_connect_method'] : 'wpdb';
        $need_php_extensions = array();
        $need_extensions_count = 0;
        $extensions=get_loaded_extensions();
        if(!function_exists("curl_init")){
            $need_php_extensions[$need_extensions_count] = 'curl';
            $need_extensions_count++;
        }
        if(!class_exists('PDO')){
            $need_php_extensions[$need_extensions_count] = 'PDO';
            $need_extensions_count++;
        }
        if(!function_exists("gzopen"))
        {
            $need_php_extensions[$need_extensions_count] = 'zlib';
            $need_extensions_count++;
        }
        if(!array_search('pdo_mysql',$extensions) && $db_connect_method === 'pdo')
        {
            $need_php_extensions[$need_extensions_count] = 'pdo_mysql';
            $need_extensions_count++;
        }
        if(!empty($need_php_extensions)){
            $msg = '';
            $figure = 0;
            foreach ($need_php_extensions as $extension){
                $figure++;
                if($figure == 1){
                    $msg .= $extension;
                }
                else if($figure < $need_extensions_count) {
                    $msg .= ', '.$extension;
                }
                else if($figure == $need_extensions_count){
                    $msg .= ' and '.$extension;
                }
            }
            if($figure == 1){
                _e('<div class="notice notice-error"><p>The '.$msg.' extension is not detected. Please install the extension first.</p></div>');
            }
            else{
                _e('<div class="notice notice-error"><p>The '.$msg.' extensions are not detected. Please install the extensions first.</p></div>');
            }
        }

        if (!class_exists('PclZip')) include_once(ABSPATH.'/wp-admin/includes/class-pclzip.php');
        if (!class_exists('PclZip')) {
            _e('<div class="notice notice-error"><p>Class PclZip is not detected. Please update or reinstall your WordPress.</p></div>');
        }

        $hide_notice = get_option('wpvivid_hide_wp_cron_notice', false);
        if(defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON && $hide_notice === false){
            _e('<div class="notice notice-error notice-wp-cron is-dismissible"><p>In order to execute the scheduled backups properly, please set the DISABLE_WP_CRON constant to false.</p></div>');
        }
    }

    public function init_js_var()
    {
        global $wpvivid_plugin;

        $loglist=$wpvivid_plugin->get_log_list_ex();
        $remoteslist=WPvivid_Setting::get_all_remote_options();
        $default_remote_storage='';
        foreach ($remoteslist['remote_selected'] as $value)
        {
            $default_remote_storage=$value;
        }
        ?>
        <script>
            var wpvivid_siteurl = '<?php
                $wpvivid_siteurl = array();
                $wpvivid_siteurl=WPvivid_Admin::wpvivid_get_siteurl();
                echo esc_url($wpvivid_siteurl['home_url']);
                ?>';
            var wpvivid_plugurl =  '<?php
                echo WPVIVID_PLUGIN_URL;
                ?>';
            var wpvivid_log_count = '<?php
                _e(sizeof($loglist['log_list']['file']), 'wpvivid');
                ?>';
            var wpvivid_log_array = '<?php
                _e(json_encode($loglist), 'wpvivid');
                ?>';
            var wpvivid_page_request = '<?php
                $page_request = WPvivid_Admin::wpvivid_get_page_request();
                _e($page_request, 'wpvivid');
                ?>';
            var wpvivid_default_remote_storage = '<?php
                _e($default_remote_storage, 'wpvivid');
                ?>';
        </script>
        <?php
    }

    public function wpvivid_add_default_tab_page($page_array){
        $page_array['backup_restore'] = array('index' => '1', 'tab_func' => array($this, 'wpvivid_add_tab_backup_restore'), 'page_func' => array($this, 'wpvivid_add_page_backup'));
        $page_array['schedule'] = array('index' => '2', 'tab_func' => array($this, 'wpvivid_add_tab_schedule'), 'page_func' => array($this, 'wpvivid_add_page_schedule'));
        $page_array['remote_storage'] = array('index' => '4', 'tab_func' => array($this, 'wpvivid_add_tab_remote_storage'), 'page_func' => array($this, 'wpvivid_add_page_remote_storage'));
        $page_array['setting'] = array('index' => '5', 'tab_func' => array($this, 'wpvivid_add_tab_setting'), 'page_func' => array($this, 'wpvivid_add_page_setting'));
        $page_array['website_info'] = array('index' => '6', 'tab_func' => array($this, 'wpvivid_add_tab_website_info'), 'page_func' => array($this, 'wpvivid_add_page_website_info'));
        $page_array['log'] = array('index' => '7', 'tab_func' => array($this, 'wpvivid_add_tab_log'), 'page_func' => array($this, 'wpvivid_add_page_log'));
        $page_array['read_log'] = array('index' => '9', 'tab_func' => array($this, 'wpvivid_add_tab_read_log'), 'page_func' => array($this, 'wpvivid_add_page_read_log'));
        $hide_mwp_tab_page = get_option('wpvivid_hide_mwp_tab_page', false);
        if($hide_mwp_tab_page === false) {
            $page_array['mwp'] = array('index' => '30', 'tab_func' => array($this, 'wpvivid_add_tab_mwp'), 'page_func' => array($this, 'wpvivid_add_page_mwp'));
        }
        return $page_array;
    }

    public function wpvivid_add_tab_backup_restore(){
        ?>
        <a href="#" id="wpvivid_tab_general" class="nav-tab wrap-nav-tab nav-tab-active" onclick="switchTabs(event,'general-page')"><?php _e('Backup & Restore', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_schedule(){
        ?>
        <a href="#" id="wpvivid_tab_schedule" class="nav-tab wrap-nav-tab" onclick="switchTabs(event,'schedule-page')"><?php _e('Schedule', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_remote_storage(){
        ?>
        <a href="#" id="wpvivid_tab_remote_storage" class="nav-tab wrap-nav-tab" onclick="switchTabs(event,'storage-page')"><?php _e('Remote Storage', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_setting(){
        ?>
        <a href="#" id="wpvivid_tab_setting" class="nav-tab wrap-nav-tab" onclick="switchTabs(event,'settings-page')"><?php _e('Settings', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_website_info(){
        ?>
        <a href="#" id="wpvivid_tab_debug" class="nav-tab wrap-nav-tab" onclick="switchTabs(event,'debug-page')"><?php _e('Debug', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_log(){
        ?>
        <a href="#" id="wpvivid_tab_log" class="nav-tab wrap-nav-tab" onclick="switchTabs(event,'logs-page')"><?php _e('Logs', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_read_log(){
        ?>
        <a href="#" id="wpvivid_tab_read_log" class="nav-tab wrap-nav-tab delete" onclick="switchTabs(event,'log-read-page')" style="display: none;">
            <div style="margin-right: 15px;"><?php _e('Log', 'wpvivid'); ?></div>
            <div class="nav-tab-delete-img">
                <img src="<?php echo esc_url( WPVIVID_PLUGIN_URL.'/admin/partials/images/delete-tab.png' ); ?>" style="vertical-align:middle; cursor:pointer;" onclick="wpvivid_close_tab(event, 'wpvivid_tab_read_log', 'wrap', 'wpvivid_tab_log');" />
            </div>
        </a>
        <?php
    }

    public function wpvivid_add_tab_mwp(){
        ?>
        <a href="#" id="wpvivid_tab_mainwp" class="nav-tab wrap-nav-tab delete" onclick="switchTabs(event, 'mwp-page')">
            <div style="margin-right: 15px;"><?php _e('MainWP', 'wpvivid'); ?></div>
            <div class="nav-tab-delete-img">
                <img src="<?php echo esc_url(WPVIVID_PLUGIN_URL.'/admin/partials/images/delete-tab.png'); ?>" style="vertical-align:middle; cursor:pointer;" onclick="wpvivid_close_tab(event, 'wpvivid_tab_mainwp', 'wrap', 'wpvivid_tab_general');" />
            </div>
        </a>
        <?php
    }

    public function wpvivid_add_page_backup()
    {
        ?>
        <div id="general-page" class="wrap-tab-content wpvivid_tab_general" name="tab-backup" style="width:100%;">
            <div class="meta-box-sortables ui-sortable">
                <?php
                do_action('wpvivid_backuppage_add_module');
                ?>
                <h2 class="nav-tab-wrapper" id="wpvivid_backup_tab" style="padding-bottom:0!important;">
                <?php
                $backuplist_array = array();
                $backuplist_array = apply_filters('wpvivid_backuppage_load_backuplist', $backuplist_array);
                foreach ($backuplist_array as $list_name) {
                    add_action('wpvivid_backuppage_add_tab', $list_name['tab_func'], $list_name['index']);
                    add_action('wpvivid_backuppage_add_page', $list_name['page_func'], $list_name['index']);
                }
                do_action('wpvivid_backuppage_add_tab');
                ?>
                </h2>
                <?php  do_action('wpvivid_backuppage_add_page'); ?>
            </div>
        </div>
        <script>
            <?php do_action('wpvivid_backup_do_js'); ?>
        </script>
        <?php
    }

    public function wpvivid_add_page_schedule()
    {
        ?>
        <div id="schedule-page" class="wrap-tab-content wpvivid_tab_schedule" name="tab-schedule" style="display: none;">
            <div>
                <table class="widefat">
                    <tbody>
                    <?php do_action('wpvivid_schedule_add_cell'); ?>
                    <tfoot>
                    <tr>
                        <th class="row-title"><input class="button-primary storage-account-button" id="wpvivid_schedule_save" type="submit" name="" value="<?php esc_attr_e( 'Save Changes', 'wpvivid' ); ?>" /></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            jQuery('#wpvivid_schedule_save').click(function(){
                wpvivid_set_schedule();
                wpvivid_settings_changed = false;
            });

            function wpvivid_set_schedule()
            {
                var schedule_data = wpvivid_ajax_data_transfer('schedule');
                var ajax_data = {
                    'action': 'wpvivid_set_schedule',
                    'schedule': schedule_data
                };
                jQuery('#wpvivid_schedule_save').css({'pointer-events': 'none', 'opacity': '0.4'});
                wpvivid_post_request(ajax_data, function (data) {
                    try {
                        var jsonarray = jQuery.parseJSON(data);

                        jQuery('#wpvivid_schedule_save').css({'pointer-events': 'auto', 'opacity': '1'});
                        if (jsonarray.result === 'success') {
                            location.reload();
                        }
                        else {
                            alert(jsonarray.error);
                        }
                    }
                    catch (err) {
                        alert(err);
                        jQuery('#wpvivid_schedule_save').css({'pointer-events': 'auto', 'opacity': '1'});
                    }
                }, function (XMLHttpRequest, textStatus, errorThrown) {
                    jQuery('#wpvivid_schedule_save').css({'pointer-events': 'auto', 'opacity': '1'});
                    var error_message = wpvivid_output_ajaxerror('changing schedule', textStatus, errorThrown);
                    alert(error_message);
                });
            }
        </script>
        <?php
    }

    public function wpvivid_add_page_remote_storage()
    {
        ?>
        <div id="storage-page" class="wrap-tab-content wpvivid_tab_remote_storage" name="tab-storage" style="display:none;">
            <div>
                <div class="storage-content" id="storage-brand-2" style="">
                    <div class="postbox">
                        <?php do_action('wpvivid_add_storage_tab'); ?>
                    </div>
                    <div class="postbox storage-account-block" id="wpvivid_storage_account_block">
                        <?php do_action('wpvivid_add_storage_page'); ?>
                    </div>
                    <h2 class="nav-tab-wrapper" style="padding-bottom:0!important;">
                        <?php do_action('wpvivid_storage_add_tab'); ?>
                    </h2>
                    <?php do_action('wpvivid_storage_add_page'); ?>
                </div>
            </div>
        </div>
        <?php
    }

    public function wpvivid_add_page_setting()
    {
        ?>
        <div id="settings-page" class="wrap-tab-content wpvivid_tab_setting" name="tab-setting" style="display:none;">
            <div>
                <h2 class="nav-tab-wrapper" style="padding-bottom:0!important;">
                    <?php
                    $setting_array = array();
                    $setting_array = apply_filters('wpvivid_add_setting_tab_page', $setting_array);
                    foreach ($setting_array as $setting_name) {
                        add_action('wpvivid_settingpage_add_tab', $setting_name['tab_func'], $setting_name['index']);
                        add_action('wpvivid_settingpage_add_page', $setting_name['page_func'], $setting_name['index']);
                    }
                    do_action('wpvivid_settingpage_add_tab');
                    ?>
                </h2>
                <?php do_action('wpvivid_settingpage_add_page'); ?>
                <div><input class="button-primary" id="wpvivid_setting_general_save" type="submit" value="<?php esc_attr_e( 'Save Changes', 'wpvivid' ); ?>" /></div>
            </div>
        </div>
        <script>
            jQuery('#wpvivid_setting_general_save').click(function(){
                wpvivid_set_general_settings();
                wpvivid_settings_changed = false;
            });

            function wpvivid_set_general_settings()
            {
                var setting_data = wpvivid_ajax_data_transfer('setting');
                var ajax_data = {
                    'action': 'wpvivid_set_general_setting',
                    'setting': setting_data
                };
                jQuery('#wpvivid_setting_general_save').css({'pointer-events': 'none', 'opacity': '0.4'});
                wpvivid_post_request(ajax_data, function (data) {
                    try {
                        var jsonarray = jQuery.parseJSON(data);

                        jQuery('#wpvivid_setting_general_save').css({'pointer-events': 'auto', 'opacity': '1'});
                        if (jsonarray.result === 'success') {
                            location.reload();
                        }
                        else {
                            alert(jsonarray.error);
                        }
                    }
                    catch (err) {
                        alert(err);
                        jQuery('#wpvivid_setting_general_save').css({'pointer-events': 'auto', 'opacity': '1'});
                    }
                }, function (XMLHttpRequest, textStatus, errorThrown) {
                    jQuery('#wpvivid_setting_general_save').css({'pointer-events': 'auto', 'opacity': '1'});
                    var error_message = wpvivid_output_ajaxerror('changing base settings', textStatus, errorThrown);
                    alert(error_message);
                });
            }
        </script>
        <?php
    }

    public function wpvivid_add_page_website_info()
    {
        ?>
        <div id="debug-page" class="wrap-tab-content wpvivid_tab_debug" name="tab-debug" style="display:none;">
            <table class="widefat">
                <div style="padding: 0 0 20px 10px;">There are two ways available to send us the debug information. The first one is recommended.</div>
                <div style="padding-left: 10px;">
                    <strong><?php _e('Method 1.'); ?></strong> <?php _e('If you have configured SMTP on your site, enter your email address and click the button below to send us the relevant information (website info and errors logs) when you are encountering errors. This will help us figure out what happened. Once the issue is resolved, we will inform you by your email address.', 'wpvivid'); ?>
                </div>
                <div style="padding:10px 10px 0">
                    <span>WPvivid support email:</span><input type="text" id="wpvivid_support_mail" value="support@wpvivid.com" readonly />
                    <span>Your email:</span><input type="text" id="wpvivid_user_mail" />
                </div>
                <div class="schedule-tab-block">
                    <input class="button-primary" type="submit" value="<?php esc_attr_e( 'Send Debug Information to Us', 'wpvivid' ); ?>" onclick="wpvivid_click_send_debug_info();" />
                </div>
                <div style="clear:both;"></div>
                <div style="padding-left: 10px;">
                    <strong><?php _e('Method 2.'); ?></strong> <?php _e('If you didn’t configure SMTP on your site, click the button below to download the relevant information (website info and error logs) to your PC when you are encountering some errors. Sending the files to us will help us diagnose what happened.', 'wpvivid'); ?>
                </div>
                <div class="schedule-tab-block">
                    <input class="button-primary" id="wpvivid_download_website_info" type="submit" name="download-website-info" value="<?php esc_attr_e( 'Download', 'wpvivid' ); ?>" />
                </div>
                <thead class="website-info-head">
                <tr>
                    <th class="row-title" style="min-width: 260px;"><?php _e( 'Website Info Key', 'wpvivid' ); ?></th>
                    <th><?php _e( 'Website Info Value', 'wpvivid' ); ?></th>
                </tr>
                </thead>
                <tbody class="wpvivid-websiteinfo-list" id="wpvivid_websiteinfo_list">
                <?php
                global $wpvivid_plugin;
                $website_info=$wpvivid_plugin->get_website_info();
                if(!empty($website_info['data'])){
                    foreach ($website_info['data'] as $key=>$value) { ?>
                        <?php
                        $website_value='';
                        if (is_array($value)) {
                            foreach ($value as $arr_value) {
                                if (empty($website_value)) {
                                    $website_value = $website_value . $arr_value;
                                } else {
                                    $website_value = $website_value . ', ' . $arr_value;
                                }
                            }
                        }
                        else{
                            if($value === true || $value === false){
                                if($value === true) {
                                    $website_value = 'true';
                                }
                                else{
                                    $website_value = 'false';
                                }
                            }
                            else {
                                $website_value = $value;
                            }
                        }
                        ?>
                        <tr>
                            <td class="row-title tablelistcolumn"><label for="tablecell"><?php _e($key, 'wpvivid'); ?></label></td>
                            <td class="tablelistcolumn"><?php _e($website_value, 'wpvivid'); ?></td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
        <script>
            jQuery('#wpvivid_download_website_info').click(function(){
                wpvivid_download_website_info();
            });

            /**
             * Download the relevant website info and error logs to your PC for debugging purposes.
             */
            function wpvivid_download_website_info(){
                wpvivid_location_href=true;
                location.href =ajaxurl+'?action=wpvivid_create_debug_package';
            }

            function wpvivid_click_send_debug_info(){
                var wpvivid_user_mail = jQuery('#wpvivid_user_mail').val();
                var ajax_data = {
                    'action': 'wpvivid_send_debug_info',
                    'user_mail': wpvivid_user_mail
                };
                wpvivid_post_request(ajax_data, function (data) {
                    try {
                        var jsonarray = jQuery.parseJSON(data);
                        if (jsonarray.result === "success") {
                            alert("Send succeeded.");
                        }
                        else {
                            alert(jsonarray.error);
                        }
                    }
                    catch (err) {
                        alert(err);
                    }
                }, function (XMLHttpRequest, textStatus, errorThrown) {
                    var error_message = wpvivid_output_ajaxerror('sending debug information', textStatus, errorThrown);
                    alert(error_message);
                });
            }
        </script>
        <?php
    }

    public function wpvivid_add_page_log()
    {
        global $wpvivid_plugin;
        $display_log_count=array(0=>"10",1=>"20",2=>"30",3=>"40",4=>"50");
        $max_log_diaplay=20;
        $loglist=$wpvivid_plugin->get_log_list_ex();
        ?>
        <div id="logs-page" class="wrap-tab-content wpvivid_tab_log" name="tab-logs" style="display:none;">
            <table class="wp-list-table widefat plugins">
                <thead class="log-head">
                <tr>
                    <th class="row-title"><?php _e( 'Date', 'wpvivid' ); ?></th>
                    <th><?php _e( 'Log Type', 'wpvivid' ); ?></th>
                    <th><?php _e( 'Log File Name', 'wpvivid' ); ?></th>
                    <th><?php _e( 'Action', 'wpvivid' ); ?></th>
                </tr>
                </thead>
                <tbody class="wpvivid-loglist" id="wpvivid_loglist">
                <?php
                $html = '';
                $html = apply_filters('wpvivid_get_log_list', $html);
                echo $html['html'];
                ?>
                </tbody>
            </table>
            <div style="padding-top: 10px; text-align: center;">
                <input class="button-secondary log-page" id="wpvivid_pre_log_page" type="submit" value="<?php esc_attr_e( ' < Pre page ', 'wpvivid' ); ?>" />
                <div style="font-size: 12px; display: inline-block; padding-left: 10px;">
                                <span id="wpvivid_log_page_info" style="line-height: 35px;">
                                    <?php
                                    $current_page=1;
                                    $max_page=ceil(sizeof($loglist['log_list']['file'])/$max_log_diaplay);
                                    if($max_page == 0) $max_page = 1;
                                    _e($current_page.' / '.$max_page, 'wpvivid');
                                    ?>
                                </span>
                </div>
                <input class="button-secondary log-page" id="wpvivid_next_log_page" type="submit" value="<?php esc_attr_e( ' Next page > ', 'wpvivid' ); ?>" />
                <div style="float: right;">
                    <select name="" id="wpvivid_display_log_count">
                        <?php
                        foreach ($display_log_count as $value){
                            if($value == $max_log_diaplay){
                                _e('<option selected="selected" value="' . $value . '">' . $value . '</option>', 'wpvivid');
                            }
                            else {
                                _e('<option value="' . $value . '">' . $value . '</option>', 'wpvivid');
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <script>
            jQuery('#wpvivid_display_log_count').on("change", function(){
                wpvivid_display_log_page();
            });

            jQuery('#wpvivid_pre_log_page').click(function(){
                wpvivid_pre_log_page();
            });

            jQuery('#wpvivid_next_log_page').click(function(){
                wpvivid_next_log_page();
            });

            function wpvivid_pre_log_page(){
                if(wpvivid_cur_log_page > 1){
                    wpvivid_cur_log_page--;
                }
                wpvivid_display_log_page();
            }

            function wpvivid_next_log_page(){
                var display_count = jQuery("#wpvivid_display_log_count option:selected").val();
                var max_pages=Math.ceil(wpvivid_log_count/display_count);
                if(wpvivid_cur_log_page < max_pages){
                    wpvivid_cur_log_page++;
                }
                wpvivid_display_log_page();
            }

            function wpvivid_display_log_page(){
                var display_count = jQuery("#wpvivid_display_log_count option:selected").val();
                var max_pages=Math.ceil(wpvivid_log_count/display_count);
                if(max_pages == 0) max_pages = 1;
                jQuery('#wpvivid_log_page_info').html(wpvivid_cur_log_page+ " / "+max_pages);

                var begin = (wpvivid_cur_log_page - 1) * display_count;
                var end = parseInt(begin) + parseInt(display_count);
                jQuery("#wpvivid_loglist tr").hide();
                jQuery('#wpvivid_loglist tr').each(function(i){
                    if (i >= begin && i < end)
                    {
                        jQuery(this).show();
                    }
                });
            }

            function wpvivid_retrieve_log_list()
            {
                var ajax_data = {
                    'action': 'wpvivid_get_log_list'
                };
                wpvivid_post_request(ajax_data, function(data){
                    try {
                        var jsonarray = jQuery.parseJSON(data);
                        if (jsonarray.result === "success") {
                            jQuery('#wpvivid_loglist').html("");
                            jQuery('#wpvivid_loglist').append(jsonarray.html);
                            wpvivid_log_count = jsonarray.log_count;
                            wpvivid_display_log_page();
                        }
                    }
                    catch(err){
                        alert(err);
                    }
                }, function(XMLHttpRequest, textStatus, errorThrown) {
                    setTimeout(function () {
                        wpvivid_retrieve_log_list();
                    }, 3000);
                });
            }
        </script>
        <?php
    }

    public function wpvivid_add_page_read_log()
    {
        ?>
        <div id="log-read-page" class="wrap-tab-content wpvivid_tab_read_log" style="display:none;">
            <div class="postbox restore_log" id="wpvivid_read_log_content">
                <div></div>
            </div>
        </div>
        <?php
    }

    public function wpvivid_add_page_mwp()
    {
        ?>
        <div id="mwp-page" class="wrap-tab-content wpvivid_tab_mainwp" name="tab-mwp" style="display:none;">
            <div style="padding: 10px; background-color: #fff;">
                <div style="margin-bottom: 10px;">
                    WPvivid Backup Plugin can be managed from MainWP dashboard now. <a target="_blank" href="https://wordpress.org/plugins/wpvivid-backup-mainwp/" style="text-decoration: none;">Download WPvivid Backup for MainWP extension from wordpress.org.</a>
                </div>
                <div>
                    <strong>Note: </strong>This extension currently only works with the community version of WPvivid Backup Plugin.
                </div>
            </div>
        </div>
        <?php
    }
}