<?php

namespace App\Adapter\Framework\Http\Controller\Order;

use App\Adapter\Framework\Http\Dto\Order\CreateOrderRequestDto;
use App\Application\UseCase\Order\CreateOrder\CreateOrder;
use App\Application\UseCase\Order\CreateOrder\Dto\CreateOrderInputDto;
use App\Domain\Model\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateOrderController extends AbstractController
{
    public function __construct(private readonly CreateOrder $createOrder)
    {
    }

    #[Route('/api/create-order', 'api_order_create', methods: ['POST'])]
    public function __invoke(CreateOrderRequestDto $requestDto): Response
    {
        $this->denyAccessUnlessGranted(
            Order::MIN_ROLE,
            null,
            sprintf('Only user with [%s] or greater can create this type of resource.', Order::MIN_ROLE),
        );

        $responseDto = $this->createOrder->handle(
            CreateOrderInputDto::create(
                $requestDto->owner,
                $requestDto->orderAddress,
            )
        );

        return $this->json(['orderId' => $responseDto->id], Response::HTTP_CREATED);
    }

}