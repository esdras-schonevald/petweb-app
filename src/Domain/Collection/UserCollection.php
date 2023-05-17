<?php

declare(strict_types=1);

namespace Petweb\Domain\Collection;

use Petweb\Domain\Entity\User;
use Petweb\Domain\ValueObject\Email;
use Phprise\Common\Contract\Arrayable;

class UserCollection implements \Iterator, \Countable, Arrayable
{
    use CollectionTemplate;

    /** implements abstracts */

    public function current(): User
    {
        return $this->array[$this->index];
    }

    public function add(User ...$user): void
    {
        array_map(fn ($item) => $this->array[] = $item, $user);
    }

    public function remove(User ...$user): void
    {
        array_map(function ($item) {
            unset($this->array[array_search($item, $this->array)]);
        }, $user);
    }

    /** custom methods */

    public function filterByEmail(Email $email): ?User
    {
        $filter = array_filter($this->array, fn ($item) => $item->email == $email);
        return current($filter) ?? null;
    }
}
