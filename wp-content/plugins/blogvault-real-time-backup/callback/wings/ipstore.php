<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVIPStoreCallback')) :

require_once dirname( __FILE__ ) . '/../../ipstore.php';

class BVIPStoreCallback {

	public function updateBVTableContent($table, $value, $filter) {
		global $bvcb;
		$bvcb->bvmain->db->query("UPDATE $table SET $value $filter;");
	}

	public function insertBVTableContent($table, $fields, $value) {
		global $bvcb;
		$bvcb->bvmain->db->query("INSERT INTO $table $fields values $value;");
	}

	public function deleteIPs($table, $rmfilters) {
		if (is_array($rmfilters)) {
			global $bvcb;
			foreach ($rmfilters as $rmfilter) {
				$rmfilter = base64_decode($rmfilter);
				$bvcb->bvmain->db->deleteBVTableContent($table, $rmfilter);
			}
		}
	}

	public function insertIPs($table, $fields, $values) {
		if (is_array($values)) {
			foreach ($values as $value) {
				$value = base64_decode($value);
				$this->insertBVTableContent($table, $fields, $value);
			}
		}
	}

	public function updateIPs($table, $value, $filters) {
		if (is_array($filters)) {
			foreach ($filters as $filter) {
				$filter = base64_decode($filter);
				$this->updateBVTableContent($table, $value, $filter);
			}
		}
	}

	public function getIPs($table, $auto_increment_offset, $type, $category) {
		global $bvcb;
		$query = "SELECT `start_ip_range` FROM $table WHERE id < $auto_increment_offset AND `type` = $type AND ";
		$query .= ($category == BVIPStore::FW) ? "`is_fw` = true;" : "`is_lp` = true;";
		return $bvcb->bvmain->db->getCol($query);
	}

	public function getIPStoreOffset($table, $auto_increment_offset) {
		global $bvcb;
		$db = $bvcb->bvmain->db;
		return intval($db->getVar("SELECT MAX(id) FROM $table WHERE id < $auto_increment_offset"));
	}

	public function getIPStoreInfo($table, $auto_increment_offset) {
			global $bvcb;
			$db = $bvcb->bvmain->db;
			$info = array();
			$info['fw_blacklisted_ips'] = $this->getIPs($table, $auto_increment_offset, BVIPStore::BLACKLISTED, BVIPStore::FW);
			$info['lp_blacklisted_ips'] = $this->getIPs($table, $auto_increment_offset, BVIPStore::BLACKLISTED, BVIPStore::LP);
			$info['fw_whitelisted_ips'] = $this->getIPs($table, $auto_increment_offset, BVIPStore::WHITELISTED, BVIPStore::FW);
			$info['lp_whitelisted_ips'] = $this->getIPs($table, $auto_increment_offset, BVIPStore::WHITELISTED, BVIPStore::LP);
			$info['ip_store_offset'] = $this->getIPStoreOffset($table, $auto_increment_offset);
			$info['country_ips_size'] = intval($db->getVar("SELECT COUNT(id) FROM $table WHERE id >= $auto_increment_offset"));
			return $info;
	}

	public function process($method) {
		global $bvresp, $bvcb;
		$db = $bvcb->bvmain->db;
		$table = $_REQUEST['table'];
		$bvTable = $db->getBVTable($table);
		$auto_increment_offset = $_REQUEST['auto_increment_offset'];
		if (!$db->isTablePresent($bvTable)) {
			$bvresp->addStatus("info", false);
		} else {
			switch ($method) {
			case "ipstrinfo":
				$info = $this->getIPStoreInfo($bvTable, $auto_increment_offset);
				$bvresp->addStatus("info", $info);
				break;
			case "insrtips":
				$values = $_REQUEST['values'];
				$fields = $_REQUEST['fields'];
				$rmfilter = $_REQUEST['rmfilter'];
				if ($rmfilter) {
					$db->deleteBVTableContent($table, $rmfilter);
				}
				$this->insertIPs($bvTable, $fields, $values);
				$bvresp->addStatus("offset", $this->getIPStoreOffset($bvTable, $auto_increment_offset));
				break;
			case "dltips":
				$rmfilters = $_REQUEST['rmfilters'];
				$this->deleteIPs($table, $rmfilters);
				$bvresp->addStatus("offset", $this->getIPStoreOffset($bvTable, $auto_increment_offset));
				break;
			case "updtips":
				$value = $_REQUEST['value'];
				$filters = $_REQUEST['filters'];
				$this->updateIPs($bvTable, $value, $filters);
				$bvresp->addStatus("offset", $this->getIPStoreOffset($bvTable, $auto_increment_offset));
				break;
			default:
				return false;
			}
			return true;
		}
	}
}
endif;
