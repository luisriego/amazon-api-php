<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\CreateProduct;

use App\Application\UseCase\Product\CreateProduct\Dto\CreateProductInputDto;
use App\Application\UseCase\Product\CreateProduct\Dto\CreateProductOutputDto;
use App\Domain\Exception\UnableToCreateResourceException;
use App\Domain\Model\Product;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;

readonly class CreateProduct
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private CategoryRepositoryInterface $categoryRepository,
    ) {}

    public function handle(CreateProductInputDto $createProductInputDto): CreateProductOutputDto
    {
        $category = $this->categoryRepository->findOneByIdOrFail($createProductInputDto->category);

        if (null === $product = Product::create(
            $createProductInputDto->sku,
            $createProductInputDto->name,
            $createProductInputDto->description,
            (int) $createProductInputDto->price,
        )
        ) {
            throw UnableToCreateResourceException::fromNamedConstructor(Product::class);
        }

        $product->setCategory($category);

        $this->productRepository->add($product, true);

        return new CreateProductOutputDto($product->getId());
    }
}
