<?php

namespace App\Domain\Model;

use App\Domain\Common\BaseDomainModel;
use App\Domain\Repository\ICategoryRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ICategoryRepository::class)]
class Category extends BaseDomainModel
{
    #[ORM\Column(type: 'string', length: 50)]
    private string $name;

    private function __construct(string $name)
    {
        $this->setId(Uuid::v4()->toRfc4122());
        $this->name = $name;
        $this->setCreatedAt(new DateTimeImmutable());
        $this->setUpdatedAt(new DateTime());
    }

    public static function create($name): self
    {
        return new static($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}