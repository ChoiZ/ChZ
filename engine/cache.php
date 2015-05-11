<?php

/*
 * This file is a part of the ChZ-PHP package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Engine;

class Cache
{
    private $cache = NULL;
    private $connected = false;
    private $servers = array(
        "localhost"
    );
    private $expire;
    private $flag;
    private $prefix;

    public function __construct($name)
    {
        $name = strtoupper($name);
        $this->expire = 3600;
        $this->flag = false;
        $this->prefix = $name.'_';

        if ($name === 'GEOIP') {
            $this->expire = 31*86400;
        }

        if ($name === 'USER') {
            $this->expire = 86400;
        }

        self::connect();
    }

    public function connect()
    {
        if (defined('DISABLE_CACHE')) {
            return false;
        }

        foreach ($this->servers as $server) {
            $ex = explode(':', $server);

            if (isset($ex[0]) && $ex[0]) {
                $host = $ex[0];
            }

            if (isset($ex[1]) && $ex[1]) {
                $port = $ex[1];
            } else {
                $port = '11211';
            }

            if ($this->cache->addServer($host, $port)) {
                $this->connected = true;
            }
        }

        return $this->connected;
    }

    function set($key, $val, $expire = NULL)
    {
        if (defined('DISABLE_CACHE') || !$this->connected) {
            return false;
        }

        if ($expire != NULL) {
            if ($expire < 1) {
                $expire = 1;
            }

            if (!is_numeric($expire)) {
                $expire = strtotime($expire);
            }
        } else {
            $expire = $this->expire;
        }

        return $this->cache->set($this->prefix.$key, $val, $this->flag, $expire);
    }

    public function get($key)
    {
        if (defined('DISABLE_CACHE') || !$this->connected) {
            return false;
        }

        return $this->cache->get($this->prefix.$key);
    }

    public function delete($key)
    {
        if (defined('DISABLE_CACHE') || !$this->connected) {
            return false;
        }

        return $this->cache->set($this->prefix.$key, NULL, $this->flag, 1);
    }
}
