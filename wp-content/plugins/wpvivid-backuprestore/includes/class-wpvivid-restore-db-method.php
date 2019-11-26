<?php

include_once WPVIVID_PLUGIN_DIR . '/includes/class-wpvivid-restore-db-pdo-mysql-method.php';
include_once WPVIVID_PLUGIN_DIR . '/includes/class-wpvivid-restore-db-wpdb-method.php';

class WPvivid_Restore_DB_Method
{
    private $db;
    private $type;

    public function __construct()
    {
        global $wpvivid_plugin;
        $client_flags = defined( 'MYSQL_CLIENT_FLAGS' ) ? MYSQL_CLIENT_FLAGS : 0;
        if($client_flags)
        {
            $wpvivid_plugin->restore_data->write_log('wpdb', 'Warning');
            $this->db =new WPvivid_Restore_DB_WPDB_Method();
            $this->type='wpdb';
            return;
        }

        if(class_exists('PDO'))
        {
            $extensions=get_loaded_extensions();
            if(array_search('pdo_mysql',$extensions))
            {
                $wpvivid_plugin->restore_data->write_log('pdo_mysql', 'Warning');
                $this->db =new WPvivid_Restore_DB_PDO_Mysql_Method();
                $this->type='pdo_mysql';
                return;
            }
        }
        $wpvivid_plugin->restore_data->write_log('wpdb', 'Warning');
        $this->db =new WPvivid_Restore_DB_WPDB_Method();
        $this->type='wpdb';
    }

    public function get_type()
    {
        return $this->type;
    }

    public function connect_db()
    {
        return $this->db->connect_db();
    }

    public function test_db()
    {
        return $this->db->test_db();
    }

    public function check_max_allow_packet()
    {
        $this->db->check_max_allow_packet();
    }

    public function get_max_allow_packet()
    {
        return $this->db->get_max_allow_packet();
    }

    public function init_sql_mode()
    {
        $this->db->init_sql_mode();
    }

    public function set_skip_query($count)
    {
        $this->db->set_skip_query($count);
    }

    public function execute_sql($query)
    {
        $this->db->execute_sql($query);
    }

    public function query($sql,$output=ARRAY_A)
    {
        return $this->db->query($sql,$output);
    }

    public function errorInfo()
    {
        return $this->db->errorInfo();
    }
}