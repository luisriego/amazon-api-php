<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\CountryRepositoryInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepositoryInterface::class)]
final class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private string $id;
    #[ORM\Column(type: 'string', length: 80)]
    private string $name;

    #[ORM\Column(type: 'string', length: 2)]
    private string $iso2;

    #[ORM\Column(type: 'string', length: 3)]
    private string $iso3;

    private function __construct(
        string $id,
        string $name,
        string $iso2,
        string $iso3,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->iso2 = $iso2;
        $this->iso3 = $iso3;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIso2(): string
    {
        return $this->iso2;
    }

    public function getIso3(): string
    {
        return $this->iso3;
    }
}
