<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\OrderItem;

interface IOrderItemRepository
{
    public function add(OrderItem $review, bool $flush): void;

    public function save(OrderItem $review, bool $flush): void;

    public function remove(OrderItem $review, bool $flush): void;

    public function findOneByIdOrFail(string $id): OrderItem;
}
