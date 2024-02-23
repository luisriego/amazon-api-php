<?php

namespace App\Adapter\Framework\Http\Dto\Order;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateOrderRequestDto implements RequestDto
{
    public ?string $owner;
    public ?string $orderAddress;

    public function __construct(Request $request)
    {
        $this->owner = $request->request->get('owner');
        $this->orderAddress = $request->request->get('orderAddress');
    }
}
{

}