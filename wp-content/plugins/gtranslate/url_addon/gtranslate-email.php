<?php
error_reporting(0);

include 'config.php';

if(!isset($_GET['glang']) or !isset($_POST['body']))
    exit;

$glang = $_GET['glang'];
$body = $_POST['body'];

$main_lang = isset($data['default_language']) ? $data['default_language'] : $main_lang;

if($glang == $main_lang) {
    exit;
}

$wp_config_dir = dirname(__FILE__, 5) . '/wp-config.php';
if(file_exists($wp_config_dir) and isset($_POST['access_key'])) {
    include $wp_config_dir;
    if(md5(substr(NONCE_SALT, 0, 10) . substr(NONCE_KEY, 0, 5)) != $_POST['access_key'])
        exit;
} else {
    exit;
}

if(!isset($_POST['subject'])) {
    die($body);
}

if(!function_exists('curl_init')) {
    if(function_exists('http_response_code'))
        http_response_code(500);

    echo 'PHP Curl library is required';
    exit;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://tdns.gtranslate.net/tdn-bin/email-translate?lang='.$glang);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// Debug
if($debug or isset($_GET['enable_debug'])) {
    $fh = fopen(dirname(__FILE__).'/debug.txt', 'a');
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_STDERR, $fh);
}

$response = curl_exec($ch);
$response_info = curl_getinfo($ch);
curl_close($ch);

echo $response;