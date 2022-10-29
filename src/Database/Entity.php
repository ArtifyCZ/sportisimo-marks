<?php

namespace Marks\Database;

use Nette\Database\Table\ActiveRow;
use Nette\SmartObject;

abstract class Entity
{
    use SmartObject;

    protected ActiveRow $row;

    /**
     * Contains pending changes
     * @var array
     */
    protected array $pending;

    public function __get(string $name): mixed
    {
        return $this->row->__get($name);
    }

    public function __set(string $name, mixed $value): void
    {
        $this->pending[$name] = $value;
    }

    public function __isset(string $name): bool
    {
        return $this->row->__isset($name);
    }

    /**
     * Saves all pending changes
     * @return void
     */
    public function save(): void
    {
        $this->row->update($this->pending);
    }

    public static abstract function fromActiveRow(ActiveRow $activeRow): self;
}
