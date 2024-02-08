<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\ShoppingCartItemRepositoryInterface;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ShoppingCartItemRepositoryInterface::class)]
final class ShoppingCartItem
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    #[ORM\Column(type: 'integer')]
    private int $price; // I think I don't need this, because the price will be taken from the Product instance

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $image;

    #[ORM\Column(type: 'string', length: 36, options: ['fixed' => true])]
    private string $shoppingCartMasterId;

    #[ORM\Column(type: 'string', length: 36, options: ['fixed' => true])]
    private string $shoppingCartId;

    #[ORM\ManyToOne(targetEntity: 'App\Domain\Model\Product')]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private ?Product $product;

//    private string $productId;

    #[ORM\Column(type: 'integer')]
    private int $stock;

    #[ORM\ManyToOne(targetEntity: ShoppingCart::class, inversedBy: 'shoppingCarItems')]
    private ShoppingCart $shoppingCart;

    //    #[ORM\Column(type: 'string', length: 50)]
    //    private string $product;
    //
    //    #[ORM\Column(type: 'string', length: 50)]
    //    private string $category;

    private function __construct(
        ?Product $product,
        ?int $quantity,
        string $shoppingCartMasterId,
        string $shoppingCartId,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->product = $product;
        $this->quantity = $quantity;
        $this->shoppingCartMasterId = $shoppingCartMasterId;
        $this->shoppingCartId = $shoppingCartId;
        $this->createdOn = new DateTimeImmutable();
        $this->whoCreated();
        $this->markAsUpdated();
        $this->whoUpdated();
    }

    public static function create($product, $quantity, $shoppingCartMasterId, $shoppingCartId): self
    {
        return new static(
            $product,
            $quantity,
            $shoppingCartMasterId,
            $shoppingCartId,
        );
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getShoppingCartMasterId(): string
    {
        return $this->shoppingCartMasterId;
    }

    public function setShoppingCartMasterId(string $shoppingCartMasterId): void
    {
        $this->shoppingCartMasterId = $shoppingCartMasterId;
    }

    public function getShoppingCartId(): string
    {
        return $this->shoppingCartId;
    }

    public function setShoppingCartId(string $shoppingCartId): void
    {
        $this->shoppingCartId = $shoppingCartId;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function getShoppingCart(): ShoppingCart
    {
        return $this->shoppingCart;
    }

    public function setShoppingCart(ShoppingCart $shoppingCart): void
    {
        $this->shoppingCart = $shoppingCart;
    }
}
