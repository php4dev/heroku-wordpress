<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVDb')) :

class BVDb {
	function dbprefix() {
		global $wpdb;
		$prefix = $wpdb->base_prefix ? $wpdb->base_prefix : $wpdb->prefix;
		return $prefix;
	}

	function prepare($query, $args) {
		global $wpdb;
		return $wpdb->prepare($query, $args);
	}

	function getSiteId() {
		global $wpdb;
		return $wpdb->siteid;
	}

	function getResult($query, $obj = ARRAY_A) {
		global $wpdb;
		return $wpdb->get_results($query, $obj);
	}

	function query($query) {
		global $wpdb;
		return $wpdb->query($query);
	}

	function getVar($query, $col = 0, $row = 0) {
		global $wpdb;
		return $wpdb->get_var($query, $col, $row);
	}

	function getCol($query, $col = 0) {
		global $wpdb;
		return $wpdb->get_col($query, $col);
	}

	function tableName($table) {
		return $table[0];
	}

	function showTables() {
		$tables = $this->getResult("SHOW TABLES", ARRAY_N);
		return array_map(array($this, 'tableName'), $tables);
	}

	function showTableStatus() {
		return $this->getResult("SHOW TABLE STATUS");
	}

	function tableKeys($table) {
		return $this->getResult("SHOW KEYS FROM $table;");
	}

	function describeTable($table) {
		return $this->getResult("DESCRIBE $table;");
	}

	function checkTable($table, $type) {
		return $this->getResult("CHECK TABLE $table $type;");
	}

	function repairTable($table) {
		return $this->getResult("REPAIR TABLE $table;");
	}

	function showTableCreate($table) {
		return $this->getVar("SHOW CREATE TABLE $table;", 1);
	}

	function rowsCount($table) {
		$count = $this->getVar("SELECT COUNT(*) FROM $table;");
		return intval($count);
	}

	function createTable($query, $name) {
		$table = $this->getBVTable($name);
		if (!$this->isTablePresent($table)) {
			if (array_key_exists('usedbdelta', $_REQUEST)) {
				if (!function_exists('dbDelta'))
					require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				dbDelta($query);
			} else {
				$this->query($query);
			}
		}
		return $this->isTablePresent($table);
	}

	function getTableContent($table, $fields = '*', $filter = '', $limit = 0, $offset = 0) {
		$query = "SELECT $fields from $table $filter";
		if ($limit > 0)
			$query .= " LIMIT $limit";
		if ($offset > 0)
			$query .= " OFFSET $offset";
		$rows = $this->getResult($query);
		return $rows;
	}

	function isTablePresent($table) {
		return ($this->getVar("SHOW TABLES LIKE '$table'") === $table);
	}

	function getCharsetCollate() {
		global $wpdb;
		return $wpdb->get_charset_collate();
	}

	function getWPTable($name) {
		return ($this->dbprefix() . $name);
	}

	function getBVTable($name) {
		return ($this->getWPTable("bv_" . $name));
	}

	function truncateBVTable($name) {
		$table = $this->getBVTable($name);
		if ($this->isTablePresent($table)) {
			return $this->query("TRUNCATE TABLE $table;");
		} else {
			return false;
		}
	}
	
	function deleteBVTableContent($name, $filter = "") {
		$table = $this->getBVTable($name);
		if ($this->isTablePresent($table)) {
			return $this->query("DELETE FROM $table $filter;");
		} else {
			return false;
		}
	}

	function dropBVTable($name) {
		$table = $this->getBVTable($name);
		if ($this->isTablePresent($table)) {
			$this->query("DROP TABLE IF EXISTS $table;");
		}
		return !$this->isTablePresent($table);
	}

	function deleteRowsFromtable($name, $count = 1) {
		$table = $this->getBVTable($name);
		if ($this->isTablePresent($table)) {
			return $this->getResult("DELETE FROM $table LIMIT $count;");
		} else {
			return false;
		}
	}

	function replaceIntoBVTable($name, $value) {
		global $wpdb;
		$table = $this->getBVTable($name);
		return $wpdb->replace($table, $value);
	}
}
endif;