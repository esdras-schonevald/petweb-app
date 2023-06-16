<?php

declare(strict_types=1);

namespace Petweb\App\Model;

use GuzzleHttp\Client;
use Petweb\Domain\Entity\User;
use Petweb\Infra\Core\Session;
use Petweb\Domain\ValueObject\CPF;
use Petweb\Domain\ValueObject\Name;
use Petweb\Domain\ValueObject\Email;
use Petweb\Domain\ValueObject\Password;
use Petweb\Domain\ValueObject\Telephone;
use Petweb\Domain\ValueObject\UserGroup;
use Petweb\Domain\ValueObject\ImageSource;
use Petweb\Infra\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class CadastroCliente
{
    /**
     * Save the user on the database
     *
     * @param \Symfony\Components\HttpFoundation\Request $request
     * @return User|null
     * @throws \Petweb\Domain\ValueObject\Exception\ValueObjectException
     */
    public function save(Request $request): ?User
    {
        $image = $request->request->get('image');

        $user = new User(
            id: 0,
            name: new Name($request->request->get('name')),
            email: new Email($request->request->get('email')),
            password: Password::create($request->request->get('senha')),
            userGroup: new UserGroup('cliente'),
            accountId: (int) getenv('DEFAULT_ACCOUNT_ID'),
            telephone: new Telephone($request->request->filter('fone')),
            cpf: new CPF($request->request->filter('cpf')),
            image: $image? new ImageSource($image): null
        );

        $httpClient =   new Client();
        $repo       =   new UserRepository($httpClient);
        $repo->add($user);

        return $repo->getByEmail($user->email);
    }
}
