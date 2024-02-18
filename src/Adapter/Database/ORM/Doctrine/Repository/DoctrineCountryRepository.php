<?php

declare(strict_types=1);

namespace App\Adapter\Database\ORM\Doctrine\Repository;

use App\Adapter\Database\ORM\Doctrine\BaseRepository;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Country;
use App\Domain\Repository\CountryRepositoryInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineCountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    public function add(Country $country, bool $flush): void
    {
        $this->getEntityManager()->persist($country);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Country $country, bool $flush): void
    {
        $this->getEntityManager()->persist($country);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Country $country, bool $flush): void
    {
        $this->getEntityManager()->remove($country);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByNameOrFail(string $name): Country
    {
        if (null === $country = $this->find($name)) {
            throw ResourceNotFoundException::createFromClassAndName(Country::class, $name);
        }

        // @var Country $country
        return $country;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findOneLikeNameOrFail(string $name): ?Country
    {
        return $this->createQueryBuilder('c')
            ->where('c.name LIKE :term')
            ->orWhere('c.iso2 LIKE :term')
            ->orWhere('c.iso3 LIKE :term')
            ->setParameter('term', '%' . $name . '%')
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByIdOrFail(int $id): Country
    {
        if (null === $country = $this->find($id)) {
            throw ResourceNotFoundException::createFromClassAndIntId(Country::class, $id);
        }

        return $country;
    }
}
