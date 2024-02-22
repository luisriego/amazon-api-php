<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\CreateProduct;

use App\Application\UseCase\Product\CreateProduct\Dto\CreateProductInputDto;
use App\Application\UseCase\Product\CreateProduct\Dto\CreateProductOutputDto;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Exception\UnableToCreateResourceException;
use App\Domain\Model\Category;
use App\Domain\Model\Product;
use App\Domain\Model\User;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security;

readonly class CreateProduct
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private CategoryRepositoryInterface $categoryRepository,
        private Security $security,
    ) {}

    public function handle(CreateProductInputDto $createProductInputDto): CreateProductOutputDto
    {
        /** @var User $authenticatedUser */
        $authenticatedUser = $this->security->getUser();

        if (null === $category = $this->categoryRepository->findOneByIdOrFail($createProductInputDto->category)) {
            throw ResourceNotFoundException::createFromClassAndId(Category::class, $createProductInputDto->category);
        }

        if (null === $product = Product::create(
            $createProductInputDto->name,
            $createProductInputDto->description,
            (int) $createProductInputDto->price,
        )
        ) {
            throw UnableToCreateResourceException::fromNamedConstructor(Product::class);
        }

        $product->setCategory($category);
        $product->creator($authenticatedUser->getUserIdentifier());

        $this->productRepository->add($product, true);

        return new CreateProductOutputDto($product->getId());
    }
}
