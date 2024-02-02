<?php

declare(strict_types=1);

namespace App\Domain\Enums;

enum ProductStatus: string
{
    case Active = 'Active status';
    case Inactive = 'Inactive status';
}
