<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\CreateProduct\Dto;

readonly class CreateProductOutputDto
{
    public function __construct(public string $id) {}
}
