<?php

declare(strict_types=1);

namespace Marks\Mark;

use Nette\Database\Explorer;
use Nette\Database\Table\Selection;

class MarkFacade
{
    private readonly Selection $marks;

    public function __construct(
        Explorer $database
    ) {
        $this->marks = $database->table('mark');
    }

    public function get(int $id): ?Mark
    {
        return Mark::fromActiveRow($this->marks->get($id));
    }
}
