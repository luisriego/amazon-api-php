<?php

declare(strict_types=1);

namespace App\Application\UseCase\Image\GetImagesByProduct\Dto;

readonly class GetImagesByProductOutputDto
{
    private function __construct(
        public array $images,
    ) {}

    public static function create(array $images): array
    {
        $result = [];

        foreach ($images as $image) {
            $result[] = $image;
        }

        return $result;
    }
}
