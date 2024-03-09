<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Product;

use App\Adapter\Framework\Http\Dto\Product\UpdateProductRequestDto;
use App\Application\UseCase\Product\UpdateProduct\Dto\UpdateProductInputDto;
use App\Application\UseCase\Product\UpdateProduct\UpdateProduct;
use App\Domain\Exception\Security\CreateAccessDeniedException;
use App\Domain\Model\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UpdateProductController extends AbstractController
{
    public function __construct(private readonly UpdateProduct $updateProductService) {}

    #[Route('/api/product/update/{id}', name: 'api_product_update', methods: ['PATCH'])]
    public function __invoke(UpdateProductRequestDto $request, string $id): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw CreateAccessDeniedException::deniedByUnauthorizedRoleFromClassAndRole(
                'Product',
                Product::MIN_ROLE,
            );
        }

        $inputDto = UpdateProductInputDto::create(
            $id,
            $request->name,
            $request->description,
            $request->price,
            $request->keys,
        );

        $responseDto = $this->updateProductService->handle($inputDto);

        return $this->json($responseDto->productData);
    }
}
