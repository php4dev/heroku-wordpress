<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVMonitCallback')) :

class BVMonitCallback {
	public function getData($table, $limit = 0, $filter = "") {
		global $bvcb;
		$result = array();
		$data = array();
		$rows = $bvcb->bvmain->db->getTableContent($table, '*', $filter, $limit);
		$last_id = 0;
		foreach ($rows as $row) {
			$result[] = $row;
			$last_id = $row['id'];
		}
		$data['last_id'] = $last_id;
		$data['rows'] = $result;
		return $data;
	}

	public function deleteBvDynamicEvents($filter = "") {
		global $bvcb;
		$name = BVDynSync::$dynsync_table;
		return $bvcb->bvmain->db->deleteBVTableContent($name, $filter);
	}

	public function process($method) {
		global $bvresp, $bvcb;
		$db = $bvcb->bvmain->db;
		$info = $bvcb->bvmain->info;
		$bvcb->bvmain->setMonitTime();
		switch ($method) {
		case "getdata":
			if (array_key_exists('lp', $_REQUEST)) {
				require_once dirname( __FILE__ ) . '/../../lp/config.php';
				$lp_params = $_REQUEST['lp'];
				$limit = intval(urldecode($lp_params['limit']));
				$filter = urldecode($lp_params['filter']);
				$db->deleteBVTableContent(BVLPConfig::$requests_table, $lp_params['rmfilter']);
				$table = $bvcb->bvmain->db->getBVTable(BVLPConfig::$requests_table);
				$bvresp->addStatus("lplogs", $this->getData($table, $limit, $filter));
			}
			if (array_key_exists('fw', $_REQUEST)) {
				require_once dirname( __FILE__ ) . '/../../fw/config.php';
				$fw_params = $_REQUEST['fw'];
				$limit = intval(urldecode($fw_params['limit']));
				$filter = urldecode($fw_params['filter']);
				$db->deleteBVTableContent(BVFWConfig::$requests_table, $fw_params['rmfilter']);
				$table = $bvcb->bvmain->db->getBVTable(BVFWConfig::$requests_table);
				$bvresp->addStatus("fwlogs", $this->getData($table, $limit, $filter));
			}
			if (array_key_exists('dynevent', $_REQUEST)) {
				require_once dirname( __FILE__ ) . '/../../dynsync.php';
				$isdynsyncactive = $info->getOption('bvDynSyncActive');
				if ($isdynsyncactive == 'yes') {
					$limit = intval(urldecode($_REQUEST['limit']));
					$filter = urldecode($_REQUEST['filter']);
					$this->deleteBvDynamicEvents($_REQUEST['rmfilter']);
					$table = $bvcb->bvmain->db->getBVTable(BVDynSync::$dynsync_table);
					$data = $this->getData($table, $limit, $filter);
					$bvresp->addStatus('last_id', $data['last_id']);
					$bvresp->addStatus('events', $data['rows']);
					$bvresp->addStatus('timestamp', time());
					$bvresp->addStatus("status", true);
				}
			}
			break;
		case "rmdata":
			require_once dirname( __FILE__ ) . '/../../dynsync.php';
			$filter = urldecode($_REQUEST['filter']);
			$bvresp->addStatus("status", $this->deleteBvDynamicEvents($filter));
			break;
		}
	}
}
endif;