<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\UpdateProduct\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;
use App\Domain\Validation\Traits\AssertRatingValueTrait;

class UpdateProductInputDto
{
    use AssertNotNullTrait;
    use AssertRatingValueTrait;

    private const ARGS = ['id'];

    public function __construct(
        public readonly ?string $id,
        public readonly ?string $name,
        public readonly ?string $description,
        public readonly ?int $price,
        public readonly ?int $rating,
        public readonly array $paramsToUpdate,
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);
        $this->assertRatingValue($this->rating);
    }

    public static function create(
        ?string $id,
        ?string $name,
        ?string $description,
        ?int $price,
        ?int $rating,
        array $paramsToUpdate,
    ): self {
        return new static(
            $id,
            $name,
            $description,
            $price,
            $rating,
            $paramsToUpdate);
    }
}
