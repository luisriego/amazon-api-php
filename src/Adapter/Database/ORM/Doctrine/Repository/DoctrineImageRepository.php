<?php

namespace App\Adapter\Database\ORM\Doctrine\Repository;

use App\Adapter\Database\ORM\Doctrine\BaseRepository;
use App\Domain\Exception\ResourceNotFoundException;
use App\Domain\Model\Image;
use App\Domain\Repository\ImageRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    public function add(Image $image, bool $flush): void
    {
        $this->getEntityManager()->persist($image);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Image $image, bool $flush): void
    {
        $this->getEntityManager()->persist($image);

         if ($flush) {
             $this->getEntityManager()->flush();
         }
    }

    public function remove(Image $image, bool $flush): void
    {
        $this->getEntityManager()->remove($image);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByIdOrFail(string $id): Image
    {
        if (null === $image = $this->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(Image::class, $id);
        }

        return $image;
    }
}