<?php

namespace Marks\Presenters;

use Nette\Bridges\ApplicationLatte\Nodes\TemplatePrintNode;

class BaseTemplate extends TemplatePrintNode
{
    public string $username;
}
