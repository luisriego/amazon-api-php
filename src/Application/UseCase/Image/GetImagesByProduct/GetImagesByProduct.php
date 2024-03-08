<?php

declare(strict_types=1);

namespace App\Application\UseCase\Image\GetImagesByProduct;

use App\Application\UseCase\Image\GetImagesByProduct\Dto\GetImagesByProductInputDto;
use App\Application\UseCase\Image\GetImagesByProduct\Dto\GetImagesByProductOutputDto;
use App\Domain\Repository\ImageRepositoryInterface;

readonly class GetImagesByProduct
{
    public function __construct(
        private ImageRepositoryInterface $imageRepository,
    ) {}

    public function handle(GetImagesByProductInputDto $dto): array
    {
        return GetImagesByProductOutputDto::create($this->imageRepository->findAllByProductIdOrFail($dto->id));
    }
}
