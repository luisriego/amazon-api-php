<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Usecase\User\CreateUser\Dto;

use App\Application\UseCase\User\CreateUser\Dto\CreateUserInputDto;
use App\Domain\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CreateUserInputDtoTest extends TestCase
{
    private const VALUES = [
        'name' => 'Peter',
        'email' => 'peter@api.com',
        'password' => 'fake123',
    ];

    public function testCreate(): void
    {
        $dto = CreateUserInputDto::create(
            self::VALUES['name'],
            self::VALUES['email'],
            self::VALUES['password'],
        );

        self::assertInstanceOf(CreateUserInputDto::class, $dto);

        self::assertEquals(self::VALUES['name'], $dto->name);
        self::assertEquals(self::VALUES['email'], $dto->email);
        self::assertEquals(self::VALUES['password'], $dto->password);
    }

//    public function testAgeHasToBeAtLeast18(): void
//    {
//        self::expectException(InvalidArgumentException::class);
//        self::expectExceptionMessage('Age has to be at least 18');
//
//        CreateUserInputDTO::create(
//            self::VALUES['name'],
//            self::VALUES['email'],
//            self::VALUES['password'],
//        );
//    }
}