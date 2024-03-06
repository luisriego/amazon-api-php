<?php

declare(strict_types=1);

namespace App\Application\UseCase\Review\CreateReview;

use App\Application\UseCase\Review\CreateReview\Dto\CreateReviewInputDto;
use App\Application\UseCase\Review\CreateReview\Dto\CreateReviewOutputDto;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Review;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\ReviewRepositoryInterface;

readonly class CreateReview
{
    public function __construct(
        private ReviewRepositoryInterface $reviewRepository,
        private ProductRepositoryInterface $productRepository,
    ) {}

    public function handle(CreateReviewInputDto $inputDto): CreateReviewOutputDto
    {
        if (null === $product = $this->productRepository->findOneByIdOrFail($inputDto->product)) {
            throw ResourceNotFoundException::createFromClassAndId(Review::class, $inputDto->product);
        }

        $review = Review::create(
            $inputDto->name,
            $inputDto->comment,
            $inputDto->rating,
            $product,
        );

        $this->reviewRepository->add($review, true);

        return new CreateReviewOutputDto($review->getId());
    }
}
