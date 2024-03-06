<?php

declare(strict_types=1);

namespace App\Application\UseCase\OrderItem\CreateOrderItem\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

class CreateOrderItemInputDto
{
    use AssertNotNullTrait;

    private const ARGS = [
        'price',
        'quantity',
        'product',
        'order',
    ];

    public function __construct(
        public readonly ?string $price,
        public readonly ?string $quantity,
        public readonly ?string $product,
        public readonly ?string $order,
    ) {
        $this->assertNotNull(
            self::ARGS,
            [$this->price, $this->quantity, $this->product, $this->order],
        );
    }

    public static function create(
        ?string $price,
        ?string $quantity,
        ?string $product,
        ?string $order,
    ): self {
        return new CreateOrderItemInputDto($price, $quantity, $product, $order);
    }
}
