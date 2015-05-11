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

    public function __construct()
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
        $namespace = $this->namespace;
        $path = explode('/', $route);

        $route_json = json_decode(file_get_contents(ROUTE_FILE), true);

        if (isset($route_json[$route])) {
            $controller = $route_json[$route]['controller'];
            $this->controller = $controller;

            if (isset($route_json[$route]['action'])) {
                $action = $route_json[$route]['action'];
                $this->action = $action;
            }
        } else if (!empty($path[0])) {
            $controller = $path[0];

            if (class_exists($namespace.$controller)) {
                $this->controller = $controller;
            } else {
                $this->controller = 'error';
            }
        }

        array_shift($path);

        if (
            $this->action == 'index' &&
            !empty($path[0]) &&
            in_array($path[0], get_class_methods($namespace.$controller))
        ) {
            $this->action = $path[0];
            array_shift($path);
        }

        if (!empty($path)) {
            $this->params = $path;
            $this->params['id'] = $path[0]; // must be update
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