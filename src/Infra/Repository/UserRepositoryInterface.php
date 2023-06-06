<?php

declare(strict_types=1);

namespace Petweb\Infra\Repository;

use Petweb\Domain\Collection\UserCollection;
use Petweb\Domain\Entity\User;

/**
 * Interface to user repository
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
interface UserRepositoryInterface
{
    /**
     * Get all users from database
     *
     * @return UserCollection Collection of users
     */
    public function getAll(): UserCollection;

    /**
     * Get one user by id from database
     *
     * Return null if no user found
     *
     * @param integer $userID User identity
     * @return User|null User at ID
     */
    public function getById(int $userID): ?User;

    /**
     * Add a new user into database
     *
     * @param User $user User to be added
     * @return void
     */
    public function add(User $user): void;

    /**
     * Remove one user from database
     *
     * @param User $user User to be removed
     * @return void
     */
    public function remove(User $user): void;
}
