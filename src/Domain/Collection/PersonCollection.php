<?php

declare(strict_types=1);

namespace Petweb\Domain\Collection;

use Petweb\Domain\Entity\Person;
use Petweb\Domain\ValueObject\Email;
use Phprise\Common\Contract\Arrayable;

class PersonCollection implements \Iterator, \Countable, Arrayable
{
    use CollectionTemplate;

    /** implements abstracts */

    public function current(): Person
    {
        return $this->array[$this->index];
    }

    public function add(Person ...$person): void
    {
        array_map(fn ($item) => $this->array[] = $item, $person);
    }

    public function remove(Person ...$person): void
    {
        array_map(function ($item) {
            unset($this->array[array_search($item, $this->array)]);
        }, $person);
    }

    /** custom methods */

    public function filterByEmail(Email $email): ?Person
    {
        $filter = array_filter($this->array, fn ($item) => $item->email == $email);
        return current($filter) ?? null;
    }
}
