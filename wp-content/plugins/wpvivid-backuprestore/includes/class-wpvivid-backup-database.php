<?php

if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
define('NECESSARY','1');
define('OPTION','0');
class WPvivid_Backup_Database
{
    private $task_id;

    public function __construct()
    {
    }

    public function wpvivid_archieve_database_info($databases, $data){
        if(isset($data['dump_db'])){
            $sql_info['file_name'] =$data['sql_file_name'];
            $sql_info['database'] = DB_NAME;
            $sql_info['host'] = DB_HOST;
            $sql_info['user'] = DB_USER;
            $sql_info['pass'] = DB_PASSWORD;
            $databases[] = $sql_info;
        }
        return $databases;
    }

    public function backup_database($data,$task_id = '')
    {
        global $wpvivid_plugin;
        $dump=null;

        try
        {
            $this->task_id=$task_id;

            //$backup_file =$data['sql_file_name'];

            require_once 'class-wpvivid-mysqldump-method.php';
            require_once 'class-wpvivid-mysqldump.php';

            $db_method=new WPvivid_DB_Method();
            $version =$db_method->get_mysql_version();

            if(version_compare('4.1.0',$version) > 0)
            {
                return array('result'=>WPVIVID_FAILED,'error'=>'Your MySQL version is too old. Please upgrade at least to MySQL 4.1.0.');
            }

            if(version_compare('5.3.0',phpversion()) > 0){
                return array('result'=>WPVIVID_FAILED,'error'=>'Your PHP version is too old. Please upgrade at least to PHP 5.3.0.');
            }

            $db_method->check_max_allowed_packet();
            add_filter('wpvivid_exclude_db_table', array($this, 'exclude_table'),10,2);
            $exclude=array();
            $exclude = apply_filters('wpvivid_exclude_db_table',$exclude, $data);

            add_filter('wpvivid_archieve_database_info', array($this, 'wpvivid_archieve_database_info'), 10, 2);
            $databases=array();
            $databases = apply_filters('wpvivid_archieve_database_info', $databases, $data);

            $backup_files = array();
            foreach ($databases as $sql_info) {
                $database_name = $sql_info['database'];
                $backup_file = $sql_info['file_name'];
                $backup_files[] = $backup_file;
                $host = $sql_info['host'];
                $user = $sql_info['user'];
                $pass = $sql_info['pass'];
                $dump = new WPvivid_Mysqldump($host, $database_name, $user, $pass, array('exclude-tables'=>$exclude,'add-drop-table' => true,'extended-insert'=>false));

                if (file_exists($backup_file))
                    @unlink($backup_file);

                $dump->task_id=$task_id;
                $dump->start($backup_file);
            }

            unset($pdo);
        }
        catch (Exception $e)
        {
            $str_last_query_string='';
            if(!is_null($dump))
            {
                $str_last_query_string=$dump->last_query_string;
            }
            if(!empty($str_last_query_string))
            {
                $wpvivid_plugin->wpvivid_log->WriteLog('last query string:'.$str_last_query_string,'error');
            }
            $message = 'A exception ('.get_class($e).') occurred '.$e->getMessage().' (Code: '.$e->getCode().', line '.$e->getLine().' in '.$e->getFile().')';
            return array('result'=>WPVIVID_FAILED,'error'=>$message);
        }

	    $files = array();
        $files = $backup_files;
        return array('result'=>WPVIVID_SUCCESS,'files'=>$files);
    }

    public function exclude_table($exclude,$data)
    {
        global $wpdb;
        if (is_multisite() && !defined('MULTISITE'))
        {
            $prefix = $wpdb->base_prefix;
        } else {
            $prefix = $wpdb->get_blog_prefix(0);
        }
        $exclude = array('/^(?!' . $prefix . ')/i');
        return $exclude;
    }
}