<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\UpdateStockProduct\Dto;

use App\Domain\Model\Product;

readonly class UpdateStockProductOutputDto
{
    private function __construct(public array $productData) {}

    public static function create(Product $product): self
    {
        return new static([
            'id' => $product->getId(),
            'stock' => $product->getStock(),
        ]);
    }
}
