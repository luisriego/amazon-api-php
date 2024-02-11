<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

final class CreateCategoryInputDto
{
    use AssertNotNullTrait;

    private const ARGS = [
        'name',
    ];

    private function __construct(public readonly string $name)
    {
        $this->assertNotNull(self::ARGS, [$this->name]);
    }

    public static function create(?string $name): self
    {
        return new CreateCategoryInputDto($name);
    }
}
