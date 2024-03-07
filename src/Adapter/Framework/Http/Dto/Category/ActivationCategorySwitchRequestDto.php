<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Category;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

readonly class ActivationCategorySwitchRequestDto implements RequestDto
{
    public ?string $id;

    public function __construct(Request $request)
    {
        $this->id = $request->request->get('id');
    }
}
