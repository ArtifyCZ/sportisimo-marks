<?php

declare(strict_types=1);

namespace Marks\Presenters;

use Nette\Application\Helpers;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{
    public function beforeRender()
    {
        $this->setLayout(__DIR__ . '/@Templates/@Layout/layout.latte');
        $this->getTemplate()->setFile(__DIR__ . '/@Templates/' . Helpers::splitName($this->getName())[1] . '/' . $this->getAction() . '.latte');
    }
}
