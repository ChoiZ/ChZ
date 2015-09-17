<?php

/*
 * This file is a part of the ChZ package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChZ\Engine;

class Cache
{
    private $cache = NULL;
    private $connected = false;
    private $servers = array(
        array("localhost", 11211)
    );
    private $expire;
    private $prefix;

    public function __construct($name)
    {
        $name = strtoupper($name);
        $this->expire = 3600;
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

        $this->cache = new \memcached;

        if ($this->cache->addServers($this->servers)) {
            $this->connected = true;
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

        return $this->cache->set($this->prefix.$key, $val, $expire);
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

        return $this->cache->set($this->prefix.$key, NULL, 1);
    }
}
