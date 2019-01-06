<?php 
/**
 * Logger
 * 
 * @author Mike Ems
 * @package Mvied
 *
 */

class Mvied_Logger implements Mvied_Logger_Interface {

	/**
	 * Instance
	 *
	 * @var Mvied_Logger
	 */
	private static $_instance;

	/**
	 * Log Entries
	 *
	 * @var array
	 */
	protected $_log = array();

	/**
	 * Get singleton instance
	 *
	 * @param none
	 * @return Mvied_Logger
	 */
	public static function getInstance() {
		if ( ! isset(self::$_instance) ) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	/**
	 * Get Log
	 *
	 * @param none
	 * @return array
	 */
	public function getLog() {
		return $this->_log;
	}

	/**
	 * Sets log array
	 *
	 * @param array $log
	 * @return $this
	 */
	public function setLog( array $log = array() ) {
		$this->_log = $log;
		return $this;
	}

	/**
	 * Adds a string to an array of log entries
	 *
	 * @param string $string
	 * @return $this
	 */
	public function log( $string ) {
		$this->_log[] = $string;
		return $this;
	}

	/**
	 * Console Log
	 * 
	 * Output contents of the log to the browser's console.
	 *
	 * @param none
	 * @return string $code
	 */
	public function consoleLog() {
		$code = "<script type=\"text/javascript\">\n\tif ( typeof console === 'object' ) {\n";
		$log = $this->getLog();
		foreach( $log as $log_entry ) {
			if ( is_array($log_entry) ) {
				$log_entry = json_encode($log_entry);
			} else {
				$log_entry = "'" . addslashes($log_entry) . "'";
			}
			$code .= "\t\tconsole.log(" . $log_entry . ");\n";
		}
		$code .= "\t}\n</script>\n";
		return $code;
	}

	/**
	 * File Log
	 * 
	 * Writes the contens of the log to a file
	 *
	 * @param sring $filename
	 * @return int | false
	 */
	public function fileLog( $filename = '' ) {
		if ( $filename == '' ) {
			$filename = 'debug.log.txt';
		}
		return file_put_contents($filename, implode("\r\n", $this->getLog()), FILE_APPEND);
	}

}