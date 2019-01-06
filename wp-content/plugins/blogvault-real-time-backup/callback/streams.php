<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVRespStream')) :
	
class BVRespStream {
	public function writeChunk($_string) {
		echo "ckckckckck".$_string."ckckckckck";
	}

	public function endStream() {
		echo "rerererere";
	}
}

class BVHttpStream {
	var $user_agent = 'BVHttpStream';
	var $host;
	var $port;
	var $timeout = 20;
	var $conn;
	var $errno;
	var $errstr;
	var $boundary;
	var $apissl;

	/**
	 * PHP5 constructor.
	 */
	function __construct($_host, $_port, $_apissl) {
		$this->host = $_host;
		$this->port = $_port;
		$this->apissl = $_apissl;
	}

	public function connect() {
		if ($this->apissl && function_exists('stream_socket_client')) {
			$this->conn = stream_socket_client("ssl://".$this->host.":".$this->port, $errno, $errstr, $this->timeout);
		} else {
			$this->conn = @fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
		}
		if (!$this->conn) {
			$this->errno = $errno;
			$this->errstr = $errstr;
			return false;
		}
		socket_set_timeout($this->conn, $this->timeout);
		return true;
	}

	public function write($data) {
		fwrite($this->conn, $data);
	}

	public function sendChunk($data) {
		$this->write(sprintf("%x\r\n", strlen($data)));
		$this->write($data);
		$this->write("\r\n");
	}

	public function sendRequest($method, $url, $headers = array(), $body = null) {
		$def_hdrs = array("Connection" => "keep-alive",
			"Host" => $this->host);
		$headers = array_merge($def_hdrs, $headers);
		$request = strtoupper($method)." ".$url." HTTP/1.1\r\n";
		if (null != $body) {
			$headers["Content-length"] = strlen($body);
		}
		foreach($headers as $key=>$val) {
			$request .= $key.":".$val."\r\n";
		}
		$request .= "\r\n";
		if (null != $body) {
			$request .= $body;
		}
		$this->write($request);
		return $request;
	}

	public function post($url, $headers = array(), $body = "") {
		if(is_array($body)) {
			$b = "";
			foreach($body as $key=>$val) {
				$b .= $key."=".urlencode($val)."&";
			}
			$body = substr($b, 0, strlen($b) - 1);
		}
		$this->sendRequest("POST", $url, $headers, $body);
	}

	public function streamedPost($url, $headers = array()) {
		$headers['Transfer-Encoding'] = "chunked";
		$this->sendRequest("POST", $url, $headers);
	}

	public function multipartChunkedPost($url) {
		$mph = array(
				"Content-Disposition" => "form-data; name=bvinfile; filename=data",
				"Content-Type" => "application/octet-stream"
		);
		$rnd = rand(100000, 999999);
		$this->boundary = "----".$rnd;
		$prologue = "--".$this->boundary."\r\n";
		foreach($mph as $key=>$val) {
			$prologue .= $key.":".$val."\r\n";
		}
		$prologue .= "\r\n";
		$headers = array('Content-Type' => "multipart/form-data; boundary=".$this->boundary);
		$this->streamedPost($url, $headers);
		$this->sendChunk($prologue);
	}

	public function writeChunk($data) {
		$this->sendChunk($data);
	}

	public function closeChunk() {
		$this->sendChunk("");
	}

	public function endStream() {
		$epilogue = "\r\n\r\n--".$this->boundary."--\r\n";
		$this->sendChunk($epilogue);
		$this->closeChunk();
	}

	public function getResponse() {
		$response = array();
		$response['headers'] = array();
		$state = 1;
		$conlen = 0;
		stream_set_timeout($this->conn, 300);
		while (!feof($this->conn)) {
			$line = fgets($this->conn, 4096);
			if (1 == $state) {
				if (!preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $line, $m)) {
					$response['httperror'] = "Status code line invalid: ".htmlentities($line);
					return $response;
				}
				$response['http_version'] = $m[1];
				$response['status'] = $m[2];
				$response['status_string'] = $m[3];
				$state = 2;
			} else if (2 == $state) {
				# End of headers
				if (2 == strlen($line)) {
					if ($conlen > 0)
						$response['body'] = fread($this->conn, $conlen);
					return $response;
				}
				if (!preg_match('/([^:]+):\\s*(.*)/', $line, $m)) {
					// Skip to the next header
					continue;
				}
				$key = strtolower(trim($m[1]));
				$val = trim($m[2]);
				$response['headers'][$key] = $val;
				if ($key == "content-length") {
					$conlen = intval($val);
				}
			}
		}
		return $response;
	}
}
endif;