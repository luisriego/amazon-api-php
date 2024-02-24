<?php

namespace App\Application\UseCase\Order\CreateOrder\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

final class CreateOrderInputDto
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
        return new CreateOrderInputDto($owner, $orderAddress);
    }
}