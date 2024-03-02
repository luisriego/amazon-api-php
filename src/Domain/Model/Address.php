<?php

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Repository\AddressRepositoryInterface;
use App\Domain\Trait\IdentifierTrait;
use App\Domain\Trait\IsActiveTrait;
use App\Domain\Trait\TimestampableTrait;
use App\Domain\Trait\WhoTrait;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AddressRepositoryInterface::class)]
class Address
{
    use IdentifierTrait;
    use TimestampableTrait;
    use IsActiveTrait;
    use WhoTrait;

    public const MIN_ROLE = 'ROLE_USER';

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 10)]
    private string $number;

    #[ORM\Column(type: 'string', length: 50)]
    private string $street;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $street2;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $department;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private ?string $neighborhood;

    #[ORM\Column(type: 'string', length: 30)]
    private string $city;

    #[ORM\Column(type: 'string', length: 10)]
    private string $zipCode;

    #[ORM\ManyToOne(targetEntity: Country::class, cascade: ['persist'])]
    private ?Country $country;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $owner;

    private function __construct(
        ?string $name,
        string $number,
        string $street,
        ?string $street2,
        ?string $department,
        ?string $neighborhood,
        string $city,
        string $zipCode,
        ?Country $country,
//        User $owner,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->number = $number;
        $this->street = $street;
        $this->street2 = $street2;
        $this->department = $department;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->zipCode = $zipCode;
        $this->country = $country;
//        $this->owner = $owner;
        $this->isActive = false;
        $this->createdOn = new DateTimeImmutable();
        $this->markAsUpdated();
    }

    public static function create(
        ?string $name,
        string $number,
        string $street,
        ?string $street2,
        ?string $department,
        ?string $neighborhood,
        string $city,
        string $zipCode,
        ?Country $country,
//        User $owner,
    ): self {
        return new Address(
            $name,
            $number,
            $street,
            $street2,
            $department,
            $neighborhood,
            $city,
            $zipCode,
            $country,
//            $owner,
        );
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function setDepartment(string $department): void
    {
        $this->department = $department;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): void
    {
        $this->owner = $owner;
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->owner->getId() === $user->getId();
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getStreet2(): ?string
    {
        return $this->street2;
    }

    public function setStreet2(?string $street2): void
    {
        $this->street2 = $street2;
    }

    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    public function setNeighborhood(?string $neighborhood): void
    {
        $this->neighborhood = $neighborhood;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->number . " " . $this->street;
    }

    public function toArray(): array
    {
        return [
            $this->name,
            $this->__toString()
        ];
    }
}
