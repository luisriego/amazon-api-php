<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\ImageRepositoryInterface;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ImageRepositoryInterface::class)]
class Image
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    #[ORM\Column(type: 'string', length: 255)]
    private string $url;

    #[ORM\Column(type: 'string', length: 255)]
    private string $publicCode;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product;

    private function __construct(
        string $url,
        string $publicCode,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->url = $url;
        $this->publicCode = $publicCode;
        $this->createdOn = new DateTimeImmutable();
        $this->updatedOn = new DateTime();
    }

    public static function create($url, $publicCode): self
    {
        return new static(
            $url,
            $publicCode,
        );
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getPublicCode(): string
    {
        return $this->publicCode;
    }

    public function setPublicCode(string $publicCode): void
    {
        $this->publicCode = $publicCode;
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
