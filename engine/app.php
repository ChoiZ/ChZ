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

use Engine\Route as Route;

class App
{
    public function __construct()
    {
        $route = Route::getInstance();
        $url = !empty($_GET['url']) ? $_GET['url'] : '/';
        $route->setRoute($url);

        $controller = $route->getNamespace().$route->getController();
        $action = $route->getAction();
        $params = $route->getParams();

        $this->object = new $controller;
        $this->object->$action($params);
    }
}
