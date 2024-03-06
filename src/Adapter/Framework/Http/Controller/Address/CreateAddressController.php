<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Address;

use App\Adapter\Framework\Http\Dto\Address\CreateAddressRequestDto;
use App\Application\UseCase\Address\CreateAddress\CreateAddress;
use App\Application\UseCase\Address\CreateAddress\Dto\CreateAddressInputDto;
use App\Domain\Model\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use function sprintf;

class CreateAddressController extends AbstractController
{
    public function __construct(private readonly CreateAddress $createAddressService) {}

    #[Route('/api/address/create', 'api_address_create', methods: ['POST'])]
    public function invoke(CreateAddressRequestDto $requestDto): Response
    {
        $this->denyAccessUnlessGranted(
            Address::MIN_ROLE,
            null,
            sprintf(
                'Only user with [%s] or greater can create this type of resource.',
                Address::MIN_ROLE,
            ),
        );

        $responseDto = $this->createAddressService->handle(
            CreateAddressInputDto::create(
                $requestDto->name,
                $requestDto->number,
                $requestDto->street,
                $requestDto->street2,
                $requestDto->department,
                $requestDto->neighborhood,
                $requestDto->city,
                $requestDto->zipCode,
                $requestDto->country,
                $requestDto->owner,
            ),
        );

        return $this->json(['addressId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
