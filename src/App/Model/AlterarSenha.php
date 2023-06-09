<?php

declare(strict_types=1);

namespace Petweb\App\Model;

use GuzzleHttp\Client;
use Petweb\Domain\Entity\User;
use Petweb\Domain\ValueObject\Password;
use Petweb\Infra\Exception\InvalidPasswordException;
use Petweb\Infra\Repository\UserRepository;

class AlterarSenha
{
    public function changePassword(User $user, Password $oldPass, Password $newPass)
    {
        if ($user->password != $oldPass) {
            throw new InvalidPasswordException();
        }

        $user = new User(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            password: $newPass,
            userGroup: $user->userGroup,
            accountId: $user->accountId,
            telephone: $user->telephone,
            cpf: $user->cpf,
            image: $user->image
        );

        $httpClient =   new Client();
        $repo       =   new UserRepository($httpClient);
        $repo->update($user);
    }
}
