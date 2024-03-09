<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\UpdateProduct\Dto;

use App\Domain\Model\Product;

readonly class UpdateProductOutputDto
{
    private function __construct(public array $productData) {}

    public static function create(Product $product): self
    {
        return new static([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
        ]);
    }
}
