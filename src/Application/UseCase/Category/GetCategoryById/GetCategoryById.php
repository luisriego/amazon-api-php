<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\GetCategoryById;

use App\Application\UseCase\Category\GetCategoryById\Dto\GetCategoryByIdInputDto;
use App\Application\UseCase\Category\GetCategoryById\Dto\GetCategoryByIdOutputDto;
use App\Domain\Repository\CategoryRepositoryInterface;

readonly class GetCategoryById
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
    ) {}

    public function handle(GetCategoryByIdInputDto $dto): GetCategoryByIdOutputDto
    {
        return GetCategoryByIdOutputDto::create($this->categoryRepository->findOneByIdOrFail($dto->id));
    }
}
