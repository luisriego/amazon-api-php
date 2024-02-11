<?php

declare(strict_types=1);

namespace App\Application\UseCase\Address\CreateAddress;

use App\Application\UseCase\Address\CreateAddress\Dto\CreateAddressInputDto;
use App\Application\UseCase\Address\CreateAddress\Dto\CreateAddressOutputDto;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Address;
use App\Domain\Model\Country;
use App\Domain\Model\User;
use App\Domain\Repository\AddressRepositoryInterface;
use App\Domain\Repository\CountryRepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security;

readonly class CreateAddress
{
    public function __construct(
        private AddressRepositoryInterface $addressRepository,
        private CountryRepositoryInterface $countryRepository,
        private Security $security,
    ) {}

    public function handle(CreateAddressInputDto $addressInputDto): CreateAddressOutputDto
    {
        /** @var User $authenticatedUser */
        $authenticatedUser = $this->security->getUser();

        if (null === $country = $this->countryRepository->findOneLikeNameOrFail($addressInputDto->country)) {
            throw ResourceNotFoundException::createFromClassAndName(Country::class, $addressInputDto->country);
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
            $authenticatedUser,
        );

        $this->addressRepository->add($address, true);

        return new CreateAddressOutputDto($address->getId());
    }
}
