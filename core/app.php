<?php

namespace core;

use controllers;

class App {

    public function __construct() {

        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->controller = (isset($url[0]) ? $url[0] : null);
            $this->action = (isset($url[1]) ? $url[1] : null);
        } else {
            $this->controller = 'controllers\\home';
        }

        $this->object = new $this->controller();
        $this->object->index();

    }

}