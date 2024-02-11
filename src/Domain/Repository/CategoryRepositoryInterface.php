<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Category;

interface CategoryRepositoryInterface
{
    public function add(Category $review, bool $flush): void;

    public function save(Category $review, bool $flush): void;

    public function remove(Category $review, bool $flush): void;

    public function findOneByIdOrFail(string $id): Category;

    public function findOneByNameOrFail(string $name): ?Category;
}
