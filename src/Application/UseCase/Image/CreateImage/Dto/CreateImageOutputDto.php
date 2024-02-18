<?php

declare(strict_types=1);

namespace App\Application\UseCase\Image\CreateImage\Dto;

readonly class CreateImageOutputDto
{
    public function __construct(public string $id) {}
}
