<?php

/*
 * This file is a part of the ChZ-PHP package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class RouteTest extends PHPUnit_Framework_TestCase {

    public function test_setRouteNamespace() {
        $route = Engine\Route::getInstance();
        $route->setRoute('home/index/2/3/5');
        $this->assertTrue($route->getNamespace() === 'controllers\\');
    }

    public function test_setRouteController() {
        $route = Engine\Route::getInstance();
        $route->setRoute('home/index/2/3/5');
        $this->assertTrue($route->getController() === 'home');
    }

    public function test_setRouteAction() {
        $route = Engine\Route::getInstance();
        $route->setRoute('home/index/2/3/5');
        $this->assertTrue($route->getAction() === 'index');
    }

    public function test_setRouteParams() {
        $route = Engine\Route::getInstance();
        $route->setRoute('home/index/2/3/5');
        $this->assertTrue($route->getParams() === array('2', '3', '5'));
    }

}
