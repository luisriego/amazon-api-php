<?php

declare(strict_types=1);

namespace App\Application\UseCase\Order\CreateOrder;

use App\Application\UseCase\Order\CreateOrder\Dto\CreateOrderInputDto;
use App\Application\UseCase\Order\CreateOrder\Dto\CreateOrderOutputDto;
use App\Domain\Model\Order;
use App\Domain\Repository\AddressRepositoryInterface;
use App\Domain\Repository\OrderRepositoryInterface;

readonly class CreateOrder
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private AddressRepositoryInterface $addressRepository,
    ) {}

    public function handle(CreateOrderInputDto $inputDto): CreateOrderOutputDto
    {
        $orderAddress = $this->addressRepository->findOneByIdOrFail($inputDto->orderAddress);

        $order = Order::create($orderAddress);

        $this->orderRepository->add($order, true);

        return new CreateOrderOutputDto($order->getId());
    }
}
