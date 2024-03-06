<?php

declare(strict_types=1);

namespace App\Application\UseCase\OrderItem\CreateOrderItem\Dto;

class CreateOrderItemOutputDto
{
    public function __construct(public string $id) {}
}
