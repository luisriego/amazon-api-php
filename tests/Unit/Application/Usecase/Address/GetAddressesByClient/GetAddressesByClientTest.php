<?php

namespace Tests\Unit\Application\Usecase\Address\GetAddressesByClient;

use App\Application\UseCase\Address\GetAddressesByClient\Dto\GetAddressesByClientInputDto;
use App\Application\UseCase\Address\GetAddressesByClient\GetAddressesByClient;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Address;
use App\Domain\Repository\AddressRepositoryInterface;
use App\Domain\Repository\CountryRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetAddressesByClientTest extends TestCase
{
    private const CONDO_DATA = [
        'id' => '9b5c0b1f-09bf-4fed-acc9-fcaafc933a19',
        'name' => 'casa',
        'number' => '376',
        'street' => 'Cristina street',
        'street2' => 'esq. Boa Esperanza',
        'department' => '401',
        'neighborhood' => 'Sion',
        'city' => 'Belo Horizonte',
        'zipCode' => '30310-800',
        'country' => 32,
    ];

    private GetAddressesByClient $useCase;

    private readonly AddressRepositoryInterface|MockObject $addressRepository;
    private readonly CountryRepositoryInterface|MockObject $countryRepository;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->addressRepository = $this->createMock(AddressRepositoryInterface::class);
        $this->countryRepository = $this->createMock(CountryRepositoryInterface::class);
        $this->useCase = new GetAddressesByClient($this->addressRepository);
    }

    public function testGetAddressesByClient(): void
    {
        $address = Address::create(
            self::CONDO_DATA['name'],
            self::CONDO_DATA['number'],
            self::CONDO_DATA['street'],
            self::CONDO_DATA['street2'],
            self::CONDO_DATA['department'],
            self::CONDO_DATA['neighborhood'],
            self::CONDO_DATA['city'],
            self::CONDO_DATA['zipCode'],
            $this->countryRepository->findOneByIdOrFail(self::CONDO_DATA['country']),
        );

        $inputDto = GetAddressesByClientInputDto::create($address->getId());

        $this->addressRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($inputDto->id)
            ->willReturn($address);

        $responseDTO = $this->useCase->handle($inputDto);

        self::assertInstanceOf(GetAddressesByClientInputDto::class, $responseDTO);

//        self::assertEquals(self::CONDO_DATA['id'], $responseDTO->id);
    }

    public function testGetAddressesByClientException(): void
    {
        $inputDto = GetAddressesByClientInputDto::create(self::CONDO_DATA['id']);

        $this->addressRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($inputDto->id)
            ->willThrowException(ResourceNotFoundException::createFromClassAndId(Address::class, $inputDto->id));

        self::expectException(ResourceNotFoundException::class);

        $this->useCase->handle($inputDto);
    }
}