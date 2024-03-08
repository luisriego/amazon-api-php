<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Product;

use App\Adapter\Framework\Http\Dto\Product\SwitchAdProductRequestDto;
use App\Application\UseCase\Product\SwitchAdProduct\Dto\SwitchAdProductInputDto;
use App\Application\UseCase\Product\SwitchAdProduct\SwitchAdProduct;
use App\Domain\Exception\Security\CreateAccessDeniedException;
use App\Domain\Model\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SwitchAdProductController extends AbstractController
{
    public function __construct(private readonly SwitchAdProduct $SwitchAdProductService) {}

    #[Route('api/product/stop-ad-product/{id}', name: 'api_stop_ad_product', methods: ['PATCH'])]
    public function __invoke(SwitchAdProductRequestDto $dto): Response
    {
        if (!$this->isGranted(Product::MIN_ROLE)) {
            throw CreateAccessDeniedException::deniedByUnauthorizedRoleFromClassAndRole('Address', Product::MIN_ROLE);
        }

        $this->SwitchAdProductService->handle(SwitchAdProductInputDto::create($dto->id));

        return $this->json([], Response::HTTP_OK);
    }
}
