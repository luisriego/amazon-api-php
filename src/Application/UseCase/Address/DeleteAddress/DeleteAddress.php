<?php

declare(strict_types=1);

namespace App\Application\UseCase\Address\DeleteAddress;

use App\Application\UseCase\Address\DeleteAddress\Dto\DeleteAddressInputDto;
use App\Domain\Exception\UnableToDeleteResourceException;
use App\Domain\Model\Address;
use App\Domain\Repository\AddressRepositoryInterface;

use function count;

readonly class DeleteAddress
{
    public function __construct(
        private AddressRepositoryInterface $addressRepository,
    ) {}

    public function handle(DeleteAddressInputDto $dto): void
    {
        $addressToDelete = $this->addressRepository->findOneByIdOrFail($dto->id);

        $addressesByUser = $this->addressRepository->findAllByClientOrFail($addressToDelete->getOwner()->getId());

        if (count($addressesByUser) <= 1) {
            throw UnableToDeleteResourceException::createFromClassAndId(Address::class, $dto->id);
        }

        $this->addressRepository->remove($addressToDelete, true);
    }
}
