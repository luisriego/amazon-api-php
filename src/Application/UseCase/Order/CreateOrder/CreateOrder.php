<?php


namespace App\Application\UseCase\Order\CreateOrder;

use App\Application\UseCase\Order\CreateOrder\Dto\CreateOrderInputDto;
use App\Application\UseCase\Order\CreateOrder\Dto\CreateOrderOutputDto;
use App\Domain\Model\Order;
use App\Domain\Model\User;
use App\Domain\Repository\AddressRepositoryInterface;
use App\Domain\Repository\OrderRepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Routing\Attribute\Route;

class CreateOrder
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly AddressRepositoryInterface $addressRepository,
        private readonly Security $security,
    )
    { }

    #[Route('/api/create-order', 'api_create_order', methods: ['POST'])]
    public function handle(CreateOrderInputDto $inputDto): CreateOrderOutputDto
    {
        /** @var User $user */
        $authenticatedUser = $this->security->getUser();

        $orderAddress = $this->addressRepository->findOneByIdOrFail($inputDto->orderAddress);

        $order = Order::create($authenticatedUser, $orderAddress);

        $this->orderRepository->add($order, true);

        return new CreateOrderOutputDto($order->getId());
    }
}