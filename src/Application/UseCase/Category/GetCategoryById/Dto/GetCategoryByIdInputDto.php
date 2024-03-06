<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\GetCategoryById\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

final class GetCategoryByIdInputDto
{
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    private function __construct(
        public readonly ?string $id,
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);
    }

    public static function create(?string $id): self
    {
        return new GetCategoryByIdInputDto($id);
    }
}
