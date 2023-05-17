<?php

declare(strict_types=1);

namespace Petweb\Domain\Collection;

trait CollectionTemplate
{
    protected int $index = 0;
    protected array $array = [];

    /** this commented methods must be implemented with replacing Collectible to custom collectible object */
    /** traits do not suports this polymorphism with multiple assign functions */

    /**
    public function current(): Collectible
    {
        return $this->array[$this->index];
    }

    public function add(Collectible ...$collectible): void
    {
        array_map(fn ($item) => $this->array[] = $item, $collectible);
    }

    public function remove(Collectible ...$collectible): void
    {
        array_map(function ($item) {
            unset($this->array[array_search($item, $this->array)]);
        }, $collectible);
    }
     */

    /** end custom */

    public function count(): int
    {
        return count($this->array);
    }

    public function key(): int
    {
        return $this->index;
    }

    public function next(): void
    {
        ++$this->index;
    }

    public function rewind(): void
    {
        $this->index = 0;
    }

    public function valid(): bool
    {
        return isset($this->array[$this->index]);
    }

    public function toArray(): array
    {
        return $this->array;
    }
}
