<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Category;
use App\Domain\Model\Product;

interface ProductRepositoryInterface
{
    public function add(Product $product, bool $flush): void;

    public function save(Product $product, bool $flush): void;

    public function remove(Product $product, bool $flush): void;

    public function findOneByIdOrFail(string $id): Product;

    public function findAllByCategoryIdOrFail(string $categoryId): ?array;

    public function findOneRepeated(string $name, int $price, Category $category): ?Product;
}
