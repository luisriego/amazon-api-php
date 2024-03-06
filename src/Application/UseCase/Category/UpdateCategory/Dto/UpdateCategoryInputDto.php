<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\UpdateCategory\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

class UpdateCategoryInputDto
{
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    public function __construct(
        public readonly ?string $id,
        public readonly ?string $name,
        public readonly array $paramsToUpdate,
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);
    }

    public static function create(?string $id, ?string $name, array $paramsToUpdate): self
    {
        return new static($id, $name, $paramsToUpdate);
    }
}
