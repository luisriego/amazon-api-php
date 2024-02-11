<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Category;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateCategoryRequestDto implements RequestDto
{
    public ?string $name;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get('name');
    }
}
