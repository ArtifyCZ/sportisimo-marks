<?php

namespace Marks\Presenters\Marks;

use Marks\Mark\Mark;
use Nette\Bridges\ApplicationLatte\Template;

class MarkRowControlTemplate extends Template
{
    public Mark $mark;

    public ?int $edit;
}
