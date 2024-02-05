<?php

declare(strict_types=1);

namespace App\Domain\Enums;

enum OrderStatus: string
{
    case Pending = 'Pending status';
    case Completed = 'Completed status';
    case Send = 'Send status';
    case Error = 'Error status';
}
