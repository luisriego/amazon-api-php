<?php

declare(strict_types=1);

namespace App\Adapter\Database\ORM\Doctrine\Repository;

use App\Adapter\Database\ORM\Doctrine\BaseRepository;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Review;
use App\Domain\Repository\ReviewRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function add(Review $review, bool $flush): void
    {
        $this->getEntityManager()->persist($review);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Review $review, bool $flush): void
    {
        $this->getEntityManager()->persist($review);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Review $review, bool $flush): void
    {
        $this->getEntityManager()->remove($review);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByIdOrFail(string $id): Review
    {
        if (null === $review = $this->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Review::class, $id);
        }

        return $review;
    }
}
