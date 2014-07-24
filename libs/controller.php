<?php

class Controller {

    function __construct() {

    }

    public function loadView($file) {
        require_once VIEWS_DIR.'/'.$file;
    }

}