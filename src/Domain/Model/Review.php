<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\ReviewRepositoryInterface;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ReviewRepositoryInterface::class)]
class Review
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    #[ORM\Column(type: 'string', length: 50)]
    private string $name;

    #[ORM\Column(type: 'string', length: 400)]
    private string $comment;

    #[ORM\Column(type: 'smallint')]
    private int $rating;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product;

    private function __construct(
        string $name,
        string $comment,
        int $rating,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->comment = $comment;
        $this->rating = $rating;
        $this->createdOn = new DateTimeImmutable();
        $this->updatedOn =  new DateTime();
    }

    public static function create($name, $comment, $rating): self
    {
        return new static(
            $name,
            $comment,
            $rating,
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
}
