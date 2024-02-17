<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\CategoryRepositoryInterface;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\IsActiveTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CategoryRepositoryInterface::class)]
final class Category
{
    use IdentifierTrait;
    use TimestampableTrait;
    use IsActiveTrait;
    use WhoTrait;

    public const MIN_ROLE = 'ROLE_ADMIN';

    #[ORM\Column(type: 'string', length: 50)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Category::class, orphanRemoval: false)]
    private Collection $products;

    private function __construct(string $name, User $user)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->products = new ArrayCollection();
        $this->isActive = false;
        $this->createdOn = new DateTimeImmutable();
        $this->creator($user->getUserIdentifier());
        $this->markAsUpdated();
        $this->whoUpdated();
    }

    public static function create($name, $user): self
    {
        return new Category($name, $user);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function setProducts(Collection $products): void
    {
        $this->products = $products;
    }
}
