<?php

if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
if(!defined('WPVIVID_REMOTE_DROPBOX')){
    define('WPVIVID_REMOTE_DROPBOX','dropbox');
}
if(!defined('WPVIVID_DROPBOX_DEFAULT_FOLDER'))
    define('WPVIVID_DROPBOX_DEFAULT_FOLDER','/');
require_once WPVIVID_PLUGIN_DIR . '/includes/customclass/class-wpvivid-base-dropbox.php';
require_once WPVIVID_PLUGIN_DIR . '/includes/customclass/class-wpvivid-remote.php';
class WPvivid_Dropbox extends WPvivid_Remote {

    private $options;
    private $upload_chunk_size = 2097152;
    private $download_chunk_size = 2097152;
    private $redirect_url = 'https://auth.wpvivid.com/dropbox_v2/';
    public function __construct($options = array())
    {
        if(empty($options)){
            if(!defined('WPVIVID_INIT_STORAGE_TAB_DROPBOX')){
                add_action('init', array($this, 'handle_auth_actions'));
                add_action('wpvivid_delete_remote_token',array($this,'revoke'));

                add_filter('wpvivid_remote_register', array($this, 'init_remotes'),10);
                add_action('wpvivid_add_storage_tab',array($this,'wpvivid_add_storage_tab_dropbox'), 11);
                add_action('wpvivid_add_storage_page',array($this,'wpvivid_add_storage_page_dropbox'), 11);
                add_action('wpvivid_edit_remote_page',array($this,'wpvivid_edit_storage_page_dropbox'), 11);
                add_filter('wpvivid_remote_pic',array($this,'wpvivid_remote_pic_dropbox'),10);
                add_filter('wpvivid_get_out_of_date_remote',array($this,'wpvivid_get_out_of_date_dropbox'),10,2);
                add_filter('wpvivid_storage_provider_tran',array($this,'wpvivid_storage_provider_dropbox'),10);
                add_filter('wpvivid_get_root_path',array($this,'wpvivid_get_root_path_dropbox'),10);

                define('WPVIVID_INIT_STORAGE_TAB_DROPBOX',1);
            }
        }else{
            $this -> options = $options;
        }
    }

    public function test_connect()
    {
        return array('result' => WPVIVID_SUCCESS);
    }

    public function sanitize_options($skip_name='')
    {
        $ret['result']=WPVIVID_SUCCESS;

        if(!isset($this->options['name']))
        {
            $ret['error']="Warning: An alias for remote storage is required.";
            return $ret;
        }

        $this->options['name']=sanitize_text_field($this->options['name']);

        if(empty($this->options['name']))
        {
            $ret['error']="Warning: An alias for remote storage is required.";
            return $ret;
        }

        $remoteslist=WPvivid_Setting::get_all_remote_options();
        foreach ($remoteslist as $key=>$value)
        {
            if(isset($value['name'])&&$value['name'] == $this->options['name']&&$skip_name!=$value['name'])
            {
                $ret['error']="Warning: The alias already exists in storage list.";
                return $ret;
            }
        }

        $ret['options']=$this->options;
        return $ret;
    }

    public function upload($task_id, $files, $callback = '')
    {
        global $wpvivid_plugin;

        $options = $this -> options;
        $dropbox = new Dropbox_Base($options);
        $upload_job=WPvivid_taskmanager::get_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_DROPBOX);
        if(empty($upload_job))
        {
            $job_data=array();
            foreach ($files as $file)
            {
                $file_data['size']=filesize($file);
                $file_data['uploaded']=0;
                $job_data[basename($file)]=$file_data;
            }
            WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_DROPBOX,WPVIVID_UPLOAD_UNDO,'Start uploading',$job_data);
            $upload_job=WPvivid_taskmanager::get_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_DROPBOX);
        }

        foreach ($files as $file){
            if(is_array($upload_job['job_data']) &&array_key_exists(basename($file),$upload_job['job_data']))
            {
                if($upload_job['job_data'][basename($file)]['uploaded']==1)
                    continue;
            }

            $this -> last_time = time();
            $this -> last_size = 0;
            $wpvivid_plugin->wpvivid_log->WriteLog('Start uploading '.basename($file),'notice');
            $wpvivid_plugin->set_time_limit($task_id);
            if(!file_exists($file))
                return array('result' =>WPVIVID_FAILED,'error' =>$file.' not found. The file might has been moved, renamed or deleted. Please reload the list and verify the file exists.');
            $result = $this -> _put($task_id,$dropbox,$file,$callback);
            if($result['result'] !==WPVIVID_SUCCESS){
                $wpvivid_plugin->wpvivid_log->WriteLog('Uploading '.basename($file).' failed.','notice');
                return $result;
            }
            $wpvivid_plugin->wpvivid_log->WriteLog('Finished uploading '.basename($file),'notice');
            $upload_job['job_data'][basename($file)]['uploaded'] = 1;
            WPvivid_taskmanager::update_backup_sub_task_progress($task_id, 'upload', WPVIVID_REMOTE_DROPBOX, WPVIVID_UPLOAD_SUCCESS, 'Uploading ' . basename($file) . ' completed.', $upload_job['job_data']);
        }
        return array('result' =>WPVIVID_SUCCESS);
    }
    private function _put($task_id,$dropbox,$file,$callback){
        global $wpvivid_plugin;
        $options = $this -> options;
        $path = trailingslashit($options['path']).basename($file);
        $upload_job=WPvivid_taskmanager::get_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_DROPBOX);
        $this -> current_file_size = filesize($file);
        $this -> current_file_name = basename($file);

        if($this -> current_file_size > $this -> upload_chunk_size){
            $wpvivid_plugin->wpvivid_log->WriteLog('Creating upload session.','notice');
            WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_DROPBOX,WPVIVID_UPLOAD_UNDO,'Start uploading '.basename($file).'.',$upload_job['job_data']);
            $result = $dropbox -> upload_session_start();
            if(isset($result['error_summary'])){
                return array('result'=>WPVIVID_FAILED,'error'=>$result['error_summary']);
            }
            $build_id = $result['session_id'];
            $result = $this -> large_file_upload($build_id,$file,$dropbox,$callback);
        }else{
            $wpvivid_plugin->wpvivid_log->WriteLog('Uploaded files are less than 2M.','notice');
            $result = $dropbox -> upload($path,$file);
            if(isset($result['error_summary'])){
                WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_DROPBOX,WPVIVID_UPLOAD_FAILED,'Uploading '.basename($file).' failed.',$upload_job['job_data']);
                $result = array('result' => WPVIVID_FAILED,'error' => $result['error_summary']);
            }else{
                WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_DROPBOX,WPVIVID_UPLOAD_SUCCESS,'Uploading '.basename($file).' completed.',$upload_job['job_data']);
                $result = array('result'=> WPVIVID_SUCCESS);
            }
        }
        return $result;
    }

    public function large_file_upload($session_id,$file,$dropbox,$callback){
        $fh = fopen($file,'rb');
        $offset = 0;
        while(!feof($fh)){
            $data = fread($fh,$this -> upload_chunk_size);
            $ret = $this -> _upload_loop($session_id,$offset,$data,$dropbox);
            if($ret['result'] !== WPVIVID_SUCCESS)
                break;

            if((time() - $this -> last_time) >3)
            {
                if(is_callable($callback))
                {
                    call_user_func_array($callback,array(min($offset + $this -> upload_chunk_size,$this -> current_file_size),$this -> current_file_name,
                        $this->current_file_size,$this -> last_time,$this -> last_size));
                }
                $this -> last_size = $offset;
                $this -> last_time = time();
            }
            $offset += $this -> upload_chunk_size;
        }
        if($ret['result'] === WPVIVID_SUCCESS){
            $options = $this -> options;
            $path = trailingslashit($options['path']).basename($file);
            $result = $dropbox -> upload_session_finish($session_id,$this -> current_file_size,$path);
            if(isset($result['error_summary'])){
                $ret = array('result' => WPVIVID_FAILED,'error' => $result['error_summary']);
            }else{
                $ret = array('result'=> WPVIVID_SUCCESS);
            }
        }
        fclose($fh);
        return $ret;
    }
    public function _upload_loop($session_id,$offset,$data,$dropbox){
        for($i =0;$i <WPVIVID_REMOTE_CONNECT_RETRY_TIMES; $i ++){
            $result = $dropbox -> upload_session_append_v2($session_id,$offset,$data);
            if(isset($result['error_summary']) && !strstr($result['error_summary'],'incorrect_offset')){
                $result = array('result' => WPVIVID_FAILED,'error' => 'Uploading '.$this -> current_file_name.' to Dropbox server failed. '.$result['error_summary']);
            }else{
                return array('result' => WPVIVID_SUCCESS);
            }
        }
        return $result;
    }

    public function download($file, $local_path, $callback = '')
    {
        try {
            global $wpvivid_plugin;
            $wpvivid_plugin->wpvivid_download_log->WriteLog('Remote type: Dropbox.','notice');
            $this->current_file_name = $file['file_name'];
            $this->current_file_size = $file['size'];
            $options = $this->options;
            $dropbox = new Dropbox_Base($options);

            $file_path = trailingslashit($local_path) . $this->current_file_name;
            $start_offset = file_exists($file_path) ? filesize($file_path) : 0;
            $wpvivid_plugin->wpvivid_download_log->WriteLog('Create local file.','notice');
            $fh = fopen($file_path, 'a');
            $wpvivid_plugin->wpvivid_download_log->WriteLog('Downloading file ' . $file['file_name'] . ', Size: ' . $file['size'] ,'notice');
            while ($start_offset < $this->current_file_size) {
                $last_byte = min($start_offset + $this->download_chunk_size - 1, $this->current_file_size - 1);
                $headers = array("Range: bytes=$start_offset-$last_byte");
                $response = $dropbox->download(trailingslashit($options['path']) . $this->current_file_name, $headers);
                if (isset($response['error_summary'])) {
                    return array('result' => WPVIVID_FAILED, 'error' => 'Downloading ' . trailingslashit($options['path']) . $this->current_file_name . ' failed.' . $response['error_summary']);
                }
                if (!fwrite($fh, $response)) {
                    return array('result' => WPVIVID_FAILED, 'error' => 'Downloading ' . trailingslashit($options['path']) . $this->current_file_name . ' failed.');
                }
                clearstatcache();
                $state = stat($file_path);
                $start_offset = $state['size'];

                if ((time() - $this->last_time) > 3) {
                    if (is_callable($callback)) {
                        call_user_func_array($callback, array($start_offset, $this->current_file_name,
                            $this->current_file_size, $this->last_time, $this->last_size));
                    }
                    $this->last_size = $start_offset;
                    $this->last_time = time();
                }
            }
            @fclose($fh);

            if(filesize($file_path) == $file['size']){
                if($wpvivid_plugin->wpvivid_check_zip_valid()) {
                    $res = TRUE;
                }
                else{
                    $res = FALSE;
                }
            }
            else{
                $res = FALSE;
            }

            if ($res !== TRUE) {
                @unlink($file_path);
                return array('result' => WPVIVID_FAILED, 'error' => 'Downloading ' . $file['file_name'] . ' failed. ' . $file['file_name'] . ' might be deleted or network doesn\'t work properly. Please verify the file and confirm the network connection and try again later.');
            }
            return array('result' => WPVIVID_SUCCESS);
        }
        catch (Exception $error){
            $message = 'An exception has occurred. class: '.get_class($error).';msg: '.$error->getMessage().';code: '.$error->getCode().';line: '.$error->getLine().';in_file: '.$error->getFile().';';
            error_log($message);
            return array('result'=>WPVIVID_FAILED, 'error'=>$message);
        }
    }

    public function cleanup($files)
    {
        $options = $this -> options;
        $dropbox = new Dropbox_Base($options);
        foreach ($files as $file){
            $dropbox -> delete(trailingslashit($options['path']).$file);
        }
        return array('result'=>WPVIVID_SUCCESS);
    }

    public function init_remotes($remote_collection){
        $remote_collection[WPVIVID_REMOTE_DROPBOX] = 'WPvivid_Dropbox';
        return $remote_collection;
    }

    public function handle_auth_actions()
    {
        if(isset($_GET['action']))
        {
            if($_GET['action'] === 'wpvivid_dropbox_auth')
            {
                try {
                    if (!isset($_GET['name']) || empty($_GET['name'])) {
                        _e('<div class="notice notice-warning is-dismissible"><p>Warning: An alias for remote storage is required.</p></div>');
                        return;
                    }

                    $_GET['name'] = sanitize_text_field($_GET['name']);

                    $remoteslist = WPvivid_Setting::get_all_remote_options();
                    foreach ($remoteslist as $key => $value) {
                        if (isset($value['name']) && $value['name'] == $_GET['name']) {
                            _e('<div class="notice notice-warning is-dismissible"><p>Warning: The alias already exists in storage list.</p></div>');
                            return;
                        }
                    }
                    $state = admin_url() . 'admin.php?page=WPvivid' . '&action=wpvivid_dropbox_finish_auth&name=' . $_GET['name'] . '&bdefault=' . $_GET['bdefault'];
                    $url = Dropbox_Base::getUrl($this->redirect_url, $state);
                    header('Location: ' . filter_var($url, FILTER_SANITIZE_URL));
                }
                catch (Exception $e){
                    _e('<div class="notice notice-error"><p>'.$e->getMessage().'</p></div>');
                }
            }
            else if($_GET['action'] === 'wpvivid_dropbox_finish_auth')
            {
                try {
                    if (!isset($_POST['code'])) {
                        header('Location: ' . admin_url() . 'admin.php?page=' . WPVIVID_PLUGIN_SLUG . '&action=wpvivid_dropbox_drive&result=error&resp_msg=' . 'Get Dropbox token failed.');
                    } else {
                        global $wpvivid_plugin;
                        $remote_options['type'] = WPVIVID_REMOTE_DROPBOX;
                        $remote_options['token'] = $_POST['code'];
                        $remote_options['name'] = $_GET['name'];
                        $remote_options['path'] = WPVIVID_DROPBOX_DEFAULT_FOLDER;
                        $remote_options['default'] = $_GET['bdefault'];
                        $ret = $wpvivid_plugin->remote_collection->add_remote($remote_options);
                        if ($ret['result'] == 'success') {
                            header('Location: ' . admin_url() . 'admin.php?page=' . WPVIVID_PLUGIN_SLUG . '&action=wpvivid_dropbox_drive&result=success');
                            return;
                        } else {
                            header('Location: ' . admin_url() . 'admin.php?page=' . WPVIVID_PLUGIN_SLUG . '&action=wpvivid_dropbox_drive&result=error&resp_msg=' . $ret['error']);
                            return;
                        }
                    }
                }
                catch (Exception $e){
                    _e('<div class="notice notice-error"><p>'.$e->getMessage().'</p></div>');
                }
            }
            else if($_GET['action']=='wpvivid_dropbox_drive')
            {
                try {
                    if (isset($_GET['result'])) {
                        if ($_GET['result'] == 'success') {
                            add_action('show_notice', array($this, 'wpvivid_show_notice_add_dropbox_success'));
                        } else if ($_GET['result'] == 'error') {
                            add_action('show_notice', array($this, 'wpvivid_show_notice_add_dropbox_error'));
                        }
                    }
                }
                catch (Exception $e){
                    _e('<div class="notice notice-error"><p>'.$e->getMessage().'</p></div>');
                }
            }
            else if($_GET['action'] === 'wpvivid_dropbox_update_auth')
            {
                try {
                    if (!isset($_GET['name']) || empty($_GET['name'])) {
                        _e('<div class="notice notice-warning is-dismissible"><p>Warning: An alias for remote storage is required.</p></div>');
                        return;
                    }

                    $_GET['name'] = sanitize_text_field($_GET['name']);

                    $remoteslist = WPvivid_Setting::get_all_remote_options();
                    foreach ($remoteslist as $key => $value) {
                        if (isset($value['name']) && $value['name'] == $_GET['name'] && $key != $_GET['id']) {
                            _e('<div class="notice notice-warning is-dismissible"><p>Warning: The alias already exists in storage list.</p></div>');
                            return;
                        }
                    }
                    $state = admin_url() . 'admin.php?page=WPvivid' . '&action=wpvivid_dropbox_finish_update_auth&name=' . $_GET['name'] . '&id=' . $_GET['id'];
                    $url = Dropbox_Base::getUrl($this->redirect_url, $state);
                    header('Location: ' . filter_var($url, FILTER_SANITIZE_URL));
                }
                catch (Exception $e){
                    _e('<div class="notice notice-error"><p>'.$e->getMessage().'</p></div>');
                }
            }
            else if($_GET['action'] === 'wpvivid_dropbox_finish_update_auth')
            {
                try {
                    if (!isset($_POST['code'])) {
                        header('Location: ' . admin_url() . 'admin.php?page=' . WPVIVID_PLUGIN_SLUG . '&action=wpvivid_dropbox_drive_update&result=error&resp_msg=' . 'Get Dropbox token failed.');
                    } else {
                        global $wpvivid_plugin;
                        $remote_options['type'] = WPVIVID_REMOTE_DROPBOX;
                        $remote_options['token'] = $_POST['code'];
                        $remote_options['name'] = $_GET['name'];
                        $remote_options['path'] = WPVIVID_DROPBOX_DEFAULT_FOLDER;
                        $ret = $wpvivid_plugin->remote_collection->update_remote($_GET['id'], $remote_options);
                        if ($ret['result'] == 'success') {
                            header('Location: ' . admin_url() . 'admin.php?page=' . WPVIVID_PLUGIN_SLUG . '&action=wpvivid_dropbox_drive_update&result=success');
                            return;
                        } else {
                            header('Location: ' . admin_url() . 'admin.php?page=' . WPVIVID_PLUGIN_SLUG . '&action=wpvivid_dropbox_drive_update&result=error&resp_msg=' . $ret['error']);
                            return;
                        }
                    }
                }
                catch (Exception $e){
                    _e('<div class="notice notice-error"><p>'.$e->getMessage().'</p></div>');
                }
            }
            else if($_GET['action']=='wpvivid_dropbox_drive_update')
            {
                try {
                    if (isset($_GET['result'])) {
                        if ($_GET['result'] == 'success') {
                            add_action('show_notice', array($this, 'wpvivid_show_notice_edit_dropbox_success'));
                        } else if ($_GET['result'] == 'error') {
                            add_action('show_notice', array($this, 'wpvivid_show_notice_edit_dropbox_error'));
                        }
                    }
                }
                catch (Exception $e){
                    _e('<div class="notice notice-error"><p>'.$e->getMessage().'</p></div>');
                }
            }
        }
    }
    public function wpvivid_show_notice_add_dropbox_success(){
        _e('<div class="notice notice-success is-dismissible"><p>You have authenticated the Dropbox account as your remote storage.</p></div>');
    }
    public function wpvivid_show_notice_add_dropbox_error(){
        global $wpvivid_plugin;
        $wpvivid_plugin->wpvivid_handle_remote_storage_error($_GET['resp_msg'], 'Add Dropbox Remote');
        _e('<div class="notice notice-error"><p>'.$_GET['resp_msg'].'</p></div>');
    }
    public function wpvivid_show_notice_edit_dropbox_success(){
        _e('<div class="notice notice-success is-dismissible"><p>You have successfully updated the storage alias.</p></div>');
    }
    public function wpvivid_show_notice_edit_dropbox_error(){
        global $wpvivid_plugin;
        $wpvivid_plugin->wpvivid_handle_remote_storage_error($_GET['resp_msg'], 'Update Dropbox Remote');
        _e('<div class="notice notice-error"><p>'.$_GET['resp_msg'].'</p></div>');
    }

    public function wpvivid_add_storage_tab_dropbox(){
        ?>
        <div class="storage-providers" remote_type="dropbox" onclick="select_remote_storage(event, 'storage_account_dropbox');">
            <img src="<?php echo esc_url(WPVIVID_PLUGIN_URL.'/admin/partials/images/storage-dropbox.png'); ?>" style="vertical-align:middle;"/><?php _e('Dropbox', 'wpvivid'); ?>
        </div>
        <?php
    }
    public function wpvivid_add_storage_page_dropbox(){
        global $wpvivid_plugin;
        $root_path=apply_filters('wpvivid_get_root_path', WPVIVID_REMOTE_DROPBOX);
        ?>
        <div id="storage_account_dropbox" class="storage-account-page" style="display:none;">
            <div style="background-color:#f1f1f1; padding: 10px;">Please read
                <a target="_blank" href="https://wpvivid.com/privacy-policy" style="text-decoration: none;">this privacy policy</a> for use of our Dropbox authorization app (none of your backup data is sent to us).
            </div>
            <div style="padding: 10px 10px 10px 0;">
                <strong>Enter Your Dropbox Information</strong>
            </div>
            <table class="wp-list-table widefat plugins" style="width:100%;">
                <tbody>
                <tr>
                    <td class="plugin-title column-primary">
                        <div class="wpvivid-storage-form">
                            <input type="text" class="regular-text" autocomplete="off" option="dropbox" name="name" placeholder="Enter a unique alias: e.g. Dropbox-001" onkeyup="value=value.replace(/[^a-zA-Z0-9\-_]/g,'')" />
                        </div>
                    </td>
                    <td class="column-description desc">
                        <div class="wpvivid-storage-form-desc">
                            <i>A name to help you identify the storage if you have multiple remote storage connected.</i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="plugin-title column-primary">
                        <div class="wpvivid-storage-form">
                            <input type="text" class="regular-text" autocomplete="off" option="dropbox" name="path" value="<?php esc_attr_e($root_path.WPVIVID_DROPBOX_DEFAULT_FOLDER); ?>" readonly="readonly" />
                        </div>
                    </td>
                    <td class="column-description desc">
                        <div class="wpvivid-storage-form-desc">
                            <i>All backups will be uploaded to this directory.</i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="plugin-title column-primary">
                        <div class="wpvivid-storage-form">
                            <input type="text" class="regular-text" autocomplete="off" value="mywebsite01" readonly="readonly" />
                        </div>
                    </td>
                    <td class="column-description desc">
                        <div class="wpvivid-storage-form-desc">
                            <a href="https://wpvivid.com/wpvivid-backup-pro-dropbox-custom-folder-name?utm_source=client_dropbox&utm_medium=inner_link&utm_campaign=access">Pro feature: Create a directory for storing the backups of the site</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="plugin-title column-primary">
                        <div class="wpvivid-storage-select">
                            <label>
                                <input type="checkbox" option="dropbox" name="default" checked />Set as the default remote storage.
                            </label>
                        </div>
                    </td>
                    <td class="column-description desc">
                        <div class="wpvivid-storage-form-desc">
                            <i>Once checked, all this sites backups sent to a remote storage destination will be uploaded to this storage by default.</i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="plugin-title column-primary">
                        <div class="wpvivid-storage-form">
                            <input onclick="wpvivid_dropbox_auth();" class="button-primary" type="submit" value="Authenticate with Dropbox">
                        </div>
                    </td>
                    <td class="column-description desc">
                        <div class="wpvivid-storage-form-desc">
                            <i>Click the button to get Dropbox authentication and add it to the storage list below.</i>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <script>
            function wpvivid_check_dropbox_storage_alias(storage_alias){
                var find = 1;
                jQuery('#wpvivid_remote_storage_list tr').each(function (i) {
                    jQuery(this).children('td').each(function (j) {
                        if (j == 3) {
                            if (jQuery(this).text() == storage_alias) {
                                find = -1;
                                return false;
                            }
                        }
                    });
                });
                return find;
            }
            function wpvivid_dropbox_auth()
            {
                wpvivid_settings_changed = false;
                var name='';
                var path = '';
                var bdefault = '0';
                jQuery("input:checkbox[option=dropbox]").each(function(){
                    var key = jQuery(this).prop('name');
                    if(jQuery(this).prop('checked')) {
                        bdefault = '1';
                    }
                    else {
                        bdefault = '0';
                    }
                });
                jQuery('input:text[option=dropbox]').each(function()
                {
                    var type = jQuery(this).prop('name');
                    if(type == 'name'){
                        name = jQuery(this).val();
                    }
                });
                if(name == ''){
                    alert('Warning: An alias for remote storage is required.');
                }
                else if(wpvivid_check_dropbox_storage_alias(name) === -1){
                    alert("Warning: The alias already exists in storage list.");
                }
                else{
                    location.href ='<?php echo admin_url().'admin.php?page=WPvivid'.'&action=wpvivid_dropbox_auth&name='?>'+name+'<?php echo '&bdefault='?>'+bdefault;
                }
            }
        </script>
        <?php
    }
    public function wpvivid_edit_storage_page_dropbox()
    {
        do_action('wpvivid_remote_storage_js');
        ?>
        <div id="remote_storage_edit_dropbox" class="postbox storage-account-block remote-storage-edit" style="display:none;">
            <div style="padding: 0 10px 10px 0;">
                <strong>Enter Your Dropbox Information</strong>
            </div>
            <table class="wp-list-table widefat plugins" style="width:100%;">
                <tbody>
                <tr>
                    <td class="plugin-title column-primary">
                        <div class="wpvivid-storage-form">
                            <input type="text" class="regular-text" autocomplete="off" option="edit-dropbox" name="name" placeholder="Enter a unique alias: e.g. Dropbox-001" onkeyup="value=value.replace(/[^a-zA-Z0-9\-_]/g,'')" />
                        </div>
                    </td>
                    <td class="column-description desc">
                        <div class="wpvivid-storage-form-desc">
                            <i>A name to help you identify the storage if you have multiple remote storage connected.</i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="plugin-title column-primary">
                        <div class="wpvivid-storage-form">
                            <input onclick="wpvivid_dropbox_update_auth();" class="button-primary" type="submit" value="Save Changes">
                        </div>
                    </td>
                    <td class="column-description desc">
                        <div class="wpvivid-storage-form-desc">
                            <i>Click the button to save the changes.</i>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <!--<h2><span><?php _e( 'Enter an alias for Dropbox','wpvivid'); ?></span></h2>
            <div class="storage-account-form">
                <input type="text" option="edit-dropbox" name="name" placeholder="Enter an unique alias: e.g. Dropbox-001" class="regular-text" onkeyup="value=value.replace(/[^a-zA-Z0-9\-_]/g,'')" />
            </div>
            <div class=""><input onclick="wpvivid_dropbox_update_auth()" class="button-primary storage-account-button" type="button" value="<?php _e( 'Save Changes', 'wpvivid' ); ?>" /></div>
            <div style="clear:both;"></div>
            <div style="padding-left: 10px;">Tips: Get Dropbox authentication to change the alias.</div>-->
        </div>
        <script>
            function wpvivid_dropbox_update_auth()
            {
                var name='';
                jQuery('input:text[option=edit-dropbox]').each(function()
                {
                    var key = jQuery(this).prop('name');
                    if(key==='name')
                    {
                        name = jQuery(this).val();
                    }
                });
                if(name == ''){
                    alert('Warning: An alias for remote storage is required.');
                }
                else if(wpvivid_check_onedrive_storage_alias(name) === -1){
                    alert("Warning: The alias already exists in storage list.");
                }
                else {
                    location.href = '<?php echo admin_url() . 'admin.php?page=WPvivid' . '&action=wpvivid_dropbox_update_auth&name='?>' + name + '&id=' + wpvivid_editing_storage_id;
                }
            }
        </script>
        <?php
    }
    public function wpvivid_remote_pic_dropbox($remote)
    {
        $remote['dropbox']['default_pic'] = '/admin/partials/images/storage-dropbox(gray).png';
        $remote['dropbox']['selected_pic'] = '/admin/partials/images/storage-dropbox.png';
        $remote['dropbox']['title'] = 'Dropbox';
        return $remote;
    }

    public function revoke($id){
        $upload_options = WPvivid_Setting::get_option('wpvivid_upload_setting');
        if(array_key_exists($id,$upload_options) && $upload_options[$id] == WPVIVID_REMOTE_DROPBOX){
            $dropbox = new Dropbox_Base($upload_options);
            $dropbox -> revoke();
        }
    }

    public function wpvivid_get_out_of_date_dropbox($out_of_date_remote, $remote)
    {
        if($remote['type'] == WPVIVID_REMOTE_DROPBOX){
            $root_path=apply_filters('wpvivid_get_root_path', $remote['type']);
            $out_of_date_remote = $root_path.$remote['path'];
        }
        return $out_of_date_remote;
    }

    public function wpvivid_storage_provider_dropbox($storage_type)
    {
        if($storage_type == WPVIVID_REMOTE_DROPBOX){
            $storage_type = 'Dropbox';
        }
        return $storage_type;
    }

    public function wpvivid_get_root_path_dropbox($storage_type){
        if($storage_type == WPVIVID_REMOTE_DROPBOX){
            $storage_type = 'apps/Wpvivid backup restore';
        }
        return $storage_type;
    }
}