<?php

declare(strict_types=1);

namespace Petweb\Domain\ValueObject;

use Petweb\Domain\ValueObject\Exception\ValueObjectException;

class Password implements \Stringable
{
    public function __construct(
        private string $password
    ) {
        if (!$this->isValid()) {
            throw new ValueObjectException('Password must be a valid MD5');
        }
    }

    public static function create(string $password): self
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/', $password)) {
            throw new ValueObjectException('Password must contain between 8 and 12 characters including uppercase, lowercase, numbers and special characters');
        }

        return new self(md5(sha1($password)));
    }

    public function __toString(): string
    {
        return $this->password;
    }

    protected function isValid(): bool
    {
        return (bool) preg_match('/^[a-f0-9]{32}$/', $this->password);
    }
}
