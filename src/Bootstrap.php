<?php

declare(strict_types=1);

namespace Marks;

use Nette\Bootstrap\Configurator;

class Bootstrap
{
    public static function boot(bool $debug): Configurator
    {
        $configurator = new Configurator();

        $appDir = dirname(__DIR__);

        $configurator->addConfig($appDir . '/config/common.neon');
        $configurator->addConfig($appDir . '/config/services.neon');

        if($debug) {
            $configurator->addConfig($appDir . '/config/credentials.dev.neon');
            $configurator->setDebugMode(true);
            $configurator->enableTracy($appDir . '/log');
            $configurator->setTempDirectory($appDir . '/tmp');
        } else {
            $configurator->addConfig($appDir . '/config/credentials.neon');
            $configurator->setDebugMode(false);
            $configurator->enableTracy('/var/log/www-marks');
            $configurator->setTempDirectory('/tmp/www-marks/nette-temp');
        }

        return $configurator;
    }
}
