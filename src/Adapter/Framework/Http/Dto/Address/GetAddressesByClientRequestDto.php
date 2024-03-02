<?php

namespace App\Adapter\Framework\Http\Dto\Address;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

readonly class GetAddressesByClientRequestDto implements RequestDto
{
    public ?string $id;

    public function __construct(Request $request)
    {
        $this->id = $request->attributes->get('id');
    }
}