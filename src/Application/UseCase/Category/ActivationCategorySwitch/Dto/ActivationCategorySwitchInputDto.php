<?php

namespace App\Application\UseCase\Category\ActivationCategorySwitch\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

class ActivationCategorySwitchInputDto
{
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    public function __construct(
        public readonly ?string $id,
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);
    }

    public static function create(?string $id): self
    {
        return new static($id);
    }
}