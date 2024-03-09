<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Product;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

use function array_keys;

readonly class UpdateStockProductRequestDto implements RequestDto
{
    public ?string $id;
    public ?int $stock;
    public array $keys;

    public function __construct(Request $request)
    {
        $this->id = $request->request->get('id');
        $this->stock = (int) $request->request->get('stock');
        $this->keys = array_keys($request->request->all());
    }
}
