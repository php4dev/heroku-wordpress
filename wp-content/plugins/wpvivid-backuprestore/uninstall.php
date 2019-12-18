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
delete_option('wpvivid_import_list_cache');
delete_option('wpvivid_importer_task_list');
delete_option('wpvivid_list_cache');
delete_option('wpvivid_exporter_task_list');
delete_option('wpvivid_need_review');
delete_option('wpvivid_review_msg');
delete_option('wpvivid_migrate_status');
delete_option('clean_task');
delete_option('cron_backup_count');
delete_option('wpvivid_backup_success_count');
delete_option('wpvivid_backup_error_array');
delete_option('wpvivid_amazons3_notice');
delete_option('wpvivid_hide_mwp_tab_page');
delete_option('wpvivid_hide_wp_cron_notice');
delete_option('wpvivid_transfer_error_array');
delete_option('wpvivid_transfer_success_count');
delete_option('wpvivid_api_token');
delete_option('wpvivid_download_task_v2');
delete_option('wpvivid_export_list');

define('WPVIVID_MAIN_SCHEDULE_EVENT','wpvivid_main_schedule_event');

if(wp_get_schedule(WPVIVID_MAIN_SCHEDULE_EVENT))
{
    wp_clear_scheduled_hook(WPVIVID_MAIN_SCHEDULE_EVENT);
    $timestamp = wp_next_scheduled(WPVIVID_MAIN_SCHEDULE_EVENT);
    wp_unschedule_event($timestamp,WPVIVID_MAIN_SCHEDULE_EVENT);
}
