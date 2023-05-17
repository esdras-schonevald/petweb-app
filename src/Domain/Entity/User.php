<?php

declare(strict_types=1);

namespace Petweb\Domain\Entity;

use Petweb\Domain\ValueObject\Email;
use Petweb\Domain\ValueObject\ImageSource;
use Petweb\Domain\ValueObject\Name;
use Petweb\Domain\ValueObject\Password;

class User
{
    public function __construct(
        public readonly Name $name,
        public readonly Email $email,
        public readonly Password $password,
        public readonly ImageSource $image
    ) {
    }
}
