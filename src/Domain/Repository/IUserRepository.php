<?php

namespace App\Domain\Repository;

use App\Domain\Model\User;

interface IUserRepository
{
    public function add(User $user, bool $flush): void;

    public function save(User $user): void;

    public function remove(User $user, bool $flush): void;

    public function findOneByIdOrFail(string $id): User;

    public function findOneByEmail(string $email): ?User;

    public function findOneByEmailOrFail(string $id): User;

    public function findAllByCondoId(string $condoId): ?array;

//    public function search(UserFilter $filter): PaginatedResponse;

//    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void;
}