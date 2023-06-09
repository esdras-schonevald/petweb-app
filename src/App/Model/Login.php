<?php

declare(strict_types=1);

namespace Petweb\App\Model;

use GuzzleHttp\Client;
use Petweb\App\Model\Mock\UserMock;
use Petweb\Domain\Collection\UserCollection;
use Petweb\Domain\Entity\User;
use Petweb\Domain\ValueObject\Email;
use Petweb\Domain\ValueObject\Password;
use Petweb\Infra\Repository\UserRepository;

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
        $httpClient =   new Client();
        $repo       =   new UserRepository($httpClient);
        $user       =   $repo->getByEmail($this->email);

        return $user;
    }

    /**
    private function getUsers(): UserCollection
    {
        $users = UserMock::getCollection();

        return $users;
    }
     */
}
