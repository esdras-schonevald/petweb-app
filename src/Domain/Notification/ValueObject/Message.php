<?php

declare(strict_types=1);

namespace Petweb\Domain\Notification\ValueObject;

class Message implements \Stringable
{
    function __construct(private readonly string $message)
    {
    }

    function __toString(): string
    {
        return $this->message;
    }
}
