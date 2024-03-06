<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Dto\Category;

use App\Adapter\Framework\Http\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

use function array_keys;

readonly class UpdateCategoryRequestDto implements RequestDto
{
    public ?string $id;
    public ?string $name;

    public array $keys;

    public function __construct(Request $request)
    {
        $this->id = $request->request->get('id');
        $this->name = $request->request->get('name');
        $this->keys = array_keys($request->request->all());
    }
}
