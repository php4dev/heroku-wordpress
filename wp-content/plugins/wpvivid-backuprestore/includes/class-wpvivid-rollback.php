<?php

if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
include_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-restore-site.php';
include_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-restore-database.php';
include_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-tools.php';
class WPvivid_RollBack
{
    private $restore_data;

    public function rollback()
    {
        @set_time_limit(1800);

        $old_path=WP_CONTENT_DIR.DIRECTORY_SEPARATOR.WPvivid_Setting::get_backupdir().DIRECTORY_SEPARATOR.WPVIVID_DEFAULT_ROLLBACK_DIR;

        if(!file_exists($old_path))
        {
            return array('result'=>WPVIVID_RESTORE_COMPLETED);
        }

        $old_db_path=$old_path.DIRECTORY_SEPARATOR.'wpvivid_old_database'.DIRECTORY_SEPARATOR.'old_database.sql';

        if(file_exists($old_db_path))
        {
            $rollback_db=new WPvivid_RestoreDB();
            $options['skip_backup_old_site']=1;
            $options['skip_backup_old_database']=1;
            $rollback_db->restore($old_path.DIRECTORY_SEPARATOR.'wpvivid_old_database'.DIRECTORY_SEPARATOR,'old_database.sql',$options);
        }

        $old_site_path=$old_path.DIRECTORY_SEPARATOR.'wpvivid_old_site';

        if(file_exists($old_site_path))
        {
            $this->rollback_old_site($old_site_path);
        }

        return array('result'=>WPVIVID_RESTORE_COMPLETED);

        $this->restore_data=new WPvivid_restore_data();

        $next_task=$this->restore_data->get_next_rollback_task();
        if($next_task===false)
        {
            $this->restore_data->write_rollback_log('Rollback task completed.','notice');
            $this->restore_data->update_rollback_status(WPVIVID_RESTORE_COMPLETED);
            return array('result'=>WPVIVID_RESTORE_COMPLETED);
        }
        else if($next_task===WPVIVID_RESTORE_RUNNING)
        {
            $this->restore_data->write_rollback_log('A rollback task is already running.','error');
            return array('result'=>WPVIVID_RESTORE_RUNNING);
        }
        else
        {
            @set_time_limit(600);
            $this->restore_data->write_rollback_log('Start rollbacking '.$next_task['type_name'],'notice');
            $result = $this -> single_rollback($next_task);
            $table=array();
            if(!empty($result['table']))
                $table = $result['table'];
            if($result['result'] != WPVIVID_SUCCESS)
            {
                $this->restore_data->write_rollback_log($result['error'],'error');
                $this->restore_data->update_rollback_error($result,$next_task['type_name'],$table);
                return array('result'=>WPVIVID_RESTORE_ERROR,'error'=>array('task_name'=>$next_task['type_name'],'error'=>$result['error']));
            }
            else
            {
                $this->restore_data->write_rollback_log($next_task['type_name'].' rollback finished.','notice');
                $this->restore_data->update_rollback_sub_task_completed($next_task['type_name'],$result,$table);
                $this->restore_data->update_rollback_status(WPVIVID_RESTORE_WAIT);
                return array('result'=> WPVIVID_RESTORE_COMPLETED);
            }
        }
    }

    public function single_rollback($data)
    {
        if($data['type_name'] == WPVIVID_BACKUP_TYPE_DB || $data['type_name'] == WPVIVID_BACKUP_TYPE_OPTIONS)
        {
            $result = $this -> rollback_db($data);
        }else{
            $result = $this -> rollback_copy($data);
        }
        return $result;
    }

    private function rollback_old_site($old_site_path)
    {
        $replace_path=$old_site_path;
        $this->move_restore_file($old_site_path, get_home_path(),$replace_path);
    }

    private function move_restore_file($source_path,$destination,$replace_path)
    {
        $result = array('result'=>WPVIVID_SUCCESS);

        $handler=opendir($source_path);
        while(($filename=readdir($handler))!==false)
        {
            if($filename != "." && $filename != "..")
            {
                if(is_dir($source_path.DIRECTORY_SEPARATOR.$filename))
                {
                    $this->move_restore_file($source_path.DIRECTORY_SEPARATOR.$filename,$destination,$replace_path);
                }else {
                    $path=str_replace($replace_path,$destination,$source_path.DIRECTORY_SEPARATOR);
                    if(file_exists($path))
                    {
                        @mkdir($path);
                    }
                    @copy($source_path.DIRECTORY_SEPARATOR.$filename,$path.DIRECTORY_SEPARATOR.$filename);
                }
            }
        }
        if($handler)
            @closedir($handler);
        return $result;
    }
    /*private function rollback_db($data){
        $this->restore_data->write_rollback_log('Start rollbacking database.','notice');
        $File = $data['data']['file'];
        if(!file_exists($File)){
            return array('result'=>WPVIVID_FAILED,'error'=>'The .sql file not found. Please try again later.');
        }

        $res = explode(':',DB_HOST);
        $db_host = $res[0];
        $db_port = empty($res[1])?'':$res[1];
        if(!empty($db_port))
            $db_host = $db_host.':'.$db_port;
        try{
            $pdo=new PDO('mysql:host=' . $db_host . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD );
        }catch (Exception $e)
        {
            if(!empty($db_port)){
                $db_host = $res[0];
                $pdo=new PDO('mysql:host=' . $db_host . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD );
            }
            if(empty($pdo) || !$pdo){
                return array('result' => WPVIVID_FAILED,'error' =>'The error establishing a database connection. Please check wp-config.php file and make sure the information is correct.');
            }
        }

        $pdo -> query('SET NAMES utf8');
        $result = $this->rollback_db_file($pdo,$File);
        unset($pdo);
        return $result;
    }
    private function rollback_db_file($pdo,$File){
        global $wpdb;
        $prefix = $wpdb->base_prefix;
        $query = '';
        $tables = array();
        $errortables = array();
        $sqlhandle = fopen($File,'r');

        $backup_database = new WPvivid_Backup_Database();
        $privileges = $backup_database -> check_privilege('restore',$pdo);
        if($privileges['result'] == WPVIVID_FAILED){
            return $privileges;
        }else{
            $privileges = $privileges['data'];
        }
        $options = array();
        foreach ($privileges as $key => $value){
            if($value == 0){
                $options[] = $key;
            }
        }

        if(!empty($options))
            $this->restore_data->write_rollback_log('The lack of optional database privileges including '.implode(',',$options),'Notice');

        $success_num = 0;
        $error_num = 0;
        $line_num = 0;
        $error_info = array();

        $res = $pdo -> query('SELECT @@SESSION.sql_mode') -> fetchAll();
        $sql_mod = $res[0][0];
        $temp_sql_mode = str_replace('NO_ENGINE_SUBSTITUTION','',$sql_mod);
        $temp_sql_mode = 'NO_AUTO_VALUE_ON_ZERO,'.$temp_sql_mode;
        $pdo -> query('SET SESSION sql_mode = "'.$temp_sql_mode.'"');

        $data = $pdo -> query('select * from information_schema.tables WHERE table_schema = "'.DB_NAME.'"') -> fetchAll();
        foreach ($data as $item){
            if(preg_match('#'.$prefix.'#i',$item['TABLE_NAME'])){
                $tables[] = $item['TABLE_NAME'];
            }
        }

        if($tables){
            foreach ($tables as $table){
                if(!$pdo -> query('DROP TABLE '.$table))
                    return array('result'=>WPVIVID_FAILED,'error' =>$pdo ->errorInfo());
            }
        }else{
            return array('result'=>WPVIVID_FAILED,'error'=>$pdo->errorInfo());
        }

        while(!feof($sqlhandle)) {
            $line = fgets($sqlhandle);
            $line_num ++;
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);

            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }

            $query = $query . $line;
            if ($endWith == ';') {
                if(preg_match('#^\\s*LOCK TABLES#',$query) && $privileges['LOCK TABLES'] == 0){
                    $this->restore_data->write_rollback_log('The lack of LOCK TABLES privilege, the backup will skip LOCK TABLES to continue.Notice at Line:'.$line_num,'notice');
                }else{
                    if(!$result = $pdo -> query($query)){
                        $error_num ++;
                        $data = array('line'=>$line_num,'sql'=>$query,'error'=>$pdo->errorInfo());
                        $this->restore_data->write_rollback_log('Restore '.basename($File).' error at line '.$line_num.','.PHP_EOL.'errorinfo: ['.implode('][',$pdo->errorInfo()).']','Warning');
                        $error_info[] = $data;
                        $query= '';
                        continue;
                    }
                    $success_num ++;
                }
                $query= '';
            }
        }
        fclose($sqlhandle);
        $pdo -> query('SET SESSION sql_mode = "'.$sql_mod.'"');

        if($error_num > 0)
        {
            $this->restore_data->write_rollback_log('Database rollback error, '.$success_num.' succeeded, '.$error_num.' failed.','Warning');
        }else{
            $this->restore_data->write_rollback_log('Database rollback succeeded.','Notice');
        }
        return array('result'=>WPVIVID_SUCCESS,'meta'=>$error_info,'table'=>array('succeed'=>$success_num,'failed'=>$error_num));
    }

    private function rollback_copy($data){
        $src_path = $data['data']['src'];
        $dst_path = $data['data']['dst'];
        $replace_path = $data['data']['replace'];
        return $this -> _rollback_copy_loop($src_path,$dst_path,$replace_path);
    }
    private function _rollback_copy_loop($path,$temp_path,$replace_path){
        $result = array('result'=>WPVIVID_SUCCESS);
        if(empty($path)) {
            return array('result'=>'failed','error'=>'Failed to retrieve website\'s folder path. Please reinstall the plugin and try again.');
        }
        $handler=opendir($path);
        while(($filename=readdir($handler))!==false)
        {
            if($filename != "." && $filename != "..")
            {
                if(is_dir($path.DIRECTORY_SEPARATOR.$filename))
                {
                    @mkdir(str_replace($replace_path,$temp_path,$path.DIRECTORY_SEPARATOR.$filename));
                    $result = $this->_rollback_copy_loop($path.DIRECTORY_SEPARATOR.$filename,$temp_path,$replace_path);
                    if($result['result'] != WPVIVID_SUCCESS)
                        break;
                }else{
                    if(!copy($path.DIRECTORY_SEPARATOR.$filename,str_replace($replace_path,$temp_path,$path.DIRECTORY_SEPARATOR.$filename))){
                        $result = array('result'=>'failed','error'=>'Copying '.$path.DIRECTORY_SEPARATOR.$filename.' into '.$temp_path.DIRECTORY_SEPARATOR.$filename.' failed. Make sure the file isn\'t occupied, or the folder is writable.');
                        break;
                    }
                }
            }
        }
        if($handler)
            @closedir($handler);
        return $result;
    }
    */
}