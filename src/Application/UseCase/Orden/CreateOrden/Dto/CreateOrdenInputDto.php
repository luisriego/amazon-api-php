<?php

namespace App\Application\UseCase\Orden\CreateOrden\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

final class CreateOrdenInputDto
{
    use AssertNotNullTrait;

    private const ARGS = [
        'owner',
        'orderAddress',
    ];

    public function __construct(
        public readonly ?string $owner,
        public readonly ?string $orderAddress,
    ) {
        $this->assertNotNull(self::ARGS, [$this->owner, $this->orderAddress]);
    }

    public static function create(
        ?string $owner,
        ?string $orderAddress,
    ): self {
        return new CreateOrdenInputDto($owner, $orderAddress);
    }
}