<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Image;

use App\Adapter\Framework\Http\Dto\Image\CreateImageRequestDto;
use App\Application\UseCase\Image\CreateImage\CreateImage;
use App\Application\UseCase\Image\CreateImage\Dto\CreateImageInputDto;
use App\Domain\Model\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use function sprintf;

class CreateImageController extends AbstractController
{
    public function __construct(
        private readonly CreateImage $createImage,
    ) {}

    #[Route('api/create-image', 'api_image_create', methods: ['POST'])]
    public function __invoke(CreateImageRequestDto $requestDto): Response
    {
        $this->denyAccessUnlessGranted(
            Image::MIN_ROLE,
            null,
            sprintf('Only user with [%s] or greater can create this type of resource.', Image::MIN_ROLE),
        );

        $responseDto = $this->createImage->handle(
            CreateImageInputDto::create(
                $requestDto->url,
                $requestDto->publicCode,
                $requestDto->product,
            ),
        );

        return $this->json(['imageId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
