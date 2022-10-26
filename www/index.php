<?php

declare(strict_types=1);

if(@!include __DIR__ . '/../vendor/autoload.php') {
    die('Install dependencies using `composer update`');
}

$configurator = Marks\Bootstrap::boot();
die('Index');
