<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Product;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateProductRequestDto implements RequestDto
{
    public string $name;
    public string $description;
    public string $price;
    public ?string $category;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get('name');
        $this->description = $request->request->get('description');
        $this->price = $request->request->get('price');
        $this->category = $request->request->get('category');
    }
}
