<?php

declare(strict_types=1);

namespace App\Application\UseCase\Address\GetAddressesByClient\Dto;

readonly class GetAddressesByClientOutputDto
{
    private function __construct(
        public array $addresses,
    ) {}

    public static function create(array $addresses): array
    {
        $result = [];

        foreach ($addresses as $address) {
            $result[] = $address;
        }

        return $result;
    }
}
