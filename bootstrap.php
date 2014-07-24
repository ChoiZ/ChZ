<?php
define('BASE_DIR', realpath(dirname(__FILE__)));
define('CORE_DIR', BASE_DIR.'/core');
define('CONTROLLER_DIR', BASE_DIR.'/controllers');
define('VIEWS_DIR', BASE_DIR.'/views');

function loader($class) {

    $class = str_replace('chzphp\\', '', $class);
    $class = str_replace('\\', '/', $class);
    $file = BASE_DIR.'/'.strtolower($class).'.php';
    try {
        if (file_exists($file)) {
            require_once $file;
        }
    } catch (Exception $e) {
        echo 'Exception : ',  $e->getMessage(), "\n";
    }
}

spl_autoload_register('loader');

$app = new chzphp\core\App();