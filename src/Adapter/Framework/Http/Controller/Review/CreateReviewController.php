<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Review;

use App\Adapter\Framework\Http\Dto\Review\CreateReviewRequestDto;
use App\Application\UseCase\Review\CreateReview\CreateReview;
use App\Application\UseCase\Review\CreateReview\Dto\CreateReviewInputDto;
use App\Domain\Model\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use function sprintf;

class CreateReviewController extends AbstractController
{
    public function __construct(private readonly CreateReview $createReview) {}

    #[Route('/api/create-review', 'api_create_review', methods: ['POST'])]
    public function __invoke(CreateReviewRequestDto $requestDto): Response
    {
        $this->denyAccessUnlessGranted(
            Review::MIN_ROLE,
            null,
            sprintf('Only user with [%s] or greater can create this type of resource.', Review::MIN_ROLE),
        );

        $responseDto = $this->createReview->handle(
            CreateReviewInputDto::create(
                $requestDto->name,
                $requestDto->comment,
                $requestDto->rating,
                $requestDto->product,
            ),
        );

        return $this->json(['reviewId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
