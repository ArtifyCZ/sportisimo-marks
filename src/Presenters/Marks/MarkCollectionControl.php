<?php

namespace Marks\Presenters\Marks;

use Marks\Mark\MarkFacade;
use Nette\Application\AbortException;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Control;

/**
 * @property MarkCollectionControlTemplate $template
 */
class MarkCollectionControl extends Control
{
    #[Persistent] public int $page = 1;

    #[Persistent] public bool $reverse = false;

    public function __construct(
        private readonly MarkFacade $marks
    ) {
    }

    /**
     * @throws AbortException
     */
    public function render(): void
    {
        if($this->page < 1) {
            $this->redirect('page!', [1]);
        }

        $marks = $this->marks->pagedSorted($this->page, 4, $this->reverse);
        if($marks->pages < $this->page) {
            $this->redirect('page!', [1]);
        }

        $this->template->marks = $marks;

        $this->template->reversed = $this->reverse;

        if($marks->pages <= 5) {
            $this->template->showFirstPage = false;
            $this->template->showLastPage = false;
            $this->template->pageNums = range(1, $marks->pages);
        } else {
            $this->template->showFirstPage = ($this->page > 3);
            $this->template->showLastPage = ($this->page < ($marks->pages - 2));

            if($this->page < 3) {
                $this->template->pageNums = range(1, 5);
            } elseif(($marks->pages - 3) < $this->page) {
                $this->template->pageNums = range($marks->pages - 5, $marks->pages);
            } else {
                $this->template->pageNums = range($this->page - 2, $this->page + 2);
            }
        }

        $this->template->render(dirname(__DIR__) . '/@Templates/Marks/Control/MarkCollection.latte');
    }

    protected function createComponentMarkRow(): MarkRowControl
    {
        return new MarkRowControl($this->marks);
    }

    public function handleRefresh(): void
    {
        $this->redrawControl('marksList');
    }

    public function handlePage(int $page): void
    {
        if($page < 1) {
            $page = 1;
        }

        $this->page = $page;
        $this->redrawControl('marksList');
    }

    public function handleSort(bool $reverse): void
    {
        $this->reverse = $reverse;
        $this->page = 1;
        $this->redrawControl('marksList');
    }
}
