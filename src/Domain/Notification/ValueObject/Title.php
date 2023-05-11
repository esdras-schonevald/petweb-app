<?php

declare(strict_types=1);

namespace Petweb\Domain\Notification\ValueObject;

class Title implements \Stringable
{
    function __construct(private readonly string $title)
    {
    }

    function __toString(): string
    {
        return $this->title;
    }
}
