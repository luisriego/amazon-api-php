<?php

declare(strict_types=1);

namespace App\Domain\Exception\Country;

use DomainException;

use function sprintf;

final class CountryAlreadyExistsException extends DomainException
{
    public static function createFromName(string $name): self
    {
        return new CategoryAlreadyExistsException(sprintf('Country with name <%s> already exists', $name));
    }
}
