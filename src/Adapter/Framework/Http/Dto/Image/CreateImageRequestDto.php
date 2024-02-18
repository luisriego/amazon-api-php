<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Image;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateImageRequestDto implements RequestDto
{
    public ?string $url;
    public ?string $publicCode;
    public ?string $product;

    public function __construct(Request $request)
    {
        $this->url = $request->request->get('url');
        $this->publicCode = $request->request->get('publicCode');
        $this->product = $request->request->get('product');
    }
}
