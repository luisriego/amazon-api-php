<?php

declare(strict_types=1);

namespace App\Application\UseCase\Review\CreateReview\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

final class CreateReviewInputDto
{
    use AssertNotNullTrait;

    private const ARGS = [
        'name',
        'comment',
        'rating',
        'product',
    ];

    public function __construct(
        public readonly ?string $name,
        public readonly string $comment,
        public readonly string $rating,
        public readonly string $product,
    ) {
        $this->assertNotNull(
            self::ARGS,
            [$this->name, $this->comment, $this->rating, $this->product],
        );
    }

    public static function create(
        ?string $name,
        ?string $comment,
        ?string $rating,
        ?string $product,
    ): self {
        return new CreateReviewInputDto($name, $comment, $rating, $product);
    }
}
