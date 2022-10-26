<?php

declare(strict_types=1);

namespace Marks\Presenters;

use Nette;
use Nette\Application\Request;
use Nette\Application\Response;

final class ErrorPresenter implements Nette\Application\IPresenter
{
    function run(Request $request): Response
    {
        $exception = $request->getParameter('exception');

        if($exception instanceof Nette\Application\BadRequestException) {
            return new Nette\Application\Responses\ForwardResponse($request->setPresenterName("Error4xx"));
        }

        die("Error");
    }
}
