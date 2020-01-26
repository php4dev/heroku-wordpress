<?php

function wpvivid_add_backup_type($html, $type_name)
{
    $html .= '<label>
                    <input type="radio" option="backup" name="'.$type_name.'" value="files+db" checked />
                    <span>'.__( 'Database + Files (WordPress Files)', 'wpvivid' ).'</span>
                </label><br>
                <label>
                    <input type="radio" option="backup" name="'.$type_name.'" value="files" />
                    <span>'.__( 'WordPress Files (Exclude Database)', 'wpvivid' ).'</span>
                </label><br>
                <label>
                    <input type="radio" option="backup" name="'.$type_name.'" value="db" />
                    <span>'.__( 'Only Database', 'wpvivid' ).'</span>
                </label><br>
                <label>
                    <div style="float: left;">
                        <input type="radio" disabled />
                        <span class="wpvivid-element-space-right" style="color: #ddd;">'.__('Create a staging site').'</span>
                    </div>
                    <span class="wpvivid-feature-pro">
                        <a href="https://wpvivid.com/wpvivid-backup-pro-create-staging-site" style="text-decoration: none;">Pro feature: learn more</a>
                    </span>
                </label><br>
                <label>
                    <div style="float: left;">
                        <input type="radio" disabled />
                        <span class="wpvivid-element-space-right" style="color: #ddd;">'.__('Custom').'</span>
                    </div>
                    <span class="wpvivid-feature-pro">
                        <a href="https://wpvivid.com/backup-migration-overview?utm_source=client_custom_backup&utm_medium=inner_link&utm_campaign=access" style="text-decoration: none;">Pro feature: learn more</a>
                    </span>
                </label><br>';
    return $html;
}

function wpvivid_backup_do_js(){
    global $wpvivid_plugin;
    $backup_task = array();
    $backup_task=$wpvivid_plugin->_list_tasks($backup_task, false);
    $general_setting=WPvivid_Setting::get_setting(true, "");
    if($general_setting['options']['wpvivid_common_setting']['estimate_backup'] == 0){
        ?>
        jQuery('#wpvivid_estimate_backup_info').hide();
        <?php
    }
    if(empty($backup_task['backup']['data'])){
        ?>
        jQuery('#wpvivid_postbox_backup_percent').hide();
        jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'auto', 'opacity': '1'});
        jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'auto', 'opacity': '1'});
        <?php
    }
    else{
        foreach($backup_task['backup']['data'] as $key=>$value){
            if($value['status']['str'] === 'running'){
                $percent=$value['data']['progress'];
                ?>
                jQuery('#wpvivid_postbox_backup_percent').show();
                jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_action_progress_bar_percent').css('width', <?php echo $percent; ?>+'%');
                jQuery('#wpvivid_backup_database_size').html('<?php echo $value['size']['db_size']; ?>');
                jQuery('#wpvivid_backup_file_size').html('<?php echo $value['size']['files_size']['sum']; ?>');
                <?php
                if($value['is_canceled'] == false){
                    $descript=$value['data']['descript'];
                    if($value['data']['type']){
                        $find_str = 'Total size: ';
                        if(stripos($descript, $find_str) != false) {
                            $pos = stripos($descript, $find_str);
                            $descript = substr($descript, 0, $pos);
                        }
                    }
                    $backup_running_time=$value['data']['running_stamp'];
                    $output = '';
                    foreach (array(86400 => 'day', 3600 => 'hour', 60 => 'min', 1 => 'second') as $key => $value) {
                        if ($backup_running_time >= $key) $output .= floor($backup_running_time/$key) . $value;
                        $backup_running_time %= $key;
                    }
                    if($output==''){
                        $output=0;
                    }
                    ?>
                    jQuery('#wpvivid_current_doing').html('<?php echo $descript; ?> Progress: <?php echo $percent; ?>%, running time: <?php echo $output; ?>');
                    <?php
                }
                else{
                    ?>
                    jQuery('#wpvivid_current_doing').html('The backup will be canceled after backing up the current chunk ends.');
                    <?php
                }
            }
        }
    }
}

function wpvivid_download_backup_descript($html){
    $html = '<p><strong>'.__('About backup download', 'wpvivid').'</strong></p>';
    $html .= '<ul>';
    $html .= '<li>'.__('->If backups are stored in remote storage, our plugin will retrieve the backup to your web server first. This may take a little time depending on the size of backup files. Please be patient. Then you can download them to your PC.', 'wpvivid').'</li>';
    $html .= '<li>'.__('->If backups are stored in web server, the plugin will list all relevant files immediately.', 'wpvivid').'</li>';
    $html .= '</ul>';
    return $html;
}

function wpvivid_restore_website_descript($html){
    $html = '<p><a href="#" id="wpvivid_how_to_restore_backup_describe" onclick="wpvivid_click_how_to_restore_backup();" style="text-decoration: none;">'.__('How to restore your website from a backup(scheduled, manual, uploaded and received backup)', 'wpvivid').'</a></p>';
    $html .= '<div id="wpvivid_how_to_restore_backup"></div>';
    return $html;
}

function wpvivid_backuppage_load_backuplist($backuplist_array){
    $backuplist_array['list_backup'] = array('index' => '1', 'tab_func' => 'wpvivid_backuppage_add_tab_backup', 'page_func' => 'wpvivid_backuppage_add_page_backup');
    $backuplist_array['list_log'] = array('index' => '3', 'tab_func' => 'wpvivid_backuppage_add_tab_log', 'page_func' => 'wpvivid_backuppage_add_page_log');
    $backuplist_array['list_restore'] = array('index' => '4', 'tab_func' => 'wpvivid_backuppage_add_tab_restore', 'page_func' => 'wpvivid_backuppage_add_page_restore');
    return $backuplist_array;
}

function wpvivid_backuppage_add_tab_backup(){
    ?>
    <a href="#" id="wpvivid_tab_backup" class="nav-tab backup-nav-tab nav-tab-active" onclick="switchrestoreTabs(event,'page-backups')"><?php _e('Backups', 'wpvivid'); ?></a>
    <?php
}

function wpvivid_backuppage_add_tab_log(){
    ?>
    <a href="#" id="wpvivid_tab_backup_log" class="nav-tab backup-nav-tab delete" onclick="switchrestoreTabs(event,'page-log')" style="display: none;">
        <div style="margin-right: 15px;"><?php _e('Log', 'wpvivid'); ?></div>
        <div class="nav-tab-delete-img">
            <img src="<?php echo esc_url(plugins_url( 'images/delete-tab.png', __FILE__ )); ?>" style="vertical-align:middle; cursor:pointer;" onclick="wpvivid_close_tab(event, 'wpvivid_tab_backup_log', 'backup', 'wpvivid_tab_backup');" />
        </div>
    </a>
    <?php
}

function wpvivid_backuppage_add_tab_restore(){
    ?>
    <a href="#" id="wpvivid_tab_restore" class="nav-tab backup-nav-tab delete" onclick="switchrestoreTabs(event,'page-restore')" style="display: none;">
        <div style="margin-right: 15px;"><?php _e('Restore', 'wpvivid'); ?></div>
        <div class="nav-tab-delete-img">
            <img src="<?php echo esc_url(plugins_url( 'images/delete-tab.png', __FILE__ )); ?>" style="vertical-align:middle; cursor:pointer;" onclick="wpvivid_close_tab(event, 'wpvivid_tab_restore', 'backup', 'wpvivid_tab_backup');" />
        </div>
    </a>
    <?php
}

function wpvivid_backuppage_add_page_backup(){
    $backuplist=WPvivid_Backuplist::get_backuplist();
    $display_backup_count = WPvivid_Setting::get_max_backup_count();
    ?>
    <div class="backup-tab-content wpvivid_tab_backup" id="page-backups">
        <div style="margin-top:10px; margin-bottom:10px;">
            <?php
            $descript='';
            $descript= apply_filters('wpvivid_download_backup_descript',$descript);
            echo $descript;
            ?>
        </div>
        <div style="margin-bottom:10px;">
            <?php
            $descript='';
            $descript= apply_filters('wpvivid_restore_website_descript',$descript);
            echo $descript;
            ?>
        </div>
        <div style="clear:both;"></div>
        <?php
        do_action('wpvivid_rescan_backup_list');
        ?>
        <table class="wp-list-table widefat plugins" id="wpvivid_backuplist_table" style="border-collapse: collapse;">
            <thead>
            <tr class="backup-list-head" style="border-bottom: 0;">
                <td></td>
                <th><?php _e( 'Backup','wpvivid'); ?></th>
                <th><?php _e( 'Storage','wpvivid'); ?></th>
                <th><?php _e( 'Download','wpvivid'); ?></th>
                <th><?php _e( 'Restore', 'wpvivid'); ?></th>
                <th><?php _e( 'Delete','wpvivid'); ?></th>
            </tr>
            </thead>
            <tbody class="wpvivid-backuplist" id="wpvivid_backup_list">
            <?php
            $html = '';
            $html = apply_filters('wpvivid_add_backup_list', $html);
            echo $html;
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th><input name="" type="checkbox" id="backup_list_all_check" value="1" /></th>
                <th class="row-title" colspan="5"><a onclick="wpvivid_delete_backups_inbatches();" style="cursor: pointer;"><?php _e('Delete the selected backups', 'wpvivid'); ?></a></th>
            </tr>
            </tfoot>
        </table>
    </div>
    <script>
        function wpvivid_retrieve_backup_list(){
            var ajax_data = {
                'action': 'wpvivid_get_backup_list'
            };
            wpvivid_post_request(ajax_data, function(data){
                try {
                    var jsonarray = jQuery.parseJSON(data);
                    if (jsonarray.result === 'success') {
                        jQuery('#wpvivid_backup_list').html('');
                        jQuery('#wpvivid_backup_list').append(jsonarray.html);
                    }
                }
                catch(err){
                    alert(err);
                }
            },function(XMLHttpRequest, textStatus, errorThrown) {
                setTimeout(function () {
                    wpvivid_retrieve_backup_list();
                }, 3000);
            });
        }

        function wpvivid_handle_backup_data(data){
            try {
                var jsonarray = jQuery.parseJSON(data);
                if (jsonarray.result === 'success') {
                    jQuery('#wpvivid_backup_list').html('');
                    jQuery('#wpvivid_backup_list').append(jsonarray.html);
                }
                else if(jsonarray.result === 'failed'){
                    alert(jsonarray.error);
                }
            }
            catch(err){
                alert(err);
            }
        }

        function wpvivid_click_check_backup(backup_id, list_name){
            var name = "";
            var all_check = true;
            jQuery('#'+list_name+' tr').each(function (i) {
                jQuery(this).children('th').each(function (j) {
                    if(j === 0) {
                        var id = jQuery(this).find("input[type=checkbox]").attr("id");
                        if (id === backup_id) {
                            name = jQuery(this).parent().children('td').eq(0).find("img").attr("name");
                            if (name === "unlock") {
                                if (jQuery(this).find("input[type=checkbox]").prop('checked') === false) {
                                    all_check = false;
                                }
                            }
                            else {
                                jQuery(this).find("input[type=checkbox]").prop('checked', false);
                                all_check = false;
                            }
                        }
                        else {
                            if (jQuery(this).find("input[type=checkbox]").prop('checked') === false) {
                                all_check = false;
                            }
                        }
                    }
                });
            });
            if(all_check === true){
                jQuery('#backup_list_all_check').prop('checked', true);
            }
            else{
                jQuery('#backup_list_all_check').prop('checked', false);
            }
        }

        function wpvivid_set_backup_lock(backup_id, lock_status){
            var max_count_limit = '<?php echo $display_backup_count; ?>';
            var check_status = true;
            if(lock_status === "lock"){
                var lock=0;
            }
            else{
                var lock=1;
                var check_can_lock=false;
                var baackup_list_count = jQuery('#wpvivid_backup_list').find('tr').length;
                if(baackup_list_count >= max_count_limit) {
                    jQuery('#wpvivid_backup_list').find('tr').find('td:eq(0)').find('span:eq(0)').each(function () {
                        var span_id = jQuery(this).attr('id');
                        span_id = span_id.replace('wpvivid_lock_', '');
                        if (span_id !== backup_id) {
                            var name = jQuery(this).find('img:eq(0)').attr('name');
                            if (name === 'unlock') {
                                check_can_lock = true;
                                return false;
                            }
                        }
                    });
                    if (!check_can_lock) {
                        check_status = false;
                        alert('The locked backups will reach the maximum limits of retained backups, which causes being unable to create a new backup. So, please unlock one of them and continue.');
                    }
                }
            }
            if(check_status) {
                var ajax_data = {
                    'action': 'wpvivid_set_security_lock',
                    'backup_id': backup_id,
                    'lock': lock
                };
                wpvivid_post_request(ajax_data, function (data) {
                    try {
                        var jsonarray = jQuery.parseJSON(data);
                        if (jsonarray.result === 'success') {
                            jQuery('#wpvivid_lock_' + backup_id).html(jsonarray.html);
                        }
                    }
                    catch (err) {
                        alert(err);
                    }
                }, function (XMLHttpRequest, textStatus, errorThrown) {
                    var error_message = wpvivid_output_ajaxerror('setting up a lock for the backup', textStatus, errorThrown);
                    alert(error_message);
                });
            }
        }

        function wpvivid_read_log(action, param){
            var tab_id = '';
            var content_id = '';
            var ajax_data = '';
            var show_page = '';
            if(typeof param === 'undefined')    param = '';
            switch(action){
                case 'wpvivid_view_backup_task_log':
                    ajax_data = {
                        'action':action,
                        'id':running_backup_taskid
                    };
                    tab_id = 'wpvivid_tab_backup_log';
                    content_id = 'wpvivid_display_log_content';
                    show_page = 'backup_page';
                    break;
                case 'wpvivid_read_last_backup_log':
                    var ajax_data = {
                        'action': action,
                        'log_file_name': param
                    };
                    tab_id = 'wpvivid_tab_backup_log';
                    content_id = 'wpvivid_display_log_content';
                    show_page = 'backup_page';
                    break;
                case 'wpvivid_view_backup_log':
                    var ajax_data={
                        'action':action,
                        'id':param
                    };
                    tab_id = 'wpvivid_tab_backup_log';
                    content_id = 'wpvivid_display_log_content';
                    show_page = 'backup_page';
                    break;
                case 'wpvivid_view_log':
                    var ajax_data={
                        'action':action,
                        'path':param
                    };
                    tab_id = 'wpvivid_tab_read_log';
                    content_id = 'wpvivid_read_log_content';
                    show_page = 'log_page';
                    break;
                default:
                    break;
            }
            jQuery('#'+tab_id).show();
            jQuery('#'+content_id).html("");
            if(show_page === 'backup_page'){
                //wpvivid_click_switch_backup_page(tab_id);
                wpvivid_click_switch_page('backup', tab_id, true);
            }
            else if(show_page === 'log_page') {
                wpvivid_click_switch_page('wrap', tab_id, true);
            }
            wpvivid_post_request(ajax_data, function(data){
                wpvivid_show_log(data, content_id);
            }, function(XMLHttpRequest, textStatus, errorThrown) {
                var div = 'Reading the log failed. Please try again.';
                jQuery('#wpvivid_display_log_content').html(div);
            });
        }

        function wpvivid_initialize_download(backup_id, list_name){
            wpvivid_reset_backup_list(list_name);
            jQuery('#wpvivid_download_loading_'+backup_id).addClass('is-active');
            tmp_current_click_backupid = backup_id;
            var ajax_data = {
                'action':'wpvivid_init_download_page',
                'backup_id':backup_id
            };
            wpvivid_post_request(ajax_data, function(data){
                try {
                    var jsonarray = jQuery.parseJSON(data);
                    jQuery('#wpvivid_download_loading_'+backup_id).removeClass('is-active');
                    if (jsonarray.result === 'success') {
                        jQuery('#wpvivid_file_part_' + backup_id).html("");
                        var i = 0;
                        var file_not_found = false;
                        var file_name = '';
                        jQuery.each(jsonarray.files, function (index, value) {
                            i++;
                            file_name = index;
                            if (value.status === 'need_download') {
                                jQuery('#wpvivid_file_part_' + backup_id).append(value.html);
                                //tmp_current_click_backupid = '';
                            }
                            else if (value.status === 'running') {
                                if (m_downloading_file_name === file_name) {
                                    wpvivid_lock_download(tmp_current_click_backupid);
                                }
                                jQuery('#wpvivid_file_part_' + backup_id).append(value.html);
                            }
                            else if (value.status === 'completed') {
                                if (m_downloading_file_name === file_name) {
                                    wpvivid_unlock_download(tmp_current_click_backupid);
                                    m_downloading_id = '';
                                    m_downloading_file_name = '';
                                }
                                jQuery('#wpvivid_file_part_' + backup_id).append(value.html);
                                //tmp_current_click_backupid = '';
                            }
                            else if (value.status === 'timeout') {
                                if (m_downloading_file_name === file_name) {
                                    wpvivid_unlock_download(tmp_current_click_backupid);
                                    m_downloading_id = '';
                                    m_downloading_file_name = '';
                                }
                                jQuery('#wpvivid_file_part_' + backup_id).append(value.html);
                                //tmp_current_click_backupid = '';
                            }
                            else if (value.status === 'file_not_found') {
                                wpvivid_unlock_download(tmp_current_click_backupid);
                                wpvivid_reset_backup_list(list_name);
                                file_not_found = true;
                                alert("Download failed, file not found. The file might has been moved, renamed or deleted. Please verify the file exists and try again.");
                                //tmp_current_click_backupid = '';
                                return false;
                            }
                        });
                        if (file_not_found === false) {
                            jQuery('#wpvivid_file_part_' + backup_id).append(jsonarray.place_html);
                        }
                    }
                }
                catch(err){
                    alert(err);
                    jQuery('#wpvivid_download_loading_'+backup_id).removeClass('is-active');
                }
            },function(XMLHttpRequest, textStatus, errorThrown){
                jQuery('#wpvivid_download_loading_'+backup_id).removeClass('is-active');
                var error_message = wpvivid_output_ajaxerror('initializing download information', textStatus, errorThrown);
                alert(error_message);
            });
        }

        function wpvivid_reset_backup_list(list_name){
            jQuery('#'+list_name+' tr').each(function(i){
                jQuery(this).children('td').each(function (j) {
                    if (j == 2) {
                        var backup_id = jQuery(this).parent().children('th').find("input[type=checkbox]").attr("id");
                        var download_btn = '<div id="wpvivid_file_part_' + backup_id + '" style="float:left;padding:10px 10px 10px 0px;">' +
                            '<div style="cursor:pointer;" onclick="wpvivid_initialize_download(\'' + backup_id + '\', \''+list_name+'\');" title="Prepare to download the backup">' +
                            '<img id="wpvivid_download_btn_' + backup_id + '" src="' + wpvivid_plugurl + '/admin/partials/images/download.png" style="vertical-align:middle;" />Download' +
                            '<div class="spinner" id="wpvivid_download_loading_' + backup_id + '" style="float:right;width:auto;height:auto;padding:10px 180px 10px 0;background-position:0 0;"></div>' +
                            '</div>' +
                            '</div>';
                        jQuery(this).html(download_btn);
                    }
                });
            });
        }

        function wpvivid_lock_download(backup_id){
            jQuery('#wpvivid_backup_list tr').each(function(i){
                jQuery(this).children('td').each(function (j) {
                    if (j == 2) {
                        jQuery(this).css({'pointer-events': 'none', 'opacity': '0.4'});
                    }
                });
            });
        }

        function wpvivid_unlock_download(backup_id){
            jQuery('#wpvivid_backup_list tr').each(function(i){
                jQuery(this).children('td').each(function (j) {
                    if (j == 2) {
                        jQuery(this).css({'pointer-events': 'auto', 'opacity': '1'});
                    }
                });
            });
        }

        /**
         * Start downloading backup
         *
         * @param part_num  - The part number for the download object
         * @param backup_id - The unique ID for the backup
         * @param file_name - File name
         */
        function wpvivid_prepare_download(part_num, backup_id, file_name){
            var ajax_data = {
                'action': 'wpvivid_prepare_download_backup',
                'backup_id':backup_id,
                'file_name':file_name
            };
            var progress = '0%';
            jQuery("#"+backup_id+"-text-part-"+part_num).html("<a>Retriving(remote storage to web server)</a>");
            jQuery("#"+backup_id+"-progress-part-"+part_num).css('width', progress);
            task_retry_times = 0;
            m_need_update = true;
            wpvivid_lock_download(backup_id);
            m_downloading_id = backup_id;
            tmp_current_click_backupid = backup_id;
            m_downloading_file_name = file_name;
            wpvivid_post_request(ajax_data, function(data)
            {
            }, function(XMLHttpRequest, textStatus, errorThrown)
            {
            }, 0);
        }

        /**
         * Download backups to user's computer.
         *
         * @param backup_id     - The unique ID for the backup
         * @param backup_type   - The types of the backup
         * @param file_name     - File name
         */
        function wpvivid_download(backup_id, backup_type, file_name){
            wpvivid_location_href=true;
            location.href =ajaxurl+'?action=wpvivid_download_backup&backup_id='+backup_id+'&download_type='+backup_type+'&file_name='+file_name;
        }

        function wpvivid_initialize_restore(backup_id, backup_time, backup_type, restore_type='backup'){
            var time_type = 'backup';
            var log_type = '';
            var tab_type = '';
            var page_type = 'backup';
            if(restore_type == 'backup'){
                time_type = 'backup';
                log_type = '';
                tab_type = '';
                page_type = 'backup';
            }
            else if(restore_type == 'transfer'){
                time_type = 'transfer';
                log_type = 'transfer_';
                tab_type = 'add_';
                page_type = 'migrate';
            }
            wpvivid_restore_backup_type = backup_type;
            jQuery('#wpvivid_restore_'+time_type+'_time').html(backup_time);
            m_restore_backup_id = backup_id;
            jQuery('#wpvivid_restore_'+log_type+'log').html("");
            jQuery('#wpvivid_'+tab_type+'tab_restore').show();
            wpvivid_click_switch_page(page_type, 'wpvivid_'+tab_type+'tab_restore', true);
            wpvivid_init_restore_data(restore_type);
        }

        function click_dismiss_restore_check_notice(obj){
            wpvivid_display_restore_check = false;
            jQuery(obj).parent().remove();
        }

        /**
         * This function will initialize restore information
         *
         * @param backup_id - The unique ID for the backup
         */
        function wpvivid_init_restore_data(restore_type)
        {
            wpvivid_resotre_is_migrate=0;
            var restore_method = '';
            if(restore_type == 'backup'){
                restore_method = '';
            }
            else if(restore_type == 'transfer'){
                restore_method = 'transfer_';
            }
            jQuery('#wpvivid_replace_domain').prop('checked', false);
            jQuery('#wpvivid_keep_domain').prop('checked', false);
            jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
            jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
            jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
            jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
            jQuery('#wpvivid_restore_'+restore_method+'part').show();
            jQuery('#wpvivid_clean_'+restore_method+'part').hide();
            jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
            jQuery('#wpvivid_download_'+restore_method+'part').hide();

            jQuery('#wpvivid_init_restore_data').addClass('is-active');
            var ajax_data = {
                'action':'wpvivid_init_restore_page',
                'backup_id':m_restore_backup_id
            };
            wpvivid_post_request(ajax_data, function(data){
                try {
                    var jsonarray = jQuery.parseJSON(data);
                    var init_status = false;
                    if(jsonarray.result === 'success') {
                        jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                        jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                        jQuery('#wpvivid_restore_'+restore_method+'part').show();
                        jQuery('#wpvivid_download_'+restore_method+'part').hide();
                        wpvivid_restore_need_download = false;
                        init_status = true;
                    }
                    else if (jsonarray.result === "need_download"){
                        init_status = true;
                        wpvivid_restore_download_array = new Array();
                        var download_num = 0;
                        jQuery.each(jsonarray.files, function (index, value)
                        {
                            if (value.status === "need_download")
                            {
                                wpvivid_restore_download_array[download_num] = new Array('file_name', 'size', 'md5');
                                wpvivid_restore_download_array[download_num]['file_name'] = index;
                                wpvivid_restore_download_array[download_num]['size'] = value.size;
                                wpvivid_restore_download_array[download_num]['md5'] = value.md5;
                                download_num++;
                            }
                        });
                        wpvivid_restore_download_index=0;
                        wpvivid_restore_need_download = true;
                        jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                        jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                        jQuery('#wpvivid_restore_'+restore_method+'part').hide();
                        jQuery('#wpvivid_download_'+restore_method+'part').show();
                    }
                    else if (jsonarray.result === "failed") {
                        jQuery('#wpvivid_init_restore_data').removeClass('is-active');
                        wpvivid_display_restore_msg(jsonarray.error, restore_type);
                    }

                    if(init_status){
                        if(jsonarray.max_allow_packet_warning != false || jsonarray.memory_limit_warning != false) {
                            if(!wpvivid_display_restore_check) {
                                wpvivid_display_restore_check = true;
                                var output = '';
                                if(jsonarray.max_allow_packet_warning != false){
                                    output += "<p>" + jsonarray.max_allow_packet_warning + "</p>";
                                }
                                if(jsonarray.memory_limit_warning != false){
                                    output += "<p>" + jsonarray.memory_limit_warning + "</p>";
                                }
                                var div = "<div class='notice notice-warning is-dismissible inline'>" +
                                    output +
                                    "<button type='button' class='notice-dismiss' onclick='click_dismiss_restore_check_notice(this);'>" +
                                    "<span class='screen-reader-text'>Dismiss this notice.</span>" +
                                    "</button>" +
                                    "</div>";
                                jQuery('#wpvivid_restore_check').append(div);
                            }
                        }
                        jQuery('#wpvivid_init_restore_data').removeClass('is-active');
                        if (jsonarray.has_exist_restore === 0) {
                            if(wpvivid_restore_need_download == false) {
                                jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                jQuery('#wpvivid_clean_' + restore_method + 'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                                jQuery('#wpvivid_rollback_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                                jQuery('#wpvivid_restore_' + restore_method + 'part').show();
                                jQuery('#wpvivid_clean_' + restore_method + 'part').hide();
                                jQuery('#wpvivid_rollback_' + restore_method + 'part').hide();
                                jQuery('#wpvivid_restore_is_migrate').css({'pointer-events': 'auto', 'opacity': '1'});

                                jQuery('#wpvivid_restore_is_migrate').hide();
                                jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});

                                wpvivid_resotre_is_migrate = jsonarray.is_migrate;

                                if (jsonarray.is_migrate_ui === 1) {
                                    jQuery('#wpvivid_restore_is_migrate').show()
                                    jQuery('#wpvivid_replace_domain').prop('checked', false);
                                    jQuery('#wpvivid_keep_domain').prop('checked', false);
                                }
                                else {
                                    jQuery('#wpvivid_restore_is_migrate').hide();
                                    jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                }

                                wpvivid_interface_flow_control();
                            }
                        }
                        else if (jsonarray.has_exist_restore === 1) {
                            jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                            jQuery('#wpvivid_clean_' + restore_method + 'restore').css({'pointer-events': 'auto', 'opacity': '1'});
                            jQuery('#wpvivid_rollback_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                            jQuery('#wpvivid_restore_'+restore_method+'part').hide();
                            jQuery('#wpvivid_clean_'+restore_method+'part').show();
                            jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
                            jQuery('#wpvivid_restore_is_migrate').hide();
                            wpvivid_display_restore_msg("An uncompleted restore task exists, please terminate it first.", restore_type);
                        }
                    }
                }
                catch(err){
                    alert(err);
                }
            }, function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery('#wpvivid_init_restore_data').removeClass('is-active');
                var error_message = wpvivid_output_ajaxerror('initializing restore information', textStatus, errorThrown);
                wpvivid_display_restore_msg(error_message, restore_type);
            });
        }

        function wpvivid_delete_selected_backup(backup_id, list_name){
            var name = '';
            jQuery('#wpvivid_backup_list tr').each(function(i){
                jQuery(this).children('td').each(function (j) {
                    if (j == 0) {
                        var id = jQuery(this).parent().children('th').find("input[type=checkbox]").attr("id");
                        if(id === backup_id){
                            name = jQuery(this).parent().children('td').eq(0).find('img').attr('name');
                        }
                    }
                });
            });
            var descript = '';
            var force_del = 0;
            var bdownloading = false;
            if(name === 'lock') {
                descript = '<?php _e('This backup is locked, are you sure to remove it? This backup will be deleted permanently from your hosting (localhost) and remote storages.', 'wpvivid'); ?>';
                force_del = 1;
            }
            else{
                descript = '<?php _e('Are you sure to remove this backup? This backup will be deleted permanently from your hosting (localhost) and remote storages.', 'wpvivid'); ?>';
                force_del = 0;
            }
            if(m_downloading_id === backup_id){
                bdownloading = true;
                descript = '<?php _e('This request will delete the backup being downloaded, are you sure you want to continue?', 'wpvivid'); ?>';
                force_del = 1;
            }
            var ret = confirm(descript);
            if(ret === true){
                var ajax_data={
                    'action': 'wpvivid_delete_backup',
                    'backup_id': backup_id,
                    'force': force_del
                };
                wpvivid_post_request(ajax_data, function(data){
                    wpvivid_handle_backup_data(data);
                    if(bdownloading){
                        m_downloading_id = '';
                    }
                }, function(XMLHttpRequest, textStatus, errorThrown) {
                    var error_message = wpvivid_output_ajaxerror('deleting the backup', textStatus, errorThrown);
                    alert(error_message);
                });
            }
        }
        function wpvivid_delete_backups_inbatches(){
            var delete_backup_array = new Array();
            var count = 0;
            var bdownloading = false;
            jQuery('#wpvivid_backup_list tr').each(function (i) {
                jQuery(this).children('th').each(function (j) {
                    if (j == 0) {
                        if(jQuery(this).find('input[type=checkbox]').prop('checked')){
                            delete_backup_array[count] = jQuery(this).find('input[type=checkbox]').attr('id');
                            if(m_downloading_id === jQuery(this).find('input[type=checkbox]').attr('id')){
                                bdownloading = true;
                            }
                            count++;
                        }
                    }
                });
            });
            if( count === 0 ){
                alert('<?php _e('Please select at least one item.','wpvivid'); ?>');
            }
            else {
                var descript = '';
                if(bdownloading) {
                    descript = '<?php _e('This request might delete the backup being downloaded, are you sure you want to continue?', 'wpvivid'); ?>';
                }
                else{
                    descript = '<?php _e('Are you sure to remove the selected backups? These backups will be deleted permanently from your hosting (localhost).', 'wpvivid'); ?>';
                }
                var ret = confirm(descript);
                if (ret === true) {
                    var ajax_data = {
                        'action': 'wpvivid_delete_backup_array',
                        'backup_id': delete_backup_array
                    };
                    wpvivid_post_request(ajax_data, function (data) {
                        wpvivid_handle_backup_data(data);
                        jQuery('#backup_list_all_check').prop('checked', false);
                        if(bdownloading){
                            m_downloading_id = '';
                        }
                    }, function (XMLHttpRequest, textStatus, errorThrown) {
                        var error_message = wpvivid_output_ajaxerror('deleting the backup', textStatus, errorThrown);
                        alert(error_message);
                    });
                }
            }
        }

        jQuery('#backup_list_all_check').click(function(){
            var name = '';
            if(jQuery('#backup_list_all_check').prop('checked')) {
                jQuery('#wpvivid_backup_list tr').each(function (i) {
                    jQuery(this).children('th').each(function (j) {
                        if (j == 0) {
                            name = jQuery(this).parent().children('td').eq(0).find("img").attr("name");
                            if(name === 'unlock') {
                                jQuery(this).find("input[type=checkbox]").prop('checked', true);
                            }
                            else{
                                jQuery(this).find("input[type=checkbox]").prop('checked', false);
                            }
                        }
                    });
                });
            }
            else{
                jQuery('#wpvivid_backup_list tr').each(function (i) {
                    jQuery(this).children('th').each(function (j) {
                        if (j == 0) {
                            jQuery(this).find("input[type=checkbox]").prop('checked', false);
                        }
                    });
                });
            }
        });
    </script>
    <?php
}

function wpvivid_backuppage_add_page_log(){
    ?>
    <div class="backup-tab-content wpvivid_tab_backup_log" id="page-log" style="display:none;">
        <div class="postbox restore_log" id="wpvivid_display_log_content">
            <div></div>
        </div>
    </div>
    <?php
}

function wpvivid_backuppage_add_page_restore(){
    ?>
    <div class="backup-tab-content wpvivid_tab_restore" id="page-restore" style="display:none;">
        <div>
            <h3><?php _e('Restore backup from:', 'wpvivid'); ?><span id="wpvivid_restore_backup_time"></span></h3>
            <p><strong><?php _e('Please do not close the page or switch to other pages when a restore task is running, as it could trigger some unexpected errors.', 'wpvivid'); ?></strong></p>
            <p><?php _e('Restore function will replace the current site\'s themes, plugins, uploads, database and/or other content directories with the existing equivalents in the selected backup.', 'wpvivid'); ?></p>
            <div id="wpvivid_restore_is_migrate" style="padding-bottom: 10px; display: none;">
                <label >
                    <input type="radio" id="wpvivid_replace_domain" option="restore" name="restore_domain" value="1" /><?php echo 'Restore and replace the original domain (URL) with '.home_url().' (migration)'; ?>
                </label><br>
                <label >
                    <input type="radio" id="wpvivid_keep_domain" option="restore" name="restore_domain" value="0" /><?php _e('Restore and keep the original domain (URL) unchanged', 'wpvivid'); ?>
                </label><br>
            </div>
            <div>
                <p><strong>Tips:</strong> The plugin detects automatically either site restoration or migration (replacing the domain name) based on the current domain name. If the domain name in backup file is same as the current one, it starts restoring. On the contrary, restoring backup means to replace with the current domain name. The precondition is that the backup is created by version 0.9.21 or later.</p>
            </div>
            <div id="wpvivid_restore_check"></div>
            <div class="restore-button-position" id="wpvivid_restore_part"><input class="button-primary" id="wpvivid_restore_btn" type="submit" name="restore" value="<?php esc_attr_e( 'Restore', 'wpvivid' ); ?>" onclick="wpvivid_start_restore();" /></div>
            <div class="restore-button-position" id="wpvivid_clean_part"><input class="button-primary" id="wpvivid_clean_restore" type="submit" name="clear_restore" value="<?php esc_attr_e( 'Terminate', 'wpvivid' ); ?>" /></div>
            <div class="restore-button-position" id="wpvivid_rollback_part"><input class="button-primary" id="wpvivid_rollback_btn" type="submit" name="rollback" value="<?php esc_attr_e( 'Rollback', 'wpvivid' ); ?>" /></div>
            <div class="restore-button-position" id="wpvivid_download_part">
                <input class="button-primary" id="wpvivid_download_btn" type="submit" name="download" value="<?php esc_attr_e( 'Retrieve the backup to localhost', 'wpvivid' ); ?>" />
                <span>The backup is stored on the remote storage, click on the button to download it to localhost.</span>
            </div>
            <div class="spinner" id="wpvivid_init_restore_data" style="float:left;width:auto;height:auto;padding:10px 20px 20px 0;background-position:0 10px;"></div>
        </div>
        <div class="postbox restore_log" id="wpvivid_restore_log"></div>
    </div>
    <script>
        jQuery('#wpvivid_clean_restore').click(function(){
            wpvivid_delete_incompleted_restore();
        });

        jQuery('#wpvivid_download_btn').click(function(){
            wpvivid_download_restore_file('backup');
        });

        function wpvivid_delete_incompleted_restore(restore_type = 'backup'){
            var restore_method = '';
            if(restore_type == 'backup'){
                restore_method = '';
            }
            else if(restore_type == 'transfer'){
                restore_method = 'transfer_';
            }

            var ajax_data={
                'action': 'wpvivid_delete_last_restore_data'
            };
            jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
            jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
            jQuery('#wpvivid_restore_'+restore_method+'part').hide();
            jQuery('#wpvivid_clean_'+restore_method+'part').show();
            jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
            wpvivid_post_request(ajax_data, function(data) {
                try {
                    var jsonarray = jQuery.parseJSON(data);
                    if (jsonarray.result === "success") {
                        wpvivid_display_restore_msg("The restore task is terminated.", restore_type);
                        wpvivid_init_restore_data(restore_type);
                    }
                }
                catch(err){
                    alert(err);
                }
            }, function(XMLHttpRequest, textStatus, errorThrown) {
                var error_message = wpvivid_output_ajaxerror('deleting the last incomplete restore task', textStatus, errorThrown);
                wpvivid_display_restore_msg(error_message, restore_type);
            });
        }

        function wpvivid_restore_is_migrate(restore_type){
            var ajax_data = {
                'action': 'wpvivid_get_restore_file_is_migrate',
                'backup_id': m_restore_backup_id
            };
            var restore_method = '';
            wpvivid_post_request(ajax_data, function(data)
            {
                try
                {
                    var jsonarray = jQuery.parseJSON(data);
                    if(jsonarray.result === "success")
                    {
                        if (jsonarray.is_migrate_ui === 1)
                        {
                            jQuery('#wpvivid_restore_is_migrate').show();
                            jQuery('#wpvivid_replace_domain').prop('checked', false);
                            jQuery('#wpvivid_keep_domain').prop('checked', false);
                        }
                        else {
                            jQuery('#wpvivid_restore_is_migrate').hide();
                            jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                        }
                    }
                    else if (jsonarray.result === "failed") {
                        jQuery('#wpvivid_init_restore_data').removeClass('is-active');
                        wpvivid_display_restore_msg(jsonarray.error, restore_type);
                    }
                }
                catch(err){
                    alert(err);
                }
            }, function(XMLHttpRequest, textStatus, errorThrown)
            {
                setTimeout(function()
                {
                    wpvivid_restore_is_migrate(restore_type);
                }, 3000);
            });
        }

        /**
         * This function will start the process of restoring a backup
         */
        function wpvivid_start_restore(restore_type = 'backup'){
            if(!wpvivid_restore_sure){
                var descript = 'Are you sure to continue?';
                var ret = confirm(descript);
            }
            else{
                ret = true;
            }
            if (ret === true) {
                wpvivid_restore_sure = true;
                var restore_method = '';
                if (restore_type == 'backup') {
                    restore_method = '';
                }
                else if (restore_type == 'transfer') {
                    restore_method = 'transfer_';
                }
                jQuery('#wpvivid_restore_' + restore_method + 'log').html("");
                jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_clean_' + restore_method + 'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_rollback_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_restore_' + restore_method + 'part').show();
                jQuery('#wpvivid_clean_' + restore_method + 'part').hide();
                jQuery('#wpvivid_rollback_' + restore_method + 'part').hide();
                wpvivid_restore_lock();
                wpvivid_restoring = true;
                if (wpvivid_restore_need_download) {
                    wpvivid_download_restore_file(restore_type);
                }
                else {
                    wpvivid_monitor_restore_task(restore_type);
                    if(wpvivid_resotre_is_migrate==0)
                    {
                        jQuery('input:radio[option=restore]').each(function()
                        {
                            if(jQuery(this).prop('checked'))
                            {
                                var value = jQuery(this).prop('value');
                                if(value == '1')
                                {
                                    wpvivid_resotre_is_migrate = '1';
                                }
                            }
                        });
                    }

                    wpvivid_restore(restore_type);
                }
            }
        }

        function wpvivid_download_restore_file(restore_type)
        {
            var restore_method = '';
            if(restore_type == 'backup'){
                restore_method = '';
            }
            else if(restore_type == 'transfer'){
                restore_method = 'transfer_';
            }

            jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
            wpvivid_restore_lock();
            if(wpvivid_restore_download_array.length===0)
            {
                wpvivid_display_restore_msg("Downloading backup file failed. Backup file might be deleted or network doesn't work properly. Please verify the file and confirm the network connection and try again later.", restore_type);
                wpvivid_restore_unlock();
                return false;
            }

            if(wpvivid_restore_download_index+1>wpvivid_restore_download_array.length)
            {
                wpvivid_display_restore_msg("Download succeeded.", restore_type);
                wpvivid_restore_is_migrate(restore_type);
                wpvivid_restore_need_download = false;
                jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                jQuery('#wpvivid_clean_' + restore_method + 'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_rollback_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_restore_' + restore_method + 'part').show();
                jQuery('#wpvivid_clean_' + restore_method + 'part').hide();
                jQuery('#wpvivid_rollback_' + restore_method + 'part').hide();
                jQuery('#wpvivid_download_'+restore_method+'part').hide();
                //wpvivid_start_restore(restore_type);
            }
            else
            {
                wpvivid_display_restore_msg("Downloading backup file " +  wpvivid_restore_download_array[wpvivid_restore_download_index]['file_name'], restore_type);
                wpvivid_display_restore_msg('', restore_type, wpvivid_restore_download_index);
                var ajax_data = {
                    'action': 'wpvivid_download_restore',
                    'backup_id': m_restore_backup_id,
                    'file_name': wpvivid_restore_download_array[wpvivid_restore_download_index]['file_name'],
                    'size': wpvivid_restore_download_array[wpvivid_restore_download_index]['size'],
                    'md5': wpvivid_restore_download_array[wpvivid_restore_download_index]['md5']
                }
                wpvivid_get_download_restore_progress_retry=0;
                wpvivid_monitor_download_restore_task(restore_type);
                wpvivid_post_request(ajax_data, function (data) {
                }, function (XMLHttpRequest, textStatus, errorThrown) {
                }, 0);
            }
        }

        function wpvivid_monitor_download_restore_task(restore_type)
        {
            var restore_method = '';
            if(restore_type == 'backup'){
                restore_method = '';
            }
            else if(restore_type == 'transfer'){
                restore_method = 'transfer_';
            }

            var ajax_data={
                'action':'wpvivid_get_download_restore_progress',
                'file_name': wpvivid_restore_download_array[wpvivid_restore_download_index]['file_name'],
                'size': wpvivid_restore_download_array[wpvivid_restore_download_index]['size'],
                'md5': wpvivid_restore_download_array[wpvivid_restore_download_index]['md5']
            };

            wpvivid_post_request(ajax_data, function(data)
            {
                try
                {
                    var jsonarray = jQuery.parseJSON(data);
                    if(typeof jsonarray ==='object')
                    {
                        if(jsonarray.result === "success")
                        {
                            if(jsonarray.status==='completed')
                            {
                                wpvivid_display_restore_msg(wpvivid_restore_download_array[wpvivid_restore_download_index]['file_name'] + ' download succeeded.', restore_type, wpvivid_restore_download_index, false);
                                wpvivid_restore_download_index++;
                                wpvivid_download_restore_file(restore_type);
                                wpvivid_restore_unlock();
                            }
                            else if(jsonarray.status==='error')
                            {
                                jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                                jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                                jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                                jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                jQuery('#wpvivid_restore_'+restore_method+'part').hide();
                                jQuery('#wpvivid_clean_'+restore_method+'part').hide();
                                jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
                                jQuery('#wpvivid_download_'+restore_method+'part').show();
                                var error_message = jsonarray.error;
                                wpvivid_display_restore_msg(error_message,restore_type,wpvivid_restore_download_array[wpvivid_restore_download_index]['file_name'],false);
                                wpvivid_restore_unlock();
                            }
                            else if(jsonarray.status==='running')
                            {
                                jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                                wpvivid_display_restore_msg(jsonarray.log, restore_type, wpvivid_restore_download_index, false);
                                setTimeout(function()
                                {
                                    wpvivid_monitor_download_restore_task(restore_type);
                                }, 3000);
                                wpvivid_restore_lock();
                            }
                            else if(jsonarray.status==='timeout')
                            {
                                wpvivid_get_download_restore_progress_retry++;
                                if(wpvivid_get_download_restore_progress_retry>10)
                                {
                                    jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                                    jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                                    jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                                    jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                    jQuery('#wpvivid_restore_'+restore_method+'part').hide();
                                    jQuery('#wpvivid_clean_'+restore_method+'part').hide();
                                    jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
                                    jQuery('#wpvivid_download_'+restore_method+'part').show();
                                    var error_message = jsonarray.error;
                                    wpvivid_display_restore_msg(error_message, restore_type);
                                    wpvivid_restore_unlock();
                                }
                                else
                                {
                                    setTimeout(function()
                                    {
                                        wpvivid_monitor_download_restore_task(restore_type);
                                    }, 3000);
                                }
                            }
                            else
                            {
                                setTimeout(function()
                                {
                                    wpvivid_monitor_download_restore_task(restore_type);
                                }, 3000);
                            }
                        }
                        else
                        {
                            wpvivid_get_download_restore_progress_retry++;
                            if(wpvivid_get_download_restore_progress_retry>10)
                            {
                                jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                                jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                                jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                                jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                jQuery('#wpvivid_restore_'+restore_method+'part').hide();
                                jQuery('#wpvivid_clean_'+restore_method+'part').hide();
                                jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
                                jQuery('#wpvivid_download_'+restore_method+'part').show();
                                var error_message = jsonarray.error;
                                wpvivid_display_restore_msg(error_message, restore_type);
                                wpvivid_restore_unlock();
                            }
                            else
                            {
                                setTimeout(function()
                                {
                                    wpvivid_monitor_download_restore_task(restore_type);
                                }, 3000);
                            }
                        }
                    }
                    else
                    {
                        setTimeout(function()
                        {
                            wpvivid_monitor_download_restore_task(restore_type);
                        }, 3000);
                    }
                }
                catch(err){
                    setTimeout(function()
                    {
                        wpvivid_monitor_download_restore_task(restore_type);
                    }, 3000);
                }
            }, function(XMLHttpRequest, textStatus, errorThrown)
            {
                setTimeout(function()
                {
                    wpvivid_monitor_download_restore_task(restore_type);
                }, 1000);
            });
        }

        /**
         * Monitor restore task.
         */
        function wpvivid_monitor_restore_task(restore_type){
            var restore_method = '';
            if(restore_type == 'backup'){
                restore_method = '';
            }
            else if(restore_type == 'transfer'){
                restore_method = 'transfer_';
            }

            var ajax_data={
                'action':'wpvivid_get_restore_progress',
                'wpvivid_restore' : '1',
            };

            if(wpvivid_restore_timeout){
                jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_restore_'+restore_method+'part').show();
                jQuery('#wpvivid_clean_'+restore_method+'part').hide();
                jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
                wpvivid_restore_unlock();
                wpvivid_restoring = false;
                wpvivid_display_restore_msg("Website restore times out.", restore_type);
            }
            else {
                wpvivid_post_request(ajax_data, function (data) {
                    try {
                        var jsonarray = jQuery.parseJSON(data);
                        if (typeof jsonarray === 'object') {
                            if (jsonarray.result === "success") {
                                jQuery('#wpvivid_restore_' + restore_method + 'log').html("");
                                while (jsonarray.log.indexOf('\n') >= 0) {
                                    var iLength = jsonarray.log.indexOf('\n');
                                    var log = jsonarray.log.substring(0, iLength);
                                    jsonarray.log = jsonarray.log.substring(iLength + 1);
                                    var insert_log = "<div style=\"clear:both;\">" + log + "</div>";
                                    jQuery('#wpvivid_restore_' + restore_method + 'log').append(insert_log);
                                    var div = jQuery('#wpvivid_restore_' + restore_method + 'log');
                                    div[0].scrollTop = div[0].scrollHeight;
                                }

                                if (jsonarray.status === 'wait') {
                                    wpvivid_restoring = true;
                                    jQuery('#wpvivid_restore_' + restore_method + 'btn').css({
                                        'pointer-events': 'none',
                                        'opacity': '0.4'
                                    });
                                    jQuery('#wpvivid_clean_' + restore_method + 'restore').css({
                                        'pointer-events': 'none',
                                        'opacity': '0.4'
                                    });
                                    jQuery('#wpvivid_rollback_' + restore_method + 'btn').css({
                                        'pointer-events': 'none',
                                        'opacity': '0.4'
                                    });
                                    jQuery('#wpvivid_restore_' + restore_method + 'part').show();
                                    jQuery('#wpvivid_clean_' + restore_method + 'part').hide();
                                    jQuery('#wpvivid_rollback_' + restore_method + 'part').hide();
                                    wpvivid_restore(restore_type);
                                    setTimeout(function () {
                                        wpvivid_monitor_restore_task(restore_type);
                                    }, 1000);
                                }
                                else if (jsonarray.status === 'completed') {
                                    wpvivid_restoring = false;
                                    wpvivid_restore(restore_type);
                                    wpvivid_restore_unlock();
                                    alert("Restore completed successfully.");
                                    location.reload();
                                }
                                else if (jsonarray.status === 'error') {
                                    wpvivid_restore_unlock();
                                    wpvivid_restoring = false;
                                    jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                    alert("Restore failed.");
                                }
                                else {
                                    setTimeout(function () {
                                        wpvivid_monitor_restore_task(restore_type);
                                    }, 1000);
                                }
                            }
                            else {
                                setTimeout(function () {
                                    wpvivid_monitor_restore_task(restore_type);
                                }, 1000);
                            }
                        }
                        else {
                            setTimeout(function () {
                                wpvivid_monitor_restore_task(restore_type);
                            }, 1000);
                        }
                    }
                    catch (err) {
                        setTimeout(function () {
                            wpvivid_monitor_restore_task(restore_type);
                        }, 1000);
                    }
                }, function (XMLHttpRequest, textStatus, errorThrown) {
                    setTimeout(function () {
                        wpvivid_monitor_restore_task(restore_type);
                    }, 1000);
                });
            }
        }

        function wpvivid_restore(restore_type){
            var restore_method = '';
            if(restore_type == 'backup'){
                restore_method = '';
            }
            else if(restore_type == 'transfer'){
                restore_method = 'transfer_';
            }

            var skip_old_site = '1';
            var extend_option = {
                'skip_backup_old_site':skip_old_site,
                'skip_backup_old_database':skip_old_site
            };

            var migrate_option = {
                'is_migrate':wpvivid_resotre_is_migrate,
            };
            jQuery.extend(extend_option, migrate_option);

            var restore_options = {
                0:'backup_db',
                1:'backup_themes',
                2:'backup_plugin',
                3:'backup_uploads',
                4:'backup_content',
                5:'backup_core'
            };
            jQuery.extend(restore_options, extend_option);
            var json = JSON.stringify(restore_options);
            var ajax_data={
                'action':'wpvivid_restore',
                'wpvivid_restore':'1',
                'backup_id':m_restore_backup_id,
                'restore_options':json
            };
            setTimeout(function () {
                wpvivid_restore_timeout = true;
            }, 1800000);
            wpvivid_post_request(ajax_data, function(data) {
            }, function(XMLHttpRequest, textStatus, errorThrown) {
            });
        }

        function wpvivid_display_restore_msg(msg, restore_type, div_id, append = true){
            var restore_method = '';
            if(restore_type == 'backup'){
                restore_method = '';
            }
            else if(restore_type == 'transfer'){
                restore_method = 'transfer_';
            }

            if(typeof div_id == 'undefined') {
                var restore_msg = "<div style=\"clear:both;\">" + msg + "</div>";
            }
            else{
                var restore_msg = "<div id=\"restore_file_"+div_id+"\"  style=\"clear:both;\">" + msg + "</div>";
            }
            if(append == true) {
                jQuery('#wpvivid_restore_'+restore_method+'log').append(restore_msg);
            }
            else{
                if(jQuery('#restore_file_'+div_id).length )
                {
                    jQuery('#restore_file_'+div_id).html(msg);
                }
                else
                {
                    jQuery('#wpvivid_restore_'+restore_method+'log').append(restore_msg);
                }
            }
            var div = jQuery('#wpvivid_restore_' + restore_method + 'log');
            div[0].scrollTop = div[0].scrollHeight;
        }

        /**
         * Lock certain operations while a restore task is running.
         */
        function wpvivid_restore_lock(){
            jQuery('#wpvivid_postbox_backup_percent').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_postbox_backup').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_postbox_backup_schedule').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_tab_backup').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_tab_upload').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_tab_backup_log').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_tab_restore').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#page-backups').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#storage-page').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#settings-page').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#debug-page').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#logs-page').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_tab_migrate').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_add_tab_migrate').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_add_tab_import').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_add_tab_key').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_add_tab_log').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_add_tab_restore').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_restore_is_migrate').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_replace_domain').css({'pointer-events': 'none', 'opacity': '1'});
            jQuery('#wpvivid_keep_domain').css({'pointer-events': 'none', 'opacity': '1'});
        }

        /**
         * Unlock the operations once restore task completed.
         */
        function wpvivid_restore_unlock(){
            jQuery('#wpvivid_postbox_backup_percent').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_postbox_backup').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_postbox_backup_schedule').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_tab_backup').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_tab_upload').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_tab_backup_log').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_tab_restore').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#page-backups').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#storage-page').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#settings-page').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#debug-page').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#logs-page').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_tab_migrate').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_add_tab_migrate').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_add_tab_import').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_add_tab_key').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_add_tab_log').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_add_tab_restore').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_restore_is_migrate').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_replace_domain').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_keep_domain').css({'pointer-events': 'auto', 'opacity': '1'});
        }
    </script>
    <?php
}

function wpvivid_backuppage_add_progress_module(){
    ?>
    <div class="postbox" id="wpvivid_postbox_backup_percent" style="display: none;">
        <div class="action-progress-bar" id="wpvivid_action_progress_bar">
            <div class="action-progress-bar-percent" id="wpvivid_action_progress_bar_percent" style="height:24px;width:0;"></div>
        </div>
        <div id="wpvivid_estimate_backup_info" style="float: left;">
            <div class="backup-basic-info"><span class="wpvivid-element-space-right"><?php _e('Database Size:', 'wpvivid'); ?></span><span id="wpvivid_backup_database_size">N/A</span></div>
            <div class="backup-basic-info"><span class="wpvivid-element-space-right"><?php _e('File Size:', 'wpvivid'); ?></span><span id="wpvivid_backup_file_size">N/A</span></div>
        </div>
        <div id="wpvivid_estimate_upload_info" style="float: left;">
            <div class="backup-basic-info"><span class="wpvivid-element-space-right"><?php _e('Total Size:', 'wpvivid'); ?></span><span>N/A</span></div>
            <div class="backup-basic-info"><span class="wpvivid-element-space-right"><?php _e('Uploaded:', 'wpvivid'); ?></span><span>N/A</span></div>
            <div class="backup-basic-info"><span class="wpvivid-element-space-right"><?php _e('Speed:', 'wpvivid'); ?></span><span>N/A</span></div>
        </div>
        <div style="float: left;">
            <div class="backup-basic-info"><span class="wpvivid-element-space-right"><?php _e('Network Connection:', 'wpvivid'); ?></span><span>N/A</span></div>
        </div>
        <div style="clear:both;"></div>
        <div style="margin-left:10px; float: left; width:100%;"><p id="wpvivid_current_doing"></p></div>
        <div style="clear: both;"></div>
        <div>
            <div id="wpvivid_backup_cancel" class="backup-log-btn"><input class="button-primary" id="wpvivid_backup_cancel_btn" type="submit" value="<?php esc_attr_e( 'Cancel', 'wpvivid' ); ?>"  /></div>
            <div id="wpvivid_backup_log" class="backup-log-btn"><input class="button-primary" id="wpvivid_backup_log_btn" type="submit" value="<?php esc_attr_e( 'Log', 'wpvivid' ); ?>" /></div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <script>
        jQuery('#wpvivid_postbox_backup_percent').on("click", "input", function(){
            if(jQuery(this).attr('id') === 'wpvivid_backup_cancel_btn'){
                wpvivid_cancel_backup();
            }
            if(jQuery(this).attr('id') === 'wpvivid_backup_log_btn'){
                wpvivid_read_log('wpvivid_view_backup_task_log');
            }
        });
            
        function wpvivid_cancel_backup(){
            var ajax_data= {
                'action': 'wpvivid_backup_cancel'
                //'task_id': running_backup_taskid
            };
            jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
            wpvivid_post_request(ajax_data, function(data){
                try {
                    var jsonarray = jQuery.parseJSON(data);
                    jQuery('#wpvivid_current_doing').html(jsonarray.msg);
                }
                catch(err){
                    alert(err);
                }
            }, function(XMLHttpRequest, textStatus, errorThrown) {
                jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'auto', 'opacity': '1'});
                var error_message = wpvivid_output_ajaxerror('cancelling the backup', textStatus, errorThrown);
                wpvivid_add_notice('Backup', 'Error', error_message);
            });
        }
    </script>
    <?php
}

function wpvivid_backuppage_add_backup_module(){
    ?>
    <div class="postbox quickbackup" id="wpvivid_postbox_backup">
        <?php
        do_action('wpvivid_backup_module_add_sub');
        ?>
    </div>
   <?php
}

function wpvivid_backup_module_add_descript(){
    $backupdir=WPvivid_Setting::get_backupdir();
    ?>
    <div style="font-size: 14px; padding: 8px 12px; margin: 0; line-height: 1.4; font-weight: 600;">
        <span style="margin-right: 5px;"><?php _e( 'Back Up Manually','wpvivid'); ?></span>
        <span style="margin-right: 5px;">|</span>
        <span style="margin-right: 0;"><a href="<?php echo esc_url(admin_url().'admin.php?page=wpvivid-export-import'); ?>" style="text-decoration: none;">Export Content</a></span>
        <span style="font-size: 10px; color: #FFA500; line-height: 10px;">(new feature)</span>
    </div>
    <div class="quickstart-storage-setting">
        <span class="list-top-chip backup" name="ismerge" value="1" style="margin: 10px 10px 10px 0;"><?php _e('Local Storage Directory: '); ?></span>
        <span class="list-top-chip" id="wpvivid_local_storage_path" style="margin: 10px 10px 10px 0;"><?php _e(WP_CONTENT_DIR.DIRECTORY_SEPARATOR.$backupdir); ?></span>
        <span class="list-top-chip" style="margin: 10px 10px 10px 0;"><a href="#" onclick="wpvivid_click_switch_page('wrap', 'wpvivid_tab_setting', true);" style="text-decoration: none;"><?php _e(' rename directory', 'wpvivid'); ?></a></span>
    </div>
    <?php
}

function wpvivid_backup_module_add_backup_type(){
    $backup_type = '';
    $type_name = 'backup_files';
    ?>
    <div class="quickstart-archive-block">
        <fieldset>
            <legend class="screen-reader-text"><span>input type="radio"</span></legend>
            <?php echo apply_filters('wpvivid_add_backup_type', $backup_type, $type_name); ?>
            <label style="display: none;">
                <input type="checkbox" option="backup" name="ismerge" value="1" checked />
            </label><br>
        </fieldset>
    </div>
    <?php
}

function wpvivid_backup_module_add_send_remote(){
    $pic='';
    ?>
    <div class="quickstart-storage-block">
        <fieldset>
            <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
            <label>
                <input type="radio" id="wpvivid_backup_local" option="backup_ex" name="local_remote" value="local" checked />
                <span><?php _e( 'Save Backups to Local', 'wpvivid' ); ?></span>
            </label><br>
            <label>
                <input type="radio" id="wpvivid_backup_remote" option="backup_ex" name="local_remote" value="remote" />
                <span><?php _e( 'Send Backup to Remote Storage:', 'wpvivid' ); ?></span>
            </label><br>
            <div id="upload_storage" style="cursor:pointer;" title="Highlighted icon illuminates that you have choosed a remote storage to store backups">
                <?php echo apply_filters('wpvivid_schedule_add_remote_pic',$pic); ?>
            </div>
        </fieldset>
    </div>
    <?php
}

function wpvivid_backup_module_add_exec(){
    ?>
    <div class="quickstart-btn" style="padding-top:20px;">
        <input class="button-primary quickbackup-btn" id="wpvivid_quickbackup_btn" type="submit" value="<?php esc_attr_e( 'Backup Now', 'wpvivid'); ?>" />
        <div class="schedule-tab-block" style="text-align:center;">
            <fieldset>
                <label>
                    <input type="checkbox" id="wpvivid_backup_lock" option="backup" name="lock" />
                    <span><?php _e( 'This backup can only be deleted manually', 'wpvivid' ); ?></span>
                </label>
            </fieldset>
        </div>
    </div>
    <script>
    jQuery('#wpvivid_quickbackup_btn').click(function(){
        wpvivid_clear_notice('wpvivid_backup_notice');
        wpvivid_start_backup();
    });
    
    function wpvivid_start_backup(){
        var bcheck=true;
        var bdownloading=false;
        if(m_downloading_id !== '') {
            var descript = 'This request might delete the backup being downloaded, are you sure you want to continue?';
            var ret = confirm(descript);
            if (ret === true) {
                bcheck=true;
                bdownloading=true;
            }
            else{
                bcheck=false;
            }
        }
        if(bcheck) {
            var backup_data = wpvivid_ajax_data_transfer('backup');
            backup_data = JSON.parse(backup_data);
            jQuery('input:radio[option=backup_ex]').each(function() {
                if(jQuery(this).prop('checked'))
                {
                    var key = jQuery(this).prop('name');
                    var value = jQuery(this).prop('value');
                    var json = new Array();
                    if(value == 'local'){
                        json['local']='1';
                        json['remote']='0';
                    }
                    else if(value == 'remote'){
                        json['local']='0';
                        json['remote']='1';
                    }
                }
                jQuery.extend(backup_data, json);
            });
            backup_data = JSON.stringify(backup_data);
            var ajax_data = {
                'action': 'wpvivid_prepare_backup',
                'backup': backup_data
            };
            wpvivid_control_backup_lock();
            jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
            jQuery('#wpvivid_backup_log_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
            jQuery('#wpvivid_postbox_backup_percent').show();
            jQuery('#wpvivid_current_doing').html('Ready to backup. Progress: 0%, running time: 0second.');
            var percent = '0%';
            jQuery('#wpvivid_action_progress_bar_percent').css('width', percent);
            jQuery('#wpvivid_backup_database_size').html('N/A');
            jQuery('#wpvivid_backup_file_size').html('N/A');
            jQuery('#wpvivid_current_doing').html('');
            wpvivid_completed_backup = 1;
            wpvivid_prepare_backup = true;
            wpvivid_post_request(ajax_data, function (data) {
                try {
                    var jsonarray = jQuery.parseJSON(data);
                    if (jsonarray.result === 'failed') {
                        wpvivid_delete_ready_task(jsonarray.error);
                    }
                    else if (jsonarray.result === 'success') {
                        if(bdownloading) {
                            m_downloading_id = '';
                        }
                        m_backup_task_id = jsonarray.task_id;                      
                        var descript = '';
                        if (jsonarray.check.alert_db === true || jsonarray.check.alter_files === true) {
                            descript = 'The database (the dumping SQL file) might be too large, backing up the database may run out of server memory and result in a backup failure.\n' +
                                'One or more files might be too large, backing up the file(s) may run out of server memory and result in a backup failure.\n' +
                                'Click OK button and continue to back up.';
                            var ret = confirm(descript);
                            if (ret === true) {
                                jQuery('#wpvivid_backup_list').html('');
                                jQuery('#wpvivid_backup_list').append(jsonarray.html);
                                wpvivid_backup_now(m_backup_task_id);
                            }
                            else {
                                jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                jQuery('#wpvivid_backup_log_btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                wpvivid_control_backup_unlock();
                                jQuery('#wpvivid_postbox_backup_percent').hide();
                            }
                        }
                        else{
                            jQuery('#wpvivid_backup_list').html('');
                            jQuery('#wpvivid_backup_list').append(jsonarray.html);
                            wpvivid_backup_now(jsonarray.task_id);
                        }                     
                    }
                }
                catch (err) {
                    wpvivid_delete_ready_task(err);
                }
            }, function (XMLHttpRequest, textStatus, errorThrown) {
                var error_message = wpvivid_output_ajaxerror('preparing the backup', textStatus, errorThrown);
                wpvivid_delete_ready_task(error_message);
            });
        }
    }
    
    function wpvivid_backup_now(task_id){
        var ajax_data = {
            'action': 'wpvivid_backup_now',
            'task_id': task_id
        };
        task_retry_times = 0;
        m_need_update=true;
        wpvivid_post_request(ajax_data, function(data){
        }, function(XMLHttpRequest, textStatus, errorThrown) {
        });
    }
    
    function wpvivid_delete_backup_task(task_id){
        var ajax_data = {
            'action': 'wpvivid_delete_task',
            'task_id': task_id
        };
        wpvivid_post_request(ajax_data, function(data){}, function(XMLHttpRequest, textStatus, errorThrown) {
        });
    }
    
    function wpvivid_control_backup_lock(){
        jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_transfer_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
    }
    
    function wpvivid_control_backup_unlock(){
        jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'auto', 'opacity': '1'});
        jQuery('#wpvivid_transfer_btn').css({'pointer-events': 'auto', 'opacity': '1'});
    }
    
    function wpvivid_delete_ready_task(error){
        var ajax_data={
            'action': 'wpvivid_delete_ready_task'
        };
        wpvivid_post_request(ajax_data, function (data) {
            try {
                var jsonarray = jQuery.parseJSON(data);
                if (jsonarray.result === 'success') {
                    wpvivid_add_notice('Backup', 'Error', error);
                    wpvivid_control_backup_unlock();
                    jQuery('#wpvivid_postbox_backup_percent').hide();
                }
            }
            catch(err){
                wpvivid_add_notice('Backup', 'Error', err);
                wpvivid_control_backup_unlock();
                jQuery('#wpvivid_postbox_backup_percent').hide();
            }
        }, function (XMLHttpRequest, textStatus, errorThrown) {
            setTimeout(function () {
                wpvivid_delete_ready_task(error);
            }, 3000);
        });
    }
    </script>
    <?php
}

function wpvivid_backup_module_add_tips(){
    ?>
    <div class="custom-info" style="float:left; width:100%;">
        <strong><?php _e('Tips', 'wpvivid'); ?></strong><?php _e(': The settings are only for manual backup, which won\'t affect schedule settings.', 'wpvivid'); ?>
    </div>
    <?php
}

function wpvivid_backuppage_add_schedule_module(){
    $schedule=WPvivid_Schedule::get_schedule();
    if($schedule['enable']){
        $schedule_status='Enabled';
        $next_backup_time=date("l, F d, Y H:i", $schedule['next_start']);
    }
    else{
        $schedule_status='Disabled';
        $next_backup_time='N/A';
    }
    $last_message = '';
    $last_message = apply_filters('wpvivid_get_last_backup_message', $last_message);
    ?>
    <div class="postbox qucikbackup-schedule" id="wpvivid_postbox_backup_schedule">
        <h2><span><?php _e( 'Backup Schedule','wpvivid'); ?></span></h2>
        <div class="schedule-block">
            <p id="wpvivid_schedule_status"><strong><?php _e('Schedule Status: ', 'wpvivid'); ?></strong><?php _e($schedule_status); ?></p>
            <div id="wpvivid_schedule_info">
                <p><strong><?php _e('Server Time: ', 'wpvivid'); ?></strong><?php _e(date("l, F d, Y H:i",time())); ?></p>
                <p><span id="wpvivid_last_backup_msg"><?php _e($last_message); ?></span></p>
                <p id="wpvivid_next_backup"><strong><?php _e('Next Backup: ', 'wpvivid'); ?></strong><?php _e($next_backup_time); ?></p>
            </div>
        </div>
    </div>
    <div style="clear:both;"></div>
    <?php
}


add_filter('wpvivid_add_backup_type', 'wpvivid_add_backup_type', 11, 2);
add_action('wpvivid_backup_do_js', 'wpvivid_backup_do_js', 10);
add_filter('wpvivid_download_backup_descript', 'wpvivid_download_backup_descript', 10);
add_filter('wpvivid_restore_website_descript', 'wpvivid_restore_website_descript', 10);

add_filter('wpvivid_backuppage_load_backuplist', 'wpvivid_backuppage_load_backuplist', 10);

add_action('wpvivid_backuppage_add_module', 'wpvivid_backuppage_add_progress_module', 10);
add_action('wpvivid_backuppage_add_module', 'wpvivid_backuppage_add_backup_module', 11);
add_action('wpvivid_backuppage_add_module', 'wpvivid_backuppage_add_schedule_module', 12);

add_action('wpvivid_backup_module_add_sub', 'wpvivid_backup_module_add_descript');
add_action('wpvivid_backup_module_add_sub', 'wpvivid_backup_module_add_backup_type');
add_action('wpvivid_backup_module_add_sub', 'wpvivid_backup_module_add_send_remote');
add_action('wpvivid_backup_module_add_sub', 'wpvivid_backup_module_add_exec');
add_action('wpvivid_backup_module_add_sub', 'wpvivid_backup_module_add_tips');

?>