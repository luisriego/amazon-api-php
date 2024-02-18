<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\ShoppingCart;

interface ShoppingCartRepositoryInterface
{
    public function add(ShoppingCart $shoppingCart, bool $flush): void;

    public function save(ShoppingCart $shoppingCart, bool $flush): void;

    public function remove(ShoppingCart $shoppingCart, bool $flush): void;

    public function findOneByIdOrFail(string $id): ShoppingCart;
}
