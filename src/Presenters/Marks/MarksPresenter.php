<?php

namespace Marks\Presenters\Marks;

use Marks\Mark\Mark;
use Marks\Mark\MarkFacade;
use Marks\Presenters\BasePresenter;
use Nette\Application\AbortException;
use Nette\Application\Attributes\Persistent;

/**
 * @Property MarksTemplate $template
 */
class MarksPresenter extends BasePresenter
{
    private ?Mark $editMark;

    #[Persistent] public int $page = 1;

    public function __construct(
        private readonly MarkFacade $marks
    ) {
    }

    /**
     * @throws AbortException
     */
    public function renderDefault(): void
    {
        $all = $this->marks->pagedSorted($this->page);
        if($all->pages < $this->page) {
            $this->redirect('page!', [1]);
        }
        $this->template->marks = $all;

        if($all->pages <= 5) {
            $this->template->showFirstPage = false;
            $this->template->showLastPage = false;
            $this->template->pageNums = range(1, $all->pages);
        } else {
            $this->template->showFirstPage = ($this->page > 3);
            $this->template->showLastPage = ($this->page < ($all->pages - 2));

            if($this->page < 3) {
                $this->template->pageNums = range(1, 5);
            } elseif(($all->pages - 3) < $this->page) {
                $this->template->pageNums = range($all->pages - 5, $all->pages);
            } else {
                $this->template->pageNums = range($this->page - 2, $this->page + 2);
            }
        }
    }

    protected function createComponentMarkRow(): MarkRowControl
    {
        return new MarkRowControl($this->marks);
    }

    public function handleRefresh(): void
    {
        $this->redrawControl('marks');
    }

    public function handlePage(int $page): void
    {
        if($page < 1) {
            die();
        }

        $this->page = $page;
        $this->redrawControl('marks');
    }
}
