<?php

/*
 * This file is a part of the ChZ-PHP package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChZ\Controllers;

use ChZ\Engine\Controller as Controller;

class Error extends Controller
{
    public function index()
    {
        header("HTTP/1.0 404 Not Found");
        parent::loadView('header');
        parent::loadView('error');
        parent::loadView('footer');
    }
}