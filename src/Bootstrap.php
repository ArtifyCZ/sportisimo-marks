<?php

declare(strict_types=1);

namespace Marks;

use Nette\Bootstrap\Configurator;

class Bootstrap
{
    public static function boot(): Configurator
    {
        $configurator = new Configurator();

        $appDir = dirname(__DIR__);
        if(getenv('DEBUG') == 'TRUE') {
            $configurator->setDebugMode(true);
            $configurator->enableTracy($appDir . '/log');
            $configurator->setTempDirectory($appDir . '/temp');
        } else {
            $configurator->setDebugMode(false);
            $configurator->enableTracy('/var/log/www-marks');
            $configurator->setTempDirectory('/tmp/www-marks/nette-temp');
        }

        $configurator->addConfig($appDir . '/config/common.neon');
        $configurator->addConfig($appDir . '/config/services.neon');

        return $configurator;
    }
}
