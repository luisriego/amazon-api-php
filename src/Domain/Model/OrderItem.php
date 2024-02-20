<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\OrderItemRepositoryInterface;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: OrderItemRepositoryInterface::class)]
final class OrderItem
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    public const MIN_ROLE = 'ROLE_USER';

    #[ORM\Column(type: 'integer')]
    private int $price;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product;

    #[ORM\ManyToOne(targetEntity: Orden::class, inversedBy: 'orderItems')]
    private ?Orden $orden;

    public function __construct(
        int $price,
        int $quantity,
        Product $product,
        Orden $orden,
        User $user,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->price  = $price;
        $this->quantity = $quantity;
        $this->product = $product;
        $this->orden = $orden;
        $this->createdOn = new DateTimeImmutable();
        $this->creator($user->getUserIdentifier());
        $this->markAsUpdated();
        $this->whoUpdated();
    }

    public static function create($price, $quantity, $product, $order, $user): self
    {
        return new OrderItem(
            $price,
            $quantity,
            $product,
            $order,
            $user,
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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    public function getOrden(): ?Orden
    {
        return $this->orden;
    }

    public function setOrden(?Orden $orden): void
    {
        $this->orden = $orden;
    }
}
