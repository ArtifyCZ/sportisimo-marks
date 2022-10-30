<?php

namespace Marks\Mark;

class MarksPaged
{
    /**
     * Page number
     * @var positive-int
     */
    public int $page;

    /**
     * Count of pages
     * @var positive-int
     */
    public int $pages;

    /**
     * Marks on current page
     * @var Mark[]
     */
    public array $marks;

    /**
     * @param positive-int $page
     * @param positive-int $pages
     * @param Mark[] $marks
     */
    public function __construct(int $page, int $pages, array $marks)
    {
        $this->page = $page;
        $this->pages = $pages;
        $this->marks = $marks;
    }
}
