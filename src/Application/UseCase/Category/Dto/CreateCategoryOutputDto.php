<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\Dto;

class CreateCategoryOutputDto
{
    public function __construct(public readonly string $id) {}
}
