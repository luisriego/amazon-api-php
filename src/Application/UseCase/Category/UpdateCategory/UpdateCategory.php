<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\UpdateCategory;

use App\Application\UseCase\Category\UpdateCategory\Dto\UpdateCategoryInputDto;
use App\Application\UseCase\Category\UpdateCategory\Dto\UpdateCategoryOutputDto;
use App\Domain\Repository\CategoryRepositoryInterface;

use function sprintf;
use function ucfirst;

class UpdateCategory
{
    private const SETTER_PREFIX = 'set';

    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository) {}

    public function handle(UpdateCategoryInputDto $dto): UpdateCategoryOutputDto
    {
        $category = $this->categoryRepository->findOneByIdOrFail($dto->id);

        foreach ($dto->paramsToUpdate as $param) {
            $category->{sprintf('%s%s', self::SETTER_PREFIX, ucfirst($param))}($dto->{$param});
        }
        $category->markAsUpdated();

        $this->categoryRepository->save($category, true);

        return UpdateCategoryOutputDto::create($category);
    }
}
