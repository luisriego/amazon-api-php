<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Review;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateReviewRequestDto implements RequestDto
{
    public ?string $name;
    public ?string $comment;
    public ?int $rating;
    public ?string $product;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get('name');
        $this->comment = $request->request->get('comment');
        $this->rating = $request->request->get('rating');
        $this->product = $request->request->get('product');
    }
}
