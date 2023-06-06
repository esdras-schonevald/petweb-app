<?php

declare(strict_types=1);

namespace Petweb\Domain\ValueObject;

use Petweb\Domain\ValueObject\Exception\ValueObjectException;

class UserGroup implements \Stringable
{
    public function __construct(protected string $userGroup)
    {
        if (!$this->isValid()) {
            throw new ValueObjectException('UserGroup must be \'admin\', \'prestador\' or \'cliente\'');
        }
    }

    protected function isValid(): bool
    {
        return in_array($this->userGroup, ['admin', 'prestador', 'cliente']);
    }

    public function __toString(): string
    {
        return $this->userGroup;
    }
}
