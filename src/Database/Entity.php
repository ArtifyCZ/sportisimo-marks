<?php

namespace Marks\Database;

use Nette\Database\Table\ActiveRow;
use Nette\SmartObject;

abstract class Entity
{
    use SmartObject;

    protected ActiveRow $row;

    public function __get(string $name): mixed
    {
        return $this->row->__get($name);
    }

    public function __set(string $name, mixed $value): void
    {
        $this->row->__set($name, $value);
    }

    public function __isset(string $name): bool
    {
        return $this->row->__isset($name);
    }

    public function __unset(string $name)
    {
        $this->row->__unset($name);
    }

    public static abstract function fromActiveRow(ActiveRow $activeRow): self;
}
