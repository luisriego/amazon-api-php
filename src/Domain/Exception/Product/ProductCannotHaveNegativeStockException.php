<?php

declare(strict_types=1);

namespace App\Domain\Exception\Product;

use DomainException;

final class ProductCannotHaveNegativeStockException extends DomainException
{
    public static function ChangeStock(): self
    {
        return new ProductCannotHaveNegativeStockException(
            'Product cannot have negative stock',
        );
    }
}
