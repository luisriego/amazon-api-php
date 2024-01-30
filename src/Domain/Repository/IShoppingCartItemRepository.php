<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\ShoppingCartItem;

interface IShoppingCartItemRepository
{
    public function add(ShoppingCartItem $review, bool $flush): void;

    public function save(ShoppingCartItem $review, bool $flush): void;

    public function remove(ShoppingCartItem $review, bool $flush): void;

    public function findOneByIdOrFail(string $id): ShoppingCartItem;
}
