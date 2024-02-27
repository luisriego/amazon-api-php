<?php

declare(strict_types=1);

namespace App\Application\UseCase\Address\CreateAddress;

use App\Application\UseCase\Address\CreateAddress\Dto\CreateAddressInputDto;
use App\Application\UseCase\Address\CreateAddress\Dto\CreateAddressOutputDto;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Exception\Security\CreateResourceDeniedException;
use App\Domain\Model\Address;
use App\Domain\Model\Country;
use App\Domain\Model\User;
use App\Domain\Repository\AddressRepositoryInterface;
use App\Domain\Repository\CountryRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security;

readonly class CreateAddress
{
    public function __construct(
        private AddressRepositoryInterface $addressRepository,
        private CountryRepositoryInterface $countryRepository,
        private UserRepositoryInterface $userRepository,
    ) {}

    public function handle(CreateAddressInputDto $addressInputDto): CreateAddressOutputDto
    {
        if (null === $owner = $this->userRepository->findOneByIdOrFail($addressInputDto->owner)) {
            throw ResourceNotFoundException::createFromClassAndId(User::class, $addressInputDto->owner);
        }

        if (null === $country = $this->countryRepository->findOneByIdOrFail($addressInputDto->country)) {
            throw ResourceNotFoundException::createFromClassAndIntId(Country::class, $addressInputDto->country);
        }

        $address = Address::create(
            $addressInputDto->name,
            $addressInputDto->number,
            $addressInputDto->street,
            $addressInputDto->street2,
            $addressInputDto->department,
            $addressInputDto->neighborhood,
            $addressInputDto->city,
            $addressInputDto->zipCode,
            $country,
            $owner,
        );

//        if (!$address->isOwnedBy($authenticatedUser)) {
//            throw CreateResourceDeniedException::deniedByNotBeTheOwner();
//        }

        $this->addressRepository->add($address, true);

        return new CreateAddressOutputDto($address->getId());
    }
}
