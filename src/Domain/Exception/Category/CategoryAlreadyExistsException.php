<?php

declare(strict_types=1);

namespace App\Domain\Exception\Category;

use DomainException;

use function sprintf;

final class CategoryAlreadyExistsException extends DomainException
{
    public static function createFromName(string $name): self
    {
        return new CategoryAlreadyExistsException(sprintf('Category with name <%s> already exists', $name));
    }
}
