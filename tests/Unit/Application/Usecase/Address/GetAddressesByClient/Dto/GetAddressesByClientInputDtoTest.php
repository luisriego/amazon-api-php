<?php

namespace Tests\Unit\Application\Usecase\Address\GetAddressesByClient\Dto;

use App\Application\UseCase\Address\GetAddressesByClient\Dto\GetImagesByProductInputDto;
use App\Domain\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GetAddressesByClientInputDtoTest extends TestCase
{
    private const CLIENT_ID = '9b5c0b1f-09bf-4fed-acc9-fcaafc933a19';

    public function testGetAddressesByClientInputDTO(): void
    {
        $dto = GetImagesByProductInputDto::create(self::CLIENT_ID);

        self::assertInstanceOf(GetImagesByProductInputDto::class, $dto);
        self::assertEquals(self::CLIENT_ID, $dto->id);
    }

    public function testGetAddressesByClientWithNullValue(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid arguments [id]');

        GetImagesByProductInputDto::create(null);
    }
}