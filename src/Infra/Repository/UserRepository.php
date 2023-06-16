<?php

namespace Petweb\Infra\Repository;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Petweb\Domain\Collection\UserCollection;
use Petweb\Domain\Entity\User;
use Petweb\Domain\ValueObject\Email;
use Psr\Http\Client\ClientInterface;

/**
 * Abstraction layer to manager users in database.
 *
 * @author Esdras Schonevald <esdraschonevald@gmail.com>
 * @copyright 2023 Petweb
 * [
 *      ADIEL ESDRAS SCHONEVALD TOLENTINO,
 *      ROGÉRIO GONÇALVES RODRIGUES,
 *      LETÍCIA SANTOS OLIVEIRA,
 *      AMANDA DRAVANETE
 * ]
 */
class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        protected ClientInterface $httpClient
    ) {
    }

    /**
     * Get all users from database
     *
     * @return UserCollection
     * @throws Psr\Http\Client\ClientExceptionInterface
     */
    public function getAll(): UserCollection
    {
        $headers    =   ['accept' => 'application/json'];
        $uri        =   getenv('PETWEB_API_URL') . '/usuarios';
        $request    =   new Request('GET', $uri, $headers);
        $response   =   $this->httpClient->sendRequest($request);
        $users      =   $response->getBody()->__toString();

        return UserCollection::fromJson($users);
    }

    public function getById(int $id): ?User
    {
        $headers    =   ['accept' => 'application/json'];
        $uri        =   getenv('PETWEB_API_URL') . '/usuarios/' . $id;
        $request    =   new Request('GET', $uri, $headers);
        $response   =   $this->httpClient->sendRequest($request);
        $user       =   $response->getBody()->__toString();
        if (empty($user)) {
            return null;
        }

        return User::fromJson($user);
    }


    public function getByEmail(Email $email): ?User
    {
        $headers    =   ['accept' => 'application/json'];
        $uri        =   getenv('PETWEB_API_URL') . '/usuarios/email/' . $email->__toString();
        $request    =   new Request('GET', $uri, $headers);
        $response   =   $this->httpClient->sendRequest($request);
        $user       =   $response->getBody()->__toString();
        if (empty($user)) {
            return null;
        }

        return User::fromJson($user);
    }

    public function add(User $user): void
    {
        $headers    =   ['content-type' => 'application/json; charset=utf-8'];
        $uri        =   getenv('PETWEB_API_URL') . '/usuarios';
        $request    =   new Request('POST', $uri, $headers, $user->toJson());
        $response   =   $this->httpClient->sendRequest($request);
        $code       =   $response->getStatusCode();

        if ($code < 200 || $code >= 300) {
            throw new RequestException('Error during request process', $request, $response);
        }
    }

    public function update(User $user): void
    {
        $headers    =   ['content-type' => 'application/json; charset=utf-8'];
        $uri        =   getenv('PETWEB_API_URL') . '/usuarios/' . $user->id;
        $request    =   new Request('PATCH', $uri, $headers, $user->toJson());
        $response   =   $this->httpClient->sendRequest($request);
        $code       =   $response->getStatusCode();

        if ($code < 200 || $code >= 300) {
            throw new RequestException('Error during request process', $request, $response);
        }
    }

    public function remove(User $user): void
    {
        $headers    =   ['content-type' => 'application/json; charset=utf-8'];
        $uri        =   getenv('PETWEB_API_URL') . '/usuarios/' . $user->id;
        $request    =   new Request('DELETE', $uri, $headers);
        $response   =   $this->httpClient->sendRequest($request);
        $code       =   $response->getStatusCode();

        if ($code < 200 || $code >= 300) {
            throw new RequestException('Error during request process', $request, $response);
        }
    }
}
