<?php

declare(strict_types=1);

namespace Petweb\Domain\ValueObject;

use Petweb\Domain\ValueObject\Exception\ValueObjectException;

class Name implements \Stringable
{
    public function __construct(
        private string $name
    ) {
        if (!$this->isValid()) {
            throw new ValueObjectException('Name must contain only alphabetic characters and spaces');
        }

        $this->name = trim($this->name);
        $this->name = strtolower($this->name);
        $this->name = ucwords($this->name);
    }

    public function __toString(): string
    {
        return $this->name;
    }

    protected function isValid(): bool
    {
        return (bool) preg_match('/^[A-Za-zÀ-ȕ\s]{1,255}/', $this->name);
    }
}
