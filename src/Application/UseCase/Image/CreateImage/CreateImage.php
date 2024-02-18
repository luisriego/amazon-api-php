<?php

namespace App\Application\UseCase\Image\CreateImage;

use App\Application\UseCase\Image\CreateImage\Dto\CreateImageInputDto;
use App\Application\UseCase\Image\CreateImage\Dto\CreateImageOutputDto;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Image;
use App\Domain\Model\Product;
use App\Domain\Model\User;
use App\Domain\Repository\ImageRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;
use Symfony\Bundle\SecurityBundle\Security;

readonly class CreateImage
{
    public function __construct(
        private ImageRepositoryInterface   $imageRepository,
        private ProductRepositoryInterface $productRepository,
        private Security                   $security,
    ) { }

    public function handle(CreateImageInputDto $inputDto): CreateImageOutputDto
    {
        /** @var User $authenticatedUser */
        $authenticatedUser = $this->security->getUser();

        if (null === $product = $this->productRepository->findOneByIdOrFail($inputDto->product)) {
            throw ResourceNotFoundException::createFromClassAndIntId(Product::class, $inputDto->product);
        }

        $image = Image::create($inputDto->url, $inputDto->pubicCode, $product, $authenticatedUser);

        $this->imageRepository->add($image, true);

        return new CreateImageOutputDto($image->getId());
    }
}