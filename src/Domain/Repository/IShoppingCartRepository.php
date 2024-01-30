<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\ShoppingCart;

interface IShoppingCartRepository
{
    public function add(ShoppingCart $review, bool $flush): void;

    public function save(ShoppingCart $review, bool $flush): void;

    public function remove(ShoppingCart $review, bool $flush): void;

    public function findOneByIdOrFail(string $id): ShoppingCart;
}
