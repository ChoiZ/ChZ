<?php

/*
 * This file is a part of the ChZ-PHP package.
 *
 * (c) François LASSERRE <choiz@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

define('BASE_DIR', realpath(dirname(__FILE__)));
define('CORE_DIR', BASE_DIR.'/core');
define('CONTROLLER_DIR', BASE_DIR.'/controllers');
define('VIEWS_DIR', BASE_DIR.'/views');

function loader($class) {

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

$app = new core\App();