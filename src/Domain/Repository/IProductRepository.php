<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Product;

interface IProductRepository
{
    public function add(Product $product, bool $flush): void;

    public function save(Product $product, bool $flush): void;

    public function remove(Product $product, bool $flush): void;

    public function findOneByIdOrFail(string $id): Product;
}
