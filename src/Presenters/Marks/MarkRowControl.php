<?php

namespace Marks\Presenters\Marks;

use Marks\Mark\Mark;
use Marks\Mark\MarkFacade;
use Nette\Application\AbortException;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

/**
 * @property MarkRowControlTemplate $template
 */
class MarkRowControl extends Control
{
    private ?int $edit = null;

    public function __construct(
        private readonly MarkFacade $marks
    ) {
    }

    public function render(Mark $mark): void
    {
        if(!isset($this->edit)) {
            $this->edit = null;
        }

        $this->template->edit = $this->edit;

        $this->template->mark = $mark;
        $this->template->render(dirname(__DIR__) . '/@Templates/Marks/Control/MarkRow.latte');
    }

    protected function createComponentEditForm(): Form
    {
        $form = new Form;
        $form->addHidden('id')->value = $this->edit;
        $form->addText('name', 'Name', maxLength: 256);
        $form->addSubmit('send', 'Uložit')
            ->setHtmlAttribute('class', 'btn waves-effect green');
        $form->onSuccess[] = [$this, 'editFormSucceed'];
        return $form;
    }

    /**
     * @throws AbortException
     */
    public function editFormSucceed(Form $form, $data): void
    {
        $id = $data->id;
        $name = $data->name;

        if($id < 1) {
            $this->redirect('edit!', [null]);
        }

        $mark = $this->marks->get($id);
        if($mark == null) {
            $this->redirect('edit!', [null]);
        }
        $mark->name = $name;
        $mark->save();
        $this->redirect('edit!', [null]);
    }

    public function handleEdit(?int $id): void
    {
        $this->edit = $id;
    }

    /**
     * @throws AbortException
     */
    public function handleDelete(?int $id): void
    {
        if($id == null) {
            return;
        }

        if($id < 1) {
            $this->redirect('delete!', [null]);
        }

        $mark = $this->marks->get($id);
        if($mark == null) {
            die();
        }

        $mark->delete();
        $mark->save();

        $this->redirect('edit!', [null]);
    }
}
