<?php

declare(strict_types=1);

namespace App\Application\UseCase\Image\CreateImage\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

final class CreateImageInputDto
{
    use AssertNotNullTrait;

    private const ARGS = [
        'url',
        'pubicCode',
        'product',
    ];

    public function __construct(
        public readonly ?string $url,
        public readonly string $pubicCode,
        public readonly string $product,
    ) {
        $this->assertNotNull(self::ARGS, [$this->url, $this->pubicCode, $this->product]);
    }

    public static function create(
        ?string $url,
        ?string $publicCode,
        ?string $product,
    ): self {
        return new CreateImageInputDto($url, $publicCode, $product);
    }
}
