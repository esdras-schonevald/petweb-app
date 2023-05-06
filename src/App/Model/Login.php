<?php

declare(strict_types=1);

namespace Petweb\App\Model;

class Login
{
    public const MOCK = [
        0 => ['email' => 'esdraschonevald@gmail.com', 'password' => 'e23b27413823ea92e0098ce7581022b0'],
        1 => ['email' => 'esdras@gmail.com', 'password' => 'd93a5def7511da3d0f2d171d9c344e91'],
        2 => ['email' => 'rogerio@gmail.com', 'password' => 'd93a5def7511da3d0f2d171d9c344e91']
    ];

    function __construct(
        private string $email,
        private string $password
    ) {
    }

    function validate(): bool
    {
        $user = ['email' => $this->email, 'password' => $this->password];

        if (!in_array($user, Login::MOCK)) {
            return false;
        }

        return true;
    }
}
