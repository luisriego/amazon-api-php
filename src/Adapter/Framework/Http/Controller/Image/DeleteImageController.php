<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Image;

use App\Adapter\Framework\Http\Dto\Image\DeleteImageRequestDto;
use App\Application\UseCase\Image\DeleteImage\DeleteImage;
use App\Application\UseCase\Image\DeleteImage\Dto\DeleteImageInputDto;
use App\Domain\Exception\Security\CreateAccessDeniedException;
use App\Domain\Model\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteImageController extends AbstractController
{
    public function __construct(private readonly DeleteImage $deleteImageService) {}

    #[Route('api/image/delete/{id}', name: 'api_image_delete', methods: ['DELETE'])]
    public function __invoke(DeleteImageRequestDto $dto): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw CreateAccessDeniedException::deniedByUnauthorizedRoleFromClassAndRole('Image', Image::MIN_ROLE);
        }

        $this->deleteImageService->handle(DeleteImageInputDto::create($dto->id));

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
