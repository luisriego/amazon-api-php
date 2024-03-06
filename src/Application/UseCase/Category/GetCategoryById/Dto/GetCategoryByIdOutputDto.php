<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\GetCategoryById\Dto;

use App\Domain\Model\Category;

readonly class GetCategoryByIdOutputDto
{
    private function __construct(
        public string $id,
        public string $name,
    ) {}

    public static function create(Category $category): self
    {
        return new self(
            $category->getId(),
            $category->getName(),
        );
    }
}
