<?php

class App {

    public function __construct() {

        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->controller = (isset($url[0]) ? $url[0] : null);
            $this->action = (isset($url[1]) ? $url[1] : null);
        } else {
            $this->controller = 'home';
        }

        if (file_exists(CONTROLLER_DIR.'/'.$this->controller.'.php')) {
            require_once CONTROLLER_DIR.'/'.$this->controller . '.php';
            $this->object = new $this->controller();
            $this->object->index();
        } else {
            require_once CONTROLLER_DIR.'/err404.php';
            $this->header = 404;
            $this->object = new Err404();
            $this->object->index();
        }

    }

}