<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Orden;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateOrdenRequestDto implements RequestDto
{
    public ?string $owner;
    public ?string $orderAddress;

    public function __construct(Request $request)
    {
        $this->owner = $request->request->get('owner');
        $this->orderAddress = $request->request->get('orderAddress');
    }
}
