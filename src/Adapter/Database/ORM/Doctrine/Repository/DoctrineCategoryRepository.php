<?php

declare(strict_types=1);

namespace App\Adapter\Database\ORM\Doctrine\Repository;

use App\Adapter\Database\ORM\Doctrine\BaseRepository;
use App\Domain\Exception\Category\CategoryAlreadyExistsException;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Category;
use App\Domain\Repository\CategoryRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineCategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function add(Category $category, bool $flush): void
    {
        $this->getEntityManager()->persist($category);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Category $category, bool $flush): void
    {
        $this->getEntityManager()->persist($category);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $category, bool $flush): void
    {
        $this->getEntityManager()->remove($category);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByNameOrFail(string $name): ?Category
    {
        if (!null === $category = $this->find($name)) {
            throw CategoryAlreadyExistsException::createFromName($name);
        }

        // @var Category $category
        return $category;
    }

    public function findOneByIdOrFail(string $id): Category
    {
        if (null === $category = $this->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Category::class, $id);
        }

        // @var Category $category
        return $category;
    }
}
