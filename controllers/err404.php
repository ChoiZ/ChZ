<?php

namespace chzphp\controllers;

use chzphp\core\controller as Controller;

class err404 extends Controller {

    public function index() {
        parent::loadView('header.html');
        parent::loadView('err404.html');
        parent::loadView('footer.html');
    }

}