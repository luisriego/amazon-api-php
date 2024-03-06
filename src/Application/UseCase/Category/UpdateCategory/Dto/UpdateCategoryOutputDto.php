<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\UpdateCategory\Dto;

use App\Domain\Model\Category;

class UpdateCategoryOutputDto
{
    private function __construct(public readonly array $categoryData) {}

    public static function create(Category $category): self
    {
        return new static([
            'id' => $category->getId(),
            'name' => $category->getName(),
        ]);
    }
}
