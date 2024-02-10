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

    #[ORM\Column(type: 'integer')]
    private int $price;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $imageUrl;

    //    private Order $order;
    //    private Product $product;

    public function __construct(
        int $price,
        int $quantity,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->price  = $price;
        $this->quantity = $quantity;
        $this->createdOn = new DateTimeImmutable();
        $this->markAsUpdated();
    }

    public static function create($price, $quantity): self
    {
        return new OrderItem(
            $price,
            $quantity,
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

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }
}
