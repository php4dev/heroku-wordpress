<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVDynSyncCallback')) :
	
require_once dirname( __FILE__ ) . '/../../dynsync.php';

class BVDynSyncCallback {
	public function dropDynSyncTable() {
		global $bvcb;
		return $bvcb->bvmain->db->dropBVTable(BVDynSync::$dynsync_table);
	}

	public function createDynSyncTable() {
		global $bvcb;
		$db = $bvcb->bvmain->db;
		$charset_collate = $db->getCharsetCollate();
		$table = $bvcb->bvmain->db->getBVTable(BVDynSync::$dynsync_table);
		$query = "CREATE TABLE $table (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			site_id int NOT NULL,
			event_type varchar(40) NOT NULL DEFAULT '',
			event_tag varchar(40) NOT NULL DEFAULT '',
			event_data text NOT NULL DEFAULT '',
			PRIMARY KEY (id)
		) $charset_collate;";
		return $db->createTable($query, BVDynSync::$dynsync_table);
	}

	public function process($method) {
		global $bvresp, $bvcb;
		$info = $bvcb->bvmain->info;
		switch ($method) {
		case "truncdynsynctable":
			$bvresp->addStatus("status", $bvcb->bvmain->db->truncateBVTable(BVDynSync::$dynsync_table));
			break;
		case "dropdynsynctable":
			$bvresp->addStatus("status", $this->dropDynSyncTable());
			break;
		case "createdynsynctable":
			$bvresp->addStatus("status", $this->createDynSyncTable());
			break;
		case "setdynsync":
			if (array_key_exists('dynplug', $_REQUEST)) {
				$info->updateOption('bvdynplug', $_REQUEST['dynplug']);
			} else {
				$info->deleteOption('bvdynplug');
			}
			$info->updateOption('bvDynSyncActive', $_REQUEST['dynsync']);
			break;
		case "setwoodyn":
			$info->updateOption('bvWooDynSync', $_REQUEST['woodyn']);
			break;
		case "setignorednames":
			switch ($_REQUEST['table']) {
			case "options":
				$info->updateOption('bvIgnoredOptions', $_REQUEST['names']);
				break;
			case "postmeta":
				$info->updateOption('bvIgnoredPostmeta', $_REQUEST['names']);
				break;
			}
			break;
		case "getignorednames":
			switch ($_REQUEST['table']) {
			case "options":
				$names = $info->getOption('bvIgnoredOptions');
				break;
			case "postmeta":
				$names = $info->getOption('bvIgnoredPostmeta');
				break;
			}
			$bvresp->addStatus("names", $names);
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;