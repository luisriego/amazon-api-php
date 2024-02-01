<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\ICategoryRepository;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ICategoryRepository::class)]
class Category
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    #[ORM\Column(type: 'string', length: 50)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Category::class, orphanRemoval: false)]
    private Collection $products;

    private function __construct(string $name)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->products = new ArrayCollection();
        $this->createdOn = new DateTimeImmutable();
        $this->markAsUpdated();
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
