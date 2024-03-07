<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use DomainException;

use function sprintf;

final class UnableToDeleteResourceException extends DomainException
{
    public static function createFromClassAndId(string $class, string $id): self
    {
        return new UnableToDeleteResourceException(sprintf('Resource of type [%s] with ID [%s] cannot be deleted', $class, $id));
    }
}
