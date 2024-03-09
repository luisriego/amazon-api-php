<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\UpdateRating;

use App\Application\UseCase\Product\UpdateRating\Dto\UpdateRatingProductInputDto;
use App\Application\UseCase\Product\UpdateRating\Dto\UpdateRatingProductOutputDto;
use App\Domain\Repository\ProductRepositoryInterface;

readonly class UpdateRatingProduct
{
    public function __construct(private ProductRepositoryInterface $productRepository) {}

    public function handle(UpdateRatingProductInputDto $dto): UpdateRatingProductOutputDto
    {
        $product = $this->productRepository->findOneByIdOrFail($dto->id);

        $product->setVotes($product->getVotes() + 1);
        $product->setTotalRatings($product->getTotalRatings() + $dto->rating);

        $this->productRepository->save($product, true);

        return UpdateRatingProductOutputDto::create($product);
    }
}
