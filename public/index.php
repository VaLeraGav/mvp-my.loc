<?php

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/config/init.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use Core\App;

$app = new App();
$app->run();

