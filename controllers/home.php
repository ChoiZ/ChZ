<?php

namespace chzphp\controllers;

use chzphp\core\controller as Controller;

class Home extends Controller {

    public function index() {
        parent::loadView('header.html');
        parent::loadView('home.html');
        parent::loadView('footer.html');
    }

}