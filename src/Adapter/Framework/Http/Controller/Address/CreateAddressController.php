<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Address;

use App\Adapter\Framework\Http\Dto\Address\CreateCategoryRequestDto;
use App\Application\UseCase\Address\CreateAddress\CreateAddress;
use App\Application\UseCase\Address\CreateAddress\Dto\CreateAddressInputDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateAddressController extends AbstractController
{
    public function __construct(private readonly CreateAddress $createAddressService) {}

    #[Route('/api/create-address', 'api_address_create', methods: ['POST'])]
    public function invoke(CreateCategoryRequestDto $requestDto): Response
    {
        $responseDto = $this->createAddressService->handler(
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
            ),
        );

        return $this->json(['addressId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
