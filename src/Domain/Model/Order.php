<?php

namespace App\Domain\Model;

use App\Domain\Repository\IOrderRepository;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IOrderRepository::class)]
class Order
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

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

    private Address $orderAddress;

    private function __construct()
    {

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
}