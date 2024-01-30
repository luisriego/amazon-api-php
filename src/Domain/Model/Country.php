<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\ICountryRepository;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ICountryRepository::class)]
class Country
{
    use IdentifierTrait;
    use TimestampableTrait;
    use WhoTrait;

    #[ORM\Column(type: 'string', length: 30)]
    private string $name;

    #[ORM\Column(type: 'string', length: 5)]
    private string $iso2;

    #[ORM\Column(type: 'string', length: 5)]
    private string $iso3;

    private function __construct(
        string $name,
        string $iso2,
        string $iso3,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->iso2 = $iso2;
        $this->iso3 = $iso3;
        $this->createdOn = new DateTimeImmutable();
        $this->updatedOn = new DateTime();
    }

    public static function create($name, $iso2, $iso3): self
    {
        return new static(
            $name,
            $iso2,
            $iso3,
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

    public function getIso2(): string
    {
        return $this->iso2;
    }

    public function setIso2(string $iso2): void
    {
        $this->iso2 = $iso2;
    }

    public function getIso3(): string
    {
        return $this->iso3;
    }

    public function setIso3(string $iso3): void
    {
        $this->iso3 = $iso3;
    }
}
