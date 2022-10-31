<?php

declare(strict_types=1);

namespace Marks\Presenters;

use JetBrains\PhpStorm\NoReturn;
use Nette\Application\Helpers;
use Nette\Application\UI\Presenter;

/**
 * @Property BaseTemplate $template
 */
class BasePresenter extends Presenter
{
    public function beforeRender(): void
    {
        $this->setLayout(__DIR__ . '/@Templates/@Layout/layout.latte');
        $this->getTemplate()->setFile(__DIR__ . '/@Templates/' . Helpers::splitName($this->getName())[1] . '/' . $this->getAction() . '.latte');

        $this->template->username = "admin";
    }

    /** TODO: */
    #[NoReturn] public function handleLogout(): void
    {
        die("Logging out.");
    }
}
