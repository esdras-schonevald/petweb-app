<?php

declare(strict_types=1);

namespace Petweb\App\Model;

use Petweb\App\Model\Mock\UserMock;
use Petweb\Domain\Collection\UserCollection;
use Petweb\Domain\Entity\User;
use Petweb\Domain\ValueObject\Email;
use Petweb\Domain\ValueObject\Password;

class Login
{
    function __construct(
        private Email $email,
        private Password $password
    ) {
    }

    function validate(): bool
    {
        $user = $this->getUser();
        if (empty($user) || $user->password != $this->password) {
            return false;
        }

        return true;
    }

    function getUser(): ?User
    {
        $users  =   $this->getUsers();
        $user   =   $users->filterByEmail($this->email);

        return $user;
    }

    private function getUsers(): UserCollection
    {
        $users = UserMock::getCollection();

        return $users;
    }
}
