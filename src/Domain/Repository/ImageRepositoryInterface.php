<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Image;

interface ImageRepositoryInterface
{
    public function add(Image $image, bool $flush): void;

    public function save(Image $image, bool $flush): void;

    public function remove(Image $image, bool $flush): void;

    public function findOneByIdOrFail(string $id): Image;

    public function findAllByProductIdOrFail(string $productId): ?array;
}
