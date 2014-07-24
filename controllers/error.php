<?php

namespace controllers;

use core\controller as Controller;

class error extends Controller {

    public function index() {
        parent::loadView('header.html');
        parent::loadView('error.html');
        parent::loadView('footer.html');
    }

}