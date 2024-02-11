<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category;

use App\Application\UseCase\Category\Dto\CreateCategoryInputDto;
use App\Application\UseCase\Category\Dto\CreateCategoryOutputDto;
use App\Domain\Exception\Category\CategoryAlreadyExistsException;
use App\Domain\Model\Category;
use App\Domain\Repository\CategoryRepositoryInterface;

readonly class CreateCategory
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository) {}

    public function handle(CreateCategoryInputDto $createCategoryInputDto): CreateCategoryOutputDto
    {
        if (!null === $this->categoryRepository->findOneByNameOrFail($createCategoryInputDto->name)) {
            throw CategoryAlreadyExistsException::createFromName($createCategoryInputDto->name);
        }

        $category = Category::create($createCategoryInputDto->name);

        $this->categoryRepository->add($category, true);

        return new CreateCategoryOutputDto($category->getId());
    }
}
