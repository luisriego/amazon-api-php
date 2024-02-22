<?php

declare(strict_types=1);

namespace App\Application\UseCase\Review\CreateReview\Dto;

readonly class CreateReviewOutputDto
{
    public function __construct(public string $id) {}
}
