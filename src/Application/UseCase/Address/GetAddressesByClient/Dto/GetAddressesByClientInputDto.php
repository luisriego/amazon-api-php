<?php

namespace App\Application\UseCase\Address\GetAddressesByClient\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

class GetAddressesByClientInputDto
{
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    private function __construct(
        public readonly ?string $id
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);
    }

    public static function create(?string $id): self
    {
        return new static($id);
    }
}