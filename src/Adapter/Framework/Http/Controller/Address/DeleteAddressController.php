<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Address;

use App\Adapter\Framework\Http\Dto\Address\DeleteAddressRequestDto;
use App\Application\UseCase\Address\DeleteAddress\DeleteAddress;
use App\Application\UseCase\Address\DeleteAddress\Dto\DeleteAddressInputDto;
use App\Domain\Exception\Security\CreateAccessDeniedException;
use App\Domain\Model\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeleteAddressController extends AbstractController
{
    public function __construct(private readonly DeleteAddress $deleteAddressService) {}

    #[Route('api/address/delete/{id}', name: 'api_address_delete', methods: ['DELETE'])]
    public function __invoke(DeleteAddressRequestDto $dto): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw CreateAccessDeniedException::deniedByUnauthorizedRoleFromClassAndRole('Address', Address::MIN_ROLE);
        }

        $this->deleteAddressService->handle(DeleteAddressInputDto::create($dto->id));

        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
