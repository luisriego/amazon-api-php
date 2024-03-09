<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\UpdateRating\Dto;

use App\Domain\Model\Product;

use function number_format;

readonly class UpdateRatingProductOutputDto
{
    private function __construct(public array $productData) {}

    public static function create(Product $product): self
    {
        $rating = ($product->getTotalRatings() / $product->getVotes()) / 100;

        return new static([
            'id' => $product->getId(),
            'rating' => number_format($rating, 2, '.', ''),
        ]);
    }
}
