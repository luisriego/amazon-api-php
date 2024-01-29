<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Common\BaseDomainModel;
use App\Domain\Repository\IImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IImageRepository::class)]
class Image extends BaseDomainModel
{
    #[ORM\Column(type: 'string', length: 255)]
    private string $url;

    #[ORM\Column(type: 'string', length: 255)]
    private string $publicCode;

    //    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'images')]
    //    private Collection $product;

    private function __construct(
        string $url,
        string $publicCode,
        //        string $product,
    ) {
        $this->url = $url;
        $this->publicCode = $publicCode;
        //        $this->product = new ArrayCollection();
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
}
