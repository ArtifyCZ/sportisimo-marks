<?php

declare(strict_types=1);

if(@!include (dirname(__DIR__ . '../') . '/vendor/autoload.php')) {
    die('Install dependencies using `composer update`');
}

Marks\Bootstrap::boot()
    ->createContainer()
    ->getByType(Nette\Application\Application::class)
    ->run();
