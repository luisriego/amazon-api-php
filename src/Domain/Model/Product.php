<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\IProductRepository;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    private ?Category $category;

    #[ORM\OneToMany(mappedBy: 'image', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $images;

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
        $this->images = new ArrayCollection();
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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): void
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

    // Method to add an image to the product
    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProduct($this);
        }

        return $this;
    }

    // Method to remove an image from the product
    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProduct() === $this) {
                $image->setProduct(null);
            }
        }

        return $this;
    }

    // Get all images associated with this product
    public function getImages(): Collection
    {
        return $this->images;
    }
}
