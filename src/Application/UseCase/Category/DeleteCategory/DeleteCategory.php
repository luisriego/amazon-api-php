<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\DeleteCategory;

use App\Application\UseCase\Category\DeleteCategory\Dto\DeleteCategoryInputDto;
use App\Domain\Exception\UnableToDeleteResourceException;
use App\Domain\Model\Category;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;

use function count;

readonly class DeleteCategory
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private ProductRepositoryInterface $productRepository,
    ) {}

    public function handle(DeleteCategoryInputDto $dto): void
    {
        $categoryToDelete = $this->categoryRepository->findOneByIdOrFail($dto->id);

        $products = $this->productRepository->findAllByCategoryIdOrFail($dto->id);

        if (count($products) > 0) {
            throw UnableToDeleteResourceException::createFromClassAndId(Category::class, $dto->id);
        }

        $this->categoryRepository->remove($categoryToDelete, true);
    }
}
