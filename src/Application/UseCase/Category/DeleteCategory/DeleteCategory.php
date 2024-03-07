<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\DeleteCategory;

use App\Application\UseCase\Category\DeleteCategory\Dto\DeleteCategoryInputDto;
use App\Domain\Repository\CategoryRepositoryInterface;

class DeleteCategory
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository) {}

    public function handle(DeleteCategoryInputDto $dto): void
    {
        $categoryToDelete = $this->categoryRepository->findOneByIdOrFail($dto->id);

        $this->categoryRepository->remove($categoryToDelete, true);
    }
}
