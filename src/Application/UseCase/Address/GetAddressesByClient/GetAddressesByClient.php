<?php

declare(strict_types=1);

namespace App\Application\UseCase\Address\GetAddressesByClient;

use App\Application\UseCase\Address\GetAddressesByClient\Dto\GetAddressesByClientInputDto;
use App\Application\UseCase\Address\GetAddressesByClient\Dto\GetAddressesByClientOutputDto;
use App\Domain\Repository\AddressRepositoryInterface;

readonly class GetAddressesByClient
{
    public function __construct(
        private AddressRepositoryInterface $addressRepository,
    ) {}

    public function handle(GetAddressesByClientInputDto $dto): array
    {
        return GetAddressesByClientOutputDto::create($this->addressRepository->findAllByClientOrFail($dto->id));
    }
}
