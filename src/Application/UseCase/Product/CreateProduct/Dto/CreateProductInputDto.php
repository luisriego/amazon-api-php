<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\CreateProduct\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

class CreateProductInputDto
{
    use AssertNotNullTrait;

    private const ARGS = [
        'name',
        'description',
        'price',
    ];

    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $price,
        public readonly ?string $category,
    ) {
        $this->assertNotNull(self::ARGS, [$this->name, $this->description, $this->price]);
    }

    public static function create(
        ?string $name,
        ?string $description,
        ?string $price,
        ?string $category,
    ): self {
        return new CreateProductInputDto($name, $description, $price, $category);
    }
}
