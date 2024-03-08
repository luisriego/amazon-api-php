<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Address;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

readonly class DeleteAddressRequestDto implements RequestDto
{
    public ?string $id;

    public function __construct(Request $request)
    {
        $this->id = $request->attributes->get('id');
    }
}
