<?php

namespace App\Adapter\Database\ORM\Doctrine\Repository;

use App\Adapter\Database\ORM\Doctrine\BaseRepository;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Order;
use App\Domain\Repository\OrderRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineOrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function add(Order $order, bool $flush): void
    {
        $this->getEntityManager()->persist($order);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Order $order, bool $flush): void
    {
        $this->getEntityManager()->persist($order);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Order $order, bool $flush): void
    {
        $this->getEntityManager()->remove($order);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByIdOrFail(string $id): Order
    {
        if (null === $order = $this->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Order::class, $id);
        }

        return $order;
    }
}