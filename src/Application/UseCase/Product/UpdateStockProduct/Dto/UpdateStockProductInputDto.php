<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\UpdateStockProduct\Dto;

use App\Domain\Validation\Traits\AssertNotNullTrait;

class UpdateStockProductInputDto
{
    use AssertNotNullTrait;

    private const ARGS = ['id', 'stock'];

    public function __construct(
        public readonly ?string $id,
        public readonly ?int $stock,
    ) {
        $this->assertNotNull(self::ARGS, [$this->id, $this->stock]);
    }

    public static function create(
        ?string $id,
        ?int $stock,
    ): self {
        return new static(
            $id,
            $stock,
        );
    }
}
