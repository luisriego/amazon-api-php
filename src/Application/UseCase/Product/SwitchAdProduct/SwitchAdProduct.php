<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\SwitchAdProduct;

use App\Application\UseCase\Product\SwitchAdProduct\Dto\SwitchAdProductInputDto;
use App\Domain\Repository\ProductRepositoryInterface;

readonly class SwitchAdProduct
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    ) {}

    public function handle(SwitchAdProductInputDto $dto): void
    {
        $productToStopAd = $this->productRepository->findOneByIdOrFail($dto->id);

        $productToStopAd->toggleStatus();

        $this->productRepository->save($productToStopAd, true);
    }
}
