<?php


namespace App\Application\UseCase\Orden\CreateOrden;

use App\Application\UseCase\Orden\CreateOrden\Dto\CreateOrdenInputDto;
use App\Application\UseCase\Orden\CreateOrden\Dto\CreateOrdenOutputDto;
use App\Domain\Model\Orden;
use App\Domain\Model\User;
use App\Domain\Repository\AddressRepositoryInterface;
use App\Domain\Repository\OrdenRepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Routing\Attribute\Route;

class CreateOrden
{
    public function __construct(
        private readonly OrdenRepositoryInterface $ordenRepository,
        private readonly AddressRepositoryInterface $addressRepository,
        private readonly Security $security,
    )
    { }

    #[Route('/api/create-orden', 'api_create_orden', methods: ['POST'])]
    public function handle(CreateOrdenInputDto $inputDto): CreateOrdenOutputDto
    {
        /** @var User $user */
        $authenticatedUser = $this->security->getUser();

        $orderAddress = $this->addressRepository->findOneByIdOrFail($inputDto->orderAddress);

        $orden = Orden::create($authenticatedUser, $orderAddress);

        $this->ordenRepository->add($orden, true);

        return new CreateOrdenOutputDto($orden->getId());
    }
}