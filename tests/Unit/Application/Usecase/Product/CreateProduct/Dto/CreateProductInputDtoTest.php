<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Usecase\Product\CreateProduct\Dto;

use App\Application\UseCase\Product\CreateProduct\Dto\CreateProductInputDto;
use PHPUnit\Framework\TestCase;

class CreateProductInputDtoTest extends TestCase
{
    private const VALUES = [
        'sku' => 'Ken: 9780688046590',
        'name' => 'The Pillars of the Earth',
        'description' => 'A wonderfully history',
        'price' => '3900',
        'category' => '9f9422af-cb8a-47a1-8764-680b93d637f6',
        'user' => 'efc3eedf-ad24-4990-83b7-ac36e256752c',
    ];

    public function testCreate(): void
    {
        $dto = CreateProductInputDto::create(
            self::VALUES['sku'],
            self::VALUES['name'],
            self::VALUES['description'],
            self::VALUES['price'],
            self::VALUES['category'],
            self::VALUES['user'],
        );

        self::assertInstanceOf(CreateProductInputDto::class, $dto);

        self::assertEquals(self::VALUES['name'], $dto->name);
    }

//    public function testAgeHasToBeAtLeast18(): void
//    {
//        self::expectException(InvalidArgumentException::class);
//        self::expectExceptionMessage('Age has to be at least 18');
//
//        CreateProductInputDTO::create(
//            self::VALUES['name'],
//            self::VALUES['email'],
//            self::VALUES['password'],
//        );
//    }
}