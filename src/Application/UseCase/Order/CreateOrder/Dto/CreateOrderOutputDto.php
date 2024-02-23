<?php

namespace App\Application\UseCase\Order\CreateOrder\Dto;

class CreateOrderOutputDto
{
    public function __construct(public string $id) {}
}