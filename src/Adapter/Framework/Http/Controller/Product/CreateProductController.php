<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Product;

use App\Adapter\Framework\Http\Dto\Product\CreateProductRequestDto;
use App\Application\UseCase\Product\CreateProduct\CreateProduct;
use App\Application\UseCase\Product\CreateProduct\Dto\CreateProductInputDto;
use App\Domain\Model\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use function sprintf;

class CreateProductController extends AbstractController
{
    public function __construct(private readonly CreateProduct $createProductService) {}

    #[Route('/api/create-product', 'api_product_create', methods: ['POST'])]
    public function invoke(CreateProductRequestDto $requestDto): Response
    {
        $this->denyAccessUnlessGranted(
            Product::MIN_ROLE,
            null,
            sprintf('Only user with [%s] or greater can create this type of resource.', Product::MIN_ROLE),
        );

        $responseDto = $this->createProductService->handle(
            CreateProductInputDto::create(
                $requestDto->name,
                $requestDto->description,
                $requestDto->price,
                $requestDto->category,
            ),
        );

        return $this->json(['productId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
