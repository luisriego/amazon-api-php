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
final class Address
{
    use IdentifierTrait;
    use TimestampableTrait;
    use IsActiveTrait;
    use WhoTrait;

    #[ORM\Column(type: 'string', length: 50)]
    private string $street;

    #[ORM\Column(type: 'string', length: 30)]
    private string $city;

    #[ORM\Column(type: 'string', length: 20)]
    private string $department;

    #[ORM\Column(type: 'string', length: 10)]
    private string $zipCode;

    //    #[ORM\Column(type: 'string', length: 25)]
    //    private string $userName;  // this may be a relationship

    //    #[ORM\Column(type: 'string', length: 25)]
    //    private string $country; // this may be a relationship

    private function __construct() {
        $this->id = Uuid::v4()->toRfc4122();
        $this->isActive = false;
        $this->createdOn = new DateTimeImmutable();
        $this->whoCreated();
        $this->markAsUpdated();
        $this->whoUpdated();
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
}
