<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Product;

use App\Adapter\Framework\Http\Dto\Product\UpdateStockProductRequestDto;
use App\Application\UseCase\Product\UpdateStockProduct\Dto\UpdateStockProductInputDto;
use App\Application\UseCase\Product\UpdateStockProduct\UpdateStockProduct;
use App\Domain\Exception\Security\CreateAccessDeniedException;
use App\Domain\Model\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UpdateStockProductController extends AbstractController
{
    public function __construct(private readonly UpdateStockProduct $updateStockProductService) {}

    #[Route('/api/product/update-stock/{id}', name: 'api_product_update_stock', methods: ['PATCH'])]
    public function __invoke(UpdateStockProductRequestDto $request, string $id): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw CreateAccessDeniedException::deniedByUnauthorizedRoleFromClassAndRole(
                'Product',
                Product::MIN_ROLE,
            );
        }

        $inputDto = UpdateStockProductInputDto::create(
            $id,
            $request->stock,
        );

        $responseDto = $this->updateStockProductService->handle($inputDto);

        return $this->json($responseDto->productData);
    }
}
