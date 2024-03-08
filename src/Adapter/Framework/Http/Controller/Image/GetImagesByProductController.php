<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Image;

use App\Adapter\Framework\Http\Dto\Image\GetImagesByProductRequestDto;
use App\Adapter\Framework\Http\Response\ApiResponse;
use App\Application\UseCase\Image\GetImagesByProduct\Dto\GetImagesByProductInputDto;
use App\Application\UseCase\Image\GetImagesByProduct\GetImagesByProduct;
use App\Domain\Model\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

use function array_map;

class GetImagesByProductController extends AbstractController
{
    public function __construct(
        private readonly GetImagesByProduct $useCase,
    ) {}

    #[Route('/api/image/get-images-by-product/{id}', name: 'get_images_by_product_id', methods: ['GET'])]
    public function __invoke(GetImagesByProductRequestDto $request): ApiResponse
    {
        $responseDTO = $this->useCase->handle(GetImagesByProductInputDto::create($request->id));

        $result = array_map(function (Image $image): array {
            return $image->toArray();
        }, $responseDTO);

        return new ApiResponse($result);
        //        return $this->json($responseDTO);
    }
}
