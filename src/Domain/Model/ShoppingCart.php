<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\ShoppingCartRepositoryInterface;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ShoppingCartRepositoryInterface::class)]
final class ShoppingCart
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    #[ORM\Column(type: 'integer')]
    private int $price;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $image;

    #[ORM\OneToMany(mappedBy: ShoppingCartItem::class, targetEntity: Product::class, orphanRemoval: true)]
    private Collection $shoppingCartItems;

    //    private string $product; // I think we need here a Product entity or id
    //    private string $category; // because product have a category yet, I think this is not necessary

    public function __construct(
        ?int $price,
        ?int $quantity,
        ?string $image,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->price = $price;
        $this->quantity = $quantity;
        $this->image = $image;
        $this->shoppingCartItems = new ArrayCollection();
        $this->createdOn = new DateTimeImmutable();
        $this->whoCreated();
        $this->markAsUpdated();
        $this->whoUpdated();
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    // Method to add a shoppingCartItem to the product
    public function addShoppingCartItem(ShoppingCartItem $shoppingCartItem): self
    {
        if (!$this->shoppingCartItems->contains($shoppingCartItem)) {
            $this->shoppingCartItems[] = $shoppingCartItem;
            $shoppingCartItem->setShoppingCart($this);
        }

        return $this;
    }

    // Method to remove a shoppingCartItem from the product
    public function removeShoppingCartItem(ShoppingCartItem $shoppingCartItem): self
    {
        if ($this->shoppingCartItems->removeElement($shoppingCartItem)) {
            // set the owning side to null (unless already changed)
            if ($shoppingCartItem->getShoppingCart() === $this) {
                $shoppingCartItem->setShoppingCart(null);
            }
        }

        return $this;
    }

    public function getShoppingCartItems(): Collection
    {
        return $this->shoppingCartItems;
    }
}
