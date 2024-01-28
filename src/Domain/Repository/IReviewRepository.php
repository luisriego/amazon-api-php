<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\Review;

interface IReviewRepository
{
    public function add(Review $review, bool $flush): void;
    public function save(Review $review, bool $flush): void;
    public function remove(Review $review, bool $flush): void;
    public function findOneByIdOrFail(string $id): Review;
}
