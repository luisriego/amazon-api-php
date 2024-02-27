<?php

namespace App\Application\UseCase\Order\CreateOrder\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

final class CreateOrderInputDto
{
    use AssertNotNullTrait;

    private const ARGS = [
        'orderAddress',
    ];

    public function __construct(
        public readonly ?string $orderAddress,
    ) {
        $this->assertNotNull(self::ARGS, [$this->orderAddress]);
    }

    public static function create(
        ?string $orderAddress,
    ): self {
        return new CreateOrderInputDto($orderAddress);
    }
}