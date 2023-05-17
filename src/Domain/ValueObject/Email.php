<?php

declare(strict_types=1);

namespace Petweb\Domain\ValueObject;

use Petweb\Domain\ValueObject\Exception\ValueObjectException;

class Email implements \Stringable
{
    public function __construct(
        private string $email
    ) {
        if (!$this->isValid()) {
            throw new ValueObjectException("Email must be a valid email pattern e.g. username@server.ext");
        }

        $this->email = strtolower($this->email);
    }

    public function __toString(): string
    {
        return $this->email;
    }

    protected function isValid(): bool
    {
        return (bool) filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }
}
