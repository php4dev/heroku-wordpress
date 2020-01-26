<?php
/**
 * Created by PhpStorm.
 * User: alienware`x
 * Date: 2019/5/23
 * Time: 16:42
 */

class WPvivid_Mysqldump_wpdb
{
// Same as mysqldump
    const MAXLINESIZE = 1000000;

    // Available compression methods as constants
    const GZIP = 'Gzip';
    const BZIP2 = 'Bzip2';
    const NONE = 'None';

    // Available connection strings
    const UTF8 = 'utf8';
    const UTF8MB4 = 'utf8mb4';

    /**
     * Database username
     * @var string
     */
    public $user;
    /**
     * Database password
     * @var string
     */
    public $pass;
    /**
     * Connection string for PDO
     * @var string
     */
    public $dsn;
    /**
     * Destination filename, defaults to stdout
     * @var string
     */
    public $fileName = 'php://output';

    // Internal stuff
    private $tables = array();
    private $views = array();
    private $triggers = array();
    private $procedures = array();
    private $events = array();
    private $dbHandler = null;
    private $dbType;
    private $compressManager;
    private $typeAdapter;
    private $dumpSettings = array();
    private $pdoSettings = array();
    private $version;
    private $tableColumnTypes = array();
    public $log=false;
    public $task_id='';
    /**
     * database name, parsed from dsn
     * @var string
     */
    private $dbName;
    /**
     * host name, parsed from dsn
     * @var string
     */
    private $host;
    /**
     * dsn string parsed as an array
     * @var array
     */
    private $dsnArray = array();
    private $privileges = array();

    public $last_query_string='';

    /**
     * Constructor of Mysqldump. Note that in the case of an SQLite database
     * connection, the filename must be in the $db parameter.
     *
     * @param string $dsn        PDO DSN connection string
     * @param string $user       SQL account username
     * @param string $pass       SQL account password
     * @param array  $dumpSettings SQL database settings
     * @param array  $pdoSettings  PDO configured attributes
     */
    public function __construct($dumpSettings = array())
    {
        $dumpSettingsDefault = array(
            'include-tables' => array(),
            'exclude-tables' => array(),
            'compress' => WPvivid_Mysqldump_wpdb::NONE,
            'init_commands' => array(),
            'no-data' => array(),
            'reset-auto-increment' => false,
            'add-drop-database' => false,
            'add-drop-table' => false,
            'add-drop-trigger' => true,
            'add-locks' => true,
            'complete-insert' => false,
            'databases' => false,
            'default-character-set' => WPvivid_Mysqldump_wpdb::UTF8,
            'disable-keys' => true,
            'extended-insert' => true,
            'events' => false,
            'hex-blob' => true, /* faster than escaped content */
            'net_buffer_length' => self::MAXLINESIZE,
            'no-autocommit' => true,
            'no-create-info' => false,
            'lock-tables' => true,
            'routines' => false,
            'single-transaction' => true,
            'skip-triggers' => false,
            'skip-tz-utc' => false,
            'skip-comments' => false,
            'skip-dump-date' => false,
            'where' => '',
            /* deprecated */
            'disable-foreign-keys-check' => true
        );

        if(defined('DB_CHARSET'))
        {
            $dumpSettingsDefault['default-character-set']=DB_CHARSET;
        }

        $this->dumpSettings = self::array_replace_recursive($dumpSettingsDefault, $dumpSettings);

        $this->dumpSettings['init_commands'][] = "SET NAMES " . $this->dumpSettings['default-character-set'];

        if (false === $this->dumpSettings['skip-tz-utc']) {
            $this->dumpSettings['init_commands'][] = "SET TIME_ZONE='+00:00'";
        }

        $diff = array_diff(array_keys($this->dumpSettings), array_keys($dumpSettingsDefault));
        if (count($diff)>0) {
            throw new Exception("Unexpected value in dumpSettings: (" . implode(",", $diff) . ")");
        }

        if ( !is_array($this->dumpSettings['include-tables']) ||
            !is_array($this->dumpSettings['exclude-tables']) ) {
            throw new Exception("Include-tables and exclude-tables should be arrays");
        }

        // Dump the same views as tables, mimic mysqldump behaviour
        $this->dumpSettings['include-views'] = $this->dumpSettings['include-tables'];

        // Create a new compressManager to manage compressed output
        $this->compressManager = CompressManagerFactory::create($this->dumpSettings['compress']);
    }

    public function set_privilege($privileges)
    {
        $this -> privileges = $privileges;
    }

    /**
     * Custom array_replace_recursive to be used if PHP < 5.3
     * Replaces elements from passed arrays into the first array recursively
     *
     * @param array $array1 The array in which elements are replaced
     * @param array $array2 The array from which elements will be extracted
     *
     * @return array Returns an array, or NULL if an error occurs.
     */
    public static function array_replace_recursive($array1, $array2)
    {
        if (function_exists('array_replace_recursive')) {
            return array_replace_recursive($array1, $array2);
        }

        foreach ($array2 as $key => $value) {
            if (is_array($value)) {
                $array1[$key] = self::array_replace_recursive($array1[$key], $value);
            } else {
                $array1[$key] = $value;
            }
        }
        return $array1;
    }

    /**
     * Main call
     *
     * @param string $filename  Name of file to write sql dump to
     * @return null
     */
    public function start($filename = '')
    {
        // Output file can be redefined here
        if (!empty($filename)) {
            $this->fileName = $filename;
        }

        // Connect to database
        $this->connect();

        // Create output file
        $this->compressManager->open($this->fileName);

        // Write some basic info to output file
        $this->compressManager->write($this->getDumpFileHeader());

        $this->compressManager->write('/* # site_url: '.site_url().' */;'.PHP_EOL);
        $this->compressManager->write('/* # home_url: '.home_url().' */;'.PHP_EOL);
        $this->compressManager->write('/* # content_url: '.content_url().' */;'.PHP_EOL);
        $upload_dir  = wp_upload_dir();
        $this->compressManager->write('/* # upload_url: '.$upload_dir['baseurl'].' */;'.PHP_EOL);
        global $wpdb;
        if (is_multisite() && !defined('MULTISITE'))
        {
            $prefix = $wpdb->base_prefix;
        } else {
            $prefix = $wpdb->get_blog_prefix(0);
        }
        $this->compressManager->write('/* # table_prefix: '.$prefix.' */;'.PHP_EOL.PHP_EOL.PHP_EOL);

        // Store server settings and use sanner defaults to dump
        $this->compressManager->write(
            $this->typeAdapter->backup_parameters($this->dumpSettings)
        );

        // Get table, view and trigger structures from database
        $this->getDatabaseStructure();

        // If there still are some tables/views in include-tables array,
        // that means that some tables or views weren't found.
        // Give proper error and exit.
        // This check will be removed once include-tables supports regexps
        if (0 < count($this->dumpSettings['include-tables']))
        {
            $name = implode(",", $this->dumpSettings['include-tables']);
            throw new Exception("Table (" . $name . ") not found in database");
        }

        $this->exportTables();

        // Restore saved parameters
        $this->compressManager->write(
            $this->typeAdapter->restore_parameters($this->dumpSettings)
        );
        // Write some stats to output file
        $this->compressManager->write($this->getDumpFileFooter());
        // Close output file
        $this->compressManager->close();
    }

    /**
     * Reads table and views names from database.
     * Fills $this->tables array so they will be dumped later.
     *
     * @return null
     */
    private function getDatabaseStructure()
    {
        // Listing all tables from database
        if (empty($this->dumpSettings['include-tables']))
        {
            // include all tables for now, blacklisting happens later

            $rows=$this->query($this->typeAdapter->show_tables($this->dbName));

            foreach ($rows  as $row)
            {
                array_push($this->tables, current($row));
            }
        } else {
            // include only the tables mentioned in include-tables
            $rows=$this->query($this->typeAdapter->show_tables($this->dbName));
            foreach ($rows as $row)
            {
                if (in_array(current($row), $this->dumpSettings['include-tables'], true))
                {
                    array_push($this->tables, current($row));
                    $elem = array_search(
                        current($row),
                        $this->dumpSettings['include-tables']
                    );
                    unset($this->dumpSettings['include-tables'][$elem]);
                }
            }
        }
    }

    /**
     * Returns header for dump file
     *
     * @return string
     */
    private function getDumpFileHeader()
    {
        $header = '';
        if ( !$this->dumpSettings['skip-comments'] ) {
            // Some info about software, source and time
            $header = "-- mysqldump-php https://github.com/ifsnop/mysqldump-php" . PHP_EOL .
                "--" . PHP_EOL .
                "-- Host: {$this->host}\tDatabase: {$this->dbName}" . PHP_EOL .
                "-- ------------------------------------------------------" . PHP_EOL;

            if ( !empty($this->version) ) {
                $header .= "-- Server version \t" . $this->version . PHP_EOL;
            }

            if ( !$this->dumpSettings['skip-dump-date'] ) {
                $header .= "-- Date: " . date('r') . PHP_EOL . PHP_EOL;
            }
        }
        return $header;
    }

    private function connect()
    {
        // Connecting with PDO
        global $wpdb;

        $this->host=DB_HOST;
        $this->dbName=DB_NAME;
        $this->version=$wpdb->db_version();

        $this->dbType='wpdb';
        $this->dbHandler=$wpdb;

        $this->typeAdapter = TypeAdapterFactory::create($this->dbType, $this->dbHandler);
    }

    public function query($query_string)
    {
        $this->last_query_string=$query_string;
        return  $this->typeAdapter->query($query_string);
    }

    /**
     * Returns footer for dump file
     *
     * @return string
     */
    private function getDumpFileFooter()
    {
        $footer = '';
        if (!$this->dumpSettings['skip-comments']) {
            $footer .= '-- Dump completed';
            if (!$this->dumpSettings['skip-dump-date']) {
                $footer .= ' on: ' . date('r');
            }
            $footer .= PHP_EOL;
        }

        return $footer;
    }

    /**
     * Compare if $table name matches with a definition inside $arr
     * @param $table string
     * @param $arr array with strings or patterns
     * @return bool
     */
    private function matches($table, $arr) {
        $match = false;

        foreach ($arr as $pattern) {
            if ( '/' != $pattern[0] ) {
                continue;
            }
            if ( 1 == preg_match($pattern, $table) ) {
                $match = true;
            }
        }

        return in_array($table, $arr) || $match;
    }

    /**
     * Exports all the tables selected from database
     *
     * @return null
     */
    private function exportTables()
    {
        // Exporting tables one by one
        $i=0;
        $i_step=0;
        if($this->task_id!=='')
        {
            $options_name[]='backup_options';
            $options_name[]='ismerge';
            $options=WPvivid_taskmanager::get_task_options($this->task_id,$options_name);
            if($options['ismerge'])
            {
                if(isset($options['backup_options']['backup']['backup_type'])) {
                    $i_step = intval(1 / (sizeof($options['backup_options']['backup']['backup_type']) + 1) * 100);
                }
                else{
                    $i_step = intval(1 / (sizeof($options['backup_options']['backup']) + 1) * 100);
                }
            }
            else
            {
                if(isset($options['backup_options']['backup']['backup_type'])) {
                    $i_step = intval(1 / sizeof($options['backup_options']['backup']['backup_type']) * 100);
                }
                else{
                    $i_step = intval(1 / sizeof($options['backup_options']['backup']) * 100);
                }
            }
        }

        foreach ($this->tables as $table)
        {
            if ( $this->matches($table, $this->dumpSettings['exclude-tables']) )
            {
                continue;
            }

            if($this->task_id!=='')
            {
                $message='Preparing to dump table '.$table;
                global $wpvivid_plugin;
                $wpvivid_plugin->wpvivid_log->WriteLog($message,'notice');
                WPvivid_taskmanager::update_backup_sub_task_progress($this->task_id,'backup',WPVIVID_BACKUP_TYPE_DB,0,$message);
            }

            $this->getTableStructure($table);
            if ( false === $this->dumpSettings['no-data'] ) { // don't break compatibility with old trigger
                $this->listValues($table);
            } else if ( true === $this->dumpSettings['no-data']
                || $this->matches($table, $this->dumpSettings['no-data']) ) {
                continue;
            } else {
                $this->listValues($table);
            }
            $i++;
            if($this->task_id!=='')
            {
                $i_progress=intval($i/sizeof($this->tables)*$i_step);
                WPvivid_taskmanager::update_backup_main_task_progress($this->task_id,'backup',$i_progress,0);
            }
        }
        return ;
    }

    /**
     * Table structure extractor
     *
     * @todo move specific mysql code to typeAdapter
     * @param string $tableName  Name of table to export
     * @return null
     */
    private function getTableStructure($tableName)
    {
        if (!$this->dumpSettings['no-create-info']) {
            $ret = '';
            if (!$this->dumpSettings['skip-comments']) {
                $ret = "--" . PHP_EOL .
                    "-- Table structure for table `$tableName`" . PHP_EOL .
                    "--" . PHP_EOL . PHP_EOL;
            }
            $stmt = $this->typeAdapter->show_create_table($tableName);

            foreach ($this->query($stmt) as $r) {

                $this->compressManager->write($ret);
                if ($this->dumpSettings['add-drop-table']) {
                    $this->compressManager->write(
                        $this->typeAdapter->drop_table($tableName)
                    );
                }

                $this->compressManager->write(
                    $this->typeAdapter->create_table($r, $this->dumpSettings)
                );
                break;
            }
        }
        $this->tableColumnTypes[$tableName] = $this->getTableColumnTypes($tableName);
        return;
    }

    /**
     * Store column types to create data dumps and for Stand-In tables
     *
     * @param string $tableName  Name of table to export
     * @return array type column types detailed
     */

    private function getTableColumnTypes($tableName)
    {
        $columnTypes = array();
        $columns = $this->query(
            $this->typeAdapter->show_columns($tableName)
        );

        foreach($columns as $key => $col) {
            $types = $this->typeAdapter->parseColumnType($col);
            $columnTypes[$col['Field']] = array(
                'is_numeric'=> $types['is_numeric'],
                'is_blob' => $types['is_blob'],
                'type' => $types['type'],
                'type_sql' => $col['Type'],
                'is_virtual' => $types['is_virtual']
            );
        }

        return $columnTypes;
    }

    /**
     * Table rows extractor
     *
     * @param string $tableName  Name of table to export
     *
     * @return null
     */
    private function listValues($tableName)
    {
        $this->prepareListValues($tableName);

        $onlyOnce = true;
        $lineSize = 0;

        $colStmt = $this->getColumnStmt($tableName);

        global $wpdb;
        $prefix=$wpdb->base_prefix;

        if(substr($tableName, strlen($prefix))=='options')
        {
            $stmt = "SELECT " . implode(",", $colStmt) . " FROM `$tableName` WHERE option_name !='wpvivid_task_list'";
        }
        else
        {
            $stmt = "SELECT " . implode(",", $colStmt) . " FROM `$tableName`";
        }



        if ($this->dumpSettings['where']) {
            $stmt .= " WHERE {$this->dumpSettings['where']}";
        }

        $resultSet = $this->query($stmt);

        $i=0;
        $i_check_cancel=0;
        $count=0;
        foreach ($resultSet as $row)
        {
            $i++;
            $vals = $this->escape($tableName, $row);

            foreach($vals as $key => $value){
                if($value === '\'0000-00-00 00:00:00\'')
                    $vals[$key] = '\'1991-01-01 00:00:00\'';
            }

            if ($onlyOnce || !$this->dumpSettings['extended-insert'])
            {

                if ($this->dumpSettings['complete-insert'])
                {
                    $lineSize += $this->compressManager->write(
                        "INSERT INTO `$tableName` (" .
                        implode(", ", $colStmt) .
                        ") VALUES (" . implode(",", $vals) . ")"
                    );
                } else {
                    $lineSize += $this->compressManager->write(
                        "INSERT INTO `$tableName` VALUES (" . implode(",", $vals) . ")"
                    );
                }
                $onlyOnce = false;
            } else {
                $lineSize += $this->compressManager->write(",(" . implode(",", $vals) . ")");
            }
            if (($lineSize > $this->dumpSettings['net_buffer_length']) ||
                !$this->dumpSettings['extended-insert']) {
                $onlyOnce = true;
                $lineSize = $this->compressManager->write(";" . PHP_EOL);
            }

            if($i>=200000)
            {
                $count+=$i;
                $i=0;
                if($this->task_id!=='')
                {
                    $i_check_cancel++;
                    if($i_check_cancel>5)
                    {
                        $i_check_cancel=0;
                        global $wpvivid_plugin;
                        $wpvivid_plugin->check_cancel_backup($this->task_id);
                    }
                    $message='Dumping table '.$tableName.', rows dumped: '.$count.' rows.';
                    WPvivid_taskmanager::update_backup_sub_task_progress($this->task_id,'backup',WPVIVID_BACKUP_TYPE_DB,0,$message);
                }
            }
        }
        unset($resultSet);

        if (!$onlyOnce) {
            $this->compressManager->write(";" . PHP_EOL);
        }



        $this->endListValues($tableName);
    }

    /**
     * Table rows extractor, append information prior to dump
     *
     * @param string $tableName  Name of table to export
     *
     * @return null
     */
    function prepareListValues($tableName)
    {
        if (!$this->dumpSettings['skip-comments']) {
            $this->compressManager->write(
                "--" . PHP_EOL .
                "-- Dumping data for table `$tableName`" .  PHP_EOL .
                "--" . PHP_EOL . PHP_EOL
            );
        }

        if ($this->dumpSettings['single-transaction']) {
            $this->typeAdapter->exec($this->typeAdapter->setup_transaction());
            $this->typeAdapter->exec($this->typeAdapter->start_transaction());
        }

        if ($this->dumpSettings['lock-tables']) {
            if($this -> privileges['LOCK TABLES'] == 0){
                global $wpvivid_plugin;
                $wpvivid_plugin->wpvivid_log->WriteLog('The lack of LOCK TABLES privilege, the backup will skip lock_tables() to continue.','notice');
            }else{
                $this->typeAdapter->lock_table($tableName);
            }
        }

        if ($this->dumpSettings['add-locks']) {
            $this->compressManager->write(
                $this->typeAdapter->start_add_lock_table($tableName)
            );
        }

        if ($this->dumpSettings['disable-keys']) {
            $this->compressManager->write(
                $this->typeAdapter->start_add_disable_keys($tableName)
            );
        }

        // Disable autocommit for faster reload
        if ($this->dumpSettings['no-autocommit']) {
            $this->compressManager->write(
                $this->typeAdapter->start_disable_autocommit()
            );
        }

        return;
    }

    /**
     * Build SQL List of all columns on current table
     *
     * @param string $tableName  Name of table to get columns
     *
     * @return string SQL sentence with columns
     */
    function getColumnStmt($tableName)
    {
        $colStmt = array();
        foreach($this->tableColumnTypes[$tableName] as $colName => $colType) {
            if ($colType['type'] == 'bit' && $this->dumpSettings['hex-blob']) {
                $colStmt[] = "LPAD(HEX(`${colName}`),2,'0') AS `${colName}`";
            } else if ($colType['is_blob'] && $this->dumpSettings['hex-blob']) {
                $colStmt[] = "HEX(`${colName}`) AS `${colName}`";
            } else if ($colType['is_virtual']) {
                $this->dumpSettings['complete-insert'] = true;
                continue;
            } else {
                $colStmt[] = "`${colName}`";
            }
        }

        return $colStmt;
    }

    /**
     * Escape values with quotes when needed
     *
     * @param string $tableName Name of table which contains rows
     * @param array $row Associative array of column names and values to be quoted
     *
     * @return string
     */
    private function escape($tableName, $row)
    {
        $ret = array();
        $columnTypes = $this->tableColumnTypes[$tableName];

        foreach ($row as $colName => $colValue) {
            if (is_null($colValue)) {
                $ret[] = "NULL";
            } elseif ($this->dumpSettings['hex-blob'] && $columnTypes[$colName]['is_blob']) {
                if ($columnTypes[$colName]['type'] == 'bit' || !empty($colValue)) {
                    $ret[] = "0x${colValue}";
                } else {
                    $ret[] = "''";
                }
            } elseif ($columnTypes[$colName]['is_numeric']) {
                $ret[] = $colValue;
            } else {
                $ret[] = $this->quote($colValue);
            }
        }
        return $ret;
    }

    public function quote($value)
    {
        $search = array("\x00", "\x0a", "\x0d", "\x1a");
        $replace = array('\0', '\n', '\r', '\Z');
        $value=str_replace('\\', '\\\\', $value);
        $value=str_replace('\'', '\\\'', $value);
        $value= "'" . str_replace($search, $replace, $value) . "'";
        return $value;
    }
    /**
     * Table rows extractor, close locks and commits after dump
     *
     * @param string $tableName  Name of table to export
     *
     * @return null
     */
    function endListValues($tableName)
    {
        if ($this->dumpSettings['disable-keys']) {
            $this->compressManager->write(
                $this->typeAdapter->end_add_disable_keys($tableName)
            );
        }

        if ($this->dumpSettings['add-locks']) {
            $this->compressManager->write(
                $this->typeAdapter->end_add_lock_table($tableName)
            );
        }

        if ($this->dumpSettings['single-transaction']) {
            $this->typeAdapter->exec($this->typeAdapter->commit_transaction());
        }

        if ($this->dumpSettings['lock-tables']) {
            $this->typeAdapter->unlock_table($tableName);
        }

        // Commit to enable autocommit
        if ($this->dumpSettings['no-autocommit']) {
            $this->compressManager->write(
                $this->typeAdapter->end_disable_autocommit()
            );
        }

        $this->compressManager->write(PHP_EOL);

        return;
    }
}