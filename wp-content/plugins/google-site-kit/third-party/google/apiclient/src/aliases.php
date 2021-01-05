<?php

namespace Google\Site_Kit_Dependencies;

if (\class_exists('Google\\Site_Kit_Dependencies\\Google_Client')) {
    // Prevent error with preloading in PHP 7.4
    // @see https://github.com/googleapis/google-api-php-client/issues/1976
    return;
}
$classMap = ['Google\\Site_Kit_Dependencies\\Google\\Client' => 'Google\\Site_Kit_Dependencies\Google_Client', 'Google\\Site_Kit_Dependencies\\Google\\Service' => 'Google\\Site_Kit_Dependencies\Google_Service', 'Google\\Site_Kit_Dependencies\\Google\\AccessToken\\Revoke' => 'Google\\Site_Kit_Dependencies\Google_AccessToken_Revoke', 'Google\\Site_Kit_Dependencies\\Google\\AccessToken\\Verify' => 'Google\\Site_Kit_Dependencies\Google_AccessToken_Verify', 'Google\\Site_Kit_Dependencies\\Google\\Model' => 'Google\\Site_Kit_Dependencies\Google_Model', 'Google\\Site_Kit_Dependencies\\Google\\Utils\\UriTemplate' => 'Google\\Site_Kit_Dependencies\Google_Utils_UriTemplate', 'Google\\Site_Kit_Dependencies\\Google\\AuthHandler\\Guzzle6AuthHandler' => 'Google\\Site_Kit_Dependencies\Google_AuthHandler_Guzzle6AuthHandler', 'Google\\Site_Kit_Dependencies\\Google\\AuthHandler\\Guzzle7AuthHandler' => 'Google\\Site_Kit_Dependencies\Google_AuthHandler_Guzzle7AuthHandler', 'Google\\Site_Kit_Dependencies\\Google\\AuthHandler\\Guzzle5AuthHandler' => 'Google\\Site_Kit_Dependencies\Google_AuthHandler_Guzzle5AuthHandler', 'Google\\Site_Kit_Dependencies\\Google\\AuthHandler\\AuthHandlerFactory' => 'Google\\Site_Kit_Dependencies\Google_AuthHandler_AuthHandlerFactory', 'Google\\Site_Kit_Dependencies\\Google\\Http\\Batch' => 'Google\\Site_Kit_Dependencies\Google_Http_Batch', 'Google\\Site_Kit_Dependencies\\Google\\Http\\MediaFileUpload' => 'Google\\Site_Kit_Dependencies\Google_Http_MediaFileUpload', 'Google\\Site_Kit_Dependencies\\Google\\Http\\REST' => 'Google\\Site_Kit_Dependencies\Google_Http_REST', 'Google\\Site_Kit_Dependencies\\Google\\Task\\Retryable' => 'Google\\Site_Kit_Dependencies\Google_Task_Retryable', 'Google\\Site_Kit_Dependencies\\Google\\Task\\Exception' => 'Google\\Site_Kit_Dependencies\Google_Task_Exception', 'Google\\Site_Kit_Dependencies\\Google\\Task\\Runner' => 'Google\\Site_Kit_Dependencies\Google_Task_Runner', 'Google\\Site_Kit_Dependencies\\Google\\Collection' => 'Google\\Site_Kit_Dependencies\Google_Collection', 'Google\\Site_Kit_Dependencies\\Google\\Service\\Exception' => 'Google\\Site_Kit_Dependencies\Google_Service_Exception', 'Google\\Site_Kit_Dependencies\\Google\\Service\\Resource' => 'Google\\Site_Kit_Dependencies\Google_Service_Resource', 'Google\\Site_Kit_Dependencies\\Google\\Exception' => 'Google\\Site_Kit_Dependencies\Google_Exception'];
foreach ($classMap as $class => $alias) {
    \class_alias($class, $alias);
}
/**
 * This class needs to be defined explicitly as scripts must be recognized by
 * the autoloader.
 */
class Google_Task_Composer extends \Google\Site_Kit_Dependencies\Google\Task\Composer
{
}
