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

use Controllers;

class App {

    public function __construct() {

        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->controller = 'Controllers\\'.(!empty($url[0]) ? $url[0] : null);
            $this->action = (isset($url[1]) ? $url[1] : null);
        } else {
            $this->controller = 'Controllers\\home';
            $this->action = 'index';
        }

        $this->object = new $this->controller();
        $this->object->$this->action();

    }

}
