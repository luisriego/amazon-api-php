<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Order;

interface IOrderRepository
{
    public function add(Order $review, bool $flush): void;

    public function save(Order $review, bool $flush): void;

    public function remove(Order $review, bool $flush): void;

    public function findOneByIdOrFail(string $id): Order;
}
