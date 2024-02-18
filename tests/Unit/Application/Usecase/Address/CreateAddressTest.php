<?php

namespace Tests\Unit\Application\Usecase\Address;

use App\Application\UseCase\Address\CreateAddress\CreateAddress;
use App\Application\UseCase\Address\CreateAddress\Dto\CreateImageInputDto;
use App\Domain\Model\Address;
use App\Domain\Repository\AddressRepositoryInterface;
use App\Domain\Repository\CountryRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\SecurityBundle\Security;

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
//        'country' => 'Brasil',
    ];

    private readonly AddressRepositoryInterface|MockObject $addressRepository;
    private readonly CountryRepositoryInterface|MockObject $countryRepository;
    private readonly Security|MockObject $security;
    private readonly CreateAddress $useCase;


    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->addressRepository = $this->createMock(AddressRepositoryInterface::class);
        $this->countryRepository = $this->createMock(CountryRepositoryInterface::class);
        $this->security = $this->createMock(Security::class);
        $this->useCase = new CreateAddress($this->addressRepository, $this->countryRepository, $this->security);
    }

    public function testCreateAddress(): void
    {
        $dto = CreateImageInputDto::create(
            self::VALUES['name'],
            self::VALUES['number'],
            self::VALUES['street'],
            self::VALUES['street2'],
            self::VALUES['department'],
            self::VALUES['neighborhood'],
            self::VALUES['city'],
            self::VALUES['zipCode'],
            self::VALUES['country'],
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