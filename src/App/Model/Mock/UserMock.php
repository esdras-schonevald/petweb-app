<?php

declare(strict_types=1);

namespace Petweb\App\Model\Mock;

use Petweb\Domain\Collection\UserCollection;
use Petweb\Domain\Entity\User;
use Petweb\Domain\ValueObject\CPF;
use Petweb\Domain\ValueObject\Email;
use Petweb\Domain\ValueObject\ImageSource;
use Petweb\Domain\ValueObject\Name;
use Petweb\Domain\ValueObject\Password;
use Petweb\Domain\ValueObject\Telephone;
use Petweb\Domain\ValueObject\UserGroup;

final class UserMock
{
    public static function getCollection(): UserCollection
    {
        $users = new UserCollection();

        $users->add(

            new User(
                id: 24,
                name: new Name('Esdras Schonevald'),
                email: new Email('esdraschonevald@fatec.sp.gov.br'),
                password: new Password(md5(sha1('Mudar@123'))),
                userGroup: new UserGroup('cliente'),
                accountId: 25,
                telephone: new Telephone('11964819214'),
                cpf: new CPF('37064613824'),
                image: new ImageSource('/img/photo-perfil-esdras.png')
            ),

            new User(
                id: 25,
                name: new Name('Rogerio Rodrigues'),
                email: new Email('rogonrodrigues@fatec.sp.gov.br'),
                password: new Password(md5(sha1('Mudar@123'))),
                image: new ImageSource('/img/photo-perfil-rogerio.png'),
                userGroup: new UserGroup('cliente'),
                accountId: 26,
                telephone: new Telephone('11964819214'),
                cpf: new CPF('37064613824')
            ),

            new User(
                name: new Name('Letícia Oliveira'),
                email: new Email('leticiasantosfernandes2@fatec.sp.gov.br'),
                password: new Password(md5(sha1('Mudar@123'))),
                image: new ImageSource('/img/photo-perfil-leticia.png'),
                id: 26,
                userGroup: new UserGroup('cliente'),
                accountId: 27,
                telephone: new Telephone('11964819214'),
                cpf: new CPF('37064613824'),
            ),

            new User(
                name: new Name('Amanda Dravanete'),
                email: new Email('dravaneteamanda@fatec.sp.gov.br'),
                password: new Password(md5(sha1('Mudar@123'))),
                image: new ImageSource('/img/photo-perfil-amanda.png'),
                id: 27,
                userGroup: new UserGroup('cliente'),
                accountId: 28,
                telephone: new Telephone('11964819214'),
                cpf: new CPF('37064613824'),
            )
        );

        return $users;
    }
}
