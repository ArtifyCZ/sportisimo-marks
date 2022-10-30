<?php

namespace Marks\Presenters\Marks;

use Marks\Mark\MarksPaged;
use Marks\Presenters\BaseTemplate;

class MarksTemplate extends BaseTemplate
{
    public MarksPaged $marks;

    /**
     * @var int[]
     */
    public array $pageNums;

    /**
     * If in the page numbers should be dedicated link to the first page
     * @var bool
     */
    public bool $showFirstPage;

    /**
     * If in the page numbers should be dedicated link to the last page
     * @var bool
     */
    public bool $showLastPage;

    /**
     * If the list should be reversed
     * @var bool
     */
    public bool $reversed;
}
