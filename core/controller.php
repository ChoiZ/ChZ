<?php

/*
 * This file is a part of the ChZ-PHP package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace core;

class Controller {

    function __construct() {

    }

    public function loadView($file) {
        require_once VIEWS_DIR.'/'.$file;
    }

}