<?php

//declare(strict_types=1);

namespace Marks\Router;

use Nette\Application\Routers\RouteList;

final class RouterFactory
{
    public static function createRouter(): RouteList
    {
        $router = new RouteList();
        $router->addRoute('<presenter>/<action>', 'Home:default');
        return $router;
    }
}
