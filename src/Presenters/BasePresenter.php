<?php

declare(strict_types=1);

namespace Marks\Presenters;

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

        // TODO:
        $this->template->username = "admin";

        if($this->isAjax()) {
            $this->redrawControl('title');
            $this->redrawControl('pageContent');
        }
    }

    /** TODO: */
    public function handleLogout(): void
    {
        die("Logging out.");
    }
}
