<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category;

use App\Application\UseCase\Category\Dto\CreateCategoryInputDto;
use App\Application\UseCase\Category\Dto\CreateCategoryOutputDto;
use App\Domain\Model\Category;
use App\Domain\Model\User;
use App\Domain\Repository\CategoryRepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security;

readonly class CreateCategory
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private Security $security,
    ) {}

    public function handle(CreateCategoryInputDto $createCategoryInputDto): CreateCategoryOutputDto
    {
        /** @var User $authenticatedUser */
        $authenticatedUser = $this->security->getUser();

        if (null === $category = $this->categoryRepository->findOneByNameOrFail($createCategoryInputDto->name)) {
            $category = Category::create($createCategoryInputDto->name, $authenticatedUser);
        }

        $this->categoryRepository->add($category, true);

        return new CreateCategoryOutputDto($category->getId());
    }
}
