<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Address;

interface IAddressRepository
{
    public function add(Address $review, bool $flush): void;
    public function save(Address $review, bool $flush): void;
    public function remove(Address $review, bool $flush): void;
    public function findOneByIdOrFail(string $id): Address;
}
