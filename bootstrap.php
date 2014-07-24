<?php
define('BASE_DIR', realpath(dirname(__FILE__)));
define('CORE_DIR', BASE_DIR.'/core');
define('VIEWS_DIR', BASE_DIR.'/views');

function loader($class) {

    $file = CORE_DIR.'/'.strtolower($class).'.php';
    if (file_exists($file)) {
        require_once $file;
    }

}

spl_autoload_register('loader');

$app = new App();