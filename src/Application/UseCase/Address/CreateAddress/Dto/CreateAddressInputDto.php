<?php

declare(strict_types=1);

namespace App\Application\UseCase\Address\CreateAddress\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

final class CreateAddressInputDto
{
    use AssertNotNullTrait;

    private const ARGS = [
        'number',
        'street',
        'city',
        'zipCode',
        'owner',
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
        public readonly ?int $country,
        public readonly ?string $owner,
    ) {
        $this->assertNotNull(self::ARGS, [$this->number, $this->street, $this->city, $this->zipCode, $this->owner]);
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
        ?int $country,
        ?string $owner
    ): self {
        return new CreateAddressInputDto($name, $number, $street, $street2, $department, $neighborhood, $city, $zipCode, $country, $owner);
    }
}
