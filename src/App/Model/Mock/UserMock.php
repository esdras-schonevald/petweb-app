<?php

declare(strict_types=1);

namespace Petweb\App\Model\Mock;

use Petweb\Domain\Collection\UserCollection;
use Petweb\Domain\Entity\User;
use Petweb\Domain\ValueObject\Email;
use Petweb\Domain\ValueObject\ImageSource;
use Petweb\Domain\ValueObject\Name;
use Petweb\Domain\ValueObject\Password;

final class UserMock
{
    public static function getCollection(): UserCollection
    {
        $users = new UserCollection();

        $users->add(

            new User(
                name: new Name('Esdras Schonevald'),
                email: new Email('esdraschonevald@gmail.com'),
                password: new Password('d93a5def7511da3d0f2d171d9c344e91'),
                image: new ImageSource('/img/photo-perfil-esdras.png')
            ),

            new User(
                name: new Name('Rogerio Rodrígues'),
                email: new Email('rogonrodrigues@gmail.com'),
                password: new Password('d93a5def7511da3d0f2d171d9c344e91'),
                image: new ImageSource('/img/photo-perfil-rogerio.png')
            ),

            new User(
                name: new Name('Letícia Oliveira'),
                email: new Email('leticiasantosfernandes2@gmail.com'),
                password: new Password('d93a5def7511da3d0f2d171d9c344e91'),
                image: new ImageSource('/img/photo-perfil-leticia.png')
            ),

            new User(
                name: new Name('Amanda Dravanete'),
                email: new Email('dravaneteamanda@gmail.com'),
                password: new Password('d93a5def7511da3d0f2d171d9c344e91'),
                image: new ImageSource('/img/photo-perfil-amanda.png')
            )
        );

        return $users;
    }
}
