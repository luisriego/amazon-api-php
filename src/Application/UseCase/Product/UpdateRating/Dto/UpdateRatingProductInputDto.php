<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\UpdateRating\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

class UpdateRatingProductInputDto
{
    use AssertNotNullTrait;

    private const ARGS = ['id', 'rating'];

    public function __construct(
        public readonly ?string $id,
        public readonly ?int $rating,
    ) {
        $this->assertNotNull(self::ARGS, [$this->id, $this->rating]);
    }

    public static function create(
        ?string $id,
        ?int $rating,
    ): self {
        return new static(
            $id,
            $rating,
        );
    }
}
