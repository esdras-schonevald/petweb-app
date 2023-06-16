<?php

declare(strict_types=1);

namespace Petweb\Domain\ValueObject;

use Petweb\Domain\ValueObject\Exception\ValueObjectException;

class Telephone implements \Stringable
{
    public function __construct(protected string $telephone)
    {
        $this->telephone    =   preg_replace('/\D/', '', $this->telephone);

        if (!$this->isValid()) {
            throw new ValueObjectException('Telephone must be this format (XX) XXXX-XXXX');
        }
    }

    protected function isValid(): bool
    {
        return (bool) preg_match('/^([\d]{2})(9)?([\d]{8})$/', $this->telephone);
    }

    public function __toString(): string
    {
        return $this->telephone;
    }

    public function format(): string|null
    {
        return preg_replace('/^([\d]{2})(9)?([\d]{4})([\d]{4})$/', '($1) $2 $3-$4', $this->telephone);
    }
}
