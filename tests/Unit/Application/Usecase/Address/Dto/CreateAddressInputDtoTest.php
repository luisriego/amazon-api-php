<?php

namespace Tests\Unit\Application\Usecase\Address\Dto;

use App\Application\UseCase\Address\CreateAddress\Dto\CreateImageInputDto;
use PHPUnit\Framework\TestCase;

class CreateAddressInputDtoTest extends TestCase
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
        'country' => 'Brasil',
    ];

    public function testCreate(): void
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

        self::assertInstanceOf(CreateImageInputDto::class, $dto);

        self::assertEquals(self::VALUES['name'], $dto->name);
        self::assertEquals(self::VALUES['number'], $dto->number);
        self::assertEquals(self::VALUES['street'], $dto->street);
        self::assertEquals(self::VALUES['street2'], $dto->street2);
        self::assertEquals(self::VALUES['department'], $dto->department);
        self::assertEquals(self::VALUES['neighborhood'], $dto->neighborhood);
        self::assertEquals(self::VALUES['city'], $dto->city);
        self::assertEquals(self::VALUES['zipCode'], $dto->zipCode);
        self::assertEquals(self::VALUES['country'], $dto->country);
    }
}