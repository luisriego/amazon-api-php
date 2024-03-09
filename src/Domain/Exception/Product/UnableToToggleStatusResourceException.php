<?php

declare(strict_types=1);

namespace App\Domain\Exception\Product;

use DomainException;

use function sprintf;

final class UnableToToggleStatusResourceException extends DomainException
{
    public static function WithoutStock(string $id): self
    {
        return new UnableToToggleStatusResourceException(
            sprintf(
                'Product with ID [%s] cannot be Activated because have not stock',
                $id,
            ),
        );
    }
}
