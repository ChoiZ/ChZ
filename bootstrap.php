<?php
define('BASE_DIR', realpath(dirname(__FILE__)));
define('LIB_DIR', BASE_DIR.'/libs');
define('VIEWS_DIR', BASE_DIR.'/views');

function loader($class) {

    $file = LIB_DIR.'/'.strtolower($class).'.php';
    if (file_exists($file)) {
        require_once $file;
    }

}

spl_autoload_register('loader');

$app = new App();