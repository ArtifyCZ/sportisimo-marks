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
    protected array $pending = array();

    /**
     * If the row is pending to be deleted
     * @var bool
     */
    protected bool $delete_pending = false;

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

    public function delete(): void
    {
        $this->delete_pending = true;
    }

    /**
     * Saves all pending changes
     * @return void
     */
    public function save(): void
    {
        if($this->delete_pending) {
            $this->delete_pending = false;
            $this->row->delete();
            return;
        }

        $this->row->update($this->pending);
    }

    /**
     * Cancels all pending changes
     * @return void
     */
    public function cancel(): void
    {
        $this->delete_pending = false;
        $this->pending = array();
    }

    public static abstract function fromActiveRow(ActiveRow $activeRow): self;
}
