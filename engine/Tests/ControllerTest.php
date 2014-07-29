<?php

/*
 * This file is a part of the ChZ-PHP package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ControllerTest extends PHPUnit_Framework_TestCase {

    public function test_loadView() {

        $view = new Engine\Controller();

        $this->assertTrue($view->loadView('home'));

    }

}
