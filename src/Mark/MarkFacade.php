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
        $mark = $this->marks->get($id);
        if($mark == null) {
            return null;
        }

        return Mark::fromActiveRow($mark);
    }

    /**
     * @param bool $reverse
     * @return Mark[]
     */
    public function getAllSorted(bool $reverse = false): array
    {
        $list = array();
        $marks = $this->marks->order('name ' . ($reverse ? 'DESC' : 'ASC'));
        foreach ($marks as $mark) {
            $list[] = Mark::fromActiveRow($mark);
        }
        return $list;
    }

    /**
     * @param int<0, max> $offset
     * @param positive-int $limit
     * @param bool $reverse
     * @return Mark[]
     */
    public function getOffsetSortedLimit(int $offset, int $limit = 4, bool $reverse = false): array
    {
        $list = array();
        $marks = $this->marks->order('name ' . ($reverse ? 'DESC' : 'ASC'))->limit($limit, $offset);
        foreach ($marks as $mark) {
            $list[] = Mark::fromActiveRow($mark);
        }
        return $list;
    }

    /**
     * @param positive-int $page
     * @param positive-int $itemsPerPage
     * @param bool $reverse
     * @return MarksPaged
     */
    public function pagedSorted(int $page, int $itemsPerPage = 4, bool $reverse = false): MarksPaged
    {
        $count = $this->marks->count();
        $pages = intdiv($count, $itemsPerPage) + 1;
        $marks = $this->getOffsetSortedLimit(($page - 1) * $itemsPerPage, $itemsPerPage, $reverse);
        return new MarksPaged($page, $pages, $marks);
    }

    public function getByName(string $name): ?Mark
    {
        $mark = $this->marks->where('name', $name)->limit(1)->fetch();
        if($mark == null) {
            return null;
        }

        return Mark::fromActiveRow($mark);
    }

    public function insert(string $name): ?Mark
    {
        $mark = $this->marks->insert(['name' => $name]);
        if($mark == null) {
            return null;
        }

        return Mark::fromActiveRow($mark);
    }
}
