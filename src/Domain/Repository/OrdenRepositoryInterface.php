<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Orden;

interface OrdenRepositoryInterface
{
    public function add(Orden $orden, bool $flush): void;

    public function save(Orden $orden, bool $flush): void;

    public function remove(Orden $orden, bool $flush): void;

    public function findOneByIdOrFail(string $id): Orden;
}
