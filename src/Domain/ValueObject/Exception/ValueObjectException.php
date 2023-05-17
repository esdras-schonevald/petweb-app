<?php

declare(strict_types=1);

namespace Petweb\Domain\ValueObject\Exception;

use ValueError;

class ValueObjectException extends ValueError
{
    function __construct(string $message)
    {
        parent::__construct($message, 500);
    }
}
