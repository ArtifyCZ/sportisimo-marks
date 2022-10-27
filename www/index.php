<?php

declare(strict_types=1);

if(@!include (dirname(__DIR__ . '../') . '/vendor/autoload.php')) {
    die('Install dependencies using `composer update`');
}

$debug = (getenv('DEBUG') === 'TRUE');

// This allows to use static files with PHP built-in web server
if($debug) {
    if (preg_match('/\.(?:css|js|png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
        return false; // serve the requested resource as-is.
    }
}

Marks\Bootstrap::boot($debug)
    ->createContainer()
    ->getByType(Nette\Application\Application::class)
    ->run();
