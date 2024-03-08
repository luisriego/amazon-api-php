<?php

declare(strict_types=1);

namespace App\Application\UseCase\Image\DeleteImage;

use App\Application\UseCase\Image\DeleteImage\Dto\DeleteImageInputDto;
use App\Domain\Repository\ImageRepositoryInterface;

readonly class DeleteImage
{
    public function __construct(
        private ImageRepositoryInterface $imageRepository,
    ) {}

    public function handle(DeleteImageInputDto $dto): void
    {
        $imageToDelete = $this->imageRepository->findOneByIdOrFail($dto->id);

        $this->imageRepository->remove($imageToDelete, true);
    }
}
