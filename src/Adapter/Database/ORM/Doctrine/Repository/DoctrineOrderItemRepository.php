<?php

namespace App\Adapter\Database\ORM\Doctrine\Repository;

use App\Adapter\Database\ORM\Doctrine\BaseRepository;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\OrderItem;
use App\Domain\Repository\OrderItemRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineOrderItemRepository extends BaseRepository implements OrderItemRepositoryInterface
{public function __construct(ManagerRegistry $registry)
{
    parent::__construct($registry, OrderItem::class);
}

    public function add(OrderItem $orderItem, bool $flush): void
    {
        $this->getEntityManager()->persist($orderItem);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(OrderItem $orderItem, bool $flush): void
    {
        $this->getEntityManager()->persist($orderItem);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrderItem $orderItem, bool $flush): void
    {
        $this->getEntityManager()->remove($orderItem);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByIdOrFail(string $id): OrderItem
    {
        if (null === $orderItem = $this->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(OrderItem::class, $id);
        }

        return $orderItem;
    }
}