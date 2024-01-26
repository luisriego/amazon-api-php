<?php

namespace App\Domain\Model;

enum ProductStatus: string
{
    case Active = "Active status";
    case Inactive = "Inactive status";
}
