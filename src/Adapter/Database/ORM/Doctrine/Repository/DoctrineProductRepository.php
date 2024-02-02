<?php

namespace App\Adapter\Database\ORM\Doctrine\Repository;

use App\Adapter\Database\ORM\Doctrine\BaseRepository;
use App\Domain\Model\Product;
use App\Domain\Repository\ProductRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $product, bool $flush): void
    {
        $this->getEntityManager()->persist($product);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Product $product, bool $flush): void
    {
        // TODO: Implement save() method.
    }

    public function remove(Product $product, bool $flush): void
    {
        // TODO: Implement remove() method.
    }

    public function findOneByIdOrFail(string $id): Product
    {
        // TODO: Implement findOneByIdOrFail() method.
    }
}