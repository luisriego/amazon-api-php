<?php

declare(strict_types=1);

namespace App\Application\UseCase\Address\CreateAddress\Dto;

readonly class CreateAddressOutputDto
{
    public function __construct(public string $id) {}
}
