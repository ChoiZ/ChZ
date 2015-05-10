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

class Route
{
    private static $instance;

    public $lang;
    public $route;
    public $namespace;
    public $controller;
    public $action;
    public $params;

    function __construct()
    {
        $this->route = null;
        $this->namespace = 'controllers\\';
        $this->controller = 'home';
        $this->action = 'index';
        $this->params = array();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Route();
        }

        return self::$instance;
    }

    public function setRoute($route)
    {
        if (substr($route, -1) === '/' && strlen($route) > 1) {
            $route = rtrim($route, '/');
        }

        if (substr($route, 0, 1) === '/') {
            $route = ltrim($route, '/');
        }

        $this->route = $route;
        $path = explode('/', $route);

        if (!empty($path[0])) {

            $namespace = $this->namespace;
            $controller = $path[0];
            array_shift($path);

            if (class_exists($namespace.$controller)) {
                $this->controller = $controller;
            } else {
                $this->controller = 'error';
            }

        }

        if (!empty($path[0]) && in_array($path[0], get_class_methods($this->namespace.$this->controller))) {
            $this->action = $path[0];
            array_shift($path);
        }

        if (!empty($path)) {
            $this->params = $path;
        }
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
    }
}