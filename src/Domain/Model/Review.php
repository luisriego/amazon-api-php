<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Common\BaseDomainModel;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

class Review extends BaseDomainModel
{
    #[ORM\Column(type: 'string', length: 50)]
    private string $name;

    #[ORM\Column(type: 'string', length: 400)]
    private string $comment;

    #[ORM\Column(type: 'smallint')]
    private int $rating;

//    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'reviews')]
//    private Product $product;

    private function __construct(
        string $name,
        string $comment,
        int $rating)
    {
        $this->setId(Uuid::v4()->toRfc4122());
        $this->name = $name;
        $this->comment = $comment;
        $this->rating = $rating;
        $this->setCreatedAt(new DateTimeImmutable());
        $this->setUpdatedAt(new DateTime());
    }

    public static function create($name, $comment, $rating): self
    {
        return new static(
            $name,
            $comment,
            $rating
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
}
