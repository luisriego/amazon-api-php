<?php

namespace App\Adapter\Framework\Http\Controller\OrderItem;

use App\Adapter\Framework\Http\Dto\OrderItem\CreateOrderItemRequestDto;
use App\Application\UseCase\OrderItem\CreateOrderItem\CreateOrderItem;
use App\Application\UseCase\OrderItem\CreateOrderItem\Dto\CreateOrderItemInputDto;
use App\Domain\Model\OrderItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateOrderItemController extends AbstractController
{
    public function __construct(private readonly CreateOrderItem $createOrderItem)
    {
    }

    #[Route('api/create-order-item', name: 'api_order_item_create', methods: ['POST'])]
    public function __invoke(CreateOrderItemRequestDto $requestDto): Response
    {
        $this->denyAccessUnlessGranted(
            OrderItem::MIN_ROLE,
            null,
            sprintf(
                'Only user with [%s] or greater can create this type of resource.',
                OrderItem::MIN_ROLE),
        );

        $responseDto = $this->createOrderItem->handle(
            CreateOrderItemInputDto::create(
                $requestDto->price,
                $requestDto->quantity,
                $requestDto->product,
                $requestDto->order,
            )
        );

        return $this->json(['orderItemId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
