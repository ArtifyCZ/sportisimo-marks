<?php

namespace Marks\Presenters\Error4xx;

use Marks\Presenters\BasePresenter;
use Nette\Application\BadRequestException;

class Error4xxPresenter extends BasePresenter
{
    public function renderDefault(BadRequestException $exception): void
    {
        $file = __DIR__ . "/templates/Error4xx/{$exception->getCode()}.latte";
        $this->getTemplate()->setFile(is_file($file) ? $file : dirname(__DIR__) . '/@Templates/Error4xx/404.latte');
    }
}
