<?php

namespace App\Application\UseCase\Category\ActivationCategorySwitch\Dto;

use App\Domain\Model\Category;

readonly class ActivationCategorySwitchOutputDto
{
    private function __construct(public array $CategoryData)
    {
    }

    public static function create(Category $category): self
    {
        return new static([
            'id' => $category->getId(),
            'name' => $category->getName(),
            'isActive' => $category->isActive(),
        ]);
    }
}