<?php

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option('wpvivid_schedule_setting');
delete_option('wpvivid_email_setting');
delete_option('wpvivid_compress_setting');
delete_option('wpvivid_local_setting');
delete_option('wpvivid_upload_setting');
delete_option('wpvivid_common_setting');
delete_option('wpvivid_backup_list');
delete_option('wpvivid_task_list');
delete_option('wpvivid_init');
delete_option('wpvivid_remote_init');
delete_option('wpvivid_last_msg');
delete_option('wpvivid_download_cache');
delete_option('wpvivid_download_task');
delete_option('wpvivid_user_history');
delete_option('wpvivid_saved_api_token');
define('WPVIVID_MAIN_SCHEDULE_EVENT','wpvivid_main_schedule_event');

if(wp_get_schedule(WPVIVID_MAIN_SCHEDULE_EVENT))
{
    wp_clear_scheduled_hook(WPVIVID_MAIN_SCHEDULE_EVENT);
    $timestamp = wp_next_scheduled(WPVIVID_MAIN_SCHEDULE_EVENT);
    wp_unschedule_event($timestamp,WPVIVID_MAIN_SCHEDULE_EVENT);
}
