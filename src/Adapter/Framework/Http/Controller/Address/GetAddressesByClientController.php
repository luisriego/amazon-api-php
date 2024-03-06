<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Address;

use App\Adapter\Framework\Http\Dto\Address\GetAddressesByClientRequestDto;
use App\Adapter\Framework\Http\Response\ApiResponse;
use App\Application\UseCase\Address\GetAddressesByClient\Dto\GetAddressesByClientInputDto;
use App\Application\UseCase\Address\GetAddressesByClient\GetAddressesByClient;
use App\Domain\Model\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

use function array_map;

class GetAddressesByClientController extends AbstractController
{
    public function __construct(
        private readonly GetAddressesByClient $useCase,
    ) {}

    #[Route('/api/address/get-addresses-by-client/{id}', name: 'get_addresses_by_client_id', methods: ['GET'])]
    public function __invoke(GetAddressesByClientRequestDto $request): ApiResponse
    {
        $responseDTO = $this->useCase->handle(GetAddressesByClientInputDto::create($request->id));

        $result = array_map(function (Address $address): array {
            return $address->toArray();
        }, $responseDTO);

        return new ApiResponse($result);
        //        return $this->json($responseDTO);
    }
}
