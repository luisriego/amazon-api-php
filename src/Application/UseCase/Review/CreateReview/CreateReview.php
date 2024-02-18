<?php

namespace App\Application\UseCase\Review\CreateReview;

use App\Application\UseCase\Review\CreateReview\Dto\CreateReviewInputDto;
use App\Application\UseCase\Review\CreateReview\Dto\CreateReviewOutputDto;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Review;
use App\Domain\Model\User;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\ReviewRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security;

class CreateReview
{
    public function __construct(
        private readonly ReviewRepositoryInterface $reviewRepository,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly Security $security,
    )
    { }

    public function handle(CreateReviewInputDto $inputDto): CreateReviewOutputDto
    {
        /** @var User $authenticatedUser */
        $authenticatedUser = $this->security->getUser();

        if (null === $product = $this->productRepository->findOneByIdOrFail($inputDto->product)) {
            throw ResourceNotFoundException::createFromClassAndId(Review::class, $inputDto->product);
        }

        $review = Review::create(
            $inputDto->name,
            $inputDto->comment,
            intval($inputDto->rating),
            $product,
            $authenticatedUser
        );

        $this->reviewRepository->add($review, true);

        return new CreateReviewOutputDto($review->getId());
    }
}