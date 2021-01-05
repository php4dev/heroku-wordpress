<?php

/**
 * Copyright 2015 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Google\Site_Kit_Dependencies\Google\AuthHandler;

use Google\Site_Kit_Dependencies\GuzzleHttp\Client;
use Google\Site_Kit_Dependencies\GuzzleHttp\ClientInterface;
use Exception;
class AuthHandlerFactory
{
    /**
     * Builds out a default http handler for the installed version of guzzle.
     *
     * @return Guzzle5AuthHandler|Guzzle6AuthHandler|Guzzle7AuthHandler
     * @throws Exception
     */
    public static function build($cache = null, array $cacheConfig = [])
    {
        $guzzleVersion = null;
        if (\defined('\\Google\\Site_Kit_Dependencies\\GuzzleHttp\\ClientInterface::MAJOR_VERSION')) {
            $guzzleVersion = \Google\Site_Kit_Dependencies\GuzzleHttp\ClientInterface::MAJOR_VERSION;
        } elseif (\defined('\\Google\\Site_Kit_Dependencies\\GuzzleHttp\\ClientInterface::VERSION')) {
            $guzzleVersion = (int) \substr(\Google\Site_Kit_Dependencies\GuzzleHttp\ClientInterface::VERSION, 0, 1);
        }
        switch ($guzzleVersion) {
            case 5:
                return new \Google\Site_Kit_Dependencies\Google\AuthHandler\Guzzle5AuthHandler($cache, $cacheConfig);
            case 6:
                return new \Google\Site_Kit_Dependencies\Google\AuthHandler\Guzzle6AuthHandler($cache, $cacheConfig);
            case 7:
                return new \Google\Site_Kit_Dependencies\Google\AuthHandler\Guzzle7AuthHandler($cache, $cacheConfig);
            default:
                throw new \Exception('Version not supported');
        }
    }
}
