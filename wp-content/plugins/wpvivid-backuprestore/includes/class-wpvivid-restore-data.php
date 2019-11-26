<?php

if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
class WPvivid_restore_data
{
    public $restore_data_file;
    private $rollback_file;
    private $rollback_data_file;
    public $restore_log_file;
    public $restore_log=false;
    public $restore_cache=false;
    private $rollback_log_file;
    private $rollback_log=false;
    private $rollback_cache=false;


    public function __construct()
    {
        $dir=WPvivid_Setting::get_backupdir();
        $this->restore_data_file= WP_CONTENT_DIR.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.'wpvivid_restoredata';
        $this->rollback_data_file= WP_CONTENT_DIR.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.WPVIVID_DEFAULT_ROLLBACK_DIR.DIRECTORY_SEPARATOR.'wpvivid_rollbackdata';
        $this->rollback_file= WP_CONTENT_DIR.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.WPVIVID_DEFAULT_ROLLBACK_DIR.DIRECTORY_SEPARATOR.'wpvivid_rollback';
        $this->restore_log_file= WP_CONTENT_DIR.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.'wpvivid_restore_log.txt';
        $this->rollback_log_file= WP_CONTENT_DIR.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.WPVIVID_DEFAULT_ROLLBACK_DIR.DIRECTORY_SEPARATOR.'wpvivid_rollback_log.txt';
    }

    public function has_restore()
    {
        if(file_exists($this->restore_data_file))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function has_rollback()
    {
        if(file_exists($this->rollback_data_file))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function has_old_files()
    {
        if(file_exists(dirname($this -> rollback_file)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function delete_old_files()
    {
        WPvivid_tools::deldir(dirname($this -> rollback_file),'',true);
    }

    public function delete_temp_files()
    {
        $backup=$this->get_backup_data();
        $backup_item=new WPvivid_Backup_Item($backup);

        foreach($this->restore_cache['restore_tasks'] as $index => $task)
        {
            if(isset($task['option'])&&isset($task['option']['has_child']))
            {
                $has_child=1;
            }
            else
            {
                $option=$backup_item->get_file_info($task['files'][0]);
                if(isset($option['has_child']))
                {
                    $has_child=1;
                }
                else
                {
                    $has_child=0;
                }
            }

            if($has_child)
            {
                foreach ($task['files'] as $file)
                {
                    $temp_files=$backup_item->get_child_files($file);
                    foreach ($temp_files as $delete_file)
                    {
                        $path= $backup_item->get_local_path().$delete_file['file_name'];
                        $this->write_log('clean file:'.$path,'notice');
                        @unlink($path);
                    }
                }
                break;
            }
        }
    }

    public function init_restore_data($backup_id,$restore_options=array())
    {
        //$data = require_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-restore-template.php';
        $this->restore_log=new WPvivid_Log();
        $this->restore_log->CreateLogFile($this->restore_log_file,'has_folder','restore');

        $data['task_id'] = $backup_id;
        $data['status']= WPVIVID_RESTORE_INIT;
        $data['error']='';
        $data['error_task']='';

        $data['restore_options']=$restore_options;
        //$data['restore_options']['skip_backup_old_site']=1;
        //$data['restore_options']['skip_backup_old_database']=1;
        //$data['restore_options']['is_migrate']=1;
        $backup=WPvivid_Backuplist::get_backup_by_id($backup_id);
        $data['backup_data'] = $backup;

        $backup_item=new WPvivid_Backup_Item($backup);

        $packages=$backup_item->get_backup_packages();

        foreach ($packages as $index=>$package)
        {
            $data['restore_tasks'][$index]['index']=$index;
            $data['restore_tasks'][$index]['files']=$package['files'];
            $data['restore_tasks'][$index]['unzip_files']=array();
            $data['restore_tasks'][$index]['status']=WPVIVID_RESTORE_WAIT;
            $data['restore_tasks'][$index]['result']=array();
            $data['restore_tasks'][$index]['option']=array();
            if(isset($package['option']))
            {
                $data['restore_tasks'][$index]['option']=$package['option'];
            }
            $data['restore_tasks'][$index]['option']=array_merge($restore_options, $data['restore_tasks'][$index]['option']);
        }

        usort($data['restore_tasks'], function ($a, $b)
        {
            if($a['index']==$b['index'])
                return 0;

            if($a['index']>$b['index'])
                return 1;
            else
                return -1;
        });

        WPvivid_tools::file_put_array($data,$this->restore_data_file);
        $this->restore_cache=$data;
        $rollback_data = require_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-rollback-template.php';
        $rollback_data['task_id'] = $backup_id;
        WPvivid_tools::deldir(dirname($this -> rollback_file));
        if(!file_exists(dirname($this -> rollback_file)))
            mkdir(dirname($this -> rollback_file));
        WPvivid_tools::file_put_array($rollback_data,$this->rollback_file);
    }

    public function get_restore_option()
    {
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }
        return $this->restore_cache['restore_options'];
    }

    public function init_rollback_data()
    {
        $this->rollback_log=new WPvivid_Log();
        $this->rollback_log->CreateLogFile($this->rollback_log_file,'has_folder','rollback');
        $rollback_data=WPvivid_tools::file_get_array($this->rollback_file);
        WPvivid_tools::file_put_array($rollback_data,$this->rollback_data_file);
        $this->rollback_cache=$rollback_data;
    }

    public function get_restore_status()
    {
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }
        if(empty($this->restore_cache))
        {
            return WPVIVID_RESTORE_ERROR;
        }
        else
        {
            return $this->restore_cache['status'];
        }
    }

    public function get_rollback_status()
    {
        if($this->rollback_cache===false)
        {
            $this->rollback_cache=WPvivid_tools::file_get_array($this->rollback_data_file);
        }
        if(empty($this->rollback_cache))
        {
            return WPVIVID_RESTORE_ERROR;
        }
        else
        {
            return $this->rollback_cache['status'];
        }
    }

    public function get_restore_error()
    {
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }
        if(empty( $this->restore_cache))
        {
            return array('task_name'=>'file','error'=>'Restore data file not found, it may be deleted. Please verify the file exists.');
        }
        else
        {
            return  array('task_name'=> $this->restore_cache['error_task'],'error'=> $this->restore_cache['error']);
        }

    }

    public function get_rollback_error()
    {
        if($this->rollback_cache===false)
        {
            $this->rollback_cache=WPvivid_tools::file_get_array($this->rollback_data_file);
        }
        if(empty( $this->rollback_cache))
        {
            return array('task_name'=>'file','error'=>'Rollback data file not found, it may be deleted. Please verify the file exists.');
        }
        else
        {
            return  array('task_name'=> $this->rollback_cache['error_task'],'error'=> $this->rollback_cache['error']);
        }
    }

    public function clean_restore_data()
    {
        @unlink($this->restore_data_file);
    }

    public function clean_rollback_data()
    {
        @unlink($this->rollback_data_file);
    }

    public function write_log($message,$type)
    {
        if($this->restore_log===false)
        {
            $this->restore_log=new WPvivid_Log();
            $this->restore_log->OpenLogFile($this->restore_log_file,'has_folder');
        }

        clearstatcache();
        if(filesize($this->restore_log_file)>4*1024*1024)
        {
            $this->restore_log->CloseFile();
            unlink($this->restore_log_file);
            $this->restore_log=null;
            $this->restore_log=new WPvivid_Log();
            $this->restore_log->OpenLogFile($this->restore_log_file,'has_folder');
        }
        $this->restore_log->WriteLog($message,$type);
    }

    public function delete_restore_log()
    {
        if(file_exists($this->restore_log_file)) {
            @unlink($this->restore_log_file);
        }
    }

    public function save_error_log_to_debug()
    {
        if($this->restore_log===false) {
            $this->restore_log=new WPvivid_Log();
            $this->restore_log->OpenLogFile($this->restore_log_file,'has_folder');
        }
        WPvivid_error_log::create_restore_error_log($this->restore_log->log_file);
    }

    public function write_rollback_log($message,$type)
    {
        if($this->rollback_log===false)
        {
            $this->rollback_log=new WPvivid_Log();
            $this->rollback_log->OpenLogFile($this->rollback_log_file,'has_folder');
        }

        $this->rollback_log->WriteLog($message,$type);
    }

    public function get_log_content()
    {
        $file =fopen($this->restore_log_file,'r');

        if(!$file)
        {
            return '';
        }

        $buffer='';
        while(!feof($file))
        {
            $buffer .= fread($file,1024);
        }
        fclose($file);

        return $buffer;
    }

    public function get_rollback_log_content()
    {
        $file =fopen($this->rollback_log_file,'r');

        if(!$file)
        {
            return '';
        }

        $buffer='';
        while(!feof($file))
        {
            $buffer .= fread($file,1024);
        }
        fclose($file);

        return $buffer;
    }

    public function get_log_handle()
    {
        if($this->restore_log===false)
        {
            $this->restore_log=new WPvivid_Log();
            $this->restore_log->OpenLogFile($this->restore_log_file,'has_folder');
        }
        return $this->restore_log;
    }

    public function get_backup_data()
    {
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }
        return $this->restore_cache['backup_data'];
    }

    public function get_restore_data()
    {
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }
        return $this->restore_cache['data'];
    }

    public function get_restore_data_id(){
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }
        return $this->restore_cache['task_id'];
    }

    public function get_next_restore_task()
    {
        $next_task=false;
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }

        foreach($this->restore_cache['restore_tasks'] as $index => $task)
        {
            if($task['status'] === WPVIVID_RESTORE_WAIT)
            {
                $next_task=$task;
                $next_task['index']=$index;
                $this->restore_cache['status'] = WPVIVID_RESTORE_RUNNING;
                $this->restore_cache['restore_tasks'][$index]['status'] = WPVIVID_RESTORE_RUNNING;
                $this->restore_cache['restore_tasks'][$index]['time']['start'] = time();
                WPvivid_tools::file_put_array($this->restore_cache,$this->restore_data_file);
                break;
            }
            else if($task['status'] === WPVIVID_RESTORE_RUNNING)
            {
                $next_task=WPVIVID_RESTORE_RUNNING;
                break;
            }
            else if($task['status'] === WPVIVID_RESTORE_COMPLETED)
            {
                continue;
            }
        }

        return $next_task;
    }

    public function get_next_rollback_task()
    {
        $next_task=false;
        if($this->rollback_cache===false)
        {
            $this->rollback_cache=WPvivid_tools::file_get_array($this->rollback_data_file);
        }

        foreach($this->rollback_cache['data'] as $task_type => $task)
        {
            if($task['status'] === WPVIVID_RESTORE_READY)
            {
                $next_task=$task;
                $this->rollback_cache['status'] = WPVIVID_RESTORE_RUNNING;
                $this->rollback_cache['data'][$task_type]['status'] = WPVIVID_RESTORE_RUNNING;
                $this->rollback_cache['data'][$task_type]['time']['start'] = time();
                WPvivid_tools::file_put_array($this->rollback_cache,$this->rollback_data_file);
                break;
            }
            else if($task['status'] === WPVIVID_RESTORE_RUNNING)
            {
                $next_task=WPVIVID_RESTORE_RUNNING;
                break;
            }
            else if($task['status'] === WPVIVID_RESTORE_COMPLETED)
            {
                continue;
            }
        }

        return $next_task;
    }

    public function update_error($error,$error_task='',$table=array())
    {
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }
        $this->restore_cache['status'] = WPVIVID_RESTORE_ERROR;
        $this->restore_cache['error'] = $error;
        if($error_task!='')
        {
            $this->restore_cache['data'][$error_task]['time']['end'] = time();
            $this->restore_cache['data'][$error_task]['status'] = WPVIVID_RESTORE_ERROR;
            $this->restore_cache['data'][$error_task]['return'] = $error;
            $this->restore_cache['error_task'] = $error_task;
            if(!empty($table))
            {
                $this->restore_cache['data'][$error_task]['table']['succeed'] = empty($table['succeed'])?0:$table['succeed'];
                $this->restore_cache['data'][$error_task]['table']['failed'] = empty($table['failed'])?0:$table['failed'];
                $this->restore_cache['data'][$error_task]['table']['unfinished'] = empty($table['unfinished'])?0:$table['unfinished'];
            }
        }
        WPvivid_tools::file_put_array($this->restore_cache,$this->restore_data_file);
    }

    public function update_rollback_error($error,$error_task='',$table=array())
    {
        if($this->rollback_cache===false)
        {
            $this->rollback_cache=WPvivid_tools::file_get_array($this->rollback_data_file);
        }
        $this->rollback_cache['status'] = WPVIVID_RESTORE_ERROR;
        $this->rollback_cache['error'] = $error;
        if($error_task!='')
        {
            $this->rollback_cache['data'][$error_task]['time']['end'] = time();
            $this->rollback_cache['data'][$error_task]['status'] = WPVIVID_RESTORE_ERROR;
            $this->rollback_cache['data'][$error_task]['return'] = $error;
            $this->rollback_cache['error_task'] = $error_task;
            if(!empty($table))
            {
                $this->rollback_cache['data'][$error_task]['table']['succeed'] = empty($table['succeed'])?0:$table['succeed'];
                $this->rollback_cache['data'][$error_task]['table']['failed'] = empty($table['failed'])?0:$table['failed'];
                $this->rollback_cache['data'][$error_task]['table']['unfinished'] = empty($table['unfinished'])?0:$table['unfinished'];
            }
        }
        WPvivid_tools::file_put_array($this->rollback_cache,$this->rollback_data_file);
    }

    public function update_status($status)
    {
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }

        $this->restore_cache['status'] = $status;
        WPvivid_tools::file_put_array($this->restore_cache,$this->restore_data_file);
    }

    public function update_rollback_status($status)
    {
        if($this->rollback_cache===false)
        {
            $this->rollback_cache=WPvivid_tools::file_get_array($this->rollback_data_file);
        }

        $this->rollback_cache['status'] = $status;
        WPvivid_tools::file_put_array($this->rollback_cache,$this->rollback_data_file);
    }

    public function update_sub_task($task_index,$result)
    {
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }

        if($result['result']==WPVIVID_SUCCESS)
        {
            $files=$this->get_need_unzip_file($this->restore_cache['restore_tasks'][$task_index]);
            if(empty($files))
            {
                $this->restore_cache['restore_tasks'][$task_index]['result']=$result;
                $this->restore_cache['restore_tasks'][$task_index]['status']=$result['result'];
            }
            else {
                $this->restore_cache['restore_tasks'][$task_index]['result']=$result;
                $this->restore_cache['restore_tasks'][$task_index]['status']=WPVIVID_RESTORE_WAIT;
            }
        }
        else
        {
            $this->restore_cache['restore_tasks'][$task_index]['result']=$result;
            $this->restore_cache['restore_tasks'][$task_index]['status']=$result['result'];
        }

        $this->restore_cache['data'][$task_index]['time']['end'] = time();
        WPvivid_tools::file_put_array($this->restore_cache,$this->restore_data_file);
    }

    public function update_rollback_sub_task_completed($task_type,$return,$table=array())
    {
        if($this->rollback_cache===false)
        {
            $this->rollback_cache=WPvivid_tools::file_get_array($this->rollback_data_file);
        }

        $this->rollback_cache['data'][$task_type]['time']['end'] = time();
        $this->rollback_cache['data'][$task_type]['status'] = WPVIVID_RESTORE_COMPLETED;
        $this->rollback_cache['data'][$task_type]['return'] = $return;
        $this->rollback_cache['status'] = WPVIVID_RESTORE_RUNNING;
        if(!empty($table)){
            $this->rollback_cache['data'][$task_type]['table']['succeed'] = empty($table['succeed'])?0:$table['succeed'];
            $this->rollback_cache['data'][$task_type]['table']['failed'] = empty($table['failed'])?0:$table['failed'];
            $this->rollback_cache['data'][$task_type]['table']['unfinished'] = empty($table['unfinished'])?0:$table['unfinished'];
        }
        WPvivid_tools::file_put_array($this->rollback_cache,$this->rollback_cache);
    }

    public function set_rollback_data($type_name,$task_id,$data)
    {
        $rollback_data=WPvivid_tools::file_get_array($this->rollback_file);

        $rollback_data['data'][$type_name]['status'] = WPVIVID_RESTORE_READY;
        $rollback_data['data'][$type_name]['task_id'] = $task_id;
        $rollback_data['data'][$type_name]['type_name'] = $type_name;
        $rollback_data['data'][$type_name]['data'] = $data;
        WPvivid_tools::file_put_array($rollback_data,$this->rollback_file);
    }

    public function get_need_unzip_file($restore_task)
    {
        $files=array();
        foreach ($restore_task['files'] as $file)
        {
            if(in_array($file,$restore_task['unzip_files']))
            {
                continue;
            }
            else
            {
                $files[]=$file;
                return $files;
            }
        }
        return $files;
    }

    public function update_need_unzip_file($task_index,$files)
    {
        if($this->restore_cache===false)
        {
            $this->restore_cache=WPvivid_tools::file_get_array($this->restore_data_file);
        }
        $this->restore_cache['restore_tasks'][$task_index]['unzip_files']=array_merge($this->restore_cache['restore_tasks'][$task_index]['unzip_files'],$files);
        WPvivid_tools::file_put_array($this->restore_cache,$this->restore_data_file);
    }
}