<?php

declare(strict_types=1);

namespace Marks\Mark;

use Marks\Database\Entity;
use Nette\Database\Table\ActiveRow;

/**
 * @property int $id
 * @property string $name
 */
class Mark extends Entity
{
    /**
     * This method checks if the object is valid to apply to database.
     * @return bool
     */
    public function is_valid(): bool {
        return ((0 <= $this->id) && (strlen($this->name) <= 256));
    }

    public static function fromActiveRow(ActiveRow $activeRow): Mark
    {
        $entity = new Mark;
        $entity->row = $activeRow;
        return $entity;
    }
}
