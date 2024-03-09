<?php

declare(strict_types=1);

namespace App\Application\UseCase\Category\CreateCategory\Dto;

readonly class CreateCategoryOutputDto
{
    public function __construct(public string $id) {}
}
