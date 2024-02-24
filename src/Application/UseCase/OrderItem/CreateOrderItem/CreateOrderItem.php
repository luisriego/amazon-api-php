<?php

namespace App\Application\UseCase\OrderItem\CreateOrderItem;

use App\Application\UseCase\OrderItem\CreateOrderItem\Dto\CreateOrderItemInputDto;
use App\Application\UseCase\OrderItem\CreateOrderItem\Dto\CreateOrderItemOutputDto;
use App\Domain\Model\OrderItem;
use App\Domain\Model\User;
use App\Domain\Repository\OrderItemRepositoryInterface;
use App\Domain\Repository\OrderRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security;

class CreateOrderItem
{
    public function __construct(
        private readonly OrderItemRepositoryInterface $orderItemRepository,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly Security $security,
    ) { }

    public function handle(CreateOrderItemInputDto $inputDto): CreateOrderItemOutputDto
    {
        /** @var User $user */
        $authenticatedUser = $this->security->getUser();

        $product = $this->productRepository->findOneByIdOrFail($inputDto->product);

        $order = $this->orderRepository->findOneByIdOrFail($inputDto->order);

        $orderItem = OrderItem::create(
            (int)$inputDto->price,
            (int)$inputDto->quantity,
            $product,
            $order,
            $authenticatedUser
        );

        $this->orderItemRepository->add($orderItem, true);

        return new CreateOrderItemOutputDto($orderItem->getId());
    }
}