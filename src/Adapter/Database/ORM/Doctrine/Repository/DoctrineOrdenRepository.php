<?php

namespace App\Adapter\Database\ORM\Doctrine\Repository;

use App\Adapter\Database\ORM\Doctrine\BaseRepository;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Orden;
use App\Domain\Repository\OrdenRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineOrdenRepository extends BaseRepository implements OrdenRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orden::class);
    }

    public function add(Orden $orden, bool $flush): void
    {
        $this->getEntityManager()->persist($orden);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Orden $orden, bool $flush): void
    {
        $this->getEntityManager()->persist($orden);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Orden $orden, bool $flush): void
    {
        $this->getEntityManager()->remove($orden);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByIdOrFail(string $id): Orden
    {
        if (null === $orden = $this->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Orden::class, $id);
        }

        return $orden;
    }
}