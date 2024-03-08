<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Product;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

use function array_keys;

readonly class UpdateProductRequestDto implements RequestDto
{
    public ?string $id;
    public ?string $name;
    public ?string $description;
    public ?int $price;
    public ?int $rating;
    public array $keys;

    public function __construct(Request $request)
    {
        $this->id = $request->request->get('id');
        $this->name = $request->request->get('name');
        $this->description = $request->request->get('description');
        $this->price = (int) $request->request->get('price');
        $this->rating = (int) $request->request->get('rating');
        $this->keys = array_keys($request->request->all());
    }
}
