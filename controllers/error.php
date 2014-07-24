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

use core\controller as Controller;

class error extends Controller {

    public function index() {
        parent::loadView('header.html');
        parent::loadView('error.html');
        parent::loadView('footer.html');
    }

}