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

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderItems')]
    private ?Order $order;

    public function __construct(
        int $price,
        int $quantity,
        Product $product,
        Order $order,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->price  = $price;
        $this->quantity = $quantity;
        $this->product = $product;
        $this->order = $order;
        $this->createdOn = new DateTimeImmutable();
        $this->markAsUpdated();
    }

    public static function create($price, $quantity, $product, $order): self
    {
        return new OrderItem(
            $price,
            $quantity,
            $product,
            $order,
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

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): void
    {
        $this->order = $order;
    }
}
