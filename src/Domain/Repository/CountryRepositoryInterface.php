<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Country;

interface CountryRepositoryInterface
{
    public function add(Country $review, bool $flush): void;

    public function save(Country $review, bool $flush): void;

    public function remove(Country $review, bool $flush): void;

    public function findOneByIdOrFail(int $id): Country;

    public function findOneByNameOrFail(string $name): Country;

    public function findOneLikeNameOrFail(string $name): ?Country;
}
