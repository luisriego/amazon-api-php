<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Usecase\Category\CreateCategory\Dto;

use App\Application\UseCase\Category\CreateCategory\Dto\CreateCategoryInputDto;
use PHPUnit\Framework\TestCase;

class CreateCategoryInputDtoTest extends TestCase
{
    private const VALUES = [
        'name' => 'Books',
    ];

    public function testCreate(): void
    {
        $dto = CreateCategoryInputDto::create(
            self::VALUES['name'],
        );

        self::assertInstanceOf(CreateCategoryInputDto::class, $dto);

        self::assertEquals(self::VALUES['name'], $dto->name);
    }

//    public function testAgeHasToBeAtLeast18(): void
//    {
//        self::expectException(InvalidArgumentException::class);
//        self::expectExceptionMessage('Age has to be at least 18');
//
//        CreateCategoryInputDTO::create(
//            self::VALUES['name'],
//            self::VALUES['email'],
//            self::VALUES['password'],
//        );
//    }
}