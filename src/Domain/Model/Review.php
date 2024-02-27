<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\ReviewRepositoryInterface;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ReviewRepositoryInterface::class)]
final class Review
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    public const MIN_ROLE = 'ROLE_USER';

    #[ORM\Column(type: 'string', length: 50)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $comment;

    #[ORM\Column(type: 'smallint')]
    private int $rating;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $owner;

    private function __construct(
        string $name,
        string $comment,
        int $rating,
        Product $product,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->comment = $comment;
        $this->rating = $rating;
        $this->product = $product;
        $this->createdOn = new DateTimeImmutable();
        $this->markAsUpdated();
    }

    public static function create($name, $comment, $rating, $product): self
    {
        return new Review(
            $name,
            $comment,
            $rating,
            $product,
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

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): void
    {
        $this->owner = $owner;
    }
}
