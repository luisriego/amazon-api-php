<?php

declare(strict_types=1);

namespace App\Domain\Trait;

use Doctrine\ORM\Mapping as ORM;

trait UpdatedByTrait
{
    #[ORM\Column(type: 'string', length: 50)]
    protected string $updatedBy;

    public function getUpdatedOBy(): string
    {
        return $this->updatedBy;
    }

    #[ORM\PrePersist]
    public function whoWasUpdated(): void
    {
        $this->updatedBy = 'updatator';
    }
}
