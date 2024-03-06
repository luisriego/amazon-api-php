<?php

declare(strict_types=1);

namespace App\Application\UseCase\Image\CreateImage;

use App\Application\UseCase\Image\CreateImage\Dto\CreateImageInputDto;
use App\Application\UseCase\Image\CreateImage\Dto\CreateImageOutputDto;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Image;
use App\Domain\Model\Product;
use App\Domain\Repository\ImageRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;

readonly class CreateImage
{
    public function __construct(
        private ImageRepositoryInterface $imageRepository,
        private ProductRepositoryInterface $productRepository,
    ) {}

    public function handle(CreateImageInputDto $inputDto): CreateImageOutputDto
    {
        if (null === $product = $this->productRepository->findOneByIdOrFail($inputDto->product)) {
            throw ResourceNotFoundException::createFromClassAndId(Product::class, $inputDto->product);
        }

        $image = Image::create($inputDto->url, $inputDto->pubicCode, $product);

        $this->imageRepository->add($image, true);

        return new CreateImageOutputDto($image->getId());
    }
}
