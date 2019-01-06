<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVLogger')) :
class BVLogger {
	public $db;
	public $table;
	const MAXROWCOUNT = 100000;

	function __construct($db, $table) {
		$this->db = $db;
		$this->table = $table;
	}

	public function log($data) {
		if (is_array($data)) {
			$tablename = $this->db->getBVTable($this->table);
			if ($this->db->rowsCount($tablename) > BVLogger::MAXROWCOUNT)
				$this->db->deleteRowsFromtable($this->table, 1);
			$this->db->replaceIntoBVTable($this->table, $data);
		}
	}
}
endif;