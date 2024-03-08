<?php

namespace Tests\Unit\Application\Usecase\Address\GetAddressesByClient;

use App\Application\UseCase\Address\GetAddressesByClient\Dto\GetImagesByProductInputDto;
use App\Application\UseCase\Address\GetAddressesByClient\GetImagesByProduct;
//use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Address;
use App\Domain\Repository\AddressRepositoryInterface;
use App\Domain\Repository\CountryRepositoryInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetAddressesByClientTest extends TestCase
{
    private const ADDRESS_DATA = [
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

    private GetImagesByProduct $useCase;

    private readonly AddressRepositoryInterface|MockObject $addressRepository;
    private readonly CountryRepositoryInterface|MockObject $countryRepository;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->addressRepository = $this->createMock(AddressRepositoryInterface::class);
        $this->countryRepository = $this->createMock(CountryRepositoryInterface::class);
        $this->useCase = new GetImagesByProduct($this->addressRepository);
    }

    public function testGetAddressesByClient(): void
    {
        $address = Address::create(
            self::ADDRESS_DATA['name'],
            self::ADDRESS_DATA['number'],
            self::ADDRESS_DATA['street'],
            self::ADDRESS_DATA['street2'],
            self::ADDRESS_DATA['department'],
            self::ADDRESS_DATA['neighborhood'],
            self::ADDRESS_DATA['city'],
            self::ADDRESS_DATA['zipCode'],
            $this->countryRepository->findOneByIdOrFail(self::ADDRESS_DATA['country']),
        );

        $inputDto = GetImagesByProductInputDto::create($address->getId());

        $this->addressRepository
            ->expects($this->once())
            ->method('findAllByClientOrFail')
            ->with($inputDto->id)
            ->willReturn([]);

        $responseDTO = $this->useCase->handle($inputDto);

        self::assertEmpty($responseDTO);
    }
//
//    public function testGetAddressesByClientException(): void
//    {
//        $inputDto = GetAddressesByClientInputDto::create(self::ADDRESS_DATA['id']);
//
//        $this->addressRepository
//            ->expects($this->once())
//            ->method('findAllByClientOrFail')
//            ->with($inputDto->id)
//            ->willThrowException(ResourceNotFoundException::createFromClassAndId(Address::class, $inputDto->id));
//
//        self::expectException(ResourceNotFoundException::class);
//
//        $this->useCase->handle($inputDto);
//    }
}