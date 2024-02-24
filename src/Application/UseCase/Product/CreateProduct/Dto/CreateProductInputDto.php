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
        'category',
        'user'
    ];

    public function __construct(
        public readonly string $sku,
        public readonly string $name,
        public readonly string $description,
        public readonly string $price,
        public readonly ?string $category,
        public readonly ?string $user,
    ) {
        $this->assertNotNull(
            self::ARGS,
            [
                $this->name,
                $this->description,
                $this->price,
                $this->category,
                $this->user
            ]
        );
    }

    public static function create(
        ?string $sku,
        ?string $name,
        ?string $description,
        ?string $price,
        ?string $category,
        ?string $user,
    ): self {
        return new CreateProductInputDto($sku, $name, $description, $price, $category, $user);
    }
}
