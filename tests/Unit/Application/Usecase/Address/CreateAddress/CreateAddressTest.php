<?php

namespace Tests\Unit\Application\Usecase\Address\CreateAddress;

use App\Application\UseCase\Address\CreateAddress\CreateAddress;
use App\Application\UseCase\Address\CreateAddress\Dto\CreateAddressInputDto;
use App\Application\UseCase\Address\CreateAddress\Dto\CreateAddressOutputDto;
use App\Domain\Model\Address;
use App\Domain\Repository\AddressRepositoryInterface;
use App\Domain\Repository\CountryRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateAddressTest extends TestCase
{
    private const VALUES = [
        'name' => 'casa',
        'number' => '376',
        'street' => 'Cristina street',
        'street2' => 'esq. Boa Esperanza',
        'department' => '401',
        'neighborhood' => 'Sion',
        'city' => 'Belo Horizonte',
        'zipCode' => '30310-800',
        'country' => 32,
        'owner' => 'efc3eedf-ad24-4990-83b7-ac36e256752c',
    ];

    private readonly AddressRepositoryInterface|MockObject $addressRepository;
    private readonly CreateAddress $useCase;


    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->addressRepository = $this->createMock(AddressRepositoryInterface::class);
        $countryRepository = $this->createMock(CountryRepositoryInterface::class);
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->useCase = new CreateAddress($this->addressRepository, $countryRepository, $userRepository);
    }

    public function testCreateAddress(): void
    {
        $dto = CreateAddressInputDto::create(
            self::VALUES['name'],
            self::VALUES['number'],
            self::VALUES['street'],
            self::VALUES['street2'],
            self::VALUES['department'],
            self::VALUES['neighborhood'],
            self::VALUES['city'],
            self::VALUES['zipCode'],
            self::VALUES['country'],
            self::VALUES['owner'],
        );

        $this->addressRepository
            ->expects($this->once())
            ->method('add')
            ->with(
                $this->callback(function (Address $address): bool {
                    return $address->getStreet() === self::VALUES['street'];
                })
            );

        $responseDTO = $this->useCase->handle($dto);

        self::assertInstanceOf(CreateAddressOutputDto::class, $responseDTO);
    }
}