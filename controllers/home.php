<?php

/*
 * This file is a part of the ChZ-PHP package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace controllers;

use engine\controller as Controller;

class Home extends Controller {

    public function index() {
        parent::loadView('header.html');
        parent::loadView('home.html');
        parent::loadView('footer.html');
    }

}