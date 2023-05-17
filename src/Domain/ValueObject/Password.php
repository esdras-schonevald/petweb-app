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

    public function __toString(): string
    {
        return md5(sha1($this->password));
    }

    protected function isValid(): bool
    {
        return (bool) preg_match('/^[a-f0-9]{32}$/', $this->password);
    }
}
