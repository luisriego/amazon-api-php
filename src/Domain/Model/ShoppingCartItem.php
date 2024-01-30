<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\IShoppingCartItemRepository;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IShoppingCartItemRepository::class)]
class ShoppingCartItem
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    #[ORM\Column(type: 'integer')]
    private int $price;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $image;

    #[ORM\Column(type: 'string', length: 36, options: ['fixed' => true])]
    private string $shoppingCartMasterId;

    #[ORM\Column(type: 'string', length: 36, options: ['fixed' => true])]
    private string $shoppingCartId;

    private string $productId;

    private int $stock;

    //    #[ORM\Column(type: 'string', length: 50)]
    //    private string $product;
    //
    //    #[ORM\Column(type: 'string', length: 50)]
    //    private string $category;

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

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }
}
