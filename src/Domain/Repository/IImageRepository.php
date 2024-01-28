<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Image;

interface IImageRepository
{
    public function add(Image $review, bool $flush): void;
    public function save(Image $review, bool $flush): void;
    public function remove(Image $review, bool $flush): void;
    public function findOneByIdOrFail(string $id): Image;
}
