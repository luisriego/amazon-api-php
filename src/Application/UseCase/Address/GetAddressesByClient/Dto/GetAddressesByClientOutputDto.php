<?php

namespace App\Application\UseCase\Address\GetAddressesByClient\Dto;

use App\Domain\Model\Address;

readonly class GetAddressesByClientOutputDto
{
    private function __construct(
        public array $addresses,
    ) {
    }

    public static function create(array $addresses): array
    {
        $result = [];

        foreach ($addresses as $address){
            $result[] = $address;
        }

        return $result;
    }
}