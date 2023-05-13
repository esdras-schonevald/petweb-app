<?php

declare(strict_types=1);

namespace Petweb\Domain\Entity;

class User
{
    public function __construct(
        private string $name,
        private string $email,
        private string $password
    ) {
    }
}
