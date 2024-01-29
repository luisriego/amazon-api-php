<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Country;

interface ICountryRepository
{
    public function add(Country $review, bool $flush): void;

    public function save(Country $review, bool $flush): void;

    public function remove(Country $review, bool $flush): void;

    public function findOneByIdOrFail(string $id): Country;
}
