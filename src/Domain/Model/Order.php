<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Enums\OrderStatus;
use App\Domain\Repository\OrderRepositoryInterface;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\IsActiveTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: OrderRepositoryInterface::class)]
#[ORM\Table(name: "`order`")]
class Order
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;
    use IsActiveTrait;

    public const MIN_ROLE = 'ROLE_USER';

    #[ORM\Column(type: 'integer')]
    private int $subtotal;

    #[ORM\Column(type: 'integer')]
    private int $total;

    #[ORM\Column(type: 'integer')]
    private int $tax;

    #[ORM\Column(type: 'integer')]
    private int $shippingPrice;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $paymentIntentId;

    #[ORM\Column(type: 'string', length: 50)]
    private string $clientSecret;

    #[ORM\Column(type: 'string', length: 50)]
    private string $stripeApiKey;

    #[ORM\Column(type: 'string', enumType: OrderStatus::class)]
    private OrderStatus $status = OrderStatus::Pending;

    #[ORM\OneToOne(targetEntity: Address::class)]
    private ?Address $orderAddress;

    #[ORM\OneToMany(mappedBy: 'Order', targetEntity: OrderItem::class)]
    private Collection $orderItems;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $owner;

    private function __construct(User $owner, Address $orderAddress)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->owner = $owner;
        $this->orderAddress = $orderAddress;
        $this->subtotal = 0;
        $this->total = 0;
        $this->tax = 0;
        $this->shippingPrice = 0;
        $this->paymentIntentId = "";
        $this->clientSecret = "";
        $this->stripeApiKey = "";
        $this->orderItems = new ArrayCollection();
        $this->isActive = false;
        $this->createdOn = new DateTimeImmutable();
        $this->creator($owner->getUserIdentifier());
        $this->markAsUpdated();
        $this->whoUpdated();
    }

    public static function create($owner, $orderAddress): self
    {
        return new Order($owner, $orderAddress);
    }

    public function getSubtotal(): int
    {
        return $this->subtotal;
    }

    public function setSubtotal(int $subtotal): void
    {
        $this->subtotal = $subtotal;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    public function getTax(): int
    {
        return $this->tax;
    }

    public function setTax(int $tax): void
    {
        $this->tax = $tax;
    }

    public function getShippingPrice(): int
    {
        return $this->shippingPrice;
    }

    public function setShippingPrice(int $shippingPrice): void
    {
        $this->shippingPrice = $shippingPrice;
    }

    public function getPaymentIntentId(): ?string
    {
        return $this->paymentIntentId;
    }

    public function setPaymentIntentId(?string $paymentIntentId): void
    {
        $this->paymentIntentId = $paymentIntentId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function setClientSecret(string $clientSecret): void
    {
        $this->clientSecret = $clientSecret;
    }

    public function getStripeApiKey(): string
    {
        return $this->stripeApiKey;
    }

    public function setStripeApiKey(string $stripeApiKey): void
    {
        $this->stripeApiKey = $stripeApiKey;
    }

    public function getOrderAddress(): Address
    {
        return $this->orderAddress;
    }

    public function setOrderAddress(Address $orderAddress): void
    {
        $this->orderAddress = $orderAddress;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function setStatus(OrderStatus $status): void
    {
        $this->status = $status;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): void
    {
        $this->owner = $owner;
    }

    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function setOrderItems(Collection $orderItems): void
    {
        $this->orderItems = $orderItems;
    }
}
