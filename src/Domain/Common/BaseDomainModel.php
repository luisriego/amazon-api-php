<?php

declare(strict_types=1);

namespace App\Domain\Common;

use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
class BaseDomainModel
{
    #[ORM\Column(type: 'string', length: 36, options: ['fixed' => true])]
    private string $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'date_time')]
    private DateTime $updatedAt;

    #[ORM\Column(type: 'string', length: 50)]
    private string $createdBy;

    #[ORM\Column(type: 'string', length: 50)]
    private string $updatedBy;

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    public function getUpdatedBy(): string
    {
        return $this->updatedBy;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function setCreatedBy(string $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function setUpdatedBy(string $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }
}
