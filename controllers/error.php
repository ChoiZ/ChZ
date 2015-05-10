<?php

/*
 * This file is a part of the ChZ-PHP package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Controllers;

use Engine\Controller as Controller;

class Error extends Controller
{
    public function index()
    {
        parent::loadView('header');
        parent::loadView('error');
        parent::loadView('footer');
    }
}