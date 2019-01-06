<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVFSCallback')) :
class BVFSCallback {
	function fileStat($relfile) {
		$absfile = ABSPATH.$relfile;
		$fdata = array();
		$fdata["filename"] = $relfile;
		$stats = @stat($absfile);
		if ($stats) {
			foreach (preg_grep('#size|uid|gid|mode|mtime#i', array_keys($stats)) as $key ) {
				$fdata[$key] = $stats[$key];
			}
			if (is_link($absfile)) {
				$fdata["link"] = @readlink($absfile);
			}
		} else {
			$fdata["failed"] = true;
		}
		return $fdata;
	}

	function scanFilesUsingGlob($initdir = "./", $offset = 0, $limit = 0, $bsize = 512, $recurse = true, $regex = '{.??,}*') {
		global $bvresp;
		$i = 0;
		$dirs = array();
		$dirs[] = $initdir;
		$bfc = 0;
		$bfa = array();
		$current = 0;
		$abspath = realpath(ABSPATH).'/';
		$abslen = strlen($abspath);
		# XNOTE: $recurse cannot be used directly here
		while ($i < count($dirs)) {
			$dir = $dirs[$i];

			foreach (glob($abspath.$dir.$regex, GLOB_NOSORT | GLOB_BRACE) as $absfile) {
				$relfile = substr($absfile, $abslen);
				if (is_dir($absfile) && !is_link($absfile)) {
					$dirs[] = $relfile."/";
				}
				$current++;
				if ($offset >= $current)
					continue;
				if (($limit != 0) && (($current - $offset) > $limit)) {
					$i = count($dirs);
					break;
				}
				$bfa[] = $this->fileStat($relfile);
				$bfc++;
				if ($bfc == $bsize) {
					$str = serialize($bfa);
					$bvresp->writeStream($str);
					$bfc = 0;
					$bfa = array();
				}
			}
			$regex = '{.??,}*';
			$i++;
			if ($recurse == false)
				break;
		}
		if ($bfc != 0) {
			$str = serialize($bfa);
			$bvresp->writeStream($str);
		}
	}

	function scanFiles($initdir = "./", $offset = 0, $limit = 0, $bsize = 512, $recurse = true) {
		global $bvresp;
		$i = 0;
		$dirs = array();
		$dirs[] = $initdir;
		$bfc = 0;
		$bfa = array();
		$current = 0;
		while ($i < count($dirs)) {
			$dir = $dirs[$i];
			$d = @opendir(ABSPATH.$dir);
			if ($d) {
				while (($file = readdir($d)) !== false) {
					if ($file == '.' || $file == '..') { continue; }
					$relfile = $dir.$file;
					$absfile = ABSPATH.$relfile;
					if (is_dir($absfile) && !is_link($absfile)) {
						$dirs[] = $relfile."/";
					}
					$current++;
					if ($offset >= $current)
						continue;
					if (($limit != 0) && (($current - $offset) > $limit)) {
						$i = count($dirs);
						break;
					}
					$bfa[] = $this->fileStat($relfile);
					$bfc++;
					if ($bfc == $bsize) {
						$str = serialize($bfa);
						$bvresp->writeStream($str);
						$bfc = 0;
						$bfa = array();
					}
				}
				closedir($d);
			}
			$i++;
			if ($recurse == false)
				break;
		}
		if ($bfc != 0) {
			$str = serialize($bfa);
			$bvresp->writeStream($str);
		}
	}

	function calculateMd5($absfile, $fdata, $offset, $limit, $bsize) {
		if ($offset == 0 && $limit == 0) {
			$md5 = md5_file($absfile);
		} else {
			if ($limit == 0)
				$limit = $fdata["size"];
			if ($offset + $limit < $fdata["size"])
				$limit = $fdata["size"] - $offset;
			$handle = fopen($absfile, "rb");
			$ctx = hash_init('md5');
			fseek($handle, $offset, SEEK_SET);
			$dlen = 1;
			while (($limit > 0) && ($dlen > 0)) {
				if ($bsize > $limit)
					$bsize = $limit;
				$d = fread($handle, $bsize);
				$dlen = strlen($d);
				hash_update($ctx, $d);
				$limit -= $dlen;
			}
			fclose($handle);
			$md5 = hash_final($ctx);
		}
		return $md5;
	}

	function getFilesStats($files, $offset = 0, $limit = 0, $bsize = 102400, $md5 = false) {
		global $bvresp;
		foreach ($files as $file) {
			$fdata = $this->fileStat($file);
			$absfile = ABSPATH.$file;
			if (!is_readable($absfile)) {
				$bvresp->addArrayToStatus("missingfiles", $file);
				continue;
			}
			if ($md5 === true) {
				$fdata["md5"] = $this->calculateMd5($absfile, $fdata, $offset, $limit, $bsize);
			}
			$bvresp->addArrayToStatus("stats", $fdata);
		}
	}

	function uploadFiles($files, $offset = 0, $limit = 0, $bsize = 102400) {
		global $bvresp;

		foreach ($files as $file) {
			if (!is_readable(ABSPATH.$file)) {
				$bvresp->addArrayToStatus("missingfiles", $file);
				continue;
			}
			$handle = fopen(ABSPATH.$file, "rb");
			if (($handle != null) && is_resource($handle)) {
				$fdata = $this->fileStat($file);
				$_limit = $limit;
				$_bsize = $bsize;
				if ($_limit == 0)
					$_limit = $fdata["size"];
				if ($offset + $_limit > $fdata["size"])
					$_limit = $fdata["size"] - $offset;
				$fdata["limit"] = $_limit;
				$sfdata = serialize($fdata);
				$bvresp->writeStream($sfdata);
				fseek($handle, $offset, SEEK_SET);
				$dlen = 1;
				while (($_limit > 0) && ($dlen > 0)) {
					if ($_bsize > $_limit)
						$_bsize = $_limit;
					$d = fread($handle, $_bsize);
					$dlen = strlen($d);
					$bvresp->writeStream($d);
					$_limit -= $dlen;
				}
				fclose($handle);
			} else {
				$bvresp->addArrayToStatus("unreadablefiles", $file);
			}
		}
	}

	function process($method) {
		switch ($method) {
		case "scanfilesglob":
			$initdir = urldecode($_REQUEST['initdir']);
			$offset = intval(urldecode($_REQUEST['offset']));
			$limit = intval(urldecode($_REQUEST['limit']));
			$bsize = intval(urldecode($_REQUEST['bsize']));
			$regex = urldecode($_REQUEST['regex']);
			$recurse = true;
			if (array_key_exists('recurse', $_REQUEST) && $_REQUEST["recurse"] == "false") {
				$recurse = false;
			}
			$this->scanFilesUsingGlob($initdir, $offset, $limit, $bsize, $recurse, $regex);
			break;
		case "scanfiles":
			$initdir = urldecode($_REQUEST['initdir']);
			$offset = intval(urldecode($_REQUEST['offset']));
			$limit = intval(urldecode($_REQUEST['limit']));
			$bsize = intval(urldecode($_REQUEST['bsize']));
			$recurse = true;
			if (array_key_exists('recurse', $_REQUEST) && $_REQUEST["recurse"] == "false") {
				$recurse = false;
			}
			$this->scanFiles($initdir, $offset, $limit, $bsize, $recurse);
			break;
		case "getfilesstats":
			$files = $_REQUEST['files'];
			$offset = intval(urldecode($_REQUEST['offset']));
			$limit = intval(urldecode($_REQUEST['limit']));
			$bsize = intval(urldecode($_REQUEST['bsize']));
			$md5 = false;
			if (array_key_exists('md5', $_REQUEST)) {
				$md5 = true;
			}
			$this->getFilesStats($files, $offset, $limit, $bsize, $md5);
			break;
		case "sendmanyfiles":
			$files = $_REQUEST['files'];
			$offset = intval(urldecode($_REQUEST['offset']));
			$limit = intval(urldecode($_REQUEST['limit']));
			$bsize = intval(urldecode($_REQUEST['bsize']));
			$this->uploadFiles($files, $offset, $limit, $bsize);
			break;
		case "filelist":
			$initdir = $_REQUEST['initdir'];
			$glob_option = GLOB_MARK;
			if(array_key_exists('onlydir', $_REQUEST)) {
				$glob_option = GLOB_ONLYDIR;
			}
			$regex = "*";
			if(array_key_exists('regex', $_REQUEST)){
				$regex = $_REQUEST['regex'];
			}
			$directoryList = glob($initdir.$regex, $glob_option);
			$this->getFilesStats($directoryList);
			break;
		default:
			return false;
		}
		return true;
	}
}
endif;