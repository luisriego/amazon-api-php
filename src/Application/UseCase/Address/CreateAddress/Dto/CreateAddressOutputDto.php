<?php

declare(strict_types=1);

namespace App\Application\UseCase\Address\CreateAddress\Dto;

class CreateAddressOutputDto
{
    public function __construct(public readonly string $id) {}
}
