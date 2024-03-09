<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\UpdateProduct\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

class UpdateProductInputDto
{
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    public function __construct(
        public readonly ?string $id,
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly ?int $price,
        public readonly array $paramsToUpdate,
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);
    }

    public static function create(
        ?string $id,
        ?string $name,
        ?string $description,
        ?int $price,
        array $paramsToUpdate,
    ): self {
        return new static(
            $id,
            $name,
            $description,
            $price,
            $paramsToUpdate);
    }
}
