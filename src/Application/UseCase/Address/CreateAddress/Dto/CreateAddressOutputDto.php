<?php

namespace App\Application\UseCase\Address\CreateAddress\Dto;

class CreateAddressOutputDto
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}