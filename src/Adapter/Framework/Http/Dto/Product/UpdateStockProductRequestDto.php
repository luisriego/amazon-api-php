<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Product;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

readonly class UpdateStockProductRequestDto implements RequestDto
{
    public ?string $id;
    public ?int $stock;

    public function __construct(Request $request)
    {
        $this->id = $request->request->get('id');
        $this->stock = (int) $request->request->get('stock');
    }
}
