<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\CreateCategory\Dto;

use App\Domain\Validation\Traits\AssertLengthRangeTrait;
use App\Domain\Validation\Traits\AssertNotNullTrait;

final class CreateCategoryInputDto
{
    use AssertNotNullTrait;
    use AssertLengthRangeTrait;

    private const ARGS = [
        'name',
    ];

    private function __construct(public readonly string $name)
    {
        $this->assertNotNull(self::ARGS, [$this->name]);
        $this->assertValueRangeLength($this->name, 3, 50);
    }

    public static function create(?string $name): self
    {
        return new CreateCategoryInputDto($name);
    }
}
