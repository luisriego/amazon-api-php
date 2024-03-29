<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Address;

interface AddressRepositoryInterface
{
    public function add(Address $address, bool $flush): void;

    public function save(Address $address, bool $flush): void;

    public function remove(Address $address, bool $flush): void;

    public function findOneByIdOrFail(string $id): Address;

    public function findOneByStreetOrFail(string $street): Address;

    public function findAllByClientOrFail(string $clientId): array;
}
