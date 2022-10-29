<?php

namespace Marks\Presenters\Marks;

use Marks\Mark\Mark;
use Marks\Presenters\BaseTemplate;

class MarksTemplate extends BaseTemplate
{
    /**
     * @var Mark[]
     */
    public array $marks;

    public ?int $editMarkId;
}
