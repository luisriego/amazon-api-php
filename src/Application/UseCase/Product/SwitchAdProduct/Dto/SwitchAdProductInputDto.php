<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\SwitchAdProduct\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

class SwitchAdProductInputDto
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
