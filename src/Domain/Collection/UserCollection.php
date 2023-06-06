<?php

declare(strict_types=1);

namespace Petweb\Domain\Collection;

use Petweb\Domain\Entity\User;
use Petweb\Domain\ValueObject\Email;
use Phprise\Common\Contract\Arrayable;

class UserCollection implements \Iterator, \Countable, Arrayable, \JsonSerializable
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

    public function toJson(): string
    {
        return json_encode($this);
    }

    public static function fromJson(string $json): self
    {
        $array      =   json_decode($json);
        $users      =   array_map(fn ($obj) => User::fromJson(json_encode($obj)), $array);
        $collection =   new self();
        $collection->add(...$users);

        return $collection;
    }

    public function jsonSerialize(): mixed
    {
        return array_map(fn ($user) => $user->jsonSerialize(), $this->array);
    }
}
