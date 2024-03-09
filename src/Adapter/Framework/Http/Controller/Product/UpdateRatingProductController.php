<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Product;

use App\Adapter\Framework\Http\Dto\Product\UpdateRatingProductRequestDto;
use App\Application\UseCase\Product\UpdateRating\Dto\UpdateRatingProductInputDto;
use App\Application\UseCase\Product\UpdateRating\UpdateRatingProduct;
use App\Domain\Exception\Security\CreateAccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UpdateRatingProductController extends AbstractController
{
    public function __construct(private readonly UpdateRatingProduct $updateRatingProductService) {}

    #[Route('/api/product/update-rating/{id}', name: 'api_product_update_rating', methods: ['PATCH'])]
    public function __invoke(UpdateRatingProductRequestDto $request, string $id): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw CreateAccessDeniedException::deniedByUnauthorizedRoleFromClassAndRole(
                'Product',
                'ROLE_USER',
            );
        }

        $inputDto = UpdateRatingProductInputDto::create(
            $id,
            $request->rating,
        );

        $responseDto = $this->updateRatingProductService->handle($inputDto);

        return $this->json($responseDto->productData);
    }
}
