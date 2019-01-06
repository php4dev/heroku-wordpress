<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVResponse')) :
	
require_once dirname( __FILE__ ) . '/streams.php';

class BVResponse {
	public $status;
	public $stream;

	function __construct() {
		$this->status = array("blogvault" => "response");
	}

	public function addStatus($key, $value) {
		$this->status[$key] = $value;
	}

	public function addArrayToStatus($key, $value) {
		if (!isset($this->status[$key])) {
			$this->status[$key] = array();
		}
		$this->status[$key][] = $value;
	}

	public function base64Encode($data, $chunk_size) {
		if ($chunk_size) {
			$out = "";
			$len = strlen($data);
			for ($i = 0; $i < $len; $i += $chunk_size) {
				$out .= base64_encode(substr($data, $i, $chunk_size));
			}
		} else {
			$out = base64_encode($data);
		}
		return $out;
	}

	public function finish() {
		$response = "bvbvbvbvbv".serialize($this->status)."bvbvbvbvbv";
		if (array_key_exists('bvb64resp', $_REQUEST)) {
			$chunk_size = array_key_exists('bvb64cksize', $_REQUEST) ? intval($_REQUEST['bvb64cksize']) : false;
			$response = "bvb64bvb64".$this->base64Encode($response, $chunk_size)."bvb64bvb64";
		}
		die($response);
	}

	public function writeStream($_string) {
		if (strlen($_string) > 0) {
			$chunk = "";
			if (isset($_REQUEST['bvb64stream'])) {
				$chunk_size = array_key_exists('bvb64cksize', $_REQUEST) ? intval($_REQUEST['bvb64cksize']) : false;
				$_string = $this->base64Encode($_string, $chunk_size);
				$chunk .= "BVB64" . ":";
			}
			$chunk .= (strlen($_string) . ":" . $_string);
			if (isset($_REQUEST['checksum'])) {
				if ($_REQUEST['checksum'] == 'crc32') {
					$chunk = "CRC32" . ":" . crc32($_string) . ":" . $chunk;
				} else if ($_REQUEST['checksum'] == 'md5') {
					$chunk = "MD5" . ":" . md5($_string) . ":" . $chunk;
				}
			}
			$this->stream->writeChunk($chunk);
		}
	}

	public function startStream() {
		global $bvcb;
		$this->stream = new BVRespStream();
		if (array_key_exists('apicall',$_REQUEST)) {
			$this->stream = new BVHttpStream($_REQUEST['apihost'], intval($_REQUEST['apiport']), array_key_exists('apissl', $_REQUEST));
			if (!$this->stream->connect()) {
				$this->addStatus("httperror", "Cannot Open Connection to Host");
				$this->addStatus("streamerrno", $this->stream->errno);
				$this->addStatus("streamerrstr", $this->stream->errstr);
				return false;
			}
			if (array_key_exists('acbmthd', $_REQUEST)) {
				$url = $bvcb->bvmain->authenticatedUrl('/bvapi/'.$_REQUEST['acbmthd'], $_REQUEST['bvapicheck'], false);
				if (array_key_exists('acbqry', $_REQUEST)) {
					$url .= "&".$_REQUEST['acbqry'];
				}
				$this->stream->multipartChunkedPost($url);
			}	else {
				$this->addStatus("httperror", "ApiCall method not present");
				return false;
			}
		}
		return true;
	}

	public function endStream() {
		$this->stream->endStream();
		if (array_key_exists('apicall', $_REQUEST)) {
			$resp = $this->stream->getResponse();
			if (array_key_exists('httperror', $resp)) {
				$this->addStatus("httperror", $resp['httperror']);
			} else {
				$this->addStatus("respstatus", $resp['status']);
				$this->addStatus("respstatus_string", $resp['status_string']);
			}
		}
	}
}
endif;