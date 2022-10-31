<?php

namespace Marks\Presenters\Marks;

use JetBrains\PhpStorm\NoReturn;
use Marks\Mark\MarkFacade;
use Marks\Presenters\BasePresenter;
use Nette\Application\AbortException;
use Nette\Application\UI\Form;

/**
 * @Property MarksTemplate $template
 */
class MarksPresenter extends BasePresenter
{
    public function __construct(
        private readonly MarkFacade $marks
    ) {
        parent::__construct();
    }

    protected function afterRender()
    {
        $this->redrawControl('marksList');
        parent::afterRender();
    }

    protected function createComponentMarkCollection(): MarkCollectionControl
    {
        return new MarkCollectionControl($this->marks);
    }

    protected function createComponentAddMarkForm(): Form
    {
        $form = new Form;
        $form->addText('name', 'Name', maxLength: 256)
            ->setRequired('Jméno značky nemůže být prázdné');
        $form->addSubmit('send', 'Uložit');
        $form->onSuccess[] = [$this, 'addMarkFormSucceed'];
        return $form;
    }

    /**
     * @throws AbortException
     */
    #[NoReturn] public function addMarkFormSucceed(Form $form, $data): void
    {
        $name = $data->name;

        if($this->marks->getByName($name) != null) {
            // Another one with the same name exists
            $this->flashMessage('Značka s tímto názvem již existuje.');
            $this->redrawControl('pageContent');
            $this->redirect('Marks:default');
        }

        $this->marks->insert($name);
        $this->redirect('Marks:default');
    }
}
