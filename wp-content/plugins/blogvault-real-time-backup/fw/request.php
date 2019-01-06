<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVRequest')) :
class BVRequest {
  private $fileNames;
  private $files;
  private $headers;
  private $host;
  private $ip;
  private $method;
  private $path;
  private $queryString;
  private $timestamp;
  private $uri;
	private $body;
	private $cookies;
	private $respcode;
	private $status;

	#status
 	const ALLOWED  = 1;
	const BLOCKED  = 2;
	const BYPASSED = 3;

	#category
	const BLACKLISTED = 1;
	const WHITELISTED = 2;
	const NORMAL      = 3;

	public function __construct($ip) {
		$fileNames = array();
		$headers = array();
		$host = '';
		$method = '';
		$path = '';
		$this->ip = $ip;
		$this->setRespCode(200);
		$this->setCategory(BVRequest::NORMAL);
		$this->setStatus(BVRequest::ALLOWED);
		$this->setTimestamp(time());
		$this->setQueryString(BVRequest::removeMagicQuotes($_GET));
		$this->setCookies(BVRequest::removeMagicQuotes($_COOKIE));
		$this->setBody(BVRequest::removeMagicQuotes($_POST));
		$this->setFiles(BVRequest::removeMagicQuotes($_FILES));
		if (!empty($_FILES)) {
			foreach ($_FILES as $input => $file) {
				$fileNames[$input] = BVRequest::removeMagicQuotes($file['name']);
			}
		}
		$this->setFileNames($fileNames);
		if (is_array($_SERVER)) {
			foreach ($_SERVER as $key => $value) {
				if (strpos($key, 'HTTP_') === 0) {
					$header = substr($key, 5);
					$header = str_replace(array(' ', '_'), array('', ' '), $header);
					$header = ucwords(strtolower($header));
					$header = str_replace(' ', '-', $header);
					$headers[$header] = BVRequest::removeMagicQuotes($value);
				}
			}
			if (array_key_exists('CONTENT_TYPE', $_SERVER)) {
				$headers['Content-Type'] = BVRequest::removeMagicQuotes($_SERVER['CONTENT_TYPE']);
			}
			if (array_key_exists('CONTENT_LENGTH', $_SERVER)) {
				$headers['Content-Length'] = BVRequest::removeMagicQuotes($_SERVER['CONTENT_LENGTH']);
			}
			if (array_key_exists('REFERER', $_SERVER)) {
				$headers['Referer'] = BVRequest::removeMagicQuotes($_SERVER['REFERER']);
			}
			if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
				$headers['User-Agent'] = BVRequest::removeMagicQuotes($_SERVER['HTTP_USER_AGENT']);
			}

			if (array_key_exists('Host', $headers)) {
				$host = $headers['Host'];
			} else if (array_key_exists('SERVER_NAME', $_SERVER)) {
				$host = BVRequest::removeMagicQuotes($_SERVER['SERVER_NAME']);
			}

			$method = array_key_exists('REQUEST_METHOD', $_SERVER) ? BVRequest::removeMagicQuotes($_SERVER['REQUEST_METHOD']) : 'GET';
			$uri = array_key_exists('REQUEST_URI', $_SERVER) ? BVRequest::removeMagicQuotes($_SERVER['REQUEST_URI']) : '';
			$_uri = parse_url($uri);
			$path = (is_array($_uri) && array_key_exists('path', $_uri)) ? $_uri['path']  : $uri;
		}
		$this->setHeaders($headers);
		$this->setHost($host);
		$this->setMethod($method);
		$this->setUri($uri);
		$this->setPath($path);
	}
	
	public function setStatus($status) {
		$this->status = $status;
	}

	public function setCategory($category) {
		$this->category = $category;
	}

	public function setBody($body) {
		$this->body = $body;
	}

	public function setCookies($cookies) {
		$this->cookies = $cookies;
	}

	public function setFileNames($fileNames) {
		$this->fileNames = $fileNames;
	}

	public function setFiles($files) {
		$this->files = $files;
	}
	
	public function setHeaders($headers) {
		$this->headers = $headers;
	}

	public function setRespCode($code) {
		$this->respcode = $code;
	}

	public function getRespCode() {
		return $this->respcode;
	}

	public function setHost($host) {
		$this->host = $host;
	}

	public function setMethod($method) {
		$this->method = $method;
	}

	public function setPath($path) {
		$this->path = $path;
	}

	public function setQueryString($queryString) {
		$this->queryString = $queryString;
	}

	public function setTimestamp($timestamp) {
		$this->timestamp = $timestamp;
	}

	public function setUri($uri) {
		$this->uri = $uri;
	}
	
	public function getStatus() {
		return $this->status;
	}

	public function getCategory() {
		return $this->category;
	}

	public function captureRespCode($status_header) {
		if (preg_match('/HTTP\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $status_header, $tokens)) {
			$this->setRespCode(intval($tokens[2]));
		}
		return $status_header;
	}

	public function getDataToLog() {
		$querystr = maybe_serialize($this->getQueryString());
		$querystr = (strlen($querystr) > 512) ? maybe_serialize(array("bv_over_size" => true)) : $querystr;
		$referer = $this->getHeader('Referer') ? $this->getHeader('Referer') : '';
		$user_agent = $this->getHeader('User-Agent') ? $this->getHeader('User-Agent') : '';
		$data = array(
			"path"         => $this->getPath(),
			"filenames"    => maybe_serialize($this->getFileNames()),
			"host"         => $this->getHost(),
			"time"         => $this->getTimeStamp(),
			"ip"           => $this->getIP(),
			"method"       => $this->getMethod(),
			"query_string" => $querystr,
			"user_agent"   => $user_agent,
			"resp_code"    => $this->getRespCode(),
			"referer"      => $referer,
			"status"       => $this->getStatus(),
			"category"     => $this->getCategory()
		);
		return $data;
	}

	protected function getKeyVal($array, $key) {
		if (is_array($array)) {
			if (is_array($key)) {
				$_key = array_shift($key);
				if (array_key_exists($_key, $array)) {
					if (count($key) > 0) {
						return $this->getKeyVal($array[$_key], $key);
					} else {
						return $array[$_key];
					}
				}
			} else {
				return array_key_exists($key, $array) ? $array[$key] : null;
			}
		}
		return null;
	}
	
	public function getBody() {
		if (func_num_args() > 0) {
			$args = func_get_args();
			return $this->getKeyVal($this->body, $args);
		}
		return $this->body;
	}
	
	public function getCookies() {
		if (func_num_args() > 0) {
			$args = func_get_args();
			return $this->getKeyVal($this->cookies, $args);
		}
		return $this->cookies;
	}
	
	public function getQueryString() {
		if (func_num_args() > 0) {
			$args = func_get_args();
			return $this->getKeyVal($this->queryString, $args);
		}
		return $this->queryString;
	}
	
	public function getHeader($key) {
		if (array_key_exists($key, $this->headers)) {
			return $this->headers[$key];
		}
		return null;
	}
	
	public function getFiles() {
		if (func_num_args() > 0) {
			$args = func_get_args();
			return $this->getKeyVal($this->files, $args);
		}
		return $this->files;
	}

	public function getFileNames() {
		if (func_num_args() > 0) {
			$args = func_get_args();
			return $this->getKeyVal($this->fileNames, $args);
		}
		return $this->fileNames;
	}

	public function getHost() {
		return $this->host;
	}

	public function getURI() {
		return $this->uri;
	}

	public function getPath() {
		return $this->path;
	}

	public function getIP() {
		return $this->ip;
	}

	public function getMethod() {
		return $this->method;
	}

	public function getTimestamp() {
		return $this->timestamp;
	}

	public static function removeMagicQuotes($value) {
		if (function_exists("get_magic_quotes_gpc") && get_magic_quotes_gpc()) {
			return BVRequest::removeSlashesRecursively($value);
		}
		return $value;
	}

	public static function removeSlashesRecursively($value) {
		if (is_array($value)) {
			$value = array_map(array('self', 'removeSlashesRecursively',), $value);
		} else if (is_string($value)) {
			$value = stripslashes($value);
		}
		return $value;
	}
}
endif;