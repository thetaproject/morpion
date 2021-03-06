<?php

namespace Epic;

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', '1');
ini_set('log_errors', '1');
error_reporting(E_ALL);

$environment = 'development';

$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function ($e) {
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}

$whoops->register();

$requestUri = $_SERVER['REQUEST_URI'];

if (isset(pathinfo($requestUri)['extension'])) {
    $dirname = dirname($requestUri);
}
else {
    $dirname = $requestUri;
}

define('BASE_FOLDER', $dirname);
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . BASE_FOLDER . '/');
