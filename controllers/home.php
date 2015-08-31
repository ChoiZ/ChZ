<?php

/*
 * This file is a part of the ChZ package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChZ\Controllers;

use ChZ\Engine\Controller as Controller;

class Home extends Controller
{
    public function index()
    {
        parent::loadView('header');
        parent::loadView('home');
        parent::loadView('footer');
    }
}