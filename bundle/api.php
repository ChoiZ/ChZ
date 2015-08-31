<?php

/*
 * This file is a part of the ChZ package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChZ\Bundle;

class Api
{
    private $handle;
    private $headers;
    protected static $api_url;
    protected static $api_key;
    protected static $secret;

    public function __construct($path)
    {
        $this->headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );

        $this->handle = curl_init();
        $url = $this::$api_url.$path;
        curl_setopt($this->handle, CURLOPT_URL, $url);
        curl_setopt($this->handle, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->handle, CURLOPT_SSL_VERIFYPEER, false);
    }

    public function getApiurl()
    {
        return $this::$api_url;
    }

    public function getApikey()
    {
        return $this::$api_key;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function delete($data)
    {
        curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
        return $this->send($data);
    }

    public function get($data)
    {
        return $this->send($data);
    }

    public function post($data)
    {
        curl_setopt($this->handle, CURLOPT_POST, true);
        curl_setopt($this->handle, CURLOPT_POSTFIELDS, $data);
        return $this->send($data);
    }

    public function put($data)
    {
        curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($this->handle, CURLOPT_POSTFIELDS, $data);
        return $this->send($data);
    }

    private function send($data)
    {
        $http_code = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
        $result = curl_exec($this->handle);
        return array(
            'http_code' => $http_code,
            'result' => $result
        );
    }
}