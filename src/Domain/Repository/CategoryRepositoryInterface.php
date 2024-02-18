<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Category;

interface CategoryRepositoryInterface
{
    public function add(Category $category, bool $flush): void;

    public function save(Category $category, bool $flush): void;

    public function remove(Category $category, bool $flush): void;

    public function findOneByIdOrFail(string $id): Category;

    public function findOneByNameOrFail(string $name): ?Category;

    public function findOneByName(string $name): ?Category;
}
