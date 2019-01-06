<?php

if (!defined('ABSPATH')) exit;
if (!class_exists('BVLib')) :

class BVLib {
	public function objectToArray($obj) {
		return json_decode(json_encode($obj), true);
	}

	public function dbsig($full = false) {
		if (defined('DB_USER') && defined('DB_NAME') &&
				defined('DB_PASSWORD') && defined('DB_HOST')) {
			$sig = sha1(DB_USER.DB_NAME.DB_PASSWORD.DB_HOST);
		} else {
			$sig = "bvnone".$this->randString(34);
		}
		if ($full)
			return $sig;
		else
			return substr($sig, 0, 6);
	}

	public function randString($length) {
		$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		$str = "";
		$size = strlen($chars);
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[rand(0, $size - 1)];
		}
		return $str;
	}

	public function http_request($url, $body) {
		$_body = array(
			'method' => 'POST',
			'timeout' => 15,
			'body' => $body);

		return wp_remote_post($url, $_body);
	}
}
endif;