<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\UpdateStockProduct;

use App\Application\UseCase\Product\UpdateStockProduct\Dto\UpdateStockProductInputDto;
use App\Application\UseCase\Product\UpdateStockProduct\Dto\UpdateStockProductOutputDto;
use App\Domain\Exception\Product\ProductCannotHaveNegativeStockException;
use App\Domain\Repository\ProductRepositoryInterface;

readonly class UpdateStockProduct
{
    public function __construct(private ProductRepositoryInterface $productRepository) {}

    public function handle(UpdateStockProductInputDto $dto): UpdateStockProductOutputDto
    {
        $product = $this->productRepository->findOneByIdOrFail($dto->id);

        $product->setStock($product->getStock() + $dto->stock);

        if ($product->getStock() < 0) {
            throw ProductCannotHaveNegativeStockException::ChangeStock();
        }

        $product->markAsUpdated();

        $this->productRepository->save($product, true);

        return UpdateStockProductOutputDto::create($product);
    }
}
