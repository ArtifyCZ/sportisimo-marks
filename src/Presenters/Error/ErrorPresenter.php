<?php

declare(strict_types=1);

namespace Marks\Presenters\Error;

use Nette;
use Nette\Application\Request;
use Nette\Application\Response;
use Tracy\ILogger;

final class ErrorPresenter implements Nette\Application\IPresenter
{
    public function __construct(
        private readonly ILogger $logger
    ) {}

    function run(Request $request): Response
    {
        $exception = $request->getParameter('exception');

        if($exception instanceof Nette\Application\BadRequestException) {
            return new Nette\Application\Responses\ForwardResponse($request->setPresenterName("Error4xx"));
        }

        $this->logger->log($exception, ILogger::EXCEPTION);
        return new Nette\Application\Responses\TextResponse("Sorry, but the server has encountered an error. Try again, please, later.");
    }
}
