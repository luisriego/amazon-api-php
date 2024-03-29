<?php

declare(strict_types=1);

namespace App\Adapter\Database\ORM\Doctrine\Repository;

use App\Adapter\Database\ORM\Doctrine\BaseRepository;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Category;
use App\Domain\Model\Product;
use App\Domain\Repository\ProductRepositoryInterface;
use Doctrine\ORM\NonUniqueResultException;
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
        $this->getEntityManager()->persist($product);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $product, bool $flush): void
    {
        $this->getEntityManager()->remove($product);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByIdOrFail(string $id): Product
    {
        if (null === $product = $this->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Product::class, $id);
        }

        return $product;
    }

    public function findRepeated(string $name, int $price, Category $category): ?Product
    {
        $product = $this->findOneBy(['name' => $name]);

        return $product;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findOneRepeated(string $name, int $price, Category $category): ?Product
    {
        return $this->createQueryBuilder('p')
            ->where('p.name LIKE :name')
            ->andWhere('p.price= :price')
            ->andWhere('p.category = :category')
            ->setParameter('name', '%' . $name . '%')
            ->setParameter('price', $price)
            ->setParameter('category', $category)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllByCategoryIdOrFail(string $categoryId): ?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.category = :category')
            ->setParameter('category', $categoryId)
            ->getQuery()
            ->getArrayResult();
    }
}
