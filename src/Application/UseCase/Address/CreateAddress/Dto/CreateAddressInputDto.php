<?php

namespace App\Application\UseCase\Address\CreateAddress\Dto;

use App\Domain\Model\User;
use App\Domain\Validation\Traits\AssertNotNullTrait;

final class CreateAddressInputDto
{
    use AssertNotNullTrait;

    private const ARGS = [
        "number",
        "street",
        "city",
        "zipCode",
    ];

    public function __construct(
        public readonly ?string $name,
        public readonly string $number,
        public readonly string $street,
        public readonly ?string $street2,
        public readonly ?string $department,
        public readonly ?string $neighborhood,
        public readonly string $city,
        public readonly string $zipCode,
        public readonly ?string $country,
    )
    {
        $this->assertNotNull(self::ARGS, [$this->number, $this->street, $this->city, $this->zipCode]);
    }

    public static function create(
        ?string $name,
        ?string $number,
        ?string $street,
        ?string $street2,
        ?string $department,
        ?string $neighborhood,
        ?string $city,
        ?string $zipCode,
        ?string $country): self
    {
        return new CreateAddressInputDto($name, $number, $street, $street2, $department, $neighborhood, $city, $zipCode, $country);
    }
}