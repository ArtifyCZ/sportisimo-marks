<?php

namespace Marks\Presenters\Marks;

use Marks\Mark\Mark;
use Marks\Mark\MarkFacade;
use Marks\Presenters\BasePresenter;

/**
 * @Property MarksTemplate $template
 */
class MarksPresenter extends BasePresenter
{
    private ?Mark $editMark;

    public function __construct(
        private readonly MarkFacade $marks
    ) {
    }

    public function renderDefault(): void {
        $all = $this->marks->getAllSorted();
        $this->template->marks = $all;
        $this->template->editMarkId = null;
    }

    protected function createComponentMarkRow(): MarkRowControl {
        return new MarkRowControl($this->marks);
    }

    public function handleRefresh(): void
    {
        $this->redrawControl('marks');
    }
}
