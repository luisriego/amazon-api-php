<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\IProductRepository;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: IProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $description;

    #[ORM\Column(type: 'int')]
    private int $price;

    #[ORM\Column(type: 'smallint')]
    private ?int $rating = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $seller;

    #[ORM\Column(type: 'int')]
    private ?int $stock;

    #[ORM\Column(type: 'string', enumType: ProductStatus::class)]
    private ProductStatus $status;

    private function __construct(
        string $name,
        string $description,
        int $price,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = 0;
        $this->status = ProductStatus::Active;
        $this->createdOn = new DateTimeImmutable();
        $this->updatedOn = new DateTime();
    }

    public static function create($name, $description, $price): self
    {
        return new static(
            $name,
            $description,
            $price,
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function getSeller(): string
    {
        return $this->seller;
    }

    public function setSeller(string $seller): void
    {
        $this->seller = $seller;
    }

    public function getStock(): string
    {
        return $this->stock;
    }

    public function setStock(string $stock): void
    {
        $this->stock = $stock;
    }

    public function getStatus(): ProductStatus
    {
        return $this->status;
    }

    public function setStatus(ProductStatus $status): void
    {
        $this->status = $status;
    }
}
