<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Order;

interface OrderRepositoryInterface
{
    public function add(Order $order, bool $flush): void;

    public function save(Order $order, bool $flush): void;

    public function remove(Order $order, bool $flush): void;

    public function findOneByIdOrFail(string $id): Order;
}
