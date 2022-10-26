<?php

namespace Marks\Presenters;

use Nette\Application\BadRequestException;

class Error4xxPresenter extends \Nette\Application\UI\Presenter
{
    public function renderDefault(BadRequestException $exception): void
    {
        $file = __DIR__ . "/templates/Error4xx/{$exception->getCode()}.latte";
        $this->template->setFile(is_file($file) ? $file : __DIR__ . '/templates/Error4xx/4xx.latte');
    }
}
