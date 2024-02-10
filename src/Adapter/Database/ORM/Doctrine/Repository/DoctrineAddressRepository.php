<?php

declare(strict_types=1);

namespace App\Adapter\Database\ORM\Doctrine\Repository;

use App\Adapter\Database\ORM\Doctrine\BaseRepository;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Address;
use App\Domain\Repository\AddressRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineAddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }

    public function add(Address $address, bool $flush): void
    {
        $this->getEntityManager()->persist($address);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Address $address, bool $flush): void
    {
        $this->getEntityManager()->persist($address);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Address $address, bool $flush): void
    {
        $this->getEntityManager()->remove($address);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByIdOrFail(string $id): Address
    {
        if (null === $address = $this->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Address::class, $id);
        }

        /** @var Address $address */
        return $address;
    }

    public function findOneByStreetOrFail(string $street): Address
    {
        if (null === $address = $this->find($street)) {
            throw ResourceNotFoundException::createFromClassAndId(Address::class, $street);
        }

        /** @var Address $address */
        return $address;
    }
}
