<?php

namespace App\Application\UseCase\Category\ActivationCategorySwitch;

use App\Application\UseCase\Category\ActivationCategorySwitch\Dto\ActivationCategorySwitchInputDto;
use App\Application\UseCase\Category\ActivationCategorySwitch\Dto\ActivationCategorySwitchOutputDto;
use App\Domain\Repository\CategoryRepositoryInterface;

readonly class ActivationCategorySwitch
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function handle(ActivationCategorySwitchInputDto $inputDto): ActivationCategorySwitchOutputDto
    {
        $category = $this->categoryRepository->findOneByIdOrFail($inputDto->id);

        $category->toggleActive();

        $category->markAsUpdated();

        $this->categoryRepository->save($category, true);

        return ActivationCategorySwitchOutputDto::create($category);
    }
}