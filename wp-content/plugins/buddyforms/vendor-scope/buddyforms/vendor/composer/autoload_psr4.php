<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

 $vendorDir = dirname(dirname(__FILE__)); $baseDir = dirname($vendorDir); return array( 'tk\\ReCaptcha\\' => array($vendorDir . '/google/recaptcha/src/ReCaptcha'), 'tk\\Psr\\Http\\Message\\' => array($vendorDir . '/psr/http-message/src'), 'tk\\Psr\\Http\\Client\\' => array($vendorDir . '/psr/http-client/src'), 'tk\\GuzzleHttp\\Psr7\\' => array($vendorDir . '/guzzlehttp/psr7/src'), 'tk\\GuzzleHttp\\Promise\\' => array($vendorDir . '/guzzlehttp/promises/src'), 'tk\\GuzzleHttp\\' => array($vendorDir . '/guzzlehttp/guzzle/src'), ); 