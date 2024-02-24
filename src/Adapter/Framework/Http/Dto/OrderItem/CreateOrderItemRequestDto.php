<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\OrderItem;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateOrderItemRequestDto implements RequestDto
{
    public ?string $price;
    public ?string $quantity;

    public ?string $product;

    public ?string $order;

    public function __construct(Request $request)
    {
        $this->price = $request->request->get('price');
        $this->quantity = $request->request->get('quantity');
        $this->product = $request->request->get('product');
        $this->order = $request->request->get('order');
    }
}
