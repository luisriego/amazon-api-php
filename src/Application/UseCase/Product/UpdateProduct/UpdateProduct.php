<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\UpdateProduct;

use App\Application\UseCase\Product\UpdateProduct\Dto\UpdateProductInputDto;
use App\Application\UseCase\Product\UpdateProduct\Dto\UpdateProductOutputDto;
use App\Domain\Repository\ProductRepositoryInterface;

use function sprintf;
use function ucfirst;

class UpdateProduct
{
    private const SETTER_PREFIX = 'set';

    public function __construct(private readonly ProductRepositoryInterface $productRepository) {}

    public function handle(UpdateProductInputDto $dto): UpdateProductOutputDto
    {
        $product = $this->productRepository->findOneByIdOrFail($dto->id);

        foreach ($dto->paramsToUpdate as $param) {
            $product->{sprintf('%s%s', self::SETTER_PREFIX, ucfirst($param))}($dto->{$param});
        }

        $product->markAsUpdated();

        $this->productRepository->save($product, true);

        return UpdateProductOutputDto::create($product);
    }
}
