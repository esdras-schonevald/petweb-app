<?php

declare(strict_types=1);

namespace Petweb\Infra\Exception;

use LogicException;

class InvalidPasswordException extends LogicException
{
    public function __construct()
    {
        parent::__construct("Invalid password", 401);
    }
}
